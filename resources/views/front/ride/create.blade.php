@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Ride')
@section('content')
<section class="left-main-bg ">
    <div class="container ">
        <div class="row">
            <div class="col-md-4 d-none d-md-block">
                <div class="right-block pt-5">
                    <div class="left-filters-block">
                        <a href="{{route('my-rides')}}" class="back-btn mb-4 d-inline-block"><i class="fa fa-angle-left mr-2"></i>Back to My Trips</a>
                        <h2 class="page-heading">
                            ADD YOUR RIDE
                            <small>Been somewhere? Add details in 3 simple steps here and
                                get rewards. </small>
                        </h2>
                        <div class="card mt-5 mb-3 mob-top-links">
                            <ul class="list-group list-group-flush bike-select-block">
                                <li class="list-group-item active-list" id="progressStep1">
                                    <div class="d-flex ">
                                        <span class="bike-select-number" id="bikeProgress1">1</span>
                                        <div class="bike-select-txt">Ride locations <small class="sml-txt-md d-block">Start and destination city or place.</small></div>
                                    </div>
                                </li>
                                <li class="list-group-item" id="progressStep2">
                                    <div class="d-flex ">
                                        <span class="bike-select-number" id="bikeProgress2">2</span>
                                        <div class="bike-select-txt">Add itinerary <small class="sml-txt-md d-block">How many days?</small></div>
                                    </div>
                                </li>
                                <li class="list-group-item" id="progressStep3">
                                    <div class="d-flex ">
                                        <span class="bike-select-number" id="bikeProgress3">3</span>
                                        <div class="bike-select-txt">Review and Done <small class="sml-txt-md d-block">Check all information and Submit</small></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="cust-left-block pt-5" id="tab1">

                    <h5 class="add-bike-heading">Ride locations
                        <small>Pin your start point, stopages and destination point. </small>
                    </h5>

                    <div class="row" id="tab1">
                        <!-- repeat div from here START -->
                        <div class="col-7">
                            <form id="addRideForm1" method="post">
                                <input type="hidden" name="csrf" content="{{ csrf_token() }}">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>


                                <div class="d-flex align-items-center w-100 mt-4">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-startlocation.svg')}}" class="img-fluid"></div>
                                    <div class="mb-0 w-100 left-seprater-dotted">
                                        <input type="text" class="input-block" autocomplete="off" name="start_location" id="start_location" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">Start location</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center w-100  mt-4">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-via.svg')}}" class="img-fluid img-icon"></div>
                                    <div class="input-field  mb-0 w-100 left-seprater-dotted">
                                        <input type="text" class="input-block via_location" autocomplete="off" name="via_location[]" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">Via</label>
                                    </div>
                                    <div class="add-via-btn">
                                        <a href="javascript:void(0)" id="add_more_via"><img src="{{ asset('public/rider/images/icons-clickable-add.svg')}}"></a>
                                    </div>
                                    <!-- <i class="btn btn-outline-success fa fa-plus ml-2" id="add_more_via"></i> -->
                                </div>

                                <div id="via_location_more"></div>

                                <div class="d-flex align-items-center mt-4 w-100">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-destination.svg')}}" class="img-fluid img-icon"></div>
                                    <div class="input-field  mb-0 w-100">
                                        <input type="text" class="input-block" autocomplete="off" name="end_location" id="end_location" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">Destination</label>
                                    </div>
                                </div>

                                <h4 class="page-sub-heading mt-4 mb-2">Other details</h4>

                                <div class="d-flex align-items-center mt-4 w-100">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-calendar.svg')}}" class="img-fluid img-icon"></div>
                                    <div class="input-field  mb-0 w-100">
                                        <input type="text" class="input-block" autocomplete="off" name="start_date" id="start_date" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">Start Date</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mt-4 w-100">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-calendar.svg')}}" class="img-fluid img-icon"></div>
                                    <div class="input-field  mb-0 w-100">
                                        <input type="text" class="input-block" autocomplete="off" name="end_date" id="end_date" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">End Date</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center w-100 mt-4">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-people.svg')}}" class="img-fluid img-icon"></div>
                                    <div class="input-field  mb-0 w-100">
                                        <input type="number" class="input-block" autocomplete="off" min="1" name="no_of_people" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">People</label>
                                    </div>
                                </div>

                                <div class="mt-5 w-100">
                                    <input type="hidden" name="luggage" id="ride_luggage">
                                    <textarea class="text-format" name="short_description" id="short_description" placeholder="Write short description about this ride" style="height:88px;"></textarea>

                                </div>
                            </form>
                        </div>
                        <div class="col-4 ml-auto">
                            <div class="card">
                                <div class="map-location rounded-top"><img src="{{ asset('public/rider/images/map1.png')}}" class="img-fluid" /></div>
                                <div class="card-body">
                                    <!-- <h4 class="page-sub-heading  mb-0">2176 km <small class="sml-txt">From Bengaluru to Delhi via Goa</small></h4> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-4 mb-2">
                        <h4 class="page-sub-heading">Things to carry on this Ride</h4>
                        <span class="ml-auto filter-block3 mob-filter"><a href="javascript:void(0)" data-toggle="modal" data-target="#rideLuggageModal">Edit/Add</a></span>
                    </div>
                    <div class="rider-overview mt-3 mt-lg-0">We’ve a curated list of things to carry on. If you wish to edit or add anything just tap on Edit button.</div>

                    <h4 class="page-sub-heading mt-5 mb-2">Bags</h4>
                    <div class="rider-overview mt-3 mt-lg-0">- A sailor bag would be perfect, a walker's bag too (without steel bar). <br>
                        - You can close it with a padlock if you want to (Don't forget to tag it before leaving with your address<br>
                        - A small backpack of 20 litres is advised for daily necessities such as camera, sunscreen lotion
                    </div>
                    <h4 class="page-sub-heading mt-4 mb-2">Clothing and Personal Equipments</h4>
                    <div class="rider-overview mt-3 mt-lg-0">- 2 light pants<br>
                        - 4 shirts (including some with long sleeves, to protect yourself from the sun)<br>
                        - 1 bathing suit
                    </div>
                    <a href="javascript:void(0)" class="d-inline-block font-weight-bold mt-4">Read more <i class="fa fa-angle-down ml-1"></i> </a>
                    <hr class="full-h-line my-4">
                    <div class="text-right pb-3 d-flex align-items-center">
                        <!-- <button class="red-outline-btn px-5 mr-3">SAVE FOR LATER</button> -->
                        <button type="button" id="rideStep1" class="post-btn lg px-5 ml-auto">CONTINUE</button>
                    </div>
                </div>


                <div class="cust-left-block pt-5" id="tab2" style="display:none;">
                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-8 mb-3">
                                <button type="button" class="btn btn-outline-success" id="first_day">Day 1</button>
                                <button type="button" class="btn btn-success" name="add" id="add">+ Add Days</button>
                                <form id="addRideForm2" method="post" enctype="multipart/form-data">
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
                                        <div class="input-field mt-4 w-100">
                                            <input type="text" class="input-block" autocomplete="off" name="start_location_0" id="start_location_0" readonly placeholder=" ">
                                            <label for="search-bike" class="input-lbl">Start Location</label>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
                                        <div class="input-field mt-4 w-100">
                                            <input type="text" class="input-block" autocomplete="off" name="end_location_0" id="end_location_0" placeholder=" ">
                                            <label for="search-bike" class="input-lbl">Destination for this day</label>
                                        </div>
                                    </div>



                                    <h5 class="add-bike-heading">Road Amenities
                                        <small>Help others to fill available amenities on your way.</small>
                                    </h5>

                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
                                        <div class="input-field mt-4 w-100">
                                            <label class="radio">Was there any petrol pump available ?</label>
                                            <input type="radio" autocomplete="off" name="is_petrol_pump_0" value="0" checked onChange="showHideField(this.value,0,'petrol_pump')"> No
                                            <input type="radio" autocomplete="off" name="is_petrol_pump_0" value="1" onChange="showHideField(this.value,0,'petrol_pump')"> Yes
                                        </div>
                                    </div>
                                    <div class="align-items-center w-100 petrol_pump_0" style="display:none">
                                        <div class="mr-2 pr-1"></div>
                                        <div class="input-field mt-4 w-100">
                                            <input type="text" class="input-block" autocomplete="off" name="petrol_pump_comment_0" placeholder=" ">
                                            <label for="search-bike" class="input-lbl">Add Your Comment</label>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
                                        <div class="input-field mt-4 w-100">
                                            <label class="radio">Was there any Restaurant/cafe ?</label>
                                            <input type="radio" autocomplete="off" name="is_restaurant_0" value="0" checked onChange="showHideField(this.value,0,'restaurant_comment')"> No
                                            <input type="radio" autocomplete="off" name="is_restaurant_0" value="1" onChange="showHideField(this.value,0,'restaurant_comment')"> Yes
                                        </div>
                                    </div>
                                    <div class="align-items-center w-100 restaurant_comment_0" style="display:none">
                                        <div class="mr-2 pr-1"></div>
                                        <div class="input-field mt-4 w-100">
                                            <input type="text" class="input-block" autocomplete="off" name="is_restaurant_comment_0" placeholder=" ">
                                            <label for="search-bike" class="input-lbl">Add Your Comment</label>
                                        </div>
                                    </div>


                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
                                        <div class="input-field mt-4 w-100">
                                            <label class="radio">Was there any hotel available ?</label>
                                            <input type="radio" autocomplete="off" name="is_hotel_0" value="0" checked onChange="showHideField(this.value,0,'is_hotel')"> No
                                            <input type="radio" autocomplete="off" name="is_hotel_0" value="1" onChange="showHideField(this.value,0,'is_hotel')"> Yes
                                        </div>
                                    </div>

                                    <div class="align-items-center w-100 is_hotel_0" style="display:none">
                                        <div class="mr-2 pr-1"></div>
                                        <div class="input-field mt-4 w-100">
                                            <input type="text" class="input-block" autocomplete="off" name="hotel_name_0" placeholder=" ">
                                            <label for="search-bike" class="input-lbl">Hotel name and location</label>
                                        </div>
                                    </div>
                                    <div class="align-items-center w-100 is_hotel_0" style="display:none">
                                        <div class="mr-2 pr-1"></div>
                                        <div class="input-field mt-4 w-100">
                                            <label class="radio">Parking was available at hotel ?</label>
                                            <input type="radio" autocomplete="off" name="is_parking_0" value="0"> No
                                            <input type="radio" autocomplete="off" name="is_parking_0" value="1" checked> Yes
                                        </div>
                                    </div>
                                    <div class="align-items-center w-100 is_hotel_0" style="display:none">
                                        <div class="mr-2 pr-1"></div>
                                        <div class="input-field mt-4 w-100">
                                            <label class="radio">Wifi was available at hotel room ?</label>
                                            <input type="radio" autocomplete="off" name="is_wifi_0" value="0"> No
                                            <input type="radio" autocomplete="off" name="is_wifi_0" value="1" checked> Yes
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
                                        <div class="input-field mt-4 w-100">
                                            <select class="custom-select" name="road_type_0" placeholder="Road Type">
                                                @foreach($road_types as $road_type)
                                                <option value="{{$road_type->id}}">{{$road_type->road_type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-4">
                                            <span class="rating-txt">Road Quality</span>
                                        </div>
                                        <div class="col-4">
                                            <div class="star-rating-block">
                                                <input type="radio" name="road_quality_0" value="5"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="4"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="3"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="2"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="1" checked><span class="star"> </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-4">
                                            <span class="rating-txt">Road Scenic</span>
                                        </div>
                                        <div class="col-4">
                                            <div class="star-rating-block">
                                                <input type="radio" name="road_scenic_0" value="5"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="4"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="3"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="2"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="1" checked><span class="star"> </span>
                                            </div>
                                        </div>
                                    </div>


                                    <h5 class="add-bike-heading mt-4">Add Images
                                        <small>Got any shots on this way? Post here</small>
                                    </h5>
                                    <div class="form-group mt-2">
                                        <input type="file" class="form-control" name="ride_images_0[]" multiple>
                                    </div>

                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-2 pr-1"></div>
                                        <div class="input-field mt-4 w-100">
                                            <textarea class="text-format" name="day_description_0" rows="3" placeholder="Day description. i.e, How was your experience on this day"></textarea>
                                        </div>
                                    </div>

                                    <div id="dynamic_field"></div>

                                    <hr class="full-h-line my-4">
                                    <div class="text-right pb-3">
                                        <button type="button" id="backRideStep1" class="post-btn  px-5">
                                            BACK</button> <button type="button" id="rideStep2" class="post-btn  px-5">CONTINUE
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cust-left-block pt-5" id="review_ride"></div>
            </div>
        </div>
    </div>
    </div>
</section>
@stop