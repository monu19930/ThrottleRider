@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Event')
@section('content')
<section class="left-main-bg ">
    <div class="container ">
        <div class="row">
            <div class="col-md-4 d-none d-md-block">
                <div class="right-block pt-5">
                    <div class="left-filters-block">
                        <a href="{{route('my-groups.events', $group_id)}}" class="back-btn mb-4 d-inline-block"><i class="fa fa-angle-left mr-2"></i>Back to Group Events Page</a>
                        <h2 class="page-heading">
                            ADD YOUR EVENT
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
                                <input type="hidden" name="group_id" value="{{$group_id}}" >
                                <input type="hidden" name="added_by" value="group" >
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>


                                <div class="d-flex align-items-center w-100 mt-4">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-startlocation.svg')}}" class="img-fluid"></div>
                                    <div class="input-field mb-0 w-100 left-seprater-dotted">
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
                                        <input type="text" class="input-block" autocomplete="off" name="start_date" id="estart_date" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">Start Date</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mt-4 w-100">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-calendar.svg')}}" class="img-fluid img-icon"></div>
                                    <div class="input-field  mb-0 w-100">
                                        <input type="text" class="input-block" autocomplete="off" name="end_date" id="eend_date" placeholder=" ">
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
                    <div class="days-nav">
                        <ul class="nav nav-tabs mb-4 cust-tab" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation" id="first_day" content="2">
                                <a class="moreDays nav-link active" id="day1-tab" data-toggle="tab" href="#day1" role="tab" aria-controls="Day1" aria-selected="true"><span>Day 1</span></a>
                            </li>                           
                            <div id="more_days" class="nav nav-tabs mb-4 cust-tab"></div>
                            <li>
                                <a href="javascript:void(0)" class="text-red font-weight-normal nav-link" name="add" id="add"><i class="fa fa-plus"></i>&nbsp; Add Day 2</a>
                            </li>
                            <li class="ml-auto mr-2"><a href="#"><img src="{{asset('public/rider/images/icons-circles-menu.svg')}}"></a></li>
                        </ul>
                    </div>

                    <div class="tab-content" id="daysContent">
                        <form class="tab-content" id="addRideForm2" method="post" enctype="multipart/form-data">
                            <div class="tab-pane fade active show" id="day1" aria-labelledby="login-tab" role="tabpanel">
                                <h5 class="add-bike-heading">
                                    <!-- <span class="right-seperater">Day 1</span>Bangalore to Marvanthe -->

                                </h5>


                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center w-100">
                                            <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-startlocation.svg')}}" class="img-fluid img-icon"></div>

                                            <div class="input-field mb-0 w-100 left-seprater-dotted">
                                                <input type="text" name="start_location_0" id="start_location_0" class="input-block select-location" readonly placeholder=" ">
                                                <label for="search-bike" class="input-lbl">Start location</label>
                                            </div>

                                        </div>

                                        <div class="d-flex align-items-center mt-4 w-100">
                                            <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-destination.svg')}}" class="img-fluid img-icon"></div>

                                            <div class="input-field  mb-0 w-100">
                                                <input type="text" name="end_location_0" class="input-block" placeholder=" ">
                                                <label for="search-bike" class="input-lbl">Destination for this day</label>
                                            </div>

                                        </div>
                                        <h4 class="page-sub-heading mt-4 mb-2">Road Amenities
                                            <small>Help others to fill available amenities on your way.</small>
                                        </h4>
                                        <div class="tip d-flex mt-3">
                                            <span class="tip-head">Tip</span>
                                            <span class="tip-txt">Tap on <img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}" style="width:20px;" class="mx-1" /> to comment about particular section.<br>i.e. Road caution, One Petrol pump on this way e.t.c.</span>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 w-100">
                                            <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-petrol.svg')}}" class="img-fluid img-icon"></div>

                                            <div class="txt-14">
                                                Was there any Petrol pump?
                                            </div>
                                            <div class="can-toggle ml-auto">
                                                <input id="a" type="checkbox" name="is_petrol_pump_0">
                                                <label for="a" class="mb-0">
                                                    <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                                                </label>
                                            </div>
                                            <div class="add-via-btn"> <a href="javascript:void(0)" id="btnAdd" onclick="addCommentField('petrol_pump_comment_0')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
                                        </div>
                                        <div id="petrol_pump_comment_0"></div>
                                        <div class="d-flex align-items-center mt-4 w-100">
                                            <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-restaurant.svg')}}" class="img-fluid img-icon"></div>

                                            <div class="txt-14">
                                                Was there any Restaurant/ Cafe?
                                            </div>
                                            <div class="can-toggle ml-auto">
                                                <input id="b" type="checkbox" name="is_restaurant_0" checked>
                                                <label for="b" class="mb-0">
                                                    <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                                                </label>
                                            </div>
                                            <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('restaurant_comment_0')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
                                        </div>
                                        <div id="restaurant_comment_0"></div>
                                        <div class="d-flex align-items-center mt-4 w-100">
                                            <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-hotel.svg')}}" class="img-fluid img-icon"></div>

                                            <div class="txt-14">
                                                Was there any Hotel?
                                            </div>
                                            <div class="can-toggle ml-auto">
                                                <input id="c" type="checkbox" name="is_hotel_0" checked onchange="valueChanged(this)">
                                                <label for="c" class="mb-0">
                                                    <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                                                </label>

                                            </div>
                                            <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('hotel_comment_0')" ><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
                                        </div>
                                        <div id="hotel_comment_0"></div>
                                        <div id="checkbox-content" class="open-txt-box is_hotel_0">
                                            <textarea class="text-format" name="hotel_name_0" placeholder="Hotel name and location" style="height:52px;"></textarea>
                                        </div>
                                        <div class="d-flex align-items-center mt-4 w-100 is_hotel_0">
                                            <div class="mr-4 pr-3"></div>

                                            <div class="txt-14 pl-1">
                                                Parking was available at Hotel?
                                            </div>
                                            <div class="can-toggle ml-auto">
                                                <input id="d" type="checkbox" name="is_parking_0">
                                                <label for="d" class="mb-0">
                                                    <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                                                </label>
                                            </div>
                                            <!-- <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('parking_comment_0')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div> -->
                                        </div>
                                        <!-- <div id="parking_comment_0"></div> -->
                                        <div class="d-flex align-items-center mt-4 w-100 is_hotel_0">
                                            <div class="mr-4 pr-3"> </div>

                                            <div class="txt-14 pl-1">
                                                Wi-Fi was available at Hotel?
                                            </div>
                                            <div class="can-toggle ml-auto">
                                                <input id="e" type="checkbox" name="is_wifi_0" checked>
                                                <label for="e" class="mb-0">
                                                    <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                                                </label>
                                            </div>
                                            <!-- <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('wifi_comment_0')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div> -->
                                        </div>
                                        <!-- <div id="wifi_comment_0"></div> -->
                                        <div class="d-flex align-items-center w-100 mt-4">
                                            <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-road.svg')}}" class="img-fluid img-icon"></div>


                                            <div class="input-field mb-0 w-100">
                                                <select class="floating-select" name="road_type_0" onclick="this.setAttribute('value', this.value);" value="">
                                                    @foreach($road_types as $road_type)
                                                    <option value="{{$road_type->id}}">{{$road_type->road_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('road_type_comment_0')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
                                        </div>
                                        <div id="road_type_comment_0"></div>
                                        <div class="d-flex align-items-center mt-4 w-100">
                                            <div class="mr-4 pr-3"> </div>

                                            <div class="txt-14 pl-1">
                                                Road Quality
                                            </div>
                                            <div class="star-rating-block ml-auto">
                                                <input type="radio" name="road_quality_0" value="5"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="4"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="3"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="2"><span class="star"> </span>
                                                <input type="radio" name="road_quality_0" value="1" checked><span class="star"> </span>
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center mt-4 w-100">
                                            <div class="mr-4 pr-3"> </div>

                                            <div class="txt-14 pl-1">
                                                Road Scenic
                                            </div>
                                            <div class="star-rating-block ml-auto">
                                                <input type="radio" name="road_scenic_0" value="5"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="4"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="3"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="2"><span class="star"> </span>
                                                <input type="radio" name="road_scenic_0" value="1" checked><span class="star"> </span>
                                            </div>

                                        </div>

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
                                <h4 class="page-sub-heading mt-4 mb-2">Add Images
                                    <small>Got any shots on this way? Post here</small>
                                </h4>
                                <div class="drag-drop">
                                    <input type="file" name="ride_images_0[]" accept="image/*" id="drag-drop" multiple />
                                    <div id="uploads"></div>
                                    <div class="dropzone flex-row justify-content-start p-4" style="height:87px;" id="dropzone">
                                        <div class="drop-icon mr-3"><i class="fa fa-file-image-o"></i></div>
                                        <div class="drop-box-format">Drag and drop <span class="text-gray">or</span> <span class="text-danger">Select from Gallery</span></div>

                                    </div>
                                </div>
                                <textarea class="text-format mt-5" name="day_description_0" placeholder="Day description. i.e. How was your experience on this day? (Optional)"></textarea>
                            </div>
                            <div id="dynamic_field" class="tab-content"></div>
                        </form>
                    </div>


                    <hr class="full-h-line my-4">
                    <div class="text-right pb-3 d-flex align-items-center">
                        <button type="button" class="red-outline-btn px-5 mr-3">SAVE FOR LATER</button>
                        <!-- <button type="button" class="red-outline-btn ml-auto px-5 mr-3 back-day">BACK</button> -->
                        <button type="button" id="backRideStep1" class="red-outline-btn ml-auto px-5 mr-3">BACK</button>
                        <button type="button" class="post-btn lg px-5 next-day" onclick="moveToNextDay(0)">PROCEED TO DAY 2</button>
                        <button type="button" id="rideStep2" class="post-btn lg px-5" style="display:none;">CONTINUE</button>
                    </div>

                </div>
                <div class="cust-left-block pt-5" id="review_ride"></div>
            </div>
        </div>
    </div>
    </div>
</section>
@stop