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
                      @foreach ($userAboutData as $userAboutDataResult)
                         <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="about_display_edit();"><i class="las la-edit"></i> Edit</a></div>
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
                         <!-- <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="education_display_edit();"><i class="las la-edit"></i> Edit</a></div> -->
                         <h5 class="small-title3">Work</h5>
                        <p><a href="javascript:void(0)" onclick="education_display_edit();" class="blue-text"><i class="las la-plus-circle"></i> Add a workplace/education</a> </p>
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
                         <!-- <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="education_display_edit();"><i class="las la-edit"></i> Edit</a></div> -->
                         <h5 class="small-title3">Places Lived</h5>
                        <p><a href="javascript:void(0)" onclick="places_display_edit();" class="blue-text"><i class="las la-plus-circle"></i> Add city</a> </p>
                         @foreach ($userEducationData as $userEducationDataResult)
                         <p>
                          <i class="las la-map-marker"></i> 
                          Went to {{$userEducationDataResult->description}} <small>Completion year {{$userEducationDataResult->completion_year}} | <a href="javascript:void(0)" class="blue-text" data-toggle="modal" data-target="#editEducationModal" onclick="modal_education({{$userEducationDataResult->id}});"><i class="las la-pen"></i></a>&nbsp;<a href="javascript:void(0)" onclick="delete_education({{$userEducationDataResult->id}});" class="blue-text"><i class="las la-trash"></i></a></small>
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
                        @foreach ($userAboutData as $userAboutDataResult)
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                         <!-- <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="about_display_edit();"><i class="las la-edit"></i> Edit</a></div> -->
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
                         <!-- <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="about_display_edit();"><i class="las la-edit"></i> Edit</a></div> -->
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
                      <form action="" method="post" id="work_edu_display_edit_form">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                         <!-- <div class="text-sm-right editsma-btn"><a href="javascript:void(0)" onclick="about_display_edit();"><i class="las la-edit"></i> Edit</a></div> -->
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

<!--Edit education/work modal start-->
<div class="modal fade" id="editEducationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit workplace/education</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="profile-pstrightabout profile-whitebox">
                    <div class="timeline-postabout">
                     <div class="timeline-pst1">
                      <form action="" method="post" id="work_edu_display_edit_form">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <p>
                          <div class="form-group">
                          <div class="contact-form-name">
                            <select name="type_modal" id="type_modal" class="form-control">
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
                            <textarea name="edu_description_modal" id="edu_description_modal" class="form-control" placeholder="Description"></textarea>
                          </div>
                          </div>
                        </p>
                        <p> 
                          <div class="form-group">
                          <div class="contact-form-name">
                            <input type="date" size="30" name="joining_year_modal" id="joining_year_modal" class="form-control" placeholder="Joining Year" required="">
                          </div>
                          </div>
                            </p> 
                        <p><div class="form-group">
                          <div class="contact-form-name">
                          <p> 
                          <div class="form-group">
                          <div class="contact-form-name">
                            <input type="date" size="30" name="completion_year_modal" id="completion_year_modal" class="form-control" placeholder="Completion Year" required="">
                          </div>
                          </div>
                            </p>
                          </div>
                          </div></p>
                      </form>
                     </div>  
                    </div>  
                 </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="education_id" id="education_id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="educationModalDataUpdate();">Update</button>
      </div>
    </div>
  </div>
</div>
<!--Edit education/work modal start-->