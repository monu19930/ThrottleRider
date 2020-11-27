@extends('layouts.frontLayout.front-layout')
@section('title', 'Throttle Rides')
@section('content')
<?php $page="Home"?>
<section class="main-bg" id="search_res">
	<div class="container">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block pt-4">
			<h2 class="page-heading">
			  Latest Rides
			</h2>
		 	<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{count($rides)}} new rides from <strong>{{$location}}</strong></span>
			  <span class="filter-block2 left-seperater">Not your city? <a href="">Change here</a></span>
			  <span class="ml-auto filter-block3 mob-filter"><a href="{{route('rides.index')}}">View all Rides</a></span>
			</div>
			<div class="row">
			  <!-- repeat div from here START -->
		@if(count($rides) > 0)
			@foreach($rides as $ride)
			<div class="col-12 mb-3">
			  <div class="rides-block d-none d-md-flex">
				<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				  <img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']['image']}}" class="img-fluid" style="width:200px;height:150px;">
				</div>
				<div class="rider-details-block w-100 order-1 order-md-2">
				   <div class="location-heading-block ">
					 <div>
					   <h4 class="location-title"><a href="{{route('rides.show',$ride['slug'])}}" class="location-title">Ride To {{$ride['end_location']}} Via {{ $ride['via_location']}}</a></h4>
					   <div class="d-flex align-items-center location-block">
						 <span class="location">from {{ $ride['start_location']}}</span>
						 <span class="time left-seperater">in month of <span>{{$ride['start_date']}}</span></span></span>
					   </div>
					 </div>
					 <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				   </div>
				   <div class="location-details d-flex align-items-center">
					 <span class="rating"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small>Rating</small></span>
					 <span class="other-details"><i class="fa fa-map-o"></i>{{$ride['total_km']}} km <small>from {{$location}}</small></span>
					 <span class="other-details"><i class="fa fa-calendar-o"></i>{{$ride['number_of_day']+1}} <small>Days trip</small></span>
					 <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
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
					<div class="w-100">
					 <div class="location-details  p-0">
					   <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small class="ml-2">Rating</small></span>
					 </div>
					  <h4 class="location-title my-2"><a href="{{route('rides.show',$ride['slug'])}}" class="location-title">Ride To {{$ride['end_location']}} Via {{ $ride['via_location']}}</a></h4>
					  <div class="d-flex align-items-center location-block mb-2">
						<!-- <span class="location">Banglore, Karnatka, India</span> -->
						<span class="time">in month of <span>{{$ride['start_date']}}</span></span></span>
					  </div>
					  <div class="location-details d-flex align-items-center ">
					 
					   <span class="other-details"><i class="fa fa-map-o"></i>{{$ride['total_km']}} km <small>from {{$location}}</small></span>
					   <!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
					   <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					 </div>
					</div>
					
				  </div>
			   </div>
			   <div class="rider-img-block ml-3 ">
			   <img src="{{ asset('public/images/rides/')}}/" class="img-fluid" >
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
					<img src="{{ asset('public/images/rides/')}}/{{$explore_ride[1]['image']}} ">
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
			 <span class="ml-auto filter-block3"><a href="{{route('bikers.index')}}">View all Bikers</a></span>
		   </div> 
		   <div class="top-riders-slider slider  mb-2">
			@if(count($riders) > 0)
				@foreach($riders as $rider)
				<div class="slide">
					<div class="top-riders-block">
					<div class="card" >
					<img src="{{ asset('public/images/rider/cover_images/')}}/{{$rider['cover_image']}}" class="card-img-top" alt="">
					<div class="card-body position-relative">
						<img src="{{ asset('public/images/rider_images/')}}/{{$rider['rider_image']}}" class="user-pic"/>
						<div class="username mb-2">
						<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> {{$rider['rating']}}</span> 
						</div>
						
						<h3 class="user-name">{{$rider['rider_name']}}<small>{{$rider['rider_email']}}</small></h3>
						<blockquote class="blockquote-block d-none d-md-block">“{{substr($rider['description'], 0, 65)}}”</blockquote>
						<div class="location-details d-flex align-items-center">
						<span class="rating pl-0 d-none d-md-inline-block">{{$rider['rating']}} <small>Rating</small></span>
						<span class="other-details pl-0">{{$rider['total_rides']}} <small>Rides</small></span>
						<span class="other-details pl-0">{{$rider['total_km']}} km <small>Driven</small></span>						
						</div>

						
							@if($rider['current_rider_follow_status'] == false)
								<button class="follow-btn w-100 mt-2 follow-rider" content="{{$rider['id']}}"
								@if($rider['is_rider_owner'] == true)
									disabled
								@endif
								>
								<i class="fa fa-plus mr-2"></i>Follow
								</button>
							@else
								<button class="follow-btn w-100 mt-2 un-follow-rider">
								<i class="fa fa-minus mr-2"></i> UnFollow
								</button>
							@endif
						
					</div>
					</div>
					</div>
				</div>
				@endforeach			 
			@else
				Not available
			@endif
		   </div>
		   <div class="d-flex align-items-center filter-details">
			 <h4 class="page-sub-heading mt-4 mb-3">
			   Top Groups				
			 </h4>
			 <span class="ml-auto filter-block3"><a href="{{route('groups.index')}}">View all Groups</a></span>
		   </div> 
		   <div class="top-group-slider slider mb-3">
			@if(count($groups) > 0)
				@foreach($groups as $group)			   
			 <div class="slide">
				<div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/images/group_images/')}}/{{$group['group_image']}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/images/rider_images/')}}/{{$group['rider_image']}}" class="user-pic"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">{{$group['group_name']}}<small class="sml-txt">{{$group['city']}}</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">{{$group['group_rating']}} <small>Rating</small></span>
					   <span class="other-details pl-0">{{$group['total_rides']}} <small>Rides</small></span>
					   <span class="other-details pl-0">{{$group['total_km']}} km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						@foreach($group['group_member_list'] as $group_member_list)
						 	<span class="follow-users"><img src="{{ asset('public/images/rider_images/')}}/{{!empty($group_member_list) ? $group_member_list:'rider.jpg'}}" /></span>
						 @endforeach
						 
						 @if($group['total_group_members'] > 0)
						 <span class="joined-grp">{{$group['total_group_members']}} People<small>Joined the group</small></span>
						 @endif
					   </div>
					 </div>

					 				 
					 <div class="d-flex">
						@if($group['current_rider_join_status'] == false)
							<button class="join-btn flex-grow-1 mt-2 mr-1 rider-group-join" id="group-join-{{$group['group_owner_id']}}" content="{{$group['group_owner_id']}}"
							@if($group['is_group_owner'] == true)	
							disabled
							@endif
							>
								<i class="fa fa-send mr-2"></i>Join
							</button>
						@else
							<button class="join-btn flex-grow-1 mt-2 mr-1" >
								<i class="fa fa-send mr-2"></i>Joined
							</button>
						@endif
						<button class="follow-btn flex-grow-1  mt-2 ml-1"
						@if($group['is_group_owner'] == true)	
						disabled
						@endif
						><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				  

				   </div>
				 </div>
				</div>
			 </div>
			 @endforeach
			@else
				Not available
			@endif
		   </div>
		   <h2 class="page-heading mt-4">
			 
			 <small>Explore top riders and groups in </small>
		   </h2>
		   <div class="city-filter d-flex align-items-center">
			@foreach($explore_rides as $key => $explore_ride)
			 <span class="{{($key==0)?'left-seperater':''}}"><a href="">{{$key}}</a></span>
			 @endforeach	
		   </div>
		   <div class="full-banner-content">
			 <img src="{{ asset('public/rider/images/mob-byke.png')}}" class="img-fluid d-md-none">
			 <img src="{{ asset('public/rider/images/full-banner.jpg')}}" class="img-fluid d-none d-md-inline-block"/>
			 <div class="banner-inner-content">
			   <div class="banner-inner-heading">BIKES</div>
			   <h4>Riding your own bike?</h4>
			   <div class="banner-tagline">Add your bike here and get personalized feed and rides suggestions. </div>
			   <div><button class="white-btn mt-4 front-bike-add">ADD BIKE NOW</button></div>
			 </div>
		   </div>
		   <h2 class="page-heading mt-5">
			 UPCOMING EVENTS NEARBY {{$location}}
			 <small>Top-rated experiences, Book activities led by local hosts on your next trip</small>
		   </h2>
		   <div class="events-details slider border-bottom pb-5 mt-4 mb-2">
			@foreach($upcoming_events as $upcoming_event)
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">{{formatDate($upcoming_event['start_date'],'l')}}</span>
				   <span class="calender-body">
				   {{formatDate($upcoming_event['start_date'],'d')}}
					 <small>{{formatDate($upcoming_event['start_date'],'M Y')}}</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">{{$upcoming_event['start_location']}}</span>
			   </div>
			 </div>
			@endforeach			 
			  
		   </div>
		   <h2 class="page-heading mt-5">
			 YOUR FEED
			 <small>Updates from your followers</small>
		   </h2>
		   <div class="d-flex align-items-center filter-details">
		@if(count($events) > 0)
			 <h2 class="page-heading mt-4 mb-3">
			  <small><strong>{{$events[0]['rider_name']}}</strong> added {{count($events)}} trips in his profile.</small>
				
			 </h2>
			 <span class="ml-auto filter-block3"><a href="">Ask a question?</a></span>
		   </div>
		   <div class="row  mb-3 pb-3">
		
			@foreach($events as $event)
			 <div class="col-12 mb-3">			 
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				 <img src="{{ asset('public/images/groups/events/')}}/{{$event['ride_image']}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ride To {{$event['end_location']}} Via {{$event['via_location']}}</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location"> from {{$event['start_location']}}</span>
						  <span class="time left-seperater">in month of <span>{{$event['created_at']}}</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>{{$event['ride_rating']}} <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>{{$event['total_km']}} km <small>from {{$event['start_location']}}</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$event['rider_image']}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">{{$event['rider_name']}}</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> {{$event['rider_rating']}}</span>
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
					   <h4 class="location-title my-2">{{$event['start_location']}}</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>{{$event['start_date']}}</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>{{$event['total_km']}} km <small>from {{$event['start_location']}}</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				<img src="{{ asset('public/images/groups/events/')}}/{{$event['ride_image']}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$event['rider_image']}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">{{$event['rider_name']}}</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> {{$event['rider_rating']}}</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
			 @endforeach
		@else
			
		@endif			 
		   </div>
		   <div class="full-banner-content">
			 <img src="{{ asset('public/rider/images/mob-byke.png')}}" class="img-fluid d-md-none">
			 <img src="{{ asset('public/rider/images/full-banner.jpg')}}" class="img-fluid d-none d-md-inline-block"/>
			 <div class="banner-inner-content">
			   <div class="banner-inner-heading">BIKES</div>
			   <h4>Riding your own bike?</h4>
			   <div class="banner-tagline">Add your bike here and get personalized feed and rides suggestions. </div>
			   <div><button class="white-btn mt-4 front-bike-add">ADD BIKE NOW</button></div>
			 </div>
		   </div>
		   <div class="d-flex align-items-center filter-details">
		   @if(count($events) > 0)
			 <h2 class="page-heading mt-4 mb-3">
			  <small><strong>{{$events[0]['rider_name']}}</strong> added {{count($events)}} trips in his profile.</small>
				
			 </h2>
			 <span class="ml-auto filter-block3"><a href="">Ask a question?</a></span>
		   </div>
		   <div class="row">
		   
			@foreach($events as $event)
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				 <img src="{{ asset('public/images/groups/events/')}}/{{$event['ride_image']}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ride To {{$event['end_location']}} Via {{$event['via_location']}}</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location"> from {{$event['start_location']}}</span>
						  <span class="time left-seperater">in month of <span>{{$event['created_at']}}</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>{{$event['ride_rating']}} <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from {{$event['start_location']}}</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$event['rider_image']}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">{{$event['rider_name']}}</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> {{$event['rider_rating']}}</span>
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
						<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{$event['ride_rating']}} <small class="ml-2">Rating</small></span>
					  </div>
					   <h4 class="location-title my-2">{{$event['start_location']}}</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>{{$event['start_date']}}</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>{{$event['total_km']}} km <small>from {{$event['start_location']}}</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				<img src="{{ asset('public/images/groups/events/')}}/{{$event['ride_image']}}" class="img-fluid" >
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$event['rider_image']}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">{{$event['rider_name']}}</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> {{$event['rider_rating']}}</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
		@endforeach
	@else
		
	@endif
		   </div>
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block pt-4">
			<button class="post-btn w-100 mb-3 post-ride">POST A RIDE
				@guest
				<small>LOGIN REQUIRED</small>
				@endguest				
			</button>
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item"><h4 class="notify-heading">Notifications</h4></li>
			   @foreach($events as $key => $event)
			   @if($key < 3)
			   <li class="list-group-item">
				 <div class="notify-title">Ride To {{$event['end_location']}} Via {{$event['via_location']}}</div>
				 <p class="notify-txt">{{substr($event['description'], 0, 50)}}... <a href="">more</a></p>
				 <span class="right-arrow"><i class="fa fa-angle-right"></i></span>
			   </li>
			   @endif
			   @endforeach			   
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