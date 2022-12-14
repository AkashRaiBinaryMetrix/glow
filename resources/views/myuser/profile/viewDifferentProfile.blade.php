@extends('myuser.layouts.view')
@section('title', 'Register')
@section('content')
<style>
.feed-usercomment .form-control {
    width: 100% !important;
}
ul.ui-tabs-nav.ui-corner-all.ui-helper-reset.ui-helper-clearfix.ui-widget-header {
    background: none;
    border: none;
}
widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    border: none !important;
    background: none !important; 
}
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
    color: #02CBFE !important;
}
.ui-widget-content {
    border: none !important;
    background: none !important;
}
.profile-navs{
  margin-bottom: -19px !important;
  margin-left: -11px !important;
  margin-top: -20px !important;
}
li.pronav-item.ui-tabs-tab.ui-corner-top.ui-state-default.ui-tab.ui-tabs-active.ui-state-active {
    font-family: 'Poppins', sans-serif !important;
}
.ui-tabs .ui-tabs-nav .ui-tabs-anchor {
    padding: 0px !important;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#tabs_profile" ).tabs();
  } );
</script>
<div class="inner-page">
  <div class="container">
    <div class="userprofile-page">
     <div class="row">
        <div class="col-md-2">
            <div class="userprofile-col">
              <div class="userprofile-pic"><img src="{{ !empty($aLoggedInUserDetail->profile_pic) ? asset('images/profile/'.$aLoggedInUserDetail->profile_pic) : '' }}" alt="" data-pagespeed-url-hash="3548533874" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
            </div>
         </div>
         <script>
             $('#profilePic').on('change', function() {
                 $('#profilePicUpload').submit();
             });
         </script>
        <div class="col-md-10">
          <div class="profile-right-sec">
            <div class="profile-top-head">
              <div class="profile-name-top"><h1>{{$userName}}
                <!-- <span class="profile-txdate">June 15, 1989</span> -->
              </h1></div>

              @php
                $results = DB::select( DB::raw("SELECT * FROM follow_following WHERE following_user_id = :var1 and followed_by_user_by = :var2"), array(
                    'var1' => $view_profile_userid,
                    'var2' => $logged_in_userid,
                ));
              @endphp

              @if(count($results) == 0)
              <div class="profile-edit-top">
                   <a href="#" onclick="button_follow({{$view_profile_userid}},{{$logged_in_userid}});"><i class="las la-user-plus"></i> Follow</a> 
              </div>
              @else
                <div class="profile-edit-top">
                   <a href="#" onclick="button_unfollow({{$view_profile_userid}},{{$logged_in_userid}});"><i class="las la-user-minus"></i> Un-Follow</a> 
              </div>
              @endif 
              <!-- <div class="profile-edit-top"><a href="javascript:void(0)"><img src="{{ asset('images/follow-ico-blue.png') }}" alt="" data-pagespeed-url-hash="1581428935" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Follow</a></div>  -->   
            </div><!--profile-top-head-->
            <div class="profile-main-right">
              <div class="row" style="margin-left: -31px;margin-top: 7px;">
                <div class="col-md-12">
                  <div class="container">                  
                    <div class="tab-content">
                      <div id="tabs_profile">
                        <div class="profile-navs">
                          <ul class="pronavbar-nav">
                            <li class="pronav-item"><a href="#tabs-1-diff">Profile</a></li>
                            <li class="pronav-item"><a href="#tabs-2-diff">About</a></li>
                            <li class="pronav-item"><a href="#tabs-3-diff">Followers</a></li>
                            <li class="pronav-item"><a href="#tabs-4-diff">Following</a></li>
                            <li class="pronav-item"><a href="#tabs-5-diff">Photo</a></li>
                            <li class="pronav-item"><a href="#tabs-6-diff">Testimony</a></li>
                          </ul>
                        </div>
                        <div id="tabs-1-diff">
                          <div class="row">
                          <div class="col-md-6 profile-custome-5">
                            <div class="profile-pstabout profile-whitebox">
                              <div class="profile-white-head">About</div> 
                              <div class="post-about-para">{{$about_line}}</div>
                              <div class="profile-pst-short">
                                <p><i class="las la-home"></i> Lives in <a href="javascript:void(0)">{{$livesin_line}}</a></p>
                                <p><i class="las la-map-marker"></i> From <a href="javascript:void(0)">{{$from_line}}</a></p>  
                                <p><i class="las la-clock"></i> Joined on {{$joinedOn}}</p>
                                <p><i class="las la-birthday-cake"></i> Born in {{$dob_line}}</p>
                                <p><i class="las la-rss"></i> Followed by <a href="javascript:void(0)">0 people</a></p>    
                              </div>   
                            </div>
                          </div>
                           <div class="col-md-6 profile-custome-7">
                            <div class="profile-main-righside">
                              <!--Timeline setup start-->
                              @php

$iUserId  = getLoggedInUserId();

$sLoggedInUserProfileImage = getValueByColumnNameAndId('users','id',$iUserId,'profile_pic');

@endphp




    @include('admin.layouts.session_message')
      <div class="row">

      <div class="">

        <input type="hidden" id="sLoggedInUserName" value="{{ getLoggedInUserName() }}"/>

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

             is <span class="feelsmilyicon" style="width: 34px;height: 34px;border: 1px solid #adc8cf;padding: 6px;border-radius: 50%;background: #E5F9FE;line-height: 19px;margin-right: 8px;"><img src="{{ asset($aFeelingOrActityDetail->image) }}"></span> {{ $aFeelingOrActityDetail->name }}

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

     @if(!empty($aInspirational->photo) && empty($aInspirational->user_profile_photo_upload_id))

     <div class="newsfeed-mainpic"><img src="{{ asset('images/inspirational_feed/'.$aInspirational->photo) }}" alt="" data-pagespeed-url-hash="943057311" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>

     @elseif (!empty($aInspirational->photo) && !empty($aInspirational->user_profile_photo_upload_id))

     <div class="newsfeed-mainpic"><img src="{{ asset('images/userphotos/'.$aInspirational->photo) }}" alt="" data-pagespeed-url-hash="943057311" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>

     @elseif (!empty($aInspirational->videos) && empty($aInspirational->user_profile_video_upload_id))

     <div class="newsfeed-mainpic">

      <video width="100%" height="240" controls>

       <source src="{{ asset('videos/inspirational_feed/'.$aInspirational->videos) }}">

       </video>

     </div>

     @elseif (!empty($aInspirational->videos) && !empty($aInspirational->user_profile_video_upload_id))

     <div class="newsfeed-mainpic">

      <video width="100%" height="240" controls>

       <source src="{{ asset('images/uservideo/'.$aInspirational->videos) }}">

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






       </div>

     </div><!--newsfeed-usercoments-->   

     @endforeach

     @endif

   </div>

   

 <div id="commentSection{{$aInspirational->id}}" style="display: none">

  <input type="hidden" id="postId{{$aInspirational->id}}" name="postId" value="{{$aInspirational->id}}">

  <input type="hidden" id="parentId{{$aInspirational->id}}" name="parentId" value="">

  <div class="feednew-comment">

    <div class="exis-userpic"><img src="{{ !empty($sLoggedInUserProfileImage) ? asset('images/profile/'.$sLoggedInUserProfileImage) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>

    <div class="feed-usercomment"><input type="text" onkeyup="isNeedToEnableOrDisabledComment({{$aInspirational->id}},this.value)" id="comment{{$aInspirational->id}}" name="comment" placeholder="Write a comment..." class="form-control">

    <button class="scomment-btn" onclick="submitComment({{$aInspirational->id}},'comment')" id="commentBtn{{$aInspirational->id}}" disabled>Comment</button>    
        
    </div>

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





</div>  





</div><!--col-md-7-->







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

          <form class="login-form" name="cform" id="group_event" onsubmit="return createEventIns();" method="post">

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

            <p class="contact-form-name">

              <input type="datetime-local" name="eventEndDateTime" id="eventEndDateTime" class="form-control" placeholder="End Date">

           </p>

           <p class="formError eventEndDateTime"></p>

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

      <div class="form-group createEventBtn">

        <input type="submit" name="btnEventSubmit" class="common-btn w-100" id="quote-submit" value="Create Now"> 

      </div>

    </form>   

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

              <div class="user-input"><input type="text" name="whats_on_your_mind" id="whats_on_your_mind" class="activity-input" placeholder="What???s on your mind?">

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


                  </div>


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


                  </div>


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

                <div class="user-input"><input type="text" class="activity-input" id="whats_on_your_mind_post" name="whats_on_your_mind_post" placeholder="What???s on your mind?">

                  <p class="formError whats_on_your_mind_post"></p>

                </div>    

              </div>



              <div class="postmedia-inner">



               <div class="file-loading">

                 <input id="file-1" type="file" accept="image/jpg, image/png, image/jpeg" name="file" class="file" data-overwrite-initial="false" data-min-file-count="2">

                 <div id="kv-error-2" style="margin-top:10px;display:none"></div>
<div id="kv-success-2" class="alert alert-success" style="margin-top:10px;display:none"></div>

               </div>         

             </div>    

           </div>



           <div class="postadd-icons">

            <div class="postadd-txt">Add to your post</div>

            <div class="postadd-emoji">

             <a href="javascript:void(0)" title="" onclick="click_browse();"><img src="{{ asset('images/camera-3Dicon.png') }}" alt="" data-pagespeed-url-hash="141198199" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Upload Photos</a>

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

<!----post modal---->





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

           $(".file-caption-main").hide();

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

            
            if($(".file-preview-image").length == 0) {
              //it doesn't exist
              fd.append("photo_upload", "");
            }else{
              fd.append("photo_upload", $(".file-preview-image").attr('title'));
            }

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

        let eventLocationError=0,eventEndDateTimeError=0;



        function createEventIns() {

          let eventName = $('#eventName').val();

          let eventStartDateTime = $("#eventStartDateTime").val();

          let eventEndDateTime = $("#eventEndDateTime").val();

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



          //event end datetime

          if(eventEndDateTime=='' || eventEndDateTime==undefined || eventEndDateTime==null) {

           $('.eventEndDateTime').html('Event end date and time required');

           eventEndDateTimeError++;

          } else {

           $('.eventEndDateTime').html(``);

           eventEndDateTimeError = 0;

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



           if(eventNameError > 0 || eventStartDateTimeError > 0 || eventprivacyTypeError > 0 || eventLocationError > 0 || eventimageError > 0 || eventEndDateTimeError > 0) {

             return false;

           } else {

            $('.createEventBtn').html(`<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>`);



            var fd = new FormData(document.getElementById("group_event"));

            $.ajax({

              url: sBASEURL+"createEventFront",

              type: "POST",

              data: fd,

                processData: false,  // tell jQuery not to process the data

                contentType: false   // tell jQuery not to set contentType

              }).done(function( data ) {

                console.log( data );

                let result = JSON.parse(data);

                if(result.status == 'success') {

                  $('#group_event')[0].reset();

                  $('#createeventmodal').modal('hide');

                  $('.success').show();

                  $('.success').toast('show');

                  $('.success .toast-body').html(`${result.msg}`);

                  $('#eventsJoinedOrCreated').html(`${result.sOutput}`);

                } else {

                  $('.failure').show();

                  $('.failure').toast('show');

                  $('.failure .toast-body').html(`${result.msg}`);

                }

                $('.createEventBtn').html(`<input type="submit" name="submit" class="common-btn w-100" id="quote-submit" value="Create Now">`);

              });

              return false;

          }

        }

      </script>



                       <!--Timeline setup end-->


                              <!--Timeline setup end-->
                           </div>
                          </div><!--profile-custome-7-->  
                        </div>
                      </div>
                        <div id="tabs-2-diff">
                            <div class="profile-main-right">
                          <div class="row">
                            <div class="col-md-6 profile-custome-5">
                              <div class="profile-main-lefside">
                                <div class="profile-pstabout profile-whitebox">
                                <div class="profile-white-head">About</div>
                                <div class="profile-aboutpst-col">
                                 <ul>
                                    <li class="section_1 profile-abactive"><a href="javascript:void(0)" onclick="show_panel(1);">Overview</a></li>
                                    <li class="section_2"><a href="javascript:void(0)" onclick="show_panel(2);">Work and education</a></li>
                                    <li class="section_3"><a href="javascript:void(0)" onclick="show_panel(3);">Places Lived</a></li>
                                    <li class="section_4"><a href="javascript:void(0)" onclick="show_panel(4);">Contact &amp; basic</a></li>
                                    <li class="section_5"><a href="javascript:void(0)" onclick="show_panel(5);">Family and relationships</a></li>   
                                 </ul>  
                                </div>
                              </div>
                              </div>
                            </div><!--profile-custome-5-->
                            <div class="col-md-6 profile-custome-7">
                             
                             <!--About display content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="about_display">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                  @foreach ($userAboutData as $userAboutDataResult)
                                    <p><i class="las la-graduation-cap"></i> Studied at {{$userAboutDataResult->studied_at}} </p>
                                    <p><i class="las la-home"></i> Lives in <a href="#">{{$userAboutDataResult->lives_in}}</a></p>  
                                    <p><i class="las la-map-marker"></i> From <a href="#">{{$userAboutDataResult->from}}</a></p>   
                                    <p><i class="las la-heart"></i> {{$userAboutDataResult->marital_status}}</p>
                                    <p><i class="las la-phone"></i> {{$userAboutDataResult->phone}}</p> 
                                    <hr> 
                                    <h5 class="small-title3">About You</h5> 
                                    <p>{{$userAboutDataResult->about}}</p> 
                                    <hr> 
                                    <h5 class="small-title3">Account Info</h5> 
                                    <p>{{$firstName}}<small>First Name</small></p> 
                                    <p>{{$lastName}} <small>Last Name</small></p>
                                    <p>{{$aLoggedInUserDetail->username}} <small>Username</small></p>
                                    <p>{{$aLoggedInUserDetail->email}} <small>Email</small></p>
                                    <p>******** <small>Password</small></p>
                                    <p>{{$userAboutDataResult->zipcode}} <small>Zip Code</small></p>
                                    <p>{{$userAboutDataResult->denomination}} <small>Denomination</small></p>
                                    <p>Member <small>{{$userAboutDataResult->member}}</small></p> 
                                    @endforeach
                                  </div>  
                                </div>  
                             </div>
                             <!--About display content end-->

                             <!--Work and education display content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="work_edu_display" style="display:none;">
                                
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                     <h5 class="small-title3">Work</h5>
                                     <hr>
                                     @foreach ($userEducationData as $userEducationDataResult)
                                     <h5 class="small-title3">{{$userEducationDataResult->type}}</h5>
                                     <p>
                                      @if($userEducationDataResult->type =='High School' || $userEducationDataResult->type =='Intermediate')         
                                        <i class="las la-university"></i>         
                                      @elseif($userEducationDataResult->type =='Work')
                                        <i class="las la-briefcase"></i>
                                      @else
                                        <i class="las la-graduation-cap"></i>    
                                      @endif
                                      Went to {{$userEducationDataResult->description}} <small>Joining year {{$userEducationDataResult->joining_year}} | Completion year {{$userEducationDataResult->completion_year}} | <a href="javascript:void(0)" class="blue-text" data-toggle="modal" data-target="#editEducationModal" onclick="modal_education({{$userEducationDataResult->id}});"><i class="las la-pen"></i></a>&nbsp;<a href="javascript:void(0)" onclick="delete_education({{$userEducationDataResult->id}});" class="blue-text"><i class="las la-trash"></i></a></small>
                                      </p>
                                     
                                     <hr>
                                     @endforeach
                                  </div>  
                                </div> 
                                
                              </div>
                             <!--Work and education display content end-->

                             <!--Places lived display content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="places_lived_display" style="display:none;">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                     <h5 class="small-title3">Places Lived</h5>
                                     @foreach ($userPlacesLivedData as $userPlacesLivedDataResult)
                                     <p>
                                      <i class="las la-map-marker"></i> 
                                      {{$userPlacesLivedDataResult->desc}} <small>{{$userPlacesLivedDataResult->type}} | <a href="javascript:void(0)" class="blue-text" data-toggle="modal" data-target="#editPlacesLivedModal" onclick="modal_placeslived({{$userPlacesLivedDataResult->id}});"><i class="las la-pen"></i></a>&nbsp;<a href="javascript:void(0)" onclick="delete_places({{$userPlacesLivedDataResult->id}});" class="blue-text"><i class="las la-trash"></i></a></small>
                                      </p>
                                     @endforeach
                                  </div> 
                                </div>  
                              </div>
                             <!--Places lived display content end-->

                             <!--Contact info display content start-->
                             <div class="profile-pstrightabout profile-whitebox"  id="contact_info_display" style="display:none;"> 
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                     <h5 class="small-title3">Contact info</h5>
                                    <p><i class="las la-phone"></i> {{$aLoggedInUserDetail->mobile}} <small>Mobile</small></p>
                                    <p><i class="las la-map-marked"></i> {{$aLoggedInUserDetail->address}}  <small>Address</small></p>
                                    <p><i class="las la-envelope"></i> {{$aLoggedInUserDetail->email}} <small>Email</small></p>
                                    <hr> 
                                    <h5 class="small-title3">Basic info</h5> 
                                    <p><i class="las la-user"></i> {{$aLoggedInUserDetail->gender}} <small>Gender</small></p>
                                    <p><i class="las la-birthday-cake"></i> {{$aLoggedInUserDetail->dob}} <small>Birth date</small></p> 
                                    <p><i class="las la-calendar-check"></i> {{$aLoggedInUserDetail->year}} <small>Birth year</small></p>
                                    <p><i class="las la-language"></i> {{$aLoggedInUserDetail->languages}} <small>Languages</small></p> 
                                    <p><i class="las la-female"></i> {{$aLoggedInUserDetail->interested_in}} <small>Interested in</small></p>
                                  </div>  
                                </div>  
                              </div>
                             <!--Contact info display content end-->

                             <!--Family info display content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="family_info_display" style="display:none;">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                     <h5 class="small-title3">Family members</h5>
                                     @foreach ($userFamilyData as $userFamilyDataResult)
                                     <p>
                                      <span class="user-pic mr-2">
                                        <img src="{{ !empty($userFamilyDataResult->image) ? asset('images/profile/'.$userFamilyDataResult->image) : asset('images/avtar1.png') }}" width="40px" alt="" data-pagespeed-url-hash="399097396" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                      </span> 
                                      {{$userFamilyDataResult->name}} <small>{{$userFamilyDataResult->relation}} | <a href="javascript:void(0)" class="blue-text" data-toggle="modal" data-target="#editFamilyModal" onclick="modal_family({{$userFamilyDataResult->id}});"><i class="las la-pen"></i></a>&nbsp;<a href="javascript:void(0)" onclick="delete_family({{$userFamilyDataResult->id}});" class="blue-text"><i class="las la-trash"></i></a></small>
                                      </p>
                                     @endforeach
                                  </div> 
                                </div>  
                              </div>
                             <!--Family info display content end-->

                             <!--------------------------------Edit forms section------------------------------------>

                             <!--About display edit content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="about_display_edit" style="display:none;">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                  <form action="" method="post" id="about_display_edit_form">
                                    @foreach ($userAboutData as $userAboutDataResult)
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$userAboutDataResult->studied_at}}" name="studied_at" id="studied_at" class="form-control" placeholder="Studied At" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$userAboutDataResult->lives_in}}" name="lives_in" id="lives_in" class="form-control" placeholder="Lives In" required="">
                                      </div>
                                      </div>
                                    </p>  
                                    <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$userAboutDataResult->from}}" name="from_city" id="from_city" class="form-control" placeholder="From" required="">
                                      </div>
                                      </div>
                                    </p>   
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <select name="marital_status" id="marital_status" class="form-control">
                                          <option value="">Marital Status</option>
                                          <option value="Married" {{ ( $userAboutDataResult->marital_status == 'Married') ? 'selected' : '' }}>Married</option>
                                          <option value="Single" {{ ( $userAboutDataResult->marital_status == 'Single') ? 'selected' : '' }}>Single</option>
                                        </select>
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$userAboutDataResult->phone}}" name="phone_no" id="phone_no" class="form-control" placeholder="Phone" required="">
                                      </div>
                                      </div>
                                    </p> 
                                    <hr> 
                                    <h5 class="small-title3">About You</h5> 
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <textarea name="about_info" id="about_us" class="form-control" placeholder="About You">{{$userAboutDataResult->about}}</textarea>
                                      </div>
                                      </div>
                                    </p> 
                                    <hr> 
                                    <h5 class="small-title3">Account Info</h5> 
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$firstName}}" name="first_name" id="first_name" class="form-control" placeholder="First Name" required="">
                                      </div>
                                      </div></p> 
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$lastName}}" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required="">
                                      </div>
                                      </div></p>
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->username}}" name="username" id="username" class="form-control" placeholder="Username" required="">
                                      </div>
                                      </div></p>
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->email}}" name="email" id="email" class="form-control" placeholder="Email" required="">
                                      </div>
                                      </div></p>
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->password}}" name="password" id="password" class="form-control" placeholder="Password" required="">
                                      </div>
                                      </div></p>
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$userAboutDataResult->zipcode}}" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode" required="">
                                      </div>
                                      </div></p>
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <select name="denomination" id="denomination" class="form-control">
                                          <option value="Denomination">Denomination</option>
                                          <option value="Roman Catholic" {{ ( $userAboutDataResult->denomination == 'Roman Catholic') ? 'selected' : '' }}>Roman Catholic</option>
                                        </select>
                                      </div>
                                      </div></p>
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                        <select name="member" id="member" class="form-control">
                                          <option value="Member">Member</option>
                                          <option value="Other Nonprofit Organization" {{ ( $userAboutDataResult->member == 'Other Nonprofit Organization') ? 'selected' : '' }}>Other Nonprofit Organization</option>
                                          <option value="Schools" {{ ( $userAboutDataResult->member == 'Schools') ? 'selected' : '' }}>Schools</option>
                                          <option value="Others" {{ ( $userAboutDataResult->member == 'Others') ? 'selected' : '' }}>Others</option>
                                        </select>
                                      </div>
                                      </div></p>
                                    <div class="form-group">
                                      <input type="butto" name="btnSubmitAbout" class="smallcommon-btn" id="quote-submit" value="Update" onclick="updateAboutInfo()"> 
                                    </div>
                                       @endforeach
                                  </form>
                                 </div>  
                                </div>  
                             </div>
                             <!--About display edit content end-->

                              <!--Work edu display edit content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="work_edu_display_edit" style="display:none;">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                  <form action="" method="post" id="work_edu_display_edit_form">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <select name="type" id="type" class="form-control">
                                          <option value="">Type</option>
                                          <option value="High School">High School</option>
                                          <option value="Intermediate">Intermediate</option>
                                          <option value="Graduation">Graduation</option>
                                          <option value="Post Graduation">Post Graduation</option>
                                          <option value="Work">Work</option>
                                          <option value="Other">Other</option>
                                        </select>
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <textarea name="edu_description" id="edu_description" class="form-control" placeholder="Description"></textarea>
                                      </div>
                                      </div>
                                    </p>
                                    <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="date" size="30" name="joining_year" id="joining_year" class="form-control" placeholder="Joining Year" required="">
                                      </div>
                                      </div>
                                        </p> 
                                    <p><div class="form-group">
                                      <div class="contact-form-name">
                                      <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="date" size="30" name="completion_year" id="completion_year" class="form-control" placeholder="Completion Year" required="">
                                      </div>
                                      </div>
                                        </p>
                                      </div>
                                      </div></p>
                                    <div class="form-group">
                                      <input type="butto" name="btnSubmitAbout" class="smallcommon-btn" id="quote-submit" value="Add" onclick="updateEducationInfo()"> 
                                    </div>
                                  </form>
                                 </div>  
                                </div>  
                             </div>
                             <!--Work edu display edit content end-->

                             <!--Places lived edit content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="places_display_edit" style="display:none;">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                  <form action="" method="post" id="places_lived_display_edit_form">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <select name="place_type" id="place_type" class="form-control">
                                          <option value="">Type</option>
                                          <option value="Home Town">Home Town</option>
                                          <option value="Current town/city">Current town/city</option>
                                        </select>
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <textarea name="place_description" id="place_description" class="form-control" placeholder="Description"></textarea>
                                      </div>
                                      </div>
                                    </p>
                                    <div class="form-group">
                                      <input type="butto" name="btnSubmitAbout" class="smallcommon-btn" id="quote-submit" value="Add" onclick="updatePlacesLivedInfo()"> 
                                    </div>
                                  </form>
                                 </div>  
                                </div>  
                             </div>
                             <!--Places lived edit content end-->

                             <!--Contact display edit content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="contact_display_edit" style="display:none;">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                  <form action="" method="post" id="contact_display_edit_form">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <h5 class="small-title3">Contact info</h5>
                                    <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->mobile}}" name="contact_mobile" id="contact_mobile" class="form-control" placeholder="Mobile" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->address}}" name="contact_address" id="contact_address" class="form-control" placeholder="Address" required="">
                                      </div>
                                      </div>
                                    </p>  
                                    <hr> 
                                    <h5 class="small-title3">Basic Info</h5>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->gender}}" name="contact_gender" id="contact_gender" class="form-control" placeholder="Gender" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="date" size="30" value="{{$aLoggedInUserDetail->dob}}" name="contact_dob" id="contact_dob" class="form-control" placeholder="DOB" required="">
                                      </div>
                                      </div>
                                    </p>
                                     <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->year}}" name="contact_year" id="contact_year" class="form-control" placeholder="Year" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->languages}}" name="contact_languages" id="contact_languages" class="form-control" placeholder="Languages" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <p>
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" value="{{$aLoggedInUserDetail->interested_in}}" name="contact_interested_in" id="contact_interested_in" class="form-control" placeholder="Interested In" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <div class="form-group">
                                      <input type="butto" name="btnSubmitAbout" class="smallcommon-btn" id="quote-submit" value="Update" onclick="updateContactInfo()"> 
                                    </div>
                                  </form>
                                 </div>  
                                </div>  
                             </div>
                             <!--Contact display edit content end-->

                              <!--Family edit content start-->
                             <div class="profile-pstrightabout profile-whitebox" id="family_info_display_edit" style="display:none;">
                                <div class="timeline-postabout">
                                 <div class="timeline-pst1">
                                  <form action="" method="post" id="family_display_edit_form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                     <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                            <input type="file" id="family_pic" name="family_pic" multiple="" accept="image/x-png,image/gif,image/jpeg"/>
                                      </div>
                                      </div>
                                     </p>
                                     <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" name="family_name" id="family_name" class="form-control" placeholder="Name" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <p> 
                                      <div class="form-group">
                                      <div class="contact-form-name">
                                        <input type="text" size="30" name="family_relation" id="family_relation" class="form-control" placeholder="Relationship" required="">
                                      </div>
                                      </div>
                                    </p>
                                    <div class="form-group">
                                      <input type="butto" name="btnSubmitAbout" class="smallcommon-btn" id="quote-submit" value="Add" onclick="updateFamilyInfo()">
                                    </div>
                                  </form>
                                 </div>  
                                </div>  
                             </div>
                             <!--Family edit content end-->

                            </div><!--profile-custome-7-->                  
                          </div>  
                        </div> 
                        </div>
                        <div id="tabs-3-diff">
                         <div class="profile-main-right">
                          <div class="profile-following-page profile-whitebox">
                            <div class="community-columns">
                              <div class="row">
                              @foreach ($userFollowersData as $userFollowersDataResult)
                               @php
                                    $results = DB::select( DB::raw("SELECT * FROM users WHERE id = :var1"), array(
                                        'var1' => $userFollowersDataResult->followed_by_user_by,
                                    ));
                               @endphp
                              <div class="col-md-4 col-xl-3 col-6">
                                <div class="community-col"><a href="#">
                                <div class="community-fig"><img src="{{asset('/images/profile/'.$results[0]->profile_pic)}}" alt="" data-pagespeed-url-hash="1112664575" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                                <div class="community-text">
                                  <h4>{!! str_replace('_*_', ' ',$results[0]->name) !!}</h4>
                                </div>
                                </a></div>  
                              </div>
                              @endforeach
                              </div>        
                              </div>      
                          </div>
                        </div> 
                        </div>
                        <div id="tabs-4-diff">
                          <div class="profile-main-right">
                            <div class="profile-following-page profile-whitebox">
                              <div class="community-columns">
                                <div class="row">
                                  @foreach ($userFollowingData as $userFollowingDataResult)
                                      @php
                                        $results = DB::select( DB::raw("SELECT * FROM users WHERE id = :var1"), array(
                                            'var1' => $userFollowingDataResult->following_user_id,
                                        ));
                                      @endphp
                                <div class="col-md-4 col-xl-3 col-6">
                                  <div class="community-col"><a href="#">
                                  <div class="community-fig"><img src="{{asset('/images/profile/'.$userFollowingDataResult->profile_pic)}}" alt="" data-pagespeed-url-hash="1112664575" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                                  <div class="community-text">
                                    <h4>{!! str_replace('_*_', ' ',$results[0]->name) !!}</h4>
                                  </div>
                                  </a></div>  
                                </div>
                                @endforeach
                            </div>
                            </div>      
                          </div>
                        </div> 
                        </div>
                        <div id="tabs-5-diff">
                          <div class="profile-main-right">
                            <div class="profile-following-page profile-whitebox">
                              <div class="clearfix"></div>
                              <div class="clearfix"></div>
                              <div id="gallery">  
                              <div class="profilegallery-sec gallery">
                                 @foreach ($userPhotoData as $userPhotoDataResult)
                                  <div class="profile-phots-col">
                                    <a href="{{ asset('images/userphotos/'.$userPhotoDataResult->url)}}"><img src="{{ asset('images/userphotos/'.$userPhotoDataResult->url)}}" alt="" data-pagespeed-url-hash="1247596316" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>    
                                  </div>
                                 @endforeach
                              </div>
                              </div>
                            </div>  
                          </div>
                        </div>
                        <div id="tabs-6-diff">
                          <div class="profile-main-right">
                              <div class="profile-following-page profile-whitebox">
                               <div class="upload-div">
                                </div>
                                <div class="clearfix"></div>
                                <div class="clearfix"></div>
                                <div class="video-gallery-pg">  
                                  <div class="row no-gutters">
                                    @foreach ($userVideoData as $userVideoDataResult)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                      <div class="inner-videogal-col">
                                        <video controls="">
                                          <source src="{{ asset('images/uservideo/'.$userVideoDataResult->url)}}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                      </div> 
                                    </div>
                                    @endforeach
                                  </div>
                                </div>
                              </div>  
                            </div> 
                          </div>                
                        </div>
                      </div>
                  </div>
                </div>
              </div>   
              </div>  
            </div>  
          </div> 
        </div><!--col-md-10--> 
     </div>   
    </div>
  </div>      
</div>
@endsection