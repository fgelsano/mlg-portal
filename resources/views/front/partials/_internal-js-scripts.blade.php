<script>
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
        $('#consent-block').fadeOut();
        $('#admission').animate();
        $('#admission').addClass('d-block');
        $('#admission').removeClass('d-none');
        $('#first-name').val($(this).attr('data-fname'));
        $('#middle-name').val($(this).attr('data-mname'));
        $('#last-name').val($(this).attr('data-lname'));
        $('#student-type').val('old');
        $('#profile-id').val($(this).attr('data-id'));
        $('#submitAdmissionBtn-course-panel').removeClass('d-none');
        $('#file-uploads-panel').addClass('d-none');
        $('#file-upload-btn').addClass('d-none');
        $('#data-privacy-agreement-course-panel').removeClass('d-none');
        $('#data-privacy-agreement-file-upload-panel').addClass('d-none');
        let firstName = $(this).attr('data-fname');
        Swal.close();
        Swal.fire(
            'Welcome Back '+firstName+'!',
            'Please fill-out the form below.',
            'success'
        )
        openCam();
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
                    swalWithBootstrapButtons.fire(
                        'Thanks for enrolling at MLGCL!',
                        'Please fill-out the form below.',
                        'success'
                    )
                    openCam();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Enter your name',
                        html:
                            '<input id="lastName" class="form-control my-3" placeholder="Last Name">' +
                            '<input id="firstName" class="form-control my-3" placeholder="First Name">',
                        inputAttributes: {
                            autocapitalize: 'off'
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
                                                $('#consent-block').fadeOut();
                                                $('#admission').animate();
                                                $('#admission').addClass('d-block');
                                                $('#admission').removeClass('d-none');
                                                $('#first-name').val(data.profiles[0].first_name);
                                                $('#middle-name').val(data.profiles[0].middle_name);
                                                $('#last-name').val(data.profiles[0].last_name);
                                                $('#student-type').val('old');
                                                $('#profile-id').val(data.profiles[0].id);
                                                $('#submitAdmissionBtn-course-panel').removeClass('d-none');
                                                $('#file-uploads-panel').addClass('d-none');
                                                $('#file-upload-btn').addClass('d-none');
                                                $('#profile-pic').attr('src','/admin/img/empty-profile-img.png');
                                                $('#profile-pic').attr('data-imng','empty');;
                                                $('#data-privacy-agreement-course-panel').removeClass('d-none');
                                                $('#data-privacy-agreement-file-upload-panel').addClass('d-none');
                                                Swal.fire(
                                                    'Welcome Back '+data.profiles[0].first_name+'!',
                                                    'Please fill-out the form below.',
                                                    'success'
                                                )
                                                openCam();
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
                                                                    '<p class="px-md-5 text-left text-lead mb-0 mt-5">Id Number: <strong class="float-right">'+data.profiles.school_id+'</strong></p>' +
                                                                    '<p class="px-md-5 text-left text-lead my-0">First Name: <strong class="float-right">'+data.profiles.first_name+'</strong></p>' +
                                                                    '<p class="px-md-5 text-left text-lead my-0">Middle Name: <strong class="float-right">'+data.profiles.middle_name+'</strong></p>' +
                                                                    '<p class="px-md-5 text-left text-lead my-0">Last Name: <strong class="float-right">'+data.profiles.last_name+'</strong></p>'+
                                                                    '<p class="px-md-5 text-left text-lead my-0">Course: <strong class="float-right">'+data.profiles.course+'</strong></p>',
                                                                    showCancelButton: true,
                                                                    confirmButtonText: 'Yes, that\'s me!',
                                                                    cancelButtonText: 'No, that\'s not me!',
                                                                }).then((result) => {
                                                                    if (result.value) {
                                                                        $('#consent-block').fadeOut();
                                                                        $('#admission').animate();
                                                                        $('#admission').addClass('d-block');
                                                                        $('#admission').removeClass('d-none');
                                                                        $('#first-name').val(data.profiles.first_name);
                                                                        $('#middle-name').val(data.profiles.middle_name);
                                                                        $('#last-name').val(data.profiles.last_name);
                                                                        $('#student-type').val('old');
                                                                        $('#profile-id').val(data.profiles.id);
                                                                        $('#submitAdmissionBtn-course-panel').removeClass('d-none');
                                                                        $('#file-uploads-panel').addClass('d-none');
                                                                        $('#file-upload-btn').addClass('d-none');
                                                                        $('#profile-pic').attr('src','/admin/img/empty-profile-img.png');
                                                                        $('#profile-pic').attr('data-imng','empty');;
                                                                        $('#data-privacy-agreement-course-panel').removeClass('d-none');
                                                                        $('#data-privacy-agreement-file-upload-panel').addClass('d-none');
                                                                        swalWithBootstrapButtons.fire(
                                                                            'Welcome Back '+data.profiles.first_name+'!',
                                                                            'Please fill-out the form below.',
                                                                            'success'
                                                                        )
                                                                        openCam();
                                                                    } else {
                                                                        swalWithBootstrapButtons.fire(
                                                                            'Sorry we can\'t find your student details',
                                                                            'Please try searching again or you may register as NEW STUDENT instead.',
                                                                            'info'
                                                                        )
                                                                    }
                                                                });
                                                            },
                                                            error: function(err){
                                                                swalWithBootstrapButtons.fire(
                                                                    'Sorry we can\'t find your student details',
                                                                    'Please try searching again or you may register as NEW STUDENT instead.',
                                                                    'info'
                                                                )
                                                            }
                                                        })
                                                    }
                                                });
                                            }
                                        });
                                    }
                                    
                                },
                                error: function(error){
                                    Swal.fire({
                                        title: error.responseJSON.error,
                                        icon: 'error'
                                    })
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
            text: 'Please make sure to wear a proper outfit and choose a good background before taking a selfie. Your selfie will be recorded in our system and will be evaluated by the registrar.',
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
        $('input[required]').each(function(){
            if($(this).val() == ""){
                alertify.error($(this)[0].name + ' requires an entry');
            }
        })
        $('select[required]').each(function(){
            if($(this).val() == ""){
                alertify.error($(this)[0].name + ' requires an entry');
            }
        })
        $('textarea[required]').each(function(){
            if($(this).val() == ""){
                alertify.error($(this)[0].name + ' requires an entry');
            }
        })
        if(!$('input[name="dpa-agree"]:checked').length > 0){
            Swal.fire({
                title: 'Agreement not Signed!',
                text: 'Please agree to Data Privacy first.',
                icon: 'error'
            })
        } else {

            $('#loading-spinner').css('visibility','visible');
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
                    let print_gender = ['Male','Female']
                    $('#print-gender').text(print_gender[data.success.gender]);
                    let print_civil_status = ['Single','Married','Widow','Widower'];
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
                    let print_year_level = ['','First Year','Second Year','Third Year','Fourth Year'];
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
                    
                    let initialFee = '₱ 3,200.00';
                    if(data.success.year_level == 1){
                        initialFee = '₱ 3,500.00';
                    } 
                    $('#totalMiscFee').text(initialFee);
                    $('html,body').animate({scrollTop: $('#admission-submitted').offset().top},'slow');
                    
                },
                error: function(err){
                    let error_html = '<ul class="text-left">';
                    for(let x = 0; x < err.length; x++){
                        error_html += '<li class="text-left">'+err.responseJSON.error[x]+'</li>';
                        if(x==err.responseJSON.error.length){
                            error_html += '</ul>';
                        }
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
    stepNextBtnClass: 'js-btn-next' };


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
            let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);
            //set active step and active panel onclick
            if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
                activePanelNum--;
            } else {
                if(valid){
                    activePanelNum++;
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
                console.log(input[i].name + '=' + valid);
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
        alert(valid);
        return valid;
    }

    //SETTING PROPER FORM HEIGHT ONLOAD
    window.addEventListener('load', setFormHeight, false);

    //SETTING PROPER FORM HEIGHT ONRESIZE
    window.addEventListener('resize', setFormHeight, false);
</script>