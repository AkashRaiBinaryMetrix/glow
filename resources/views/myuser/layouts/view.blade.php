<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}">
    @php
        $sCURL = Request::segment(1);
        $sBaseURL = '';
        $sTitle = '';
        $sImage = '';
        $sDescription = '';
        if($sCURL && $sCURL == 'group-detail') {
             $sTitle = !empty($aGroupDetail->name) ? $aGroupDetail->name : '';
             $sImage = !empty($aGroupDetail->image) ? asset('public/images/groups/'.$aGroupDetail->image) : '';
             $sDescription = !empty($aGroupDetail->description) ? $aGroupDetail->description : '';
             $sBaseURL = BASE_URL.'group-detail/'.$aGroupDetail->id;
        } else if($sCURL && $sCURL == 'event-detail') {
             $sTitle = !empty($aEventDetail->name) ? $aEventDetail->name : '';
             $sImage = !empty($aEventDetail->image) ? asset('public/images/events/'.$aEventDetail->image) : '';
             $sDescription = !empty($aEventDetail->description) ? $aEventDetail->description : '';
             $sBaseURL = BASE_URL.'event-detail/'.$aEventDetail->id;
        } else {
             $sBaseURL = BASE_URL;
        }
       
    @endphp
    <title>{{ SITE_NAME }} | @if(!empty($sTitle)) {{ $sTitle }} @else @yield('title') @endif </title>
    <meta property="og:title" content="{{$sTitle}}"/>
    <meta property="og:image" content="{{$sImage}}"/>
    <meta property="og:url" content="{{$sBaseURL}}"/>
    <meta property="og:description" content="{{$sDescription}}"/>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">	
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/developer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/my_custom.css') }}" />
        <link rel="stylesheet" href="{{asset('css/simple-lightbox.css')}}">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        let sBASEURL = '<?php echo BASE_URL; ?>';
    </script>


</head>

<body>
    @if(empty($sCURL))
       <div class="homepage-header">  
    @endif
    <header class="main-header">
        <div class="container">    
            
        <nav class="navbar navbar-expand-lg p-0 align-items-center">
        
        <a class="navbar-brand" href="{{url('/')}}"> <div class="logo"><script data-pagespeed-no-defer>//<![CDATA[
        (function(){for(var g="function"==typeof Object.defineProperties?Object.defineProperty:function(b,c,a){if(a.get||a.set)throw new TypeError("ES3 does not support getters and setters.");b!=Array.prototype&&b!=Object.prototype&&(b[c]=a.value)},h="undefined"!=typeof window&&window===this?this:"undefined"!=typeof global&&null!=global?global:this,k=["String","prototype","repeat"],l=0;l<k.length-1;l++){var m=k[l];m in h||(h[m]={});h=h[m]}var n=k[k.length-1],p=h[n],q=p?p:function(b){var c;if(null==this)throw new TypeError("The 'this' value for String.prototype.repeat must not be null or undefined");c=this+"";if(0>b||1342177279<b)throw new RangeError("Invalid count value");b|=0;for(var a="";b;)if(b&1&&(a+=c),b>>>=1)c+=c;return a};q!=p&&null!=q&&g(h,n,{configurable:!0,writable:!0,value:q});var t=this;function u(b,c){var a=b.split("."),d=t;a[0]in d||!d.execScript||d.execScript("var "+a[0]);for(var e;a.length&&(e=a.shift());)a.length||void 0===c?d[e]?d=d[e]:d=d[e]={}:d[e]=c};function v(b){var c=b.length;if(0<c){for(var a=Array(c),d=0;d<c;d++)a[d]=b[d];return a}return[]};function w(b){var c=window;if(c.addEventListener)c.addEventListener("load",b,!1);else if(c.attachEvent)c.attachEvent("onload",b);else{var a=c.onload;c.onload=function(){b.call(this);a&&a.call(this)}}};var x;function y(b,c,a,d,e){this.h=b;this.j=c;this.l=a;this.f=e;this.g={height:window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight,width:window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth};this.i=d;this.b={};this.a=[];this.c={}}function z(b,c){var a,d,e=c.getAttribute("data-pagespeed-url-hash");if(a=e&&!(e in b.c))if(0>=c.offsetWidth&&0>=c.offsetHeight)a=!1;else{d=c.getBoundingClientRect();var f=document.body;a=d.top+("pageYOffset"in window?window.pageYOffset:(document.documentElement||f.parentNode||f).scrollTop);d=d.left+("pageXOffset"in window?window.pageXOffset:(document.documentElement||f.parentNode||f).scrollLeft);f=a.toString()+","+d;b.b.hasOwnProperty(f)?a=!1:(b.b[f]=!0,a=a<=b.g.height&&d<=b.g.width)}a&&(b.a.push(e),b.c[e]=!0)}y.prototype.checkImageForCriticality=function(b){b.getBoundingClientRect&&z(this,b)};u("pagespeed.CriticalImages.checkImageForCriticality",function(b){x.checkImageForCriticality(b)});u("pagespeed.CriticalImages.checkCriticalImages",function(){A(x)});function A(b){b.b={};for(var c=["IMG","INPUT"],a=[],d=0;d<c.length;++d)a=a.concat(v(document.getElementsByTagName(c[d])));if(a.length&&a[0].getBoundingClientRect){for(d=0;c=a[d];++d)z(b,c);a="oh="+b.l;b.f&&(a+="&n="+b.f);if(c=!!b.a.length)for(a+="&ci="+encodeURIComponent(b.a[0]),d=1;d<b.a.length;++d){var e=","+encodeURIComponent(b.a[d]);131072>=a.length+e.length&&(a+=e)}b.i&&(e="&rd="+encodeURIComponent(JSON.stringify(B())),131072>=a.length+e.length&&(a+=e),c=!0);C=a;if(c){d=b.h;b=b.j;var f;if(window.XMLHttpRequest)f=new XMLHttpRequest;else if(window.ActiveXObject)try{f=new ActiveXObject("Msxml2.XMLHTTP")}catch(r){try{f=new ActiveXObject("Microsoft.XMLHTTP")}catch(D){}}f&&(f.open("POST",d+(-1==d.indexOf("?")?"?":"&")+"url="+encodeURIComponent(b)),f.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),f.send(a))}}}function B(){var b={},c;c=document.getElementsByTagName("IMG");if(!c.length)return{};var a=c[0];if(!("naturalWidth"in a&&"naturalHeight"in a))return{};for(var d=0;a=c[d];++d){var e=a.getAttribute("data-pagespeed-url-hash");e&&(!(e in b)&&0<a.width&&0<a.height&&0<a.naturalWidth&&0<a.naturalHeight||e in b&&a.width>=b[e].o&&a.height>=b[e].m)&&(b[e]={rw:a.width,rh:a.height,ow:a.naturalWidth,oh:a.naturalHeight})}return b}var C="";u("pagespeed.CriticalImages.getBeaconData",function(){return C});u("pagespeed.CriticalImages.Run",function(b,c,a,d,e,f){var r=new y(b,c,a,e,f);x=r;d&&w(function(){window.setTimeout(function(){A(r)},0)})});})();pagespeed.CriticalImages.Run('/mod_pagespeed_beacon','https://binarymetrix.in/glow/inspirational-feed.html','oG-7lxx8_G',true,false,'75s15wpqPQM');
        //]]></script><img src="{{ asset('images/logo.png') }}" alt="" data-pagespeed-url-hash="1514387616" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="las la-bars "></span></button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        
        <ul class="navbar-nav">
        <li class="nav-item {{ Request::segment(1) == 'testimony' ? 'active': ''}}"><a class="nav-link" href="{{url('testimony')}}">Testimony</a></li>
        <li class="nav-item {{ Request::segment(1) == 'holy-spirit' ? 'active': ''}}"><a class="nav-link" href="{{url('holy-spirit')}}">Holy Spirit</a></li>
        <li class="nav-item {{ Request::segment(1) == 'inspirational-feed' ? 'active': ''}}"><a class="nav-link" href="{{url('inspirational-feed')}}">Inspirational Feed</a></li>		
        <li class="nav-item {{ Request::segment(1) == 'tips' ? 'active': ''}}"><a class="nav-link" href="{{ url('godluv-tips') }}">Tips</a></li>
        <li class="nav-item {{ Request::segment(1) == 'give' ? 'active': ''}}"><a class="nav-link" href="{{ url('give') }}">Give</a></li>		
        </ul>
        
        @if (Session::has('isUserLoggedIn'))
           @php
               $iUserId  = getLoggedInUserId();
               $sLoggedInUserProfileImage = getValueByColumnNameAndId('users','id',$iUserId,'profile_pic');
           @endphp
           <div class="menu-ham-ico">
            <div class="top-notify"><img src="{{ asset('images/bell-ico.png')}}" alt="" data-pagespeed-url-hash="6734172" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"> 

                @php
                    $resultsCount = DB::select( DB::raw("SELECT count(*) as notify_count FROM notification WHERE for_user = :var1 and status='unread'"), array(
                        'var1' => $iUserId,
                    ));
                @endphp
                <span>{{$resultsCount[0]->notify_count}}</span>

            </div>
            <div class="top-user-profile">
           <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ !empty($sLoggedInUserProfileImage) ? asset('images/profile/'.$sLoggedInUserProfileImage) : asset('images/user.png') }}" alt="" width="25px" height="25px" data-pagespeed-url-hash="2638378100" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
           </a>
            
           <ul class="dropdown-menu">
              <li><a href="{{url('profile')}}">My Profile</a></li>
              <li><a href="{{url('user-logout')}}">Logout</a></li>
            </ul>	
            
          </div>
            </div>
          @else 
          <div class="menu-ham-ico"><a href="{{url('login')}}"><i class="las la-user"></i> Sign In</a></div>  
        @endif
          
            
        </div>    
            
        </nav> 	
            
        </div>
        </header>
        <div class="notification-wrapper">
  <div id="notification" class="notification-bar" style="display: none;">
    
   @if (Session::has('isUserLoggedIn'))
           @php
               $iUserId  = getLoggedInUserId();
               $sLoggedInUserProfileImage = getValueByColumnNameAndId('users','id',$iUserId,'profile_pic');
           @endphp
    <div class="noti-head"><h3>Notifications</h3> <a href="javascript:void(0)" onclick="mark_all_read({{$iUserId}});">Mark All As Read</a></div>

    
    <div class="inner-noti-sec">
         
     @php
                $results = DB::select( DB::raw("SELECT * FROM notification WHERE for_user = :var1 and status='unread' order by id desc"), array(
                    'var1' => $iUserId,
                ));
      @endphp
      @foreach ($results as $notificationResult)
       @php
                $resultsProfilePic = DB::select( DB::raw("SELECT profile_pic FROM users WHERE id = :var1"), array(
                    'var1' => $notificationResult->by_user,
                ));
       @endphp
      <div class="noti-col"><a href="#">
        <div class="noti-ico"><img src="{{ !empty($resultsProfilePic[0]->profile_pic) ? asset('images/profile/'.$resultsProfilePic[0]->profile_pic) : '' }}" alt="" data-pagespeed-url-hash="1407164496" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
        <p>{{$notificationResult->description}}</p>
        <small>{{$notificationResult->created_at}}</small></a>  
      </div>
      @endforeach
  
    </div>  
      @endif
  </div>    
</div>
     @if(empty($sCURL))
      </div>  
     @endif
    @yield('content')

    <footer>
        <div class="container">
          <div class="row align-items-center">
             <div class="col-md-4"><div class="footer-logo"><img src="{{ asset('images/footer-logo.png') }}" alt="" data-pagespeed-url-hash="4134649178" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div> </div> 
             <div class="col-md-8">  
               <div class="footer-slogan">
                   <h3>GLOW with Us</h3>
               </div>
               
               <div class="footer-links">   
                   <a href="javascript:void(0)">Contact</a>
                   <a href="javascript:void(0)">About</a>
                   <a href="javascript:void(0)">Privacy</a>
               </div>  
                 
             </div>
          </div>  
               
          <div class="row align-items-center footer-row">
             <div class="col-md-4">
                 <div class="footer-social">
                   <a href="javascript:void(0)"><img src="{{ asset('images/fb-icon.png')}}" alt="" data-pagespeed-url-hash="1267411903" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                   <a href="javascript:void(0)"><img src="{{ asset('images/instagram-icon.png')}}" alt="" data-pagespeed-url-hash="464414725" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                   <a href="javascript:void(0)"><img src="{{ asset('images/twitter-icon.png')}}" alt="" data-pagespeed-url-hash="3218690080" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                   <a href="javascript:void(0)"><img src="{{ asset('images/youtube-icon.png')}}" alt="" data-pagespeed-url-hash="2043281484" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>  
                 </div>
              </div> 
              
             <div class="col-md-8">
               <div class="copyright">© 2022 God’s Luving Own Words glowteam.org. All Rights Reserved. </div> 
             </div>
          </div>     
            
            
        </div>    
       </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/my_custom.js') }}"></script>
    <script src="{{ asset('js/user_profile.js') }}"></script>    
    <script>$(".custom-file-input").on("change",function(){var fileName=$(this).val().split("\\").pop();$(this).siblings(".custom-file-label").addClass("selected").html(fileName);});</script>    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script> 
    <script src="{{ asset('js/theme.js') }}" type="text/javascript"></script>
    
    
    <script type="text/javascript">
    $("#file-1").fileinput({theme:'fa',uploadUrl:sBASEURL+"feedImageUpload",allowedFileExtensions:['jpg','png','gif'],overwriteInitial:false,maxFileSize:2000,maxFilesNum:10,slugCallback:function(filename){return filename.replace('(','_').replace(']','_');}});

    $(document).ready(function() {
    $("#file-1").fileinput({
        uploadUrl: sBASEURL+"feedImageUpload",
        uploadAsync: false,
        showPreview: false,
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        maxFileCount: 5,
        elErrorContainer: '#kv-error-2'
    }).on('filebatchpreupload', function(event, data, id, index) {
        $('#kv-success-2').html('<h4>Upload Status</h4><ul></ul>').hide();
    }).on('filebatchuploadsuccess', function(event, data) {
        var out = '';
        $.each(data.files, function(key, file) {
            var fname = file.name;
            out = out + '<li>' + 'Uploaded file # ' + (key + 1) + ' - '  +  fname + ' successfully.' + '</li>';
            //alert(out);
        });
        $('#kv-success-2 ul').append(out);
        $('#kv-success-2').fadeIn('slow');
    });
});

var video=document.querySelector("#videoElement");if(navigator.mediaDevices.getUserMedia){navigator.mediaDevices.getUserMedia({video:true}).then(function(stream){video.srcObject=stream;}).catch(function(err0r){console.log("Something went wrong!");});}</script>    
        
    <script>$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});</script>
    <script src="{{ asset('js/share.js') }}"></script>
    <!-- AddToAny BEGIN -->
      <script async src="https://static.addtoany.com/menu/page.js"></script>
    <!-- AddToAny END -->
    <script src="{{asset('js/simple-lightbox.js')}}"></script>
<script>$(function(){var gallery=$('.gallery a').simpleLightbox({navText:['&lsaquo;','&rsaquo;']});});</script>
<script>$(".top-notify").click(function(){$("#notification").toggle();});</script>

</body>

</html>
