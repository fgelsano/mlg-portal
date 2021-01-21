<script>
    // Initialize Dropify
    $('.dropify').dropify();
    // Input Mask
    document.addEventListener('DOMContentLoaded', () => {
        for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
            const pattern = el.getAttribute("placeholder"),
                slots = new Set(el.dataset.slots || "_"),
                prev = (j => Array.from(pattern, (c,i) => slots.has(c)? j=i+1: j))(0),
                first = [...pattern].findIndex(c => slots.has(c)),
                accept = new RegExp(el.dataset.accept || "\\d", "g"),
                clean = input => {
                    input = input.match(accept) || [];
                    return Array.from(pattern, c =>
                        input[0] === c || slots.has(c) ? input.shift() || c : c
                    );
                },
                format = () => {
                    const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                        i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                        return i<0? prev[prev.length-1]: back? prev[i-1] || first: i;
                    });
                    el.value = clean(el.value).join``;
                    el.setSelectionRange(i, j);
                    back = false;
                };
            let back = false;
            el.addEventListener("keydown", (e) => back = e.key === "Backspace");
            el.addEventListener("input", format);
            el.addEventListener("focus", format);
            el.addEventListener("blur", () => el.value === pattern && (el.value=""));
        }
    });
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

    $(document).on('click', '.editProfile', function(e){
        e.preventDefault();
        let id = $(this).attr('data-id');
        let routeUrl = "{{ route('profiles.edit','id') }}";
        let editUrl = routeUrl.replace('id', id);
        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#editProfileForm').attr('data-id',data.profile.id);
                clearLabels();
                fillLabels();
                $.each(data.courses,function(key,value){
                    let selected = data.profile.course == value.id ? " checked" : "";
                    
                    let course = '<div class="form-check course-iteration">'+
                                    '<input class="form-check-input" type="radio" name="course" id="radio-'+value.code+'" value="'+value.id+'" '+selected+'>'+
                                    '<label class="form-check-label" for="radio-'+value.code+'">'+
                                        value.name + ' ('+value.code+')'+
                                    '</label>'+
                                '</div>';
                    $('#course').append(course);
                })
                for(let x = 1; x <= 4; x++){
                    let year = '';
                    if(x == 1){
                        year = 'First Year';
                    }else if(x == 2){
                        year = 'Second Year';
                    }else if(x == 3){
                        year = 'Third Year';
                    }else if(x == 4){
                        year = 'Fourth YEar';
                    }
                    let selected = data.profile.year_level == x ? " checked" : "";
                    let yearLevel = '<div class="form-check year-iteration">'+
                                        '<input class="form-check-input" type="radio" name="year-level" id="radio-'+x+'" value="'+x+'" '+selected+'>'+
                                        '<label class="form-check-label" for="radio-'+x+'">'+
                                            year+
                                        '</label>'+
                                    '</div>';
                    $('#year-level').append(yearLevel);
                }
                $('#school-id').val(data.profile.school_id);
                $('#first-name').val(data.profile.first_name);
                $('#middle-name').val(data.profile.middle_name);
                $('#last-name').val(data.profile.last_name);
                
                let selectedGender = data.profile.gender;
                $('select#gender option').each(function(){
                    if($(this).val() == selectedGender){
                        $(this).attr('selected','selected');
                    }
                });

                let selectedCivilStat = data.profile.civil_status;
                $('select#civil-status option').each(function(){
                    if($(this).val() == selectedCivilStat){
                        $(this).attr('selected','selected');
                    }
                });

                $('#contact_number').val(data.profile.contact_number);
                $('#religion').val(data.profile.religion);

                $('#lrn').val(data.profile.lrn);

                $('#purok').val(data.profile.purok);
                $('#sitio').val(data.profile.sitio);
                $('#street-barangay').val(data.profile.barangay);
                $('#municipality').val(data.profile.municipality);
                $('#province').val(data.profile.province);
                $('#zip-code').val(data.profile.zipcode);

                $('#emergency-contact-name').val(data.profile.emergency_contact_name);
                $('#emergency-contact-number').val(data.profile.emergency_contact_number);

                $('#school-graduated').val(data.profile.school_graduated);
                $('#year-graduated').val(data.profile.year_graduated);
                $('#school-address').val(data.profile.school_address);

                let profileImg = data.profile.profile_pic == 'No Data' ? 'empty-profile-img.png' : data.profile.profile_pic;
                let profileUrl = '{{ asset("storage/uploads/applicant-img") }}'+'/'+profileImg;
                initDropify('#profile-pic',profileUrl);
                
                if(data.profile.documents[0] != null){
                    $('#uploaded-documents').removeClass('d-none');
                    let medCertImg = data.profile.documents[0].med_cert == 'No Data' ? 'no-document-uploaded.jpg' : data.profile.documents[0].med_cert;
                    let medCertUrl = '{{ asset("storage/uploads/med-cert") }}'+'/'+medCertImg;
                    initDropify('#med-cert',medCertUrl);

                    let gmctImg = data.profile.documents[0].good_moral == 'No Data' ? 'no-document-uploaded.jpg' : data.profile.documents[0].good_moral;
                    let gmcUrl = '{{ asset("storage/uploads/gmc") }}'+'/'+gmctImg;
                    initDropify('#gmc',gmcUrl);

                    let psaBcImg = data.profile.documents[0].psa_birth_cert == 'No Data' ? 'no-document-uploaded.jpg' : data.profile.documents[0].psa_birth_cert;
                    let psaBcUrl = '{{ asset("storage/uploads/psa-bc") }}'+'/'+psaBcImg;
                    initDropify('#psa-bc',psaBcUrl);

                    let sf9FImg = data.profile.documents[0].report_card_front == 'No Data' ? 'no-document-uploaded.jpg' : data.profile.documents[0].report_card_front;
                    let sf9FUrl = '{{ asset("storage/uploads/sf9-front") }}'+'/'+sf9FImg;
                    initDropify('#sf9-f',sf9FUrl);

                    let sf9BImg = data.profile.documents[0].report_card_back == 'No Data' ? 'no-document-uploaded.jpg' : data.profile.documents[0].report_card_back;
                    let sf9BUrl = '{{ asset("storage/uploads/sf9-back") }}'+'/'+sf9BImg;
                    initDropify('#sf9-b',sf9BUrl);

                    let honDImg = data.profile.documents[0].honorable_dismissal == 'No Data' ? 'no-document-uploaded.jpg' : data.profile.documents[0].honorable_dismissal;
                    let honDUrl = '{{ asset("storage/uploads/hd") }}'+'/'+honDImg;
                    initDropify('#hon-d',honDUrl);
                }

                $('#profile-modal').modal('show');
            }
        })
    })

    $(document).on('submit','#editProfileForm',function(e){
        e.preventDefault();
        
        let profileId = $('#editProfileForm').attr('data-id');
        let form = $('#editProfileForm')[0];
        let formData = new FormData(form);
        formData.append('_method','PUT');

        let routeUrl = "{{ route('profiles.update','id') }}";
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
                    text: 'Profile Updated!'
                }).then(function(){
                    $('#profile-modal').modal('hide');
                    $('#profiles').DataTable().ajax.reload();
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

    function clearLabels(){
        $('span').remove('.ptxt');
        $('.form-check').remove('.course-iteration');
        $('.form-check').remove('.year-iteration');
    }
    function fillLabels(){
        $('.school-id-label').append('<span class="ptxt">School Id</span>');
        $('.first-name-label').append('<span class="ptxt">First Name</span>');
        $('.middle-name-label').append('<span class="ptxt">Middle Name</span>');
        $('.last-name-label').append('<span class="ptxt">Last Name</span>');
        $('.civil-status').append('<span class="ptxt">Civil Status</span>');
        $('.gender').append('<span class="ptxt">Gender</span>');
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
    }
</script>