    <!--Login Modal -->
	<div class="modal fade" id="loginmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0">
			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-lg-6">
				  <div class="login-block">
					<form id="loginForm" method="post">
					<input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
					<h2 class="login-heading">Welcome back! <small>Login using</small></h2>
					<div class="social-btn mt-3">
					  <a class="outline-btn" href="{{ url('login/facebook')}}" ><img src="{{ asset('public/rider/images/icons-social-fb.svg')}}"> Facebook</a>
					  <a class="outline-btn" href="{{ url('login/google')}}"><img src="{{ asset('public/rider/images/icons-social-google.svg')}}"> Google</a>
					</div>
					<div class="alert alert-danger response-msg" style="display:none">
					<ul></ul>
					</div>
					<label class="login-change-txt">or Login using email/ Mobile number</label>
					<div class="login-input">
					<div class="form-group">
					  <input type="email" class="form-control " name="email" id="email" placeholder="Email address/ Mobile number">
					</div>
					<div class="form-group">
					  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
					</div>
				  
					<button type="button" class="btn btn-danger w-100" onclick="signinRider();">LOGIN</button>
					<p class="mt-3 login-bottom-txt">Forgot Password? <a href="#" class="text-danger">Reset Password</a></p>
				  <p class=" mt-3 login-bottom-txt">New on Throttle Rides? <a href="#" class="text-danger" data-toggle="modal" data-target="#signupmodal" data-dismiss="modal">Create Your Account</a></p>
				  </div>
				</form>
				  </div>
				</div>
				<div class="col-lg-6 p-0">
				  <div clas="position-relative">
					<img src="{{ asset('public/rider/images/login-bg.jpg')}}" class="img-fluid" />
					<div class="login-banner-txt">
					  <span class="login-txt">Explore over 2,000+ Rides, Bikers, 
						Events, Groups, Suppliers, 
						Local Guides around the world.</span>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			 
		  </div>
		</div>
	  </div>

	  <!--Signup Modal -->
	<div class="modal fade" id="signupmodal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0">
			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-lg-6">
				  <div class="login-block">
					<form id="signupForm" method="post">
					<input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
					<h2 class="login-heading">CREATE A NEW ACCOUNT<small>Let's ride the world!</small></h2>
					<div class="alert alert-danger print-error-msg" style="display:none">
					<ul></ul>
					</div>
					<div class="login-input">
						<div class="form-group">
							<input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
							<span class="text-danger p-1">{{ $errors->first('name') }}</span>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email address">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>					
						<button type="button" id="signup" class="btn btn-danger w-100" onclick="registerRider();">CREATE ACCOUNT</button>
						<p class="mt-3 login-bottom-txt">Are you a member? <a href="#" class="text-danger" data-toggle="modal" data-target="#loginmodal" data-dismiss="modal">Login here</a></p>
				  </div>
				</form>
				  </div>
				</div>
				<div class="col-lg-6 p-0">
				  <div clas="position-relative">
					<img src="{{ asset('public/rider/images/login-bg.jpg')}}" class="img-fluid" />
					<div class="login-banner-txt">
					  <span class="login-txt">Explore over 2,000+ Rides, Bikers, 
						Events, Groups, Suppliers, 
						Local Guides around the world.</span>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			 
		  </div>
		</div>
	  </div>


	  <!--Bike Modal -->
	<div class="modal fade" id="bikeModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0">
			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-lg-6">
				  <div class="login-block">
					<form id="bikeForm" method="post" enctype="multipart/form-data">
						<input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
						@auth
							<input type="hidden" name="rider_id" value="{{ Auth::user()->id }}">
						@endauth
						<h2 class="login-heading">Add NEW BIKE</h2>
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input">
							<div class="form-group">
								<input type="text" class="form-control" name="name" id="name" placeholder="Bike Name">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="total_km" id="total_km" placeholder="Kilometer Ride">
							</div>
							<div class="form-group">
								<input type="file" class="form-control" name="image" id="image" placeholder="Image">
							</div>
							<div class="form-group">
							<textarea id="form7" class="md-textarea form-control" name="info" id="info" rows="3" placeholder="Information"></textarea>
							</div>					
							<button type="button" id="addBike" class="btn btn-danger w-100">Submit</button>
						</div>
					</form>
				  </div>
				</div>
				<div class="col-lg-6 p-0">
				  <div clas="position-relative">
					<img src="{{ asset('public/rider/images/login-bg.jpg')}}" class="img-fluid" />
					<div class="login-banner-txt">
					  <span class="login-txt">Explore over 2,000+ Rides, Bikers, 
						Events, Groups, Suppliers, 
						Local Guides around the world.</span>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			 
		  </div>
		</div>
	  </div>