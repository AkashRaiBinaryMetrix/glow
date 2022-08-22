<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

          return view('myuser.profile.editDetails',['aLoggedInUserDetail'=>$aLoggedInUserDetail, 'userName' => $userName, 'joinedOn' => $joinedOn, 'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists]);
     }
}