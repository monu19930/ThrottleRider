<div class="cust-left-block pt-5">
                            <h2 class="page-heading">
                              Rides from {{$result['location']}} 
                              @if(isset($result['search_location']) && !empty($result['search_location']))
                                to {{$result['search_location']}}
                              @endif
                            </h2>
                            <div class="d-flex align-items-center filter-details mb-4">
                              <span class="filter-block1">{{$total}} Results </strong></span>
                              
                              <span class="ml-auto sort-block dropdown ">
                                <a href="#" class="sortby-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <label>Sort by</label>
                                  Ratings <i class="fa fa-angle-down drop-arrow"></i></a>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                  </div>
                                </span>
                            </div>
                            <div class="row">
                            <!-- repeat div from here START -->
                          @if(isset($rides) && ($total > 0))
                            @foreach($rides as $key => $ride)

                            @if($key < 2)
                            <div class="col-12 mb-3">
                              <div class="rides-block d-none d-md-flex">
                                <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
                                  <img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']}}" class="img-fluid">
                                </div>
                                <div class="rider-details-block w-100 order-1 order-md-2">
                                    <div class="location-heading-block ">
                                      <div>
                                        <h4 class="location-title"><a href="{{route('rides.show',$ride['slug'])}}" class="location-title">Ride To {{ $ride['end_location']}} Via {{ $ride['via_location']}}</a></h4>
                                        <div class="d-flex align-items-center location-block">
                                          <span class="location">from {{ $ride['start_location']}}</span>
                                          <span class="time left-seperater">in month of <span>{{$ride['start_date']}}</span></span></span>
                                        </div>
                                      </div>
                                      <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                    </div>
                                    <div class="location-details d-flex align-items-center">
                                      <span class="rating"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small>Rating</small></span>
                                      <span class="other-details"><i class="fa fa-map-o"></i>{{$ride['total_km']}} km <small>from {{$ride['start_location']}}</small></span>
                                      <span class="other-details"><i class="fa fa-calendar-o"></i>{{$ride['number_of_day']}} <small>Days trip</small></span>
                                      <span class="other-details"><i class="fa fa-road"></i>{{$ride['road_type']}} <small>Road Type</small></span>
                                    </div>
                                    <div class="userdetails d-flex align-items-center">
                                      <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$ride['rider_image']}}" class="img-fluid" /></span>
                                      <span class="username">
                                        <span class="d-block">{{$ride['rider_name']}}</span>
                                        <span class="badge badge-warning"><i class="fa fa-star"></i> {{$ride['rider_rating']}}</span>
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
                                        <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small class="ml-2">Rating</small></span>
                                      </div>
                                      <h4 class="location-title my-2">{{$ride['via_location']}} To {{$ride['end_location']}}</h4>
                                      <div class="d-flex align-items-center location-block mb-2">
                                        <!-- <span class="location">Banglore, Karnatka, India</span> -->
                                        <span class="time">in month of <span>{{$ride['start_date']}}</span></span></span>
                                      </div>
                                      <div class="location-details d-flex align-items-center ">
                                      
                                        <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from {{$ride['start_location']}}</small></span>
                                        <!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
                                        <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
                                      </div>
                                    </div>
                                    
                                  </div>
                                  
                                  
                                </div>
                                <div class="rider-img-block ml-3 ">
                                  <img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']}}" class="img-fluid">
                                </div>
                              </div>
                                <div class="d-flex align-items-center mt-1">
                                  <div class="userdetails d-flex align-items-center">
                                  <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$ride['rider_image']}}" class="img-fluid" /></span>
                                  <span class="username">
                                    <span class="d-block">{{$ride['rider_name']}}</span>
                                    <span class="badge badge-warning"><i class="fa fa-star"></i> {{$ride['rider_rating']}}</span>
                                  </span>
                                  </div> 
                                  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                </div>
                              </div>
                              <!-- <mobile div END here -->
                            </div>
                              <!-- repeat div from here START -->
                              @endif
                            @endforeach
                          @endif				
                          </div>
            
                            <div class="full-banner-content m-0 mb-3">
                              <img src="{{ asset('public/rider/images/mob-byke.png')}}" class="img-fluid d-md-none">
                              <img src="{{ asset('public/rider/images/full-banner.jpg')}}" class="img-fluid d-none d-md-inline-block"/>
                              <div class="banner-inner-content">
                                <div class="banner-inner-heading">RIDES</div>
                                <h4>Have been on a trip recently ?</h4>
                                <div class="banner-tagline">Let the world know and help others to reach this milestone and Get 450 points.</div>
                                <div><button class="white-btn mt-4">ADD RIDE NOW</button></div>
                              </div>
                            </div>
                            
                            
                    @if(isset($rides) && ($total > 2))
                        <div class="row">
                      @foreach($rides as $key => $ride)

                      @if($key >= 2)
                      <div class="col-12 mb-3">
                              <div class="rides-block d-none d-md-flex">
                                <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
                                  <img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']}}" class="img-fluid">
                                </div>
                                <div class="rider-details-block w-100 order-1 order-md-2">
                                    <div class="location-heading-block ">
                                      <div>
                                        <h4 class="location-title"><a href="{{route('rides.show',$ride['slug'])}}" class="location-title"> Ride To {{ $ride['end_location']}} Via {{ $ride['via_location']}}</a></h4>
                                        <div class="d-flex align-items-center location-block">
                                          <span class="location">from {{$ride['start_location']}}</span>
                                          <span class="time left-seperater">in month of <span>{{$ride['start_date']}}</span></span></span>
                                        </div>
                                      </div>
                                      <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                    </div>
                                    <div class="location-details d-flex align-items-center">
                                      <span class="rating"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small>Rating</small></span>
                                      <span class="other-details"><i class="fa fa-map-o"></i>{{$ride['total_km']}} km <small>from {{$ride['start_location']}}</small></span>
                                      <span class="other-details"><i class="fa fa-calendar-o"></i>{{$ride['number_of_day']}} <small>Days trip</small></span>
                                      <span class="other-details"><i class="fa fa-road"></i>{{$ride['road_type']}} <small>Road Type</small></span>
                                    </div>
                                    <div class="userdetails d-flex align-items-center">
                                      <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$ride['rider_image']}}" class="img-fluid" /></span>
                                      <span class="username">
                                        <span class="d-block">{{$ride['rider_name']}}</span>
                                        <span class="badge badge-warning"><i class="fa fa-star"></i> {{$ride['rider_rating']}}</span>
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
                                        <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small class="ml-2">Rating</small></span>
                                      </div>
                                      <h4 class="location-title my-2">{{$ride['via_location']}} To {{$ride['end_location']}}</h4>
                                      <div class="d-flex align-items-center location-block mb-2">
                                        <!-- <span class="location">Banglore, Karnatka, India</span> -->
                                        <span class="time">in month of <span>{{$ride['start_date']}}</span></span></span>
                                      </div>
                                      <div class="location-details d-flex align-items-center ">
                                      
                                        <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from {{$ride['start_location']}}</small></span>
                                        <!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
                                        <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
                                      </div>
                                    </div>
                                    
                                  </div>
                                  
                                  
                                </div>
                                <div class="rider-img-block ml-3 ">
                                  <img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']}}" class="img-fluid">
                                </div>
                              </div>
                                <div class="d-flex align-items-center mt-1">
                                  <div class="userdetails d-flex align-items-center">
                                  <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$ride['rider_image']}}" class="img-fluid" /></span>
                                  <span class="username">
                                    <span class="d-block">{{$ride['rider_name']}}</span>
                                    <span class="badge badge-warning"><i class="fa fa-star"></i> {{$ride['rider_rating']}}</span>
                                  </span>
                                  </div> 
                                  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                </div>
                              </div>
                              <!-- <mobile div END here -->
                    </div>
                    @endif
                      
                      @endforeach
                      </div>
                    @endif