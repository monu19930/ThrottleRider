<!-- JS FILES NOW -->
<script src="{{ asset('public/rider/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap.bundle.js')}}"></script>

<script src="{{ asset('public/rider/js/slick.js')}}"></script>






@yield('javascript')
<script type="text/javascript">
    function registerRider () { 
        $(function() {
            $('#signup').html('Please Wait...');
            $("#signup"). attr("disabled", true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            url: "{{url('rider-signup')}}",
            type: "POST",
            data: $('#signupForm').serialize(),
            success: function( response ) {
                if(response.status==true) {
                    $('#signup').html('CREATE A NEW ACCOUNT');
                    $("#signup"). attr("disabled", false);
                    document.getElementById("signupForm").reset();
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".print-error-msg").removeClass('alert-danger').addClass('alert-success');
                }
                else {
                    $('#signup').html('CREATE A NEW ACCOUNT');
                    $("#signup"). attr("disabled", false);
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( response.error, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
            }
            });
        });
    }

    function signinRider() {
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            url: "{{route('login')}}",
            type: "POST",
            data: $('#loginForm').serialize(),
            success: function( response ) {
                if(response.status==true) {
                    $(".response-msg").css('display','block');
                    $(".response-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".response-msg").removeClass('alert-danger').addClass('alert-success');
                    location.replace("{{ route('profile') }}");
                }
                else {
                    $(".response-msg").css('display','block');
                    $.each( response.error, function( key, value ) {
                        $(".response-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
            }
            });
        });
    }

    

    $(function() {
        $('#addBike').on('click', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('add-bike')}}",
                type: "POST",
                data: new FormData($('#bikeForm')[0]),
                processData: false,
                contentType: false,
                success: function( response ) {
                    if(response.status==true) {
                    $('#addBike').html('SUBMIT');
                    $("#addBike"). attr("disabled", false);
                    document.getElementById("bikeForm").reset();
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".print-error-msg").removeClass('alert-danger').addClass('alert-success');
                }
                else {
                    $('#addBike').html('SUBMIT');
                    $("#addBike"). attr("disabled", false);
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( response.error, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
                }
            });
        });   
    });

</script>