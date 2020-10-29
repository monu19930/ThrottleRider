<section class="main-bg">
<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Review Ride Information
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">Bikes Added</span>
			</div>
			
			<div class="row">
            <div class="col-12 mb-3">
                            <h2>Ride to {{ $ride['end_location'] }} Via {{ implode(',',$ride['via_location'])}}</h2>
                            </div>
			  <!-- repeat div from here START -->			
				<div class="col-12 mb-3">

                <h4 class="location-title">Itinerary</h4>
                        @foreach($ride['rideDay'] as $key => $ride)
                        <div class="row">
                            <div class="col-12 mb-3">
                                Day {{$key+1}}
                                <div class="d-flex align-items-center location-block">
                                        <h4>{{$ride['start_location']}} To {{$ride['end_location']}}</h4>
                                    <span class="location">{{$ride['day_description']}}</span>
                                    <span class="time left-seperater">in month of <span>June 2019</span></span></span>
                                </div>
                                <div class="location-details d-flex align-items-center">
                                    <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
                                    <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
                                    <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
                                    <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
                                </div>
                                @if(isset($ride['ride_images']))
                                <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">                                    
                                    <img src="{{ asset('public/images/rides')}}/{{ $ride['ride_images'][0]}}" class="img-fluid">
                                </div>
                                @endif
                                <div class="userdetails d-flex align-items-center">
                                    <span class="username">
                                    <span class="d-block">Information</span>
                                    <span class="badge badge-warning">
                                    </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group">
                        <button type="button" id="save_later3" class="btn btn-danger w-20">SAVE FOR LATER</button>
                        <button type="button" class="btn btn-danger w-20">BACK</button>
                        <button type="button" onClick="submitRide()" id="riderSubmit" class="btn btn-danger w-40">DONE, SUBMIT</button>
                    </div>
				</div>
				</div>
			</div>		   
		  </div>
		</div>
	  </div>
    </div>