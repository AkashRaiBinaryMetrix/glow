@extends('myuser.layouts.view')
@section('title', 'Groups List')
@section('content')
<div class="social-media-page">
  <div class="inner-socialcontainer">

    <div class="row">
      <div class="col-md-12">
         <div class="groupslisting-page"> 
        <div class="eventpage-sec white-box">
          <div class="social-title">All Groups</div>
          
          <div class="groups-allbtns"><a href="{{ url('groups-list') }}" class="active-group">Joined</a> <a href="{{ url('discover-groups-list') }}">Discover</a></div>    
            
          <div class="event-listing-sec">
            <div class="row">
	          @if (!empty($aGroupLists))
               @php
                 $iUserId = getLoggedInUserId();
               @endphp

               @foreach ($aGroupLists as $aGroup)
               @php
                       
                      /*----------------------- check this is created by user or joined group ------------------------*/
                          $isGroupCreatedByUserOrJoinedByUser = NO;
                          $iTotalGroupCreatedByLoggedInUsers = 0;
                       if($iUserId == $aGroup->user_id) {
                           $isGroupCreatedByUserOrJoinedByUser = YES;
                           $iTotalGroupCreatedByLoggedInUsers++;
                       } else {
                           $isUserJoinedGroup = getRowByMultipleCondition('users_joined_group',[['user_id',$iUserId],['group_id',$aGroup->id]]);
                           if(!empty($isUserJoinedGroup)) {
                             $isGroupCreatedByUserOrJoinedByUser = YES;
                           }
                           $iTotalGroupCreatedByLoggedInUsers = 1;
                       }
                      /*----------------------- check this is created by user or joined group ------------------------*/
                      
                      /*----------------------- get total numbers of joined group users ------------------------------*/
                       $iTotalUsersJoinedGroups = getTotalUsersJoinedGroups($aGroup->id);
                       $iTotalUsersJoinedGroups = $iTotalUsersJoinedGroups+$iTotalGroupCreatedByLoggedInUsers;
                      /*----------------------- get total numbers of joined group users ------------------------------*/
                 @endphp
                  <div class="col-md-4">
                      <div class="mainevent-col">
                        <a href="{{ url('group-detail/'.$aGroup->id) }}">
                          <div class="mainevent-pic"><img src="{{ asset('public/images/groups/'.$aGroup->image) }}" alt="" data-pagespeed-url-hash="791246335" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                          <div class="mainevent-content">
                              <div class="mainevent-title">{{ !empty($aGroup->name) ? $aGroup->name : ''}}</div>
                              <div class="mainevent-crowd" id="totalGroupMembers{{$aGroup->id}}">
                                {{ !empty ($iTotalUsersJoinedGroups) ? formatNumber($iTotalUsersJoinedGroups) : ''}}
                                {{-- 249K members • 10+ posts a day --}}
                              </div>
                          </div>
                        </a>
                        <a href="javascript:void(0)"><div onclick="joinGroup({{$aGroup->id}})" class="mainevent-link" id="joinedGroup{{$aGroup->id}}">{{$isGroupCreatedByUserOrJoinedByUser && $isGroupCreatedByUserOrJoinedByUser == YES ? 'Joined' : 'Join Group'}}</div></a>
                    </div>	
                  </div>
               @endforeach
            @endif
           </div>     
        </div>          
      </div><!--eventpage-sec-->
    </div>          
</div><!--col-md-7-->
        
        
      {{-- <div class="col-md-5 custom-5">
        <div class="social-group-sec white-box">
          <div class="social-head">
            <img src="images/social-group-ico.png" alt="" data-pagespeed-url-hash="1056036" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
            <h3>Group <span>Suggetd for you</span></h3>  
          </div> 
            
          <div class="social-group-btn"><div class="view-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#creategrupmodal"><i class="las la-plus"></i> Create New Group</a></div></div>
          
          <div class="asidegroups-list">
            <div class="aside-groups-subtitle">Groups you've joined</div>
            <div class="inner-asidegroups-list"> 
               <div class="aside-groups-col">
                <a href="#">
              <div class="aside-groups-pic"><img src="images/group-1.jpg" alt="" data-pagespeed-url-hash="624115584" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="aside-groups-title">Indian Generation <span class="event-post-time">Last active &bull; 37 weeks ago</span></div></a>
            </div>
              
               <div class="aside-groups-col">
                <a href="#">
              <div class="aside-groups-pic"><img src="images/group-2.jpg" alt="" data-pagespeed-url-hash="918615505" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="aside-groups-title">Graphics Design and Pics <span class="event-post-time">Last active &bull; 3 years ago</span></div></a>
            </div>  
  
               <div class="aside-groups-col">
                <a href="#">
              <div class="aside-groups-pic"><img src="images/group-3.jpg" alt="" data-pagespeed-url-hash="1213115426" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="aside-groups-title">3D Visualizer <span class="event-post-time">Last active &bull; 37 weeks ago</span></div></a>
            </div>
              
               <div class="aside-groups-col">
                <a href="#">
              <div class="aside-groups-pic"><img src="images/group-4.jpg" alt="" data-pagespeed-url-hash="1507615347" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="aside-groups-title">Easy learning PHP Tips & library <span class="event-post-time">Last active &bull; 37 weeks ago</span></div></a>
            </div>
              
               <div class="aside-groups-col">
                <a href="#">
              <div class="aside-groups-pic"><img src="images/group-5.jpg" alt="" data-pagespeed-url-hash="1802115268" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="aside-groups-title">Digital /Online marketing strategy <span class="event-post-time">Last active &bull; 37 weeks ago</span></div></a>
            </div>  
            </div>   
          </div>
            
        </div><!--social-group-sec-->
          
       
          
        <div class="social-event-sec white-box">
            
          <div class="social-event-head">
            <div class="event-user"><img src="images/event-profile.jpg" alt="" data-pagespeed-url-hash="2771137919" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
            <div class="event-title">Brittany Edwards, Jean Wright and 2 others are interested in an event. <span class="event-post-time">3 hrs <img src="images/event-dot.jpg" alt="" data-pagespeed-url-hash="3392945715" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></span></div>
            
            <div class="events-arrow">
                   <div class="dropdown">
						  <button type="button" class="dropdown-toggle" data-toggle="dropdown">
							 <img src="images/event-arrow-icon.png" alt="" data-pagespeed-url-hash="603205129" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
						  </button>
						  <div class="dropdown-menu">
							<a class="dropdown-item" href="#"><i class="las la-eye-slash"></i> Hide</a>
							<a class="dropdown-item" href="#"><i class="las la-flag"></i> Report</a>
						  </div>
						</div>
                 </div>  
              
          </div>
            
          <div class="social-event-col"><a href="#">
            <div class="social-event-main"><img src="images/event-pic.jpg" class="img-responsive" alt="" data-pagespeed-url-hash="857254988" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              
            <div class="social-event-details">
              
             <div class="eventmain-time">20 <span>jan</span></div>
             <div class="event-maintitle">
                <h3>Winter Career Expo</h3>
                <h4>Michigan Union · Ann Arbor, MI</h4>
                <p>628 People are interested</p>
             </div>
            <div class="events-maincalender"><img src="images/calender-icon.png" alt="" data-pagespeed-url-hash="4013489801" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
            </div>  
          </a></div>    
          <div class="social-event-share"><a href="#"><img src="images/share-icon.png" alt="" data-pagespeed-url-hash="323690004" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Share</a></div>
           
          <div class="common-box"><a href="event-page.html" class="smallcommon-btn">View All</a></div>    
            
        </div><!--social-group-sec-->  
          
          
      </div><!--col-md-5--> --}}
    </div>
      
      
      
  </div>      
</div>
<script>
    function joinGroup(iGroupId) {
          if(iGroupId!='' && iGroupId!=null && iGroupId!=undefined) {
                $.ajax({
                      url:sBASEURL+"joinGroup",
                      type:"POST",
                      data:{iGroupId,"from":"list","_token":"{{ csrf_token() }}"},
                      success:function(response) {
                          let result = JSON.parse(response);
                          if(result.status == 'success') {
                               $(`#totalGroupMembers${iGroupId}`).html(`${result.iTotalGroupMember}`);
                               $(`#joinedGroup${iGroupId}`).html(`Joined`);
                               $(`#joinedGroup${iGroupId}`).removeAttr('onclick');
                          }
                      }
                });
          }
    }
</script>
@endsection