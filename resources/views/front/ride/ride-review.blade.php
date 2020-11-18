<section class="main-bg">
<div class="container ">
	  <div class="row">
		<div class="col-md-12">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Review Ride Information
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">Ride Added Details</span>
			</div>
			
			<div class="row">
            <div class="col-12 mb-3">
                            <h4>Ride to {{ $ride['end_location'] }} Via {{ implode(',',$ride['via_location'])}}</h4>
                            </div>
			  <!-- repeat div from here START -->			
				<div class="col-12 mb-3">

                <h4 class="location-title">Itinerary</h4>
                        @foreach($ride['rideDay'] as $key => $field)
                        

                        <ul>
                    <li class="col-12 mb-3">
                      <span>Day {{$key+1}}</span>
                      <div class="d-flex align-items-center location-block">
                        <h4>{{$field['start_location']}} To {{$field['end_location']}}</h4>
                      </div>
                      <div class="row">
                        @if(!empty($field['day_description']))
                        <div class="col-md-6">
                          <p>{{$field['day_description']}}</p>
                        </div>
                        @endif
                        <div class="col-md-6">
                          @if(isset($field['ride_images']))
                          <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
                            <img src="{{ asset('public/images/rides/')}}/{{ $field['ride_images'][0]}}" class="img-fluid">
                          </div>
                          @endif
                        </div>
                      </div>
                      
                      <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                          <span>
                            <i class="fa fa-star"></i> {{$field['road_quality']}} <small>Road Quality</small>
                          </span>
<span>                            <i class="fa fa-star"></i> {{$field['road_scenic']}} <small>Road Scenic</small>
                          </span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                        <span class="">
                          <i class="fa fa-map"></i> 2176 km <small>from {{$field['start_location']}}</small>
                        </span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <span class="{{($field['is_petrol_pump']==0) ? 'not-available' : ''}}">
                          <i class="fa fa-home"></i> <small>Petrol Pump</small>
                        </span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <span class="{{($field['is_restaurant']==0) ? 'not-available' : ''}}">
                        <i class="fa fa-cutlery" aria-hidden="true"></i> <small>Restaurant Available</small>
                        </span>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                        <span class="{{($field['is_hotel']==0) ? 'not-available' : ''}}">
                        <i class="fa fa-h-square" aria-hidden="true"></i> <small>Hotel Available</small>
                        </span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <span class="{{($field['is_parking']==0) ? 'not-available' : ''}}">
                          <i class="fa fa-road"></i> <small>Parking Available</small>
                        </span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <span class="{{($field['is_wifi']==0) ? 'not-available' : ''}}">
                        <i class="fa fa-wifi" aria-hidden="true"></i> <small>Wifi Available</small>
                        </span>
                        </div>
                      </div>

                      </div>
                    </li>
                  </ul>
                        @endforeach

                        <div class="form-group">
                        <!-- <button type="button" id="save_later3" class="btn back-btn w w-20">SAVE FOR LATER</button> -->
                        <button type="button" onClick="rideDetailsPage()" class="btn back-btn w-20"> << BACK</button>
                        <button type="button" onClick="submitRide()" id="riderSubmit" class="btn btn-danger w-40">DONE, SUBMIT</button>
                    </div>
				</div>
				</div>
			</div>		   
		  </div>
		</div>
	  </div>
    </div>