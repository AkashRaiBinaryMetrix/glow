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
     <div class="inner-banner blue-bg">
  <div class="container">
    <div class="innerbanner-text">
      <h2>Privacy Policy</h2>    
    </div>
  </div>      
</div>
<div class="menuinner-page">
 <div class="container">
   
<p>God’s Luving Own Words (DBA "GLOW") builds technologies and services that enable Christian people to connect with each other, build communities, and grow businesses.</p>
     
<p>This Privacy Policy ("Policy") describes the manner in which God's Luving Own Words, Inc. ("GLOW", "we," "us," or "our") collects and uses Personal Information in the context of our website at Glowteam.org (the "Site"), as well as all related websites, networks, applications, and other services provided by us and on which a link to this Policy is displayed (collectively, together with the Site, our "Service"). This Policy describes the Personal Information that we gather from you on the Service, how we use and disclose such Personal Information, and the steps we take to protect such Personal Information.</p>

<h5>Personal Information We Collect</h5>
     
<p>In this Policy, "Personal Information" means any information relating to an identified or identifiable individual. We may collect Personal Information about you directly from you and from third parties, as well as automatically through your use of the Service. Where required by applicable law, we indicate whether and why you must provide us with your Personal Information, as well as the consequences of failing to do so.</p>

<h5>Personal Information Provided by You</h5>

<ul>
    <li>Account Information. When you register for an account, you provide us with account information, such as your name, contact details, date of birth, gender, marital status, language preferences, denominations, and login details.</li>
    <li>Affiliations and Relationships. We may collect data about your affiliations and relationships with other users in the Service, including your followers, and the users and organizations you follow and interact with.</li>
    <li>Communication Information. When you communicate with us or others through the Service, you may provide us with communication information, including your name, contact details, the content, date and time of your message, any attachments thereto, and other information you choose to provide.</li>
    <li>Profile Information. When you create or update your profile on the Service, you may provide us with profile information, such as information about your religious denomination, your church attendance frequency, your social and religious leanings, your preferred Bible translation, whether you act in a religious or ministry leadership capacity, your location, and any other information you choose to include on your profile.</li>
    <li>User-Generated Content. When you share content through the Service, we may receive your user-generated content, such as photos, videos, text or any other media you choose share publicly, privately, or with other users.</li>
    <li>Contact Uploads. When you invite others through the Service, we may store the phone numbers and/or email addresses of users you have selected to invite.</li>
</ul>

<p>As we are a religious social network, some of the information you provide may reveal your religious beliefs or political opinions. Where required by applicable law, we will only collect and use such information with your consent. Your personal data are stored on secure servers in the United States.</p>

<h5>Information Collected via Automated Means</h5>
<ul>
    <li>Service Usage Information. When you use our Service, we may collect information about your use of the Service, such as your IP address, web browser, device type, and the web pages that you visit just before or just after you use the Service, as well as information about your interactions with the Service, such as the date and time of your visit, and where you have clicked.</li>
    <li>Location Information. We may obtain information about your physical location, such as by use of GPS and other geolocation features in your device, or by inference from other Personal Information we collect. For example, your IP address indicates the general geographic region from which you are connecting to the Internet.</li>
    <li>Cookies and Similar Technologies. When you use our Service, we may automatically collect information about your use of the Service via cookies, beacons, invisible tags, and similar technologies in your browser and on emails sent to you. This information may include Personal Information, such as your IP address, web browser, device type, and the web pages that you visit just before or just after you use the Services, as well as information about your interactions with the Services, such as the date and time of your visit, and where you have clicked. You can find more information about how we use cookies and similar technologies in the section How We Use Cookies below.</li>
</ul>

<h5>Information from Other Sources</h5>

<ul>
    <li>We may obtain Personal Information from our partners or other users of the Service, including when our partners or other users refer you to the Service. We may also obtain Personal Information from third parties and sources other than the Service, such as our partners and advertisers.</li>
</ul>

<h5>How We Use Personal Information</h5>

<p>We use Personal Information we collect on the Service in a variety of ways in providing the Service and operating our business, including the following:</p>

<ul>
    <li>Providing the Service. We use Personal Information to operate, maintain, enhance and provide all features of the Service, to provide services and information that you request, to respond to comments and questions and otherwise to provide support to users, and to process and deliver entries and rewards in connection with promotions that may be offered from time to time on the Service.</li>
    <li>Understanding usage and improving the Service. We use Personal Information to understand and analyze the usage trends and preferences of our users, to improve the Service, and to develop new products, services, features, and functionality, and to analyze the ways in which our users and partners might better serve and communicate with each other.</li>
    <li>Communicating with you. We may use your email address or other Personal Information to contact you for administrative purposes such as customer service or to send communications, including updates on promotions and events, relating to products and services offered by us and by third parties.</li>
    <li>Marketing and Advertising. We use Personal Information for marketing purposes, such as developing and providing promotional and advertising materials that may be useful, relevant, valuable or otherwise of interest to you.</li>
    <li>Personalization. We use Personal Information to personalize your experience on our Service such as to curate content for you and recommend users to connect with.</li>
</ul>

<h5>Our Use of European Personal Information</h5>

<p>If you are located in the European Economic Area, we only process your Personal Information when we have a valid “legal basis”, including when:</p>

<ul>
    <li>You have consented to the use of your Personal Information, for example to process Personal Information revealing religious beliefs or political opinions, or to send you marketing communications.</li>
    <li>We need your Personal Information to provide you with the Service, for example to respond to your inquiries.</li>
    <li>We or a third party have a legitimate interest in using your Personal Information. In particular, we have a legitimate interest in using your Personal Information for product development and internal analytics purposes, and otherwise to improve the safety, security, and performance of our Service. We only rely on our or a third party’s legitimate interests to process your Personal Information when these interests are not overridden by your rights and interests.</li>
    <li>We or a third party have a legitimate interest in using your Personal Information. In particular, we have a legitimate interest in using your Personal Information for product development and internal analytics purposes, and otherwise to improve the safety, security, and performance of our Service. We only rely on our or a third party’s legitimate interests to process your Personal Information when these interests are not overridden by your rights and interests.</li>
</ul>

<h5>How We Use Cookies</h5>

<p>Cookies are small text files containing a string of alphanumeric characters which are stored on your device. We may use both session cookies and persistent cookies. A session cookie disappears after you close your browser. A persistent cookie remains after you close your browser and may be used by your browser on subsequent visits to the Service. We and third-party service providers may use cookies and similar technologies in the following ways:</p>

<ul>
    <li>Functional cookies. Some cookies are strictly necessary to make our Service available to you. For example, to provide the login functionality. We cannot provide you with the Service without this type of cookies.</li>
    <li>Analytical cookies. We also use cookies for website analytics purposes in order to operate, maintain, and improve our Service. We may use our own analytics cookies or use third-party analytics providers such as Google Analytics to collect and process certain analytics data on our behalf. These providers may also collect information about your use of other websites, apps, and online resources.</li>
    <li>Analytical cookies. We also use cookies for website analytics purposes in order to operate, maintain, and improve our Service. We may use our own analytics cookies or use third-party analytics providers such as Google Analytics to collect and process certain analytics data on our behalf. These providers may also collect information about your use of other websites, apps, and online resources.</li>
    <li>Advertising cookies. We allow third-party advertising partners to use cookies on the Service to collect information about your browsing activities over time and across websites. We also work with these third-party advertising partners to market our Service to you on other websites, apps and online services. Through a process called “retargeting,” these services may place a cookie on your browser when you visit our website so that they can identify you and serve you ads on other websites around the web based on your browsing activity.</li>
    <li>Where required by applicable law, we obtain your consent to use cookies. You can find more information about your rights and choices, and how to opt out of the use of certain cookies in the section Your Rights and Choices below.</li>
</ul>

<h5>When We Disclose Information</h5>

<p>We understand the importance of your Personal Information, and assure you that GLOW is not in the business of merely collecting and selling marketing data. Data is nevertheless important to GLOW’s primary business of connecting people with communities, and communities with people, and of facilitating the ways in which those people and communities access and interact with providers of messaging, content, as well as products and services that speak to their unique needs and interests. As such, you should be aware that in the operation of our business, we disclose information to third parties in a variety of circumstances consistent within that broader business context:</p>

<ul>
    <li>Any Personal Information that you voluntarily choose to include in a publicly accessible area of the Service will be available to all those, including other users, who have access to that content.</li>
    <li>We work with third party service providers to provide website, application development, hosting, maintenance, and other services for us. These third parties may have access to or process Personal Information about you as part of providing those services for us. Generally, we limit the information provided to these service providers to that which is reasonably necessary for them to perform their functions, and we require them to agree to maintain the confidentiality of such information.</li>
    <li>One of primary purposes of the Service is to enable you to communicate, share, shop, give, and learn by connecting you, based on your interests and preferences, with others, including faith communities, faith leaders, and other community members, as well as providers of messaging, content, and products and services that align with your interests and preferences, or that we believe you may be interested in. To accomplish this goal, we may engage in transactions in which we disclose Personal Information to our partners, content providers, advertisers, or other third parties for this purpose.</li>
    <li>We may disclose Personal Information about you if required to do so by law or in the good-faith belief that such action is necessary to comply with state and federal laws, in response to a court order, judicial or other government subpoena or warrant, or to otherwise cooperate with law enforcement or other governmental agencies.</li>
    <li>We also reserve the right to disclose Personal Information about you that we believe, in good faith, is appropriate or necessary to (i) take precautions against liability, (ii) protect ourselves or others from fraudulent, abusive, or unlawful uses or activity, (iii) investigate and defend ourselves against any third-party claims or allegations, (iv) protect the security or integrity of the Service and any facilities or equipment used to make the Service available, or (v) protect our property or other legal rights (including, but not limited to, enforcement of our agreements), or the rights, property, or safety of others.</li>
    <li>Personal Information about our users may be disclosed and otherwise transferred to an acquirer, successor, or assignee as part of any merger, acquisition, debt financing, sale of assets, or similar transaction, or in the event of an insolvency, bankruptcy, or receivership in which information is transferred to one or more third parties as one of our business assets.</li>
    <li>We may make certain aggregated, automatically-collected, or otherwise non-personal information available to third parties for various purposes, including (i) compliance with various reporting obligations; (ii) for business or marketing purposes; or (iii) to assist such parties in understanding our users’ interests, habits, and usage patterns for certain programs, content, services, advertisements, promotions, and/or functionality available through the Service.</li>
</ul>

<h5>Your Rights and Choices</h5>

<p>Privacy Rights</p>     

<ul>
    <li>You may, of course, decline to share certain information with us, in which case we may not be able to provide to you some of the features and functionality of the Service. You may update, correct, or delete your account information and preferences at any time by accessing the Privacy Settings page on the Service. If you wish to access or amend any other Personal Information we hold about you, you may contact us at <a href="mailto:privacy@glowteam.org">privacy@glowteam.org</a>. Please note that while any changes you make will be reflected in active user databases within a reasonable period of time, we may retain all information you submit for backups, archiving, prevention of fraud and abuse, analytics, satisfaction of legal obligations, or where we otherwise reasonably believe that we have a legitimate reason to do so.</li>
    <li>If you receive commercial emails from us, you may unsubscribe at any time by following the instructions contained within the email. You may also opt out from receiving commercial email from us by sending your request to us by email at <a href="mailto:privacy@glowteam.org">privacy@glowteam.org</a> or by writing to us at the address given at the end of this policy. We may allow you to view and modify settings relating to the nature and frequency of promotional communications that you receive from us in user account functionality on the Service.</li>
    <li>Please be aware that if you opt out of receiving commercial emails from us or otherwise modify the nature or frequency of promotional communications you receive from us, it may take up to ten business days for us to process your request, and you may continue receiving promotional communications from us during that period. Additionally, even after you opt out from receiving commercial messages from us, you will continue to receive administrative messages from us regarding the Service.</li>
</ul>

<h5>Your Cookie Choices</h5>

<p>You have the following choices with regard to the use of cookies and similar technologies.</p>

<ul>
    <li>Browser settings. Many web browsers allow you to manage your preferences relating to cookies. You can set your browser to refuse cookies or delete certain cookies. You may be able to manage other technologies in the same way that you manage cookies using your browser’s preferences. Please review your web browser “Help” file to learn the proper way to modify your cookie settings. Please note that if you delete, or choose not to accept, cookies from the Service, you may not be able to utilize the features of the Service to their fullest potential.</li>
    <li>Google Analytics. You can opt-out of Google Analytics cookies by downloading the Google Analytics opt-out browser add-on, available at <a href="https://tools.google.com/dlpage/gaoptout"><strong>https://tools.google.com/dlpage/gaoptout</strong></a>.</li>
    <li>Network Advertising Initiative and Digital Advertising Alliance. We work with third party advertising partners to show you ads that we think may interest you. These advertising partners may set and access their own cookies, pixel tags and similar technologies on our Service and they may otherwise collect or have access to information about you which they may collect over time and across different online services. Some of our advertising partners are members of the Network Advertising Initiative <a href="http://optout.networkadvertising.org/?c=1#!/"><strong>(http://optout.networkadvertising.org/?c=1#!/)</strong></a> or the Digital Advertising Alliance <a href="http://optout.aboutads.info/?c=2&lang=EN"><strong>(http://optout.aboutads.info/?c=2&lang=EN)</strong></a>. If you do not wish to receive personalized ads, please visit their opt-out pages to learn about how you may opt out of receiving web-based personalized ads from member companies. You can access any settings offered by your mobile operating system to limit ad tracking, or you can install the AppChoices mobile app to learn more about how you may opt out of personalized ads in mobile apps.</li>
</ul>

<h5>Your European Privacy Rights</h5>

<p>If you are located in the European Economic Area, you may request access to and receive information about the Personal Information we maintain about you, update and correct inaccuracies in your Personal Information, restrict or object to the processing of your Personal Information, have the information anonymized or deleted, as appropriate, or exercise your right to data portability to transfer your Personal Information to another company. In addition, you may also have the right to lodge a complaint with a supervisory authority, including in your country of residence, place of work or where an incident took place. You may withdraw any consent you previously provided to us regarding the processing of your Personal Information, at any time and free of charge. We will apply your preferences going forward and this will not affect the lawfulness of the processing before you withdrew your consent.</p>

<h5>Third-Party Services</h5>

<p>
The Service may contain features or links to websites and services provided by third parties and contain social media features and other content provided by third parties. These third parties may collect information about you if you visit their websites, or if you visit a website that contains social media features or other content provided by them. Any information you provide on third-party sites or services is provided directly to the operators of such services and is subject to those operators’ policies, if any, governing privacy and security, even if accessed through the Service. We are not responsible for the content or privacy and security practices and policies of third-party sites or services to which links or access are provided through the Service. We encourage you to learn about third parties’ privacy and security policies before providing them with information.
</p>

<h5>YouTube</h5>

<p>The Service uses the YouTube API to transmit, store, and display video content uploaded by The Service and it's users. By agreeing to this agreement, you acknowledge the Google Privacy Policy <a href="http://www.google.com/policies/privacy"><strong>(http://www.google.com/policies/privacy)</strong></a> and agree to be bound by the YouTube Terms of Service <a href="https://www.youtube.com/t/terms"><strong>(https://www.youtube.com/t/terms).</strong></a></p>

<h5>Children’s Privacy</h5>

<p>Protecting the privacy of young children is especially important. Our Site is a general audience site not directed to children under the age of 13, and we do not knowingly collect personal information from children under the age of 13 without obtaining parental consent.</p>

<h5>Information Security</h5>

<p>We use certain physical, organizational, and technical safeguards that are designed to maintain the integrity and security of information that we collect. Please be aware that no security measures are perfect or impenetrable and thus we cannot and do not guarantee the security of your information. It is important that you maintain the security and control of your credentials, and not share your passwords with anyone.</p>

<h5>International Visitors</h5>

<p>The Service is hosted in the United States. We make no representation that the Service is appropriate or available for use outside of the United States. Access to the Service from countries or territories or by individuals where such access is illegal is prohibited.</p>

<p>If you are located in the European Economic Area, we will comply with applicable data protection laws when transferring your Personal Information outside of the European Economic Area. We may transfer your Personal Information to countries which have been found to provide adequate protection by the EU Commission (e.g., Switzerland, Canada), use contractual protections for the transfer of Personal Information, or transfer to recipients who have certified to the Privacy Shield or adopted Binding Corporate Rules. For more information about how we transfer Personal Information outside of the EEA, or to obtain a copy of the contractual safeguards we use for such transfers, you may contact us as specified below.</p>

<h5>Retention</h5>

<p>We take measures to delete your Personal Information or keep it in a form that does not permit identifying you when this information is no longer necessary for the purposes for which we process it unless we are required by law to keep this information for a longer period. When determining the specific retention period, we consider various criteria, such as the type of service provided to you, the nature and length of our relationship with you, and mandatory retention periods provided by law and the relevant statute of limitations.</p>

<h5>Changes and Updates to this Policy</h5>

<p>Please revisit this page periodically to stay aware of any changes to this Policy, which we may update from time to time. If we modify this Policy, we will make it available through the Service, and indicate the date of the latest revision. In the event that the modifications materially alter your rights or obligations hereunder, we will make reasonable efforts to notify you of the change. For example, we may send a message to your email address, if we have one on file, or generate a pop-up or similar notification when you access the Service for the first time after such material changes are made. Your continued use of the Service after the revised Policy has become effective indicates that you have read, understood and agreed to the current version of this Policy.</p>

<h5>Your California Privacy Rights</h5>

<p>Residents of California have the right to request a disclosure describing what types of Personal Information we have shared with third parties for their direct marketing purposes and with whom we have shared it, during the preceding calendar year. You may request a copy of that disclosure by contacting us at <a href="mailto:privacy@glowteam.org">privacy@glowteam.org</a>.</p>

<h5>How to Contact Us</h5>

<p>Unless otherwise indicated in this Policy, God’s Luving Own Words, Inc. is the entity responsible or “data controller” for the processing of Personal Information described in this Policy. Please contact us with any questions or comments about this Policy, information we have collected or otherwise obtained about you, our use and disclosure practices, or your consent choices by email at <a href="mailto:privacy@glowteam.org">privacy@glowteam.org</a></p>

</div>        
</div>
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
                   <a href="privacy-policy">Privacy</a>
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
