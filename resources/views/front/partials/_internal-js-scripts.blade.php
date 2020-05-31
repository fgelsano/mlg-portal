<script>

    // Consent Button
    $('#consent-btn').click(function(){
        $('#consent-block').fadeOut();
        $('#admission').animate();
        $('#admission').addClass('d-block');
        $('#admission').removeClass('d-none');
    });

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
        Webcam.set({
            width: 470,
            height: 390,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
    
        Webcam.attach( '#camera' );
    };

    // Capture Selfie
    function takeSnapshot() {
        Webcam.snap( function(data_uri) {
            $(".img-tag").val(data_uri);
            $('#profile-pic').attr('src', data_uri);
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
    
    // Admission Form Submission
    $('#admission-form').on('submit',function(event){
        
        let today = new Date();
        let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        let time = today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
        let dateTime = date+'_'+time;

        let fileName = 'profile-'+ dateTime +'.png';
        let dataURI = $('.img-tag').val();

        let file = dataURItoFile(dataURI, fileName);

        event.preventDefault();

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
                console.log(data);
                if(data.error.length > 0){
                    let error_html = '';
                    for(let x = 0; x < data.error.length; x++){
                        error_html += '<li>'+data.error[x]+'</li>';
                    }
                    toastr["error"](error_html);
                    $('#error-box').html('<ul>'+error_html+'</ul>');
                    $('#error-box').removeClass('d-none');
                    $('#error-box').addClass('d-block');
                } else {
                    $('#admission-submitted').removeClass('d-none');
                    $('#admission-submitted').addClass('d-block');
                    $('#admission').addClass('d-none');
                    $('#admission').removeClass('d-block');
                    $('#submitted-form').addClass('d-block');
                    $('#submitted-form').removeClass('d-none');
                    
                    $('#print-fullname').text(data.success.first_name+' '+data.success.middle_name+' '+data.success.last_name);
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
                    $('#print-physical-address').text(print_purok+' '+print_sitio+','+data.success.street_barangay+','+data.success.municipality+','+data.success.province+', Philippines '+data.success.zip_code);
                    let print_courses = ['BSIT','BEED','BSED-Math','BSED-SocSci','SHS-ABM','SHS-HUMSS','SHS-CK','SHS-HK','SHS-BP','SHS-ICT','JHS'];
                    $('#print-course').text(print_courses[data.success.course]);
                    let print_year_level = ['First Year','Second Year','Third Year','Fourth Year','Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
                    $('#print-year-level').text(print_year_level[data.success.year_level]);
                    $('#print-lrn').text(data.success.lrn);
                    let trans_id = data.success.id;
                    let id = trans_id.toString();
                    $('#print-trans-id').text(id.padStart(5,'0'));
                    $('#print-parent-name').text(data.success.parent_guardian_name);
                    $('#print-parent-contact').text(data.success.parent_guardian_contact);
                    $('#print-school-graduated').text(data.success.school_graduated);
                    $('#print-school-address').text(data.success.school_address);
                    $('#print-year-graduated').text(data.success.year_graduated);
                    $('#print-gmc').html(data.success.gmc);
                    $('#print-sf9-front').html(data.success.sf9_front);
                    $('#print-sf9-back').html(data.success.sf9_back);
                    $('#print-med-cert').html(data.success.med_cert);
                    $('#print-gwa').html(data.success.gwa);
                    $('#print-psa-bc').html(data.success.psa_bc);
                    $('#print-hd').html(data.success.hd);
                    let applicant_img_url = 'storage/uploads/applicant-img/';
                    $('#print-applicant-img').attr('src', applicant_img_url+data.success.applicant_img);
                    $('html,body').animate({scrollTop: $('#admission-submitted').offset().top},'slow');
                }
            }
        });        
    });

    // Print
    function printAdmission(){
        window.print();

    }

    // Toaster Config
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "30000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>