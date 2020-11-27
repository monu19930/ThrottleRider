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
					
					<div class="alert alert-success alert-dismissible print-error-msg mt-2" style="display:none">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<span></span>
					</div>
					<label class="login-change-txt">or Login using email/ Mobile number</label>
					<div class="login-input">
					<div class="form-group">
					  <input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email address/ Mobile number">
					</div>
					<div class="form-group">
					  <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password">
					</div>
				  
					<button type="button" class="btn btn-danger w-100" id="signinRiderBtn" onclick="signinRider();">LOGIN</button>
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
					<div class="alert alert-success alert-dismissible print-error-msg mt-2" style="display:none">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<span></span>
					</div>
					<div class="login-input">
						<div class="form-group">
							<input type="text" class="form-control" autocomplete="off" name="name" placeholder="Your Name">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email address">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" autocomplete="off" name="phone" placeholder="Phone Number">
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
					<h4 class="page-sub-heading">Things to carry on this Ride</h4>
					<hr class="full-h-line my-4">

					<h4 class="page-sub-heading mt-2 mb-2">Bags</h4>
                    <div class="rider-overview mt-3 mt-lg-0">- A sailor bag would be perfect, a walker's bag too (without steel bar). <br>
                        - You can close it with a padlock if you want to (Don't forget to tag it before leaving with your address<br>
                        - A small backpack of 20 litres is advised for daily necessities such as camera, sunscreen lotion
                    </div>
                    
					<div class="col-10">
						<form id="rideLuggageForm" method="post">
							<div class="alert alert-success print-error-msg" style="display:none">
								<ul></ul>
							</div>					
							
							<div class="d-flex align-items-center w-100 mt-4">
								<div class="input-field  mb-0 w-100">
									<input type="text" autocomplete="off" class="input-block" name="ride_luggage[]" placeholder=" "> 
									<label for="search-bike" class="input-lbl">Add Your Point</label>
								</div>
								<a href="javascript:void(0)" id="add_more_ride_luggage">Add</a>
							</div>
							<div id="ride_luggage_list"></div>							
						</form>
					</div>
					<h4 class="page-sub-heading mt-4 mb-2">Clothing and Personal Equipments</h4>
                    <div class="rider-overview mt-3 mt-lg-0">- 2 light pants<br>
                        - 4 shirts (including some with long sleeves, to protect yourself from the sun)<br>
                        - 1 bathing suit
					</div>
					<hr class="full-h-line my-4">
					<div class="text-right pb-3 d-flex align-items-center">
						<button type="button" data-dismiss="modal" aria-label="Close" class="btn back-btn w-30">CANCEL</button>
						<button type="button" id="rideLuggageSubmit" class="post-btn lg px-5 ml-auto">SAVE</button>
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
						<h2 class="login-heading">Invite New Members<small>Enter multiple email address by comma(,) separated</small></h2>
						<div class="alert alert-danger invite-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input">
							<div class="form-group">
								<input type="text" autocomplete="off" name="email[]" id="invite_group_member_email" class="form-control">
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


	<!---Add Past Experience--->
	<div class="modal fade" id="pastExperienceModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
					<form id="pastExperienceForm" method="post">
						<h4 class="login-heading">Add Past Experience<small>Past Experience</small></h4>
						<input type="hidden" name="group_id" id="past_experience_id">						
						<div class="alert alert-success alert-dismissible print-error-msg" style="display:none">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<span></span>
						</div>
						<div class="login-input">
							<div class="form-group">
								<input type="text" autocomplete="off" name="title" class="form-control" placeholder="Title">
							</div>
							<div class="form-group">
								<input type="text" autocomplete="off" name="added_on" id="start_date" class="form-control" placeholder="Date">
							</div>
							<div class="form-group">
								<input type="file" class="form-control" name="images[]" accept="image/*" multiple>
							</div>
							<div class="form-group">
								<textarea class="md-textarea form-control" name="description"  rows="3" placeholder="Description"></textarea>
							</div>
							<div class="form-group">						
								<button type="button" id="past_experience" class="btn btn-danger w-100" onclick="savePastExperience();">SUBMIT</button>
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


	<!--Share Contact Model-->
	<div class="modal fade" id="shareContactModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
					<form id="shareContactForm" method="post">
						<h2 class="login-heading">Share Contact<small>With group members</small></h2>
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input">
							<div class="form-group">
								<select class="custom-select" name="group_member[]" id="group_members" multiple="multiple">
								</select> 
							</div>
							<div class="form-group">						
								<button type="button" class="btn btn-danger w-100" onclick="sendContact();">SUBMIT</button>
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



	  <!---Add Polls--->
	<div class="modal fade" id="feedbackPollModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
					<form id="pollFeedbackForm" method="post">
						<h4 class="login-heading">Polls<small>Give your feedback</small></h4>
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input pollFeedbackQuestions"></div>
						<div class="login-input">
							<div class="form-group">						
								<button type="button" class="btn btn-danger w-100" onclick="saveRiderFeedback();">SUBMIT</button>
							</div>
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


	<!---Add Past Experience--->
	<div class="modal fade" id="createTipModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
				  <form id="tipForm" method="post"  enctype="multipart/form-data">                    
					  <h4 class="login-heading">Add New Tip<small>Tip Details</small></h4>
					  <div class="alert alert-success alert-dismissible print-error-msg" style="display:none">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<span></span>
						</div>
                      <div class="login-input">
                          <div class="form-group">
                              <input type="text" class="form-control" name="tip_title" placeholder="Tip Title">
                          </div>
                          <div class="form-group">
                            <input type="file" class="form-control-file uplode_file dropzone" name="file_name">
                          </div>                          
                          <div class="form-group">
                              <textarea class="md-textarea form-control" name="tip_description" rows="3" placeholder="Tip Description"></textarea>
                          </div>
                          <div class="form-group">
                            <button type="button" id="submitTip" class="btn btn-danger w-50" onclick="saveTip();">Submit</button>
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
