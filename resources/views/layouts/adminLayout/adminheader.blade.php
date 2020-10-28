<style>
.navbar-brand {
  font-size: 36px;
}
.logo-default{max-width: 175px; max-height: 50px; width: 100%; margin-top: 1px !important; min-height: 75px;}
.logo-default img{max-width: 100%; max-height: 100%; display: inline-block; float: none;}
</style>
<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<a href="{{ url('admin/dashboard') }}" class="navbar-brand logo-default" style=" margin-left: 5px;">
				<img src="{{ asset('images/logo.png') }}" />
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="page-top">
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						{{Auth::user()->name }} </span>
						<img alt="" class="img-circle" src="{{ asset('images/AdminImages/'.Auth::guard('admin')->user()) }}"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="">
									<i class="icon-user"></i> My Profile 
								</a>
							</li>
							<li>
								<a href="{{ url('admin/logout') }}">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>