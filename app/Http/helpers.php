<?php
use Illuminate\Support\Facades\DB;
define('SITE_NAME', "GOD'S LUVING WORDS (godluv.org)");
define('BASE_URL', "https://binarymetrix-dev.com/glow/");
define('ACTIVE', '1');
define('INACTIVE', '0');
define('Y', 'y');
define('N', 'n');
define('YES', 'yes');
define('NO', 'no');
define('MAIL_FROM_ADDRESS', 'godluv.noreply@gmail.com');
define('PUBLIC_GROUP_TYPE','Public');
define('PRIVATE_GROUP_TYPE','Private');
define('TIME_ZONE_NAME','America/Los_Angeles');
define('PRAYER','prayer');
function pr($aData)
{
    echo '<pre>';
    print_r($aData);
    echo '</pre>';
    die;
}
function prc($aData)
{
    echo '<pre>';
    print_r($aData);
    echo '</pre>';
}
function perPagePaging() {
    return DB::table('pagination')->value('per_page_record');
}
function getValueByColumnNameAndId($table,$columnName,$searchBy,$columnValue) {
    return DB::table($table)->where($columnName,$searchBy)->value($columnValue);
}
function getDataByMultipleId($table,$columnName,$searchBy,$orderBy='desc') {
  return DB::table($table)->whereIn($columnName,$searchBy)->get();
}

function getRowByColumnNameAndId($table,$columnName,$searchBy) {
  return DB::table($table)->where($columnName,$searchBy)->first();
}
function getRowByMultipleCondition($table,$condition=[]) {
    return DB::table($table)->where($condition)->first();
}
function format_interval(DateInterval $interval) {
        
    $result = "";
    if ($interval->y) { return $result = $interval->format("%y Years "); }
    if ($interval->m) { return $result = $interval->format("%m Months "); }
    if ($interval->d) { return $result = $interval->format("%d Days "); }
    if ($interval->h) { return $result = $interval->format("%h Hours "); }
    if ($interval->i) { return $result = $interval->format("%i minutes "); }
    return $result;
}
function getUTCDateTimeByZoneWise($zone = TIME_ZONE_NAME)
{
        if (!empty($zone)) {
            //date_default_timezone_set($zone);
            config(['app.timezone' => $zone]);
            $timestamp = date('Y-m-d H:i');
            date_default_timezone_set('UTC');
            return date("Y-m-d H:i", strtotime($timestamp));
        }
}
function getCurrentLocalDateTime($city_utc_time_zone=TIME_ZONE_NAME, $customDateTime = null) {
    !empty($city_utc_time_zone) ?  config(['app.timezone' => $city_utc_time_zone]) : '';
    $datetime = !empty($customDateTime) ? $customDateTime : date('Y-m-d H:i');
    return $datetime;
}
function getCurrentLocalDate($city_utc_time_zone, $customDateTime = null) {
!empty($city_utc_time_zone) ? config(['app.timezone' => $city_utc_time_zone]) : '';
$datetime = !empty($customDateTime) ? $customDateTime : date('Y-m-d');
return $datetime;
}
function getCurrentDateTimeByZoneFromUTC($city_utc_time_zone, $customDateTime = null)
{
    !empty($city_utc_time_zone) ? config(['app.timezone' => $city_utc_time_zone]) : '';
    $datetime = !empty($customDateTime) ? $customDateTime : date('Y-m-d H:i:s');
    if (!empty($city_utc_time_zone) && !empty($datetime)) {
        // create a $utc object with the UTC timezone
        $IST = new DateTime($datetime, new DateTimeZone('UTC'));

        // change the timezone of the object without changing it's time

        $IST->setTimezone(new DateTimeZone($city_utc_time_zone));

        // format the datetime
        return $IST->format('Y-m-d H:i');
    }
    return '';
}
function getLoggedInUserId() {
    $isUserLoggedIn = Session('isUserLoggedIn');
    return !empty($isUserLoggedIn->id) ? $isUserLoggedIn->id : '';
}
function getLoggedInUserName() {
    $isUserLoggedIn = Session('isUserLoggedIn');
    return !empty($isUserLoggedIn->name) ? str_replace("_*_"," ",$isUserLoggedIn->name) : '';
}
function isEventHideOrReportedByUser($iUserId,$iEventId) {
       return DB::table('events_hide_report')->where([['is_event_hide',YES],['event_id',$iEventId],['user_id',$iUserId]])->count();
}
function isPostHideOrReportedByUser($iUserId,$iInspirationalPostId) {
      return DB::table('insprational_feed_hide_report')->where([['is_insprational_feed_hide',YES],['insprational_feed_id',$iInspirationalPostId],['user_id',$iUserId]])->count();
}
function getTotalLikedPost($iUserId,$iInspirationalPostId) {
    $isUserLiked = DB::table('insprational_feed_like')->where([['user_id',$iUserId],['insprational_feed_id',$iInspirationalPostId]])->count();
    $iTotalLiked = DB::table('insprational_feed_like')->where([['insprational_feed_id',$iInspirationalPostId]])->count();
    $msg = 0;
    if($isUserLiked > 0 && $iTotalLiked == 1) {
        $msg = $isUserLiked > 0 && $iTotalLiked == 1 ? 'You like': 'You and '.$iTotalLiked.' others likes';
    } else if( $iTotalLiked > 0){
        $msg = $iTotalLiked.' likes';
    }
    return $msg;
}

function getTotalSharedPost($iUserId,$iInspirationalPostId) {
    $isUserShare = DB::table('insprational_feed_share_on_timeline')->where([['user_id',$iUserId],['insprational_feed_id',$iInspirationalPostId]])->count();
    $iTotalShares = DB::table('insprational_feed_share_on_timeline')->where([['insprational_feed_id',$iInspirationalPostId]])->count();
    $msg = 0;
    if($isUserShare > 0 && $iTotalShares == 1) {
        $msg = $isUserShare > 0 && $iTotalShares == 1 ? 'You share': 'You and '.$iTotalShares.' others shares';
    } else if($iTotalShares > 0){
        $msg = $iTotalShares.' shares';
    }
    return $msg;
}
function getTotalCommentPost($iUserId,$iInspirationalPostId) {
      return DB::table('comments')->where([['insprational_feed_id',$iInspirationalPostId]])->count();
}
function getName($sName) {
    return !empty($sName) ? str_replace("_*_"," ",$sName) : '';
}
function getInspirationalFeedCommentLists($iInspirationalPostId) {
       return DB::table('comments')
                ->leftJoin('users','comments.user_id','=','users.id')
                ->select('comments.*','users.name','users.profile_pic')
                ->whereNull('parent_id')
                ->where('insprational_feed_id',$iInspirationalPostId)->get();
}

function getNestedComment($icommentId) {
    return DB::table('comments')
    ->leftJoin('users','comments.user_id','=','users.id')
    ->select('comments.*','users.name','users.profile_pic')
    ->where('parent_id',$icommentId)->get();
}
function getReplyNestedComment($icommentId) {
    $aNestedCommentLists =  DB::table('comments')
    ->leftJoin('users','comments.user_id','=','users.id')
    ->select('comments.*','users.name','users.profile_pic')
    ->where('parent_id',$icommentId)->get();
    $sOutPut = '';
    if($aNestedCommentLists && count($aNestedCommentLists) > 0) {
            foreach($aNestedCommentLists as $key => $aNestedComment) {
                 $sUserName = !empty($aNestedComment->name) ? getName($aNestedComment->name) : '';
                 $sComment = !empty($aNestedComment->comment) ? $aNestedComment->comment : '';
                 $sDate = !empty($aNestedComment->created_at) ? date('d M Y', strtotime($aNestedComment->created_at)) : '';
                 $sTime = !empty($aNestedComment->created_at) ? date('H:i', strtotime($aNestedComment->created_at)) : '';
                 
                 $icommentId = !empty($aNestedComment->id) ? $aNestedComment->id : '';
                 $ipostId = !empty($aNestedComment->insprational_feed_id) ? $aNestedComment->insprational_feed_id : '';
                 $iCommentId = "'$icommentId'";
                 $iPostId = "'$ipostId'";
                 $iTotalCommentLike = getTotaLikeComment($aNestedComment->id) > 0 ? getTotaLikeComment($aNestedComment->id) : '';
                 $sUserProfilePic = !empty($aNestedComment->profile_pic) ? asset('images/profile/'.$aNestedComment->profile_pic) : asset('images/avtar1.png');
                 $sOutPut  .= '<div class="newsfeed-usercoments mt-3">
                        <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)"><img src="'.$sUserProfilePic.'" alt="" data-pagespeed-url-hash="2808585493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
                        <div class="newsfeed-commenting-comments">
                            <div class="commenting-comments2"><a href="javascript:void(0)">'.$sUserName.'</a> <span>'.$sComment.'</span></div>
                            <div class="commenting-comments2">
                                <a href="javascript:void(0)" onclick="likeComment('.$iCommentId.','.$iPostId.')">Like</a>
                                <a href="javascript:void(0)" onclick="replyOnComment('.$iCommentId.','.$iPostId.')">Reply</a>
                                <span id="commentLike'.$icommentId.'">
                                 <a href="javascript:void(0)"><img src="'.asset('images/like-ico-blue.png').'" alt="" data-pagespeed-url-hash="64196249" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> '.$iTotalCommentLike.'</a>';
                                
                                $sOutPut  .= '</span><span> '.$sDate.' at '.$sTime.'</span>
                                '.getReplyNestedComment($aNestedComment->id).'
                            </div>    
                        </div>
                    </div>';
            }
    }
    return $sOutPut;
}
function getTotaLikeComment($iCommentId) {
       return DB::table('comments_like')->where('comment_id',$iCommentId)->count();
}
function getTotalUsersInterestedInEvents($iEventId) {
    return DB::table('users_interested_in_events')->where('event_id',$iEventId)->count();
}
function getTotalUsersGoingInEvents($iEventId) {
    return DB::table('users_going_in_events')->where('event_id',$iEventId)->count();
}
function isUsersInterestedInEvents($iEventId) {
    $iUserId = getLoggedInUserId();
    return DB::table('users_interested_in_events')->where([['event_id',$iEventId],['user_id',$iUserId]])->count();
}
function isUsersGoingInEvents($iEventId) {
    $iUserId = getLoggedInUserId();
    return DB::table('users_going_in_events')->where([['event_id',$iEventId],['user_id',$iUserId]])->count();
}
function formatNumber($number) {
    if($number >= 1000) {
       return $number/1000 . "K members";   // NB: you will want to round this
    }
    else {
        return $number == 1 ? '1 member': $number.' members';
    }
}
function getTotalUsersJoinedGroups($iGroupId) {
    return DB::table('users_joined_group')->where([['group_id',$iGroupId]])->count();
}
function getTotalGroupCreatedByUser($iUserId) {
    return DB::table('groups')->where([['user_id',$iUserId]])->count();
}
function isGroupJoinedByUser($iGroupId) {
    $iUserId = getLoggedInUserId();
    return DB::table('users_joined_group')->where([['group_id',$iGroupId],['user_id',$iUserId]])->count();
}