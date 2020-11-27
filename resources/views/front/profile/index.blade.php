@extends('layouts.frontLayout.front-layout')
@section('title', 'My Profile')
@section('content')
<section class="left-main-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-4 d-none d-md-block">
				@include('layouts.frontLayout.profile-sidebar')
			</div>
			<div class="col-md-8">
				<div class="cust-left-block">					
					<div class="d-flex align-items-center filter-details mb-4">
						<h2 class="page-heading">ABOUT ME</h2>
						<span class="filter-block1 ml-3"><a href="#" data-toggle="modal" data-target="#riderDescriptionModal"><i class="fa fa-edit"></i></a></span>
					</div>

					<!---Update Description Modal--->
					<div class="modal fade" id="riderDescriptionModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content rounded-0" style="width:60%">
								<div class="modal-body p-0">
									<button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<div class="row no-gutters">
										<div class="col-md-12">
											<div class="login-block">
												<form id="updateRiderDesc" method="post">
													<h4 class="login-heading">My Profile<small>Update Description</small></h4>
													<div class="alert alert-success alert-dismissible print-error-msg" style="display:none">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<span></span>
													</div>
													<div class="login-input">
														<div class="form-group">
															<textarea class="md-textarea form-control" name="description" rows="3" placeholder="Description">{{$description}}</textarea>
														</div>
														<div class="form-group">
															<button type="button" id="update_rider_desc" class="btn btn-danger w-50" onclick="updateRiderDescription();">Update</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 mb-3">
							<div class="row">
								<div class="col-md-6">
									<span>{{$description}}</span>
								</div>
								<div class="col-md-6">
									<img src="{{ asset('public/images/rider/cover_images')}}/{{$cover_image}}" class="card-img-top" alt="" style="height:160px;
    width: 330px;">
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-3">
									<div class="rider-details-block w-100 ">
										<div class="location-heading-block ">
											<div class="location-details  p-0">
												<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{ $rating }} <small class="ml-2">Rating</small></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="rider-details-block w-100 ">
										<div class="location-heading-block ">
											<div class="location-details  p-0">
												<span class="other-details d-flex align-items-center"><i class="fa fa-calendar-o"></i>{{ $total_rides }} <small class="ml-2">Rides</small></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="rider-details-block w-100 ">
										<div class="location-heading-block ">
											<div class="location-details  p-0">
												<span class="other-details d-flex align-items-center"><i class="fa fa-user-plus"></i>{{$total_followers}} <small class="ml-2">Followers</small></span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="rider-details-block w-100 ">
										<div class="location-heading-block ">
											<div class="location-details  p-0">
												<span class="other-details d-flex align-items-center"><i class="fa fa-map-o"></i>{{ $total_km }} km <small class="ml-2">Bikes Driven</small></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



					
					<div class="d-flex align-items-center filter-details mb-4">
						<h2 class="page-heading mt-4">MY RECENT TRIPS <small>Explore My recent and past trips.</small></h2>
						<span class="ml-auto filter-block3 mob-filter mt-5"><a href="{{route('my-rides')}}">View all Trips</a></span>
					</div>


					<div class="row">
						@if(count($rides) > 0)
						@foreach($rides as $ride)
						<div class="col-12 mb-3">
							<div class="rides-block d-none d-md-flex">
								<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
									<img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']['image']}}" class="img-fluid">
								</div>
								<div class="rider-details-block w-100 order-1 order-md-2">
									<div class="location-heading-block ">
										<div>
											<h4 class="location-title">Ride To {{$ride['end_location']}} Via {{ $ride['via_location']}}</h4>
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
										<span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
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
											<div>
												<div class="location-details  p-0">
													<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>{{$ride['ride_rating']}} <small class="ml-2">Rating</small></span>
												</div>
												<h4 class="location-title my-2">Ride To {{$ride['end_location']}} Via {{ $ride['via_location']}}</h4>
												<div class="d-flex align-items-center location-block mb-2">
													<!-- <span class="location">Banglore, Karnatka, India</span> -->
													<span class="time">in month of <span>{{$ride['start_date']}}</span></span></span>
												</div>
												<div class="location-details d-flex align-items-center ">

													<span class="other-details"><i class="fa fa-map-o"></i>{{$ride['total_km']}} km <small>from {{$ride['start_location']}}</small></span>
													<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
													<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
												</div>
											</div>

										</div>
									</div>
									<div class="rider-img-block ml-3 ">
										<img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']['image']}}" class="img-fluid">
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

					
					<div class="d-flex align-items-center filter-details mb-4">
						<h2 class="page-heading mt-4">MY BIKES <small>Explore my bikes and reviews</small></h2>
						<span class="ml-auto filter-block3 mob-filter mt-5"><a href="{{route('bikes')}}">View all Bikes</a></span>
					</div>

					<div class="row">
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
												<span class="time">Added on <span> {{formatDate($bike->created_at, 'd M Y')}}</span></span>
											</div>
										</div>
										<div class="bookmark ml-auto">
											<a href="{{url('bikes/edit/')}}/{{$bike->id}}"><i class="fa fa-edit"></i></a>
											<a class="bike-remove" content="{{$bike->id}}" style="cursor:pointer;"><i class="fa fa-remove"></i></a>
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
												<h4 class="location-title my-2">{{ $bike->name}}</h4>
												<div class="d-flex align-items-center location-block mb-2">
													<!-- <span class="location">Banglore, Karnatka, India</span> -->
													<span class="time">Added on <span>{{formatDate($bike->created_at, 'd M Y')}}</span></span></span>
												</div>
												<div class="location-details d-flex align-items-center ">

													<span class="other-details"><i class="fa fa-map-o"></i>{{ $bike->total_km}} km <small>Driven</small></span>
													<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
													<span class="other-details"><i class="fa fa-road"></i>{{ $bike->total_rides}} <small>Rides</small></span>
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


									</div>
									<div class="rider-img-block ml-3 ">
										@if(!empty($bike->image))
										<img src="{{ asset('public/images/rider/bikes/')}}/{{isset(json_decode($bike->image,true)[0]) ? json_decode($bike->image,true)[0] : 'not_found.jpg'  }}" class="img-fluid">
										@else
										<img src="{{ asset('public/images/rider/bikes/not_found.jpg')}}" class="img-fluid">
										@endif
									</div>
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
<script>
	var is_social = "{{$is_social}}";
	if (is_social != '') {
		if (window.name == 'socialWindow') {
			window.close();
			window.opener.location = "{{route('my-profile')}}";
		}
	}
</script>
@stop