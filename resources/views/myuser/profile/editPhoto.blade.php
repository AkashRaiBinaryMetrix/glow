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
                <li class="pronav-item"><a href="{{url('profile')}}">Profile</a></li>
                <li class="pronav-item"><a href="{{url('edit_details')}}">About</a></li>
                <li class="pronav-item"><a href="{{url('edit_followers')}}">Followers</a></li>
                <li class="pronav-item"><a href="{{url('edit_following')}}">Following</a></li>   
                <li class="pronav-item pronav-active"><a href="{{url('edit_photos')}}">Photos</a></li>
                <li class="pronav-item"><a href="{{url('edit_video')}}">Testimony</a></li>		
                </ul>  
            </div>  
          <div class="profile-main-right">
              <div class="profile-following-page profile-whitebox">
               <div class="upload-div">
    <!-- File upload form -->
    <form id="uploadForm" enctype="multipart/form-data" class="upload_form">
        <input type="file" name="images[]" id="fileInput" multiple required>
        <input type="submit" name="submit" value="UPLOAD"/>
    </form>
  
    <!-- Display upload status -->
    <div id="uploadStatus"></div>
</div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <div id="gallery">  
                <div class="profilegallery-sec gallery">
                   @foreach ($userPhotoData as $userPhotoDataResult)
                    <div class="profile-phots-col">
                      <a href="{{ asset('images/userphotos/'.$userPhotoDataResult->url)}}"><img src="{{ asset('images/userphotos/'.$userPhotoDataResult->url)}}" alt="" data-pagespeed-url-hash="1247596316" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                      <div class="pdelete-ico" onclick="delete_photo({{$userPhotoDataResult->id}},'{{$userPhotoDataResult->url}}');"><i class="las la-times"></i></div>    
                    </div>
                   @endforeach
                   @foreach ($userFeedPhotoData as $userFeedPhotoDataResult)
                    <div class="profile-phots-col">
                      <a href="{{ asset('images/inspirational_feed/'.$userFeedPhotoDataResult->photo)}}"><img src="{{ asset('images/inspirational_feed/'.$userFeedPhotoDataResult->photo)}}" alt="" data-pagespeed-url-hash="1247596316" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                    </div>
                   @endforeach
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