@extends('myuser.layouts.view')
@section('title', 'Register')
@section('content')
<div class="inner-page">
  <div class="container">
      
    <div class="inner-title">My Profile</div>
     
    <div class="userprofile-page">
     <div class="row">
        <div class="col-md-2">
            <div class="userprofile-col">
              <div class="userprofile-pic"><img src="{{ !empty($aLoggedInUserDetail->profile_pic) ? asset('images/profile/'.$aLoggedInUserDetail->profile_pic) : '' }}" alt="" data-pagespeed-url-hash="3548533874" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="userprofile-camera" onclick="document.getElementById('profilePic').click();"><a href="javascript:void(0)"><img src="{{ asset('images/camera-settings.png') }}" alt="" data-pagespeed-url-hash="1144822072" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div> 
              <form id="profilePicUpload" enctype="multipart/form-data" action="{{ url('profile') }}" method="post"> 
                @csrf
                <input type="file" accept="image/png, image/jpg, image/jpeg" name="profilePic" id="profilePic" style="display: none;" />  
              </form>
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
              <!-- <div class="profile-edit-top"><a href="javascript:void(0)"><img src="{{ asset('images/follow-ico-blue.png') }}" alt="" data-pagespeed-url-hash="1581428935" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Follow</a></div>  -->   
            </div><!--profile-top-head-->
              
            <div class="profile-navs">
              <ul class="pronavbar-nav">
                <li class="pronav-item pronav-active"><a href="javascript:void(0)">Post</a></li>
                <li class="pronav-item"><a href="{{url('edit_details')}}">About</a></li>
                <li class="pronav-item"><a href="javascript:void(0)">Following</a></li>		
                <li class="pronav-item"><a href="{{url('edit_photos')}}">Photos</a></li>
                <li class="pronav-item"><a href="{{url('edit_video')}}">Videos</a></li>		
                </ul>  
            </div>  
              
            <div class="profile-main-right">
              <div class="row">
                  
                <div class="col-md-6 profile-custome-5">
                    
                  <div class="profile-main-lefside">
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
                        
                         
                        
                      <a href="{{url('edit_details')}}">Edit Details <i class="las la-angle-double-right"></i></a>    
                    </div>
                        
                     
                    <div class="profile-photo-box">
                     <div class="top-profile-photo-box"><span>Photos</span> <a href="profile-photos.html">See All Photos</a></div>
                        
                     <div class="inner-profile-photo-box">
                      <a href="profile-photos.html"><img src="{{ asset('images/home-service-1.jpg') }}" alt="" data-pagespeed-url-hash="523810136" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                      <a href="profile-photos.html"><img src="{{ asset('images/home-service-2.jpg') }}" alt="" data-pagespeed-url-hash="818310057" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                      <a href="profile-photos.html"><img src="{{ asset('images/home-service-3.jpg') }}" alt="" data-pagespeed-url-hash="1112809978" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                      <a href="profile-photos.html"><img src="{{ asset('images/home-service-4.jpg') }}" alt="" data-pagespeed-url-hash="1407309899" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                      <a href="profile-photos.html"><img src="{{ asset('images/home-service-5.jpg') }}" alt="" data-pagespeed-url-hash="1701809820" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                      <a href="profile-photos.html"><img src="{{ asset('images/home-service-6.jpg') }}" alt="" data-pagespeed-url-hash="1996309741" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>     
                     </div>       
                    </div>
                      
                  </div>

                </div><!--profile-custome-5-->
                  
                  
                <div class="col-md-6 profile-custome-7">
                  <div class="profile-main-righside">
                      
                <div class="user-activity-sec white-box">
                  <div class="user-activity-head">    
                    <div class="user-pic"><a href="javascript:void(0)"><img width="40px" height="23px" src="{{ !empty($aLoggedInUserDetail->profile_pic) ? asset('images/profile/'.$aLoggedInUserDetail->profile_pic) : '' }}" alt="" data-pagespeed-url-hash="399097396" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>
                    <div class="user-input"><input type="text" class="activity-input" placeholder="Inspire others with your love, blessings, gratitude"></div>    
                  </div>
                  
                  <div class="user-activity-btns">
                   <div class="user-live-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postlivemodal"><img src="{{ asset('images/live-video-icon.png') }}" alt="" data-pagespeed-url-hash="1806690493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Testimony</a></div>
                   <div class="user-photo-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postmediamodal" class="postmediamodal"><img src="{{ asset('images/camera-icon.png') }}" alt="" data-pagespeed-url-hash="676148810" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Photo</a></div>
                   <div class="user-feel-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postfeelingmodal"><img src="{{ asset('images/smiley-icon.png') }}" alt="" data-pagespeed-url-hash="1049116682" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Feeling /Activity</a></div>     
                 </div>    
                </div>
                       
                    <div class="newsfeed-wrapper">
		   
                         <div class="newsfeed-sec">

                         <div class="newsfeed-tophead">     
                           <div class="newsfeed-top-sec">
                             <div class="news-userpic"><img src="{{ asset('images/lores.jpg') }}" alt="" data-pagespeed-url-hash="3548533874" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                             <div class="newsfeed-text"><h3><strong>Lores Nguyen</strong> is watching <img class="newsfeed-exico" src="{{ asset('images/activity-ico-2.png') }}" alt="" data-pagespeed-url-hash="1887260317" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Movies at <strong><a href="javascript:void(0)">coming soon</a></strong></h3> <p>Yesterday at 3:21 PM</p></div>
                           </div>

                           <div class="newsfeed-arrow">
                               <div class="dropdown">
                                      <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                         <img src="{{ asset('images/event-arrow-icon.png') }}" alt="" data-pagespeed-url-hash="603205129" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="las la-eye-slash"></i> Hide</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="las la-flag"></i> Report</a>
                                      </div>
                                    </div>
                             </div>

                           </div><!--newsfeed-tophead-->  

                           <div class="newsfeed-desc"><p>Part of spiritual and emotional maturity is recognizing that it’s not like you’re going to try to fix yourself and become a different person. You remain the same person, but you become awakened.</p></div>

                           <div class="newsfeed-mainpic">
                            <!-- <img src="{{ asset('images/timeline-1.jpg') }}" alt="" data-pagespeed-url-hash="52605886" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> -->
                          </div>

                           <div class="newsfeed-licosh-col">
                            <div class="feednewlikes"><a href="javascript:void(0)"><img src="{{ asset('images/like-ico.png') }}" alt="" data-pagespeed-url-hash="1279223300" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Like</span></a> </div>
                            <div class="feednewcomment"><a href="javascript:void(0)"><img src="{{ asset('images/comment-ico.png') }}" alt="" data-pagespeed-url-hash="1033231412" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Comments</span></a> </div>
                            <div class="feednewprayer"><a href="javascript:void(0)"><img src="{{ asset('images/prayer-icon.png') }}" alt="" data-pagespeed-url-hash="3948427328" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Prayer</span></a> </div>
                            <div class="feednewshare"><a href="javascript:void(0)"><img src="{{ asset('images/post-share-ico.png') }}" alt="" data-pagespeed-url-hash="4226147923" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">  <span>Shares</span></a> </div>   
                           </div>

                           <div class="feed-maincomment-sec">

                           <div class="newsfeed-liked-col">
                             <div class="row align-items-center">
                               <div class="col-6"><div class="totalshares">195 shares </div></div>
                               <div class="col-6 text-right"><div class="totalcomenshare">102 comments </div></div>
                             </div>
                           </div>       

                           <div class="feednew-comment">
                             <div class="exis-userpic"><img src="{{ asset('images/newsuserpic.png') }}" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                             <div class="feed-usercomment"><input type="text" name="comment" placeholder="Write a comment..." class="form-control">
                             </div>
                         </div>

                          <div class="newsfeed-liked-col">
                             <div class="row align-items-center">
                               <div class="col-6"><div class="totalshares"><a href="javascript:void(0)">View previous comments</a> </div></div>
                               <div class="col-6 text-right"><div class="totalcomenshare">2 of 150 </div></div>
                             </div>
                           </div>

                           <div class="newsfeed-usercoments">
                             <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)"><img src="{{ asset('images/user-1.jpg') }}" alt="" data-pagespeed-url-hash="2514085572" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
                               <div class="newsfeed-commenting-comments">
                                <div class="commenting-comments1"><a href="javascript:void(0)">John Bryant</a> <a href="javascript:void(0)">Adam,</a><span> we need to move asap!</span></div>

                                 <div class="commenting-comments2">
                                     <a href="javascript:void(0)">Like</a>
                                     <a href="javascript:void(0)">Reply</a>
                                     <a href="javascript:void(0)"><img src="{{ asset('images/like-ico-blue.png') }}" alt="" data-pagespeed-url-hash="64196249" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> 1</a>
                                     <span> March 21 at 4:32pm</span>
                                  </div>

                                  <div class="newsfeed-commenting-rply">
                                 <div class="rplyicon"><a href="javascript:void(0)"><img src="{{ asset('images/reply-icon.png') }}" alt="" data-pagespeed-url-hash="2931494377" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> 1 Reply</a></div>
                               </div>   

                               </div>
                           </div><!--newsfeed-usercoments-->   

                           <div class="newsfeed-usercoments">
                             <div class="newsfeed-commenting-userpic"><a href="javascript:void(0)"><img src="{{ asset('images/user-2.jpg') }}" alt="" data-pagespeed-url-hash="2808585493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>    
                               <div class="newsfeed-commenting-comments">
                                <div class="commenting-comments1"><a href="javascript:void(0)">Sophia Holden</a> <a href="javascript:void(0)">Angie Walters</a></div>

                                 <div class="commenting-comments2">
                                     <a href="javascript:void(0)">Like</a>
                                     <a href="javascript:void(0)">Reply</a>
                                     <span> March 21 at 4:34pm</span>
                                  </div>    
                               </div>
                           </div><!--newsfeed-usercoments-->    

                         </div><!--feed-comment-main-->     


                       </div>

                         <div class="newsfeed-sec">

                         <div class="newsfeed-tophead">     
                           <div class="newsfeed-top-sec">
                             <div class="news-userpic"><img src="{{ asset('images/lores.jpg') }}" alt="" data-pagespeed-url-hash="3548533874" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                             <div class="newsfeed-text"><h3>Lores Nguyen</h3> <p>March 21 at 2:29pm</p></div>
                           </div>

                           <div class="newsfeed-arrow">
                               <div class="dropdown">
                                      <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                         <img src="{{ asset('images/event-arrow-icon.png') }}" alt="" data-pagespeed-url-hash="603205129" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="las la-eye-slash"></i> Hide</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="las la-flag"></i> Report</a>
                                      </div>
                                    </div>
                             </div>

                           </div><!--newsfeed-tophead-->  

                           <div class="newsfeed-desc"><p>More smiling, less worrying. More compassion, less judgment. More blessed, less stressed. More love, less hate.</p></div>


                           <div class="newsfeed-mainpic">
                            <!-- <img src="{{ asset('images/timeline-2.jpg') }}" alt="" data-pagespeed-url-hash="347105807" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> -->
                          </div>

                           <div class="newsfeed-licosh-col">
                            <div class="feednewlikes"><a href="javascript:void(0)"><img src="{{ asset('images/like-ico.png') }}" alt="" data-pagespeed-url-hash="1279223300" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Like</span></a> </div>
                            <div class="feednewcomment"><a href="javascript:void(0)"><img src="{{ asset('images/comment-ico.png') }}" alt="" data-pagespeed-url-hash="1033231412" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Comments</span></a> </div>
                            <div class="feednewprayer"><a href="javascript:void(0)"><img src="{{ asset('images/prayer-icon.png') }}" alt="" data-pagespeed-url-hash="3948427328" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> <span>Prayer</span></a> </div>
                            <div class="feednewshare"><a href="javascript:void(0)"><img src="{{ asset('images/post-share-ico.png') }}" alt="" data-pagespeed-url-hash="4226147923" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">  <span>Shares</span></a> </div>   
                           </div>

                           <div class="feed-maincomment-sec">

                           <div class="newsfeed-liked-col">
                             <div class="row align-items-center">
                               <div class="col-6"><div class="totalshares">195 shares </div></div>
                               <div class="col-6 text-right"><div class="totalcomenshare">102 comments </div></div>
                             </div>
                           </div>       

                           <div class="feednew-comment">
                             <div class="exis-userpic"><img src="{{ asset('images/newsuserpic.png') }}" alt="" data-pagespeed-url-hash="2338652753" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                             <div class="feed-usercomment"><input type="text" name="comment" placeholder="Write a comment..." class="form-control">
                             </div>
                         </div>

                         </div><!--feed-comment-main-->     


                       </div>

                    </div>
 
                   </div>
                </div><!--profile-custome-7-->  
                
                
              </div>  
            </div>  
           
          </div> 
         
        </div><!--col-md-10--> 
        
     </div>   
    </div>
      
  </div>      
</div>




@endsection
<!----Add testimony---->
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
<!----Add testimony---->

<!----Photo upload---->
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
<!----Photo upload---->

<!----Feeling/Activity---->
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
                  {{-- <button type="button" id="btnFeelingSearch" class="search-ico"><i class="las la-search"></i></button>   --}}
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
                  {{-- <button type="button" id="btnActivitySearch" class="search-ico"><i class="las la-search"></i></button>  --}}
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
<!----Feeling/Activity---->