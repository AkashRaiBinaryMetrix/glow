<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    public function index() {
         /*--------------- get banners data ----------------*/
          $aBannersLists = DB::table('banners')->where([['status',ACTIVE],['is_deleted',N]])->get();
         /*--------------- get banners data ----------------*/
         return view('myuser.home.index', ['aBannersLists'=>$aBannersLists]);
    }
    public function eventsList() {
        /*--------------- get all events list ------------------*/
        $aEventsList = DB::table('events')
                    ->where([['events.status',ACTIVE],['events.is_deleted',N]])
                    ->orderBy('id','desc')
                    ->get();
        /*--------------- get all events list ------------------*/

        $iUserId = getLoggedInUserId();
         /*-------------- get testimony or post created ----------------------*/
          $aInspirationalFeed = DB::table('insprational_feed')
                            ->leftJoin('users','insprational_feed.user_id','=','users.id')
                            ->select('insprational_feed.*','users.name','users.profile_pic')
                            ->where([['insprational_feed.status',ACTIVE],['insprational_feed.is_deleted',N]])
                            ->orderBy('id','desc')
                            ->get(); 
         /*-------------- get testimony or post created ----------------------*/

        /*--------------- get user group created and joined -------------------*/
        $aPublicGroupLists = DB::table('groups')
                       ->where('group_type',PUBLIC_GROUP_TYPE)
                       ->where([['status',ACTIVE],['is_deleted',N]])
                       ->orderBy('id','desc')
                       ->limit(3)
                       ->get();
        
        $aPrivateGroupLists = DB::table('groups')
                ->where('group_type',PRIVATE_GROUP_TYPE)
                ->where('user_id',$iUserId)
                ->where([['status',ACTIVE],['is_deleted',N]])
                ->orderBy('id','desc')
                ->limit(3)
                ->get();
        
        $aGroupLists = array();
        if(($aPublicGroupLists && count($aPublicGroupLists) > 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
          $aGroupLists = (object) array_merge($aPrivateGroupLists->toArray(),$aPublicGroupLists->toArray());
        } else if(($aPublicGroupLists && count($aPublicGroupLists) == 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
              $aGroupLists = $aPrivateGroupLists;
        } else {
              $aGroupLists = $aPublicGroupLists;
        }
        /*--------------- get user group created and joined -------------------*/
        
        /*-------------- get feelings and activity ----------------------*/
           $aFeelingLists = DB::table('feelings')->where([['status',ACTIVE],['is_deleted',N]])->get();
           $aActivityLists = DB::table('activities')->where([['status',ACTIVE],['is_deleted',N]])->get();
        /*-------------- get feelings and activity ----------------------*/

        return view('myuser.events.index', ['aEventsList'=>$aEventsList,'aGroupLists'=>$aGroupLists]);
    }
    public function eventDetail(Request $request, $iEventId) {
        $aEventDetail = DB::table('events')
                    ->where([['id',$iEventId],['events.status',ACTIVE],['events.is_deleted',N]])
                    ->first();
        /*--------------- get events post by admin ---------------------------*/
        $aEventsList = DB::table('events')
                    ->whereNotIn('id',[$iEventId])
                    ->where([['events.status',ACTIVE],['events.is_deleted',N]])
                    ->limit(2)
                    ->orderBy('id','desc')
                    ->get();
       /*--------------- get events post by admin ---------------------------*/
        return view('myuser.events.detail',['aEventDetail'=>$aEventDetail,
          'aEventsList'=>$aEventsList]);
    }
    public function showInterestInEvent(Request $request) {
          $post = $request->input();
          $iEventId = $post['iEventId'];
          $from = $post['from'];
         /*------------------- get current date time -------------------*/
          $iUserId = getLoggedInUserId();
          $sCurrentDateTime = getCurrentLocalDateTime();
         /*------------------- get current date time -------------------*/
         $aData = [
              'user_id'=>$iUserId,
              'event_id'=>$iEventId,
              'created_at'=>$sCurrentDateTime
         ];
         $iLastInsereetedId = DB::table('users_interested_in_events')->insertGetId($aData);
         if($iLastInsereetedId) {
              /*---------------------- get total users interested in events -----------------------*/
              $aTotalUsersInterested = !empty($iEventId) ? getTotalUsersInterestedInEvents($iEventId) : '';
            if(!empty($from) && $from == 'list') {
              $iTotalUsersInterested = !empty($aTotalUsersInterested) ? $aTotalUsersInterested.' interested': '';
              /*---------------------- get total users interested in events -----------------------*/

              /*---------------------- get total users going in events -----------------------*/
                $aTotalUsersGoing = !empty($iEventId) ? getTotalUsersGoingInEvents($iEventId) : '';
                $iTotalUsersGoing = !empty($aTotalUsersGoing) ? ' - '.$aTotalUsersGoing.' going': '';
              /*---------------------- get total users going in events -----------------------*/
              $sTotalUsersInterestedOrGoing = '';
              if(!empty($iTotalUsersInterested) && !empty($iTotalUsersGoing)) {
                  $sTotalUsersInterestedOrGoing = $iTotalUsersInterested.$iTotalUsersGoing;
              } else if(!empty($iTotalUsersInterested) && empty($iTotalUsersGoing)) {
                   $sTotalUsersInterestedOrGoing = $iTotalUsersInterested;
              } else if(empty($iTotalUsersInterested) && !empty($iTotalUsersGoing)) {
                   $sTotalUsersInterestedOrGoing = $aTotalUsersGoing.' going';
              }
              $isUserInterested = '<i class="lar la-star"></i> Interested';
             echo json_encode(['status'=>'success', 'sTotalUsersInterestedOrGoing'=>$sTotalUsersInterestedOrGoing,'isUserInterested'=>$isUserInterested]);
            } else {
                echo json_encode(['status'=>'success', 'sTotalUsersInterested'=>$aTotalUsersInterested]);
            }
         } else {
             echo json_encode(['status'=>'failure']);
         }
    }
    public function isUserGoingInEvent(Request $request) {
        $post = $request->input();
        $iEventId = $post['iEventId'];
       /*------------------- get current date time -------------------*/
        $iUserId = getLoggedInUserId();
        $sCurrentDateTime = getCurrentLocalDateTime();
       /*------------------- get current date time -------------------*/
       $aData = [
            'user_id'=>$iUserId,
            'event_id'=>$iEventId,
            'created_at'=>$sCurrentDateTime
       ];
       $iLastInsereetedId = DB::table('users_going_in_events')->insertGetId($aData);
       if($iLastInsereetedId) {
          
            /*---------------------- get total users going in events -----------------------*/
             $iTotalUsersGoing = !empty($iEventId) ? getTotalUsersGoingInEvents($iEventId) : '';
            /*---------------------- get total users going in events -----------------------*/
           echo json_encode(['status'=>'success', 'iTotalUsersGoing'=>$iTotalUsersGoing]);
       } else {
           echo json_encode(['status'=>'failure']);
       }
    }
    public function groupsList() {
           $iUserId = getLoggedInUserId();
        /*--------------- get user group created and joined -------------------*/
            $aPublicGroupLists = DB::table('groups')
                        ->join('users_joined_group','groups.id','=','users_joined_group.group_id')
                        ->select('groups.*')
                        ->whereIn('groups.group_type',[PUBLIC_GROUP_TYPE,PRIVATE_GROUP_TYPE])
                        ->where([['groups.status',ACTIVE],['groups.is_deleted',N]])
                        ->orderBy('groups.id','desc')
                        ->get();
            
            $aPrivateGroupLists = DB::table('groups')
                    ->whereIn('group_type',[PUBLIC_GROUP_TYPE,PRIVATE_GROUP_TYPE])
                    ->where('user_id',$iUserId)
                    ->where([['status',ACTIVE],['is_deleted',N]])
                    ->orderBy('id','desc')
                    ->get();
            
            $aGroupLists = array();
            if(($aPublicGroupLists && count($aPublicGroupLists) > 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
                $aGroupLists = (object) array_merge($aPrivateGroupLists->toArray(),$aPublicGroupLists->toArray());
            } else if(($aPublicGroupLists && count($aPublicGroupLists) == 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
                $aGroupLists = $aPrivateGroupLists;
            } else {
                $aGroupLists = $aPublicGroupLists;
            }
        /*--------------- get user group created and joined -------------------*/
        return view('myuser.groups.index',['aGroupLists'=>$aGroupLists]);
    }
    public function joinGroup(Request $request) {
        $post = $request->input();
        $iGroupId = $post['iGroupId'];
        $from = $post['from'];
       /*------------------- get current date time -------------------*/
        $iUserId = getLoggedInUserId();
        $sCurrentDateTime = getCurrentLocalDateTime();
       /*------------------- get current date time -------------------*/
       $aData = [
            'user_id'=>$iUserId,
            'group_id'=>$iGroupId,
            'created_at'=>$sCurrentDateTime
       ];
       $iLastInsereetedId = DB::table('users_joined_group')->insertGetId($aData);
       if($iLastInsereetedId) {
            /*---------------------- get total users interested in events -----------------------*/
            $iTotalGroupMember = !empty($iGroupId) ? getTotalUsersJoinedGroups($iGroupId) : 0;
            $iGroupCreatedByUser =  getTotalGroupCreatedByUser($iUserId);
            $iTotalGroupMember = $iTotalGroupMember+$iGroupCreatedByUser;
            $iTotalGroupMember = !empty($iTotalGroupMember) ? formatNumber($iTotalGroupMember) : '';
            if($from && $from == 'detail') {
                $sGroupType = getValueByColumnNameAndId('groups','id',$iGroupId,'name');
                $iTotalGroupMember = $sGroupType.' group · '.$iTotalGroupMember;
            }
            echo json_encode(['status'=>'success', 'iTotalGroupMember'=>$iTotalGroupMember]);
       } else {
           echo json_encode(['status'=>'failure']);
       }
    }
    public function groupDetail(Request $request, $iGroupId) {
        $iUserId = getLoggedInUserId();
        $aGroupDetail = DB::table('groups')
                    ->where([['id',$iGroupId],['groups.status',ACTIVE],['groups.is_deleted',N]])
                    ->first();
        /*--------------- get user group created and joined -------------------*/
        $aPublicGroupLists = DB::table('groups')
                       ->whereNotIn('id',[$iGroupId])
                       ->where('group_type',PUBLIC_GROUP_TYPE)
                       ->where([['status',ACTIVE],['is_deleted',N]])
                       ->orderBy('id','desc')
                       ->limit(3)
                       ->get();
        
        $aPrivateGroupLists = DB::table('groups')
                ->where('group_type',PRIVATE_GROUP_TYPE)
                ->whereNotIn('id',[$iGroupId])
                ->where('user_id',$iUserId)
                ->where([['status',ACTIVE],['is_deleted',N]])
                ->orderBy('id','desc')
                ->limit(3)
                ->get();
        
        $aGroupLists = array();
        if(($aPublicGroupLists && count($aPublicGroupLists) > 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
          $aGroupLists = (object) array_merge($aPrivateGroupLists->toArray(),$aPublicGroupLists->toArray());
        } else if(($aPublicGroupLists && count($aPublicGroupLists) == 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
              $aGroupLists = $aPrivateGroupLists;
        } else {
              $aGroupLists = $aPublicGroupLists;
        }
        /*--------------- get user group created and joined -------------------*/

        /*--------------- get events post by admin ---------------------------*/
        $aEventsList = DB::table('events')
                    ->where([['events.status',ACTIVE],['events.is_deleted',N]])
                    ->limit(1)
                    ->orderBy('id','desc')
                    ->get();
       /*--------------- get events post by admin ---------------------------*/

        return view('myuser.groups.detail',['aEventsList'=>$aEventsList,'aGroupLists'=>$aGroupLists,'aGroupDetail'=>$aGroupDetail]);
    }
    public function discoverGroupsList() {
        $iUserId = getLoggedInUserId();
        /*--------------- get user group created and joined -------------------*/
            $aGroupLists = DB::table('groups')
                        ->select('groups.*')
                        ->whereIn('groups.group_type',[PUBLIC_GROUP_TYPE,PRIVATE_GROUP_TYPE])
                        ->where([['groups.status',ACTIVE],['groups.is_deleted',N]])
                        ->whereNotIn('groups.user_id',[$iUserId])
                        ->orderBy('groups.id','desc')
                        ->get();
            // $aPrivateGroupLists = DB::table('groups')
            //         ->whereIn('group_type',[PUBLIC_GROUP_TYPE,PRIVATE_GROUP_TYPE])
            //         ->whereNotIn('user_id',$iUserId)
            //         ->where([['status',ACTIVE],['is_deleted',N]])
            //         ->orderBy('id','desc')
            //         ->get();
            
            // $aGroupLists = array();
            // if(($aPublicGroupLists && count($aPublicGroupLists) > 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
            //     $aGroupLists = (object) array_merge($aPrivateGroupLists->toArray(),$aPublicGroupLists->toArray());
            // } else if(($aPublicGroupLists && count($aPublicGroupLists) == 0) && ($aPrivateGroupLists && count($aPrivateGroupLists) > 0)) {
            //     $aGroupLists = $aPrivateGroupLists;
            // } else {
            //     $aGroupLists = $aPublicGroupLists;
            // }
        /*--------------- get user group created and joined -------------------*/
          return view('myuser.groups.discover',['aGroupLists'=>$aGroupLists]);
    }
    public function spiritualTestimony() {
        return view('myuser.spiritual_testimony.index');
    }
    public function powerOfHolySpirit() {
        return view('myuser.power_of_holy_spirit.index');
    }
    public function godLuvTips() {
        return view('myuser.godliv_tips.index');
    }
    public function give() {
        return view('myuser.give.index');
    }
    
}
