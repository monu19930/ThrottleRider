<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
<html lang="en" class="ie9 no-js">
<html lang="en">
	<head>
    	<meta charset="utf-8"/>
	    <title>@if(isset($title)) {{$title}} - {{config('constants.project_name')}} @endif</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
		<link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">
		<link rel="mask-icon" href="{{asset('images/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
		<link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}">
		<meta name="apple-mobile-web-app-title" content="Avon">
		<meta name="application-name" content="Avon">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-config" content="{{asset('images/favicon/browserconfig.xml')}}">
		<meta name="theme-color" content="#ffffff">
	    <!-- styles Starts -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/font-awesome/css/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/simple-line-icons/simple-line-icons.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/bootstrap/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/bootstrap/css/formValidation.min.css') }}" />
		<link href="{!! asset('css/backend_css/bootstrap-switch.min.css') !!}" rel="stylesheet" type="text/css"/>
		<link href="{!! asset('css/backend_css/bootstrap-fileinput.css') !!}" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/tasks.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/components-rounded.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/plugins.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/layout.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/light.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/custom.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/profile.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/datepicker.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-select.min.css')}}" />
		<link rel="stylesheet" href="{{ URL::asset('css/backend_css/admin.css') }}" />
		<!-- styles ends here -->
		<script src="{!! asset('js/backend_js/jquery.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/bootstrap.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/bootstrap-hover-dropdown.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/jquery.blockui.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/formValidation.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/Framework/bootstrap.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/jquery.cokie.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/bootstrap-switch.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/bootstrap-fileinput.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/jquery.dataTables.min.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/dataTables.bootstrap.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/datatable.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/table-ajax.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/metronic.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/layout.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/demo.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('js/backend_js/tasks.js') !!}" type="text/javascript"></script>
		<script src="{{ asset('js/backend_js/bootstrap-select.min.js')}}" type="text/javascript"></script>

		<script src="{!! asset('js/backend_js/datepicker.min.js') !!}" type="text/javascript"></script>
		
	</head>
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
		@include('layouts.adminLayout.adminheader')
		<div class="clearfix">
		</div>
		
		@include('layouts.adminLayout.admin-footer')
		<div class="loadingDiv" style="display:none;">
	</body>
</html>