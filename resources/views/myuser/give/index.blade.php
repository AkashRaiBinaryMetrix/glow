@extends('myuser.layouts.view')
@section('title', 'Give')
@section('content')
<div class="inner-banner blue-bg">
  <div class="container">
    <div class="innerbanner-text">
      <h3>Giving</h3>
      <h1>We are grateful for your generosity to GodLuv.</h1>
      <h1>Your faithfulness makes it possible for us to
help fulfill Jesus Christ - God’s Luving Words Mission to…</h1>    
    </div>
  </div>      
</div>

<div class="menuinner-page">
 <div class="container">
   <div class="givepage-sec">
     
     <div class="givetop-list">
       <ul>
         <li>Inspire Christians to fellowship and strengthen their relationship with our amazing Lord Jesus Christ by empowering the Holy Spirit</li>
         <li>Join together to share our spiritual testimony of God’s grace and mercy through God’s Luving Words</li>
         <li>Further his Kingdom by reaching the unreachable and be a valuable source</li>
         <li>Be a search engine for all Christians to find local churches, radio stations, professionals,</li>   
       </ul>  
     </div>
       
     <div class="givedonation-sec">
       <div class="givedonation-pic"><img src="images/give-donate-banner.jpg" alt="" class="img-responsive" data-pagespeed-url-hash="2889461791" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></div>
       
        <div class="givedonation-inner">
          <div class="givebold-text">Make a Donation to Tragedy Into Triumph Conferences & Services</div>
          <div class="heading-3">Your Donation for General Fund</div>
         
          <div class="givedonate-btns">
           <div class="preference-options-check">

						<div class="image-checkbox-col">
						  <div class="custom-control custom-radio image-checkbox">
							<input type="radio" class="custom-control-input" id="pre-1" name="pre-1">
							<label class="custom-control-label" for="pre-1">
								<span class="image-check-col">$200</span>
							</label>
						</div>  
						</div>

						<div class="image-checkbox-col">
						  <div class="custom-control custom-radio image-checkbox">
							<input type="radio" class="custom-control-input" id="pre-2" name="pre-1">
							<label class="custom-control-label" for="pre-2">
								<span class="image-check-col">$149</span>
							</label>
						</div>  
						</div>
						  
						<div class="image-checkbox-col">
						  <div class="custom-control custom-radio image-checkbox">
							<input type="radio" class="custom-control-input" id="pre-3" name="pre-1">
							<label class="custom-control-label" for="pre-3">
								<span class="image-check-col">$100</span>
							</label>
						</div>  
						</div>
						  
						<div class="image-checkbox-col">
						  <div class="custom-control custom-radio image-checkbox">
							<input type="radio" class="custom-control-input" id="pre-4" name="pre-1">
							<label class="custom-control-label" for="pre-4">
								<span class="image-check-col">$50</span>
							</label>
						</div>  
						</div>
						  
						<div class="image-checkbox-col">
						  <div class="custom-control custom-radio image-checkbox">
							<input type="radio" class="custom-control-input" id="pre-5" name="pre-1">
							<label class="custom-control-label" for="pre-5">
								<span class="image-check-col">Other</span>
							</label>
						</div>  
						</div>  

					  </div> 
            
          </div>    
            
          <div class="givedonations-2col">
            <div class="row">
              <div class="col-lg-3 col-sm-6">
                <div class="form-group">
				  <p class="doantefm-name">
                    <label>Your Donation</label>
                    <span class="donadol">$</span>  
					<input type="text" size="30" value="149" name="" id="" class="form-control" required="">
				  </p>
				  </div>  
              </div>
                
              <div class="col-lg-3 col-sm-6">
                <div class="form-group">
				  <p class="contact-form-name">
                    <label>Start Date</label>  
					<input type="date" size="30" value="01 / 02 / 2022" name="" id="" class="form-control" required="">
				  </p>
				  </div>  
              </div>    
              
            </div>  
            
            <div class="form-group donateradiobtn">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio" name="example" value="customEx" checked>
                    <label class="custom-control-label" for="customRadio">One-Time</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio2" name="example" value="customEx">
                    <label class="custom-control-label" for="customRadio2">Recurring</label>
                  </div>
			</div>  
              
            <div class="form-group">
                <label>Note</label>
                <textarea class="form-control" id="comment" placeholder="Your Message" rows="3" required=""></textarea>
            </div>  
             
            <div class="form-group mt-4">
                <div class="common-box"><a href="#" class="common-btn">Donate Now</a></div>
            </div>  
              
          </div>   
            
        </div>  
     </div>  
       
   </div>   
 </div>        
</div>
@endsection