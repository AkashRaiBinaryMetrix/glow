@extends('myuser.layouts.view')
@section('title', 'Group Detail')
@section('content')

@php
    $iUserId = getLoggedInUserId();
    $sCreatedAtTimeStap =  !empty($aGroupDetail->created_at) ? (int) strtotime($aGroupDetail->created_at) : '';
@endphp

<div class="social-media-page">
  <div class="inner-socialcontainer">
    <div class="row">
      <div class="col-md-7 custom-7">
          
        <div class="eventpage-sec white-box">          
          <div class="event-detail-sec">
            <div class="event-picdate-col">  
              <div class="event-cover-image"><img src="{{ asset('public/images/groups/'.$aGroupDetail->image) }}" alt=""></div>  
              <div class="detailevent-date">{{ !empty($sCreatedAtTimeStap) ? date('d', $sCreatedAtTimeStap): '' }} <small>{{ !empty($sCreatedAtTimeStap) ? date('M', $sCreatedAtTimeStap): '' }}</small></div>
            </div>  
            @php
                       
                      /*----------------------- check this is created by user or joined group ------------------------*/
                          $isGroupCreatedByUserOrJoinedByUser = NO;
                          $iTotalGroupCreatedByLoggedInUsers = 0;
                       if($iUserId == $aGroupDetail->user_id) {
                           $isGroupCreatedByUserOrJoinedByUser = YES;
                           $iTotalGroupCreatedByLoggedInUsers++;
                       } else {
                           $isUserJoinedGroup = getRowByMultipleCondition('users_joined_group',[['user_id',$iUserId],['group_id',$aGroupDetail->id]]);
                           if(!empty($isUserJoinedGroup)) {
                             $isGroupCreatedByUserOrJoinedByUser = YES;
                           }
                           $iTotalGroupCreatedByLoggedInUsers = 1;
                       }
                      /*----------------------- check this is created by user or joined group ------------------------*/
                      
                      /*----------------------- get total numbers of joined group users ------------------------------*/
                       $iTotalUsersJoinedGroups = getTotalUsersJoinedGroups($aGroupDetail->id);
                       $iTotalUsersJoinedGroups = $iTotalUsersJoinedGroups+$iTotalGroupCreatedByLoggedInUsers;
                      /*----------------------- get total numbers of joined group users ------------------------------*/
                 @endphp
            <div class="event-detail-topcont">
              <div class="mainevent-content">
                      <div class="mainevent-title">{{ !empty($aGroupDetail->name) ? $aGroupDetail->name : ''}}</div>
                      <div class="mainevent-location" id="totalGroupMembers{{$aGroupDetail->id}}"><i class="las la-map-marker-alt"></i> {{ !empty($aGroupDetail->group_type) ? $aGroupDetail->group_type : ''}} group · {{ !empty ($iTotalUsersJoinedGroups) ? formatNumber($iTotalUsersJoinedGroups) : ''}}</div>

                      <div class="mainevent-location">{{$aGroupDetail->group_category}}</div>
                  
                      <div class="detailevent-links">
                          <a href="javascript:void(0)" onclick="joinGroup({{$aGroupDetail->id}})" id="joinedGroup{{$aGroupDetail->id}}"><i class="lar la-star"></i> {{$isGroupCreatedByUserOrJoinedByUser && $isGroupCreatedByUserOrJoinedByUser == YES ? 'Joined' : 'Join Group'}}</a>
                          <!-- <a href="javascript:void(0)"><i class="las la-envelope"></i> Invite</a> -->
                          <a href="javascript:void(0)" data-toggle="modal" data-target="#invitefrndmodal"><i class="las la-envelope"></i> Invite</a>

                          <a class="a2a_dd" href="https://www.addtoany.com/share"><i class="las la-share"></i> Share </a>
                          {{-- {!!Share::page(url('group-detail/'.$aGroupDetail->id), $aGroupDetail->name,["class"=>"social"])
                            ->facebook()
                            ->twitter()
                            ->linkedin()
                            ->whatsapp()
                            ->telegram()
                            ->reddit();
                          !!} --}}
                      </div>
                  </div>  
                
                <div class="aboutgrup-detail">
                  <div class="subhead3">About this group</div>
                  
                  <div class="aboutgrup-txt">
                      <div class="aboutgrup-para">{{ !empty($aGroupDetail->description) ? $aGroupDetail->description : '' }}</div>
                      {{-- <div class="aboutgrup-web"><i class="las la-globe"></i> Website - www.roamlikehippy.com</div>
                      <div class="aboutgrup-email"><i class="las la-envelope"></i> Email id - Hippycare@roamlikehippy.com</div> --}}
                      
                      <div class="aboutgrup-public"><i class="las la-globe"></i> <strong>{{ !empty($aGroupDetail->group_type) ? $aGroupDetail->group_type : ''}}</strong></div>
                      
                  </div>    
                    
                </div>
                
            </div>  
              
            {{-- <div class="group-details-innersec">
              <div class="newsfeed-sec">
               
             <div class="newsfeed-tophead">     
			   <div class="newsfeed-top-sec">
			     <div class="news-userpic"><img src="images/newsuserpic.png" alt=""></div>
				 <div class="newsfeed-text"><h3><a href="#">Tammy Olson</a> <span> shared a</span> <a href="#">Travel Himachal Pradesh</a></h3> <p>Yesterday at 3:21 PM</p></div>
			   </div>
                      
			   <div class="newsfeed-arrow">
                   <div class="dropdown">
						  <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							 <img src="images/event-arrow-icon.png" alt="">
						  </button>
						  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 22px, 0px);">
							<a class="dropdown-item" href="#"><i class="las la-eye-slash"></i> Hide</a>
							<a class="dropdown-item" href="#"><i class="las la-flag"></i> Report</a>
						  </div>
						</div>
                 </div>
                 
               </div><!--newsfeed-tophead-->  
                 
               <div class="newsfeed-desc"><p>One of GLOW’s mission is to “Inspire Christians to fellowship and strengthentheir relationship with our amazing Lord Jesus Christ by empowering the Holy Spirit</p></div>
                 
			   <div class="newsfeed-mainpic"><img src="images/newsfeed-pic.jpg" alt=""></div>
			   
			   <div class="newsfeed-licosh-col">
			    <div class="feednewlikes"><a href="#"><img src="images/like-ico.png" alt=""> <span>Like</span></a> </div>
                <div class="feednewcomment"><a href="#"><img src="images/comment-ico.png" alt=""> <span>Comments</span></a> </div>
                <div class="feednewprayer"><a href="#"><img src="images/prayer-icon.png" alt=""> <span>Prayer</span></a> </div>
                <div class="feednewshare"><a href="#"><img src="images/post-share-ico.png" alt="">  <span>Shares</span></a> </div>   
			   </div>
                 
               <div class="feed-maincomment-sec">
			   
               <div class="newsfeed-liked-col">
			     <div class="row align-items-center">
				   <div class="col-6"><div class="totalshares">195 shares </div></div>
				   <div class="col-6 text-right"><div class="totalcomenshare">102 comments </div></div>
				 </div>
			   </div>       
                   
			   <div class="feednew-comment">
			     <div class="exis-userpic"><img src="images/newsuserpic.png" alt=""></div>
				 <div class="feed-usercomment"><input type="text" name="comment" placeholder="Write a comment..." class="form-control">
			     </div>
			 </div>
                   
              <div class="newsfeed-liked-col">
			     <div class="row align-items-center">
				   <div class="col-6"><div class="totalshares"><a href="#">View previous comments</a> </div></div>
				   <div class="col-6 text-right"><div class="totalcomenshare">2 of 150 </div></div>
				 </div>
			   </div>
                   
               <div class="newsfeed-usercoments">
                 <div class="newsfeed-commenting-userpic"><a href="#"><img src="images/user-1.jpg" alt=""></a></div>    
                   <div class="newsfeed-commenting-comments">
                    <div class="commenting-comments1"><a href="#">John Bryant</a> <a href="#">Adam,</a><span> we need to move asap!</span></div>
                       
                     <div class="commenting-comments2">
                         <a href="#">Like</a>
                         <a href="#">Reply</a>
                         <a href="#"><img src="images/like-ico-blue.png" alt=""> 1</a>
                         <span> March 21 at 4:32pm</span>
                      </div>
                      
                      <div class="newsfeed-commenting-rply">
                     <div class="rplyicon"><a href="#"><img src="images/reply-icon.png" alt=""> 1 Reply</a></div>
                   </div>   
                       
                   </div>
               </div><!--newsfeed-usercoments-->   
                   
               <div class="newsfeed-usercoments">
                 <div class="newsfeed-commenting-userpic"><a href="#"><img src="images/user-2.jpg" alt=""></a></div>    
                   <div class="newsfeed-commenting-comments">
                    <div class="commenting-comments1"><a href="#">Sophia Holden</a> <a href="#">Angie Walters</a></div>
                       
                     <div class="commenting-comments2">
                         <a href="#">Like</a>
                         <a href="#">Reply</a>
                         <span> March 21 at 4:34pm</span>
                      </div>    
                   </div>
               </div><!--newsfeed-usercoments-->    
		   
             </div><!--feed-comment-main-->     
                 
                 
		   </div>
              
              
            </div> --}}
              
          </div>     
        </div><!--eventpage-sec-->
          
      </div><!--col-md-7-->
        
        
      <div class="col-md-5 custom-5">
        <div class="social-group-sec white-box">
          <div class="social-head">
            <img src="images/social-group-ico.png" alt="" data-pagespeed-url-hash="1056036" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
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
              <div class="aside-groups-title">{{ !empty($aGroup->name) ? $aGroup->name : ''}} <span class="event-post-time">Last active &bull; {{ $sPosted }}</span></div></a>
            </div>
            @endforeach
          @endif
            </div>   
          </div>
            
        </div><!--social-group-sec-->
          
       
          
        @if($aEventsList && count($aEventsList) > 0)  
        <div class="social-event-sec white-box">
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
            <div class="event-user"><img src="{{ !empty($sLoggedInUserProfileImage) ? asset('images/profile/'.$sLoggedInUserProfileImage) : asset('images/avtar1.png') }}" alt="" data-pagespeed-url-hash="2771137919" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
            <div class="event-title">{{!empty($aEvent->name) ? $aEvent->name : ''}} <span class="event-post-time">{{$sPosted}} <img src="{{ asset('images/event-dot.jpg') }}" alt="" data-pagespeed-url-hash="3392945715" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span></div>
            
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
          <div class="social-event-share"><a class="a2a_dd" href="https://www.addtoany.com/share"><img src="{{ asset('images/share-icon.png') }}" alt="" data-pagespeed-url-hash="323690004" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Share 
            {{-- {!!Share::page(url('inspirational-feed'), $aEvent->name,["class"=>"social","id"=>'EventShare_'.$aEvent->id])
              ->facebook()
              ->twitter()
              ->linkedin()
              ->whatsapp()
              ->telegram()
              ->reddit();
            !!} --}}
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

<!-----Invite modal-----> 
<div class="modal fade common-modal" id="invitefrndmodal" tabindex="-1" role="dialog" aria-labelledby="invitefrndmodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="las la-times"></i></span>
        </button>
      <div class="modal-body p-0">
         <div class="login-wrapper">
      <div class="login-form-col">
        <h1>Invite friends to this group</h1>
      <form class="invitefrnd-form" name="cform" action="{{ url('send_invitation') }}" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="form-group search-form">
          <input type="hidden" name="group_id" value="{{$groupIdCheck}}">
<input type="text" class="form-control" name="" id="search_user_invite" onkeyup="searchUserInvite();" placeholder="Search...">
                   <button type="submit" class="search-ico"><i class="las la-search"></i></button>      
                </div>
                <div class="invitefrnd-list-col" id="invitefrnd-list-col-1">
                  @foreach($userDetails as $userDetailsResult)
                  @php
                    $final_name = str_replace("_*_"," ",$userDetailsResult->name);
                  @endphp
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="" id="group_invite_checkbox" name="group_invite_checkbox[]" value="{{$userDetailsResult->email}}">
                   <span class="invitefrnd-pic"><img src="{{ !empty($userDetailsResult->profile_pic) ? asset('images/profile/'.$userDetailsResult->profile_pic) : asset('images/dummy.png') }}" alt=""></span> {{$final_name}}
                  </div>
                  @endforeach
                </div> 
                <div class="invitefrnd-list-col" id="invitefrnd-list-col-2" style="display:none;"></div>
         <div class="form-group">
                <input type="reset" name="cancel" class="common-btn common-btn2" id="invitefrnd-cancel" value="Cancel" data-dismiss="modal" aria-label="Close">      
        <input type="submit" name="submit" class="common-btn" id="invitefrnd-submit" value="Send Invitations"> 
        </div>
        </form>   
      </div>
     </div>
      </div>
    </div>
  </div>
</div> 
<!-----Invite modal----->    

<script>
    function joinGroup(iGroupId) {
          if(iGroupId!='' && iGroupId!=null && iGroupId!=undefined) {
                $.ajax({
                      url:sBASEURL+"joinGroup",
                      type:"POST",
                      data:{iGroupId,"from":"detail","_token":"{{ csrf_token() }}"},
                      success:function(response) {
                          let result = JSON.parse(response);
                          if(result.status == 'success') {
                               $(`#totalGroupMembers${iGroupId}`).html(`<i class="las la-map-marker-alt"></i> ${result.iTotalGroupMember}`);
                               $(`#joinedGroup${iGroupId}`).html(`<i class="lar la-star"></i> Joined`);
                               $(`#joinedGroup${iGroupId}`).removeAttr('onclick');
                          }
                      }
                });
          }
    }
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
@endsection
