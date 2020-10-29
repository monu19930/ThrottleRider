
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Latest Rides
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{$rides->count()}} new rides from <strong>Bangaluru</strong></span>
			  <span class="filter-block2 left-seperater">Not your city? <a href="#">Change here</a></span>
			  <span class="ml-auto filter-block3 mob-filter"><a href="#">View all Rides</a></span>
			</div>
			<div class="row">
			  <!-- repeat div from here START -->
		@if($rides->count() > 0)
			@foreach($rides as $ride)
			<div class="col-12 mb-3">
			  <div class="rides-block d-none d-md-flex">
				<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
				<div class="rider-details-block w-100 order-1 order-md-2">
				   <div class="location-heading-block ">
					 <div>
					   <h4 class="location-title">{{ implode(',',json_decode($ride->via_location))}},{{$ride->end_location}}</h4>
					   <div class="d-flex align-items-center location-block">
						 <span class="location">Banglore, Karnatka, India</span>
						 <span class="time left-seperater">in month of <span>June 2019</span></span></span>
					   </div>
					 </div>
					 <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				   </div>
				   <div class="location-details d-flex align-items-center">
					 <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					 <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					 <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					 <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
				   </div>
				   <div class="userdetails d-flex align-items-center">
					 <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					 <span class="username">
					   <span class="d-block">Ekene Obasey</span>
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
					   <span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
					 </div>
					  <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					  <div class="d-flex align-items-center location-block mb-2">
						<!-- <span class="location">Banglore, Karnatka, India</span> -->
						<span class="time">in month of <span>June 2019</span></span></span>
					  </div>
					  <div class="location-details d-flex align-items-center ">
					 
					   <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					   <!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
					   <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					 </div>
					</div>
					
				  </div>
			   </div>
			   <div class="rider-img-block ml-3 ">
				 <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
			   </div>
			  </div>
			   <div class="d-flex align-items-center mt-1">
				 <div class="userdetails d-flex align-items-center">
				 <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				 <span class="username">
				   <span class="d-block">Ekene Obasey</span>
				   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				 </span>
				 </div> 
				 <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
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

			<h4 class="page-sub-heading mt-4 mb-3">
			 Explore other cities
			 <small>People from bengaluru are taking Rides from  these populer cities too</small>
		   </h4>
		   <div class="other-cities slider border-bottom pb-5 mb-2">
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/delhi.jpg')}}">
			   <div class="img-content">
				 <span class="no-rides">23</span>
				 <span class="ride-loc">Rides from</span>
				 <span class="ride-state">Delhi, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/chennai.jpg')}}">
			   <div class="img-content">
				 <span class="no-rides">43</span>
				 <span class="ride-loc">Rides from</span>
				 <span class="ride-state">Chennai, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/dhanushkodi.jpg')}}">
			   <div class="img-content">
				 <span class="no-rides">4</span>
				 <span class="ride-loc">Rides from</span>
				 <span class="ride-state">Dhanushkodi, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/goa.jpg')}}">
			   <div class="img-content">
				 <span class="no-rides">32</span>
				 <span class="ride-loc">Rides from</span>
				 <span class="ride-state">Goa, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/mysure.jpg')}}">
			   <div class="img-content">
				 <span class="no-rides">17</span>
				 <span class="ride-loc">Rides from</span>
				 <span class="ride-state">Mysure, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/goa.jpg')}}">
			   <div class="img-content">
				 <span class="no-rides">32</span>
				 <span class="ride-loc">Rides from</span>
				 <span class="ride-state">Goa, India</span>
			   </div>
			 
			 </div>
		   </div>
		   <h2 class="page-heading mt-5">
			 Top Bikers and groups in Bengaluru
			 <small>Get inspires from top Riders around the world and Join them to get latest update.</small>
		   </h2>
		   <div class="d-flex align-items-center filter-details">
			 <h4 class="page-sub-heading mt-4 mb-3">
			  Top Bikers
				
			 </h4>
			 <span class="ml-auto filter-block3"><a href="#">View all Rides</a></span>
		   </div> 
		   <div class="top-riders-slider slider  mb-2">
			 <div class="slide">
				<div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2">
					   <span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> 4.5</span> 
					 </div>

					 
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <blockquote class="blockquote-block d-none d-md-block">“Dream to ride a bike to Ladakh someday. Owns KTM and 5 other bikes.”</blockquote>
					 <div class="location-details d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-inline-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					 
					 </div>
					 <button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				 </div>
				</div>
			 </div>
			 <div class="slide">
				<div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2">
					   <span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> 4.5</span> 
					 </div>

					 
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <blockquote class="blockquote-block d-none d-md-block">“Dream to ride a bike to Ladakh someday. Owns KTM and 5 other bikes.”</blockquote>
					 <div class="location-details d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-inline-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					 
					 </div>
					 <button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				 </div>
				</div>
			 </div>
			 <div class="slide">
			   <div class="top-riders-block">
				<div class="card" >
				  <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				  <div class="card-body position-relative">
					<img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					<div class="username mb-2">
					  <span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> 4.5</span> 
					</div>

					
					<h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					<blockquote class="blockquote-block d-none d-md-block">“Dream to ride a bike to Ladakh someday. Owns KTM and 5 other bikes.”</blockquote>
					<div class="location-details d-flex align-items-center">
					  <span class="rating pl-0 d-none d-md-inline-block">4.5 <small>Rating</small></span>
					  <span class="other-details pl-0">34 <small>Rides</small></span>
					  <span class="other-details pl-0">2176 km <small>Driven</small></span>
					
					</div>
					<button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				  </div>
				</div>
			   </div>
			</div>
			<div class="slide">
			 <div class="top-riders-block">
			  <div class="card" >
				<img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				<div class="card-body position-relative">
				  <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
				  <div class="username mb-2">
					<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> 4.5</span> 
				  </div>

				  
				  <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
				  <blockquote class="blockquote-block d-none d-md-block">“Dream to ride a bike to Ladakh someday. Owns KTM and 5 other bikes.”</blockquote>
				  <div class="location-details d-flex align-items-center">
					<span class="rating pl-0 d-none d-md-inline-block">4.5 <small>Rating</small></span>
					<span class="other-details pl-0">34 <small>Rides</small></span>
					<span class="other-details pl-0">2176 km <small>Driven</small></span>
				  
				  </div>
				  <button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				</div>
			  </div>
			 </div>
			</div>
			<div class="slide">
			 <div class="top-riders-block">
			  <div class="card" >
				<img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				<div class="card-body position-relative">
				  <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
				  <div class="username mb-2">
					<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> 4.5</span> 
				  </div>

				  
				  <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
				  <blockquote class="blockquote-block d-none d-md-block">“Dream to ride a bike to Ladakh someday. Owns KTM and 5 other bikes.”</blockquote>
				  <div class="location-details d-flex align-items-center">
					<span class="rating pl-0 d-none d-md-inline-block">4.5 <small>Rating</small></span>
					<span class="other-details pl-0">34 <small>Rides</small></span>
					<span class="other-details pl-0">2176 km <small>Driven</small></span>
				  
				  </div>
				  <button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				</div>
			  </div>
			 </div>
			</div>
			<div class="slide">
			 <div class="top-riders-block">
			  <div class="card" >
				<img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				<div class="card-body position-relative">
				  <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
				  <div class="username mb-2">
					<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> 4.5</span> 
				  </div>

				  
				  <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
				  <blockquote class="blockquote-block d-none d-md-block">“Dream to ride a bike to Ladakh someday. Owns KTM and 5 other bikes.”</blockquote>
				  <div class="location-details d-flex align-items-center">
					<span class="rating pl-0 d-none d-md-inline-block">4.5 <small>Rating</small></span>
					<span class="other-details pl-0">34 <small>Rides</small></span>
					<span class="other-details pl-0">2176 km <small>Driven</small></span>
				  
				  </div>
				  <button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				</div>
			  </div>
			 </div>
		  </div>
		   </div>
		   <div class="d-flex align-items-center filter-details">
			 <h4 class="page-sub-heading mt-4 mb-3">
			   Top Groups
				
			 </h4>
			 <span class="ml-auto filter-block3"><a href="#">View all Bikers</a></span>
		   </div> 
		   <div class="top-group-slider slider   mb-3">
			 <div class="slide">
				<div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-1.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-2.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-3.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-4.png')}}" /></span>
						 <span class="joined-grp">26 People<small>Joined the group</small></span>
					   </div>
					 </div>
					 <div class="d-flex">
					   <button class="join-btn flex-grow-1 mt-2 mr-1"><i class="fa fa-send mr-2"></i>Join</button>
					 <button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				   </div>
				 </div>
				</div>
			 </div>
			 <div class="slide">
			   <div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-1.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-2.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-3.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-4.png')}}" /></span>
						 <span class="joined-grp">26 People<small>Joined the group</small></span>
					   </div>
					 </div>
					 <div class="d-flex">
					   <button class="join-btn flex-grow-1 mt-2 mr-1"><i class="fa fa-send mr-2"></i>Join</button>
					 <button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				   </div>
				 </div>
				</div>
			 </div>
			 <div class="slide">
			   <div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-1.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-2.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-3.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-4.png')}}" /></span>
						 <span class="joined-grp">26 People<small>Joined the group</small></span>
					   </div>
					 </div>
					 <div class="d-flex">
					   <button class="join-btn flex-grow-1 mt-2 mr-1"><i class="fa fa-send mr-2"></i>Join</button>
					 <button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				   </div>
				 </div>
				</div>
			 </div>
			 <div class="slide">
			   <div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-1.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-2.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-3.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-4.png')}}" /></span>
						 <span class="joined-grp">26 People<small>Joined the group</small></span>
					   </div>
					 </div>
					 <div class="d-flex">
					   <button class="join-btn flex-grow-1 mt-2 mr-1"><i class="fa fa-send mr-2"></i>Join</button>
					 <button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				   </div>
				 </div>
				</div>
			 </div>
			 <div class="slide">
			   <div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-1.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-2.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-3.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-4.png')}}" /></span>
						 <span class="joined-grp">26 People<small>Joined the group</small></span>
					   </div>
					 </div>
					 <div class="d-flex">
					   <button class="join-btn flex-grow-1 mt-2 mr-1"><i class="fa fa-send mr-2"></i>Join</button>
					 <button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				   </div>
				 </div>
				</div>
			 </div>
			 <div class="slide">
			   <div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/rider/images/top-rider-pic.png')}}" class="user-pic"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">Steve Rogers<small>@rogers.steve99</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating pl-0 d-none d-md-block">4.5 <small>Rating</small></span>
					   <span class="other-details pl-0">34 <small>Rides</small></span>
					   <span class="other-details pl-0">2176 km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-1.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-2.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-3.png')}}" /></span>
						 <span class="follow-users"><img src="{{ asset('public/rider/images/img-4.png')}}" /></span>
						 <span class="joined-grp">26 People<small>Joined the group</small></span>
					   </div>
					 </div>
					 <div class="d-flex">
					   <button class="join-btn flex-grow-1 mt-2 mr-1"><i class="fa fa-send mr-2"></i>Join</button>
					 <button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
				   </div>
				   </div>
				 </div>
				</div>
			 
			 </div>
		   </div>
		   <h2 class="page-heading mt-4">
			 
			 <small>Explore top riders and groups in </small>
		   </h2>
		   <div class="city-filter d-flex align-items-center">
			 <span><a href="#">Delhi</a></span>
			 <span class="left-seperater"><a href="#">Mumbai</a></span>
			 <span class="left-seperater"><a href="#">Chennai</a></span>
			 <span class="left-seperater"><a href="#">Hyderabad</a></span>
			 <span><a href="#">Goa</a></span>
		   </div>
		   <div class="full-banner-content">
			 <img src="{{ asset('public/rider/images/mob-byke.png')}}" class="img-fluid d-md-none">
			 <img src="{{ asset('public/rider/images/full-banner.jpg')}}" class="img-fluid d-none d-md-inline-block"/>
			 <div class="banner-inner-content">
			   <div class="banner-inner-heading">BIKES</div>
			   <h4>Riding your own bike?</h4>
			   <div class="banner-tagline">Add your bike here and get personalized feed and rides suggestions. </div>
			   <div><button class="white-btn mt-4">ADD BIKE NOW</button></div>
			 </div>
		   </div>
		   <h2 class="page-heading mt-5">
			 UPCOMING EVENTS NEARBY BENGALURU
			 <small>Top-rated experiences, Book activities led by local hosts on your next trip</small>
		   </h2>
		   <div class="events-details slider border-bottom pb-5 mt-4 mb-2">
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 25
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Whitefield, Bengaluru</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 16
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Chennai, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 29
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Dhanushkodi, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
				   <span class="calender-head">TUESDAY</span>
				   <span class="calender-body">
					 31
					 <small>May 19</small>
				   </span>
			   </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Goa, India</span>
			   </div>
			 </div>
			 <div class="slide">
			   <img src="{{ asset('public/rider/images/byke.png')}}">
			   <div class="img-content">
				 <div class="calender-block">
					 <span class="calender-head">TUESDAY</span>
					 <span class="calender-body">
					   17
					   <small>May 19</small>
					 </span>
				 </div>
				 <span class="event-name">Get a chance to become
our influencer</span>
				 <span class="ride-state">Mysure, India</span>
			   </div>
			 </div>
			  
		   </div>
		   <h2 class="page-heading mt-5">
			 YOUR FEED
			 <small>Updates from your followers</small>
		   </h2>
		   <div class="d-flex align-items-center filter-details">
			 <h2 class="page-heading mt-4 mb-3">
			  <small><strong>Rickie Baroch</strong> added two trips in his profile.</small>
				
			 </h2>
			 <span class="ml-auto filter-block3"><a href="#">Ask a question?</a></span>
		   </div>
		   <div class="row  mb-3 pb-3">
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
						<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
					  </div>
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
						<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
					  </div>
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
		   </div>
		   <div class="full-banner-content">
			 <img src="{{ asset('public/rider/images/mob-byke.png')}}" class="img-fluid d-md-none">
			 <img src="{{ asset('public/rider/images/full-banner.jpg')}}" class="img-fluid d-none d-md-inline-block"/>
			 <div class="banner-inner-content">
			   <div class="banner-inner-heading">BIKES</div>
			   <h4>Riding your own bike?</h4>
			   <div class="banner-tagline">Add your bike here and get personalized feed and rides suggestions. </div>
			   <div><button class="white-btn mt-4">ADD BIKE NOW</button></div>
			 </div>
		   </div>
		   <div class="d-flex align-items-center filter-details">
			 <h2 class="page-heading mt-4 mb-3">
			  <small><strong>Nikhil</strong> added two trips in his profile.</small>
				
			 </h2>
			 <span class="ml-auto filter-block3"><a href="#">Ask a question?</a></span>
		   </div>
		   <div class="row">
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
						<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
					  </div>
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
			 <div class="col-12 mb-3">
			   <div class="rides-block d-none d-md-flex">
				 <div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
				   <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				 </div>
				 <div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
					  <div>
						<h4 class="location-title">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block">
						  <span class="location">Banglore, Karnatka, India</span>
						  <span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
					  </div>
					  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
					  <span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
					  <span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
					  <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
					  <span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
					  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					  <span class="username">
						<span class="d-block">Ekene Obasey</span>
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
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
						<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
					  </div>
					   <h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
					   <div class="d-flex align-items-center location-block mb-2">
						 <!-- <span class="location">Banglore, Karnatka, India</span> -->
						 <span class="time">in month of <span>June 2019</span></span></span>
					   </div>
					   <div class="location-details d-flex align-items-center ">
					  
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					  </div>
					 </div>
					 
				   </div>
				   
				   
				</div>
				<div class="rider-img-block ml-3 ">
				  <img src="{{ asset('public/rider/images/rider.jpg')}}" class="img-fluid">
				</div>
			   </div>
				<div class="d-flex align-items-center mt-1">
				  <div class="userdetails d-flex align-items-center">
				  <span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
				  <span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
				  </span>
				  </div> 
				  <div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
			  </div>
			  <!-- <mobile div END here -->
			 </div>
		   </div>
		  </div>
		</div>
	 

