@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
              <a href="{{route('group.events', $group_id)}}">< Back to Group Events Page</a>
			<h2 class="page-heading">
			  Ride Locations
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1"></span><br/>
            </div>
			
			<div class="row" id="tab1">
			  <!-- repeat div from here START -->
				<div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-8 mb-3">                        
                            <form id="addEventForm1" method="post">
                                <input type="hidden" name="group_id" value="{{$group_id}}" >
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="login-input">
                                    <div class="form-group">
                                        <input type="text" class="form-control" autocomplete="off" name="start_location" id="start_location" placeholder="Start Locations">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" autocomplete="off" name="via_location[]" class="via_location" placeholder="Via Location">
                                        <i class="fa fa-plus" id="add_more_via"></i>
                                    </div>
                                    <div id="via_location_more"></div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" autocomplete="off" name="end_location" id="end_location" placeholder="End Locations">
                                    </div>
                                </div>

                                <h2 class="page-heading">Other Details</h2>
                                <div class="login-input">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="no_of_people" min="1" id="no_of_people" placeholder="People">
                                    </div>
                                    
                                    <div class="form-group">
                                        <textarea class="md-textarea form-control" name="short_description" id="short_description" rows="3" placeholder="Write short description about this ride"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="luggage" id="ride_luggage">
                                    </div>
                                    
                                    <div class="review-more-details">
                                        <h2 class="page-heading">Things to carry on this Ride</h2>
                                            <div class="d-flex align-items-center filter-details mb-4">
                                            <span class="filter-block1">We've accurated list of things to carry on. If you wish to edit or add anything just tap on Edit Button</span>
                                            <a href="javascript:void(0)" class="review-details" data-toggle="modal" data-target="#rideLuggageModal">Edit/Add</a>
                                        </div>
                                        
                                    </div>

                                    <h4 class="page-sub-heading">Bags</h4>
                                    <div>
                                        <ul class="list-content">
                                            <li>A sailor bag would be perfect, a walker bag too (without steel bar)</li>
                                            <li>You can close it with a padlock if you want to (Don't forget to tag it before leaving with your address</li>
                                            <li>A small backpack of 20 litres is advised for daily necessities such as camera, suncreen lotion</li>
                                        </ul>                               
                                    </div>

                                    <h4 class="page-sub-heading">Clothing and Personal Equipments</h4>
                                    <div>
                                        <ul class="list-content">
                                            <li>2 light pants</li>
                                            <li>4 shirts (including some with long sleeves, to protect yourself from the sun)</li>
                                            <li>1 bathing suit</li>
                                        </ul>                               
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="eventStep1" class="btn btn-danger w-30">CONTINUE</button>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                        
                    </div>
				</div>
            </div>
            
            <div class="row" id="tab2" style="display:none;">
				<div class="col-12 mb-3">
                    <div class="row">                        
                        <div class="col-8 mb-3">                            
                            <button type="button" class="btn btn-default back-btn" id="first_day">Day 1</button>
                            <button type="button" class="btn btn-success" name="add" id="add" >+ Add Days</button>
                            <form id="addEventForm2" method="post" enctype="multipart/form-data">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="login-input">
                                    <div class="form-group">
                                        <input type="text" class="form-control" autocomplete="off" name="start_location_0" placeholder="Start Location" readonly id="start_location_0">
                                    </div>                                   
                                    <div class="form-group">
                                        <input type="email" class="form-control" autocomplete="off" name="end_location_0" placeholder="End Location">
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
                                        <button type="button" id="backEventStep1" class="btn back-btn w-20"><< BACK</button>
                                        <button type="button" id="eventStep2" class="btn btn-danger w-40">CONTINUE</button>
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
			<button class="post-btn w-100 mb-3">Add Your Ride</button>
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item">
				   <h4 class="notify-heading">
						   <a href="#" data-toggle="modal" data-target="#bikeModal">Ride Locations</a>
					</h4>
				</li>
			   <li class="list-group-item">
				   <h4 class="notify-heading">
					   <a href="{{ route('add-ride')}}">Add Itinerary</a>
					</h4>
                </li>
                <li class="list-group-item">
				   <h4 class="notify-heading">
					   <a href="{{ route('add-ride')}}">Review And Done</a>
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