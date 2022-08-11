@extends('myuser.layouts.view')
@section('title', 'Spiritual Testimony')
@section('content')
<div class="inner-banner blue-bg">
  <div class="container">
    <div class="innerbanner-text">
      <h3>One of Godluv’s mission is to </h3>
      <h1>“Inspire Christians to Join together to share</h1>
      <p>One of the most effective tools we have for sharing our faith is our spiritual testimony of how Jesus Christ transformed our life and gave us grace and mercy.</p>
      <a href="#" class="common-btn"><i class="las la-plus"></i> Add New Testimony</a>    
    </div>
  </div>      
</div>

<div class="menuinner-page">
 <div class="container">
   <div class="menuinner-tophead">
     <div class="menuinner-title"><h3>Spiritual Testimony</h3></div>
    <div class="sortby-col">
      <i class="las la-sliders-h"></i> Sort by
       <select id="sortby" class="form-control">
          <option value="Alphabetical" label="Alphabetical">Alphabetical</option>
          <option value="Recent" label="Recent">Recent</option>
          <option value="Popular" label="Popular">Popular</option>
        </select>    
    </div>   
   </div>
     
   <div class="spiritual-page">
     <div class="row">
      
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-1.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="523810136" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>
         
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-2.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="818310057" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>
         
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-3.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="1112809978" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>
         
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-2.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="818310057" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>
         
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-1.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="523810136" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>
         
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-3.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="1112809978" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>
         
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-1.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="523810136" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>
         
      <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="homeservices-col wow fadeIn">
            <a href="#">
              <div class="homeservices-pictxt">
                  <img src="{{ asset('images/home-service-1.jpg') }}" class="img-responsive" alt="" data-pagespeed-url-hash="523810136" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                </div>
              <div class="homeservices-content">
                  <h4>Testimony title here. 3 lines maximum</h4>
              </div>
            </a>
        </div>	
      </div>     
        
    </div>
     
   </div>  
      
 </div>        
</div>
@endsection