@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">My Profile</h2>
			<div class="row">
				<div class="col-12 mb-3">
				  <div class="login-block">
					<form id="profileForm" method="post" enctype="multipart/form-data">
						<input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Name" readonly>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email" value="{{$email}}" placeholder="Email" readonly>
							</div>
							<div class="form-group">
								@if(isset($rider->image))
									<img src="{{ asset('public/images/rider_images')}}/{{$rider->image}}" class="img-fluid" width="200" height="150">
								@endif
								<input type="file" class="form-control" name="image" placeholder="Image">
							</div>
							<div class="form-group">
								<label>Total Rides</label>
								<input type="number" class="form-control" name="total_rides" value="{{isset($rider->total_rides) ? $rider->total_rides : ''}}" placeholder="Total Rides">
							</div>
							<div class="form-group">
								<label>Riding Year</label>
								<input type="number" class="form-control" name="riding_year" value="{{isset($rider->riding_year) ? $rider->riding_year : ''}}">
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea class="md-textarea form-control" name="description" rows="3"> {{isset($rider->description) ? $rider->description : ''}}</textarea>
							</div>					
							<button type="button" id="updateProfile" class="btn btn-danger w-100">Submit</button>
						</div>
					</form>
				  </div>				
				</div>   
			</div>		   
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
		  <img src="{{ asset('public/images/rider_images/567898.jpg')}}" class="img-circle" alt="Cinque Terre" width="200" height="150">
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
			   <li class="list-group-item"><h4 class="notify-heading">Groups</h4></li>
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