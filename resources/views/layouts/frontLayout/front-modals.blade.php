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
						<button type="button" class="outline-btn social_login" data-content="{{url('login/facebook')}}" > 
							<img src="{{ asset('public/rider/images/icons-social-fb.svg')}}"> Facebook
						</button>
					  	<button type="button" class="outline-btn social_login" data-content="{{url('login/google')}}"> 
							<img src="{{ asset('public/rider/images/icons-social-google.svg')}}"> Google
						</button>
					</div>
					<div class="alert alert-danger response-msg" style="display:none">
					<ul></ul>
					</div>
					<label class="login-change-txt">or Login using email/ Mobile number</label>
					<div class="login-input">
					<div class="form-group">
					  <input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email address/ Mobile number">
					</div>
					<div class="form-group">
					  <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password">
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
							<input type="text" class="form-control" autocomplete="off" name="name" placeholder="Your Name">
							<span class="text-danger p-1">{{ $errors->first('name') }}</span>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email address">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password">
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


	<!--Signup Modal -->
	<div class="modal fade" id="bikeListModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
					<form id="bikeModalForm" method="post">
					<input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
					<h2 class="login-heading">SELECT BIKE MODEL NAME<small>Choose model name</small></h2>
					<div class="alert alert-danger print-error-msg" style="display:none">
					<ul></ul>
					</div>
					<div class="login-input">
						<div class="form-group">
							<select class="custom-select" id="bike_models"></select> 
						</div>
						<div class="form-group">						
							<button type="button" class="btn btn-danger w-100" onclick="submitBikeModel();">SUBMIT</button>
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

	
	<!--Signup Modal -->
	<div class="modal fade" id="reviewBikeListModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
					<form id="reviewBikeModalForm" method="post">
						<input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
						<h2 class="login-heading">SELECT BIKE MODEL NAME<small>Choose model name</small></h2>
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input">
							<div class="form-group">
								<select class="custom-select" id="review_bike_models"></select> 
							</div>
							<div class="form-group">						
								<button type="button" class="btn btn-danger w-100" onclick="submitReviewBikeModel();">SUBMIT</button>
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

	<!--Ride Equipments Modal -->
	<div class="modal fade" id="rideLuggageModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close" style="color: #ef1111;">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-lg-12">					
				  <div class="login-block">
				 	 <div class="review-more-details">
						<h2 class="page-heading">Things to carry on this Ride</h2>
						<div class="d-flex align-items-center filter-details mb-4">
							<span class="filter-block1"></span>
						</div>
						<div class="alert alert-success print-error-msg" style="display:none">
							<ul></ul>
						</div>
					</div>
					<h4 class="page-sub-heading">Bags</h4>
					<div>
						<ul class="list-content">
							<li>A sailor bag would be perfect, a walker bag too (without steel bar)</li>
							<li>You can close it with a padlock if you want to (Don't forget to tag it before leaving with your address</li>
							<li>A small backpack of 20 litres is advised for daily necessities such as camera, suncreen lotion</li>
						</ul>                               
					</div>
					<div class="col-10">
					<form id="rideLuggageForm" method="post">						
						<div class="login-input">
							<div class="form-group">
								<input type="text" autocomplete="off" class="form-control" name="ride_luggage[]" placeholder="Add Your Point"> <a href="javascript:void(0)" id="add_more_ride_luggage">Add</a>
							</div>
							<div id="ride_luggage_list"></div>
						</div>
					</form>
					</div>
					<h4 class="page-sub-heading">Clothing and Personal Equipments</h4>
					<div>
						<ul class="list-content">
							<li>2 light pants</li>
							<li>4 shirts (including some with long sleeves, to protect yourself from the sun)</li>
							<li>1 bathing suit</li>
						</ul>                               
					</div>
					<div class="form-group">
						<button type="button" data-dismiss="modal" aria-label="Close" class="btn back-btn w-30">CANCEL</button>
						<button type="button" id="rideLuggageSubmit" class="btn btn-danger w-30">SAVE</button>
					</div>				
				  </div>
				</div>				
			  </div>
			</div>
			 
		  </div>
		</div>
	  </div>

	  <!--Invite Members Model-->
	<div class="modal fade" id="inviteMembersModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
					<form id="inviteGroupMembersForm" method="post">
						<input type="hidden" name="member" id="group_member">
						<h2 class="login-heading">INVITE MEMBERS<small>Enter multiple email address by comm(,) separated</small></h2>
						<div class="alert alert-danger invite-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input">
							<div class="form-group">
								<input type="text" autocomplete="off" name="email" class="form-control">
							</div>
							<div class="form-group">						
								<button type="button" class="btn btn-danger w-100" onclick="sendGroupInvitation();">SUBMIT</button>
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