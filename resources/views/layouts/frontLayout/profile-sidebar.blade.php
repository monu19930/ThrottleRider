<div class="right-block mob-profile-page">
   <div class="card mt-2 my-3 mob-bg">
    <img src="{{ asset('/public/rider/images/profile-cover.png')}}" class="img-fluid prof-mob-bg d-lg-none"/>
       <div class="profile-page-block  p-0 p-lg-4">
          <div class="profile-img-block">					
          <img src="{{ asset('public/images/rider_images')}}/{{isset(user()->profile->image) ? user()->profile->image:'rider.jpg'}}" class="img-fluid profile-page-pic">										</div>
          <div class="rider-details-block w-100 order-1 order-md-2">
             <div class="location-heading-block ">
                <div>
                   <h3 class="profile-user-name">{{ user()->name}}							<small>{{user()->email}}</small>						</h3>
                 </div>
             </div>
             <div class="mob-white-bg">
             <div class="location-details d-flex align-items-center pt-0 prof-mob-rating">						
                 <span class="rating"><i class="fa fa-star"></i>{{ isset(user()->profile) ? user()->profile->rating : 0}} <small>Rating</small></span>						
                 <span class="other-details"><i class="fa fa-map-o"></i>{{ isset(user()->profile) ? user()->profile->total_rides : 0}} <small>Total Rides</small></span>						
                 <span class="other-details"><i class="fa fa-calendar-o"></i>{{ isset(user()->profile) ? user()->profile->total_km : 0}} km <small>Total Driven</small></span>					
             </div>
             </div>
             <button class="join-btn w-100 d-none d-lg-block"><a href="#" data-toggle="modal" data-target="#riderDetailsModal"><i class="fa fa-pencil mr-2"></i> EDIT</a></button>					
          </div>
       </div>
    </div>

    <!---Update Description Modal--->
			<div class="modal fade" id="riderDetailsModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content rounded-0" style="width:60%">			 
					<div class="modal-body p-0">
					<button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="row no-gutters">
						<div class="col-md-12">
						<div class="login-block">
						<form id="updateRiderDetail" method="post">                    
							<h4 class="login-heading">My Profile<small>Update Details</small></h4>
							<div class="alert alert-success alert-dismissible print-error-msg" style="display:none">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<span></span>
								</div>
							<div class="login-input mt-4"> 
                        <div class="form-group">
                           @if(isset(user()->profile->image))
                              <img src="{{ asset('public/images/rider_images')}}/{{(isset(user()->profile->image) && (!empty(user()->profile->image))) ? user()->profile->image : 'rider.jpg'}}" class="img-fluid" width="200" height="150">
                           @endif
                           <input type="file" class="form-control" name="image" placeholder="Image">
                        </div>

                        <div class="form-group">
                           <label>Total Rides</label>
                           <input type="number" class="form-control" name="total_rides" value="{{isset(user()->profile) ? user()->profile->total_rides : 0}}" placeholder="Total Rides">
                        </div>
                        <div class="form-group">
                           <label>Total Year of Riding</label>
                           <input type="number" class="form-control" name="riding_year" value="{{isset(user()->profile) ? user()->profile->riding_year : 0}}">
                        </div>
								<div class="form-group">
									<button type="button" id="update_rider_details" class="btn btn-danger w-50" onclick="updateRiderDetails();">Update</button>
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

    <div class="card mt-2 mb-3 mob-top-links"  >
       <ul class="list-group list-group-flush cust-profile-links">
          <li class="list-group-item"><a href="{{route('my-profile')}}" class="{{ Route::currentRouteName()=='my-profile' ? 'active' : '' }}">Profile</a></li>
          <li class="list-group-item"><a href="{{ route('my-rides')}}" class="{{ Route::currentRouteName()=='my-rides' ? 'active' : '' }}">Rides</a></li>
          <li class="list-group-item"><a href="{{ route('bikes')}}" class="{{ Route::currentRouteName()=='bikes' ? 'active' : '' }}">Bikes</a></li>
          <li class="list-group-item"><a href="{{ route('my-groups.index')}}" class="{{ Route::currentRouteName()=='my-groups.index' ? 'active' : '' }}">Groups</a></li>
          <li class="list-group-item"><a href="{{ route('suppliers.index')}}" class="{{ Route::currentRouteName()=='suppliers.index' ? 'active' : '' }}">Suppliers</a></li>
          <li class="list-group-item"><a href="{{ route('tips.index')}}" class="{{ Route::currentRouteName()=='tips.index' ? 'active' : '' }}">Tips</a></li>
          <li class="list-group-item"><a href="{{ route('polls.index')}}" class="{{ Route::currentRouteName()=='polls.index' ? 'active' : '' }}">Polls</a></li>
       </ul>
    </div>
    <!--<div class="card mt-4 mb-3 border-0"  >
       <div class="card-body text-center">
       <div class="badge-icon"><img src="{{ asset('public/rider/images/badge.png')}}"></div>
       <div class="badge-status">Current status of Badge</div>
       <p class="badge-txt">Also we’ll show the available points in your account here.</p>
       </div>
       </div>
       <div class="sponser-ads"><span>SPONSERED ADS</span></div>-->
 </div>