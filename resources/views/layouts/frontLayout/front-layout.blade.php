<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Throttle Rides</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0;">
        <script src="https://use.fontawesome.com/de227abbfd.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- font-family: 'Lato', sans-serif;
              Light 300
              Regular 400
              Bold 700
              Black 900

           font-family: 'Oswald', sans-serif;
            Light 300
            Regular 400
            Medium 500
            Semi-bold 600
            Bold 700
            -->
       @include('layouts.frontLayout.style-files')

         
    </head>
    <body class="">
	  

		<div class="PleaseWaitDiv" style="display:none;">
        	<b><p style="color: #000;">Please wait...</p></b>
        </div>
		@include('layouts.frontLayout.front-header')
            @yield('content')
        @include('layouts.frontLayout.front-modals')
		@include('layouts.frontLayout.js-files')
		@include('layouts.frontLayout.front-footer')
		
	</body>
</html>