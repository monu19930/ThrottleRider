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
                 <span class="other-details"><i class="fa fa-map"></i>{{ isset(user()->profile) ? user()->profile->total_rides : 0}} <small>Total Rides</small></span>						
                 <span class="other-details"><i class="fa fa-calendar"></i>{{ isset(user()->profile) ? user()->profile->total_km : 0}} km <small>Total Driven</small></span>					
             </div>
             </div>
             <button class="join-btn w-100 d-none d-lg-block"><a href="{{route('my-profile.edit')}}"><i class="fa fa-pencil mr-2"></i> EDIT</a></button>					
          </div>
       </div>
    </div>
    <div class="card mt-2 mb-3 mob-top-links"  >
       <ul class="list-group list-group-flush cust-profile-links">
          <li class="list-group-item"><a href="{{route('my-profile')}}" class="{{ Route::currentRouteName()=='my-profile' ? 'active' : '' }}">Profile</a></li>
          <li class="list-group-item"><a href="{{ route('rides')}}" class="{{ Route::currentRouteName()=='rides' ? 'active' : '' }}">Rides</a></li>
          <li class="list-group-item"><a href="{{ route('bikes')}}" class="{{ Route::currentRouteName()=='bikes' ? 'active' : '' }}">Bikes</a></li>
          <li class="list-group-item"><a href="{{ route('groups.index')}}" class="{{ Route::currentRouteName()=='groups.index' ? 'active' : '' }}">Groups</a></li>
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