@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  My Bikes
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{ $bikes->count() }} Bikes Added</span><br/>
			</div>
			<span><a href="{{route('add-bike')}}">Add New Bike</a></span>
			
			<div class="row">
			  <!-- repeat div from here START -->
			@if($bikes->count() > 0)
				@foreach($bikes as $bike)
				<div class="col-12 mb-3 bike-refferer-{{$bike->id}}">
				<div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
						@if(!empty($bike->image))
							<img src="{{ asset('public/images/rider/bikes/')}}/{{isset(json_decode($bike->image,true)[0]) ? json_decode($bike->image,true)[0] : 'not_found.jpg'  }}" class="img-fluid" width="250" height="180">
						@endif
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
						<h4 class="location-title">{{ $bike->name}}</h4>
						<div class="d-flex align-items-center location-block">
							<span class="time">Added on <span>{{formatDate($bike->created_at, 'd M Y')}}</span></span></span>
						</div>
						</div>
						<div class="bookmark ml-auto">
							<a href="{{url('bikes/edit/')}}/{{$bike->id}}"><i class="fa fa-edit"></i></a>
							<a href="javascript:void(0)" class="bike-remove" content="{{$bike->id}}"><i class="fa fa-remove"></i></a>
						</div>
					</div>
					<div class="location-details d-flex align-items-center">
						<span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
						<span class="other-details"><i class="fa fa-map-o"></i>{{ $bike->total_km}} km <small>Bikes Driven</small></span>
						<span class="other-details"><i class="fa fa-calendar-o"></i>{{ $bike->total_rides}} <small>Rides</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
						
						<span class="username">
						<span class="d-block">
						{{ $bike->info}}
						</span>
						<span class="badge badge-warning">
						</span>
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
					<img src="{{ asset('public/rider/images/mobe_byke.png')}}" class="img-fluid">
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
					<h2 class="page-heading">Bikes is not available</h2>
				</div>
			@endif		   
			</div>		   
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
		  <img src="{{ asset('public/images/rider_images/rider.jpg')}}" style="position: relative;margin-left:50px;"class="img-circle" alt="Cinque Terre" width="200" height="180">
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item">
				   <h4 class="notify-heading">
						   <a href="{{route('my-profile')}}">Profile</a>
					</h4>
				</li>
			   <li class="list-group-item">
				   <h4 class="notify-heading">
					   <a href="{{ route('rides')}}">Rides</a>
					</h4>
				</li>
			   <li class="list-group-item">
				   
			   	<h4 class="notify-heading">
					<a href="{{ route('bikes')}}">Bikes</a>
				</h4>
				</li>
			   <li class="list-group-item"><h4 class="notify-heading"><a href="{{ route('groups')}}">Groups</a></h4></li>
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