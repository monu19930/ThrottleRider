@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8" id="search_res">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Latest Rides
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{count($rides)}} new rides from <strong>{{$location}}</strong></span>
			  <span class="filter-block2 left-seperater">Not your city? <a href="#">Change here</a></span>
			  <span class="ml-auto filter-block3 mob-filter"><a href="#">View all Rides</a></span>
			</div>
			<div class="row">
			  <!-- repeat div from here START -->
		@if(count($rides) > 0)
			@foreach($rides as $ride)
			<div class="col-12 mb-3">
			  <div class="rides-block d-none d-md-flex">
				<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				  <img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']}}" class="img-fluid" style="width:200px;height:150px;">
				</div>
				<div class="rider-details-block w-100 order-1 order-md-2">
				   <div class="location-heading-block ">
					 <div>
					   <h4 class="location-title">{{ $ride['via_location']}},{{$ride['end_location']}}</h4>
					   <div class="d-flex align-items-center location-block">
						 <span class="location">Banglore, Karnatka, India</span>
						 <span class="time left-seperater">in month of <span>{{$ride['start_date']}}</span></span></span>
					   </div>
					 </div>
					 <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				   </div>
				   <div class="location-details d-flex align-items-center">
					 <span class="rating"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small>Rating</small></span>
					 <span class="other-details"><i class="fa fa-map-o"></i>{{$ride['total_km']}} km <small>from {{$location}}</small></span>
					 <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					 <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
				   </div>
				   <div class="userdetails d-flex align-items-center">
					 <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$ride['rider_image']}}" style="width:60px;height:50px;" class="img-fluid" /></span>
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
					   <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
					 </div>
					  <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					  <div class="d-flex align-items-center location-block mb-2">
						<!-- <span class="location">Banglore, Karnatka, India</span> -->
						<span class="time">in month of <span>June 2019</span></span></span>
					  </div>
					  <div class="location-details d-flex align-items-center ">
					 
					   <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					   <!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
					   <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					 </div>
					</div>
					
				  </div>
			   </div>
			   <div class="rider-img-block ml-3 ">
				 <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
			   </div>
			  </div>
			   <div class="d-flex align-items-center mt-1">
				 <div class="userdetails d-flex align-items-center">
				 <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				 <span class="username">
				   <span class="d-block">Ekene Obasey</span>
				   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				 </span>
				 </div> 
				 <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
			   </div>
			 </div>
			 <!-- <mobile div END here -->
			</div>
			@endforeach
		@else
		<div class="col-12 mb-3">
			<h4 class="location-title my-2">Not Found</h4>
		</div>
		@endif
		   
			</div>

			<h4 class="page-sub-heading mt-4 mb-3">
			 Explore other cities
			 <small>People from {{$location}} are taking Rides from  these populer cities too</small>
		   </h4>
		   <div class="other-cities slider border-bottom pb-5 mb-2">
			@if(count($explore_rides) > 0)
				@foreach($explore_rides as $key => $explore_ride)			
				<div class="slide">
				<img src="{{ asset('public/images/rides/')}}/{{getRideImage($explore_ride)}} ">
				<div class="img-content">
					<span class="no-rides">{{count($explore_ride)}}</span>
					<span class="ride-loc">Rides from</span>
					<span class="ride-state">{{$key}}</span>
				</div>
				</div>
				@endforeach
			@else
				Records not available
			@endif
		   </div>
		   <h2 class="page-heading mt-5">
			 Top Bikers and groups in {{$location}}
			 <small>Get inspires from top Riders around the world and Join them to get latest update.</small>
		   </h2>
		   <div class="d-flex align-items-center filter-details">
			 <h4 class="page-sub-heading mt-4 mb-3">
			  Top Bikers
				
			 </h4>
			 <span class="ml-auto filter-block3"><a href="#">View all Bikers</a></span>
		   </div> 
		   <div class="top-riders-slider slider  mb-2">
			@if(count($riders) > 0)
				@foreach($riders as $rider)
				<div class="slide">
					<div class="top-riders-block">
					<div class="card" >
					<img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
					<div class="card-body position-relative">
						<img src="{{ asset('public/images/rider_images/')}}/{{$rider['rider_image']}}" class="user-pic" widtj="60" height="60"/>
						<div class="username mb-2">
						<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> {{$rider['rating']}}</span> 
						</div>
						
						<h3 class="user-name">{{$rider['rider_name']}}<small>{{$rider['rider_email']}}</small></h3>
						<blockquote class="blockquote-block d-none d-md-block">“{{$rider['description']}}”</blockquote>
						<div class="location-details d-flex align-items-center">
						<span class="rating pl-0 d-none d-md-inline-block">{{$rider['rating']}} <small>Rating</small></span>
						<span class="other-details pl-0">{{$rider['total_rides']}} <small>Rides</small></span>
						<span class="other-details pl-0">{{$rider['total_km']}} km <small>Driven</small></span>
						
						</div>
						<button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
					</div>
					</div>
					</div>
				</div>
				@endforeach			 
			@else
				Bikers Not available
			@endif
		   </div>
		   <div class="d-flex align-items-center filter-details">
			 <h4 class="page-sub-heading mt-4 mb-3">
			   Top Groups				
			 </h4>
			 <span class="ml-auto filter-block3"><a href="#">View all Groups</a></span>
		   </div> 
		   <div class="top-group-slider slider mb-3">
			@if(count($groups) > 0)
				@foreach($groups as $group)			   
			 <div class="slide">
				<div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/images/group_images/')}}/{{$group['group_image']}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/images/rider_images/')}}/{{$group['rider_image']}}" class="user-pic" widtj="60" height="60"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">{{$group['rider_name']}}<small>{{$group['group_desc']}}</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">{{$group['group_rating']}} <small>Rating</small></span>
					   <span class="other-details pl-0">{{$group['total_rides']}} <small>Rides</small></span>
					   <span class="other-details pl-0">{{$group['total_km']}} km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						@foreach($group['group_member_list'] as $group_member_list)
						 	<span class="follow-users"><img src="{{ asset('public/images/rider_images/')}}/{{$group_member_list}}" style="height: 25px; width:25px;" /></span>
						 @endforeach
						 
						 <span class="joined-grp">{{$group['total_group_members']}} People<small>Joined the group</small></span>
					   </div>
					 </div>
					 <div class="d-flex">
						@if($group['current_rider_join_status'] == false)
							<button class="join-btn flex-grow-1 mt-2 mr-1 rider-group-join" id="group-join-{{$group['group_owner_id']}}" content="{{$group['group_owner_id']}}">
								<i class="fa fa-send mr-2"></i>Join
							</button>
						@else
							<button class="join-btn flex-grow-1 mt-2 mr-1" >
								<i class="fa fa-send mr-2"></i>Joined
							</button>
						@endif
						<button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				   </div>
				 </div>
				</div>
			 </div>
			 @endforeach
			@else
				Groups Not available
			@endif
		   </div>
		   <h2 class="page-heading mt-4">
			 
			 <small>Explore top riders and groups in </small>
		   </h2>
		   <div class="city-filter d-flex align-items-center">
			@foreach($explore_rides as $key => $explore_ride)
			 <span class="{{($key==0)?'left-seperater':''}}"><a href="#">{{$key}}</a></span>
			 @endforeach	
		   </div>
		   <div class="full-banner-content">
			 <img src="{{ asset('public/rider/images/mob-byke.png')}}" class="img-fluid d-md-none">
			 <img src="{{ asset('public/rider/images/full-banner.jpg')}}" class="img-fluid d-none d-md-inline-block"/>
			 <div class="banner-inner-content">
			   <div class="banner-inner-heading">BIKES</div>
			   <h4>Riding your own bike?</h4>
			   <div class="banner-tagline">Add your bike here and get personalized feed and rides suggestions. </div>
			   <div><button class="white-btn mt-4">ADD BIKE NOW</button></div>
			 </div>
		   </div>
		   <h2 class="page-heading mt-5">
			 UPCOMING EVENTS NEARBY {{$location}}
			 <small>Top-rated experiences, Book activities led by local hosts on your next trip</small>
		   </h2>
		   <div class="events-details slider border-bottom pb-5 mt-4 mb-2">
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 25
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Whitefield, Bengaluru</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 16
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Chennai, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 29
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Dhanushkodi, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 31
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Goa, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
					 <span class="calender-head">TUESDAY</span>
					 <span class="calender-body">
					   17
					   <small>May 19</small>
					 </span>
				 </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Mysure, India</span>
			   </div>
			 </div>
			  
		   </div>
		   <h2 class="page-heading mt-5">
			 YOUR FEED
			 <small>Updates from your followers</small>
		   </h2>
		   <div class="d-flex align-items-center filter-details">
			 <h2 class="page-heading mt-4 mb-3">
			  <small><strong>Rickie Baroch</strong> added two trips in his profile.</small>
				
			 </h2>
			 <span class="ml-auto filter-block3"><a href="#">Ask a question?</a></span>
		   </div>
		   <div class="row  mb-3 pb-3">
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
		   </div>
		   <div class="full-banner-content">
			 <img src="{{ asset('public/rider/images/mob-byke.png')}}" class="img-fluid d-md-none">
			 <img src="{{ asset('public/rider/images/full-banner.jpg')}}" class="img-fluid d-none d-md-inline-block"/>
			 <div class="banner-inner-content">
			   <div class="banner-inner-heading">BIKES</div>
			   <h4>Riding your own bike?</h4>
			   <div class="banner-tagline">Add your bike here and get personalized feed and rides suggestions. </div>
			   <div><button class="white-btn mt-4">ADD BIKE NOW</button></div>
			 </div>
		   </div>
		   <div class="d-flex align-items-center filter-details">
			 <h2 class="page-heading mt-4 mb-3">
			  <small><strong>Nikhil</strong> added two trips in his profile.</small>
				
			 </h2>
			 <span class="ml-auto filter-block3"><a href="#">Ask a question?</a></span>
		   </div>
		   <div class="row">
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
		   </div>
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
			<button class="post-btn w-100 mb-3">POST A RIDE<small>LOGIN REQUIRED</small></button>
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item"><h4 class="notify-heading">Notifications</h4></li>
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
		   <div class="card mt-4 mb-3 border-0"  >
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