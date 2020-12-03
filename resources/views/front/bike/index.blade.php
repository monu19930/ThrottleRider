@extends('layouts.frontLayout.front-layout')
@section('title', 'Bikes')
@section('content')
<section class="left-main-bg">
	<div class="container ">
	  <div class="row">
	  	<div class="col-md-4 d-none d-md-block">
		  @include('layouts.frontLayout.profile-sidebar')
		</div>
		<div class="col-md-8">
		  <div class="cust-left-block">			
		  		<div class="d-flex align-items-center mt-4 mb-2">
				  	<h2 class="page-heading">MY BIKES <small>{{ count((array)$bikes) }} Bikes added</small></h2>
					<span class="ml-auto filter-block3 mob-filter"><a href="{{route('add-bike')}}" class="post-btn  px-5">ADD NEW BIKE</a></span>
				</div>
				<div class="d-flex align-items-center filter-details mb-4"></div>
			
			<div class="row">
			  <!-- repeat div from here START -->
			@if(count((array)$bikes) > 0)
				@foreach($bikes as $key =>$bike)
				<div class="col-12 mb-3 bike-refferer-{{$bike['id']}}">
				<div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">						
						<img src="{{ asset('public/images/rider/bikes/')}}/{{$bike['image']}}" class="img-fluid" width="250" height="180">
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
							<h4 class="location-title">{{ $bike['bike_name']}}</h4>
							<div class="d-flex align-items-center location-block">
								<span class="time">Added on <span>{{$bike['added_on']}}</span></span></span>
							</div>
						</div>
						<div class="prof-ride-menu ml-auto dropdown">												
							<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="{{ asset('public/rider/images/circles-menu.png')}}">
							</a>												
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">													
								<a class="dropdown-item" href="{{url('bikes/edit/')}}/{{$bike['id']}}">Edit</a>													
								<a class="dropdown-item bike-remove" content="{{$bike['id']}}" href="javascript:void(0)">Remove</a>
							</div>											
						</div>						
					</div>
					
					<div class="location-details d-flex align-items-center">
						<span class="rating"><i class="fa fa-star"></i>{{ $bike['rating']}} <small>Rating</small></span>
						<span class="other-details"><i class="fa fa-map-o"></i>{{ $bike['total_km']}} km <small>Bikes Driven</small></span>
						<span class="other-details"><i class="fa fa-calendar-o"></i>{{ $bike['total_rides']}} <small>Rides</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
						
						<span class="username">
						<span class="d-block">
						{{ substr($bike['description'], 0, 200)}}..
						</span>
						<span class="badge badge-warning">
						</span>
						</span>
						@if($bike['status']==1)
                            <button class="btn btn-success" data-target="#status_comment{{$key}}" data-toggle="collapse">Approved</button>
						@elseif($bike['status']==0)
							<button class="btn btn-dark">Pending</button>
						@elseif($bike['status']==2)
							<button class="btn btn-danger">Rejected</button>
						@else
							<button class="btn btn-warning">UnApproved</button>
						@endif   
					</div>

					<div class="collapse" id="status_comment{{$key}}">
						@if(count($bike['status_comment']) > 0)						
						<div class="table-responsive mt-5">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
									<th>#</th>                        
									<th>Comment</th>
									<th>Added On</th>
									</tr>
								</thead>
								<tbody>
									@foreach($bike['status_comment'] as $key => $comment)
										<tr>
											<td>{{$i++}}.</td>
											<td>{{$comment['description']}}</td>
											<td>{{formatDate($comment['created_at'], 'd-M-Y')}}</td>
										</tr>
									@endforeach
									
									@php
									$i=1;
									@endphp      
								</tbody>
							</table>
						</div>
						@endif						
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
						<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{ $bike['rating']}} <small class="ml-2">Rating</small></span>
						</div>
						<h4 class="location-title my-2">{{ $bike['bike_name']}}</h4>
						<div class="d-flex align-items-center location-block mb-2">
							<!-- <span class="location">Banglore, Karnatka, India</span> -->
							<span class="time">Added on  <span>{{ $bike['added_on']}}</span></span></span>
						</div>
						<div class="location-details d-flex align-items-center ">
						
						<span class="other-details"><i class="fa fa-map-o"></i>{{ $bike['total_km']}} km <small>Driven</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>{{ $bike['total_rides']}} <small>Total Rides</small></span>
						</div>
						</div>
						
					</div>
					
					
				</div>
				<div class="rider-img-block ml-3 ">
				<img src="{{ asset('public/images/rider/bikes/')}}/{{$bike['image']}}" class="img-fluid">
				</div>
				</div>
				<div class="d-flex align-items-center mt-1">
					<div class="userdetails d-flex align-items-center">
					<span class="userimg mr-2"><img src="{{ asset('public/images/rider_images/')}}/{{$bike['rider_image']}}" class="img-fluid" /></span>
					<span class="username">
					<span class="d-block">{{$bike['rider_name']}}</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> {{$bike['rider_rating']}}</span>
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
	  </div>
	</div>
  </section>
@stop