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
              <div class="profile-name-top"><h1>Lores Nguyen <span class="profile-txdate">June 15, 1989</span></h1></div>
              <div class="profile-edit-top"><a href="javascript:void(0)"><img src="{{ asset('images/follow-ico-blue.png') }}" alt="" data-pagespeed-url-hash="1581428935" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Follow</a></div>    
            </div><!--profile-top-head-->
              
            <div class="profile-navs">
              <ul class="pronavbar-nav">
                <li class="pronav-item pronav-active"><a href="javascript:void(0)">Post</a></li>
                <li class="pronav-item"><a href="javascript:void(0)">About</a></li>
                <li class="pronav-item"><a href="javascript:void(0)">Following</a></li>		
                <li class="pronav-item"><a href="javascript:void(0)">Photos</a></li>
                <li class="pronav-item"><a href="javascript:void(0)">Videos</a></li>		
                </ul>  
            </div>  
              
            <div class="profile-main-right">
              <div class="row">
                  
                <div class="col-md-6 profile-custome-5">
                    
                  <div class="profile-main-lefside">
                    <div class="profile-pstabout profile-whitebox">
                      <div class="profile-white-head">About</div> 
                      <div class="post-about-para">Think Positive & Positive thinks will happen</div>
                      <div class="profile-pst-short">
                        <p><i class="las la-home"></i> Lives in <a href="javascript:void(0)">Florida, U.S.</a></p>
                        <p><i class="las la-map-marker"></i> From <a href="javascript:void(0)">Florida, U.S.</a></p>  
                        <p><i class="las la-clock"></i> Joined on October 2010</p>
                        <p><i class="las la-rss"></i> Followed by <a href="javascript:void(0)">130 people</a></p>    
                      </div>   
                        
                         
                        
                      <a href="profile-about.html">Edit Details <i class="las la-angle-double-right"></i></a>    
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
                      <div class="user-pic"><a href="javascript:void(0)"><img src="{{ asset('images/lores.jpg') }}" alt="" data-pagespeed-url-hash="3548533874" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a></div>
                      <div class="user-input"><input type="text" class="activity-input" placeholder="Inspire others with your love, blessings, gratitude"></div>    
                    </div>
            
                 <div class="user-activity-btns">
                   <div class="user-live-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postlivemodal"><img src="{{ asset('images/live-video-icon.png') }}" alt="" data-pagespeed-url-hash="1806690493" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Testimony</a></div>
                   <div class="user-photo-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#postmediamodal"><img src="{{ asset('images/camera-icon.png') }}" alt="" data-pagespeed-url-hash="676148810" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Photo</a></div>
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

                           <div class="newsfeed-mainpic"><img src="{{ asset('images/timeline-1.jpg') }}" alt="" data-pagespeed-url-hash="52605886" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>

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


                           <div class="newsfeed-mainpic"><img src="{{ asset('images/timeline-2.jpg') }}" alt="" data-pagespeed-url-hash="347105807" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>

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