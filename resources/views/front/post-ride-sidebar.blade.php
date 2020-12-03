<div class="right-block pt-4">
					<button class="post-btn w-100 mb-3 post-ride">POST A RIDE
						@guest
						<small>LOGIN REQUIRED</small>
						@endguest
					</button>
					<div class="card mt-2 mb-3 border-0">
						<ul class="list-group list-group-flush cust-notify">
							<li class="list-group-item">
								<h4 class="notify-heading">Notifications</h4>
							</li>
							@foreach($events as $key => $event)
								@if($key < 3) 
								<li class="list-group-item">
									<div class="notify-title">Ride To {{$event['end_location']}} Via {{$event['via_location']}}</div>
									<p class="notify-txt">{{substr($event['description'], 0, 50)}}... <a href="{{route('rides.show',$event['slug'])}}">more</a></p>
									<span class="right-arrow"><i class="fa fa-angle-right"></i></span>
								</li>
								@endif
							@endforeach
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