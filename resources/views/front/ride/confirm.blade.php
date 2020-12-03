@extends('layouts.frontLayout.front-layout')
@section('title', 'Ride Confirmation')
@section('content')
<div class="short-banner">
          <div class="container">
            <div class="row">
               <div class="col-8 mx-auto">
                 <h2 class="short-banner-txt"><span class="banner-flag"><img src="{{ asset('public/rider/images/flag.png')}}"></span>AWESOME, THANKS FOR ADDING YOUR RIDE!</h2>
                 <small class="short-banner-txt-sml">Your ride will reflect in your profile post review by our team.</small>
               </div>
             
            
            </div>
          </div>
        </div>
        <section class="container">
          <div class="row">
              <div class="col-12 col-md-8 mx-md-auto push-top">
                <div class="confirm-msg d-flex align-items-center">
                  <span><i class="fa fa-clock-o clock-icon"></i></span>
                  <span>Waiting for Review by our team. It will be done within 24 hrs.</span>
                </div>
                <div class="rides-block d-none d-md-flex byke-push-top">

                  <div class="bike-img-block   order-2 order-md-1">
                    <img src="{{ asset('public/images/rides/')}}/{{isset($rides->ride_image['image']) ? $rides->ride_image['image'] : 'not_found.png' }}">
                  </div>
        
                  <div class="rider-details-block order-1 col-md-8">
        
                  <div class="location-heading-block ">
        
                    <div>
        
                    <h4 class="location-title">Ride to {{ $rides->end_location}} via {{$rides->via_location}}</h4>
        
                    <div class="d-flex align-items-center location-block">
                        <span class="location">from {{ $rides->start_location}}</span>
                        <span class="time left-seperater">in Month of <span>{{$rides->start_date}}</span></span></span>
        
                    </div>
        
                    </div>
         
                  </div>
        
                  <div class="location-details d-flex align-items-center justify-content-start">
        
                    <span class="rating"><i class="fa fa-star"></i> {{$rides->ride_rating}} <small>Rating</small></span>
        
                    <span class="other-details"><i class="fa fa-map-o"></i> {{$rides->total_km}} km <small>from {{ $rides->start_location}}</small></span>
        
                    <span class="other-details"><i class="fa fa-calendar-o"></i> 2 <small>Days Trip</small></span>

                    <span class="other-details"><i class="fa fa-calendar-o"></i> {{$rides->road_type}} <small>Road Type</small></span>
        
                  </div>
        
                   
        
                    
        
                    <div  >
                      <small class="sml-txt font-italic mb-2 d-block">Review Highlight</small>
                    <div class="byke-details">
        
                    {{$rides->description}}
        
                    </div>
        
                    
        
                  </div>
        
                   
        
                  </div>
        
                </div>
        
                <!-- <mobile div start from here -->
        
                <div class="rides-block flex-column d-md-none mt-5">
        
                <div class="d-flex"> 
        
                <div class="rider-details-block w-100 ">
        
                  <div class="location-heading-block ">
        
                    <div>
        
                    <div class="location-details  p-0">
        
                    <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{$rides->ride_rating}} <small class="ml-2">Rating</small></span>
        
                    </div>
        
                    <h4 class="location-title my-2">Ride to {{ $rides->end_location}} via {{$rides->via_location}}</h4>
        
                    <div class="d-flex align-items-center location-block mb-2">
        
                      <!-- <span class="location">Banglore, Karnatka, India</span> -->
        
                      <span class="time">in month of <span>{{$rides->start_date}}</span></span></span>
        
                    </div>
        
                    <div class="location-details d-flex align-items-center ">
        
                    
        
                    <span class="other-details"><i class="fa fa-map-o"></i>{{$rides->total_km}} km <small>from {{$rides->start_location}}</small></span>
        
                    <!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
        
                    <span class="other-details"><i class="fa fa-road"></i>2 <small>Days Trip</small></span>

                    <span class="other-details"><i class="fa fa-road"></i>{{$rides->road_type}} <small>Road Type</small></span>
        
                    </div>
        
                    </div>
        
                    
        
                  </div>
        
                  
        
                  
        
                </div>
        
                <div class="rider-img-block ml-3 ">
        
                  <img src="" class="img-fluid">
        
                </div>
        
                </div>
        
                <div class="d-flex align-items-center mt-1">
        
                  <div class="userdetails d-flex align-items-center">
        
                  <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$rides->rider_image}}" class="img-fluid" /></span>
        
                  <span class="username">
        
                  <span class="d-block">{{$rides->rider_name}}</span>
        
                  <span class="badge badge-warning"><i class="fa fa-star"></i> {{$rides->rider_rating}}</span>
        
                  </span>
        
                  </div> 
        
                  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
        
                </div>
        
                </div>
        
                <!-- <mobile div END here -->
                  <div class="point-block d-flex align-items-center mt-4">
                    <span><img src="{{ asset('public/rider/images/coin.png')}}"></span>
                    <h5 class="rider-name m-0 ml-3">Earned Royality Points<small class="d-block sml-txt">You’ll get 100 Royality points on adding this ride. Points will reflect in your account post ride details verification.</small></h5>
                    <span class="ml-auto">
                      <button class="brown-btn">100 Points</button>
                    </span>
                  </div>
                  <div class="point-block d-flex align-items-center mt-4">
                    <span><img src="{{ asset('public/rider/images/icons-help.svg')}}"></span>
                    <h5 class="rider-name m-0 ml-3">Need any help?<small class="d-block sml-txt">Contact us for any help or support.</small></h5>
                    <span class="ml-auto">
                      <a href="#">Contact us</a>
                    </span>
                  </div>
                  <h4 class="page-sub-heading mt-4 pt-2">What next?</h4>
                  <div class="d-flex align-items-center">
                    <!-- <button class="red-outline-btn px-5 mr-3">ADD MORE BIKES</button>
                    <button class="red-outline-btn px-5 mr-3">ADD A TRIP</button> -->
                    <a href="{{($rides->group_id==0) ? route('my-rides.create') : route('my-groups.events.create',$rides->group_id)}}" class="red-outline-btn px-5 mr-3">ADD MORE TRIPS</a>
                    <a href="{{route('add-bike')}}" class="red-outline-btn px-5 mr-3">ADD A BIKE</a>
                    <button class="red-outline-btn px-5 mr-3">EXPLORE TRIPS</button>
                  </div>
                  <h4 class="page-sub-heading mt-4 pt-2">Back to</h4>
                  <div class="d-flex  mb-5">
                    <!-- <button class="red-outline-btn px-5 mr-3">PROFILE</button>
                    <button class="red-outline-btn px-5 mr-3">HOMEPAGE</button> -->
                    <a href="{{route('my-profile')}}" class="red-outline-btn px-5 mr-3">PROFILE</a>
                    <a href="{{route('login')}}" class="red-outline-btn px-5 mr-3">HOMEPAGE</a>
                  </div>
              </div>
          </div>
        </section>
@stop