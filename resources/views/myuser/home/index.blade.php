@extends('myuser.layouts.view')
@section('title', 'Home')
@section('content')
@if ($aBannersLists && count($aBannersLists) > 0)
  <div class="banner">
    <div id="banner-slider" class="owl-carousel">
    @foreach ($aBannersLists as $aBanners)
      <div class="item">
        <div class="banner_containt">
          <h1>{{ !empty($aBanners->short_description) ? $aBanners->short_description : ''}}</h1>
        <a href="javascript:void(0)" class="common-btn">Learn more</a>
        </div>
        
        <img src="{{ asset('images/banners/'.$aBanners->image) }}" alt="" class="img-responsive" data-pagespeed-url-hash="1764889273" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
      </div><!--item-->
    @endforeach
    </div>
  </div><!--banner-->  
@endif

  
<div class="gudtips-sec">
<div class="container-fluid p-0">
   
 <div class="homepagesec2-col">	
      <div class="row no-gutters align-items-center align-self-stretch">
        <div class="col-lg-6 text-center">
            <div class="homepagesec2-pic wow fadeIn"><img src="{{ asset('images/homepage-1.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="3622855607" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
        </div>

        <div class="col-lg-6">
            <div class="homepagesec2-text">
              <div class="small-txt">GodLuv Tips</div>  
              <h3>Don’t fall off your stairway to Heaven </h3>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore </p>  
              <a href="javascript:void(0)" class="common-btn">Learn More</a>  

            </div>
        </div>	
      </div>
  </div>
   
     <div class="homepagesec2-col">	
      <div class="row no-gutters flex-lg-row-reverse align-items-center align-self-stretch">
        <div class="col-lg-6 text-center">
            <div class="homepagesec2-pic wow fadeIn"><img src="{{ asset('images/homepage-2.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="3917355528" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
        </div>

        <div class="col-lg-6">
            <div class="homepagesec2-text">
              <div class="small-txt">Verse of the Day </div>  
              <h3>a Verse a day keeps the devil away</h3>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore </p>  
              <a href="javascript:void(0)" class="common-btn">Learn More</a>  

            </div>
        </div>	
      </div>
  </div> 
   
   
   
   
</div>    
</div>    
  
<div class="sharinggod-sec">
<div class="sharinggod-pic"><img src="{{ asset('images/footer-bg.jpg') }}" alt="" class="img-responsive" data-pagespeed-url-hash="3906626216" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>    
<div class="sharinggod-col">
  <h4>Spiritual Testimony</h4>
  <h2>sharing God’s grace and mercy</h2>  
  <div class="watch-btn"><a href="javascript:void(0)" class="common-btn">Watch Testimony</a></div>  
</div>      
</div>    
  
<div class="homeservices-sec">
<div class="container">
  <div class="row">
    
        <div class="col-lg-4">
            <div class="homeservices-col wow fadeIn">
              <a href="javascript:void(0)">
                <div class="homeservices-pictxt">
                    <img src="{{ asset('images/home-service-1.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="523810136" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    <h4>Discover the Power of the Holy Spirit</h4>
                  </div>
                <div class="homeservices-content">
                    <p>Do you know your Spiritual Gift? Take the Spiritual Gift assessment to discover your gift!</p>
                    <div class="learn-service-btn">Learn more</div>
                </div>
              </a>
          </div>	
        </div>
      
        <div class="col-lg-4">
            <div class="homeservices-col wow fadeIn">
              <a href="javascript:void(0)">
                <div class="homeservices-pictxt">
                    <img src="{{ asset('images/home-service-2.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="818310057" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    <h4>Doubting God? </h4>
                  </div>
                <div class="homeservices-content">
                    <p>Do you know your Spiritual Gift? Take the Spiritual Gift assessment to discover your gift!</p>
                    <div class="learn-service-btn">Learn more</div>
                </div>
              </a>
          </div>	
        </div>
      
        <div class="col-lg-4">
            <div class="homeservices-col wow fadeIn">
              <a href="javascript:void(0)">
                <div class="homeservices-pictxt">
                    <img src="{{ asset('images/home-service-3.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="1112809978" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    <h4>Discover Healthy Living</h4>
                  </div>
                <div class="homeservices-content">
                    <p>Healthy living for mind, body and emotions</p>
                    <div class="learn-service-btn">Coming July 2022</div>
                </div>
              </a>
          </div>	
        </div>
      
        <div class="col-lg-4">
            <div class="homeservices-col wow fadeIn">
              <a href="javascript:void(0)">
                <div class="homeservices-pictxt">
                    <img src="{{ asset('images/home-service-4.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="1407309899" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    <h4>Christian Music</h4>
                  </div>
                <div class="homeservices-content">
                    <p>Christian music & wordship </p>
                    <div class="learn-service-btn">Learn more</div>
                </div>
              </a>
          </div>	
        </div>
      
        <div class="col-lg-4">
            <div class="homeservices-col wow fadeIn">
              <a href="javascript:void(0)">
                <div class="homeservices-pictxt">
                    <img src="{{ asset('images/home-service-5.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="1701809820" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    <h4>Christian Dating</h4>
                  </div>
                <div class="homeservices-content">
                    <p>Dating with Purpose Finding your Christian luv</p>
                    <div class="learn-service-btn">Coming October 2022 </div>
                </div>
              </a>
          </div>	
        </div>
      
        <div class="col-lg-4">
            <div class="homeservices-col wow fadeIn">
              <a href="javascript:void(0)">
                <div class="homeservices-pictxt">
                    <img src="{{ asset('images/home-service-6.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="1996309741" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    <h4>Christian shopping </h4>
                  </div>
                <div class="homeservices-content">
                    <p>Shop for Christian Books, Concerts, Gadgets, Music, Movies & Podcast</p>
                    <div class="learn-service-btn">Coming October 2022 </div>
                </div>
              </a>
          </div>	
        </div>
      
  </div>
</div>      
</div>    
  
<div class="homebook-sec">
<div class="homebook-pic"><img src="{{ asset('images/bookbg.jpg') }}" alt="" class="img-responsive" data-pagespeed-url-hash="4161152843" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
  
<div class="homebook-text">
<h2>Basic Instructions Before Leaving Earth “Bible”s</h2>    
  <ul>
  <li>• The Bible between the lines – What’s God really up to?</li>
  <li>• Bible with commentaries and audible</li>
  <li>• Able to highlight and take notes</li>
  <li>• Has bible study materials</li>
  <li>• Bible trivia after each book</li>    
  </ul>
  <div class="watch-btn"><a href="javascript:void(0)" class="common-btn">Watch Testimony</a></div>
</div>    
</div>    
  
<div class="homeresources-sec">
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="homeresources-left">
        <div class="small-txt">Resources</div>
        <h3>Christian Resources</h3>
        <div class="homeresources-blue">Coming July 2022</div>    
      </div>  
    </div>
      
      
      
    <div class="col-md-8">
      <div class="homeresources-right">
        <div class="row">
          <div class="col-sm-6">
            <div class="homeresources-col1">
              <div class="homeresources-icon"><img src="{{ asset('images/resources-ico-1.png') }}" alt="" data-pagespeed-url-hash="3223576526" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="homeresources-rtext">
                <h3>Financial Resources</h3>  
                <p>Financial Peace Live workshop Christian healthcare, grants, loans, scholarship</p>    
              </div>  
            </div>  
          </div>
            
          <div class="col-sm-6">
            <div class="homeresources-col1">
              <div class="homeresources-icon"><img src="{{ asset('images/resources-ico-2.png') }}" alt="" data-pagespeed-url-hash="3518076447" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="homeresources-rtext">
                <h3>Business Idea</h3>  
                <p>A workshop aimed at shaping your business idea, answering questions regarding project planning</p>    
              </div>  
            </div>  
          </div>
            
          <div class="col-sm-6">
            <div class="homeresources-col1">
              <div class="homeresources-icon"><img src="{{ asset('images/resources-ico-3.png') }}" alt="" data-pagespeed-url-hash="3812576368" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="homeresources-rtext">
                <h3>Professionals Resources</h3>  
                <p>Search for Christian Professionals (Attorney, Doctors, Therapist, Mortgage Broker, Real Estate Agents, Property Managers</p>    
              </div>  
            </div>  
          </div>
            
          <div class="col-sm-6">
            <div class="homeresources-col1">
              <div class="homeresources-icon"><img src="{{ asset('images/resources-ico-4.png') }}" alt="" data-pagespeed-url-hash="4107076289" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
              <div class="homeresources-rtext">
                <h3>Christian Roommate</h3>  
                <p>Search for Christian roommate or properties to rent, buy or sell</p>    
              </div>  
            </div>  
          </div>  
          
        </div>
      </div>  
    </div>    
   
  </div>
</div>       
</div>    
  
<div class="homemission-sec">
<div class="container">
 <div class="homemission-text">
   <div class="homemission-icon"><img src="{{ asset('images/logo-icon.png') }}" alt="" data-pagespeed-url-hash="3268069504" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
   <h3>GodLuv’s mission is to…</h3>
    <p>Inspire Christians to fellowship and strengthen their relationship with our amazing Lord Jesus Christ</p>

<p>Join together to share our spiritual testimony of God’s grace and mercy through God’s Luving Words</p>

<p>Further his Kingdom by reaching the unreachable and be a valuable source for those seeking a path-way to everlasting life</p>

<p>Be a search engine for all Christians to find local churches, radio stations, professionals, luv, merchants, events, activities for singles & married couples, serving opportunities and fellowship with God’s family</p>      
 </div>   
</div>       
</div>
@endsection