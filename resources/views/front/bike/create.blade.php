@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Bike')
@section('content')
<section class="left-main-bg ">
    <div class="container ">
        <div class="row">
            <div class="col-md-4 d-none d-md-block">
                <div class="right-block pt-5">
                    <div class="left-filters-block">
                        <a href="{{route('bikes')}}" class="back-btn mb-4 d-inline-block"><i class="fa fa-angle-left mr-2"></i>Back to My Bikes</a>
                        <h2 class="page-heading">
                            ADD YOUR BIKE
                            <small>Own a bike? Add here in 3 simple steps and
                                get rewards from Throttle Rides. </small>
                        </h2>
                        <div class="card mt-5 mb-3 mob-top-links">
                            <ul class="list-group list-group-flush bike-select-block">
                                <li class="list-group-item active-list" id="progressStep1">
                                    <div class="d-flex ">
                                        <span class="bike-select-number" id="bikeProgress1">1</span>
                                        <div class="bike-select-txt">Select your bike <small class="sml-txt-md d-block">Bike name, model, type e.t.c.</small></div>
                                    </div>
                                </li>
                                <li class="list-group-item" id="progressStep2">
                                    <div class="d-flex ">
                                        <span class="bike-select-number" id="bikeProgress2">2</span>
                                        <div class="bike-select-txt">Add Bike details <small class="sml-txt-md d-block">Images, KMs, Rides e.t.c.</small></div>
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
                <div class="cust-left-block pt-5" id="bike_tab1">
                    <div class="row">
                        <div class="col-8">
                            <form id="addBikeForm1" method="post">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <h5 class="add-bike-heading">Select your bike<small>Choose brand, bike and model</small></h5>
                                <div class="input-field my-4">
                                    <input type="text" autocomplete="off" name="name" value="{{isset($name) ? $name : ''}}" id="bike_list" class="input-block" placeholder=" ">
                                    <label for="search-bike" class="input-lbl">Search for bike brand or model name</label>
                                </div>
                                <h5 class="add-bike-heading"><small>or choose from following brands:-</small></h5>
                                <div class="d-flex flex-wrap">
                                    @foreach($brands as $key => $brand)
                                    <a class="logo-block {{($key < 8) ? '': 'bike_brands collapse'}}" style="cursor:pointer;" onclick="showBikeModelList('{{$brand->id}}')">
                                        <span class="d-block"><img src="http://localhost/gull-html-laravel/public/images/bike_brands/{{$brand->logo}}" style="width: 60px;height: 54px;" /></span>
                                        <span class="d-block mt-2">{{$brand->brand_name}}</span>
                                    </a>
                                    @endforeach
                                </div>
                                @if(count($brands) > 8)
                                <a href="javascript:void(0)" data-toggle="collapse" data-target=".bike_brands" onclick="showHideBrands()" class="d-inline-block font-weight-bold mt-4" id="view_more_brands">Show more brands <i class="fa fa-angle-down ml-1"></i></a>
                                @endif
                            </form>
                        </div>
                        <div class="col-4">
                            <div class="bike-prev flex-column bike-icon" id="bike-icon">
                                <span><img src="{{ asset('public/rider/images/bike-icon.png')}}" /></span>
                                <span>Selected bike will be shown here.</span>
                            </div>

                            <div class="bike-prev flex-column selected_bike" style="display:none">
                                <img src="" alt="" width="200" height="200" id="selected_bike" />
                                <div class="selected-list d-flex">
                                    <span class="bike-select-number">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>selected
                                </div>
                                <h5 class="add-bike-heading" id="model_name">Royal Enfield 650</h5>
                            </div>
                        </div>
                    </div>
                    <hr class="full-h-line my-4">
                    <div class="text-right pb-3">
                        <button class="post-btn  px-5" id="submitBikeStep1">CONTINUE</button>
                    </div>
                </div>
                <div class="cust-left-block pt-5" id="bike_tab2" style="display:none">
                    <form id="addBikeForm2" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{isset($id) ? $id : ''}}">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <h5 class="add-bike-heading">Add bike details
                            <small>Fill details for better review and profile buildup.</small>
                        </h5>
                        <h4 class="page-sub-heading mt-4 mb-2">Upload bike images</h4>
                        <div class="drag-drop">
                            @if(isset($images))
                                <div class="form-group">
                                    @foreach($images as $image)
                                        <img src="{{ asset('public/images/rider/bikes/')}}/{{$image}}" style="width:200px; height:150px">
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" name="image[]" id="drag-drop" multiple />
                            <div id="uploads"></div>
                            <div class="dropzone" id="dropzone">
                                <div class="drop-icon"><i class="fa fa-file-image-o"></i></div>
                                <div class="drop-box-format mt-2">Drag and drop <span class="text-gray">or</span>
                                    <span class="text-danger">Select from Gallery</span>
                                </div>
                                <small class="sml-txt-md mt-2">Tip: For better buildup, Please upload Bike front and Odometer Photos.</small>
                            </div>
                        </div>
                        <h4 class="page-sub-heading mt-4 mb-2">Highlight details</h4>
                        <div class="row">
                            <div class="col-7">
                                <div class="d-flex align-items-center w-100">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>

                                    <div class="input-field mt-4 w-100">
                                        <input type="text" autocomplete="off" name="total_km" id="total_km" value="{{isset($total_km) ? $total_km : ''}}" class="input-block" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">KMs driven</label>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center w-100">
                                    <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-destination.svg')}}" class="img-fluid"></div>

                                    <div class="input-field  mb-0 w-100">
                                        <input type="text" autocomplete="off" name="total_rides" id="total_rides" value="{{isset($total_rides)?$total_rides:''}}" class="input-block" placeholder=" ">
                                        <label for="search-bike" class="input-lbl">Rides you’ve completed with this bike?</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <h4 class="page-sub-heading mt-4 mb-2">Rate your bike</h4>
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <span class="rating-txt">Comfortness</span>
                            </div>
                            <div class="col-4">
                                <div class="star-rating-block">
                                    <input type="radio" name="comfortness" value="5" 
                                    @if(isset($comfortness) && $comfortness==5)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="comfortness" value="4" 
                                    @if(isset($comfortness) && $comfortness==4)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="comfortness" value="3" 
                                    @if(isset($comfortness) && $comfortness==3)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="comfortness" value="2" 
                                    @if(isset($comfortness) && $comfortness==2)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="comfortness" value="1" 
                                    @if(isset($comfortness) && $comfortness==1)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <span class="rating-txt">Visual Appeal</span>
                            </div>
                            <div class="col-4">
                                <div class="star-rating-block">
                                    <input type="radio" name="visual_appeal" value="5" 
                                    @if(isset($visual_appeal) && $visual_appeal==5)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="visual_appeal" value="4" 
                                    @if(isset($visual_appeal) && $visual_appeal==4)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="visual_appeal" value="3" 
                                    @if(isset($visual_appeal) && $visual_appeal==3)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="visual_appeal" value="2" 
                                    @if(isset($visual_appeal) && $visual_appeal==2)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="visual_appeal" value="1" 
                                    @if(isset($visual_appeal) && $visual_appeal==1)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <span class="rating-txt">Reliability</span>
                            </div>
                            <div class="col-4">
                                <div class="star-rating-block">
                                    <input type="radio" name="reliability" value="5" 
                                    @if(isset($reliability) && $reliability==5)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="reliability" value="4" 
                                    @if(isset($reliability) && $reliability==4)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="reliability" value="3" 
                                    @if(isset($reliability) && $reliability==3)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="reliability" value="2" 
                                    @if(isset($reliability) && $reliability==2)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="reliability" value="1" 
                                    @if(isset($reliability) && $reliability==1)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <span class="rating-txt">Performance</span>
                            </div>
                            <div class="col-4">
                                <div class="star-rating-block">
                                    <input type="radio" name="performance" value="5" 
                                    @if(isset($performance) && $performance==5)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="performance" value="4" 
                                    @if(isset($performance) && $performance==4)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="performance" value="3" 
                                    @if(isset($performance) && $performance==3)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="performance" value="2" 
                                    @if(isset($performance) && $performance==2)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="performance" value="1" 
                                    @if(isset($performance) && $performance==1)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <span class="rating-txt">Service Experience</span>
                            </div>
                            <div class="col-4">
                                <div class="star-rating-block">
                                    <input type="radio" name="service_experience" value="5" 
                                    @if(isset($service_experience) && $service_experience==5)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="service_experience" value="4" 
                                    @if(isset($service_experience) && $service_experience==4)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="service_experience" value="3" 
                                    @if(isset($service_experience) && $service_experience==3)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="service_experience" value="2" 
                                    @if(isset($service_experience) && $service_experience==2)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                    <input type="radio" name="service_experience" value="1" 
                                    @if(isset($service_experience) && $service_experience==1)
                                        checked
                                    @endif
                                    /><span class="star"> </span>
                                </div>
                            </div>
                        </div>
                        <h4 class="page-sub-heading mt-4 mb-2">Other (Optional)</h4>
                        <textarea class="text-format" name="info" id="description" placeholder="Anything else you want to share about this bike? Write it down here">{{isset($info) ? $info : ''}}</textarea>

                        <hr class="full-h-line my-4">
                        <div class="text-right pb-3">
                            <button type="button" class="red-outline-btn px-5 mr-3" id="backBikeStep1">BACK</button>
                            <button type="button" class="post-btn lg px-5" id="submitBikeStep2">CONTINUE</button>
                        </div>
                    </form>
                </div>
                <div class="cust-left-block pt-5" id="review_bike" style="display:none"></div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
@stop