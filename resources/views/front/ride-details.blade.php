@extends('layouts.frontLayout.front-layout')
@section('title', 'Ride from '.$ride['start_location'].' to '.$ride['end_location'])
@section('content')
<div class="bg-white border-bottom pb-4">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ol class="breadcrumb bg-white px-0">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('rides.index')}}">Rides</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ride to {{ $ride['end_location']}} via {{ $ride['via_location']}}</li>
        </ol>
      </div>
      <div class="col-md-8">
        <div class="location-details  p-0 d-md-none">
          <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small class="ml-2">Overall Ratings</small></span>
        </div>
        <h2 class="ride-heading mt-lg-5 pt-lg-3 mt-2">
          Ride to {{ $ride['end_location']}} via {{ $ride['via_location']}}
        </h2>
        <small class="head-small-txt pt-2 d-block">from <span>{{ $ride['start_location']}}</span></small>
        <div class="mob-rider-profile d-flex align-items-center mt-4 d-md-none">
          <div class="userdetails d-flex align-items-center">
            <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$ride['rider_image']}}" class="img-fluid"></span>
            <span class="username">
              <span class="d-block">{{ $ride['rider_name']}}</span>
              <span class="badge badge-warning"><i class="fa fa-star"></i> {{ $ride['rider_rating']}}</span>
            </span>
          </div>
          <div class="ml-auto">
            
            @if($ride['current_rider_follow_status'] == false)
            <button class="follow-btn w-100 follow-rider" tabindex="0" content="{{$ride['rider_id']}}" @if($ride['is_rider_owner'] == true) disabled @endif><i class="fa fa-plus mr-2"></i>FOLLOW</button>
            @else
            <button class="follow-btn w-100" tabindex="0"><i class="fa fa-minus mr-2"></i>FOLLOWED</button>
            @endif
          </div>
        </div>
        <div class="row mt-4 d-none d-lg-flex">
          <div class="col-md-8 ">
            <div class="byker-profile-rate d-flex align-items-center justify-content-between">
              <span class="rating border-right py-2 px-3 d-flex align-items-center justify-content-center w-33">
                <span class="rating-txt">{{$ride['ride_rating']}}</span>
                <span>
                  <span class="rider-star">
                    @for($i=0; $i < intval($ride['ride_rating']); $i++)
                    <i class="fa fa-star"></i>
                    @endfor

                    @if(is_float($ride['ride_rating']))
                      <i class="fa fa-star-half"></i>
                    @endif                    
                  </span>
                  <small class="d-block sml-txt">Overall Ratings</small>
                </span>
              </span>
              <span class="w-33 d-flex align-items-center px-3 h-100 border-right justify-content-center">
                <span class="star-txt"><i class="fa fa-star"></i> {{$ride['road_quality']}}</span>
                <small class="sml-txt">Road Quality</small>
              </span>
              <span class="w-33 d-flex align-items-center px-3 h-100 justify-content-center ">
                <span class="star-txt"><i class="fa fa-star"></i> {{$ride['road_scenic']}}</span>
                <small class="sml-txt">Scenery</small>
              </span>

            </div>
          </div>
          <div class="col-md-4">
            <div class="byker-profile-calender d-flex align-items-center p-3 ">
              <span class="calender-icon"><i class="fa fa-calendar-o"></i></span>
              <span class="top-rider-calender pl-3">
                <small class="sml-txt d-block">In Month of</small>
                {{$ride['start_date']}}
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 pl-4 d-none d-lg-flex">
        <div class="card ml-4">
          <div class="card-header bg-blue">
            <div class="d-flex biker-profile-right align-items-center p-2">
              <span class="bikername">
                <small class="sml-txt">Posted by</small>
                <span class="rider-name d-block">{{$ride['rider_name']}}</span>
                <span class="badge badge-warning cust-badge-rating"><i class="fa fa-star"></i> {{$ride['rider_rating']}}</span>
              </span>
              <span class="ml-auto"><img src="{{ asset('public/images/rider_images/')}}/{{$ride['rider_image']}}" class="rider-pic"></span>
            </div>
          </div>
          <div class="card-body">
            <blockquote class="blockquote-block pr-5 mt-0">“{{substr($ride['description'], 0, 65)}}..”</blockquote>
            <div class="row align-items-center mt-3">
              <div class="col-md-8">
                
                @if($ride['current_rider_follow_status'] == false)
                <button class="follow-btn w-100 mt-2 follow-rider-{{$ride['rider_id']}}" onclick="followRider('<?=$ride['rider_id']?>')" tabindex="0" @if($ride['is_rider_owner'] == true) disabled @endif>
                  <i class="fa fa-plus mr-2"></i>FOLLOW
                </button>
                @else
                <button class="follow-btn w-100 mt-2 un-follow-rider-{{$ride['rider_id']}}" tabindex="0" onclick="unFollowRider('<?= $ride['rider_id'] ?>')">
									<i class="fa fa-minus mr-2"></i> UnFollow
								</button>
                @endif

              </div>
              <div class="col-md-4 text-center"><a href="#"><img src="{{ asset('public/rider/images/icons-black-menu.svg')}}"></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="main-bg">
  <div class="container ">
    <div class="row">
      <div class="col-md-8">
        <div class="cust-left-block  pt-4">
          <h5 class="mid-heading d-none d-lg-block">Highlights</h5>
          <div class="highlight-block-scroll">
            <div class="highlight-block d-flex">
              <div class="highlight-box1 d-inline-flex align-items-center mr-3 p-0">
                <span class="ride-km-map">
                  <i class="fa fa-map-o"></i><span class="d-block">{{$ride['total_km']}} km </span><small class="sml-txt d-block">from {{$ride['start_location']}}</small>
                </span>
                <span class="ml-auto"><img src="{{ asset('public/rider/images/map.png')}}/" class="img-fluid rounded-right rider-map" /></span>
              </div>


              <div class="highlight-box2   mr-3">
                <i class="fa fa-user-o"></i><span class="d-block">{{$ride['no_of_people']}} </span><small class="sml-txt d-block">People</small>
              </div>



              <div class="highlight-box2   mr-3">
                <i class="fa fa-calendar-o"></i><span class="d-block">{{count($ride['rideDays'])}}</span><small class="sml-txt d-block">Days Trip</small>
              </div>



              <div class="highlight-box3 ">
                <i class="fa fa-road"></i><span class="d-block">Highway</span><small class="sml-txt d-block">Road Type</small>
              </div>



            </div>
          </div>
          <hr class="full-h-line mx-0 d-none d-lg-block">
          <h5 class="mid-heading d-none d-lg-block">Overview</h5>
          <div class="rider-overview mt-3 mt-lg-0">
            {{$ride['description']}} <br><a href="#" class="mt-2 font-weight-bold d-inline-block">Read more</a>
          </div>
          <hr class="full-h-line mx-0">
          <h5 class="mid-heading">Itinerary</h5>
          <!-- <div class="rider-overview">Some description. This is the place where I was introduced to this addiction of motorcycle touring. After spending
            almost 3 years It was time for me to change the job and head back North.</div> -->
          <div>
            <ul class="cust-timeline">
              @foreach($ride['rideDays'] as $key => $rideDay)
              <li>
                <div class="row">
                  <div class="col-12 col-md-2">
                    <h5 class="m-0 p-0 timeline-day">Day {{$key+1}}</h5>
                  </div>
                  <div class="col-9 col-md-7">
                    <h4 class="page-sub-heading">{{$rideDay->start_location}} to {{$rideDay->end_location}}</h4>
                    <div class="timeline-txt">Day {{$key+1}} {{$rideDay->day_description}} <a href="#">read more</a> </div>
                    <div class="d-none d-md-block">
                      <div class="byker-profile-rate d-inline-flex align-items-center mt-3 ">

                        <span class="d-flex align-items-center px-4 h-100 border-right justify-content-center">
                          <span class="star-txt"><i class="fa fa-star"></i> {{$rideDay->road_quality}}</span>
                          <small class="sml-txt">Road Quality</small>
                        </span>
                        <span class="d-flex align-items-center px-4 h-100 justify-content-center ">
                          <span class="star-txt"><i class="fa fa-star"></i> {{$rideDay->road_scenic}}</span>
                          <small class="sml-txt">Scenery</small>
                        </span>

                      </div>
                      <div class="d-flex mt-3">
                        <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                        <div class="pl-2">
                          <small class="sml-txt d-block">Distance from {{$rideDay->start_location}}</small>
                          <p class="timeline-keypoint">{{$rideDay->total_km}} km</p>
                        </div>
                      </div>
                      <div class="d-flex mt-3">
                        <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                        <div class="pl-2">
                          <small class="sml-txt d-block">Petrol Pump</small>
                          @if($rideDay->is_petrol_pump==1)
                          <p class="timeline-keypoint">Yes, {{$rideDay->petrol_pump_comment}}</p>
                          @else
                          <p class="timeline-keypoint">No</p>
                          @endif
                        </div>
                      </div>

                      <div class="d-flex mt-3">
                        <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                        <div class="pl-2">
                          <small class="sml-txt d-block">Hotel</small>
                          @if($rideDay->is_hotel==1)
                          <p class="timeline-keypoint">Yes</p>
                          @else
                          <p class="timeline-keypoint">No</p>
                          @endif
                        </div>
                      </div>

                      @if($rideDay->is_hotel==1)
                      <div class="d-flex mt-3">
                        <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                        <div class="pl-2">
                          <small class="sml-txt d-block">Place of stay at {{$rideDay->end_location}}</small>
                          <p class="timeline-keypoint">{{$rideDay->hotel_name}} <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{urlencode($rideDay->hotel_name)}}" class="ml-1 font-weight-bold">View on Map</a></p>
                        </div>
                      </div>
                      @endif
                      <div class="d-flex align-items-center mt-4">
                        <div class="d-flex align-items-center pr-2 pr-lg-4 border-right">
                          <span><img src="{{ asset('public/rider/images/parking.png')}}" /></span>
                          <span class="timeline-txt ml-2">Parking available</span>
                        </div>
                        <div class="d-flex align-items-center px-2 px-lg-4 border-right">
                          <span><img src="{{ asset('public/rider/images/wifi.png')}}" /></span>
                          <span class="timeline-txt ml-2">Wi-fi</span>
                        </div>
                        <div class="d-flex align-items-center pl-lg-4 pl-2">
                          <span><img src="{{ asset('public/rider/images/food.png')}}" /></span>
                          <span class="timeline-txt ml-2">Food available</span>
                        </div>

                      </div>
                    </div>

                  </div>
                  @php
                  $ride_images = json_decode($rideDay->ride_images,true);
                  @endphp
                  <div class="col-3 text-right">
                    <img src="{{ asset('public/images/rides/')}}/{{isset($ride_images[0]['image']) ? $ride_images[0]['image'] : 'not_found.png'}}" class="img-fluid timeline-img"><small class="no-of-imgs">
                      @if(isset($ride_images) && count($ride_images) > 1)
                      {{count($ride_images)}}+ Photos
                      @endif
                    </small>
                  </div>
                  <div class="col-12 d-md-none ">
                    <div class="byker-profile-rate d-inline-flex align-items-center mt-3 ">

                      <span class="d-flex align-items-center px-4 h-100 border-right justify-content-center"><span class="star-txt"><i class="fa fa-star"></i> {{$rideDay->road_quality}}</span> <small class="sml-txt">Road Quality</small></span>
                      <span class="d-flex align-items-center px-4 h-100 justify-content-center "><span class="star-txt"><i class="fa fa-star"></i> {{$rideDay->road_scenic}}</span> <small class="sml-txt">Scenery</small></span>

                    </div>
                    <div class="d-flex mt-3">
                      <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                      <div class="pl-2">
                        <small class="sml-txt d-block">Distance from {{$rideDay->start_location}}</small>
                        <p class="timeline-keypoint">{{$rideDay->total_km}} km</p>
                      </div>
                    </div>
                    <div class="d-flex mt-3">
                      <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                      <div class="pl-2">
                        <small class="sml-txt d-block">Petrol Pump</small>
                        @if($rideDay->is_petrol_pump==1)
                        <p class="timeline-keypoint">Yes, {{$rideDay->petrol_pump_comment}}</p>
                        @else
                        <p class="timeline-keypoint">No</p>
                        @endif
                      </div>
                    </div>
                    <div class="d-flex mt-3">
                      <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                      <div class="pl-2">
                        <small class="sml-txt d-block">Hotel</small>
                        @if($rideDay->is_hotel==1)
                        <p class="timeline-keypoint">Yes</p>
                        @else
                        <p class="timeline-keypoint">No</p>
                        @endif
                      </div>
                    </div>
                    @if($rideDay->is_hotel==1)
                    <div class="d-flex mt-3">
                      <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                      <div class="pl-2">
                        <small class="sml-txt d-block">Place of stay at {{$rideDay->end_location}}</small>
                        <p class="timeline-keypoint">{{$rideDay->hotel_name}} <a href="https://www.google.com/maps/search/?api=1&query={{urlencode($rideDay->hotel_name)}}" class="ml-1 font-weight-bold">View on Map</a></p>
                      </div>
                    </div>
                    @endif
                    <div class="d-flex align-items-center mt-4">
                      <div class="d-flex align-items-center pr-2 pr-lg-4 border-right">
                        <span><img src="{{ asset('public/rider/images/parking.png')}}" /></span>
                        <span class="timeline-txt ml-2">Parking available</span>
                      </div>
                      <div class="d-flex align-items-center px-2 px-lg-4 border-right">
                        <span><img src="{{ asset('public/rider/images/wifi.png')}}" /></span>
                        <span class="timeline-txt ml-2">Wi-fi</span>
                      </div>
                      <div class="d-flex align-items-center pl-lg-4 pl-2">
                        <span><img src="{{ asset('public/rider/images/food.png')}}" /></span>
                        <span class="timeline-txt ml-2">Food available</span>
                      </div>

                    </div>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          <hr class="full-h-line mx-0">
          <h5 class="mid-heading">Things to carry</h5>
          <div class="rider-overview">
            Appropriate equipment is a component of a successful journey! Travel lightly, try to stay under 45 lb (20 kg).
          </div>
          <h4 class="page-sub-heading mt-4 mb-2">
            Bags
          </h4>
          <div class="rider-overview">
            - A sailor bag would be perfect, a walker's bag too (without steel bar). <br>
            - You can close it with a padlock if you want to (Don't forget to tag it before leaving with your address<br>
            - A small backpack of 20 litres is advised for daily necessities such as camera, sunscreen lotion
          </div>
          <h4 class="page-sub-heading mt-4 mb-2">
            Clothing and Personal Equipments
          </h4>
          <div class="rider-overview">
            - 2 light pants<br>
            - 4 shirts (including some with long sleeves, to protect yourself from the sun)<br>
            - 1 bathing suit
            <br><a href="#" class="mt-2 font-weight-bold d-inline-block">Read more</a>
          </div>
          <hr class="full-h-line mx-0">
          <h5 class="mid-heading">Terms & Conditions</h5>
          <ol class="cust-ol-list">
            <li> "You" means the person/s in whose name and / or whose behalf the booking is made. Alternatively, the reference may be
              made in the third person as "tour participant" / "they" / "Client" / "them" / "his" / "her".
            </li>
            <li> "We" / "Us" / "Company" means Tripjack.</li>
          </ol>
          <br><a href="#" class="mt-2 font-weight-bold d-inline-block">Read more</a>
          <hr class="full-h-line">
          <h2 class="page-heading">
            RECOMMEDED RIDES
          </h2>
          <div class="d-flex align-items-center filter-details mb-4">
            <span class="filter-block1">Explore other rides</span>

            <span class="ml-auto filter-block3 mob-filter"><a href="{{route('rides.index')}}">View all Rides</a></span>
          </div>
          <div class="row">
            <!-- repeat div from here START -->
            @foreach($ride['related_rides'] as $rides)
            <div class="col-12 mb-3">
              <div class="rides-block d-none d-md-flex">
                <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
                  <img src="{{ asset('public/images/rides/')}}/{{isset($rides['ride_image']['image']) ? $rides['ride_image']['image'] : 'not_found.png'}}" class="img-fluid">
                </div>
                <div class="rider-details-block w-100 order-1 order-md-2">
                  <div class="location-heading-block ">
                    <div>
                      <h4 class="location-title"><a href="{{route('rides.show', $rides['slug'])}}" class="location-title">Ride to {{$rides['end_location']}} via {{$rides['via_location']}}</a></h4>
                      <div class="d-flex align-items-center location-block">
                        <span class="location">from {{$rides['start_location']}}</span>
                        <span class="time left-seperater">in month of <span>{{$rides['start_date']}}</span></span></span>
                      </div>
                    </div>
                    <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                  </div>
                  <div class="location-details d-flex align-items-center">
                    <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
                    <span class="other-details"><i class="fa fa-map-o"></i>{{$rides['total_km']}} km <small>from {{$rides['start_location']}}</small></span>
                    <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
                    <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
                  </div>
                  <div class="userdetails d-flex align-items-center">
                    <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$rides['rider_image']}}" class="img-fluid" /></span>
                    <span class="username">
                      <span class="d-block">{{$rides['rider_name']}}</span>
                      <span class="badge badge-warning"><i class="fa fa-star"></i> {{$rides['rider_rating']}}</span>
                    </span>
                  </div>
                </div>
              </div>
              <!-- <mobile div start from here -->
              <div class="rides-block flex-column d-md-none">
                <div class="d-flex">
                  <div class="rider-details-block w-100 ">
                    <div class="location-heading-block ">
                      <div>
                        <div class="location-details  p-0">
                          <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
                        </div>
                        <h4 class="location-title my-2"><a href="{{route('rides.show',$rides['slug'])}}" class="location-title">Ride to {{$rides['end_location']}} via {{$rides['via_location']}}</a></h4>
                        <div class="d-flex align-items-center location-block mb-2">
                          <!-- <span class="location">Banglore, Karnatka, India</span> -->
                          <span class="time">in month of <span>{{$rides['start_date']}}</span></span></span>
                        </div>
                        <div class="location-details d-flex align-items-center ">

                          <span class="other-details"><i class="fa fa-map-o"></i>{{$rides['total_km']}} km <small>from {{$rides['start_location']}}</small></span>
                          <!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
                          <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
                        </div>
                      </div>

                    </div>


                  </div>
                  <div class="rider-img-block ml-3 ">
                    <img src="{{ asset('public/images/rides/')}}/{{isset($rides['ride_image']['image']) ? $rides['ride_image']['image'] : 'not_found.png'}}" class="img-fluid">
                  </div>
                </div>
                <div class="d-flex align-items-center mt-1">
                  <div class="userdetails d-flex align-items-center">
                    <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$rides['rider_image']}}" class="img-fluid" /></span>
                    <span class="username">
                      <span class="d-block">{{$rides['rider_name']}}</span>
                      <span class="badge badge-warning"><i class="fa fa-star"></i> {{$rides['rider_rating']}}</span>
                    </span>
                  </div>
                  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                </div>
              </div>
              <!-- <mobile div END here -->
            </div>
            @endforeach
            <!-- repeat div from here START -->


          </div>
        </div>
      </div>
      <div class="col-md-4 d-none d-md-block ">
        <div class="right-block pt-4">
          <button class="post-btn w-100 mb-3">ASK QUESTIONS ?
            @guest
              <small>LOGIN REQUIRED</small>
            @endguest
          </button>
          <div class="card mt-2 mb-3 border-0">
            <ul class="list-group list-group-flush cust-notify">
              <li class="list-group-item">
                <h4 class="notify-heading">Updates</h4>
              </li>
              <li class="list-group-item">
                <div class="notify-title">Title of notification</div>
                <p class="notify-txt">The kit consists of more than a hundred ready-to-use elements that you… <a href="">more</a></p>
                <span class="right-arrow"><i class="fa fa-angle-right"></i></span>
              </li>
              <li class="list-group-item">
                <div class="notify-title">Title of notification</div>
                <p class="notify-txt">The kit consists of more than a hundred ready-to-use elements that you… <a href="">more</a></p>
                <span class="right-arrow"><i class="fa fa-angle-right"></i></span>
              </li>
            </ul>
          </div>
          <div class="card mt-2 mb-3 border-0">
            <div class="bg-white card-header">
              <div class="d-flex align-items-center">
                <h4 class="notify-heading">PHOTOS</h4>
                <span class="ml-auto "><a href="#" class="reset-btn">See all</a></span>
              </div>
            </div>
            <div class="card-body">
              <div class="row m-0">
                @foreach($ride['rideImagesList'] as $image)
                <div class="col-4 mb-2 px-1">
                  <img src="{{ asset('public/images/rides/')}}/{{$image}}" class="img-fluid rounded-lg">
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="card mt-4 mb-3 border-0">
            <div class="card-body text-center">
              <div class="badge-icon"><img src="{{ asset('public/rider/images/badge.png')}}"></div>
              <div class="badge-status">Current status of Badge</div>
              <p class="badge-txt">Also we’ll show the available points in your account here.</p>
            </div>
          </div>
          <div class="sponser-ads"><span>SPONSERED ADS</span></div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop