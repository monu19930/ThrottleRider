@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">My Profile</h2>
			<div class="row">
					<a href="{{route('my-profile')}}" class="href"><< Back</a>
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
								<label>Phone Number</label>
								<input type="text" class="form-control" name="phone" value="{{$phone}}" placeholder="Phone Number" readonly>
							</div>
							<div class="form-group">
								<label>Profile Image</label>
								@if(isset($rider->image))
									<img src="{{ asset('public/images/rider_images')}}/{{$rider->image}}" class="img-fluid" width="200" height="150">
								@endif
								<input type="file" class="form-control" name="image" placeholder="Image">
							</div>

							<div class="form-group">
								<label>Cover Image</label>
								@if(isset($rider->cover_image))
									<img src="{{ asset('public/images/rider/cover_images')}}/{{$rider->cover_image}}" class="img-fluid" width="200" height="150">
								@endif
								<input type="file" class="form-control" name="cover_image" placeholder="Image">
							</div>

							<div class="form-group">
								<label>Total Rides</label>
								<input type="number" class="form-control" name="total_rides" value="{{isset($rider->total_rides) ? $rider->total_rides : ''}}" placeholder="Total Rides">
							</div>
							<div class="form-group">
								<label>Total Year of Riding</label>
								<input type="number" class="form-control" name="riding_year" value="{{isset($rider->riding_year) ? $rider->riding_year : ''}}">
							</div>
							<div class="form-group">
								<label>City</label>
								<select class="custom-select" name="city" >
									<option value="">Select your city </option>
									@foreach($cities as $key => $city)
										<option value="{{$key}}" {{ ( $city == $rider_city) ? 'selected' : '' }} >{{$city}}</option>										
									@endforeach
								</select>								
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
		@include('layouts.frontLayout.profile-sidebar')
		</div>
	  </div>
	</div>
  </section>
@stop