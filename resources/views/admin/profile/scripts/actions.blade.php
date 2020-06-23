<script>
    $('#dpa-agree').click(function(){
        console.log($('#dpa-agree:checked'));
        if($('#dpa-agree:checked').length > 0){
            var date = new Date();
            date = date.getDate() + "/"
                    + (date.getMonth()+1)  + "/" 
                    + date.getFullYear() + " - "  
                    + date.getHours() + ":"  
                    + date.getMinutes() + ":" 
                    + date.getSeconds();
            $('#dpa-agree-date').text('Agreed date: '+date);
            $('#dpa-agreement-date').val(date);
        } else {
            $('#dpa-agree-date').text('');
            $('#dpa-agreement-date').val('');
        }  
    })

    $(document).on('click','#edit-profile-tab', function(e){
        e.preventDefault();
        $('#edit-profile-tab').attr('data-status','show');
        let profileId = $('#edit-profile-tab').attr('data-id');
        let routeUrl = "{{ route('profile.edit','id') }}";
        let editUrl = routeUrl.replace('id', profileId);
        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#editProfileForm').attr('data-id',data.id);
                $('#editProfileForm').attr('data-course',data.course);
                $('#editProfileForm').attr('data-year-level',data.year_level);
                
                $('.first-name-label').append('<span class="ptxt">First Name</span>');
                $('.middle-name-label').append('<span class="ptxt">Middle Name</span>');
                $('.last-name-label').append('<span class="ptxt">Last Name</span>');
                $('.contact-label').append('<span class="ptxt">Contact</span>');
                $('.religion-label').append('<span class="ptxt">Religion</span>');
                $('.purok-label').append('<span class="ptxt">Purok</span>');
                $('.sitio-label').append('<span class="ptxt">Sitio</span>');
                $('.barangay-label').append('<span class="ptxt">Barangay</span>');
                $('.municipality-label').append('<span class="ptxt">Municipality</span>');
                $('.province-label').append('<span class="ptxt">Province</span>');
                $('.zipcode-label').append('<span class="ptxt">Zipcode</span>');
                $('.emergency-contact-label').append('<span class="ptxt">Emergency Contact</span>');
                $('.school-graduated-label').append('<span class="ptxt">School Graduated</span>');
                $('.school-address-label').append('<span class="ptxt">School Address</span>');
                $('.year-graduated-label').append('<span class="ptxt">Year Graduated</span>');
                $('.lrn-label').append('<span class="ptxt">LRN</span>');
                $('.gwa-label').append('<span class="ptxt">GWA</span>');

                $('#first-name').val(data.first_name);
                $('#middle-name').val(data.middle_name);
                $('#last-name').val(data.last_name);
                

                let selectedGender = data.gender;
                $('select#gender option').each(function(){
                    if($(this).val() == selectedGender){
                        $(this).attr('selected','selected');
                    }
                });

                let selectedCivilStat = data.civil_status;
                $('select#civil-status option').each(function(){
                    if($(this).val() == selectedCivilStat){
                        $(this).attr('selected','selected');
                    }
                });

                $('#contact_number').val(data.contact_number);
                $('#religion').val(data.religion);

                $('#lrn').val(data.lrn);

                $('#purok').val(data.purok);
                $('#sitio').val(data.sitio);
                $('#street-barangay').val(data.barangay);
                $('#municipality').val(data.municipality);
                $('#province').val(data.province);
                $('#zip-code').val(data.zipcode);

                $('#emergency-contact-name').val(data.emergency_contact_name);
                $('#emergency-contact-number').val(data.emergency_contact_number);

                $('#school-graduated').val(data.school_graduated);
                $('#year-graduated').val(data.year_graduated);
                $('#school-address').val(data.school_address);

                let profileImg = data.profile_pic == 'No Data' ? 'empty-profile-img.png' : data.profile_pic;
                let profileUrl = '{{ asset("storage/uploads/applicant-img") }}'+'/'+profileImg;
                initDropify('#profile-pic',profileUrl);
                
                let medCertImg = data.documents[0].med_cert == 'No Data' ? 'no-document-uploaded.jpg' : data.documents[0].med_cert;
                let medCertUrl = '{{ asset("storage/uploads/med-cert") }}'+'/'+medCertImg;
                initDropify('#med-cert',medCertUrl);

                let gmctImg = data.documents[0].good_moral == 'No Data' ? 'no-document-uploaded.jpg' : data.documents[0].good_moral;
                let gmcUrl = '{{ asset("storage/uploads/gmc") }}'+'/'+gmctImg;
                initDropify('#gmc',gmcUrl);

                let psaBcImg = data.documents[0].psa_birth_cert == 'No Data' ? 'no-document-uploaded.jpg' : data.documents[0].psa_birth_cert;
                let psaBcUrl = '{{ asset("storage/uploads/psa-bc") }}'+'/'+psaBcImg;
                initDropify('#psa-bc',psaBcUrl);

                let sf9FImg = data.documents[0].report_card_front == 'No Data' ? 'no-document-uploaded.jpg' : data.documents[0].report_card_front;
                let sf9FUrl = '{{ asset("storage/uploads/sf9-front") }}'+'/'+sf9FImg;
                initDropify('#sf9-f',sf9FUrl);

                let sf9BImg = data.documents[0].report_card_back == 'No Data' ? 'no-document-uploaded.jpg' : data.documents[0].report_card_back;
                let sf9BUrl = '{{ asset("storage/uploads/sf9-back") }}'+'/'+sf9BImg;
                initDropify('#sf9-b',sf9BUrl);

                let honDImg = data.documents[0].honorable_dismissal == 'No Data' ? 'no-document-uploaded.jpg' : data.documents[0].honorable_dismissal;
                let honDUrl = '{{ asset("storage/uploads/hd") }}'+'/'+honDImg;
                initDropify('#hon-d',honDUrl);

                $('#dpa-agree-date').text('Agreed date: '+data.dpa_agreement);
                $('#dpa-agreement-date').val(data.dpa_agreement);

                $('.nav-tabs a[href="#edit-profile"]').tab('show');
            }
        })
    })

    $(document).on('submit','#editProfileForm',function(e){
        e.preventDefault();
        
        let profileId = $('#editProfileForm').attr('data-id');
        let form = $('#editProfileForm')[0];
        let formData = new FormData(form);
        formData.append('profile-id',profileId);
        formData.append('_method','PUT');
        formData.append('course',$('#editProfileForm').attr('data-course'));
        formData.append('year_level',$('#editProfileForm').attr('data-year-level'));

        let routeUrl = "{{ route('profile.update','id') }}";
        let updateUrl = routeUrl.replace('id', profileId);

        $.ajax({
            url: updateUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                Swal.fire({
                    icon: 'success',
                    text: 'Profile Updated!!'
                }).then(function(){
                    let route = "{{ route('profile.show','id') }}";
                    let profileRoute = route.replace('id', data.id);
                    window.location.href = profileRoute;
                });
            },
            error: function(err){
                console.log(err.responseJSON);
                // let error_html = '<ul class="text-left">';
                let error_html = '';
                if(err.responseJSON == 'Profile Pic is required'){
                    alertify.error(err.responseJSON);
                } else {
                    $.each(err.responseJSON, function(key, response){
                        $.each(response, function(key, value){
                            error_html += '<p class="text-left">'+value+'</p>';
                            // if(value == err.responseJSON.length){
                            //     error_html += '</ul>'
                            // }
                            alertify.error(error_html);
                        })
                    }) 
                }

                
            }
        });
        
    })

    function initDropify(element, image){
        let dropify = $(element).dropify({
            defaultFile: image
        });
        dropifyEvent = dropify.data('dropify');
        dropifyEvent.resetPreview();
        dropifyEvent.clearElement();
        dropifyEvent.settings.defaultFile = image;
        dropifyEvent.destroy();
        dropifyEvent.init();
    }

    $(document).on('submit','#resetPassForm', function(e){
        e.preventDefault();
        let form = $('#resetPassForm')[0];
        let formData = new FormData(form);
        
        let routeUrl = "{{ route('reset.password') }}";

        $.ajax({
            url: routeUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },            
            success: function(data){
                Swal.fire({
                    icon: 'success',
                    text: 'Password Successfully Changed!'
                }).then(function(){
                    window.location.href = "{{ route('dashboard') }}";
                });
            },
            error: function(err){
                console.log(err);
                Swal.fire({
                    icon: 'error',
                    text: err.responseJSON
                })
            }
        })
    })
</script>