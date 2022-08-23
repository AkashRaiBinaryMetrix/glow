<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Userabout;
use App\Models\Userwork;

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

          return view('myuser.profile.index',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists]);
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

          return view('myuser.profile.editDetails',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'userAboutData'=>$userAboutData, "firstName" => $explodeName[0],"lastName" => $explodeName[1], "userEducationData" => $userEducationData]);
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
                    "email" => $post["email"], 
                    "password" => !empty($password) ? Crypt::encryptString($post["password"]) : '' 
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
}