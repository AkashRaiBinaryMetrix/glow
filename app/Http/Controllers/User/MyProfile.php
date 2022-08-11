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
          return view('myuser.profile.index',['aLoggedInUserDetail'=>$aLoggedInUserDetail]);
     }
     public function uploadProfilePic(Request $request) {
          dd('hello');
     }
}
