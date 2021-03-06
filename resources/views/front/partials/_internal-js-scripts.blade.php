<script>
    let studentType = 'new';
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

    $(document).on('click','.studentDetail', function(){
        let id = $(this).attr('data-id');
        let routeUrl = "{{ route('admissionRequest.check','id') }}";
        let fetchUrl = routeUrl.replace('id', id);
        $.ajax({
            url: fetchUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                let courses = '';
                let id = data.profile.id;
                $.each(data.courses,function(key,value){
                    courses += '<div class="form-check" style="padding-left: 0rem; text-align: left"><input class="form-check-input course" type="radio" name="course" value="'+value.id+'" style="margin: 0 10px 0 0; display: inline; height: 20px; width: auto;"><label class="form-check-label" for="course" style="position: relative; left: 20px">'+value.code+'</label></div>'
                    // courses.push(value.id+':'+value.name)
                })
                let year = [
                    '<div class="form-check" style="padding-left: 0rem; text-align: left"><input class="form-check-input year" type="radio" name="year" value="1" style="margin: 0 10px 0 0; display: inline; height: 20px; width: auto;"><label class="form-check-label" for="year" style="position: relative; left: 20px">First Year</label></div>'+
                    '<div class="form-check" style="padding-left: 0rem; text-align: left"><input class="form-check-input year" type="radio" name="year" value="2" style="margin: 0 10px 0 0; display: inline; height: 20px; width: auto;"><label class="form-check-label" for="year" style="position: relative; left: 20px">Second Year</label></div>'+
                    '<div class="form-check" style="padding-left: 0rem; text-align: left"><input class="form-check-input year" type="radio" name="year" value="3" style="margin: 0 10px 0 0; display: inline; height: 20px; width: auto;"><label class="form-check-label" for="year" style="position: relative; left: 20px">Third Year</label></div>'+
                    '<div class="form-check" style="padding-left: 0rem; text-align: left"><input class="form-check-input year" type="radio" name="year" value="4" style="margin: 0 10px 0 0; display: inline; height: 20px; width: auto;"><label class="form-check-label" for="year" style="position: relative; left: 20px">Fourth Year</label></div>'
                ]
                Swal.fire({
                    title: 'May we know what course you would like to enroll this time?',
                    icon: 'question',
                    html:
                        '<form id="admitOldStudent">'+
                            '@csrf'+
                            '<div class="row">'+
                                '<div class="col-12 col-md-6 px-5 mb-3"><div class="alert alert-primary mb-0">Course</div>'+courses+'</div>'+
                                '<div class="col-12 col-md-6 px-5"><div class="alert alert-primary mb-0">Year Level</div>'+year+'</div>'+
                            '</div>'+
                            '@method("PUT")'+
                        '</form>',                        
                    inputAttributes: {
                        autocapitalize: 'on'
                    }
                }).then((result) => {
                    if(result.value){
                        let form = $('#admitOldStudent')[0];
                        let formData = new FormData(form);

                        let profileId = id;

                        let routeUrl = "{{ route('old-student.admit','id') }}";
                        let fetchUrl = routeUrl.replace('id', profileId);
                        $.ajax({
                            url: fetchUrl,
                            type: 'POST',
                            contentType: false,
                            processData: false,    
                            data: formData,
                            dataType: 'json',
                            success: function(data){
                                console.log(data);
                                window.location = '/admission-confirmation/'+data.id;
                            },
                            error: function(data){}
                        })
                    }
                })
            },
            error: function(error){
                Swal.fire({
                    title: 'Duplicate Admission Request',
                    icon: 'error',
                    text: error.responseJSON.error,
                    footer: '<p class="text-center">You have already requested for admission and it is now under evaluation by the registrar. Please wait for the registrar to process your request.</p>'
                })
            }
        })

        // $('#consent-block').fadeOut();
        // $('#admission').animate();
        // $('#admission').addClass('d-block');
        // $('#admission').removeClass('d-none');
        // $('#first-name').val($(this).attr('data-fname'));
        // $('#middle-name').val($(this).attr('data-mname'));
        // $('#last-name').val($(this).attr('data-lname'));
        // $('#student-type').val('old');
        // $('#profile-id').val($(this).attr('data-id'));
        // $('#file-uploads-panel').remove();
        // $('#file-upload-btn').remove();
        // let firstName = $(this).attr('data-fname');
        // studentType = 'old';
        // Swal.close();
        // Swal.fire(
        //     'Welcome Back '+firstName+'!',
        //     'Please fill-out the form below.',
        //     'success'
        // )
        // openCam();
    })
    // Consent Button
    $('#consent-btn').click(function(){
        const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Student Type',
                text: "Please let us know if you're a NEW or OLD student.",
                icon: 'question',
                confirmButtonText: 'New Student',
                cancelButtonText: 'Old Student',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#consent-block').fadeOut();
                    $('#admission').animate();
                    $('#admission').addClass('d-block');
                    $('#admission').removeClass('d-none');
                    $('#profile-pic').attr('src','/admin/img/empty-profile-img.png');
                    $('#profile-pic').attr('data-imng','empty');
                    studentType = 'new';
                    swalWithBootstrapButtons.fire(
                        'Thanks for enrolling at MLGCL!',
                        'Please fill-out the form below.',
                        'success'
                    )
                    openCam();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'May we know your name?',
                        icon: 'question',
                        html:
                            '<input id="lastName" class="form-control my-3" placeholder="Last Name">' +
                            '<input id="firstName" class="form-control my-3" placeholder="First Name">',
                        inputAttributes: {
                            autocapitalize: 'on'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Look up',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            let name = $('#lastName').val() + ',' + $('#firstName').val();
                            let routeUrl = "{{ route('oldStudent.fetch','name') }}";
                            let fetchUrl = routeUrl.replace('name', name);
                            $.ajax({
                                url: fetchUrl,
                                type: 'GET',
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(data){   
                                    let student = '';
                                    let courses = data.courses;
                                    
                                    if(data.profiles.length == 1) {
                                        let studentCourse = '';
                                        $.each(courses, function(key, course){
                                            if(course.id == data.profiles[0].course ){
                                                studentCourse = course.code;
                                            }
                                        })
                                        student = '<div class="row mt-3 py-3 mx-3 studentDetail border" data-id="'+data.profiles[0].id+'" data-fname="'+data.profiles[0].first_name+'" data-lname="'+data.profiles[0].last_name+'" data-mname="'+data.profiles[0].middle_name+'" data-course="'+studentCourse+'"">'+
                                                        '<div class="col-12 text-left">'+
                                                            '<p class="text-left text-lead mb-0">Id Number: <strong class="float-right">'+data.profiles[0].school_id+'</strong></p>' +
                                                            '<p class="text-left text-lead my-0">First Name: <strong class="float-right">'+data.profiles[0].first_name+'</strong></p>' +
                                                            '<p class="text-left text-lead my-0">Middle Name: <strong class="float-right">'+data.profiles[0].middle_name+'</strong></p>' +
                                                            '<p class="text-left text-lead my-0">Last Name: <strong class="float-right">'+data.profiles[0].last_name+'</strong></p>' +
                                                            '<p class="text-left text-lead my-0">Course: <strong class="float-right">'+studentCourse+'</strong></p>'+
                                                        '</div>'+
                                                    '</div>';
                                    } else if(data.profiles.length > 1){
                                        $.each(data.profiles, function(key,profile){
                                                let studentCourse = '';
                                                $.each(courses, function(key, course){
                                                    if(course.id == profile.course ){
                                                        studentCourse = course.code;
                                                    }
                                                })
                                                student = student + '<div class="row mt-3 py-3 mx-3 studentDetail border" data-id="'+profile.id+'" data-fname="'+profile.first_name+'" data-lname="'+profile.last_name+'" data-mname="'+profile.middle_name+'" data-course="'+studentCourse+'"">'+
                                                                        '<div class="col-12 text-left">'+
                                                                            '<p class="text-left text-lead mb-0">Id Number: <strong class="float-right">'+profile.school_id+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">First Name: <strong class="float-right">'+profile.first_name+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">Middle Name: <strong class="float-right">'+profile.middle_name+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">Last Name: <strong class="float-right">'+profile.last_name+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">Course: <strong class="float-right">'+studentCourse+'</strong></p>'+
                                                                        '</div>'+
                                                                    '</div>';
                                        })
                                        $('.swal2-confirm').hide();
                                    }  
                                    
                                    if(data.profiles.length == 0){
                                        Swal.fire({
                                            title: 'Sorry, no record found!',
                                            icon: 'error'
                                        })
                                    } else  {
                                        Swal.fire({
                                            icon: 'question',
                                            title: 'See your name below? \nPlease click it!',
                                            html: student,
                                            showCancelButton: true,
                                            confirmButtonText: 'Yes, that\'s me!',
                                            cancelButtonText: 'No, that\'s not me!',
                                        }).then((result) => {
                                            if (result.value) {
                                                $('.studentDetail').click();
                                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                                Swal.fire({
                                                    title: 'Try Again using your Id number!',
                                                    icon: 'info',
                                                    html:
                                                        '<input id="id_number" class="form-control my-3" placeholder="Enter your Id number">',
                                                    inputAttributes: {
                                                        autocapitalize: 'off'
                                                    },
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Look up',
                                                    showLoaderOnConfirm: true,
                                                    preConfirm: () => {
                                                        let id = 'id,'+$('#id_number').val();
                                                        
                                                        let routeUrl = "{{ route('oldStudent.fetch','name') }}";
                                                        let fetchUrl = routeUrl.replace('name', id);
                                                        $.ajax({
                                                            url: fetchUrl,
                                                            type: 'GET',
                                                            contentType: false,
                                                            processData: false,
                                                            dataType: 'json',
                                                            success: function(data){
                                                                Swal.fire({
                                                                    icon: 'question',
                                                                    title: 'Is this correct?',
                                                                    html: 
                                                                    '<div class="row mt-3 py-3 mx-3 studentDetail border" data-id="'+data.profiles[0].id+'" data-fname="'+data.profiles[0].first_name+'" data-lname="'+data.profiles[0].last_name+'" data-mname="'+data.profiles[0].middle_name+'" data-course=""">'+
                                                                        '<div class="col-12 text-left">'+
                                                                            '<p class="text-left text-lead mb-0">Id Number: <strong class="float-right">'+data.profiles[0].school_id+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">First Name: <strong class="float-right">'+data.profiles[0].first_name+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">Middle Name: <strong class="float-right">'+data.profiles[0].middle_name+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">Last Name: <strong class="float-right">'+data.profiles[0].last_name+'</strong></p>' +
                                                                            '<p class="text-left text-lead my-0">Course: <strong class="float-right">'+data.profiles[0].course+'</strong></p>'+
                                                                        '</div>'+
                                                                    '</div>',
                                                                    showCancelButton: true,
                                                                    confirmButtonText: 'Yes, that\'s me!',
                                                                    cancelButtonText: 'No, that\'s not me!',
                                                                }).then((result) => {
                                                                    if (result.value) {
                                                                        $('.studentDetail').click();
                                                                    } else {
                                                                        swalWithBootstrapButtons.fire(
                                                                            'Sorry we can\'t find your student details',
                                                                            'Please try searching again or you may register as NEW STUDENT instead.',
                                                                            'info'
                                                                        )
                                                                    }
                                                                });
                                                            },
                                                            error: function(error){
                                                                if(Object.keys(error.responseJSON).length > 1){
                                                                    $.each(error.responseJSON,function(key,value){
                                                                        if(key === 'noGrade' || key === 'notCleared'){
                                                                            let notClearedSubject = '<div class="not-cleared"><p class="bg-warning text-white text-left p-2 mb-0">Not Cleared Subjects:</p>';
                                                                            let noGradeSubject = '<div class="not-cleared"><p class="bg-danger text-white text-left p-2 mb-0">No Grades Yet:</p>';
                                                                            console.log(notClearedSubject);
                                                                            $.each(error.responseJSON.notCleared,function(key,value){
                                                                                $.each(value,function(key,value){
                                                                                    notClearedSubject += '<li class="m-0 text-left">'+key+' ('+value+')</li>';
                                                                                })
                                                                            })
                                                                            $.each(error.responseJSON.noGrade,function(key,value){
                                                                                $.each(value,function(key,value){
                                                                                    noGradeSubject += '<li class="m-0 text-left">'+key+' ('+value+')</li>';
                                                                                })
                                                                            })
                                                                            console.log(notClearedSubject);
                                                                            Swal.fire({
                                                                                title: 'We Encountered Issues',
                                                                                icon: 'error',
                                                                                backdrop: 'rgba(255,0,0,0.3)',
                                                                                html: notClearedSubject + '</div>' + noGradeSubject + '</div>',
                                                                                footer: '<p class="text-danger">Please coordinate with your instructors to resolve the issues.</p>'
                                                                            })
                                                                        } else {
                                                                            Swal.fire({
                                                                                title: error.responseJSON,
                                                                                icon: 'error'
                                                                            })
                                                                        }
                                                                    })
                                                                } else {
                                                                    Swal.fire({
                                                                        title: 'Invalid Request',
                                                                        icon: 'error',
                                                                        text: error.responseJSON.error
                                                                    })
                                                                }
                                                            }
                                                        })
                                                    }
                                                });
                                            }
                                        });
                                    }
                                    
                                },
                                error: function(error){
                                    if(Object.keys(error.responseJSON).length > 1){
                                        $.each(error.responseJSON,function(key,value){
                                            if(key === 'noGrade' || key === 'notCleared'){
                                                let notClearedSubject = '<div class="not-cleared"><p class="bg-warning text-white text-left p-2 mb-0">Not Cleared Subjects:</p>';
                                                let noGradeSubject = '<div class="not-cleared"><p class="bg-danger text-white text-left p-2 mb-0">No Grades Yet:</p>';
                                                console.log(notClearedSubject);
                                                $.each(error.responseJSON.notCleared,function(key,value){
                                                    $.each(value,function(key,value){
                                                        notClearedSubject += '<li class="m-0 text-left">'+key+' ('+value+')</li>';
                                                    })
                                                })
                                                $.each(error.responseJSON.noGrade,function(key,value){
                                                    $.each(value,function(key,value){
                                                        noGradeSubject += '<li class="m-0 text-left">'+key+' ('+value+')</li>';
                                                    })
                                                })
                                                console.log(notClearedSubject);
                                                Swal.fire({
                                                    title: 'We Encountered Issues',
                                                    icon: 'error',
                                                    backdrop: 'rgba(255,0,0,0.3)',
                                                    html: notClearedSubject + '</div>' + noGradeSubject + '</div>',
                                                    footer: '<p class="text-danger">Please coordinate with your instructors to resolve the issues.</p>'
                                                })
                                            } else {
                                                Swal.fire({
                                                    title: error.responseJSON,
                                                    icon: 'error'
                                                })
                                            }
                                        })
                                    } else {
                                        Swal.fire({
                                            title: 'Invalid Request',
                                            icon: 'error',
                                            text: error.responseJSON.error
                                        })
                                    }                                    
                                }
                        })
                    },
                    
                }
            )}
        })
    });

    $('#dpa-agree').click(function(){
        var date = new Date();
        date = date.getDate() + "/"
                + (date.getMonth()+1)  + "/" 
                + date.getFullYear() + " - "  
                + date.getHours() + ":"  
                + date.getMinutes() + ":" 
                + date.getSeconds();
        $('#dpa-agree-date').text('Agreed date: '+date);
        $('#dpa-agreement-date').val(date);        
    })
    $('#dpa-agree-modal').click(function(){
        var date = new Date();
        date = date.getDate() + "/"
                + (date.getMonth()+1)  + "/" 
                + date.getFullYear() + " - "  
                + date.getHours() + ":"  
                + date.getMinutes() + ":" 
                + date.getSeconds();
        $('#dpa-agree-date-modal').text('Agreed date: '+date);
        $('#dpa-agreement-date-modal').val(date);        
    })

    // onBlur Last Name
    $('#last-name').blur(function(){
        let filled = true;
        if($('#first-name').val() == ''){
            filled = false;
        }
        if($('#last-name').val() == ''){
            filled = false;
        }
        
        if(filled == true){
            let name = $('#last-name').val() + ',' + $('#first-name').val();
            let routeUrl = "{{ route('oldStudent.fetch','name') }}";
            let fetchUrl = routeUrl.replace('name', name);
            $.ajax({
                url: fetchUrl,
                type: 'GET',
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    if(data.profiles.length > 0){
                        $('#consent-block').fadeIn();
                        $('#admission').addClass('d-none');
                        $('#admission').removeClass('d-block');
                        $('#admission-form')[0].reset();
                        
                        Swal.fire({
                            title: 'That name is already in the system! Please select \n"Old Student"',
                            icon: 'error',
                        })
                    }
                }
            });
        }
    })

    // Read URL Function
    function readUrl(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = (e) => {
                let imgData = e.target.result;
                let imgName = input.files[0].name;
                input.setAttribute("data-title", imgName);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Webcam
    function openCam(){
        $('#selfieModal').modal('show');
        camPrompt();
        Webcam.set({
            width: 470,
            height: 390,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
    
        Webcam.attach( '#camera' );
    };

    function camPrompt(){
        Swal.fire({
            title: 'Selfie Reminder',
            text: 'Please make sure to wear a proper outfit and choose a good background before taking a selfie. \nYour selfie will be recorded in our system and will be evaluated by the registrar. \nMake sure your face is clear and well lit up. \nUncentered and unclear selfies could cause the registrar to reject your admission request.',
            icon: 'info',
            confirmButtonText: 'Cool'
        })
    }

    // Capture Selfie
    function takeSnapshot() {
        Webcam.snap( function(data_uri) {
            $("#applicant-img").val(data_uri);
            $('#profile-pic').attr('src', data_uri);
            $('#profile-pic').attr('data-img','captured');
            $('.overlay').hide();
        });
        
        $('#selfieModal').modal('hide');
        Webcam.reset();
    }

    // Convert data_uri to actual file
    function dataURItoFile(dataURI, fileName) {
        let arr = dataURI.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], fileName, {type:mime});
    }

    // Print
    function printAdmission(){
        alert('IMPORTANT REMINDER!\n Enable the "Background Graphics" option first before printing.\n This will allow the images to be included in the printout.')
        window.print();
    }

    // Toaster Config
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "100000",
        "hideDuration": "5000",
        "timeOut": "80000",
        "extendedTimeOut": "100000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    
    // GWA Accepts Only Numbers
    $(document).on('input', '#gwa-grade', function(){
        let entry = $('#gwa-grade').val();
        let gwa = $.isNumeric($('#gwa-grade').val());
        if(gwa == false){
            alertify.error('Please enter a number. Enter 0 if not applicable!');
            $(this).val('');
        }
    });

    // Initialize Dropify
    $('.dropify').dropify();

    // Admission Form Submission
    $('#admission-form').on('submit',function(event){
        event.preventDefault();
        if(!$('input[name="dpa-agree"]:checked').length > 0){
            Swal.fire({
                title: 'Agreement not Signed!',
                text: 'Please agree to Data Privacy first.',
                icon: 'error'
            })
        } else {

            $('#loading-spinner').css('visibility','visible');
            $('#submitAdmissionBtn').addClass('d-none');
            let today = new Date();
            let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            let time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
            let dateTime = date+'_'+time;
            let fileName = 'profile-'+ dateTime +'.png';
            let dataURI = $('.img-tag').val();
            let file = dataURItoFile(dataURI, fileName);

            let form = $('#admission-form')[0];
            let formData = new FormData(form);
            formData.append('applicant-img', file);
            
            $.ajax({
                url: '{{ route("admission.store") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    $('#loading-spinner').css('visibility','hidden');
                    $('#admission-submitted').removeClass('d-none');
                    $('#admission-submitted').addClass('d-block');
                    $('#admission').addClass('d-none');
                    $('#admission').removeClass('d-block');
                    $('#submitted-form').addClass('d-block');
                    $('#submitted-form').removeClass('d-none');
                    
                    $('#print-fullname').text(data.success.first_name+' '+data.success.middle_name+' '+data.success.last_name);
                    $('#print-contact').text(data.success.contact_number);
                    let print_gender = ['Gender','Male','Female']
                    $('#print-gender').text(print_gender[data.success.gender]);
                    let print_civil_status = ['Civil Status','Single','Married','Widow','Widower'];
                    $('#print-civil-status').text(print_civil_status[data.success.civil_status]);
                    $('#print-religion').text(data.success.religion);
                    let print_purok = '';
                    if(data.success.purok){
                        print_purok = 'Purok '+data.success.purok
                    }
                    let print_sitio = '';
                    if(data.success.sitio){
                        print_sitio = 'Sitio '+data.success.sitio;
                    }

                    let purokSitio = '';
                    if(print_purok == '' || print_sitio == ''){
                        purokSitio = '';
                    } else if(print_purok == ''){
                        purokSitio = print_sition;
                    } else {
                        purokSitio = print_purok+' '+print_sitio+', ';
                    }

                    $('#print-physical-address').text(purokSitio+data.success.street_barangay+','+data.success.municipality+','+data.success.province+', Philippines '+data.success.zip_code);
                    
                    let courseSelected = '';
                    let courseList = data.success.courses;
                    $.each(courseList, function(key,value){
                        if(value.id == data.success.course){
                            courseSelected = value.code;
                        }
                    })
                    $('#print-course').text(courseSelected);
                    let print_year_level = ['Year Level','First Year','Second Year','Third Year','Fourth Year'];
                    $('#print-year-level').text(print_year_level[data.success.year_level]);
                    $('#print-lrn').text(data.success.lrn);
                    // let trans_id = data.success.id;
                    // let id = trans_id.toString();
                    // $('#print-trans-id').text(id.padStart(6,'0'));
                    $('#print-parent-name').text(data.success.parent_guardian_name);
                    $('#print-parent-contact').text(data.success.parent_guardian_contact);
                    $('#print-school-graduated').text(data.success.school_graduated);
                    $('#print-school-address').text(data.success.school_address);
                    $('#print-year-graduated').text(data.success.year_graduated);

                    $('#print-gmc').css('background-image','url('+data.success.gmc+')');
                    $('#print-sf9-front').css('background-image','url('+data.success.sf9_front+')');
                    $('#print-sf9-back').css('background-image','url('+data.success.sf9_back+')');
                    $('#print-med-cert').css('background-image','url('+data.success.med_cert+')');
                    $('#print-psa-bc').css('background-image','url('+data.success.psa_bc+')');
                    $('#print-hd').css('background-image','url('+data.success.hd+')');

                    $('#print-applicant-img').attr('src', data.success.applicant_img);
                    
                    let initialFee = '₱ 1,500.00';
                    if(data.success.year_level == 1){
                        initialFee = '₱ 3,500.00';
                    } 
                    $('#totalMiscFee').text(initialFee);
                    $('html,body').animate({scrollTop: $('#admission-submitted').offset().top},'slow');
                    
                },
                error: function(error){
                    if(Object.keys(error.responseJSON).length > 1){
                            $.each(error.responseJSON,function(key,value){
                                let error_html = '<ul class="text-left">';
                                for(let x = 0; x < err.length; x++){
                                error_html += '<li class="text-left">'+err.responseJSON.error[x]+'</li>';
                                if(x==err.responseJSON.error.length){
                                    error_html += '</ul>';
                                }
                            }   
                        });
                    } else {
                        Swal.fire({
                            title: 'Invalid Request',
                            icon: 'error',
                            text: error.responseJSON.error
                        });
                    }
                }
            });  
        }

    });
</script>

<script>
    //DOM elements
    const DOMstrings = {
        stepsBtnClass: 'multisteps-form__progress-btn',
        stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
        stepsBar: document.querySelector('.multisteps-form__progress'),
        stepsForm: document.querySelector('.multisteps-form__form'),
        stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
        stepFormPanelClass: 'multisteps-form__panel',
        stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
        stepPrevBtnClass: 'js-btn-prev',
        stepNextBtnClass: 'js-btn-next' 
    };

    //remove class from a set of items
    const removeClasses = (elemSet, className) => {
        elemSet.forEach(elem => {
            elem.classList.remove(className);
        });
    };

    //return exact parent node of the element
    const findParent = (elem, parentClass) => {
        let currentNode = elem;
        while (!currentNode.classList.contains(parentClass)) {
            currentNode = currentNode.parentNode;
        }
        return currentNode;
    };

    //get active button step number
    const getActiveStep = elem => {
        return Array.from(DOMstrings.stepsBtns).indexOf(elem);
    };

    //set all steps before clicked (and clicked too) to active
    const setActiveStep = activeStepNum => {
        //remove active state from all the state
        removeClasses(DOMstrings.stepsBtns, 'js-active');
        //set picked items to active
        DOMstrings.stepsBtns.forEach((elem, index) => {
            if (index <= activeStepNum) {
                elem.classList.add('js-active');
            }
        });
    };

    //get active panel
    const getActivePanel = () => {
        let activePanel;
        DOMstrings.stepFormPanels.forEach(elem => {
            if (elem.classList.contains('js-active')) {
                activePanel = elem;
            }
        });
        return activePanel;
    };

    //open active panel (and close inactive panels)
    const setActivePanel = activePanelNum => {
        //remove active class from all the panels
        removeClasses(DOMstrings.stepFormPanels, 'js-active');
        //show active panel
        DOMstrings.stepFormPanels.forEach((elem, index) => {
            if (index === activePanelNum) {
                elem.classList.add('js-active');
                setFormHeight(elem);
            }
        });
    };

    //set form height equal to current panel height
    const formHeight = activePanel => {
        const activePanelHeight = activePanel.offsetHeight;
        DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;
    };

    const setFormHeight = () => {
        const activePanel = getActivePanel();
        formHeight(activePanel);
    };

    //STEPS BAR CLICK FUNCTION
    DOMstrings.stepsBar.addEventListener('click', e => {
        //check if click target is a step button
        const eventTarget = e.target;
        if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
            return;
        }
        
        let valid = validateForm();
        
        if(valid){
            //get active button step number
            const activeStep = getActiveStep(eventTarget);
            
            //set all steps before clicked (and clicked too) to active
            setActiveStep(activeStep);
        
            //open active panel
            setActivePanel(activeStep);
        }
        
    });

    //PREV/NEXT BTNS CLICK
    DOMstrings.stepsForm.addEventListener('click', e => {
        const eventTarget = e.target;
        //check if we clicked on `PREV` or NEXT` buttons
        if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`)))
        {
            return;
        }

        let valid = validateForm();
        
        //find active panel
        const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);
        let activePanelNum = Array.from(document.querySelectorAll('.multisteps-form__panel')).indexOf(activePanel);
        console.log(activePanelNum);
        //set active step and active panel onclick
        if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
            activePanelNum--;
        } else {
            if(valid){
                activePanelNum++;
                if(activePanelNum == 6){
                    if(studentType == 'old'){
                        activePanelNum++;
                    }
                }
            }
        }
        setActiveStep(activePanelNum);
        setActivePanel(activePanelNum);
    });

    const validateForm = () => {
        let panel = getActivePanel();
        // This function deals with validation of the form fields
        let input, select, i = 0, valid = true;
        input = panel.getElementsByTagName("input");
        select = panel.getElementsByTagName("select");
        textarea = panel.getElementsByTagName("textarea");

        for (i; i < input.length; i++) {
            // If a field is empty...
            if (input[i].value == "") {
                if(input[i].name == 'middle-name'){
                    input[i].className = 'form-control';
                    valid = true;
                } else if(input[i].name == 'purok'){
                    input[i].className = 'form-control';
                    valid = true;
                } else if(input[i].name == 'sitio'){
                    input[i].className = 'form-control';
                    valid = true;
                } else if(input[i].name == 'gwa-grade'){
                    input[i].className = 'form-control';
                    valid = true;
                } else if(input[i].type == 'file'){
                    input[i].className = 'form-control';
                    valid = true;
                } else {
                    input[i].className = "invalid form-control"; // add an "invalid" class to the field:
                    valid = false; // and set the current valid status to false:
                }
            }
        }
        
        for (i = 0; i < select.length; i++){
            if(select[i].value == 'Gender'){
                select[i].className = " invalid form-control";
                valid = false;
            } else if(select[i].value == 'Civil Status') {
                select[i].className = " invalid form-control";
                valid = false;
            } else if(select[i].value == 'Select Year Level'){
                select[i].className = " invalid form-control";
                valid = false;
            } else if(select[i].value == 'Select a Course'){
                select[i].className = " invalid form-control";
                valid = false;
            }
        }
        
        for (i = 0; i < textarea.length; i++){
            if(textarea[i].value == ""){
                textarea[i].className = " invalid form-control";
                valid = false;
            }
        }
        
        if(valid == false){
            alertify.error('Fill out required Fields!');
        }

        var applicantImg = document.getElementById("profile-pic");
        if(applicantImg.getAttribute('data-img') == 'empty'){
            alertify.error('Selfie is required!');
            valid = false;
        }
        return valid;
    }

    //SETTING PROPER FORM HEIGHT ONLOAD
    window.addEventListener('load', setFormHeight, false);

    //SETTING PROPER FORM HEIGHT ONRESIZE
    window.addEventListener('resize', setFormHeight, false);
</script>