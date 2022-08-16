@extends('myuser.layouts.view')
@section('title', 'Inspirational Feed')
@section('content')
@php
$iUserId  = getLoggedInUserId();
$sLoggedInUserProfileImage = getValueByColumnNameAndId('users','id',$iUserId,'profile_pic');
@endphp
<div class="social-media-page">
  <div class="inner-socialcontainer">
    @include('admin.layouts.session_message')
    <div class="row">
      <div class="col-md-7 custom-7">
        <input type="hidden" id="sLoggedInUserName" value="{{ getLoggedInUserName() }}"/>
        <div class="user-activity-sec white-box">
          <div class="user-activity-head">    
            <div class="user-pic"><a href="javascript:void(0)"><img width="40px" height="23px" src="{{ !empty($sLoggedInUserProfileImage) ? asset('images/profile/'.$sLoggedInUserProfileImage) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="399097396" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>
            <div class="user-input"><input type="text" class="activity-input" placeholder="What’s on your mind?"></div>    
          </div>
          
          <div class="user-activity-btns">
           <div class="user-live-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postlivemodal"><img src="{{ asset('images/live-video-icon.png') }}" alt="" data-pagespeed-url-hash="1806690493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Testimony</a></div>
           <div class="user-photo-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postmediamodal" class="postmediamodal"><img src="{{ asset('images/camera-icon.png') }}" alt="" data-pagespeed-url-hash="676148810" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Photo</a></div>
           <div class="user-feel-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postfeelingmodal"><img src="{{ asset('images/smiley-icon.png') }}" alt="" data-pagespeed-url-hash="1049116682" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Feeling /Activity</a></div>     
         </div>    
       </div>

       <div class="newsfeed-wrapper">
         @if($aInspirationalFeed && count($aInspirationalFeed) > 0)
         @foreach ($aInspirationalFeed as $key=> $aInspirational)
         @php
         /*-------------------------- check user is hide event or raise against report ---------------*/
         $isHideOrReport = !empty($aInspirational->id) ? isPostHideOrReportedByUser($iUserId, $aInspirational->id) : '';
         if($isHideOrReport > 0) {
          continue;
        }
        /*-------------------------- check user is hide event or raise against report ---------------*/

        /*------------------------- check user is feeling happy or activity --------------------------*/

        if(!empty($aInspirational->feeling_id) && empty($aInspirational->activity_id)) {
          $aFeelingOrActityDetail = !empty($aInspirational->feeling_id) ? getRowByColumnNameAndId('feelings','id',$aInspirational->feeling_id)  : '';
        } else {
          $aFeelingOrActityDetail = !empty($aInspirational->activity_id) ? getRowByColumnNameAndId('activities','id',$aInspirational->activity_id) : '';
        }

        /*------------------------- check user is feeling happy or activity --------------------------*/
        @endphp

        <div class="newsfeed-sec inspirationTestimonyOrPost" id="inspirationTestimonyOrPost{{$aInspirational->id}}">

         <div class="newsfeed-tophead">     
          <div class="newsfeed-top-sec">
            <div class="news-userpic"><img src="{{ !empty($aInspirational->profile_pic) ? asset('images/profile/'.$aInspirational->profile_pic) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
            <div class="newsfeed-text"><h3>{{!empty($aInspirational->name) ? getName($aInspirational->name): ''}} 
             @if(!empty($aInspirational->feeling_id) && empty($aInspirational->activity_id) && !empty($aFeelingOrActityDetail))
             is <span class="feelsmilyicon" style="width: 34px;height: 34px;border: 1px solid #adc8cf;padding: 6px;border-radius: 50%;background: #E5F9FE;line-height: 19px;margin-right: 8px;"><img src="{{ asset($aFeelingOrActityDetail->image) }}"></span> feeling {{ $aFeelingOrActityDetail->name }}
             @elseif (!empty($aInspirational->activity_id) && empty($aInspirational->feeling_id) && !empty($aFeelingOrActityDetail))
             is <span class="feelsmilyicon" style="width: 34px;height: 34px;border: 1px solid #adc8cf;padding: 6px;border-radius: 50%;background: #E5F9FE;line-height: 19px;margin-right: 8px;"><img src="{{$aFeelingOrActityDetail->image}}"></span> {{ $aFeelingOrActityDetail->name }}
             @endif 
           </h3> <p>{{ !empty($aInspirational->created_at) ? date('d-M-Y h:i', strtotime($aInspirational->created_at)): ''}}</p></div>
         </div>

         <div class="newsfeed-arrow">
           <div class="dropdown">
            <button type="button" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('images/event-arrow-icon.png') }}" alt="" data-pagespeed-url-hash="603205129" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
            </button>
            <div class="dropdown-menu">
             <a class="dropdown-item" href="javascript:void(0)" onclick="hideInspirationalFeed({{ $aInspirational->id }},'hide')"><i class="las la-eye-slash"></i> Hide</a>
             <a class="dropdown-item" href="javascript:void(0)" onclick="hideInspirationalFeed({{ $aInspirational->id }},'hide')"><i class="las la-flag"></i> Report</a>
           </div>
         </div>
       </div>

     </div><!--newsfeed-tophead-->  

     <div class="newsfeed-desc"><p>{{ !empty($aInspirational->whats_on_your_mind) ? $aInspirational->whats_on_your_mind : '' }}</p></div>
     @if(!empty($aInspirational->photo))
     <div class="newsfeed-mainpic"><img src="{{ asset('images/inspirational_feed/'.$aInspirational->photo) }}" alt="" data-pagespeed-url-hash="943057311" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
     @elseif (!empty($aInspirational->videos))
     <div class="newsfeed-mainpic">
      <video width="100%" height="240" controls>
       <source src="{{ asset('videos/inspirational_feed/'.$aInspirational->videos) }}">
       </video>
     </div>
     @else

     @endif


     <div class="newsfeed-licosh-col">
       <div class="feednewlikes"><a href="javascript:void(0)" onclick="likePost({{ $iUserId}},{{ $aInspirational->id}})"><img src="{{ asset('images/like-ico.png')}}" alt="" data-pagespeed-url-hash="1279223300" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Like</span></a> </div>
       <div class="feednewcomment"><a href="javascript:void(0)" onclick="commentOnPost({{ $iUserId}},{{ $aInspirational->id}})"><img src="{{ asset('images/comment-ico.png') }}" alt="" data-pagespeed-url-hash="1033231412" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Comments</span></a> </div>
       <div class="feednewprayer"><a href="javascript:void(0)" onclick="submitComment({{$aInspirational->id}},'prayer')"><img src="{{ asset('images/prayer-icon.png') }}" alt="" data-pagespeed-url-hash="3948427328" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Prayer</span></a> </div>
       <div class="feednewshare"><a href="javascript:void(0)" onclick="sharePostOnTimeLine({{ $iUserId}},{{ $aInspirational->id}})"><img src="{{ asset('images/post-share-ico.png') }}" alt="" data-pagespeed-url-hash="4226147923" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">  <span>Shares</span></a> </div>   
     </div>
     @php
     /*------------------- check user liked post or not and also check total like ---------*/
     $iTotalLiked = getTotalLikedPost($iUserId,$aInspirational->id);
     /*------------------- check user liked post or not and also check total like ---------*/

     /*------------------- check user share post or not and also check total share ---------*/
     $iTotalShared = getTotalSharedPost($iUserId,$aInspirational->id);
     /*------------------- check user share post or not and also check total share ---------*/

     /*------------------- check user share post or not and also check total share ---------*/
     $iTotalComment = getTotalCommentPost($iUserId,$aInspirational->id);
     /*------------------- check user share post or not and also check total share ---------*/
     @endphp   
     <div class="feed-maincomment-sec">

      <div class="newsfeed-liked-col">
        <div class="row align-items-center">
         <div class="col-4"><div class="totalshares" id="totallike">{{ !empty($iTotalLiked) ? $iTotalLiked : ''}}</div></div>
         <div class="col-4"><div class="totalcomenshare" id="totalcomment">{{ !empty($iTotalComment) ? $iTotalComment.' comments' : ''}}</div></div>
         <div class="col-4 text-right"><div class="totalshares" id="totalshares">{{ !empty($iTotalShared) ? $iTotalShared : ''}}</div></div>
       </div>
     </div>       

     @php
     /*------------------ get comments -----------------*/
     $aCommentLists = getInspirationalFeedCommentLists($aInspirational->id);
     /*------------------ get comments -----------------*/ 
     @endphp

     {{-- <div class="newsfeed-liked-col">
      <div class="row align-items-center">
       <div class="col-6"><div class="totalshares"><a href="javascript:void(0)">View previous comments</a> </div></div>
       <div class="col-6 text-right"><div class="totalcomenshare">2 of 150 </div></div>
     </div>
   </div> --}}
   <div id="commentSectionIndividualPost{{$aInspirational->id}}">
     @if($aCommentLists && count($aCommentLists) > 0)
     @foreach ($aCommentLists as $aComment)


     <div class="newsfeed-usercoments">
       <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)">
        <img src="{{ !empty($aComment->profile_pic) ? asset('images/profile/'.$aComment->profile_pic) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="2514085572" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
        <div class="newsfeed-commenting-comments">
          <div class="commenting-comments1"><a href="javascript:void(0)">{{!empty($aComment->name) ? getName($aComment->name) : ''}}</a><span> 
            @if(!empty($aComment->comment) && $aComment->comment == PRAYER) 
            <img src="{{ asset('images/prayer-icon.png') }}">
            @else 
            {{ !empty($aComment->comment) ? $aComment->comment : ''}}
            @endif
          </span></div>

          <div class="commenting-comments2">
           <a href="javascript:void(0)" onclick="likeComment({{ $aComment->id }}, {{ $aComment->insprational_feed_id}})">Like</a>
           <a href="javascript:void(0)" onclick="replyOnComment({{$aComment->id}}, {{ $aComment->insprational_feed_id}})">Reply</a>
           <span id="commentLike{{ $aComment->id }}">
            <a href="javascript:void(0)"><img src="{{ asset('images/like-ico-blue.png') }}" alt="" data-pagespeed-url-hash="64196249" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> {{ getTotaLikeComment($aComment->id) > 0 ? getTotaLikeComment($aComment->id) : '' }}</a></span>
            <span>{{ !empty($aComment->created_at) ? date('d M Y', strtotime($aComment->created_at)) : ''}} at {{ !empty($aComment->created_at) ? date('H:i', strtotime($aComment->created_at)) : ''}}</span>
            @php
            /*--------------- called recursion function to show comment nested comment --------------------*/
            $aNestedCommentLists = getNestedComment($aComment->id);
            /*--------------- called recursion function to show comment nested comment --------------------*/
            @endphp
            @if($aNestedCommentLists && count($aNestedCommentLists) > 0)

            @foreach($aNestedCommentLists as $key => $aNestedComment) 
            @php
            $sUserName = !empty($aNestedComment->name) ? getName($aNestedComment->name) : '';
            $sComment = !empty($aNestedComment->comment) ? $aNestedComment->comment : '';
            $sDate = !empty($aNestedComment->created_at) ? date('d M Y', strtotime($aNestedComment->created_at)) : '';
            $sTime = !empty($aNestedComment->created_at) ? date('H:i', strtotime($aNestedComment->created_at)) : '';

            $icommentId = !empty($aNestedComment->id) ? $aNestedComment->id : '';
            $ipostId = !empty($aNestedComment->insprational_feed_id) ? $aNestedComment->insprational_feed_id : '';
            @endphp 
            <div class="newsfeed-usercoments mt-3">
              <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)"><img src="{{ !empty($aNestedComment->profile_pic) ? asset('images/profile/'.$aNestedComment->profile_pic) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="2808585493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
              <div class="newsfeed-commenting-comments">
                <div class="commenting-comments2"><a href="javascript:void(0)"> {{ $sUserName }} </a> <span> {{ $sComment }} </span></div>

                <div class="commenting-comments2">
                  <a href="javascript:void(0)" onclick="likeComment({{ $icommentId }} ,{{ $ipostId }})">Like</a>
                  <a href="javascript:void(0)" onclick="replyOnComment({{ $icommentId }} ,{{ $ipostId }})">Reply</a>
                  <span id="commentLike{{$icommentId}}"><a href="javascript:void(0)"><img src="{{ asset('images/like-ico-blue.png') }}" alt="" data-pagespeed-url-hash="64196249" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> {{ getTotaLikeComment($aNestedComment->id) > 0 ? getTotaLikeComment($aNestedComment->id) : '' }} </a></span></span>
                  <span> {{$sDate}} at {{$sTime}}</span>
                  {!! html_entity_decode(getReplyNestedComment($aNestedComment->id)) !!}
                </div>    
              </div>  
            </div>

            @endforeach
            @endif

          </div>

          {{-- <div class="newsfeed-commenting-rply">
           <div class="rplyicon"><a href="javascript:void(0)"><img src="images/reply-icon.png" alt="" data-pagespeed-url-hash="2931494377" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> 1 Reply</a></div>
         </div>    --}}

       </div>
     </div><!--newsfeed-usercoments-->   
     @endforeach
     @endif
   </div>
   {{-- <div class="newsfeed-usercoments">
     <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)"><img src="images/user-2.jpg" alt="" data-pagespeed-url-hash="2808585493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
     <div class="newsfeed-commenting-comments">
      <div class="commenting-comments1"><a href="javascript:void(0)">Sophia Holden</a> <a href="javascript:void(0)">Angie Walters</a></div>

      <div class="commenting-comments2">
       <a href="javascript:void(0)">Like</a>
       <a href="javascript:void(0)">Reply</a>
       <span> March 21 at 4:34pm</span>
     </div>    
   </div>
 </div><!--newsfeed-usercoments-->   --}}
 <div id="commentSection{{$aInspirational->id}}" style="display: none">
  <input type="hidden" id="postId{{$aInspirational->id}}" name="postId" value="{{$aInspirational->id}}">
  <input type="hidden" id="parentId{{$aInspirational->id}}" name="parentId" value="">
  <div class="feednew-comment">
    <div class="exis-userpic"><img src="{{ !empty($sLoggedInUserProfileImage) ? asset('images/profile/'.$sLoggedInUserProfileImage) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
    <div class="feed-usercomment"><input type="text" onkeyup="isNeedToEnableOrDisabledComment({{$aInspirational->id}},this.value)" id="comment{{$aInspirational->id}}" name="comment" placeholder="Write a comment..." class="form-control">
    </div>
  </div>
  <div>
    <button class="btn btn-primary pull-right" onclick="submitComment({{$aInspirational->id}},'comment')" id="commentBtn{{$aInspirational->id}}" disabled>Comment</button>
  </div>  
</div>
</div><!--feed-comment-main-->           
</div>
@endforeach
@endif
<script>
 /*--------------------- comment section ------------------*/
 function likeComment(iCommentId,iPostId) {
   let parentId = $(`#parentId${iPostId}`).val();
   $.ajax({
     url:sBASEURL+"likeComment",
     type:"POST",
     data:{iPostId,iCommentId,parentId,"_token":"{{ csrf_token() }}"},
     success:function(response){
       let result = JSON.parse(response);
       if(result.status == 'success') {
         $(`#commentLike${iCommentId} a`).html(`${result.iTotalCommentLikes}`);
       }
     }
   });
 }
 function replyOnComment(iCommentId,iPostId) {
  $(`#commentSection${iPostId}`).show();
  $(`#postId${iPostId}`).val(iPostId);
  $(`#parentId${iPostId}`).val(iCommentId);
}
function submitComment(iPostId,sType) {
 let postId = '';
 let comment = ''; 
 if(sType && sType!='prayer') {
  postId = $(`#postId${iPostId}`).val();
  comment = $(`#comment${iPostId}`).val();
} else {
  postId  = iPostId;
  comment = sType;
}
let parentId = $(`#parentId${iPostId}`).val();
$.ajax({
 url:sBASEURL+"commentOnPost",
 type:"POST",
 data:{postId,comment,parentId,"_token":"{{ csrf_token() }}"},
 success:function(response){
   let result = JSON.parse(response);
   if(result.status == 'success') {
    $(`#postId${iPostId}`).val('');
    $(`#comment${iPostId}`).val('');
    $(`#parentId${iPostId}`).val('')
    $(`#commentSectionIndividualPost${iPostId}`).html(`${result.sOutput}`);
    $(`#commentSectionIndividualPost${iPostId} #totalcomment`).html(`${result.iTotalComment}`);
  }
}
});
}
function commentOnPost(iUserId,iPostId) {
  $(`#commentSection${iPostId}`).show();
}
function isNeedToEnableOrDisabledComment(iPostId,sValue) {
  if(sValue!='' && sValue!=undefined && sValue!=null) {
   $(`#commentBtn${iPostId}`).removeAttr('disabled');
 } else {
   $(`#commentBtn${iPostId}`).attr('disabled','disabled');
 }
}
/*--------------------- comment section ------------------*/
function likePost(iUserId,iPostId) {
 if(iUserId && iPostId) {
   $.ajax({
     url:sBASEURL+"likePost",
     type:"POST",
     data:{iUserId,iPostId,"_token":"{{ csrf_token() }}"},
     success:function(response){
       let result = JSON.parse(response);
       if(result.status == 'success') {
        $('.success').show();
        $('.success').toast('show');
        $('.success .toast-body').html(`${result.msg}`);
        $(`#inspirationTestimonyOrPost${iPostId} #totallike`).html(`${result.iTotalLikes}`);
      } else {
        $('.failure').show();
        $('.failure').toast('show');
        $('.failure .toast-body').html(`${result.msg}`);
      }
    }
  });
 }
 return false;
}
function sharePostOnTimeLine(iUserId,iPostId) {
 if(iUserId && iPostId) {
   $.ajax({
     url:sBASEURL+"sharePostOnTimeLine",
     type:"POST",
     data:{iUserId,iPostId,"_token":"{{ csrf_token() }}"},
     success:function(response){
       let result = JSON.parse(response);
       if(result.status == 'success') {
        $('.success').show();
        $('.success').toast('show');
        $('.success .toast-body').html(`${result.msg}`);
        $(`#inspirationTestimonyOrPost${iPostId} #totalshares`).html(`${result.iTotalShares}`);
      } else {
        $('.failure').show();
        $('.failure').toast('show');
        $('.failure .toast-body').html(`${result.msg}`);
      }
    }
  });
 }
 return false;
}
</script>
{{-- <div class="newsfeed-sec">

 <div class="newsfeed-tophead">     
  <div class="newsfeed-top-sec">
    <div class="news-userpic"><img src="images/newsuserpic-2.jpg" alt="" data-pagespeed-url-hash="297758938" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
    <div class="newsfeed-text"><h3>Bloomberg <span><img src="images/verified.png" alt="" data-pagespeed-url-hash="3749702213" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span></h3> <p>March 21 at 2:29pm</p></div>
  </div>

  <div class="newsfeed-arrow">
   <div class="dropdown">
    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
      <img src="images/event-arrow-icon.png" alt="" data-pagespeed-url-hash="603205129" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
    </button>
    <div class="dropdown-menu">
     <a class="dropdown-item" href="javascript:void(0)"><i class="las la-eye-slash"></i> Hide</a>
     <a class="dropdown-item" href="javascript:void(0)"><i class="las la-flag"></i> Report</a>
   </div>
 </div>
</div>

</div><!--newsfeed-tophead-->  

<div class="newsfeed-desc"><p>The tiny Caribbean paradise is now at the center of the biggest data leak in history. It’s a real-world Treasure Island, a tiny Caribbean paradise that, on paper, is home to nearly half a million companies.</p></div>


<div class="newsfeed-mainpic"><img src="images/newsfeed-pic-2.jpg" alt="" data-pagespeed-url-hash="984524616" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>

<div class="newsfeed-licosh-col">
 <div class="feednewlikes"><a href="javascript:void(0)"><img src="images/like-ico.png" alt="" data-pagespeed-url-hash="1279223300" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Like</span></a> </div>
 <div class="feednewcomment"><a href="javascript:void(0)"><img src="images/comment-ico.png" alt="" data-pagespeed-url-hash="1033231412" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Comments</span></a> </div>
 <div class="feednewprayer"><a href="javascript:void(0)"><img src="images/prayer-icon.png" alt="" data-pagespeed-url-hash="3948427328" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Prayer</span></a> </div>
 <div class="feednewshare"><a href="javascript:void(0)"><img src="images/post-share-ico.png" alt="" data-pagespeed-url-hash="4226147923" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">  <span>Shares</span></a> </div>   
</div>

<div class="feed-maincomment-sec">

 <div class="newsfeed-liked-col">
  <div class="row align-items-center">
   <div class="col-6"><div class="totalshares">195 shares </div></div>
   <div class="col-6 text-right"><div class="totalcomenshare">102 comments </div></div>
 </div>
</div>       

<div class="feednew-comment">
  <div class="exis-userpic"><img src="images/newsuserpic.png" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
  <div class="feed-usercomment"><input type="text" name="comment" placeholder="Write a comment..." class="form-control">
  </div>
</div>

</div><!--feed-comment-main-->     


</div> --}}

</div>  


</div><!--col-md-7-->


<div class="col-md-5 custom-5">
  <div class="social-group-sec white-box">
    <div class="social-head">
      <img src="{{ asset('images/social-group-ico.png') }}" alt="" data-pagespeed-url-hash="1056036" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
      <h3>Group <span>Suggetd for you</span></h3>  
    </div> 

    <div class="social-group-btn"><div class="view-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#creategrupmodal"><i class="las la-plus"></i> Create New Group</a></div></div>

    <div class="asidegroups-list">
      <div class="aside-groups-subtitle">Groups you've joined</div>
      <div class="inner-asidegroups-list" id="groupsJoinedOrCreated"> 
        @if(!empty($aGroupLists))
        @foreach($aGroupLists as $aGroup)
        @php
        $sCreatedDateTime = !empty($aGroup->created_at) ? $aGroup->created_at : '';
        /*--------------- get current local Date Time from UTC ---------------*/
        $sCurrentDate = getCurrentLocalDateTime();
        /*--------------- get current local Date Time from UTC ---------------*/

        $first_date = !empty($sCreatedDateTime) ? new DateTime($sCreatedDateTime) : "";
        $second_date = !empty($sCurrentDate) ? new DateTime($sCurrentDate) : "";
        $difference = !empty($first_date) && !empty($second_date) ? $first_date->diff($second_date) : "";
        $sPosted     = !empty($difference) ? format_interval($difference) : "";                  
        @endphp
        <div class="aside-groups-col">
          <a href="{{url('group-detail/'.$aGroup->id)}}">
            <div class="aside-groups-pic"><img src="{{ asset('public/images/groups/'.$aGroup->image) }}" alt="" data-pagespeed-url-hash="624115584" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
            <div class="aside-groups-title">{{ !empty($aGroup->name) ? $aGroup->name : ''}} <span class="event-post-time">Last active &bull; {{ $sPosted }}</span></div>
          </a>
        </div>
        @endforeach
        <div class="common-box"><a href="{{ url('groups-list') }}" class="smallcommon-btn">View All</a></div>
        @endif

      </div>   
    </div>

  </div><!--social-group-sec-->


  @if($aEventsList && count($aEventsList) > 0) 
  <div class="social-event-sec white-box">
    <div class="social-head">
      <i class="las la-calendar-check"></i>
      <h3>Discover events</h3>  
    </div>
    <div class="social-group-btn"><div class="view-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#createeventmodal"><i class="las la-plus"></i> Create New Event</a></div></div>
    @foreach ($aEventsList as $aEvent)
    @php
    /*-------------------------- check user is hide event or raise against report ---------------*/
    $isHideOrReport = !empty($aEvent->id) ? isEventHideOrReportedByUser($iUserId, $aEvent->id) : '';
    if($isHideOrReport > 0) {
     continue;
   }
   /*-------------------------- check user is hide event or raise against report ---------------*/

   $sCreatedDateTime = !empty($aEvent->created_at) ? $aEvent->created_at : '';
   /*--------------- get current local Date Time from UTC ---------------*/
   $sCurrentDate = getCurrentLocalDateTime();
   /*--------------- get current local Date Time from UTC ---------------*/

   $first_date = !empty($sCreatedDateTime) ? new DateTime($sCreatedDateTime) : "";
   $second_date = !empty($sCurrentDate) ? new DateTime($sCurrentDate) : "";
   $difference = !empty($first_date) && !empty($second_date) ? $first_date->diff($second_date) : "";
   $sPosted     = !empty($difference) ? format_interval($difference) : "";   

   $sCreatedAtTimeStap =  !empty($aEvent->created_at) ? (int) strtotime($aEvent->created_at) : '';

   /*---------------------- get total users interested in events -----------------------*/
   $iTotalUsersInterested = !empty($aEvent->id) ? getTotalUsersInterestedInEvents($aEvent->id) : '';
   /*---------------------- get total users interested in events -----------------------*/

   //echo gettype($sCreatedAtTimeStap);die;
   @endphp
   <div class="events" id="event{{$aEvent->id}}">
    <div class="social-event-head">
      <div class="event-user"><img src="{{ asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="2771137919" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
      <div class="event-title"><span>{{!empty($aEvent->name) ? $aEvent->name : ''}}</span> <span class="event-post-time">{{$sPosted}} <img src="{{ asset('images/event-dot.jpg') }}" alt="" data-pagespeed-url-hash="3392945715" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span></div>

      <div class="events-arrow">
       <div class="dropdown">
        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset('images/event-arrow-icon.png') }}" alt="" data-pagespeed-url-hash="603205129" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
        </button>
        <div class="dropdown-menu">
         <a class="dropdown-item" href="javascript:void(0)" onclick="hideEventOrReport({{ $aEvent->id }},'hide')"><i class="las la-eye-slash"></i> Hide</a>
         <a class="dropdown-item" href="javascript:void(0)" onclick="hideEventOrReport({{ $aEvent->id }},'report')"><i class="las la-flag"></i> Report</a>
       </div>
     </div>
   </div>  

 </div>

 <div class="social-event-col"><a href="{{ url('event-detail/'.$aEvent->id) }}">
  <div class="social-event-main"><img src="{{ asset('public/images/events/'.$aEvent->image) }}" class="img-responsive" alt="" data-pagespeed-url-hash="857254988" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>

  <div class="social-event-details">

   <div class="eventmain-time">{{!empty($aEvent->created_at) ? date('d', $sCreatedAtTimeStap) : ''}} <span>{{!empty($aEvent->created_at) ? date('M', $sCreatedAtTimeStap) : ''}}</span></div>
   <div class="event-maintitle">
    {{-- <h3>Winter Career Expo</h3> --}}
    <h4>{{ !empty($aEvent->long_description) && Str::length($aEvent->long_description) > 50 ? Str::substr($aEvent->long_description, 0, 50).'...' : $aEvent->long_description  }}</h4>
    <p>{{ !empty($iTotalUsersInterested) ? $iTotalUsersInterested.' People are interested' : ''}}</p>
  </div>
  <div class="events-maincalender"><img src="{{ asset('images/calender-icon.png') }}" alt="" data-pagespeed-url-hash="4013489801" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>    

</div>  
</a>
<div class="social-event-share"><a href="javascript:void(0)">
  <a class="a2a_dd" href="https://www.addtoany.com/share">
    {{-- <i class="fa fa-share-alt" aria-hidden="true"></i> --}}
    <img src="{{ asset('images/share-icon.png') }}" alt="" data-pagespeed-url-hash="323690004" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Share
  </a>


  {{-- {!!Share::page(url('inspirational-feed'), $aEvent->name,["class"=>"social","id"=>'EventShare_'.$aEvent->id])
  ->facebook()
  ->twitter()
  ->linkedin()
  ->whatsapp()
  ->telegram()
  ->reddit();
  !!}  --}}
</a></div>
</div>    


</div>
@endforeach
<div class="common-box"><a href="{{ url('events-list') }}" class="smallcommon-btn">View All</a></div>
</div><!--social-group-sec-->  
@endif

</div><!--col-md-5-->
</div>



</div>      
</div>
<script>
 $('#social-links ul li a').on('click', function() {
  let sId = $(this).attr('id');
  let aId = sId.split("_");
  let id =  aId[1];
  let siteName = '{{ SITE_NAME }}';
  let sURL     = '{{ BASE_URL }}';
  let sTitle = $(`#event${id} .event-title span:first`).text();
  let sImage = $(`#event${id} .social-event-main img`).attr('src');
  document.title = siteName+' | '+sTitle;
  $('meta[property="og:title"]').attr('content', sTitle);
  $('meta[property="og:image"]').attr('content', sImage);
  $('meta[property="og:url"]').attr('content', sURL+'event-detail/'+id);
});
</script>

<!----- create event modal start ----->  
<div class="modal fade common-modal" id="createeventmodal" tabindex="-1" role="dialog" aria-labelledby="createeventmodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="las la-times"></i></span>
      </button>
      <div class="modal-body p-0">
       <div class="login-wrapper">
         <div class="login-form-col">
          <h1>Create Event</h1>
          <form class="login-form" name="cform" id="group" onsubmit="return createEventIns();" method="post">
           @csrf
            <div class="form-group">
              <p class="contact-form-name">
               <input type="text" name="eventName" id="eventName" class="form-control" placeholder="Event Name">
             </p>
             <p class="formError eventNameError"></p>
           </div>
           <div class="form-group">
            <p class="contact-form-name">
              <input type="datetime-local" name="eventStartDateTime" id="eventStartDateTime" class="form-control" placeholder="Start Date">
           </p>
           <p class="formError eventStartDateTime"></p>
         </div>
         <div class="form-group">
          <p class="contact-form-email">
            <select class="form-control" name="eventPrivacy" id="eventPrivacy">
              <option value="">Choose Privacy </option>
              <option value="6">Public</option>
              <option value="5">Private</option>
            </select>
          </p>
          <p class="formError eventPrivacy"></p>
        </div>
        <div class="form-group">
          <p class="contact-form-name">
           <input type="text" name="eventLocation" id="eventLocation" class="form-control" placeholder="Location">
         </p>
         <p class="formError eventLocation"></p>
       </div>
       <div class="form-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="eventFile" id="eventFile">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <p class="formError eventFile"></p>
      </div>
      <div class="form-group">
        <textarea class="form-control" name="eventDescription" id="eventDescription" placeholder="Description (Optional)" rows="2"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="btnEventSubmit" class="common-btn w-100" id="quote-submit" value="Create Now"> 
      </div>
    </form>   
  </div>
  </div>
</div>
</div>
</div>
</div>
</div>
<!----- create event modal start ----->  


<!----- group modal start ----->	

<div class="modal fade common-modal" id="creategrupmodal" tabindex="-1" role="dialog" aria-labelledby="creategrupmodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="las la-times"></i></span>
      </button>

      <div class="modal-body p-0">
       <div class="login-wrapper">
         <div class="login-form-col">

          <h1>Create Group</h1>

          <form class="login-form" name="cform" id="group" onsubmit="return createGroup()"  method="post">
           @csrf
           <div class="form-group">
            <p class="contact-form-name">
              <input type="text" name="groupName" id="groupName" class="form-control" placeholder="Group Name">

            </p>
            <p class="formError groupName"></p>
          </div>

          <div class="form-group">
            <p class="contact-form-email">
              <select class="form-control" name="privacyType" id="privacyType">
                <option value="">Choose Privacy </option>
                <option value="{{PUBLIC_GROUP_TYPE}}">Public</option>
                <option value="{{PRIVATE_GROUP_TYPE}}">Private</option>
              </select>
            </p>
            <p class="formError privacyType"></p>
          </div>

          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="image" id="image" accept="image/png, image/jpg, image/jpeg">
              <label class="custom-file-label" for="image">Choose file</label>
              <p class="formError image"></p>
            </div>
          </div>

          <div class="form-group">
            <textarea class="form-control" id="description" name="description" placeholder="Description (Optional)" rows="2"></textarea>
          </div>

          <div class="form-group createGroupBtn">
            <input type="submit" name="submit" class="common-btn w-100" id="quote-submit" value="Create Now"> 
          </div>

        </form>   

      </div>
    </div>
  </div>

</div>
</div>
</div>
<!----- group modal end ----->

<!----live modal---->

<div class="modal fade common-modal" id="postlivemodal" tabindex="-1" role="dialog" aria-labelledby="postlivemodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="las la-times"></i></span>
      </button>

      <div class="modal-body p-0">
       <div class="login-wrapper">
         <div class="login-form-col">

          <h1>Create Testimony</h1>
          <p></p>
          <form id="inspirationalFeedCreateTestimony" onsubmit="return submitCreateTestimonyInspirationalFeed()">
            @csrf
            <div class="user-postmedia-head">    
              <div class="user-pic"><a href="javascript:void(0)"><img src="{{ !empty($sLoggedInUserProfileImage) ? asset('images/profile/'.$sLoggedInUserProfileImage) : asset('images/avtar1.png') }}" width="40px" alt="" data-pagespeed-url-hash="399097396" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>
              <div class="user-input"><input type="text" name="whats_on_your_mind" id="whats_on_your_mind" class="activity-input" placeholder="What’s on your mind?">
               <p class="formError whats_on_your_mind"></p>
             </div>
             <input type="file" accept="video/*" name="testimony_videos" id="testimony_videos" style="display: none;" />
             <input type="hidden" name="feeling_id_testimony" id="feeling_id_testimony">
             <input type="hidden" name="activity_id_testimony" id="activity_id_testimony">
           </div>    

           <div class="postlive-popcol">
            <video autoplay="true" id="videoElement" class="w-100"></video>
          </div>

          <div class="testimonypostadd-icons">
           <div class="testimonypostadd-camera">
             <a href="javascript:void(0)" onclick="document.getElementById('testimony_videos').click();"><img src="{{ asset('images/camera-3Dicon.png') }}" alt="" data-pagespeed-url-hash="141198199" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Browse Testimony video</a>   
           </div>

           <div class="testimonypostadd-emoji"><a href="javascript:void(0)" data-toggle="modal" data-target="#postfeelingmodal" title="Feeling /Activity"><img src="{{ asset('images/smiley-3Dicon.png') }}" alt="" data-pagespeed-url-hash="1141578551" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>

         </div>    

         <div class="common-box">
          <button type="submit" class="common-btn w-100">Upload Testimony</button>
        </div>   
      </form>
    </div>
  </div>
</div>

</div>
</div>
</div>  


<!----activity modal---->

<div class="modal fade common-modal" id="postfeelingmodal" tabindex="-1" role="dialog" aria-labelledby="postfeelingmodalTitle" aria-hidden="true" style="z-index: 99999">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="las la-times"></i></span>
      </button>

      <div class="modal-body p-0">
       <div class="login-wrapper">
         <div class="login-form-col">

          <h1>How are you feeling?</h1>

          <div class="post-feeling-col">
           <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Feelings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Activities</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="postfeeling-inner">
                <form class="search-form" name="cform" method="post">
                  <div class="form-group mb-0">
                    <input type="text" class="form-control" name="feeling_search" id="feeling_search" placeholder="Search...">
                    {{-- <p class="formError feeling_search"></p> --}}
                  </div>
                  {{-- <button type="button" id="btnFeelingSearch" class="search-ico"><i class="las la-search"></i></button>	 --}}
                </form>

                <div class="postfeeling-list">
                  <ul>  
                    @if($aFeelingLists && count($aFeelingLists) > 0)
                    @foreach ($aFeelingLists as $aFeeling)
                    <li><a href="javascript:void(0)" onclick="showFeelingAndActivity('{{$aFeeling->name}}','{{asset($aFeeling->image)}}',{{ $aFeeling->id }},'')"><span class="feelsmilyicon"><img src="{{ asset($aFeeling->image)}}" alt="" data-pagespeed-url-hash="1699137061" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span> <span class="feelsmilytxt">{{$aFeeling->name}}</span></a></li>   
                    @endforeach 
                    @endif
                  </ul>
                </div>    

              </div> 
            </div><!--tab1--> 

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="postfeeling-inner2">
                <form class="search-form" name="cform" method="post">
                  <div class="form-group mb-0">
                    <input type="text" class="form-control" name="activity_search" id="activity_search" placeholder="Search...">
                    {{-- <p class="formError activity_search"></p> --}}
                  </div>
                  {{-- <button type="button" id="btnActivitySearch" class="search-ico"><i class="las la-search"></i></button>	 --}}
                </form>

                <div class="postfeeling-list2">
                  <ul>  
                    @if($aActivityLists && count($aActivityLists) > 0)
                    @foreach ($aActivityLists as $aActivity)
                    <li><a href="javascript:void(0)" onclick="showFeelingAndActivity('{{$aActivity->name}}','{{asset($aActivity->image)}}','',{{ $aActivity->id }})"><span class="feelsmilyicon"><img src="{{ asset($aActivity->image) }}" alt="" data-pagespeed-url-hash="1592760396" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span> <span class="feelsmilytxt">{{ $aActivity->name }}</span> <i class="las la-angle-right"></i></a></li>
                    @endforeach 
                    @endif 
                  </ul> 

                </div>      

              </div>
            </div><!--tab2-->    
          </div>    
        </div>    

        {{-- <div class="common-box"><a href="javascript:void(0)" class="common-btn w-100">Post</a></div>    --}}

      </div>
    </div>
  </div>

</div>
</div>
</div>      
<script>
  /*------------------ click on feeling on activity or feeling ---------------*/
  $('#pills-home-tab').on('click',function() {
    $('#postfeelingmodal .login-form-col h1').text(`How are you feeling?`);
  });
  $('#pills-profile-tab').on('click',function() {
    $('#postfeelingmodal .login-form-col h1').text(`What are you doing?`);
  });
  /*------------------ click on feeling on activity or feeling ---------------*/

  /*------------------ onclick feeling or activity -----------------*/
  function showFeelingAndActivity(sFeelingOrActivity,sImage,iFeelingId,iActivityId) {
   let sLoggedInUserName = $('#sLoggedInUserName').val();
   if($('#postmediamodal').attr('aria-modal')) {
    $('#postmediamodal #feeling_id_post').val(iFeelingId);
    $('#postmediamodal #activity_id_post').val(iActivityId);
    $('#postmediamodal .login-form-col p:first').html(`${sLoggedInUserName} is <span class="feelsmilyicon" style="width: 34px;height: 34px;border: 1px solid #adc8cf;padding: 6px;border-radius: 50%;background: #E5F9FE;line-height: 19px;margin-right: 8px;"><img src="${sImage}"></span> ${iFeelingId!='' && iFeelingId!=null && iFeelingId!=undefined ? 'feeling' : '' } ${sFeelingOrActivity}`);
    $('#postfeelingmodal .la-times').click();
  }
  if($('#postlivemodal').attr('aria-modal')) {
    $('#postlivemodal #feeling_id_testimony').val(iFeelingId);
    $('#postlivemodal #activity_id_testimony').val(iActivityId);
    $('#postlivemodal .login-form-col p:first').html(`${sLoggedInUserName} is <span class="feelsmilyicon" style="width: 34px;height: 34px;border: 1px solid #adc8cf;padding: 6px;border-radius: 50%;background: #E5F9FE;line-height: 19px;margin-right: 8px;"><img src="${sImage}"></span> ${iFeelingId!='' && iFeelingId!=null && iFeelingId!=undefined ? 'feeling' : '' } ${sFeelingOrActivity}`);
    $('#postfeelingmodal .la-times').click();
  }

  if(!$('#postmediamodal').attr('aria-modal') && !$('#postlivemodal').attr('aria-modal')) {
    $('#postmediamodal .login-form-col p:first').html(`${sLoggedInUserName} is <span class="feelsmilyicon" style="width: 34px;height: 34px;border: 1px solid #adc8cf;padding: 6px;border-radius: 50%;background: #E5F9FE;line-height: 19px;margin-right: 8px;"><img src="${sImage}"></span> ${iFeelingId!='' && iFeelingId!=null && iFeelingId!=undefined ? 'feeling' : '' } ${sFeelingOrActivity}`);
    $('.postmediamodal').click();
    $('#postmediamodal #feeling_id_post').val(iFeelingId);
    $('#postmediamodal #activity_id_post').val(iActivityId);
    $('#postfeelingmodal .la-times').click();
  }

}
/*------------------ onclick feeling or activity -----------------*/

/*-------------------- search feelings --------------------------*/
$('#feeling_search').on('keyup', function() {
  let feeling_search = $(this).val();
  $.ajax({
    url:sBASEURL+"fellingSearch",
    type:"POST",
    data:{feeling_search,"_token":"{{ csrf_token() }}"},
    success:function(response) {
      let result = JSON.parse(response);
      $('.postfeeling-list ul').html(`${result.sOutput}`);

    }
  });
});
/*-------------------- search feelings --------------------------*/

/*-------------------- search activity --------------------------*/
$('#activity_search').on('keyup', function() {
  let activity_search = $(this).val();
  $.ajax({
    url:sBASEURL+"activitySearch",
    type:"POST",
    data:{activity_search,"_token":"{{ csrf_token() }}"},
    success:function(response) {
      let result = JSON.parse(response);
      $('.postfeeling-list2 ul').html(`${result.sOutput}`);

    }
  });
});
/*-------------------- search activity --------------------------*/
</script>

<!----post modal---->

<div class="modal fade common-modal" id="postmediamodal" tabindex="-1" role="dialog" aria-labelledby="postmediamodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="las la-times"></i></span>
      </button>

      <div class="modal-body p-0">
       <div class="login-wrapper">
         <div class="login-form-col">

          <h1>Create Post</h1>
          <p></p>
          <form class="itemcreation-form" onsubmit="return submitCreatePostInspirationalFeed()" name="cform" id="inspirationalFeedCreatePost" method="post">
            @csrf
            <div class="postmedia-popcol">
              <div class="user-postmedia-head">    
                <div class="user-pic"><a href="javascript:void(0)"><img width="40px" src="{{ !empty($sLoggedInUserProfileImage) ? asset('images/profile/'.$sLoggedInUserProfileImage) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="399097396" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>
                <div class="user-input"><input type="text" class="activity-input" id="whats_on_your_mind_post" name="whats_on_your_mind_post" placeholder="What’s on your mind?">
                  <p class="formError whats_on_your_mind_post"></p>
                </div>    
              </div>

              <div class="postmedia-inner">

               <div class="file-loading">
                 <input id="file-1" type="file" accept="image/jpg, image/png, image/jpeg" name="file" class="file" data-overwrite-initial="false" data-min-file-count="2">
               </div>					
             </div>    
           </div>

           <div class="postadd-icons">
            <div class="postadd-txt">Add to your post</div>
            <div class="postadd-emoji">
             <a href="javascript:void(0)" title=""><img src="{{ asset('images/camera-3Dicon.png') }}" alt="" data-pagespeed-url-hash="141198199" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Upload Photos</a>
             <a href="javascript:void(0)" data-toggle="modal" data-target="#postfeelingmodal" title="Feeling /Activity"><img src="{{ asset('images/smiley-3Dicon.png') }}" alt="" data-pagespeed-url-hash="1141578551" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>   
           </div>    
         </div>    
         <input type="hidden" name="feeling_id_post" id="feeling_id_post">
         <input type="hidden" name="activity_id_post" id="activity_id_post">
         <div class="common-box">
          <button type="submit" class="common-btn w-100">Post Now</button>
        </div>   
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script>
  /*--------------------------- create inspirational feed testimony ---------------------*/
  let whats_on_your_mind_testimony_error = 0;
  function submitCreateTestimonyInspirationalFeed() {
    let whats_on_your_mind = $('#whats_on_your_mind').val();
    if(whats_on_your_mind == '' || whats_on_your_mind == undefined || whats_on_your_mind == null) {
     $('.whats_on_your_mind').html(`Whats on your mind is required`);
     whats_on_your_mind_testimony_error++;
   } else {
     $('.whats_on_your_mind').html(``);
     whats_on_your_mind_testimony_error=0;
   }
   if(whats_on_your_mind_testimony_error > 0) {
     return false;
   } else {
    var fd = new FormData(document.getElementById('inspirationalFeedCreateTestimony'));
    fd.append("label", "WEBUPLOAD");
    $.ajax({
      url: sBASEURL+"createInspirationalFeedTestimony",
      type: "POST",
      data: fd,
                processData: false,  // tell jQuery not to process the data
                contentType: false   // tell jQuery not to set contentType
              }).done(function( response ) {
                let result = JSON.parse(response);
                if(result.status == 'success') {
                  $('.success').show();
                  $('.success').toast('show');
                  $('.success .toast-body').html(`${result.msg}`);
                  $('#inspirationalFeedCreateTestimony')[0].reset();
                  $('#postlivemodal .la-times').click();
                  window.location.reload();
                } else {
                  $('.failure').show();
                  $('.failure').toast('show');
                  $('.failure .toast-body').html(`${result.msg}`);
                }
              });
              return false;
            }
          }
          /*--------------------------- create inspirational feed testimony ---------------------*/

          /*--------------------------- create inspirational feed post --------------------------*/
          $('.postmediamodal').on('click', function() {
           $(document).find('.file-drop-zone-title').text('Upload and preview image');
         });
          let whats_on_your_mind_post_error = 0;
          function submitCreatePostInspirationalFeed() {
            let whats_on_your_mind_post = $('#whats_on_your_mind_post').val();
            if(whats_on_your_mind_post == '' || whats_on_your_mind_post == undefined || whats_on_your_mind_post == null) {
             $('.whats_on_your_mind_post').html(`Whats on your mind is required`);
             whats_on_your_mind_post_error++;
           } else {
             $('.whats_on_your_mind_post').html(``);
             whats_on_your_mind_post_error=0;
           }
           if(whats_on_your_mind_post_error > 0) {
             return false;
           } else {
            var fd = new FormData(document.getElementById('inspirationalFeedCreatePost'));
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: sBASEURL+"createInspirationalFeedPost",
              type: "POST",
              data: fd,
                processData: false,  // tell jQuery not to process the data
                contentType: false   // tell jQuery not to set contentType
              }).done(function( response ) {
                let result = JSON.parse(response);
                if(result.status == 'success') {
                  $('.success').show();
                  $('.success').toast('show');
                  $('.success .toast-body').html(`${result.msg}`);
                  $('#inspirationalFeedCreatePost')[0].reset();
                  $('#postmediamodal .la-times').click();
                  window.location.reload();
                } else {
                  $('.failure').show();
                  $('.failure').toast('show');
                  $('.failure .toast-body').html(`${result.msg}`);
                }
              });
              return false;
            }
          }
          /*--------------------------- create inspirational feed post --------------------------*/
        </script>
        <script>
          /*---------------- hide or report post or testimony -----------------*/
          function hideInspirationalFeed(id,type) {
            let sMsg =  type && type == 'hide' ? 'Are you sure you want to hide this post?': 'Are you sure you want to report against this post?';
            let sConfirm = confirm(sMsg);
            if(sConfirm == true) {
              $.ajax({
                url:sBASEURL+"hideInspirationalFeed",
                type:"POST",
                data:{id,type,"_token":"{{ csrf_token() }}"},
                success:function(response) {
                  let result = JSON.parse(response);
                  if(result.status == 'success') {
                    $('.success').show();
                    $('.success').toast('show');
                    $('.success .toast-body').html(`${result.msg}`);
                    $(`.newsfeed-wrapper #inspirationTestimonyOrPost${id}`).remove();
                    let len =  $('.newsfeed-wrapper .inspirationTestimonyOrPost').length;
                    if(len == 0) {
                      $(`.newsfeed-wrapper`).hide();
                    }
                  } else {
                    $('.failure').show();
                    $('.failure').toast('show');
                    $('.failure .toast-body').html(`${result.msg}`);
                  }
                }
              });
            }
          }
          /*---------------- hide or report post or testimony -----------------*/

          /*---------------- hide or report post or testimony -----------------*/
          function hideEventOrReport(id,type) {
           let sMsg =  type && type == 'hide' ? 'Are you sure you want to hide this event?': 'Are you sure you want to report against this event?';
           let sConfirm = confirm(sMsg);
           if(sConfirm == true) {
            $.ajax({
             url:sBASEURL+"hideEventOrReport",
             type:"POST",
             data:{id,type,"_token":"{{ csrf_token() }}"},
             success:function(response) {
               let result = JSON.parse(response);
               if(result.status == 'success') {
                $('.success').show();
                $('.success').toast('show');
                $('.success .toast-body').html(`${result.msg}`);
                $(`.social-event-sec #event${id}`).remove();
                let len =  $('.social-event-sec .events').length;
                if(len == 0) {
                 $(`.social-event-sec`).hide();
               }
             } else {
              $('.failure').show();
              $('.failure').toast('show');
              $('.failure .toast-body').html(`${result.msg}`);
            }
          }
        });
          }
        } 
        /*---------------- hide or report post or testimony -----------------*/
      </script>
      <script>
        let groupNameError=0,privacyTypeError=0,imageError=0;
        function createGroup() {
          let groupName = $('#groupName').val();
          let privacyType = $('#privacyType').val();
          let image = $('#image').val();
          let description = $('#description').val();
          if(groupName=='' || groupName==undefined || groupName==null) {
           $('.groupName').html(`Group name is required`);
           groupNameError++;
         } else {
           $('.groupName').html(``);
           groupNameError = 0;
         }
         if(privacyType=='' || privacyType==undefined || privacyType==null) {
           $('.privacyType').html(`Group privacy is required`);
           privacyTypeError++;
         } else {
           $('.privacyType').html(``);
           privacyTypeError = 0;
         }
         if(image=='' || image==undefined || image==null) {
           $('.image').html(`Image is required`);
           imageError++;
         } else {
           $('.image').html(``);
           imageError = 0;
         }

         if(groupNameError > 0 || privacyTypeError > 0 || imageError > 0) {

           return false;
         } else {
          $('.createGroupBtn').html(`<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>`);

          var fd = new FormData(document.getElementById("group"));
          $.ajax({
            url: sBASEURL+"createGroup",
            type: "POST",
            data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
              console.log( data );
              let result = JSON.parse(data);
              if(result.status == 'success') {
                $('#group')[0].reset();
                $('#creategrupmodal').modal('hide');
                $('.success').show();
                $('.success').toast('show');
                $('.success .toast-body').html(`${result.msg}`);
                $('#groupsJoinedOrCreated').html(`${result.sOutput}`);
              } else {
                $('.failure').show();
                $('.failure').toast('show');
                $('.failure .toast-body').html(`${result.msg}`);
              }
              $('.createGroupBtn').html(`<input type="submit" name="submit" class="common-btn w-100" id="quote-submit" value="Create Now">`);
            });
            return false;
          }
        }
      </script>

      <script>
        let eventNameError=0,eventprivacyTypeError=0,eventimageError=0,eventStartDateTimeError=0;
        let eventLocationError=0;

        function createEventIns() {
          let eventName = $('#eventName').val();
          let eventStartDateTime = $("#eventStartDateTime").val();
          let eventPrivacy = $('#eventPrivacy').val();
          let eventLocation = $("#eventLocation").val();
          let eventFile = $('#eventFile').val();
          let eventDescription = $('#eventDescription').val();

          //event name
          if(eventName=='' || eventName==undefined || eventName==null) {
           $('.eventNameError').html('Event name is required');
           eventNameError++;
          } else {
           $('.eventNameError').html(``);
           eventNameError = 0;
          }

          //event start datetime
          if(eventStartDateTime=='' || eventStartDateTime==undefined || eventStartDateTime==null) {
           $('.eventStartDateTime').html('Event start date and time required');
           eventStartDateTimeError++;
          } else {
           $('.eventStartDateTime').html(``);
           eventStartDateTimeError = 0;
          }

          //event privacy
          if(eventPrivacy=='' || eventPrivacy==undefined || eventPrivacy==null) {
           $('.eventPrivacy').html(`Group privacy is required`);
           eventprivacyTypeError++;
          } else {
           $('.eventPrivacy').html(``);
           eventprivacyTypeError = 0;
          }
          
          //event location
          if(eventLocation=='' || eventLocation==undefined || eventLocation==null) {
           $('.eventLocation').html(`Event location is required`);
           eventLocationError++;
          } else {
           $('.eventLocation').html(``);
           eventLocationError = 0;
          }

          //event file
          if(eventFile=='' || eventFile==undefined || eventFile==null) {
           $('.eventFile').html(`Image is required`);
           eventimageError++;
          } else {
           $('.eventFile').html(``);
           eventimageError = 0;
          }

           if(eventNameError > 0 || eventStartDateTimeError > 0 || eventprivacyTypeError > 0 || eventLocationError > 0 || eventimageError > 0) {
             return false;
           } else {
            // $('.createGroupBtn').html(`<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>`);

            // var fd = new FormData(document.getElementById("group"));
            // $.ajax({
            //   url: sBASEURL+"createGroup",
            //   type: "POST",
            //   data: fd,
            //     processData: false,  // tell jQuery not to process the data
            //     contentType: false   // tell jQuery not to set contentType
            //   }).done(function( data ) {
            //     console.log( data );
            //     let result = JSON.parse(data);
            //     if(result.status == 'success') {
            //       $('#group')[0].reset();
            //       $('#creategrupmodal').modal('hide');
            //       $('.success').show();
            //       $('.success').toast('show');
            //       $('.success .toast-body').html(`${result.msg}`);
            //       $('#groupsJoinedOrCreated').html(`${result.sOutput}`);
            //     } else {
            //       $('.failure').show();
            //       $('.failure').toast('show');
            //       $('.failure .toast-body').html(`${result.msg}`);
            //     }
            //     $('.createGroupBtn').html(`<input type="submit" name="submit" class="common-btn w-100" id="quote-submit" value="Create Now">`);
            //   });
            //   return false;
          }
        }
      </script>

      @endsection