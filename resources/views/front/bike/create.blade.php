@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
              <a href="{{route('rides')}}">< Back to My Bikes</a>
			<h2 class="page-heading">
			  Select your bike
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">Choose brand bike and model</span><br/>
            </div>
			
			<div class="row" id="tab1">
			  <!-- repeat div from here START -->
				<div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-8 mb-3">                        
                            <form id="addRideForm1" method="post">
                                <input type="hidden" name="csrf" content="{{ csrf_token() }}">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="login-input">
                                    <div class="form-group">                                        
                                        <input type="text" class="form-control" autocomplete="off" name="bike_name" id="bike_list" placeholder="Search for bike brand or model name">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center filter-details mb-4">
                                    <span class="filter-block1"> or Choose from following brands</span>
                                </div>
                                <div class="row">
                                    @foreach($brands as $brand)
                                        <div class="col-3">
                                            <img src="{{ asset('public/images/logo/bike_brands/')}}/{{$brand->logo}}" width="100" height="80"/>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>                        
                    </div>
				</div>
            </div>
            
            <div class="row" id="tab2" style="display:none">
				<div class="col-12 mb-3">
                    <div class="row">                        
                        <div class="col-6 mb-3">
                        <button type="button" class="btn btn-success" name="add" id="add" >+ Add Days</button>
                            <form id="addRideForm2" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="csrf" content="{{ csrf_token() }}">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="login-input">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="start_location_0" placeholder="Start Location">
                                    </div>                                   
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="end_location_0" placeholder="End Location">
                                    </div>                                    
                                </div>
                                <h4>Road Amenties</h4>
                                <div class="login-input">
                                    <div class="form-group">
                                        <label class="radio">Was there any petrol pump available ?</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_petrol_pump_0" value="1" onChange="showHideField(this.value,0,'petrol_pump')">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_petrol_pump_0" value="0" checked onChange="showHideField(this.value,0,'petrol_pump')">
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group petrol_pump_0" style="display:none">
                                        <input type="text" class="form-control" name="petrol_pump_comment_0" placeholder="Add Your Comment">
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="radio">Was there any Restaurant/cafe ?</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_restaurant_0" value="1" onChange="showHideField(this.value,0,'restaurant_comment')">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_restaurant_0" value="0" onChange="showHideField(this.value,0,'restaurant_comment')" checked>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group restaurant_comment_0" style="display:none">
                                        <input type="text" class="form-control" name="is_restaurant_comment_0" placeholder="Add Your Comment">
                                    </div>

                                    <div class="form-group">
                                        <label class="radio">Was there any hotel available ?</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_hotel_0" value="1" onChange="showHideField(this.value,0,'is_hotel')">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_hotel_0" value="0" onChange="showHideField(this.value,0,'is_hotel')" checked>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group is_hotel_0" style="display:none">
                                        <input type="text" class="form-control" name="hotel_name_0" placeholder="Hotel name and location">
                                    </div>

                                    <div class="form-group is_hotel_0" style="display:none">
                                        <label class="radio">Parking was available at hotel ?</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_parking_0" value="1">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_parking_0" value="0" checked>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="form-group is_hotel_0" style="display:none">
                                        <label class="radio">Wifi was available at hotel room ?</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_wifi_0" value="1">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_wifi_0" value="0" checked>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Road Type</label>
                                        <select class="custom-select" name="road_type_0" style="width:150px;"> 
                                            <option value="1">Highway</option>
                                        </select> 
                                    </div>

                                    <div class="form-group">
                                        <input type="number" class="form-control" name="road_quality_0" min="1" max="5" placeholder="Road Quality">
                                    </div>

                                    <div class="form-group">
                                        <input type="number" class="form-control" name="road_quality_0" min="1" max="5" placeholder="Road Scenic">
                                    </div>

                                    <div class="form-group">
                                        <label>Add Images</label>
                                        <input type="file" class="form-control" name="ride_images_0[]" multiple >
                                    </div>
                                
                                    <div class="form-group">
                                        <textarea id="form7" class="md-textarea form-control" name="day_description_0"  rows="3" placeholder="Day description. i.e, How was your experience on this day"></textarea>
                                    </div>
                                    <div id="dynamic_field">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="save_later2" class="btn btn-danger w-20">SAVE FOR LATER</button>
                                        <button type="button" class="btn btn-danger w-20">BACK</button>
                                        <button type="button" id="rideStep2" class="btn btn-danger w-40">CONTINUE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
            </div>
            <div id="review_ride"></div>
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
			<button class="post-btn w-100 mb-3">Add Your Bike</button>
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item">
				   <h4 class="notify-heading">
						   Select your bike
					</h4>
				</li>
			   <li class="list-group-item">
				   <h4 class="notify-heading">
					   Add Bike Details
					</h4>
                </li>
                <li class="list-group-item">
				   <h4 class="notify-heading">
					   Review And Done
					</h4>
				</li>
			 </ul>
		   </div>
		   
		  </div>
		</div>
	  </div>
	</div>
  </section>
@stop