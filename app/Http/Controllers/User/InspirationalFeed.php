<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class InspirationalFeed extends Controller
{
     public function index() {
          $iUserId = getLoggedInUserId();
         /*-------------- get testimony or post created ----------------------*/
          $aInspirationalFeed = DB::table('insprational_feed')
                            ->leftJoin('users','insprational_feed.user_id','=','users.id')
                            ->select('insprational_feed.*','users.name','users.profile_pic')
                            ->where([['insprational_feed.status',ACTIVE],['insprational_feed.is_deleted',N]])
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
        return view('myuser.inspirational_feed.index',['aGroupLists'=>$aGroupLists,'aEventsList'=>$aEventsList,'aFeelingLists'=>$aFeelingLists,'aActivityLists'=>$aActivityLists,'aInspirationalFeed'=>$aInspirationalFeed]);
     }
     public function createGroup(Request $request) {
         $post =  $request->input();
         $groupName = $post['groupName'] ?? '';
         $privacyType = $post['privacyType'] ?? '';
         $description = $post['description'] ?? '';
         /*-------------- check group exists --------------------*/
           $isExists = DB::table('groups')->where([['name',$groupName],['is_deleted',N]])->count();
           if($isExists) {
               echo json_encode(['status'=>'failure','msg'=>'Group name is already exists']);
               exit;
           }
         /*-------------- check group exists --------------------*/
         $isUserLoggedIn = Session('isUserLoggedIn');
         $iUserId = !empty($isUserLoggedIn->id) ? $isUserLoggedIn->id : '';
         /*------------------- get current date time -------------------*/
            $sCurrentDateTime = getCurrentLocalDateTime();
         /*------------------- get current date time -------------------*/
         $aData = [
              'user_id'=>$iUserId,
              'name'=>$groupName,
              'group_type'=>$privacyType,
              'description'=>$description,
              'created_at'=> $sCurrentDateTime
         ];
         if($request->file('image')){
          $file= $request->file('image');
          $filename= date('YmdHi').'_'.$file->getClientOriginalName();
          $file->move(public_path('public/images/groups'), $filename);
          $aData['image']= $filename;
        }
        $iLastInsertedId = DB::table('groups')->insertGetId($aData);
        if($iLastInsertedId) {
            /*------------- get all user event he have joined or created --------------------*/
            /*--------------- get user group created and joined -------------------*/
                $aPublicGroupLists = DB::table('groups')
                        ->where('group_type',PUBLIC_GROUP_TYPE)
                        ->where([['status',ACTIVE],['is_deleted',N]])
                        ->limit(3)
                        ->orderBy('id','desc')
                        ->get();

                $aPrivateGroupLists = DB::table('groups')
                ->where('group_type',PRIVATE_GROUP_TYPE)
                ->where('user_id',$iUserId)
                ->where([['status',ACTIVE],['is_deleted',N]])
                ->limit(3)
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
             $sOutput = '';
             if(!empty($aGroupLists)) {
                  foreach($aGroupLists as $key=> $aGroup) {
                      $iImage = 'public/images/groups/'.$aGroup->image;
                      $sName = !empty($aGroup->name) ? $aGroup->name : '';
                      $sURL  = url('group-detail/'.$aGroup->id);

                      $sCreatedDateTime = !empty($aGroup->created_at) ? $aGroup->created_at : '';
                      /*--------------- get current local Date Time from UTC ---------------*/
                       $sCurrentDate = getCurrentLocalDateTime();
                     /*--------------- get current local Date Time from UTC ---------------*/

                    $first_date = !empty($sCreatedDateTime) ? new DateTime($sCreatedDateTime) : "";
                    $second_date = !empty($sCurrentDate) ? new DateTime($sCurrentDate) : "";
                    $difference = !empty($first_date) && !empty($second_date) ? $first_date->diff($second_date) : "";
                    $sPosted     = !empty($difference) ? format_interval($difference) : "";   

                      $sOutput .= '<div class="aside-groups-col">
                      <a href="'.$sURL.'">
                        <div class="aside-groups-pic"><img src="'.$iImage.'" alt="" data-pagespeed-url-hash="624115584" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                        <div class="aside-groups-title">'.$sName.' <span class="event-post-time">Last active &bull; '.$sPosted.'</span></div>
                      </a>
                    </div>';
                  }
             }
            /*------------- get all user event he have joined or created --------------------*/
            echo json_encode(['status'=>'success','msg'=>'Group has been created successfully','sOutput'=>$sOutput]);
        } else {
            echo json_encode(['status'=>'failure','msg'=>'Group has not been created. Please try again']);
        }
     }
     public function hideEventOrReport(Request $request) {
           $post = $request->input();
           $id   = !empty($post['id']) ? $post['id'] : '';
           $type = !empty($post['type']) ? $post['type'] : '';
           /*------------------- get current date time -------------------*/
           $sCurrentDateTime = getCurrentLocalDateTime();
           /*------------------- get current date time -------------------*/

           $iUserId  = getLoggedInUserId();
           $aData = [
               'user_id'=>$iUserId,
               'event_id'=>$id,
               'created_at'=>$sCurrentDateTime
           ];
           if(!empty($type) && $type == 'hide') {
              $aData['is_event_hide'] = YES;
           } else {
              $aData['is_event_hide'] = YES;
              $aData['is_event_report'] = YES;
           }
           $iLastInsertedId = DB::table('events_hide_report')->insertGetId($aData);
           if($iLastInsertedId) {
              $sMsg = !empty($type) && $type == 'hide' ? 'Event has been hidden successfully' : 'Event has been hide and reported successfully';
              echo json_encode(['status'=>'success','msg'=>$sMsg]);
           } else {
              $sMsg = !empty($type) && $type == 'hide' ? 'Event has not been hidden' : 'Event has not been hide and reported';
              echo json_encode(['status'=>'failure','msg'=>$sMsg]);
           }
     }
  public function hideInspirationalFeed(Request $request) {
      $post = $request->input();
      $id   = !empty($post['id']) ? $post['id'] : '';
      $type = !empty($post['type']) ? $post['type'] : '';
      /*------------------- get current date time -------------------*/
      $sCurrentDateTime = getCurrentLocalDateTime();
      /*------------------- get current date time -------------------*/

      $iUserId  = getLoggedInUserId();
      $aData = [
          'user_id'=>$iUserId,
          'insprational_feed_id'=>$id,
          'created_at'=>$sCurrentDateTime
      ];
      if(!empty($type) && $type == 'hide') {
         $aData['is_insprational_feed_hide'] = YES;
      } else {
         $aData['is_insprational_feed_hide'] = YES;
         $aData['is_insprational_feed_report'] = YES;
      }
      $iLastInsertedId = DB::table('insprational_feed_hide_report')->insertGetId($aData);
      if($iLastInsertedId) {
         $sMsg = !empty($type) && $type == 'hide' ? 'Post has been hidden successfully' : 'Post has been hide and reported successfully';
         echo json_encode(['status'=>'success','msg'=>$sMsg]);
      } else {
         $sMsg = !empty($type) && $type == 'hide' ? 'Post has not been hidden' : 'Post has not been hide and reported';
         echo json_encode(['status'=>'failure','msg'=>$sMsg]);
      }
    }
     public function fellingSearch(Request $request) {
             $post = $request->input();
             $feeling_search = !empty($post['feeling_search']) ? $post['feeling_search'] : '';
            
             $aFeelingLists = DB::table('feelings')->where('name','like','%'.$feeling_search.'%')->where([['status',ACTIVE],['is_deleted',N]])->get();
             $sOutput = '';
             if($aFeelingLists && count($aFeelingLists) > 0) {
                 foreach($aFeelingLists as $key => $aFeeling) {
                   $sName = !empty($aFeeling->name) ? $aFeeling->name : '';
                   $sImage = !empty($aFeeling->image) ? asset($aFeeling->image) : '';
                   $iId = !empty($aFeeling->id) ?  $aFeeling->id : '';
                   $sFunName = "'$sName'";
                   $sFunImage = "'$sImage'";
                   $iFunId = "'$iId'";
                   $iActivityId = "''";
                   $sOutput .= '<li><a href="javascript:void(0)" onclick="showFeelingAndActivity('.$sFunName.','.$sFunImage.','.$iFunId.','.$iActivityId.')"><span class="feelsmilyicon"><img src="'.$sImage.'" alt="" data-pagespeed-url-hash="1699137061" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span> <span class="feelsmilytxt">'.$sName.'</span></a></li>';
                 }
             }
             echo json_encode(['sOutput'=>$sOutput]); 
     }
      public function activitySearch(Request $request) {
        $post = $request->input();
        $activity_search = !empty($post['activity_search']) ? $post['activity_search'] : '';
        $aActivityLists = DB::table('activities')->where('name','like','%'.$activity_search.'%')->where([['status',ACTIVE],['is_deleted',N]])->get();
        $sOutput = '';
        if($aActivityLists && count($aActivityLists) > 0) {
            foreach($aActivityLists as $key => $aActivity) {
              $sName = !empty($aActivity->name) ? $aActivity->name : '';
              $sImage = !empty($aActivity->image) ? asset($aActivity->image) : '';
              $iId = !empty($aActivity->id) ?  $aActivity->id : '';
              $sFunName = "'$sName'";
              $sFunImage = "'$sImage'";
              $iFunId = "'$iId'";
              $iFeelingId = "''";

              $sOutput .= '<li><a href="javascript:void(0)" onclick="showFeelingAndActivity('.$sFunName.','.$sFunImage.','.$iFunId.','.$iFeelingId.')"><span class="feelsmilyicon"><img src="'.$sImage.'" alt="" data-pagespeed-url-hash="1592760396" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span> <span class="feelsmilytxt">'.$sName.'</span> <i class="las la-angle-right"></i></a></li>';
            }
        }
        echo json_encode(['sOutput'=>$sOutput]); 
    }
    public function createInspirationalFeedPost(Request $request) {
        $post = $request->input();
        $whats_on_your_mind_post = !empty($post['whats_on_your_mind_post']) ? $post['whats_on_your_mind_post']: '';
        $feeling_id_post = !empty($post['feeling_id_post']) ? $post['feeling_id_post']: '';
        $activity_id_post = !empty($post['activity_id_post']) ? $post['activity_id_post']: '';

        /*------------------- get current date time -------------------*/
        $sCurrentDateTime = getCurrentLocalDateTime();
        /*------------------- get current date time -------------------*/
        $iUserId = getLoggedInUserId();
        $aData = [
              'user_id'=>$iUserId,
              'whats_on_your_mind'=>$whats_on_your_mind_post,
              'feeling_id'=>$feeling_id_post,
              'activity_id'=>$activity_id_post,
              'created_at'=>$sCurrentDateTime,
          ];
        if($request->file('file')){
            $file= $request->file('file');
            $filename= date('YmdHi').'_'.$file->getClientOriginalName();
            $file->move(public_path('images/inspirational_feed'), $filename);
            $aData['photo']= $filename;
        }
        $iLastInsertedId = DB::table('insprational_feed')->insertGetId($aData);
        if($iLastInsertedId) {
            echo json_encode(['status'=>'success','msg'=>'Inspirational feed has been posted successfully']);
        } else {
            echo json_encode(['status'=>'failure','msg'=>'Inspirational feed has not been posted. Please try again']);
        }
    }
    public function createInspirationalFeedTestimony(Request $request) {
      $post = $request->input();
      $whats_on_your_mind = !empty($post['whats_on_your_mind']) ? $post['whats_on_your_mind']: '';
      $feeling_id_testimony = !empty($post['feeling_id_testimony']) ? $post['feeling_id_testimony']: '';
      $activity_id_testimony = !empty($post['activity_id_testimony']) ? $post['activity_id_testimony']: '';

      /*------------------- get current date time -------------------*/
      $sCurrentDateTime = getCurrentLocalDateTime();
      /*------------------- get current date time -------------------*/
      $iUserId = getLoggedInUserId();
      $aData = [
            'user_id'=>$iUserId,
            'whats_on_your_mind'=>$whats_on_your_mind,
            'feeling_id'=>$feeling_id_testimony,
            'activity_id'=>$activity_id_testimony,
            'created_at'=>$sCurrentDateTime,
        ];
      if($request->file('testimony_videos')){
          $file= $request->file('testimony_videos');
          $filename= date('YmdHi').'_'.$file->getClientOriginalName();
          $file->move(public_path('videos/inspirational_feed'), $filename);
          $aData['videos']= $filename;
      }
      $iLastInsertedId = DB::table('insprational_feed')->insertGetId($aData);
      if($iLastInsertedId) {
          echo json_encode(['status'=>'success','msg'=>'Post has been posted successfully']);
      } else {
          echo json_encode(['status'=>'failure','msg'=>'Post has not been posted. Please try again']);
      }
  }
   public function likePost(Request $request) {
        $post = $request->input();
        $iUserId   = !empty($post['iUserId']) ? $post['iUserId'] : '';
        $iPostId = !empty($post['iPostId']) ? $post['iPostId'] : '';
        /*------------------- get current date time -------------------*/
        $sCurrentDateTime = getCurrentLocalDateTime();
        /*------------------- get current date time -------------------*/
        $isUserAlreadyLike = DB::table('insprational_feed_like')->where([['user_id',$iUserId],['insprational_feed_id',$iPostId]])->count();
        if($isUserAlreadyLike > 0) {
            echo json_encode(['status'=>'failure','msg'=>'You have already liked this post']);
            exit();
        }
        $aData = [
            'user_id'=>$iUserId,
            'insprational_feed_id'=>$iPostId,
            'created_at'=>$sCurrentDateTime
        ];
        $iLastInsertedId = DB::table('insprational_feed_like')->insertGetId($aData);
        if($iLastInsertedId) {
             $iTotalLikes = DB::table('insprational_feed_like')->where([['insprational_feed_id',$iPostId]])->count();
             $msg =  $iTotalLikes == 1 ? 'You like': 'You and '.$iTotalLikes.' others likes';
             echo json_encode(['status'=>'success','msg'=>'You have liked this post successfully','iTotalLikes'=>$msg]); 
        } else {
             echo json_encode(['status'=>'failure','msg'=>'You have not liked this post. Please try again']); 
        }
   }
   public function sharePostOnTimeLine(Request $request) {
    $post = $request->input();
    $iUserId   = !empty($post['iUserId']) ? $post['iUserId'] : '';
    $iPostId = !empty($post['iPostId']) ? $post['iPostId'] : '';
    /*------------------- get current date time -------------------*/
    $sCurrentDateTime = getCurrentLocalDateTime();
    /*------------------- get current date time -------------------*/
    $isUserAlreadyLike = DB::table('insprational_feed_share_on_timeline')->where([['user_id',$iUserId],['insprational_feed_id',$iPostId]])->count();
    if($isUserAlreadyLike > 0) {
        echo json_encode(['status'=>'failure','msg'=>'You have already share this post to your timeline']);
        exit();
    }
    $aData = [
        'user_id'=>$iUserId,
        'insprational_feed_id'=>$iPostId,
        'created_at'=>$sCurrentDateTime
    ];
    $iLastInsertedId = DB::table('insprational_feed_share_on_timeline')->insertGetId($aData);
    if($iLastInsertedId) {
         $iTotalShares = DB::table('insprational_feed_share_on_timeline')->where([['insprational_feed_id',$iPostId]])->count();
         $msg =  $iTotalShares == 1 ? 'You share': 'You and '.$iTotalShares.' others shares';
         echo json_encode(['status'=>'success','msg'=>'You have shared this post successfully','iTotalShares'=>$msg]); 
    } else {
         echo json_encode(['status'=>'failure','msg'=>'You have not shared this post. Please try again']); 
    }
  }
   public function commentOnPost(Request $request) {
        $post  = $request->input();
        $postId = $post['postId'];
        $comment = $post['comment'];
        $parentId = $post['parentId'];
        /*------------------- get current date time -------------------*/
          $iUserId = getLoggedInUserId();
          $sCurrentDateTime = getCurrentLocalDateTime();
        /*------------------- get current date time -------------------*/
         $aData = [
             'user_id'=>$iUserId,
             'insprational_feed_id'=>$postId,
             'parent_id'=>$parentId,
             'comment'=>$comment,
             'created_at'=>$sCurrentDateTime,
         ];
         $iLastInsertedId = DB::table('comments')->insertGetId($aData);
         if($iLastInsertedId) {
            $aCommentLists = getInspirationalFeedCommentLists($postId);
            
            $sOutput = '';
            /*------------------ get post comment and like ----------------------*/
                    if($aCommentLists && count($aCommentLists) > 0) {
                         foreach ($aCommentLists as $aComment) {
                              $sUserName = !empty($aComment->name) ? getName($aComment->name) : '';
                              $sCommentName = !empty($aComment->comment) && $aComment->comment == PRAYER ? '<img src="'.asset('images/prayer-icon.png').'">' : $aComment->comment;
                              $iCommentId = !empty($aComment->id) ? $aComment->id : '';
                              $iCommentedId = "'$iCommentId'";
                              $iPostedId = "'$postId'";

                              $iTotalike  = getTotaLikeComment($aComment->id) > 0 ? getTotaLikeComment($aComment->id) : '' ;
                              $sDate = !empty($aComment->created_at) ? date('d M Y', strtotime($aComment->created_at)) : '';
                              $sTime = !empty($aComment->created_at) ? date('H:i', strtotime($aComment->created_at)) : '';
                              $sUserProfilePic = !empty($aComment->profile_pic) ? asset('images/profile/'.$aComment->profile_pic) : asset('images/avtar1.png');

                              $sOutput .= '<div class="newsfeed-usercoments" id="commentSectionIndividualPost'.$iCommentId.'">
                              <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)"><img src="'.$sUserProfilePic.'" alt="" data-pagespeed-url-hash="2514085572" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
                                <div class="newsfeed-commenting-comments">
                                 <div class="commenting-comments1"><a href="javascript:void(0)">'.$sUserName.'</a><span>'.$sCommentName.'</span></div>
                                    
                                  <div class="commenting-comments2">
                                      <a href="javascript:void(0)" onclick="likeComment('.$iCommentedId.', '.$iPostedId.')">Like</a>
                                      <a href="javascript:void(0)" onclick="replyOnComment('.$iCommentedId.', '.$iPostedId.')">Reply</a>
                                      <span id="commentLike'.$iCommentId.'">
                                         <a href="javascript:void(0)"><img src="'.asset('images/like-ico-blue.png').'" alt="" data-pagespeed-url-hash="64196249" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">'.$iTotalike.'</a></span>
                                      <span>'.$sDate.' at '.$sTime.'</span>';
                                /*--------------- called recursion function to show comment nested comment --------------------*/
                                      $aNestedCommentLists = getNestedComment($aComment->id);
                                      
                                      if($aNestedCommentLists && count($aNestedCommentLists) > 0) {
                                          foreach($aNestedCommentLists as $key => $aNestedComment) {
                                                $sUserName = !empty($aNestedComment->name) ? getName($aNestedComment->name) : '';
                                                $sComment = !empty($aNestedComment->comment) ? $aNestedComment->comment : '';
                                                $sDate = !empty($aNestedComment->created_at) ? date('d M Y', strtotime($aNestedComment->created_at)) : '';
                                                $sTime = !empty($aNestedComment->created_at) ? date('H:i', strtotime($aNestedComment->created_at)) : '';
                                                
                                                $icommentId = !empty($aNestedComment->id) ? $aNestedComment->id : '';
                                                $ipostId = !empty($aNestedComment->insprational_feed_id) ? $aNestedComment->insprational_feed_id : '';
                                                $iCommentedId = "'$icommentId'";
                                                $iPostedId = "'$ipostId'";

                                                $iTotalLiked = getTotaLikeComment($aNestedComment->id) > 0 ? getTotaLikeComment($aNestedComment->id) : '';

                                                $sUserProfilePic = !empty($aNestedComment->profile_pic) ? asset('images/profile/'.$aNestedComment->profile_pic) : asset('images/avtar1.png');

                                                $sOutput .= '<div class="newsfeed-usercoments mt-3">
                                                <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)"><img src="'.$sUserProfilePic.'" alt="" data-pagespeed-url-hash="2808585493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
                                                <div class="newsfeed-commenting-comments">
                                                    <div class="commenting-comments2"><a href="javascript:void(0)"> '.$sUserName.' </a> <span> '.$sComment.' </span></div>
                                                    
                                                    <div class="commenting-comments2">
                                                        <a href="javascript:void(0)" onclick="likeComment('. $iCommentedId.' ,'.$iPostedId.')">Like</a>
                                                        <a href="javascript:void(0)" onclick="replyOnComment('. $iCommentedId.' ,'.$iPostedId.')">Reply</a>
                                                        <span id="commentLike'.$icommentId.'"><a href="javascript:void(0)"><img src="'.asset('images/like-ico-blue.png').'" alt="" data-pagespeed-url-hash="64196249" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">'.$iTotalLiked.' </a></span></span>
                                                        <span> '.$sDate.' at '.$sTime.'</span>
                                                          '.getReplyNestedComment($aNestedComment->id).'
                                                    </div>    
                                                </div>  
                                            </div>';
                                         }
                                    }
                                 $sOutput .='</div>    
                                 </div>  
                             </div>';
                                /*--------------- called recursion function to show comment nested comment --------------------*/
                         }
                    }
            /*------------------ get post comment and like ----------------------*/
            $iTotalComment = getTotalCommentPost($iUserId,$postId);
            echo json_encode(['status'=>'success','sOutput'=>$sOutput,'iTotalComment'=>$iTotalComment]);
         } else {
            echo json_encode(['status'=>'failure']);
         }
    }
    public function likeComment(Request $request) {
        $post  = $request->input();
        $iCommentId = $post['iCommentId'];
        $parentId = $post['parentId'];
        /*------------------- get current date time -------------------*/
          $iUserId = getLoggedInUserId();
          $sCurrentDateTime = getCurrentLocalDateTime();
        /*------------------- get current date time -------------------*/
         $isAlreadyLike = DB::table('comments_like')->where([['user_id',$iUserId],['comment_id',$iCommentId]])->count();
         if($isAlreadyLike > 0) {
            echo json_encode(['status'=>'failure','msg'=>'You have already like this comment']);
            exit();
         }
         $aData = [
             'user_id'=>$iUserId,
             'comment_id'=>$iCommentId,
             'parent_id'=>$parentId,
             'created_at'=>$sCurrentDateTime,
         ];
         $iLastInsertedId = DB::table('comments_like')->insertGetId($aData);
         if($iLastInsertedId) {
            $iTotalCommentLikes = DB::table('comments_like')->where([['comment_id',$iCommentId]])->count();
            $sMsg = '<img src="'.asset('images/like-ico-blue.png').'" alt="" data-pagespeed-url-hash="64196249" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> '.$iTotalCommentLikes.'';
            echo json_encode(['status'=>'success','iTotalCommentLikes'=>$sMsg]);
         } else {
            echo json_encode(['status'=>'failure']);
         }
    }

    //create events
    public function createEventFront(Request $request) {
         
         $post =  $request->input();
         
         $eventName = $post['eventName'] ?? '';
         $eventStartDateTime = $post['eventStartDateTime'] ?? '';
         $eventEndDateTime = $post['eventEndDateTime'] ?? '';
         $eventPrivacy = $post['eventPrivacy'] ?? '';
         $eventLocation = $post['eventLocation'] ?? '';
         $eventFile = $post['eventFile'] ?? '';
         $eventDescription = $post['eventDescription'] ?? '';

         /*-------------- check event exists --------------------*/
         $isExists = DB::table('events')->where([['name',$eventName],['is_deleted',"n"]])->count();
         if($isExists) {
               echo json_encode(['status'=>'failure','msg'=>'This event already exists']);
               exit;
         }

         /*-------------- check if user logged-in --------------------*/
         $isUserLoggedIn = Session('isUserLoggedIn');
         $iUserId = !empty($isUserLoggedIn->id) ? $isUserLoggedIn->id : '';
         
         /*------------------- get current date time -------------------*/
         $sCurrentDateTime = getCurrentLocalDateTime();

         /*------------------- check image -------------------*/
         if($request->file('eventFile')){
          $file= $request->file('eventFile');
          $filename= date('YmdHi').'_'.$file->getClientOriginalName();
          $file->move(public_path('public/images/events'), $filename);
          $aData['image']= $filename;
         }
         /*------------------- check image -------------------*/

         /*------------------- create event -------------------*/
         $aData = [
               'name'               => $eventName,
               'image'              => $aData['image'],
               'short_description'  => $eventDescription,
               'long_description'   => $eventDescription,
               'start_date_time'    => $eventStartDateTime,
               'end_date_time'      => $eventEndDateTime,
               'privacy'            => $eventPrivacy, 
               'location'           => $eventLocation,
               'created_at'         => $sCurrentDateTime,
               'created_by'         => $iUserId
         ];
        
         $iLastInsertedId = DB::table('events')->insertGetId($aData);
         /*------------------- create event -------------------*/
        
         if($iLastInsertedId) {
            /*------------- get all user event he have joined or created --------------------*/
            $aEventsListSql = DB::table('events')
                            ->where([['events.status',ACTIVE],['events.is_deleted',N]])
                            ->limit(2)
                            ->orderBy('id','desc')
                            ->get();

            $aGroupLists = array();
            $aGroupLists = $aEventsListSql;
            $sOutput = '';
             
            if(!empty($aGroupLists)) {
                foreach($aGroupLists as $key=> $aGroup) {
                    $iImage = 'public/images/groups/'.$aGroup->image;
                    $sName = !empty($aGroup->name) ? $aGroup->name : '';
                    $sURL  = url('group-detail/'.$aGroup->id);

                    $sCreatedDateTime = !empty($aGroup->created_at) ? $aGroup->created_at : '';
                    
                    /*--------------- get current local Date Time from UTC ---------------*/
                    $sCurrentDate = getCurrentLocalDateTime();
                    /*--------------- get current local Date Time from UTC ---------------*/

                    $first_date = !empty($sCreatedDateTime) ? new DateTime($sCreatedDateTime) : "";
                    $second_date = !empty($sCurrentDate) ? new DateTime($sCurrentDate) : "";
                    $difference = !empty($first_date) && !empty($second_date) ? $first_date->diff($second_date) : "";
                    $sPosted     = !empty($difference) ? format_interval($difference) : "";   

                    $sOutput .= '<div class="aside-groups-col">
                      <a href="'.$sURL.'">
                        <div class="aside-groups-pic"><img src="'.$iImage.'" alt="" data-pagespeed-url-hash="624115584" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                        <div class="aside-groups-title">'.$sName.' <span class="event-post-time">Last active &bull; '.$sPosted.'</span></div>
                      </a>
                    </div>';
                  }
             }

            /*------------- get all user event he have joined or created --------------------*/
            echo json_encode(['status'=>'success','msg'=>'Event has been created successfully','sOutput'=>$sOutput]);
        } else {
            echo json_encode(['status'=>'failure','msg'=>'Event has not been created. Please try again']);
        }
     }

    public function feedImageUpload(Request $request){
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

          // File upload configuration
          $targetDir = $_SERVER['DOCUMENT_ROOT'].'/images/inspirational_feed/';
          $allowTypes = array('jpg','png','jpeg','gif');
         
             $image_name = $_FILES['file']['name'];
             $tmp_name   = $_FILES['file']['tmp_name'];
             $size       = $_FILES['file']['size'];
             $type       = $_FILES['file']['type'];
             $error      = $_FILES['file']['error'];
            
             // File upload path
             $fileName = date("Ymd").$iUserId.basename($_FILES['file']['name']);
             $targetFilePath = $targetDir . $fileName;
             
             // Check whether file type is valid
             $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
             if(in_array($fileType, $allowTypes)){    
                 // Store images on the server
                 if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath)){
                     //$images_arr[] = $targetFilePath;
                    $output = array('uploaded' => 'OK' );
                 }else{
                    $output = array('uploaded' => 'OK' );
             
                 }
             }

             echo json_encode($output); 

             //store data
             //$fileName = trim(substr($targetFilePath, strrpos($targetFilePath, '/') + 1));

             

 }
}
