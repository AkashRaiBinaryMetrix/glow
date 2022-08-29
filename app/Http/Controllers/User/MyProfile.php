<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Userabout;
use App\Models\Userwork;
use App\Models\Userplaces;
use App\Models\Userfamily;

class MyProfile extends Controller
{
     public function index(Request $request) {
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

          //get userabout details
          $userAboutData = DB::table('userabout')->where([['user_id',$iUserId]])->get();
          
          $dob = $aLoggedInUserDetail->dob;
          $dobNum  = date("m",strtotime($aLoggedInUserDetail->dob));
          $dobName = date('F', mktime(0, 0, 0, $dobNum, 10)); // March
          $dobyear = date("Y",strtotime($aLoggedInUserDetail->dob));
          $dobOn = $dobName.' '.$dobyear;

          return view('myuser.profile.index',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 
'userName' => $userName, 
'joinedOn' => $joinedOn, 
'aFeelingLists'=>$aFeelingLists,
'aActivityLists'=>$aActivityLists, 
'about_line' => isset($userAboutData[0]->about)? $userAboutData[0]->about : "", 
'from_line' => isset($userAboutData[0]->from) ? $userAboutData[0]->from : "",
'livesin_line' => isset($userAboutData[0]->lives_in)? $userAboutData[0]->lives_in : "", 
"dob_line" => $dobOn]);
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

          return view('myuser.profile.editPhoto',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'userPhotoData'=>$userPhotoData]);
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

}