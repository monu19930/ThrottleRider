<!-- JS FILES NOW -->
<script src="{{ asset('public/rider/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('public/rider/js/slick.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('public/rider/js/sweetalert.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" /> 


@yield('javascript')
<script type="text/javascript">
    function registerRider () {  
        $(function() {
            $('#signup').html('Please Wait...');
            $("#signup"). attr("disabled", true);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                url: "{{route('rider-register')}}",
                type: "POST",
                data: $('#signupForm').serialize(),
                success: function( response ) {
                    
                    if(response.status==true) {
                        $('#signup').html('CREATE A NEW ACCOUNT');
                        $("#signup"). attr("disabled", false);                        

                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $(".print-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                        $(".print-error-msg").addClass('alert-success').removeClass('alert-danger');

                        setTimeout(function () {
                            if ($(".alert").is(":visible")){
                                $(".alert").fadeOut("fast");
                            }
                            document.getElementById("signupForm").reset();
                            location.replace("{{ route('my-profile') }}");
                        }, 3000);
                    }
                },
                error: function(response) {
                    var error = response.responseJSON.errors;
                    $('#signup').html('CREATE A NEW ACCOUNT');
                    $("#signup"). attr("disabled", false);
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( error, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                    $(".print-error-msg").addClass('alert-danger').removeClass('alert-success');
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000);
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
                headers: {'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')}
            });
            $.ajax({
            url: "{{route('rider-login')}}",
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
        //Update Rider Profile
        $('#updateProfile').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
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
                        showMessage('Success', 'Profile updated successfully!', 'success');
                        setTimeout(function () {                            
                            location.replace("{{ route('my-profile') }}");
                        }, 3000);
                    }
                    else {
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 100;
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $.each( response.error, function( key, value ) {
                            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
                }
            });
        });

        
        $("#bike_list").autocomplete({ 
            source: function (request, response) {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({ 
                    url:"{{route('bike-search')}}", 
                    type: "POST",
                    format: "json",
                    data: {
                        limit: 8,
                        search: request.term,
                    },
                    
                    success: function (data) {
                        response(data);
                    }, 
                }); 
            },
            select : getBikeDetails
        }); 

        //submit bike form step 1
        $('#submitBikeStep1').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('bike-register1')}}",
                type: "POST",
                data: $('#addBikeForm1').serialize(),
                success: function( response ) {
                    $('#bike_tab2').show();
                    $('#bike_tab1').hide();
                    $('#progressStep1').css('color','#047922');
                    $('#progressStep2').css('color','black');                 
                },
                error: function(response) {                    
                    var error = response.responseJSON.errors;
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( error, function( key, value ) {                           
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000)
                } 
            });
        });


        //Submit Bike Form Step 2
        $('#submitBikeStep2').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('bike-register2')}}",
                type: "POST",
                data: new FormData($('#addBikeForm2')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    if(response.status==false) {
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 100;
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $.each( response.error, function( key, value ) {
                            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                        setTimeout(function () {
                            if ($(".alert").is(":visible")){
                                $(".alert").fadeOut("fast");
                            }
                        }, 5000)
                    }
                    else {
                        $('#bike_tab2').hide();
                        $('#bike_tab1').hide();
                        $('#review_bike').show();                        
                        $('#review_bike').html(response);
                        $('#progressStep2').css('color','#047922');
                        $('#progressStep3').css('color','black');
                    }
                }
            });
        });
 
        //submit ride form step 1
        $('#rideStep1').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('register1')}}",
                type: "POST",
                data: $('#addRideForm1').serialize(),
                success: function( response ) {
                    if(response.status == true) {
                        $('#tab2').show();
                        $('#tab1').hide();
                        if(response.days == 0){
                            $('#add').hide();
                        }
                        $('#start_location_0').val(response.start_location);
                        $('#first_day').attr('content', response.days);
                    } else {
                        scroll();
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
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
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
                    $('#review_ride').show();                        
                    $('#review_ride').html(response);
                }
            });
        });

        //Event form step 1
        $('#eventStep1').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('group.events.add.step1')}}",
                type: "POST",
                data: $('#addEventForm1').serialize(),
                success: function( response ) {
                    if(response.status == true) {
                        $('#tab2').show();
                        $('#tab1').hide();
                        if(response.days == 0){
                            $('#add').hide();
                        }
                        $('#start_location_0').val(response.start_location);
                        $('#first_day').attr('content', response.days);
                    }
                }, error: function(response){
                    var error = response.responseJSON.errors;
                    scroll();
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( error, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });

                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000)
                }
            });
        });

        //Event Form Step 2
        $('#eventStep2').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('group.events.add.step2')}}",
                type: "POST",
                data: new FormData($('#addEventForm2')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    $('#tab2').hide();
                    $('#tab1').hide();                   
                    $('#review_ride').show();                        
                    $('#review_ride').html(response);
                }
            });
        });

        $('#submitGroup').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('group-submit')}}",
                type: "POST",
                data: new FormData($('#groupForm')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    if(response.status == true) {
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $(".print-error-msg").addClass('alert-success').removeClass('alert-danger');
                        $(".print-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                        document.getElementById("groupForm").reset();
                        setTimeout(function () {
                            if ($(".alert").is(":visible")){
                                $(".alert").fadeOut("fast");
                            }
                            location.replace("{{ route('groups') }}");
                        }, 3000)
                    }
                }, error: function(response) {
                    var error = response.responseJSON.errors;
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( error, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                    $(".print-error-msg").addClass('alert-danger').removeClass('alert-success');
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000);
                }
            });
        })

        //social login
        $('.social_login').on('click', function(){
            var socialUrl = $(this).attr('data-content');
            $('#loginmodal').modal('hide');
            socialWindow = window.open(
                socialUrl, 'socialWindow', 'height=500,width=500,left=40,top=40,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
        
        });


        $(function() {
            $("#start_date").datepicker({
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#end_date").datepicker("option", "minDate", dt);
                }
            });

            $("#end_date").datepicker({
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#start_date").datepicker("option", "maxDate", dt);
                }
            });

         });

        //Ride Submit Step
        $('#riderSubmit').on('click',function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
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
            var max = $('#first_day').attr('content');

            if(i < max) {
                i++;                
                if(i == parseInt(max)) {
                    $(this).hide();
                }
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({
                    url: "{{route('ride-day')}}",
                    type: "POST",
                    data: {val: i},
                    success: function( response ) {                        
                        $('#dynamic_field').append(response);
                    }
                });                
            }
        });

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();
            $('#add').show();
            i--;
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


        //Add More Ride Luggage
        var max_fields_limit = 8;
        var j = 1;
        $('#add_more_ride_luggage').click(function(e){
            e.preventDefault(); 
            if(j < max_fields_limit){
                j++;
                $('#ride_luggage_list').append('<div class="form-group"><input type="text" autocomplete="off" class="form-control" name="ride_luggage[]" placeholder="Add your point"><a href="javascript:void(0)" class="remove_field">Remove</a></div>'); //add input field 
            } 
        }); 
        $('#ride_luggage_list').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); j--; 
        })


        //Back Bike Step Event
        $('#backBikeStep1').on('click', function(){
            $('#bike_tab2').hide();
            $('#bike_tab1').show();

            $('#progressStep1').css('color','black');
            $('#progressStep2').css('color','#b8bcbf');
            $('#progressStep3').css('color','#b8bcbf');
        })


        //Back Ride Step Event        
        $('#backRideStep1').on('click', function(){
            $('#tab2').hide();
            $('#tab1').show();
        })

        //Save Ride Luggage
        $('#rideLuggageSubmit').on('click', function(){
            var luggage = [];
            var inps = document.getElementsByName('ride_luggage[]');
            for (var i = 0; i < inps.length; i++) {
                var inp=inps[i];
                if(inp.value != '') {
                    luggage.push(inp.value);
                }
            }

            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');

            if(luggage.length > 0) {
                $('#ride_luggage').attr('value', JSON.stringify(luggage));
                $(".print-error-msg").removeClass("alert-danger").addClass('alert-success');            
                $(".print-error-msg").find("ul").append('<li>Ride luggage added successfully</li>');
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                    $('#rideLuggageModal').modal('hide');
                }, 3000);
            } else {
                $(".print-error-msg").find("ul").append('<li>Field is required</li>');
                $(".print-error-msg").addClass("alert-danger").removeClass('alert-success');
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                }, 3000);
            }
            
            
        })


        //search filter
        $("#search-input").autocomplete({ 
            source: function (request, response) {
                $('#submit-search').attr('content', request.term);
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({ 
                    url:"{{route('search-location')}}", 
                    type: "POST",
                    format: "json",
                    data: {
                        limit: 8,
                        search: request.term
                    },
                    
                    success: function (data) {
                        response(data);
                    }, 
                }); 
            },
        });

        $('#submit-search').on('click', function(){
            var search_keyword = $('#search-input').val();
            var key = $('#submit-search').attr('content');
            $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
            $.ajax({ 
                url:"{{route('search-location-result')}}", 
                type: "POST",
                format: "json",
                data: {
                    search: key,
                    search_type: search_keyword
                },
                
                success: function (response) {
                    //response(data);
                    $('#search_res').html(response);  
                }, 
            }); 
        })


        //Rider Group Join
        $('.rider-group-join').on('click', function(){
            var is_user = "{{Auth::user()}}";
            if(!is_user) {
                $('#loginmodal').modal('show');
            }
            
            var group_id = $(this).attr('content');
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('join-group')}}",
                type: "POST",
                data: {group_id:group_id},
                success: function( response ) {
                    if(response.status==true) {
                        $('#group-join-'+group_id).removeClass('rider-group-join');                       
                        $('#group-join-'+group_id).html('<i class="fa fa-send mr-2"></i>Joined');
                        
                    }         
                }
            });
        })

        //remove bike
        $('.ride-remove').on('click', function(){
            var id = $(this).attr('content');
            var url = "{{route('delete-ride')}}";
            var cls = "ride-refferer";
            deleteRecord(id,url,cls);
        });

        //remove bike
        $('.bike-remove').on('click', function(){
            var id = $(this).attr('content');
            var url = "{{route('delete-bike')}}";
            var cls = "bike-refferer";
            deleteRecord(id,url,cls);            
        })
    });

    function scroll() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 100;
    }

    function sendGroupInvitation() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
        $.ajax({
            url: "{{route('invite-group-members')}}",
            type: "POST",
            data: $('#inviteGroupMembersForm').serialize(),
            success: function( response ) {
                if(response.status==true) {
                    $(".invite-error-msg").find("ul").html('');
                    $(".invite-error-msg").css('display','block');                 
                    $(".invite-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".invite-error-msg").addClass("alert-success").removeClass('alert-danger');                    
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                        document.getElementById("inviteGroupMembersForm").reset();
                        $('#inviteMembersModal').modal('hide');
                    }, 3000);
                } 
                else {
                    $(".invite-error-msg").find("ul").html('');
                    $(".invite-error-msg").css('display','block');                 
                    $(".invite-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".invite-error-msg").addClass("alert-danger").removeClass('alert-success');
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000);
                }         
            }
        });
    }

    function inviteMembers(id) {
        $('#group_member').val(id);
        $('#inviteMembersModal').modal('show');
    }


    function reviewBikeDetails(){
        $('.review-bike-selected').hide();
        $('#review_bike_change').show();
    }
    function cancelReviewBikeChange(){
        $('.review-bike-selected').show();
        $('#review_bike_change').hide();
    }

    function reviewBikeImagesDetails() {
        $('.review-bike-image-selected').hide();
        $('#review_bike_images_change').show();
    }
    function cancelReviewBikeImagesChange() {
        $('.review-bike-image-selected').show();
        $('#review_bike_images_change').hide();
    }

    function reviewBikeMoreDetails() {
        $('.review-bike-moredetails-selected').hide();
        $('#review-bike-moredetails-change').show();
    }
    function cancelReviewBikeDetailsChange() {
        $('.review-bike-moredetails-selected').show();
        $('#review-bike-moredetails-change').hide();
    }

    function reviewBikeDescription() {
        $('.review-bike-description-selected').hide();
        $('#review-bike-description-change').show();
    }
    function cancelReviewBikeDescChange() {
        $('.review-bike-description-selected').show();
        $('#review-bike-description-change').hide();
    }

    function reviewBikeStep1() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('bike-register1')}}",
            type: "POST",
            data: $('#addReviewBikeForm1').serialize(),
            success: function( response ) {
                $('.review-bike-selected').show();
                $('#review_bike_change').hide();               
            },
            error: function(response) {                    
                var error = response.responseJSON.errors;
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( error, function( key, value ) {                           
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                }, 3000)
            } 
        });
    }

    function deleteRecord(id,url,cls) {
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(isConfirm) {
            if (isConfirm) {                    
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id:id},
                    success: function( response ) {
                        if(response.status==true) {
                            alertSwal('Deleted', response.msg, 'success');                            
                            $('.'+cls+'-'+id).remove();                           
                        }         
                    }, error(){
                        alertSwal('Failed', 'Something goes wrong, Please try again', 'error');                        
                    }
                });
            }
        });         
    }

    function alertSwal(ttl,msg,icn) {
        swal({
            title: ttl,
            text: msg,
            icon: icn
        })
    }

    function getBikeDetails(event, ui) { 
        $(function() {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('search-bike-details')}}",
                type: "POST",
                data: {keyword:ui.item.label},
                success: function( response ) {
                    var img = "{{ asset('public/images/bike_models/')}}/"+response.image;
                    $('#bike-icon').hide();
                    $('.selected_bike').show();
                    $('#selected_bike').attr('src', img);
                }
            });

        });
    }

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
                    if(response.status==true) {
                        showMessage('Success', response.msg, 'success');
                        setTimeout(function () {                            
                            location.replace("{{ route('rides') }}");
                        }, 3000);                        
                    }
                    else {
                        showMessage('Failed', response.msg, 'error');
                    }
                    
                }
            });

        });
    }

    function submitEvent(){
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('group.events.submit')}}",
                type: "POST",
                data: {status:true},
                processData: false,
                contentType: false,
                success: function( response ) {
                    if(response.status==true) {
                        showMessage('Success', response.msg, 'success');
                        setTimeout(function () {                            
                            location.replace(response.redirect);
                        }, 3000);                        
                    }
                    else {
                        showMessage('Failed', response.msg, 'error');
                    }
                    
                }
            });

        });
    }

    function submitBike(id=''){
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('bike-submit')}}",
                type: "POST",
                data: {id:id},
                success: function( response ) {
                    if(response.status==true) {
                        showMessage('Success', response.msg, 'success');
                        setTimeout(function () {                            
                            location.replace("{{ route('bikes') }}");
                        }, 3000)
                    }
                    else {
                        showMessage('Failed', response.msg, 'error');
                    }
                    
                }
            });

        });
    }

    function bikeDetailsStep() {
        $(function(){
            $('#bike_tab2').show();
            $('#bike_tab1').hide();
            $('#review_bike').hide();

            $('#progressStep1').css('color','#047922');
            $('#progressStep2').css('color','black');
            $('#progressStep3').css('color','#b8bcbf');
        });
    }

    
    function rideDetailsPage() {
        $(function(){
            $('#tab2').show();
            $('#tab1').hide();
            $('#review_ride').hide();
        });
    }
    //sweat alert
    function showMessage(status_mg, msg, status) {
        sweetAlert(status_mg, msg, status);
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

    //get brand list   
    function showBikeModelList(id) {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
        $.ajax({
            url: "{{route('brand-list')}}",
            type: "POST",
            data: {brand_id:id},
            success: function( response ) {

                $('#bikeListModal').modal('show');
                $('#bike_models').html(response);         
            }
        });
    }

    function showReviewBikeModelList(id) {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('brand-list')}}",
            type: "POST",
            data: {brand_id:id},
            success: function( response ) {
                $('#reviewBikeListModal').modal('show');
                $('#review_bike_models').html(response);                         
            }
        });
    }

    function submitReviewBikeModel() {
        var model_name = $('#review_bike_models option:selected').val();
        var img = $('#review_bike_models option:selected').attr('data-content');
        $('#review_bike_list').val(model_name);
        console.log(model_name);
        var model_image = "{{ asset('public/images/bike_models/')}}/"+img;
        $('#reviewBikeListModal').modal('hide');
        $('#review_selected_bike').attr('src', model_image);
    }

    function submitReviewBikeChangeStep(){
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('bike-register1')}}",
            type: "POST",
            data: $('#addReviewBikeForm1').serialize(),
            success: function( response ) {

                $('.review-bike-name').text($('#review_bike_list').val());
                $('#review_bike_image').attr('src', $('#review_selected_bike').attr('src'));

                $('.review-bike-selected').show();
                $('#review_bike_change').hide();        
            },
            error: function(response) {                    
                var error = response.responseJSON.errors;
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( error, function( key, value ) {                           
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                }, 3000)
            } 
        });
    }

    function submitReviewBikeMoreDetailsStep() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('review-bike-moredetails-save')}}",
            type: "POST",
            data: $('#addReviewBikeMoreDetailsForm1').serialize(),
            success: function( response ) {
                $('.review_total_km').text($('.rview_total_km').val());
                $('.review_total_rides').text($('.rview_total_rides').val());
                $('.review_comfortness').text($('.rview_comfortness').val());
                $('.review_visual_appeal').text($('.rview_visual_appeal').val());
                $('.review_reliability').text($('.rview_reliability').val());
                $('.review_performance').text($('.rview_performance').val());
                $('.review_service_experience').text($('.rview_service_experience').val());

                $('.review-bike-moredetails-selected').show();
                $('#review-bike-moredetails-change').hide();        
            },
            error: function(response) {                    
                var error = response.responseJSON.errors;
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( error, function( key, value ) {                           
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                }, 3000)
            } 
        });
    }

    function submitReviewBikeDescriptionStep() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('review-bike-desc-save')}}",
            type: "POST",
            data: $('#addReviewBikeDescForm1').serialize(),
            success: function( response ) {
                $('.review_description').text($('.rview_description').val());
                $('.review-bike-description-selected').show();
                $('#review-bike-description-change').hide();        
            },
            error: function(response) {                    
                var error = response.responseJSON.errors;
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( error, function( key, value ) {                           
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                }, 3000)
            } 
        });
    }

    function submitReviewBikeImageStep() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('review-bike-image-save')}}",
            type: "POST",
            data: new FormData($('#addReviewBikeImageForm')[0]),
            processData: false,
            contentType: false,
            cache:false,
            success: function( response ) {
                updateReviewedSelectedFiles(response.img['image']);
                $('.review-bike-image-selected').show();
                $('#review_bike_images_change').hide();        
            },
            error: function(response) {                    
                var error = response.responseJSON.errors;
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( error, function( key, value ) {                           
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                }, 3000)
            } 
        });
    }

    function updateReviewedSelectedFiles(images) {
        var html = '';
        var img_path = "{{ asset('public/images/rider/bikes/')}}";
        for (var i = 0; i < images.length; i++)
        {
            html += '<img src="'+img_path+'/'+images[i]+'" width="200" height="200">'
        }
        $('.review_bike_images_list').html(html);
    }

    function submitBikeModel() {
        var model_name = $('#bike_models option:selected').val();
        var img = $('#bike_models option:selected').attr('data-content');
        $('#bike_list').val(model_name);
        var model_image = "{{ asset('public/images/bike_models/')}}/"+img;
        $('#bikeListModal').modal('hide');
        $('#bike-icon').hide();
        $('#selected_bike').attr('src', model_image);
        $('.selected_bike').show();
    }
</script>