@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
                <a href="{{route('bikes')}}">< Back to My Bikes</a>
			    <div class="row" id="bike_tab1">
                    <h2 class="page-heading">Select your bike</h2>
                    <div class="d-flex align-items-center filter-details mb-4">
                        <span class="filter-block1"></span><br/>
                    </div>
                    
			    <!-- repeat div from here START -->
				<div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-8 mb-3">                        
                            <form id="addBikeForm1" method="post">
                                <input type="hidden" name="csrf" content="{{ csrf_token() }}">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="login-input">
                                    <div class="form-group">                                        
                                        <input type="text" class="form-control" autocomplete="off" name="name" value="{{isset($name) ? $name : ''}}" id="bike_list" placeholder="Search for bike brand or model name">
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center filter-details mb-4">
                                    <span class="filter-block1"> or Choose from following brands</span>
                                </div>
                                <div class="row">
                                    @foreach($brands as $brand)
                                        <div class="col-3">
                                            <img src="http://localhost/gull-html-laravel/public/images/bike_brands/{{$brand->logo}}" onclick="showBikeModelList('{{$brand->id}}')" width="100" height="80"/>
                                        </div>
                                    @endforeach
                                </div>                                
                            </form>
                        </div>
                        <div class="col-4 mb-3">
                            <div id="bike-icon" style="background-color: #f2f5fa;height:200px;">
                                <div>
                                    <i class="fa fa-motorcycle" aria-hidden="true" style="position: relative;float: bottom; margin-top: 100px;margin-left: 100px;"></i>
                                </div>
                                <div class="filter-block1" style="color: #aaaaaa;
    font-size: 14px;     text-align: center;"> Selected Bike will be shown here.</div>
                            </div>
                            <div class="selected_bike" style="display:none">
                                <img src="{{ asset('public/images/logo/bike_brands/dummy.jpg')}}" alt="" width="200" height="200" id="selected_bike"/>
                            </div>
                        </div> 
                        <div class="col-8 mb-3">
                            <button type="button" id="submitBikeStep1" class="btn btn-danger w-50"> CONTINUE</button>
                        </div>                      
                    </div>
				</div>
            </div>
            
            <div class="row" id="bike_tab2" style="display:none">
                <div class="cust-left-block">
                
                    <h2 class="page-heading">
                    Add Bike Details
                    </h2>
                    <div class="d-flex align-items-center filter-details mb-4">
                    <span class="filter-block1">Fill Details for better review and profile buildup</span><br/>
                    </div>
                <div class="col-12 mb-3">
                    <div class="row">                        
                        <div class="col-12 mb-3">                            
                            <form id="addBikeForm2" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{isset($id) ? $id : ''}}">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="login-input">
                                    <h2 class="page-heading">Upload Bike Images</h2>
                                    @if(isset($images))
                                    <div class="form-group">
                                       @foreach($images as $image)
                                            <img src="{{ asset('public/images/rider/bikes/')}}/{{$image}}" style="width:200px; height:150px">
                                       @endforeach
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="image[]" multiple>
                                    </div>                        
                                </div>
                               
                                <div class="login-input">
                                    <h2 class="page-heading">Highlight Details</h2>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="total_km" value="{{isset($total_km) ? $total_km : ''}}" placeholder="KMs Driven">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="total_rides" value="{{isset($total_rides)?$total_rides:''}}" placeholder="Rides you have completed with this bike">
                                    </div>
                                </div>

                                <div class="login-input">
                                    <h2 class="page-heading">Rate Your Bike</h2>
                                    <div class="form-group">
                                        <p>Comfortness</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comfortness" value="1"
                                            @if(isset($comfortness) && $comfortness==1)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2"> 1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comfortness" value="2" 
                                            @if(isset($comfortness) && $comfortness==2)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comfortness" value="3"
                                            @if(isset($comfortness) && $comfortness==3)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comfortness" value="4"
                                            @if(isset($comfortness) && $comfortness==4)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="comfortness" value="5"
                                            @if(isset($comfortness) && $comfortness==5)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">5</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p>Visual Appeal</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="visual_appeal" value="1"
                                            @if(isset($visual_appeal) && $visual_appeal==1)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2"> 1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="visual_appeal" value="2" 
                                            @if(isset($visual_appeal) && $visual_appeal==2)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="visual_appeal" value="3"
                                            @if(isset($visual_appeal) && $visual_appeal==3)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="visual_appeal" value="4"
                                            @if(isset($visual_appeal) && $visual_appeal==4)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="visual_appeal" value="5"
                                            @if(isset($visual_appeal) && $visual_appeal==5)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">5</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p>Reliability</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reliability" value="1"
                                            @if(isset($reliability) && $reliability==1)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2"> 1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reliability" value="2" 
                                            @if(isset($reliability) && $reliability==2)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reliability" value="3"
                                            @if(isset($reliability) && $reliability==3)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reliability" value="4"
                                            @if(isset($reliability) && $reliability==4)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reliability" value="5"
                                            @if(isset($reliability) && $reliability==5)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">5</label>
                                        </div>
                                     </div>
                                    <div class="form-group">
                                        <p>Performance</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="performance" value="1"
                                            @if(isset($performance) && $performance==1)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2"> 1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="performance" value="2" 
                                            @if(isset($performance) && $performance==2)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="performance" value="3"
                                            @if(isset($performance) && $performance==3)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="performance" value="4"
                                            @if(isset($performance) && $performance==4)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="performance" value="5"
                                            @if(isset($performance) && $performance==5)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">5</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p>Service Experience</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="service_experience" value="1"
                                            @if(isset($service_experience) && $service_experience==1)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2"> 1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="service_experience" value="2" 
                                            @if(isset($service_experience) && $service_experience==2)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="service_experience" value="3"
                                            @if(isset($service_experience) && $service_experience==3)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="service_experience" value="4"
                                            @if(isset($service_experience) && $service_experience==4)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="service_experience" value="5"
                                            @if(isset($service_experience) && $service_experience==5)
                                            checked
                                            @endif
                                            >
                                            <label class="form-check-label" for="exampleRadios2">5</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="login-input">
                                    <h2 class="page-heading">Other Optional</h2>
                                    <div class="form-group">
                                        <textarea id="form7" class="md-textarea form-control" name="info" id="description" rows="3" placeholder="Anything else you want to share about this bike ? Write it down here">{{isset($info) ? $info : ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="button" id="backBikeStep1" class="btn btn-default w-40 back-btn"><< BACK</button>
                                    <button type="button" id="submitBikeStep2" class="btn btn-danger w-40">CONTINUE</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
            </div>
            <div class="row" id="review_bike" style="display:none"></div>
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
			<button class="post-btn w-100 mb-3">Add Your Bike</button>
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item">
				   <h4 class="notify-heading" id="progressStep1">Select your bike</h4>
				</li>
			   <li class="list-group-item">
				   <h4 class="notify-heading progress-frm" id="progressStep2">Add Bike Details</h4>
                </li>
                <li class="list-group-item">
				   <h4 class="notify-heading progress-frm" id="progressStep3">Review And Done</h4>
				</li>
			 </ul>
		   </div>		   
		  </div>
		</div>
	  </div>
	</div>
  </section>
@stop