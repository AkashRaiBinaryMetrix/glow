@extends('myuser.layouts.view')
@section('title', 'Events List')
@section('content')
<div class="social-media-page">
  <div class="inner-socialcontainer">

    <div class="row">
      <div class="col-md-12">
          
        <div class="eventpage-sec white-box">
          <div class="social-title">Discover Events</div>
          
          <div class="event-listing-sec">
            <div class="row">
	          @if($aEventsList && count($aEventsList) > 0)
                @foreach ($aEventsList as $aEvents)
                  @php
                       $sCreatedAtTimeStap =  !empty($aEvents->created_at) ? (int) strtotime($aEvents->created_at) : '';
                      /*---------------------- get total users interested in events -----------------------*/
                        $aTotalUsersInterested = !empty($aEvents->id) ? getTotalUsersInterestedInEvents($aEvents->id) : '';
                      /*---------------------- get total users interested in events -----------------------*/

                      /*---------------------- get total users going in events -----------------------*/
                        $aTotalUsersGoing = !empty($aEvents->id) ? getTotalUsersGoingInEvents($aEvents->id) : '';
                      /*---------------------- get total users going in events -----------------------*/ 

                      /*---------------------- check logged in users is interested or not -------------*/
                        $isUserInterested = !empty($aEvents->id) ? isUsersInterestedInEvents($aEvents->id) : '';
                      /*---------------------- check logged in users is interested or not -------------*/
                  @endphp
                  <div class="col-md-4">
                    <div class="mainevent-col">
                      <a href="{{ url('event-detail/'.$aEvents->id) }}">
                        <div class="mainevent-pic"><img src="{{ asset('public/images/events/'.$aEvents->image) }}" alt="" data-pagespeed-url-hash="1704642141" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div></a>
                        <div class="mainevent-content">
                        <a href="{{ url('event-detail/'.$aEvents->id) }}">
                            <div class="event-datetime">
                                <p><i class="las la-calendar"></i> {{!empty($aEvents->created_at) ? date('D', $sCreatedAtTimeStap) : ''}}, {{!empty($aEvents->created_at) ? date('d', $sCreatedAtTimeStap) : ''}} {{!empty($aEvents->created_at) ? date('M', $sCreatedAtTimeStap) : ''}} {{!empty($aEvents->created_at) ? date('Y', $sCreatedAtTimeStap) : ''}} AT {{!empty($aEvents->created_at) ? date('H:i', $sCreatedAtTimeStap) : ''}} </p>
                            </div>
                            <div class="mainevent-title">{{ !empty($aEvents->name) ? $aEvents->name : '' }}</div>
                            <div class="mainevent-location">{{ !empty($aEvents->long_description) ? $aEvents->long_description : '' }}</div>
                          </a>
                            <div class="mainevent-crowd" id="totalUsersIneterstedOrGoing{{$aEvents->id}}">{{!empty($aTotalUsersInterested) ? $aTotalUsersInterested.' interested': ''}}  {{!empty($aTotalUsersGoing) && $aTotalUsersInterested > 0 ? ' - '.$aTotalUsersGoing.' going': ($aTotalUsersGoing > 0 ?  $aTotalUsersGoing.' going' : '') }}</div>
                            @if($isUserInterested > 0)
                                <a href="javascript:void(0)">
                                    <div class="mainevent-link"><i class="lar la-star"></i> Interested</div>
                                </a>
                            @else
                                <a href="javascript:void(0)" onclick="showInterestInEvent({{$aEvents->id}})">
                                  <div class="mainevent-link" id="isUserInterested{{$aEvents->id}}"><i class="lar la-star"></i> Interest</div>
                                </a>
                            @endif
                        </div>
                      
                  </div>	
                  </div>
                @endforeach
            @endif
            
            {{-- <div class="col-md-6">
              <div class="mainevent-col">
                <a href="event-detail.html">
                  <div class="mainevent-pic"><img src="images/event-pic-3.jpg" alt="" data-pagespeed-url-hash="1999142062" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                  <div class="mainevent-content">
                      <div class="event-datetime">
                          <p><i class="las la-calendar"></i> SAT, 30 JUL AT 21:30 UTC+05:30 </p>
                      </div>
                      <div class="mainevent-title">49th Annual Puerto Rican Day Festival of Bristol, PA</div>
                      <div class="mainevent-location">Michigan Union · Ann Arbor, MI</div>
                      <div class="mainevent-crowd">933 interested · 145 going</div>
                      <div class="mainevent-link"><i class="lar la-star"></i> Interested</div>
                  </div>
                </a>
            </div>	
             </div>
                
             <div class="col-md-6">
              <div class="mainevent-col">
                <a href="event-detail.html">
                  <div class="mainevent-pic"><img src="images/event-pic-2.jpg" alt="" data-pagespeed-url-hash="1704642141" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                  <div class="mainevent-content">
                      <div class="event-datetime">
                          <p><i class="las la-calendar"></i> SAT, 30 JUL AT 21:30 UTC+05:30 </p>
                      </div>
                      <div class="mainevent-title">49th Annual Puerto Rican Day Festival of Bristol, PA</div>
                      <div class="mainevent-location">Michigan Union · Ann Arbor, MI</div>
                      <div class="mainevent-crowd">933 interested · 145 going</div>
                      <div class="mainevent-link"><i class="lar la-star"></i> Interested</div>
                  </div>
                </a>
            </div>	
             </div>
            
            <div class="col-md-6">
              <div class="mainevent-col">
                <a href="event-detail.html">
                  <div class="mainevent-pic"><img src="images/event-pic-3.jpg" alt="" data-pagespeed-url-hash="1999142062" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                  <div class="mainevent-content">
                      <div class="event-datetime">
                          <p><i class="las la-calendar"></i> SAT, 30 JUL AT 21:30 UTC+05:30 </p>
                      </div>
                      <div class="mainevent-title">49th Annual Puerto Rican Day Festival of Bristol, PA</div>
                      <div class="mainevent-location">Michigan Union · Ann Arbor, MI</div>
                      <div class="mainevent-crowd">933 interested · 145 going</div>
                      <div class="mainevent-link"><i class="lar la-star"></i> Interested</div>
                  </div>
                </a>
            </div>	
             </div>     --}}
	
        </div>  
            
          </div>    
            
            
        </div><!--eventpage-sec-->
          
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
    function showInterestInEvent(iEventId) {
          if(iEventId!='' && iEventId!=null && iEventId!=undefined) {
                $.ajax({
                      url:sBASEURL+"showInterestInEvent",
                      type:"POST",
                      data:{iEventId,"from":"list","_token":"{{ csrf_token() }}"},
                      success:function(response) {
                          let result = JSON.parse(response);
                          if(result.status == 'success') {
                               $(`#totalUsersIneterstedOrGoing${iEventId}`).html(`${result.sTotalUsersInterestedOrGoing}`);
                               $(`#isUserInterested${iEventId}`).html(`${result.isUserInterested}`);
                               $(`#isUserInterested${iEventId}`).parent('a').removeAttr('onclick');
                          }
                      }
                });
          }
    }
</script>
@endsection