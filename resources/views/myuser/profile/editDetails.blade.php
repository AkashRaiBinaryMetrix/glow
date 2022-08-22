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
                <li class="pronav-item"><a href="{{url('profile')}}">Post</a></li>
                <li class="pronav-item pronav-active"><a href="javascript:void(0)">About</a></li>
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
                         <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="about_display_edit();"><i class="las la-edit"></i> Edit</a></div>
                        <p><i class="las la-graduation-cap"></i> Studied at ABC University </p>
                        <p><i class="las la-home"></i> Lives in <a href="#">Florida, U.S.</a></p>  
                        <p><i class="las la-map-marker"></i> From <a href="#">Florida, U.S.</a></p>   
                        <p><i class="las la-heart"></i> Married</p>
                        <p><i class="las la-phone"></i> +1 1234567890</p> 
                        <hr> 
                        <h5 class="small-title3">About You</h5> 
                        <p>Think Positive &amp; Positive thinks will happen</p> 
                        <hr> 
                        <h5 class="small-title3">Account Info</h5> 
                        <p>Dummy Name <small>First Name</small></p> 
                        <p>Surname <small>Last Name</small></p>
                        <p>Dummy12345 <small>Username</small></p>
                        <p>testing@gmail.com <small>Email</small></p>
                        <p>******** <small>Password</small></p>
                        <p>123456 <small>Zip Code</small></p>
                        <p>Roman Catholic <small>Denomination</small></p>
                        <p>Member <small>Other Nonprofit Organization / Schools / Others</small></p> 
                      </div>  
                    </div>  
                 </div>
                 <!--About display content end-->

                 <!--Work and education display content start-->
                 <div class="profile-pstrightabout profile-whitebox" id="work_edu_display" style="display:none;">
                    <div class="timeline-postabout">
                     <div class="timeline-pst1">
                         <div class="text-sm-right editsma-btn"><a href="#"><i class="las la-edit"></i> Edit</a></div>
                         <h5 class="small-title3">Work</h5>
                        <p><a href="profile-editabout2.html" class="blue-text"><i class="las la-plus-circle"></i> Add a workplace</a> </p>
                         <hr>
                         <h5 class="small-title3">University</h5>
                        <p><i class="las la-graduation-cap"></i> Studied at ABC University </p>
                         <hr>
                         <h5 class="small-title3">High School</h5>
                        <p><i class="las la-university"></i> Went to XYZ School <small>School year 2010</small></p>
                      </div>  
                    </div>  
                  </div>
                 <!--Work and education display content end-->

                 <!--Places lived display content start-->
                 <div class="profile-pstrightabout profile-whitebox" id="places_lived_display" style="display:none;">
                    <div class="timeline-postabout">
                     <div class="timeline-pst1">
                         <div class="text-sm-right editsma-btn"><a href="#"><i class="las la-edit"></i> Edit</a></div>
                         <h5 class="small-title3">Places lived</h5>
                        <p><a href="profile-editabout2.html" class="blue-text"><i class="las la-plus-circle"></i> Add city</a> </p>
                        <p><i class="las la-map-marker"></i> <a href="#">Florida, U.S.A</a> <small>Current town/city</small></p>
                        <p><i class="las la-map-marker"></i> <a href="#">New York, U.S.A</a> <small>Home town</small></p> 
                      </div>  
                    </div>  
                  </div>
                 <!--Places lived display content end-->

                 <!--Contact info display content start-->
                 <div class="profile-pstrightabout profile-whitebox"  id="contact_info_display" style="display:none;"> 
                    <div class="timeline-postabout">
                     <div class="timeline-pst1">
                         <div class="text-sm-right editsma-btn"><a href="profile-editabout4.html"><i class="las la-edit"></i> Edit</a></div>
                         <h5 class="small-title3">Contact info</h5>
                        <p><i class="las la-phone"></i> +1 1234567890 <small>Mobile</small></p>
                        <p><i class="las la-map-marked"></i> Florida, U.S.A  <small>Address</small></p>
                        <p><i class="las la-envelope"></i> testing@gmail.com <small>Email</small></p>
                        <hr> 
                        <h5 class="small-title3">Basic info</h5> 
                        <p><i class="las la-user"></i> Male <small>Gender</small></p>
                        <p><i class="las la-birthday-cake"></i> 25 August <small>Birth date</small></p> 
                        <p><i class="las la-calendar-check"></i> 1992 <small>Birth year</small></p>
                        <p><i class="las la-language"></i> English, Frech, Spanish <small>Languages</small></p> 
                        <p><i class="las la-female"></i> Women <small>Interested in</small></p>
                      </div>  
                    </div>  
                  </div>
                 <!--Contact info display content end-->

                 <!--Family info display content start-->
                 <div class="profile-pstrightabout profile-whitebox" id="family_info_display" style="display:none;">
                    <div class="timeline-postabout">
                     <div class="timeline-pst1">
                         <div class="text-sm-right editsma-btn"><a href="#"><i class="las la-edit"></i> Edit</a></div>
                         <h5 class="small-title3">Relationship</h5>
                         <p><i class="las la-heart"></i> Married</p>
                         <hr>
                          <h5 class="small-title3">Family members</h5>
                        <p><a href="profile-editabout2.html" class="blue-text"><i class="las la-plus-circle"></i> Add a family member</a> </p>
                        <p><span class="user-pic mr-2"><img src="images/lores.jpg" alt="" data-pagespeed-url-hash="3548533874" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span> <a href="#">Josef Buttler</a> <small>Brother</small></p> 
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

                         <!-- <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="about_display_edit();"><i class="las la-edit"></i> Edit</a></div> -->
                        <p> 
                          <div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="studied_at" id="studied_at" class="form-control" placeholder="Studied At" required="">
                          </div>
                          </div>
                        </p>
                        <p>
                          <div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="lives_in" id="lives_in" class="form-control" placeholder="Lives In" required="">
                          </div>
                          </div>
                        </p>  
                        <p> 
                          <div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="from_city" id="from_city" class="form-control" placeholder="From" required="">
                          </div>
                          </div>
                        </p>   
                        <p>
                          <div class="form-group">
                          <div class="contact-form-name">
                            <select name="marital_status" id="marital_status" class="form-control">
                              <option value="">Marital Status</option>
                              <option value="Married">Married</option>
                              <option value="Single">Single</option>
                            </select>
                          </div>
                          </div>
                        </p>
                        <p>
                          <div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="phone_no" id="phone_no" class="form-control" placeholder="Phone" required="">
                          </div>
                          </div>
                        </p> 
                        <hr> 
                        <h5 class="small-title3">About You</h5> 
                        <p>
                          <div class="form-group">
                          <div class="contact-form-name">
                            <textarea name="about_info" id="about_us" class="form-control" placeholder="About You"></textarea>
                          </div>
                          </div>
                        </p> 
                        <hr> 
                        <h5 class="small-title3">Account Info</h5> 
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="first_name" id="first_name" class="form-control" placeholder="First Name" required="">
                          </div>
                          </div></p> 
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required="">
                          </div>
                          </div></p>
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="username" id="username" class="form-control" placeholder="Username" required="">
                          </div>
                          </div></p>
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="email" id="email" class="form-control" placeholder="Email" required="">
                          </div>
                          </div></p>
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="password" id="password" class="form-control" placeholder="Password" required="">
                          </div>
                          </div></p>
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <input type="text" size="30" value="" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode" required="">
                          </div>
                          </div></p>
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <select name="denomination" id="denomination" class="form-control">
                              <option value="Denomination">Denomination</option>
                              <option value="Roman Catholic">Roman Catholic</option>
                            </select>
                          </div>
                          </div></p>
                        <p><div class="form-group">
                          <div class="contact-form-name">
                            <select name="member" id="member" class="form-control">
                              <option value="Member">Member</option>
                              <option value="Other Nonprofit Organization">Other Nonprofit Organization</option>
                              <option value="Schools">Schools</option>
                              <option value="Others">Others</option>
                            </select>
                          </div>
                          </div></p>
                        <div class="form-group">
                          <input type="butto" name="btnSubmitAbout" class="smallcommon-btn" id="quote-submit" value="Save" onclick="updateAboutInfo()"> 
                        </div>
                      </form>
                     </div>  
                    </div>  
                 </div>
                 <!--About display edit content end-->

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