<!-- JS FILES NOW -->
<script src="{{ asset('public/rider/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('public/rider/js/slick.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('public/rider/js/autocomplete.js')}}"></script>


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
                    removeAlert();
                }
                else {
                    $('#signup').html('CREATE A NEW ACCOUNT');
                    $("#signup"). attr("disabled", false);
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( response.error, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                    $(".print-error-msg").removeClass('alert-success').addClass('alert-danger');
                    removeAlert();
                }
            }
            });
        });
    }

    function removeAlert() {
        $(function() {
            setTimeout(function () {
                if ($(".alert").is(":visible")){
                    $(".alert").fadeOut("fast");
                }
            }, 3000);
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
                    location.replace("{{ route('my-profile') }}");
                }
                else {
                    $(".response-msg").css('display','block');
                    $.each( response.error, function( key, value ) {
                        $(".response-msg").find("ul").append('<li>'+value+'</li>');
                    });
                    removeAlert();
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

        //Update Rider Profile
        $('#updateProfile').on('click', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('edit-profile')}}",
                type: "POST",
                data: new FormData($('#profileForm')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    if(response.status==true) {                        
                        alert('Profile updated successfully');
                        location.replace("{{ route('my-profile') }}");
                    }
                    else {
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $.each( response.error, function( key, value ) {
                            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                        removeAlert();
                    }
                }
            });
        });

        

        //submit ride form step 1
        $('#rideStep1').on('click', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('register1')}}",
                type: "POST",
                data: $('#addRideForm1').serialize(),
                success: function( response ) {
                    if(response.status == true) {
                        $('#tab2').show();
                        $('#tab1').hide();
                    } else {
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $.each( response.error, function( key, value ) {
                            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });

                        setTimeout(function () {
                            if ($(".alert").is(":visible")){
                                $(".alert").fadeOut("fast");
                            }
                        }, 3000)

                    }
                }
            });
        });

        //Submit Ride Form Step 2
        $('#rideStep2').on('click', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('register2')}}",
                type: "POST",
                data: new FormData($('#addRideForm2')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    $('#tab2').hide();
                    $('#tab1').hide();
                    $('#review_ride').append(response);
                }
            });
        });

        $(function() {
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left"
            });
         });

        //Ride Submit Step
        $('#riderSubmit').on('click',function(){
            console.log('check1')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('ride-submit')}}",
                type: "POST",
                data: {status:true},
                processData: false,
                contentType: false,
                success: function( response ) {
                    //do nothing
                }
            });
        });

        //Start Added Code For Add More Ride Day
        var i=0;
        $('#add').click(function(){ 
            i++;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('ride-day')}}",
                type: "POST",
                data: {val: i},
                success: function( response ) {
                    $('#dynamic_field').append(response);
                }
            });
        });

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
        }); 
        //End Added Code For Add More Ride Day


        //Add More Via Location
        var max_fields_limit = 4;
        var j = 1;
        $('#add_more_via').click(function(e){
            e.preventDefault(); 
            if(j < max_fields_limit){
                j++;
                $('#via_location_more').append('<div class="form-group"><input type="text" autocomplete="off" class="form-control" name="via_location[]" class="via_location" placeholder="Via Location"><i class="fa fa-minus remove_field"></i></div>'); //add input field 
            } 
        }); 
        $('#via_location_more').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); j--; 
        })

    });

    function submitRide(){
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('ride-submit')}}",
                type: "POST",
                data: {status:true},
                processData: false,
                contentType: false,
                success: function( response ) {
                    alert(response.msg);
                    if(response.status==true) {                        
                        location.replace("{{ route('rides') }}");
                    }
                    
                }
            });

        });
    }

    function showHideField(val,field_key,content) {
        if(val==1) {
            $('.'+content+'_'+field_key).show();
        }
        else{
            $('.'+content+'_'+field_key).hide();
        }
    }

    //search result
    function findResult(keyword) {
        $(function(){
            var start_location = $('#dropdownMenuButton').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('search-result')}}",
                type: "POST",
                data: {search:keyword,start_location:start_location},
                success: function( response ) {
                    $('#search_res').html(response);                
                }
            });
        });
    }
</script>