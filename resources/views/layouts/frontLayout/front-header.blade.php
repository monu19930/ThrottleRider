
 <header>  
  <?php $page="";

   ?>
  <nav id="navbar_top" class="navbar navbar-expand-lg cust-nav home-header">
        <div class="container">
          <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('public/rider/images/logo.png')}}" class="img-fluid light-logo"> <img src="{{ asset('public/rider/images/logo-dark.png')}}" class="img-fluid dark-logo"></a>
          <a class="mob-search-btn" href="#"><img src="{{ asset('public/rider/images/search.png')}}" /></a>
          <a class="navbar-toggler" href="#" class="text-white">
           <img src="{{ asset('public/rider/images/notification.png')}}" class="notify-icon">
           <span class="notify-badge"></span>
          </a>
          <div class="collapse navbar-collapse" id="main_nav">	
            <ul class="navbar-nav ml-auto cust-links">
              <li class="nav-item"><a class="nav-link" href="{{url('/')}}"> Whats New</a></li>
              <li class="nav-item"><a class="nav-link {{ Route::currentRouteName()=='rides.index' ? 'active' : '' }}" href="{{route('rides.index')}}"> Rides</a></li>
              <li class="nav-item"><a class="nav-link {{ Route::currentRouteName()=='bikers.index' ? 'active' : '' }}" href="{{route('bikers.index')}}"> Bikers</a></li>
              <li class="nav-item"><a class="nav-link {{ Route::currentRouteName()=='groups.index' ? 'active' : '' }}" href="{{route('groups.index')}}"> Groups</a></li>
              <li class="nav-item"><a class="nav-link" href="{{url('/')}}"> More</a></li>
              @auth
              <li class="dropdown user-profile-block">
                <label class="usr-detail">Profile</label>
                              <button class="profile-dropdown" type="button" title="{{ Auth::user()->name}}" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="txt-elps"> {{ Auth::user()->name}} </span><img src="{{ asset('public/images/rider_images/')}}/{{isset(user()->profile->image) ? user()->profile->image:'rider.jpg'}}" class="profile-pic" /><i class="fa fa-angle-down drop-arrow">  </i>
                              </button>
                              <div class="dropdown-menu profile-nav-list" aria-labelledby="dropdownMenuButton"  >
                                <a class="dropdown-item" href="{{route('rider-logout')}}">Logout</a>
                                <a class="dropdown-item" href="{{route('my-profile')}}">My Profile</a>
                              </div>
                     
              </li>
              @endauth

              @guest
              <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#loginmodal"> Login/Signup</a></li>
              @endguest
            </ul>
          </div> <!-- navbar-collapse.// -->
        </div> <!-- container.// -->
      </nav>
          <!-- Mob Nav START-->
          <div class="mob-nav d-md-none">
          <ul class="navbar-nav mob-menu text-center">
            <li class="nav-item">
              <a href="{{url('/')}}" class="{{ Route::currentRouteName()=='login' ? 'active' : '' }}">
                <span class="mob-icon"><img src="{{ asset('public/rider/images/home-active.png')}}" class="img-fluid active-icon"><img src="{{ asset('public/rider/images/home.png')}}" class="img-fluid main-icon"></span>
                <span class="mob-links">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#">
                <span class="mob-icon"><img src="{{ asset('public/rider/images/explore-active.png')}}" class="img-fluid active-icon"><img src="{{ asset('public/rider/images/explore.png')}}" class="img-fluid main-icon"></span>
                <span class="mob-links">Explore </span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" >
                <span class="mob-icon"><img src="{{ asset('public/rider/images/add-active.png')}}" class="img-fluid active-icon"><img src="{{ asset('public/rider/images/add.png')}}" class="img-fluid main-icon"></span>
                <span class="mob-links">Add</span>
              </a>
            </li>
            <li class="nav-item" >
              <a href="#" >
                <span class="mob-icon"><img src="{{ asset('public/rider/images/bookmark-active.png')}}" class="img-fluid active-icon"><img src="{{ asset('public/rider/images/bookmark.png')}}" class="img-fluid main-icon"></span>
                <span class="mob-links">Saved</span>
              </a>
            </li>
            @auth
            <li class="nav-item">
              <a href="{{route('my-profile')}}" class="{{ Route::currentRouteName()=='my-profile' ? 'active' : '' }}">
                <span class="mob-icon"><img src="{{ asset('public/rider/images/profile-active.png')}}" class="img-fluid active-icon"><img src="{{ asset('public/rider/images/profile.png')}}" class="img-fluid main-icon"></span>
                <span class="mob-links">Profile</span>
              </a>
            </li>
            @endauth

            @guest
            <li class="nav-item">
              <a href="{{route('signup-mob')}}" class="{{ Route::currentRouteName()=='signup-mob' ? 'active' : '' }}">
                <span class="mob-icon"><img src="{{ asset('public/rider/images/profile-active.png')}}" class="img-fluid active-icon"><img src="{{ asset('public/rider/images/profile.png')}}" class="img-fluid main-icon"></span>
                <span class="mob-links">Sign Up</span>
              </a>
            </li>
            @endguest
          </ul>
        </div>
        <!-- Mob Nav End-->
      
        <nav  class="navbar navbar-expand-lg cust-nav fixed-top inner-header">
          <div class="container">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('public/rider/images/logo.png')}}" class="img-fluid light-logo"> <img src="{{ asset('public/rider/images/logo-dark.png')}}" class="img-fluid dark-logo"></a>
            <a class="mob-search-btn" href="#"><img src="{{ asset('public/rider/images/search.png')}}" /></a>
            <a class="navbar-toggler" href="#" class="text-white">
             <img src="{{ asset('public/rider/images/notification.png')}}" class="notify-icon">
             <span class="notify-badge"></span>
            </a>
        <div class="dropdown d-inline-block bnr-select">
                        <label class="location-lbl">Your Location</label>
                          <button class="bnr-dropdown" type="button" id="dropdownMenuButton" content="{{getCurrentLocation()}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{getCurrentLocation()}} <i class="fa fa-angle-down drop-arrow">  </i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>
            <div class="cust-search-bar">
                          <div class="search-block">
                            <input type="text" class="search-input" id="search-input" placeholder="Where to? i.e. Delhi or Rides to Delhi" />
                            <a href="javascript:void(0)" id="submit-search" class="bnr-search-btn"><i class="fa fa-search"></i></a>
                          </div>
                    </div>
            <div class="collapse navbar-collapse" id="main_nav">	
              <ul class="navbar-nav ml-auto cust-links">
                <li class="nav-item"><a class="nav-link" href="{{url('/')}}"> Whats New</a></li>
                <li class="nav-item"><a class="nav-link {{ Route::currentRouteName()=='rides.index' ? 'active' : '' }}" href="{{route('rides.index')}}"> Rides</a></li>
                <li class="nav-item"><a class="nav-link {{ Route::currentRouteName()=='bikers.index' ? 'active' : '' }}" href="{{route('bikers.index')}}"> Bikers</a></li>
                <li class="nav-item"><a class="nav-link {{ Route::currentRouteName()=='groups.index' ? 'active' : '' }}" href="{{route('groups.index')}}"> Groups</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/')}}"> More</a></li>
                @auth
                <li class="dropdown user-profile-block">
          <label class="usr-detail">Profile</label>
                        <button class="profile-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="txt-elps"> {{ Auth::user()->name}} </span><img src="{{ asset('public/images/rider_images/')}}/{{isset(user()->profile->image) ? user()->profile->image:'rider.jpg'}}" class="profile-pic" /><i class="fa fa-angle-down drop-arrow">  </i>
                        </button>
                        <div class="dropdown-menu profile-nav-list" aria-labelledby="dropdownMenuButton"  >
                          <a class="dropdown-item" href="{{route('rider-logout')}}">Logout</a>
                          <a class="dropdown-item" href="{{route('my-profile')}}">My Profile</a>
                        </div>
               
                 </li>
                @endauth
  
                @guest
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#loginmodal"> Login/Signup</a></li>
                @endguest
              </ul>
            </div> <!-- navbar-collapse.// --> 
          </div> <!-- container.// -->
          </nav>
      
        <div class="banner">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="banner-sml-txt">Let's ride the world.</div>
                  <div class="banner-big-txt">
                    Show me the Rider, Bikers and Groups from 
                    <div class="dropdown d-inline-block bnr-select">
                      <label class="location-lbl">Your Location</label>
                        <button class="bnr-dropdown" type="button" id="dropdownMenuButton" content="{{getCurrentLocation()}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{getCurrentLocation()}} <i class="fa fa-angle-down drop-arrow">  </i>
                       </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </div>
                  <div class="cust-search-bar">
                        <div class="search-block">
                          <input type="text" class="search-input" id="search-input2" placeholder="Where to? i.e. Delhi or Rides to Delhi" />
                          <a href="javascript:void(0)" id="submit-search2" class="bnr-search-btn"><i class="fa fa-search"></i></a>
                        </div>
                  </div>
                  <div class="trending-txt d-md-flex align-items-center">
                    <label>Trending Searches in {{getCurrentLocation()}} :</label>
                    <a href="#" class="ml-2">5-10km Rides</a>
                    <a href="#" class="left-seperater">2 days ride</a>
                    <a href="#" class="left-seperater">Scenic Rides</a>
                  </div>
                  <div class="explore-txt d-md-flex align-items-center">
                    <label>Can't decide where to go?</label>
                    <a href="#">Tap Here to Explore</a>
                  </div>
              </div>
            </div>
          

        </div>
        </div>
</header>
         
    

     

        
