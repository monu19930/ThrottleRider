<!-- JS FILES NOW -->
<script src="{{ asset('public/rider/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('public/rider/js/slick.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('public/rider/js/sweetalert.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('public/rider/js/jquery.multiselect.js')}}"></script>
<script src="{{ asset('public/rider/js/jquery-ui.min.js')}}" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script> 
<script src="{{ asset('public/rider/js/jquery.email.multiple.js')}}"></script>

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
                        }, 5000);
                    }
                },
                error: function(response) {
                    $('#signup').html('CREATE A NEW ACCOUNT');
                    $("#signup"). attr("disabled", false);
                    showErrorMessage(response.responseJSON.errors);
                }
            });
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
                $(".response-msg").find("ul").html('');
                $(".response-msg").css('display','block');
                if(response.status==true) {
                    $(".response-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".response-msg").removeClass('alert-danger').addClass('alert-success');
                    location.replace("{{ route('my-profile') }}");
                }
                else {
                    $.each( response.error, function( key, value ) {
                        $(".response-msg").find("ul").append('<li>'+value+'</li>');
                    });
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000);
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
                        swal('Success', 'Profile updated successfully!', 'success');
                        setTimeout(function () {                            
                            location.replace("{{ route('my-profile') }}");
                        }, 3000);
                    }
                    else {
                        showErrorMessage(response.error);
                    }
                }
            });
        });

        //
        $("#invite_group_member_email").email_multiple({
                data: '',
                color:"#343a40",
                textColor:"#000000"

                // reset: true
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
                    showErrorMessage(response.responseJSON.errors);
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
                        showErrorMessage(response.error);
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
                        showErrorMessage(response.error);

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
                    showErrorMessage(response.responseJSON.errors);
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

        //Add Group 
        $('#submitGroup').on('click', function(){
            var form_id = 'groupForm';
            var url = "{{route('groups.store')}}"; 
            var redirectUrl = "{{route('groups.index')}}"; 
            submitForm(form_id, url, redirectUrl)
        });

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

        //Ride Submit Step
        $('.group_past_experience').on('click',function(){
            $('#past_experience_id').val($(this).attr('content'));
            $('#pastExperienceModal').modal('show');
        });

        //Start Added Code For Add More Ride Day
        var i=0;
        $('#add').click(function(){
            var max = $('#first_day').attr('content');
            var end_loc = $('input[name=end_location_'+i+']').val();

            if(end_loc == ''){
                swal('Failed', 'Please enter end location of Day '+(i+parseInt(1)), 'error');
                return false;
            }
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
                    data: {val: i, end_location: end_loc},
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

        //multiselect
       


        //Add More Via Location
        var max_fields_limit = 4;
        var j = 1;
        $('#add_more_via').click(function(e){
            e.preventDefault(); 
            if(j < max_fields_limit){
                j++;
                $('#via_location_more').append('<div class="form-group">'+
                '<input type="text" autocomplete="off" class="form-control" name="via_location[]" class="via_location" placeholder="Via Location">'+
                '<i class="fa fa-minus remove_field"></i></div>');
            } 
        }); 
        $('#via_location_more').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); j--; 
        })


        //Add More Spare Parts
        var max_spare_parts = 8;
        var k = 1;
        $('#more_spare_parts').click(function(e){
            e.preventDefault(); 
            if(k < max_spare_parts){
                k++;
                $('#spare_parts_div').append('<div class="form-group">'+
                '<input type="text" autocomplete="off" class="form-control" name="spare_part_name[]" placeholder="Name">'+
                '<input type="text" autocomplete="off" class="form-control" name="spare_part_number[]" placeholder="Serial Number">'+
                '<input type="file" class="form-control" name="spare_part_image[]"><i class="fa fa-minus-circle review-details remove_field"></i>'+
                '</div>');
            } 
        }); 
        $('#spare_parts_div').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); 
            k--; 
        })


        //Add More Ride Luggage
        var max_fields_limit = 8;
        var m = 1;
        $('#add_more_ride_luggage').click(function(e){
            e.preventDefault(); 
            if(m < max_fields_limit){
                m++;
                $('#ride_luggage_list').append('<div class="form-group">'+
                '<input type="text" autocomplete="off" class="form-control" name="ride_luggage[]" placeholder="Add your point">'+
                '<a href="javascript:void(0)" class="remove_field">Remove</a></div>');
            } 
        }); 
        $('#ride_luggage_list').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); m--; 
        })


        //add more polls options
        var max_options_limit = 5;
        var opt = 1;
        $('.add_more_options').click(function(e){
            e.preventDefault(); 
            if(opt < max_options_limit){
                opt++;
                $('#more_options_list').append('<div class="form-group">'+
                    '<input type="text" autocomplete="off" class="form-control" name="options[]" class="form-control" placeholder="Option">'+
                    '<input type="checkbox" name="right_option[]" value="'+opt+'">Correct'+
                    '<i class="fa fa-minus remove_field"></i></div>');
            } 
        }); 
        $('#more_options_list').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); opt--; 
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
            var ttl = inps.length;
            for (var n = 0; n < ttl; n++) {
                var inp=inps[n];
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
                $(".print-error-msg").removeClass("alert-success").addClass('alert-danger');            
                $(".print-error-msg").find("ul").append('<li>Field is required</li>');
            }
            
            
        })

        //Add Supplier
        $('#submitSupplier').on('click', function(){
            var form_id = 'supplierForm';
            var url = "{{route('suppliers.store')}}"; 
            var redirectUrl = "{{route('suppliers.index')}}"; 
            submitForm(form_id, url, redirectUrl)
        });

        //Add Tips
        $('#submitTip').on('click', function(){
            var form_id = 'tipForm';
            var url = "{{route('tips.store')}}"; 
            var redirectUrl = "{{route('tips.index')}}"; 
            submitForm(form_id, url, redirectUrl)
        });


        //Show feedbackPoll Modal
        $('.view-feedback-poll').on('click', function(){
            var group = $(this).attr('data-content');
            //console.log(group);return false;
            $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
            $.ajax({ 
                url:"{{route('get-group-polls')}}", 
                type: "POST",
                data: {group: group},                
                success: function (response) {
                    $('#feedbackPollModal').modal('show');
                    $('.pollFeedbackQuestions').html(response); 
                }, 
            });            
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

        //search filter
        $("#search-input2").autocomplete({ 
            source: function (request, response) {
                $('#submit-search2').attr('content', request.term);
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

        $('#submit-search2').on('click', function(){
            var search_keyword = $('#search-input2').val();
            var key = $('#submit-search2').attr('content');
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
        var g=0;
        $('.rider-group-join').on('click', function(){

            if(g == 0) { 
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
                            g++;
                            $('#group-join-'+group_id).removeClass('rider-group-join');                       
                            $('#group-join-'+group_id).html('Joined');
                            
                        }         
                    }
                });
            }
        })


        //Rider Follow UP
        var f = 0;
        $('.follow-rider').on('click', function(){

            if(f == 0) {
                var is_user = "{{Auth::user()}}";
                if(!is_user) {
                    $('#loginmodal').modal('show');
                }
                
                var rider_id = $(this).attr('content');
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({
                    url: "{{route('follow-rider')}}",
                    type: "POST",
                    data: {rider_id:rider_id},
                    success: function( response ) {
                        if(response.status==true) {
                            f++;
                            $('#follow_rider_'+rider_id).removeClass('follow-rider');                       
                            $('#follow_rider_'+rider_id).html('Followed');
                        }         
                    }
                });
            }
        })

        //add bike home
         $('.front-bike-add').on('click', function(){
            var is_user = "{{Auth::user()}}";
            if(!is_user) {
                $('#loginmodal').modal('show');
            }
            else {
                location.replace("{{route('add-bike')}}");
            }
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

        $('.remove_record').on('click', function(){
            var url = $(this).attr('data-content');
            var cls = $(this).attr('id');
            deleteRecordSource(url,cls);            
        })

        
    });

    function submitForm(form_id, url, redirect_url) {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($('#'+form_id)[0]),
            processData: false,
            contentType: false,
            cache:false,
            success: function( response ) {
                if(response.status == true) {
                    $(".print-error-msg").find("ul").html('');
                    document.getElementById(form_id).reset();
                    swal('Success', response.msg, 'success');
                    setTimeout(function () {
                        location.replace(redirect_url);
                    }, 3000)
                } else {
                    showErrorMessage(response.error);
                }
            }, error: function(response) {
                
                showErrorMessage(response.responseJSON.errors);
            }
        });
    }

    function showErrorMessage(error,type='') {
        if(type=='') {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 100;
        }
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

    function sendGroupInvitation() {

        var emails = [];
        $('.email-ids').each(function(){
            var email = $(this).text();
            emails.push(email);
        })
        var member = $('#group_member').val();

        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
        $.ajax({
            url: "{{route('invite-group-members')}}",
            type: "POST",
            data: {email: emails, member: member},
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
                showErrorMessage(response.responseJSON.errors);
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
                            swal('Deleted', response.msg, 'success');                            
                            $('.'+cls+'-'+id).remove();                           
                        }         
                    }, error(){
                        swal('Failed', 'Something goes wrong, Please try again', 'error');                        
                    }
                });
            }
        });         
    }


    function deleteRecordSource(url,cls) {
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
                    type: "DELETE",
                    success: function( response ) {
                        if(response.status==true) {
                            swal('Deleted', response.msg, 'success');                            
                            $('.'+cls).remove();                           
                        }         
                    }, error(){
                        swal('Failed', 'Something goes wrong, Please try again', 'error');                        
                    }
                });
            }
        });         
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
                    var img = "http://localhost/gull-html-laravel/public/images/bike_models/"+response.image;
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
                        swal('Success', response.msg, 'success');
                        setTimeout(function () {                            
                            location.replace("{{ route('rides') }}");
                        }, 3000);                        
                    }
                    else {
                        swal('Failed', response.msg, 'error');
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
                        swal('Success', response.msg, 'success');
                        setTimeout(function () {                            
                            location.replace(response.redirect);
                        }, 3000);                        
                    }
                    else {
                        swal('Failed', response.msg, 'error');
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
                        swal('Success', response.msg, 'success');
                        setTimeout(function () {                            
                            location.replace("{{ route('bikes') }}");
                        }, 3000)
                    }
                    else {
                        swal('Failed', response.msg, 'error');
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
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
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

    //save poll
    function savePoll(){
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('polls.store')}}",
            type: "POST",
            data: $('#pollForm').serialize(),
            success: function( response ) {                
                var redirectUrl = "{{route('polls.index')}}";
                showSuccessMessage(response.msg,'pollForm','pollModal',redirectUrl);        
            }, error: function(response){
                showErrorMessage(response.responseJSON.errors);
            }
        });
    }

    function savePastExperience() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('group.experience.save')}}",
            type: "POST",
            data: $('#pastExperienceForm').serialize(),
            success: function( response ) {
                if(response.status == true) {                   
                    showSuccessMessage(response.msg,'pastExperienceForm','pastExperienceModal')
                } else {
                    showErrorMessage(response.error, 'modal');
                }
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
        var model_image = "http://localhost/gull-html-laravel/public/images/bike_models/"+img;

        if(img==undefined){
            model_image = "http://localhost/throttle/public/images/rider/bikes/not_found.jpg";
        }
        
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
                showErrorMessage(response.responseJSON.errors);
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
                showErrorMessage(response.responseJSON.errors);
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
                showErrorMessage(response.responseJSON.errors);
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
                showErrorMessage(response.responseJSON.errors);
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
        var model_image = "http://localhost/gull-html-laravel/public/images/bike_models/"+img;
        if(img==undefined){
            model_image = "http://localhost/throttle/public/images/rider/bikes/not_found.jpg";
        }
        $('#bikeListModal').modal('hide');
        $('#bike-icon').hide();
        $('#selected_bike').attr('src', model_image);
        $('.selected_bike').show();
    }


    function shareContact(group_id){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('group_member-list')}}",
            type: "POST",
            data: {group_id:group_id},
            success: function( response ) {
                if(response.status == false){
                    swal('Failed', response.msg, 'error');
                }
                else{
                    $('#shareContactModal').modal('show');                   
                    $('#group_members').html(response.html);
                    $('#group_members').multiselect({
                        columns: 1,
                        placeholder: 'Select Group Members',
                        search: true,
                        searchOptions: {
                            'default': 'Search Group Members'
                        },
                        selectAll: true,
                    });
                }   
            }
        });
    }

    function sendContact() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('send-contact-detail')}}",
            type: "POST",
            data: $('#shareContactForm').serialize(),
            success: function( response ) {
                if(response.status==true) {
                    $('#group_members').multiselect('reset');
                    showSuccessMessage(response.msg,'shareContactForm','shareContactModal');
                }
                else{
                    showErrorMessage([response.msg],'modal');
                }
            }
        });
    }

    function showSuccessMessage(message,form_id,modal_id,redirectUrl=''){
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');                 
        $(".print-error-msg").find("ul").append('<li>'+message+'</li>');
        $(".print-error-msg").addClass("alert-success").removeClass('alert-danger');                    
        setTimeout(function () {
            if ($(".alert").is(":visible")){
                $(".alert").fadeOut("fast");
            }
            document.getElementById(form_id).reset();            
            $('#'+modal_id).modal('hide');
            if(redirectUrl!=''){
                location.replace(redirectUrl);
            }

        }, 3000);
    }

    function saveRiderFeedback(){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('save-rider-polls-feedback')}}",
            type: "POST",
            data: $('#pollFeedbackForm').serialize(),
            success: function( response ) {
                if(response.status==true) {                   
                    showSuccessMessage(response.msg,'pollFeedbackForm','feedbackPollModal');
                    $('.view-feedback-poll').remove();
                }
            }
        });
    }
</script>