@extends('layouts.frontLayout.front-layout')
@section('title', 'My Profile')
@section('content')
<section class="left-main-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-4 mob-black-bg">
				@include('layouts.frontLayout.profile-sidebar')
			</div>
			<div class="col-md-8">
				<div class="cust-left-block py-0 py-lg-4">					
					<!---Start Description Modal-->
					<div class="modal fade" id="riderDescriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-md">
							<div class="modal-content rounded-0">
								<div class="modal-header">
								<h5 class="modal-title font-weight-bold" id="exampleModalLabel">UPDATE DESCRIPTION</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<img src="{{ asset('public/rider/images/icons-circles-close.svg')}}">
								</button>
								</div>
								<div class="modal-body">
								<div class="alert alert-success alert-dismissible print-error-msg" style="display:none">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<span></span>
								</div>
								<form id="updateRiderDesc" method="post">
									<div class="login-input mt-4">
										<div class="d-flex mt-3 align-items-center">
											<div class="w-100 input-field mb-0">
											<textarea class="text-format" name="description" placeholder="Description">{{$description}}</textarea>			
											</div>
										</div>
									</div>
								</form>
								</div>
								<div class="modal-footer">
								<div class="text-right  d-flex align-items-center">
									<button type="button" class="post-btn lg px-5 " id="update_rider_desc" onclick="updateRiderDescription();">UPDATE</button>
								</div>
								</div>
							</div>
						</div>
					</div>
					<!---End Description Modal-->

					<!-- Start Cover Image Modal -->
					<div class="modal fade" id="riderCoverImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-md">
							<div class="modal-content rounded-0">
								<div class="modal-header">
								<h5 class="modal-title font-weight-bold" id="exampleModalLabel">UPDATE COVER IMAGE</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<img src="{{ asset('public/rider/images/icons-circles-close.svg')}}">
								</button>
								</div>
								<div class="modal-body">
								<div class="alert alert-success alert-dismissible print-error-msg" style="display:none">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<span></span>
								</div>
								<form id="updateRiderCoverImage" method="post">
									<div class="login-input mt-4">
										<div class="d-flex mt-3 align-items-center">
											<div class="w-50 input-field mb-0">
											@if(isset(user()->profile->cover_image))
												<img src="{{ asset('public/images/rider/cover_images')}}/{{(isset(user()->profile->cover_image) && (!empty(user()->profile->cover_image))) ? user()->profile->cover_image : 'rider.jpg'}}" class="img-fluid" width="200" height="150">
											@endif
											<input type="file" class="input-block mt-2" name="cover_image" placeholder="">
											</div>
										</div>
									</div>
								</form>
								</div>
								<div class="modal-footer">
								<div class="text-right  d-flex align-items-center">
									<button type="button" class="post-btn lg px-5 " id="update_rider_coverImage" onclick="updateRiderCoverImage();">UPDATE</button>
								</div>
								</div>
							</div>
						</div>
					</div>
					<!---End cover image modal-->

					<div class="row ">
						<div class="col-md-4">
							<h2 class="page-heading d-none d-lg-block">ABOUT ME <span class="heading-edit-icon"><a href="#" data-toggle="modal" data-target="#riderDescriptionModal"><i class="fa fa fa-pencil"></i></a></span></h2>
							<p class="about-content">{{$description}}</p>
						</div>
						<div class="col-md-8 d-none d-lg-block"> <span class="position-relative d-block cover-pic-block"> <img src="{{ asset('public/images/rider/cover_images')}}/{{$cover_image}}" class="img-fluid" /> <button class="change-cover" data-toggle="modal" data-target="#riderCoverImageModal"><i class="fa fa-pencil"></i>EDIT COVER PHOTO</button> </span> </div>
					</div>
					<div class="row mt-4 d-none d-lg-flex">
						<div class="col-md-4">
							<div class="d-flex align-items-center profile-top-rider"> <span class="brown-badge-block"><img src="{{ asset('/public/rider/images/brown-badge.png')}}" class="brown-badge" /></span> <span class="top-rider-txt"> Top Rider <small>Rank on Throttle Rides</small> </span> </div>
						</div>
						<div class="col-md-8 ">
							<div class="location-details profile-loc-detail d-flex align-items-center"> <span class="rating"><i class="fa fa-star"></i><span>{{ $rating }}</span> <small>Rating</small></span> <span class="other-details"><i class="fa fa-flag-o"></i><span>{{ $total_rides }}</span> <small>Rides</small></span> <span class="other-details"><i class="fa fa-user-plus"></i><span>{{$total_followers}}</span> <small>Followers</small></span> <span class="other-details"><i class="fa fa-map-o"></i><span>{{ $total_km }} km </span><small>Bike Driven</small></span> </div>
						</div>
					</div>
					<hr class="full-h-line" />
					<h2 class="page-heading"> MY RECENT TRIPS </h2>
					<div class="d-flex align-items-center filter-details mb-4"> <span class="filter-block1">Explore my recent and past trips.</span> <span class="ml-auto filter-block3 mob-filter"><a href="{{route('my-rides')}}">View all Rides</a></span> </div>



					<div class="row">
						
						@if(count($rides) > 0)
						@foreach($rides as $key => $ride)
						<div class="col-12 mb-3">
							<div class="rides-block d-none d-md-flex flex-wrap">
								@if($key == 0)
								<div class="wait-msg box--full">
									<div class="d-flex align-itmes-center"> 
										<span class="mr-3"><img src="{{ asset('/public/rider/images/clock.png')}}" /></span> 
										<span>Waiting for Review by our team. It will be done within 24 hrs.</span> 
										<span class="ml-auto"><a href="#" class="text-white">Know more</a></span> 
									</div>
								</div>
								@endif
								<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1 box--small">
									<img src="{{ asset('public/images/rides/')}}/{{$ride['ride_image']['image']}}" class="img-fluid">
								</div>
								<div class="rider-details-block w-100 order-1 order-md-2 box--half">
									<div class="location-heading-block ">
										<div>
											<h4 class="location-title">Ride To {{$ride['end_location']}} Via {{ $ride['via_location']}}</h4>
											<div class="d-flex align-items-center location-block">
												<span class="location">from {{ $ride['start_location']}}</span>
												<span class="time left-seperater">in month of <span>{{$ride['start_date']}}</span></span></span>
											</div>
										</div>
										<div class="prof-ride-menu ml-auto dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/public/rider/images/circles-menu.png')}}" /></a>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#">Edit</a> <a class="dropdown-item" href="#">Remove</a> </div>
										</div>

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
									<div class="prof-ride-menu ml-auto dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/public/rider/images/circles-menu.png')}}" /></a>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#">Edit</a> <a class="dropdown-item" href="#">Remove</a> </div>
									</div>
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
								<div class="rider-details-block w-100 order-1 order-md-2 box--half">
									<div class="location-heading-block ">
										<div>
											<h4 class="location-title">{{ $bike->name}}</h4>
											<div class="d-flex align-items-center location-block">
												<span class="time">Added on <span> {{formatDate($bike->created_at, 'd M Y')}}</span></span>
											</div>
										</div>
										<div class="prof-ride-menu ml-auto dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/public/rider/images/circles-menu.png')}}" /></a>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="{{url('bikes/edit/')}}/{{$bike->id}}">Edit</a> <a class="dropdown-item" href="#" content="{{$bike->id}}">Remove</a> </div>
										</div>

									</div>
									<div class="location-details d-flex align-items-center justify-content-start">
										<span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
										<span class="other-details"><i class="fa fa-map-o"></i>{{ $bike->total_km}} km <small>Bikes Driven</small></span>
										<span class="other-details"><i class="fa fa-calendar-o"></i>{{ $bike->total_rides}} <small>Rides</small></span>
									</div>
									<div class="d-flex align-items-center location-block"> <span class="time font-italic">Review Highlight </span></span> </div>
									<p class="prof-byke-detail">{{ $bike->info}}</p>

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