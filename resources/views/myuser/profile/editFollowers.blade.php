@extends('myuser.layouts.view')
@section('title', 'Register')
@section('content')

@php
$iUserId  = getLoggedInUserId();
$sLoggedInUserProfileImage = getValueByColumnNameAndId('users','id',$iUserId,'profile_pic');
@endphp

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
                <li class="pronav-item"><a href="{{url('profile')}}">Post</a></li>
                <li class="pronav-item"><a href="{{url('edit_details')}}">About</a></li>
                <li class="pronav-item pronav-active"><a href="{{url('edit_followers')}}">Followers</a></li>
                <li class="pronav-item"><a href="{{url('edit_following')}}">Following</a></li>   
                <li class="pronav-item"><a href="{{url('edit_photos')}}">Photos</a></li>
                <li class="pronav-item"><a href="{{url('edit_video')}}">Videos</a></li>		
                </ul>  
            </div>  
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
                <button type="button" class="comjoin-btn" id="follow_button" onclick="remove_follow({{$userFollowersDataResult->id}});">Remove</button>
            </div>
            </a></div>  
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