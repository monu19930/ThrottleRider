@extends('layouts.frontLayout.front-layout')
@section('title', 'Bikers');
@section('content')
<section class="main-bg">
	<div class="container ">
		<div class="row">
			<div class="col-md-8" id="search_res">
				<div class="cust-left-block">
					<h2 class="page-heading">
						Bikers
					</h2>
					<div class="d-flex align-items-center filter-details mb-4">

					</div>

					<!-- repeat div from here START -->
					<div class="col-md-12">
						<div class="row">
							@if(count($riders) > 0)
							@foreach($riders as $rider)
							<div class="col-md-6 mt-2">
								<div class="top-riders-block">
									<div class="card">
										<img src="{{ asset('public/images/rider/cover_images/')}}/{{$rider['cover_image']}}" class="card-img-top" alt="">
										<div class="card-body position-relative">
											<img src="{{ asset('public/images/rider_images/')}}/{{$rider['rider_image']}}" class="user-pic" widtj="60" height="60" />
											<div class="username mb-2">
												<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> {{$rider['rating']}}</span>
											</div>

											<h3 class="user-name">{{$rider['rider_name']}}<small>{{$rider['rider_email']}}</small></h3>
											<blockquote class="blockquote-block d-none d-md-block">“{{substr($rider['description'], 0, 65)}}”</blockquote>
											<div class="location-details d-flex align-items-center">
												<span class="rating d-none d-md-inline-block"><i class="fa fa-star"></i>{{$rider['rating']}} <small>Rating</small></span>
												<span class="other-details">{{$rider['total_rides']}} <small><i class="fa fa-map-o"></i> Rides</small></span>
												<span class="other-details">{{$rider['total_km']}} km <small><i class="fa fa-calendar-o"></i> Driven</small></span>

											</div>

											@if($rider['current_rider_follow_status'] == false)
											<button class="follow-btn w-100 mt-2 follow-rider-{{$rider['rider_id']}}" onclick="followRider('<?=$rider['rider_id']?>')" @if($rider['is_rider_owner']==true) disabled @endif>
												<i class="fa fa-plus mr-2"></i>FOLLOW
											</button>
											@else
											<button class="follow-btn w-100 mt-2 un-follow-rider-{{$rider['rider_id']}}" onclick="unFollowRider('<?=$rider['rider_id']?>')">
											<i class="fa fa-minus mr-2"></i>UNFOLLOW
											</button>
											@endif

										</div>
									</div>
								</div>
							</div>
							@endforeach
							@else
							Bikers Not available
							@endif
						</div>

					</div>

				</div>
			</div>

			<div class="col-md-4 d-none d-md-block">
				<div class="right-block">
					<button class="post-btn w-100 mb-3">POST A RIDE
						@guest
						<small>LOGIN REQUIRED</small>
						@endguest
					</button>
					<div class="card mt-2 mb-3 border-0">
						<ul class="list-group list-group-flush cust-notify">
							<li class="list-group-item">
								<h4 class="notify-heading">Notifications</h4>
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