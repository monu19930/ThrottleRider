<div class="container">
<div class="row">
	<div class="col-md-8">			
		<div class="cust-left-block pt-4">
			<h2 class="page-heading">{{$result['type']}}</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{$total}} {{$result['key']}} found</strong></span>
			</div>
			<div class="row">
				@if(isset($rides) && ($rides->count() > 0))
					@foreach($rides as $ride)
				<div class="col-12 mb-4 mt-4">
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
			@endif

			<!-- repeat div from here START -->
			<div class="col-md-12">
				<div class="row">
				@if(isset($groups) && ($total > 0))
					@foreach($groups as $group)			  
				<div class="col-md-4 mt-4">
					<div class="top-riders-block">
					<div class="card" >
					<img src="{{ asset('public/images/group_images/')}}/{{$group['group_image']}}" class="card-img-top" alt="">
					<div class="card-body position-relative">
						<img src="{{ asset('public/images/rider_images/')}}/{{$group['rider_image']}}" class="user-pic" widtj="60" height="60"/>
						<div class="username mb-2  d-md-none">
						<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
						</div>
						<h3 class="user-name">{{$group['group_name']}}<small class="sml-txt">{{$group['city']}}</small></h3>
						<div class="location-details py-4 d-flex align-items-center">
						<span class="rating pl-0 d-none d-md-block">{{$group['group_rating']}} <small>Rating</small></span>
						<span class="other-details pl-0">{{$group['total_rides']}} <small>Rides</small></span>
						<span class="other-details pl-0">{{$group['total_km']}} km <small>Driven</small></span>
						<div class="d-flex followers-block align-items-center">
							
							<span class="joined-grp">{{$group['total_group_members']}} People<small>Joined the group</small></span>
						</div>
						</div>
							<!-- <button class="join-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>JOIN</button> -->
							<button class="follow-btn flex-grow-1  mt-2 ml-1"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
					</div>
					</div>
					</div>
					</div>
				@endforeach
				@endif
				</div>
			</div>

			<div class="col-md-12">
				<div class="row">
				@if(isset($riders) && ($total > 0))
					@foreach($riders as $rider)
					<div class="col-md-4 mt-4">
						<div class="top-riders-block">
						<div class="card" >
						<img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
						<div class="card-body position-relative">
							<img src="{{ asset('public/images/rider_images/')}}/{{$rider['rider_image']}}" class="user-pic" widtj="60" height="60"/>
							<div class="username mb-2">
							<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> {{$rider['rating']}}</span> 
							</div>
							
							<h3 class="user-name">{{$rider['rider_name']}}<small>{{$rider['rider_email']}}</small></h3>
							<blockquote class="blockquote-block d-none d-md-block">“{{substr($rider['description'], 0, 65)}}”</blockquote>
							<div class="location-details d-flex align-items-center">
							<span class="rating pl-0 d-none d-md-inline-block">{{$rider['rating']}} <small>Rating</small></span>
							<span class="other-details pl-0">{{$rider['total_rides']}} <small>Rides</small></span>
							<span class="other-details pl-0">{{$rider['total_km']}} km <small>Driven</small></span>
							
							</div>
							<button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
						</div>
						</div>
						</div>
					</div>
					@endforeach			 
				@endif
				</div>

				<div class="row">
				@if(isset($suppliers) && ($total > 0))
					@foreach($suppliers as $supplier)
					<div class="col-md-4 mt-4">
						<div class="top-riders-block">
						<div class="card" >
						<img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
						<div class="card-body position-relative">
							<img src="{{ asset('public/images/supplier_images/')}}/{{$supplier['supplier_image']}}" class="user-pic" widtj="60" height="60"/>
							<div class="username mb-2">
							<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> {{$supplier['supplier_rating']}}</span> 
							</div>
							
							<h3 class="user-name">{{$supplier['supplier_name']}}<small></small></h3>
							<blockquote class="blockquote-block d-none d-md-block">“{{$supplier['supplier_description']}}”</blockquote>
							<div class="location-details d-flex align-items-center">
								<span class="rating pl-0 d-none d-md-inline-block">{{$supplier['supplier_rating']}} <small>Rating</small></span>						
								<span class="rating pl-0 d-none d-md-inline-block">{{$supplier['supplier_address']}} <small>Address</small></span>						
							</div>
						</div>
						</div>
						</div>
					</div>
					@endforeach			 
				@endif
				</div>
		</div>		   
	</div>
		</div>
	</div>

	<div class="col-md-4 d-none d-md-block">
		  <div class="right-block pt-4">
			<button class="post-btn w-100 mb-3">POST A RIDE
				@guest
				<small>LOGIN REQUIRED</small>
				@endguest
			</button>
			<div class="card mt-2 mb-3 border-0">
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item"><h4 class="notify-heading">Notifications</h4></li>
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

