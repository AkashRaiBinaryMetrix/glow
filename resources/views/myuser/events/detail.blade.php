@extends('myuser.layouts.view')
@section('title', 'Event Detail')
@section('content')
@php
    $iUserId  = getLoggedInUserId();
@endphp
<div class="social-media-page">
  <div class="inner-socialcontainer">
    <div class="row">
      <div class="col-md-7 custom-7">
        @php
          $sCreatedAtTimeStap =  !empty($aEventDetail->created_at) ? (int) strtotime($aEventDetail->created_at) : '';
          /*---------------------- get total users interested in events -----------------------*/
              $iTotalUsersInterested = !empty($aEventDetail->id) ? getTotalUsersInterestedInEvents($aEventDetail->id) : '';
          /*---------------------- get total users interested in events -----------------------*/

          /*---------------------- get total users going in events -----------------------*/
              $iTotalUsersGoing = !empty($aEventDetail->id) ? getTotalUsersGoingInEvents($aEventDetail->id) : '';
          /*---------------------- get total users going in events -----------------------*/ 

          /*---------------------- check logged in users is interested or not -------------*/
             $isUserInterested = !empty($aEventDetail->id) ? isUsersInterestedInEvents($aEventDetail->id) : '';
          /*---------------------- check logged in users is interested or not -------------*/

          /*---------------------- check logged in users is interested or not -------------*/
            $isUserGoing = !empty($aEventDetail->id) ? isUsersGoingInEvents($aEventDetail->id) : '';
          /*---------------------- check logged in users is interested or not -------------*/
        @endphp
        <div class="eventpage-sec white-box">          
          <div class="event-detail-sec">
            <div class="event-picdate-col">  
              <div class="event-cover-image"><img src="{{ asset('public/images/events/'.$aEventDetail->image) }}" alt="" data-pagespeed-url-hash="2933105352" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>  
              <div class="detailevent-date">{{ !empty($sCreatedAtTimeStap) ? date('d', $sCreatedAtTimeStap): ''}} <small>{{ !empty($sCreatedAtTimeStap) ? date('M', $sCreatedAtTimeStap): ''}}</small></div>
            </div>  
            
            <div class="event-detail-topcont">
              <div class="mainevent-content">
                      <div class="event-datetime">
                          <p><i class="las la-calendar"></i> {{ !empty($sCreatedAtTimeStap) ? date('D', $sCreatedAtTimeStap): ''}}, {{ !empty($sCreatedAtTimeStap) ? date('d', $sCreatedAtTimeStap): ''}} {{ !empty($sCreatedAtTimeStap) ? date('M', $sCreatedAtTimeStap): ''}} AT {{ !empty($sCreatedAtTimeStap) ? date('H:i', $sCreatedAtTimeStap): ''}} </p>
                      </div>
                      <div class="mainevent-title">{{ !empty($aEventDetail->name) ? $aEventDetail->name : '' }}</div>
                      <div class="mainevent-location"><i class="las la-map-marker-alt"></i> {{ !empty($aEventDetail->long_description) ? $aEventDetail->long_description : '' }}</div>
                  
                      <div class="detailevent-links">
                          @if ($isUserInterested > 0)
                                <a href="javascript:void(0)"><i class="lar la-star"></i> Interested</a>
                             @else 
                                <a href="javascript:void(0)" id="isUserInterested{{$aEventDetail->id}}" onclick="showInterestInEvent({{$aEventDetail->id}})"><i class="lar la-star"></i> Interest</a>
                          @endif
                          @if ($isUserGoing > 0)
                               <a href="javascript:void(0)"><i class="las la-check-circle"></i> Going</a>
                            @else
                               <a href="javascript:void(0)" id="isUserGoing{{$aEventDetail->id}}" onclick="isUserGoingInEvent({{$aEventDetail->id}})"><i class="las la-check-circle"></i> Go</a>
                          @endif
                          
<!--                           <a href="javascript:void(0)"><i class="las la-envelope"></i> Invite</a>
 -->                          <a href="javascript:void(0)" data-toggle="modal" data-target="#invitefrndmodal"><i class="las la-envelope"></i> Invite</a>

                          <a data-a2a-url="{{ url('event-detail/'.$aEventDetail->id) }}" data-a2a-title="{{!empty($aEventDetail->name) ? $aEventDetail->name : ''}}" class="a2a_dd" href="https://www.addtoany.com/share"><i class="las la-share"></i> Share </a>
                          {{-- {!!Share::page(url('event-detail/'.$aEventDetail->id), $aEventDetail->name,["class"=>"social"])
                            ->facebook()
                            ->twitter()
                            ->linkedin()
                            ->whatsapp()
                            ->telegram()
                            ->reddit();
                          !!} --}}
                      </div>
                  
                     <div class="detailguest-col">
                      <div class="subhead3">Guests</div>
                      <div class="detailguest-2">
                        <div class="row">
                          <div class="col"><div class="instpeop" id="going"><strong>{{ !empty($iTotalUsersGoing) ? $iTotalUsersGoing : 0}}</strong> Going</div></div>
                          <div class="col"><div class="instpeop" id="interested"><strong>{{ !empty($iTotalUsersInterested) ? $iTotalUsersInterested : 0}}</strong> Interested</div></div>    
                        </div>    
                      </div>      
                     </div>
                  </div>  
            </div>  
              
            {{-- <div class="detailhost-col">
                      <div class="subhead3">Meet your host</div>
                      <div class="detailmeet-host">
                        <div class="mainevent-col">
                <a href="event-detail.html">
                  <div class="mainevent-pic"><img src="images/event-pic-2.jpg" class="img-responsive" alt="" data-pagespeed-url-hash="1704642141" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
                  <div class="mainevent-content">
                      <div class="mainevent-title">Puerto Rican Cultural Association of Bucks County</div>
                      <div class="mainevent-location">18 past events · 1,935 likes</div>
                      <div class="mainevent-crowd">Our 49th Puerto Rican Festival will be held on July 30, 2022 (Rain Date July 31, 2022)</div>
                      <div class="mainevent-link"><img src="images/like-ico.png" alt="" data-pagespeed-url-hash="1279223300" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Like</div>
                  </div>
                </a>
            </div>    
                      </div>      
                     </div> --}}
              
          </div>     
        </div><!--eventpage-sec-->
          
      </div><!--col-md-7-->
        
        
      <div class="col-md-5 custom-5">
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
          <div class="social-event-share" data-a2a-url="{{ url('event-detail/'.$aEvent->id) }}" data-a2a-title="{{!empty($aEvent->name) ? $aEvent->name : ''}}"><a class="a2a_dd" href="https://www.addtoany.com/share"><img src="{{ asset('images/share-icon.png') }}" alt="" data-pagespeed-url-hash="323690004" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> Share 
           
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
      <form class="invitefrnd-form" name="cform" action="{{ url('send_invitation_event') }}" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="form-group search-form">
          <input type="hidden" name="event_id" value="{{$iEventId}}">
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
  function showInterestInEvent(iEventId) {
        if(iEventId!='' && iEventId!=null && iEventId!=undefined) {
              $.ajax({
                    url:sBASEURL+"showInterestInEvent",
                    type:"POST",
                    data:{iEventId,"from":"detail","_token":"{{ csrf_token() }}"},
                    success:function(response) {
                        let result = JSON.parse(response);
                        if(result.status == 'success') {
                             $(`#interested`).html(`${result.sTotalUsersInterested}`);
                             $(`#isUserInterested${iEventId}`).html(`<i class="lar la-star"></i> Interested`);
                             $(`#isUserInterested${iEventId}`).removeAttr('onclick');
                        }
                    }
              });
        }
  }
  function isUserGoingInEvent(iEventId) {
        if(iEventId!='' && iEventId!=null && iEventId!=undefined) {
              $.ajax({
                    url:sBASEURL+"isUserGoingInEvent",
                    type:"POST",
                    data:{iEventId,"_token":"{{ csrf_token() }}"},
                    success:function(response) {
                        let result = JSON.parse(response);
                        if(result.status == 'success') {
                             $(`#going`).html(`${result.iTotalUsersGoing}`);
                             $(`#isUserGoing${iEventId}`).html(`<i class="lar la-star"></i> Going`);
                             $(`#isUserGoing${iEventId}`).removeAttr('onclick');
                        }
                    }
              });
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