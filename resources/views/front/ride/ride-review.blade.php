<h5 class="add-bike-heading">
    Review ride information
    <small>Verify information you’ve entered and submit</small>
</h5>
<div class="d-flex align-items-center mt-4 mb-2">
    <h5 class="blue-heading mt-4 mb-3">Ride to {{ $ride['end_location']}} via {{ implode(',', $ride['via_location'])}}
        <small class="head-small-txt pt-1 d-block">from <span>{{ $ride['start_location']}}</span></small>
    </h5>
    <span class="ml-auto"><a href="#">Change</a></span>
</div>
<div class="rider-overview mt-3 mt-lg-0">
    @if(!empty($ride['short_description']))
    {{$ride['short_description']}} <a href="#">read more</a>
    @endif
</div>
<div class="d-flex align-items-center my-3">
    <div class="d-flex mt-3 mr-5">
        <div><img src="{{ asset('public/rider/images/icons-calendar.svg')}}"></div>
        <div class="pl-2">
            <small class="sml-txt d-block">In month of</small>
            <p class="timeline-keypoint">{{formatDate($ride['start_date'], 'M Y')}}</p>
        </div>
    </div>
    <div class="d-flex mt-3">
        <div><img src="{{ asset('public/rider/images/icons-people.svg')}}"></div>
        <div class="pl-2">
            <small class="sml-txt d-block">People</small>
            <p class="timeline-keypoint">{{$ride['no_of_people']}}</p>
        </div>
    </div>
</div>
<hr class="full-h-line my-4" />


<div class="d-flex align-items-center mt-4 mb-2">
    <h4 class="page-sub-heading">Things to carry on this Ride</h4>
    <span class="ml-auto filter-block3 mob-filter"><a href="#" data-toggle="modal" data-target="#changedetails">Change</a></span>
</div>

<div class="rider-overview mt-3 mt-lg-0">We’ve a curated list of things to carry on. If you wish to edit or add anything just tap on Edit button.</div>
<h4 class="page-sub-heading mt-4 mb-2">Bags</h4>
<div class="rider-overview mt-3 mt-lg-0">- A sailor bag would be perfect, a walker's bag too (without steel bar). <br>
    - You can close it with a padlock if you want to (Don't forget to tag it before leaving with your address<br>
    - A small backpack of 20 litres is advised for daily necessities such as camera, sunscreen lotion</div>
<h4 class="page-sub-heading mt-4 mb-2">Clothing and Personal Equipments</h4>
<div class="rider-overview mt-3 mt-lg-0">- 2 light pants<br>
    - 4 shirts (including some with long sleeves, to protect yourself from the sun)<br>
    - 1 bathing suit
</div>
<a href="#" class="d-inline-block font-weight-bold mt-4">Read more <i class="fa fa-angle-down ml-1"></i> </a>
<hr class="full-h-line my-4" />
<h4 class="page-sub-heading">Itinerary</h4>
<div class="reiview-itinerary">
    <ul class="cust-timeline">
        @foreach($ride['rideDay'] as $key => $rideDay)
        <li>
            <div class="row">
                <div class="col-12 col-md pr-0">
                    <h5 class="m-0 p-0 timeline-day">Day {{$key+1}}</h5>
                </div>
                <div class="col-9 col-md-7">
                    <h4 class="page-sub-heading">{{$rideDay['start_location']}} to {{$rideDay['end_location']}}</h4>
                    <div class="timeline-txt">
                        @if(!empty($rideDay['day_description']))
                        Day {{$key+1}} {{$rideDay['day_description']}}<a href="#">read more</a>
                        @endif 
                    </div>
                    <div class="d-none d-md-block">
                        <div class="byker-profile-rate d-inline-flex align-items-center mt-3 ">

                            <span class="d-flex align-items-center px-4 h-100 border-right justify-content-center">
                                <span class="star-txt"><i class="fa fa-star"></i> {{$rideDay['road_quality']}}</span>
                                <small class="sml-txt">Road Quality</small>
                            </span>
                            <span class="d-flex align-items-center px-4 h-100 justify-content-center ">
                                <span class="star-txt"><i class="fa fa-star"></i> {{$rideDay['road_scenic']}}</span>
                                <small class="sml-txt">Scenery</small>
                            </span>

                        </div>
                        <div class="d-flex mt-3">
                            <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                            <div class="pl-2">
                                <small class="sml-txt d-block">Distance from {{$rideDay['start_location']}}</small>
                                <p class="timeline-keypoint">{{$rideDay['total_km']}} km</p>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <div><img src="{{ asset('public/rider/images/icons-petrol.svg')}}"></div>
                            <div class="pl-2">
                                <small class="sml-txt d-block">Petrol Pump</small>
                                @if(isset($rideDay['is_petrol_pump']) && ($rideDay['is_petrol_pump']==1))
                                <p class="timeline-keypoint">Yes, {{isset($rideDay['petrol_pump_comment']) ? $rideDay['petrol_pump_comment'] : ''}}</p>
                                @else
                                <p class="timeline-keypoint">No</p>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex mt-3">
                            <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                            <div class="pl-2">
                                <small class="sml-txt d-block">Hotel</small>
                                @if(isset($rideDay['is_hotel']) && $rideDay['is_hotel']==1)
                                <p class="timeline-keypoint">Yes</p>
                                @else
                                <p class="timeline-keypoint">No</p>
                                @endif
                            </div>
                        </div>

                        @if(isset($rideDay['is_hotel']) && $rideDay['is_hotel']==1)
                        <div class="d-flex mt-3">
                            <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                            <div class="pl-2">
                                <small class="sml-txt d-block">Place of stay at {{$rideDay['end_location']}}</small>
                                <p class="timeline-keypoint">{{$rideDay['hotel_name']}} <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{urlencode($rideDay['hotel_name'])}}" class="ml-1 font-weight-bold">View on Map</a></p>
                            </div>
                        </div>
                        @endif
                        <div class="d-flex align-items-center mt-4">
                            <div class="d-flex align-items-center pr-2 pr-lg-4 border-right not-available">
                                <span><img src="{{ asset('public/rider/images/parking.png')}}"></span>
                                <span class="timeline-txt ml-2">Parking available</span>
                            </div>
                            <div class="d-flex align-items-center px-2 px-lg-4 border-right">
                                <span><img src="{{ asset('public/rider/images/wifi.png')}}"></span>
                                <span class="timeline-txt ml-2">Wi-fi</span>
                            </div>
                            <div class="d-flex align-items-center pl-lg-4 pl-2">
                                <span><img src="{{ asset('public/rider/images/food.png')}}"></span>
                                <span class="timeline-txt ml-2">Food available</span>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-3 text-right">
                    <img src="{{ asset('public/images/rides/')}}/{{isset($rideDay['ride_images'][0]['image']) ? $rideDay['ride_images'][0]['image'] : 'not_found.png'}}" class="img-fluid timeline-img"><small class="no-of-imgs">
                    @if(isset($rideDay['ride_images']) && count($rideDay['ride_images']) > 1)
                    {{count($rideDay['ride_images'])}}+ Photos
                    @endif
                    </small>
                </div>
                <div class="col-1 text-right"><a href="#">Change</a> </div>
                <div class="col-12 d-md-none ">
                    <div class="byker-profile-rate d-inline-flex align-items-center mt-3 ">

                        <span class="d-flex align-items-center px-4 h-100 border-right justify-content-center"><span class="star-txt"><i class="fa fa-star"></i> {{$rideDay['road_quality']}}</span> <small class="sml-txt">Road Quality</small></span>
                        <span class="d-flex align-items-center px-4 h-100 justify-content-center "><span class="star-txt"><i class="fa fa-star"></i> {{$rideDay['road_scenic']}}</span> <small class="sml-txt">Scenery</small></span>

                    </div>
                    <div class="d-flex mt-3">
                        <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                        <div class="pl-2">
                            <small class="sml-txt d-block">Distance from {{$rideDay['start_location']}}</small>
                            <p class="timeline-keypoint">{{$rideDay['total_km']}} km</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mt-3">
                      <div><img src="{{ asset('public/rider/images/icons-petrol.svg')}}"></div>
                      <div class="pl-2">
                        <small class="sml-txt d-block">Petrol Pump</small>
                        @if(isset($rideDay['is_petrol_pump']) && ($rideDay['is_petrol_pump']==1))
                        <p class="timeline-keypoint">Yes, {{isset($rideDay['petrol_pump_comment']) ? $rideDay['petrol_pump_comment'] : ''}}</p>
                        @else
                        <p class="timeline-keypoint">No</p>
                        @endif
                      </div>
                    </div>

                    <div class="d-flex mt-3">
                      <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                      <div class="pl-2">
                        <small class="sml-txt d-block">Hotel</small>
                        @if(isset($rideDay['is_hotel']) && $rideDay['is_hotel']==1)
                        <p class="timeline-keypoint">Yes</p>
                        @else
                        <p class="timeline-keypoint">No</p>
                        @endif
                      </div>
                    </div>

                    
                    @if(isset($rideDay['is_hotel']) && $rideDay['is_hotel']==1)
                    <div class="d-flex mt-3">
                      <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                      <div class="pl-2">
                        <small class="sml-txt d-block">Place of stay at {{$rideDay['end_location']}}</small>
                        <p class="timeline-keypoint">{{$rideDay['hotel_name']}} <a href="https://www.google.com/maps/search/?api=1&query={{urlencode($rideDay['hotel_name'])}}" class="ml-1 font-weight-bold">View on Map</a></p>
                      </div>
                    </div>
                    @endif

                    <div class="d-flex align-items-center mt-4">
                        <div class="d-flex align-items-center pr-2 pr-lg-4 border-right">
                            <span><img src="images/parking.png"></span>
                            <span class="timeline-txt ml-2">Parking available</span>
                        </div>
                        <div class="d-flex align-items-center px-2 px-lg-4 border-right">
                            <span><img src="images/wifi.png"></span>
                            <span class="timeline-txt ml-2">Wi-fi</span>
                        </div>
                        <div class="d-flex align-items-center pl-lg-4 pl-2">
                            <span><img src="images/food.png"></span>
                            <span class="timeline-txt ml-2">Food available</span>
                        </div>

                    </div>
                </div>
            </div>
        </li>
        @endforeach       
    </ul>
</div>
<hr class="full-h-line my-4">
<div class="text-right pb-3 d-flex align-items-center">
    <button type="button" class="red-outline-btn px-5 mr-3">SAVE FOR LATER</button>
    <button type="button" onClick="rideDetailsPage()" class="red-outline-btn px-5 mr-3 ml-auto">Back</button>
    <button type="button" onClick="submitRide()" id="riderSubmit" class="post-btn lg px-5 ">Done, Submit</button>
</div>