  <h5 class="add-bike-heading">Review Ride Information
    <small>Verify Information you've entered and submit</small>
  </h5>

  <h2 class="page-heading mt-3">
    Ride to {{ $ride['end_location']}} via {{ implode(',',$ride['via_location'])}}
    <small class="head-small-txt pt-2 d-block">from <span>{{ $ride['start_location']}}</span></small>
  </h2>
  
  <div class="rider-overview mt-3 mt-lg-0">
    {{$ride['short_description']}}
    <br><a href="#" class="mt-2 font-weight-bold d-inline-block">Read more</a>
  </div>

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
        <i class="fa fa-calendar-o"></i><span class="d-block">{{count($ride['rideDay'])}}</span><small class="sml-txt d-block">Days Trip</small>
      </div>



    </div>
  </div>

  <hr class="full-h-line mx-0">
  <h5 class="mid-heading">Things to carry on this Ride</h5>
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
  <h5 class="mid-heading">Itinerary</h5>
    <ul class="cust-timeline">
      @foreach($ride['rideDay'] as $key => $rideDay)
      <li>
        <div class="row">
          <div class="col-12 col-md-2">
            <h5 class="m-0 p-0 timeline-day">Day {{$key+1}}</h5>
          </div>
          <div class="col-9 col-md-7">
            <h4 class="page-sub-heading">{{$rideDay['start_location']}} to {{$rideDay['end_location']}}</h4>
            <div class="timeline-txt">Day {{$key+1}} {{$rideDay['day_description']}} <a href="#">read more</a> </div>
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
                  <p class="timeline-keypoint">284 km</p>
                </div>
              </div>
              <div class="d-flex mt-3">
                <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                <div class="pl-2">
                  <small class="sml-txt d-block">Petrol Pump</small>
                  <p class="timeline-keypoint">Yes, in mid-way</p>
                </div>
              </div>
              <div class="d-flex mt-3">
                <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
                <div class="pl-2">
                  <small class="sml-txt d-block">Place of stay at Marvanthe</small>
                  <p class="timeline-keypoint">Hotel Marvanthe, Karnataka, India <a href="#" class="ml-1 font-weight-bold">View on Map</a></p>
                </div>
              </div>
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
          <div class="col-3 text-right">
            <img src="{{ asset('public/images/rides/')}}/{{$rideDay['ride_images'][0]}}" class="img-fluid timeline-img"><small class="no-of-imgs">
              @if(count($rideDay['ride_images']) > 1)
              {{count($rideDay['ride_images'])}}+ Photos
              @endif
            </small>
          </div>
          <div class="col-12 d-md-none ">
            <div class="byker-profile-rate d-inline-flex align-items-center mt-3 ">

              <span class="d-flex align-items-center px-4 h-100 border-right justify-content-center"><span class="star-txt"><i class="fa fa-star"></i> 4.5</span> <small class="sml-txt">Road Quality</small></span>
              <span class="d-flex align-items-center px-4 h-100 justify-content-center "><span class="star-txt"><i class="fa fa-star"></i> 4.5</span> <small class="sml-txt">Scenery</small></span>

            </div>
            <div class="d-flex mt-3">
              <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
              <div class="pl-2">
                <small class="sml-txt d-block">Distance from {{$rideDay['start_location']}}</small>
                <p class="timeline-keypoint">284 km</p>
              </div>
            </div>
            <div class="d-flex mt-3">
              <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
              <div class="pl-2">
                <small class="sml-txt d-block">Petrol Pump</small>
                <p class="timeline-keypoint">Yes, in mid-way</p>
              </div>
            </div>
            <div class="d-flex mt-3">
              <div><img src="{{ asset('public/rider/images/icons-km.svg')}}"></div>
              <div class="pl-2">
                <small class="sml-txt d-block">Place of stay at Marvanthe</small>
                <p class="timeline-keypoint">Hotel Marvanthe, Karnataka, India <a href="#" class="ml-1 font-weight-bold">View on Map</a></p>
              </div>
            </div>
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
  <hr class="full-h-line my-4">
  <div class="text-right pb-3">
    <!-- <button type="button" id="save_later3" class="btn back-btn w w-20">SAVE FOR LATER</button> -->
    <button type="button" onClick="rideDetailsPage()" class="post-btn  px-5">
      BACK</button> <button type="button" onClick="submitRide()" id="riderSubmit" class="post-btn  px-5">DONE, SUBMIT
    </button>
  </div>