<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Userabout;
use App\Models\Userwork;
use App\Models\Userplaces;
use App\Models\Userfamily;
use App\Models\Following;
use App\Models\Notification;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use Exception;

class MyProfile extends Controller
{
     public function index(Request $request) {
          $iUserId = getLoggedInUserId();

           /*-------------- get testimony or post created ----------------------*/
          $aInspirationalFeed = DB::table('insprational_feed')
                            ->leftJoin('users','insprational_feed.user_id','=','users.id')
                            ->select('insprational_feed.*','users.name','users.profile_pic')
                            ->where([['insprational_feed.status',ACTIVE],['insprational_feed.is_deleted',N],['insprational_feed.user_id',$iUserId]])
                            ->orderBy('id','desc')
                            ->get(); 
         /*-------------- get testimony or post created ----------------------*/

         /*--------------- get events post by admin ---------------------------*/
          $aEventsList = DB::table('events')
                            ->where([['events.status',ACTIVE],['events.is_deleted',N]])
                            ->limit(2)
                            ->orderBy('id','desc')
                            ->get();
        /*--------------- get events post by admin ---------------------------*/

          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          //get userabout details
          $userAboutData = DB::table('userabout')->where([['user_id',$iUserId]])->get();
          
          $dob = $aLoggedInUserDetail->dob;
          $dobNum  = date("m",strtotime($aLoggedInUserDetail->dob));
          $dobName = date('F', mktime(0, 0, 0, $dobNum, 10)); // March
          $dobyear = date("Y",strtotime($aLoggedInUserDetail->dob));
          $dobOn = $dobName.' '.$dobyear;


          //get photos
          $userLightPhotoData = DB::table('userphoto')->where([['user_id',$iUserId]])->get();

          return view('myuser.profile.index',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 
'userName' => $userName, 
'joinedOn' => $joinedOn, 
'aFeelingLists'=>$aFeelingLists,
'aActivityLists'=>$aActivityLists, 
'about_line' => isset($userAboutData[0]->about)? $userAboutData[0]->about : "", 
'from_line' => isset($userAboutData[0]->from) ? $userAboutData[0]->from : "",
'livesin_line' => isset($userAboutData[0]->lives_in)? $userAboutData[0]->lives_in : "",
'aInspirationalFeed'=>$aInspirationalFeed, 
'aEventsList'=>$aEventsList,
'userLightPhotoData' => $userLightPhotoData,
"dob_line" => $dobOn,
"iUserIdCheck" => $iUserId
]);
     }

     public function edit_details(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
          
          //get userabout details
          $userAboutData = DB::table('userabout')->where([['user_id',$iUserId]])->get();

          //get education details
          $userEducationData = DB::table('userwork')->where([['user_id',$iUserId]])->get();

          //get places lived
          $userPlacesLivedData = DB::table('userplaces')->where([['user_id',$iUserId]])->get();
     
          //get places lived
          $userFamilyData = DB::table('userfamily')->where([['user_id',$iUserId]])->get();

          return view('myuser.profile.editDetails',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'userAboutData'=>$userAboutData, "firstName" => $explodeName[0],"lastName" => $explodeName[1], "userEducationData" => $userEducationData, "userPlacesLivedData" => $userPlacesLivedData, 'userFamilyData' => $userFamilyData]);
     }

     public function saveAbout(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          //update data in users table
          $full_name = $post["first_name"]." ".$post["last_name"];
          $final_full_name = str_replace(" ","_*_",$full_name);
          DB::table('users')->where('id',$iUserId)->update(
               [
                    "name" => $final_full_name,
                    "username" => $post["username"], 
                    //"email" => $post["email"], 
                    //"password" => !empty($password) ? Crypt::encryptString($post["password"]) : '' 
               ]
          );

          //update or create entry in user_about table
          Userabout::updateOrCreate(
                   [
                      'user_id'   => $iUserId,
                   ],
                   [
                      "studied_at" => $post["studied_at"],
                      "lives_in" => $post["lives_in"],
                      "from" => $post["from_city"],
                      "marital_status" => $post["marital_status"],
                      "phone" => $post["phone_no"],
                      "about" => $post["about_info"],
                      "zipcode" => $post["zipcode"],
                      "denomination" => $post["denomination"],
                      "member" => $post["member"],
                      "created_on" => $sCurrentDateTime
                   ],
               );
     }

     public function saveEducation(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          Userwork::create(
                   [
                      'user_id'   => $iUserId,
                      "type" => $post["type"],
                      "description" => $post["edu_description"],
                      "joining_year" => $post["joining_year"],
                      "completion_year" => $post["completion_year"],
                      "created_on" => $sCurrentDateTime
                   ],
               );
     }

     public function deleteEducation(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          DB::table('userwork')->where('id', '=',  $post["id"])->delete();
     }

     public function getEducation(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          $userEducationData = DB::table('userwork')->where([['id',$post["id"]]])->get();

          $data = array(
                         "type" => $userEducationData[0]->type,
                         "description"      =>    $userEducationData[0]->description,
                         "completion_year" =>           $userEducationData[0]->completion_year,
                         "joining_year" =>          $userEducationData[0]->joining_year);

          return json_encode($data);

     }

     function modalUpdateEducation(Request $request){

          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          DB::table('userwork')->where('id',$post["id"])->update(
               [
                    'type'=>$post["type_modal"],
                    'description'=>$post["edu_description_modal"],
                    'completion_year'=>$post["completion_year_modal"],
                    'joining_year'=>$post["joining_year_modal"],
               ]
          );
     }

     public function savePlacesLived(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          Userplaces::create(
                   [
                      'user_id'   => $iUserId,
                      "type" => $post["place_type"],
                      "desc" => $post["place_description"],
                      "created_on" => $sCurrentDateTime
                   ],
               );
     }

     public function deletePlacesLived(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          DB::table('userplaces')->where('id', '=',  $post["id"])->delete();
     }

        public function getPlacesLived(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          $userPlacesLivedData = DB::table('userplaces')->where([['id',$post["id"]]])->get();

          $data = array(
                         "type"             => $userPlacesLivedData[0]->type,
                         "description"      =>    $userPlacesLivedData[0]->desc,
                    );

          return json_encode($data);
     }

     function modalUpdatePlacesLived(Request $request){

          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          DB::table('userplaces')->where('id',$post["id"])->update(
               [
                    'type'=>$post["type_modal"],
                    'desc'=>$post["places_description_modal"],
               ]
          );
     }

       public function saveContact(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          //update or create entry in user_about table
          DB::table('users')->where('id',$iUserId)->update(
                   [
                      "mobile" => $post["contact_mobile"],
                      "address" => $post["contact_address"],
                      "gender" => $post["contact_gender"],
                      "dob" => $post["contact_dob"],
                      "year" => $post["contact_year"],
                      "languages" => $post["contact_languages"],
                      "interested_in" => $post["contact_interested_in"],
                   ]
               );
     }

     public function saveFamily(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          if(!empty($post)) {
            if($request->hasFile('family_pic')) {
               foreach ($request->file('family_pic') as  $image) {
                   // other methods
                   $size        = $image->getSize();
                   $ext         = $image->getClientOriginalExtension();
                   $mime_type = $image->getClientMimeType(); 
                   $filename= date('YmdHi').'_'.$image->getClientOriginalName();
                   $image->move(public_path('images/profile'), $filename);
               }
           }
          }

          Userfamily::create(
                   [
                      'user_id'    => $iUserId,
                      "image"      => $filename,
                      "name"       => $post["family_name"],
                      "relation"   => $post["family_relation"],
                      "created_on" => $sCurrentDateTime
                   ],
               );
     }

     public function deleteFamily(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          DB::table('userfamily')->where('id', '=',  $post["id"])->delete();
     }


     public function getFamily(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          $userFamilyData = DB::table('userfamily')->where([['id',$post["id"]]])->get();

          $data = array(
                         "name" => $userFamilyData[0]->name,
                         "relation"      =>    $userFamilyData[0]->relation,
                    );

          return json_encode($data);
     }

     function updateFamily(Request $request){

          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();


          if(!empty($post)) {
            if($request->hasFile('modal_family_pic')) {
               foreach ($request->file('modal_family_pic') as  $image) {
                   // other methods
                   $size        = $image->getSize();
                   $ext         = $image->getClientOriginalExtension();
                   $mime_type = $image->getClientMimeType(); 
                   $filename= date('YmdHi').'_'.$image->getClientOriginalName();
                   $image->move(public_path('images/profile'), $filename);
               }

                DB::table('userfamily')->where('id',$post["modal_family_id"])->update(
               [
                    'name'=>$post["modal_family_name"],
                    'relation'=>$post["modal_family_relation"],
                    'image' => $filename
               ]
          );
           }else{
               DB::table('userfamily')->where('id',$post["modal_family_id"])->update(
               [
                    'name'=>$post["modal_family_name"],
                    'relation'=>$post["modal_family_relation"],
               ]
          );
           }
          }
     }

     public function edit_photos(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
     
          //get photos
          $userPhotoData = DB::table('userphoto')->where([['user_id',$iUserId]])->get();

          //get feed photos
          $userFeedPhotoData = DB::table('insprational_feed')->where([['user_id',$iUserId],['photo','!=',""]])->get();

          return view('myuser.profile.editPhoto',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'userPhotoData'=>$userPhotoData,'userFeedPhotoData'=>$userFeedPhotoData]);
     }

     public function deletePhoto(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          unlink($_SERVER['DOCUMENT_ROOT'].'/images/userphotos/'.$post["url"]);

          DB::table('userphoto')->where('id', '=',  $post["id"])->delete();
          DB::table('insprational_feed')->where('user_profile_photo_upload_id', '=',  $post["id"])->delete();
     }

     public function uploadPhoto(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          //unlink($_SERVER['DOCUMENT_ROOT'].'/images/userphotos/'.$post["url"]);

          //DB::table('userphoto')->where('id', '=',  $post["id"])->delete();

         // File upload configuration
         $targetDir = $_SERVER['DOCUMENT_ROOT'].'/images/userphotos/';
         $allowTypes = array('jpg','png','jpeg','gif');
         
         $images_arr = array();
         foreach($_FILES['images']['name'] as $key=>$val){
             $image_name = $_FILES['images']['name'][$key];
             $tmp_name   = $_FILES['images']['tmp_name'][$key];
             $size       = $_FILES['images']['size'][$key];
             $type       = $_FILES['images']['type'][$key];
             $error      = $_FILES['images']['error'][$key];
             
             // File upload path
             $fileName = rand(1,100).date("Ymd").$iUserId.basename($_FILES['images']['name'][$key]);
             $targetFilePath = $targetDir . $fileName;
             
             // Check whether file type is valid
             $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
             if(in_array($fileType, $allowTypes)){    
                 // Store images on the server
                 if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                     $images_arr[] = $targetFilePath;
                 }
             }

             //store data
             $fileName = trim(substr($targetFilePath, strrpos($targetFilePath, '/') + 1));

             $iId = DB::table('userphoto')->insertGetId([
                    'user_id' => $iUserId,
                    'url' => $fileName,
                    'created_at' => $sCurrentDateTime
             ]);

             DB::table('insprational_feed')->insertGetId([
                    'user_id' => $iUserId,
                    'user_profile_photo_upload_id' => $iId,
                    'whats_on_your_mind' => "Uploaded a photo",
                    'photo' => $fileName,
                    'is_deleted' => 'n',
                    'status' => 1,
                    'created_at' => $sCurrentDateTime
             ]);
         }
     }

     public function edit_video(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
     
          //get videos
          $userVideoData = DB::table('uservideo')->where([['user_id',$iUserId]])->get();

          //get feed videos
          $userFeedVideoData = DB::table('insprational_feed')->where([['user_id',$iUserId],['videos','!=',""]])->get();

          return view('myuser.profile.editVideo',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'userVideoData'=>$userVideoData,'userFeedVideoData'=>$userFeedVideoData]);
     }

     public function uploadVideo(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          //unlink($_SERVER['DOCUMENT_ROOT'].'/images/userphotos/'.$post["url"]);

          //DB::table('userphoto')->where('id', '=',  $post["id"])->delete();

         // File upload configuration
         $targetDir = $_SERVER['DOCUMENT_ROOT'].'/images/uservideo/';
         $allowTypes = array('mp4');
         
         $images_arr = array();
         foreach($_FILES['videos']['name'] as $key=>$val){
             $image_name = $_FILES['videos']['name'][$key];
             $tmp_name   = $_FILES['videos']['tmp_name'][$key];
             $size       = $_FILES['videos']['size'][$key];
             $type       = $_FILES['videos']['type'][$key];
             $error      = $_FILES['videos']['error'][$key];
             
             // File upload path
             $fileName = rand(1,100).date("Ymd").$iUserId.basename($_FILES['videos']['name'][$key]);
             $targetFilePath = $targetDir . $fileName;
             
             // Check whether file type is valid
             $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
             if(in_array($fileType, $allowTypes)){    
                 // Store images on the server
                 if(move_uploaded_file($_FILES['videos']['tmp_name'][$key],$targetFilePath)){
                     $images_arr[] = $targetFilePath;
                 }
             }

             //store data
             $fileName = trim(substr($targetFilePath, strrpos($targetFilePath, '/') + 1));

             $iId = DB::table('uservideo')->insertGetId([
                    'user_id' => $iUserId,
                    'url' => $fileName,
                    'created_at' => $sCurrentDateTime
             ]);

             DB::table('insprational_feed')->insertGetId([
                    'user_id' => $iUserId,
                    'user_profile_video_upload_id' => $iId,
                    'whats_on_your_mind' => "Uploaded a video",
                    'videos' => $fileName,
                    'is_deleted' => 'n',
                    'status' => 1,
                    'created_at' => $sCurrentDateTime
             ]);
         }
     }

     public function deleteVideo(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $sCurrentDateTime = getCurrentLocalDateTime();

          unlink($_SERVER['DOCUMENT_ROOT'].'/images/uservideo/'.$post["url"]);

          DB::table('uservideo')->where('id', '=',  $post["id"])->delete();
          DB::table('insprational_feed')->where('user_profile_video_upload_id', '=',  $post["id"])->delete();
     }

     public function edit_following(Request $request) {
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
     
          //get photos
          $userPhotoData = DB::table('userphoto')->where([['user_id',$iUserId]])->get();

          //get all users list
          $userFollowingData = DB::table('users')->where([['id','!=',$iUserId],['status',1]])->get();

          return view('myuser.profile.editFollowing',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'userPhotoData'=>$userPhotoData, 'userFollowingData'=>$userFollowingData]);
     }

     public function processFollowing(Request $request){
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
     
          //get photos
          $userPhotoData = DB::table('userphoto')->where([['user_id',$iUserId]])->get();

          //get all users list
          $userFollowingData = DB::table('users')->where([['id','!=',$iUserId],['status',1]])->get();

          $sCurrentDateTime = getCurrentLocalDateTime();

          $followed_by_user_byData = DB::table('users')->where([['id','=',$iUserId],['status',1]])->get();

          //create following notification
          DB::table('notification')->insertGetId([
                    'for_user' => $post["following_user_id"],
                    'by_user' => $post["followed_by_user_by"],
                    'type' => 'following',
                    'status' => 'unread',
                    'description' => str_replace('_*_',' ',$followed_by_user_byData[0]->name).' has started following you',
                    'created_at' => $sCurrentDateTime
          ]);

          DB::table('follow_following')->insertGetId([
                    'following_user_id' => $post["following_user_id"],
                    'followed_by_user_by' => $post["followed_by_user_by"],
                    'created_at' => $sCurrentDateTime
          ]);
          
     }

     public function deleteFollowing(Request $request){
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
     
          //get photos
          $userPhotoData = DB::table('userphoto')->where([['user_id',$iUserId]])->get();

          //get all users list
          $userFollowingData = DB::table('users')->where([['id','!=',$iUserId],['status',1]])->get();

          $sCurrentDateTime = getCurrentLocalDateTime();

          $followed_by_user_byData = DB::table('users')->where([['id','=',$iUserId],['status',1]])->get();

          //create following notification
          DB::table('notification')->insertGetId([
                    'for_user' => $post["following_user_id"],
                    'by_user' => $post["followed_by_user_by"],
                    'type' => 'following',
                    'status' => 'unread',
                    'description' => str_replace('_*_',' ',$followed_by_user_byData[0]->name).' has un followed you',
                    'created_at' => $sCurrentDateTime
          ]);

          Following::where('following_user_id',$post["following_user_id"])->where('followed_by_user_by',$post["followed_by_user_by"])->delete();
     }

     public function edit_followers(Request $request){
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
     
          //get photos
          $userPhotoData = DB::table('userphoto')->where([['user_id',$iUserId]])->get();

          //get all users list
          $userFollowersData = DB::table('follow_following')->where([['following_user_id','=',$iUserId]])->get();

          return view('myuser.profile.editFollowers',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'userPhotoData'=>$userPhotoData, 'userFollowersData'=>$userFollowersData]);
     }

     public function deleteFollower(Request $request){
          $iUserId = getLoggedInUserId();
          
          $post = $request->input();
          if(!empty($post)) {
            if($request->file('profilePic')) {
                $file= $request->file('profilePic');
                $filename= date('YmdHi').'_'.$file->getClientOriginalName();
                $file->move(public_path('images/profile'), $filename);
                DB::table('users')->where('id',$iUserId)->update(['profile_pic'=>$filename]);
             }
          }
          
          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$iUserId);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);
     
          //get photos
          $userPhotoData = DB::table('userphoto')->where([['user_id',$iUserId]])->get();

          //get all users list
          $userFollowingData = DB::table('users')->where([['id','!=',$iUserId],['status',1]])->get();

          $sCurrentDateTime = getCurrentLocalDateTime();

          Following::where('id',$post["id"])->delete();
     }

     public function markAllRead(Request $request){
          $iUserId = getLoggedInUserId();
          $post = $request->input();
          $sCurrentDateTime = getCurrentLocalDateTime();

          DB::table('notification')->where('for_user',$iUserId)->update(['status'=>'read']);
     }

     public function getUsersList(Request $request){
          $iUserId = getLoggedInUserId();
          $post = $request->input();
          $sCurrentDateTime = getCurrentLocalDateTime();

          $html ="";

          //get all users list
          $userData = DB::table('users')->where([['id','!=',$iUserId],['status',1],['name','like','%' .$post["query"].'%']])->get();

          $html .='<div class="table-responsive"><table class="table table bordered">';
          
          if(empty($post["query"])){
               $html .='<tr>
                              <td>Search string empty</td>
                    </tr>';
          }else if(count($userData) == 0){
               $html .='<tr>
                              <td>No data found</td>
                    </tr>';
          }else{
              foreach($userData as $userDataResult){
                    $html .='<tr>
                              <td><img src="'.asset('images/profile/'.$userDataResult->profile_pic).'" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" style=""></td>
                              <td style=""><a href="view-profile/'.$userDataResult->id.'" id="profile-edit-top-anchor"><p style="">'.str_replace("_*_", " ", $userDataResult->name).'</p></a></td>
                    </tr>';
              }  
          }
          
          $html .="</table></div>";

          echo $html;
     }

     public function viewDifferentProfile($id){
          $iUserId = getLoggedInUserId();

          /*-------------- get testimony or post created ----------------------*/
          $aInspirationalFeed = DB::table('insprational_feed')
                            ->leftJoin('users','insprational_feed.user_id','=','users.id')
                            ->select('insprational_feed.*','users.name','users.profile_pic')
                            ->where([['insprational_feed.status',ACTIVE],['insprational_feed.is_deleted',N],['insprational_feed.user_id',$id]])
                            ->orderBy('id','desc')
                            ->get(); 
          /*-------------- get testimony or post created ----------------------*/

          /*--------------- get events post by admin ---------------------------*/
          $aEventsList = DB::table('events')
                            ->where([['events.status',ACTIVE],['events.is_deleted',N]])
                            ->limit(2)
                            ->orderBy('id','desc')
                            ->get();
          /*--------------- get events post by admin ---------------------------*/

          /*--------------------- get profile pic -----------------*/
          $aLoggedInUserDetail = getRowByColumnNameAndId('users','id',$id);
          /*--------------------- get profile pic -----------------*/

          /*-------------- get feelings and activity ----------------------*/
          $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
          $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
          /*-------------- get feelings and activity ----------------------*/

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          
          $monthNum  = date("m",strtotime($aLoggedInUserDetail->created_at));
          $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
          $year = date("Y",strtotime($aLoggedInUserDetail->created_at));
          $joinedOn = $monthName.' '.$year;

          //get userabout details
          $userAboutData = DB::table('userabout')->where([['user_id',$id]])->get();
          
          $dob = $aLoggedInUserDetail->dob;
          $dobNum  = date("m",strtotime($aLoggedInUserDetail->dob));
          $dobName = date('F', mktime(0, 0, 0, $dobNum, 10)); // March
          $dobyear = date("Y",strtotime($aLoggedInUserDetail->dob));
          $dobOn = $dobName.' '.$dobyear;

          //get photos
          $userLightPhotoData = DB::table('userphoto')->where([['user_id',$id]])->get();

           //get photos
          $userVideoData = DB::table('uservideo')->where([['user_id',$id]])->get();

          //get photos
          $userPhotoData = DB::table('userphoto')->where([['user_id',$id]])->get();

          //get all users list
          $userFollowingData = DB::table('follow_following')->where([['followed_by_user_by',$id]])->get();

          //get all users list
          $userFollowersData = DB::table('follow_following')->where([['following_user_id',$id]])->get();

          //get userabout details
          $userAboutData = DB::table('userabout')->where([['user_id',$id]])->get();

          //get education details
          $userEducationData = DB::table('userwork')->where([['user_id',$id]])->get();

          //get places lived
          $userPlacesLivedData = DB::table('userplaces')->where([['user_id',$id]])->get();
     
          //get places lived
          $userFamilyData = DB::table('userfamily')->where([['user_id',$id]])->get();

          $userName = str_replace("_*_"," ",$aLoggedInUserDetail->name);
          
          $joinedOn = $monthName.' '.$year;

          $explodeName = explode(" ",$userName);

          return view('myuser.profile.viewDifferentProfile',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 
               'userName' => $userName, 
               'joinedOn' => $joinedOn, 
               'aFeelingLists'=>$aFeelingLists,
               'aActivityLists'=>$aActivityLists, 
               'about_line' => isset($userAboutData[0]->about)? $userAboutData[0]->about : "", 
               'from_line' => isset($userAboutData[0]->from) ? $userAboutData[0]->from : "",
               'livesin_line' => isset($userAboutData[0]->lives_in)? $userAboutData[0]->lives_in : "",
               'aInspirationalFeed'=>$aInspirationalFeed, 
               'aEventsList'=>$aEventsList,
               'userLightPhotoData' => $userLightPhotoData,
               "dob_line" => $dobOn,
               "iUserIdCheck" => $id,
               'userVideoData'=>$userVideoData,
               'userPhotoData'=>$userPhotoData,
               'userFollowingData' => $userFollowingData,
               'userFollowersData' => $userFollowersData,
               'userAboutData'=>$userAboutData, 
               "firstName" => $explodeName[0],
               "lastName" => $explodeName[1], 
               "userEducationData" => $userEducationData, 
               "userPlacesLivedData" => $userPlacesLivedData, 
               'userFamilyData' => $userFamilyData,
               'logged_in_userid' =>  $iUserId,
               'view_profile_userid' => $id
               ]);
     }

     public function getUsersListInvite(Request $request){
          $iUserId = getLoggedInUserId();
          $post = $request->input();
          $sCurrentDateTime = getCurrentLocalDateTime();

          $html ="";

          //get all users list
          $userData = DB::table('users')->where([['id','!=',$iUserId],['status',1],['name','like','%' .$post["query"].'%']])->get();

          
          if(empty($post["query"])){
               $html .='<span>Search string empty</span>';
          }else if(count($userData) == 0){
               $html .='<span>No data found</span>';
          }else{
              foreach($userData as $userDataResult){

                    $img = (empty($userDataResult->profile_pic))?asset('images/dummy.png') : asset('images/profile/'.$userDataResult->profile_pic);

                    $html .='<div class="custom-control custom-checkbox">';

                    $html .='<input type="checkbox" class="" id="group_invite_checkbox" name="group_invite_checkbox[]" value="'.$userDataResult->email.'">
                    <span class="invitefrnd-pic"><img src="'.$img.'" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" style=""></span>'.$userDataResult->name;

                    $html .="</div>";
              }  
          }

          echo $html;
     }

     public function send_invitation(Request $request){
          $iUserId = getLoggedInUserId();
          $post = $request->input();
          $sCurrentDateTime = getCurrentLocalDateTime();

          //get emails
          $group_invite_checkbox = $post["group_invite_checkbox"];

          //inviting_person_name
          $inviting_person_name = DB::table('users')->where([['id','=',$iUserId]])->get();
          $final_inviting_person_name = str_replace("_*_"," ",$inviting_person_name[0]->name);

          //get group name
          $aGroupDetail = DB::table('groups')
                    ->where([['id',$post["group_id"]]])
                    ->get();

          //send mail
          foreach($group_invite_checkbox as $email){
               //invited_to
               $invited_to = DB::table('users')->where([['email','=',$group_invite_checkbox]])->get();
               $final_invited_to = str_replace("_*_"," ",$invited_to[0]->name);

               Mail::send('myuser.mail_template.sendGroupInvite', ['inviting_person_name' => $final_inviting_person_name,'invited_to' => $final_invited_to, 'group_name' => $aGroupDetail[0]->name], function ($message) use ($email) {
                             $message->to($email)
                                 ->subject(SITE_NAME . ' Group Invitation')
                                 ->from(MAIL_FROM_ADDRESS);
                         });

               //create notification
               DB::table('notification')->insertGetId([
                    'for_user' => $invited_to[0]->id,
                    'by_user' => $iUserId,
                    'type' => 'group_invite',
                    'status' => 'unread',
                    'description' => $final_inviting_person_name.' is inviting you to join group '.$aGroupDetail[0]->name,
                    'created_at' => $sCurrentDateTime
               ]);
          }
     }

}