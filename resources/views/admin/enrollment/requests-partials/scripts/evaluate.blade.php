{{-- Evaluate Admission --}}
<script>
    $('#rejectAdmission').click(function(){
        $('input[name="button-action"]').val('Reject');
    });
    $(document).on('click', '.evalAdmission', function(e){
        e.preventDefault();
        let admissionId = $(this).attr('data-id');
        let routeUrl = "{{ route('requests.show','id') }}";
        let evalUrl = routeUrl.replace('id', admissionId);
        $.ajax({
            url: evalUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                console.log(data);
                $('#rejectAdmission').attr('data-id', data.id);
                $('#enrollAdmission').attr('data-id', data.id);
                
                let fullname = data.first_name+' '+data.middle_name+' '+data.last_name;
                $('#fullname').text(fullname);
                $('#requested-by').text(fullname);
                let print_gender = ['Male','Female']
                $('#gender').text(print_gender[data.gender]);
                $('#contact').text(data.contact_number);
                let print_civil_status = ['Single','Married','Widow','Widower'];
                $('#civil-status').text(print_civil_status[data.civil_status]);
                $('#religion').text(data.religion);
                let print_purok = '';
                if(data.purok){
                    print_purok = 'Purok '+data.purok
                }
                let print_sitio = '';
                if(data.sitio){
                    print_sitio = 'Sitio '+data.sitio;
                }

                let purokSitio = '';
                if(print_purok == '' || print_sitio == ''){
                    purokSitio = '';
                } else if(print_purok == ''){
                    purokSitio = print_sition;
                } else {
                    purokSitio = print_purok+' '+print_sitio+', ';
                }

                $('#physical-address').text(purokSitio+data.barangay+','+data.municipality+','+data.province+', Philippines '+data.zipcode);
                let print_courses = ['BSIT','BEED','BSED-Math','BSED-SocSci','SHS-ABM','SHS-HUMSS','SHS-CK','SHS-HK','SHS-BP','SHS-ICT','JHS'];
                $('#course').text(print_courses[data.course]);
                let print_year_level = ['First Year','Second Year','Third Year','Fourth Year','Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
                $('#year-level').text(print_year_level[data.year_level]);
                $('#lrn').text(data.lrn);
                // let trans_id = data.id;
                // let request_id = trans_id.toString();
                // $('#request-id').text(request_id.padStart(6,'0'));
                // $('#request-id').attr('data-id', trans_id);
                $('#parent-name').text(data.emergency_contact_name);
                $('#parent-contact').text(data.emergency_contact_number);
                $('#school-graduated').html(data.school_graduated+' (Graduated: '+data.year_graduated+')');
                $('#school-address').text(data.school_address);

                let filePath = '/storage/uploads/';
                let noDoc = '/no-document-uploaded.jpg';

                let gmc = data.documents[0].good_moral ? filePath+'gmc/'+data.good_moral : filePath+'gmc'+noDoc;
                $('#gmc').css('background-image','url("'+gmc+'")');
                $('#gmc-link').attr('data-img',gmc);

                let sf9_front = data.documents[0].report_card_front ? filePath+'sf9-front/'+data.report_card_front : filePath+'sf9-front'+noDoc;
                $('#sf9-front').css('background-image','url("'+sf9_front+'")');
                $('#sf9-front-link').attr('data-img',sf9_front);

                let sf9_back = data.documents[0].report_card_back ? filePath+'sf9-back/'+data.report_card_back : filePath+'sf9-back'+noDoc;
                $('#sf9-back').css('background-image','url("'+sf9_back+'")');
                $('#sf9-back-link').attr('data-img',sf9_back);

                let med_cert = data.documents[0].med_cert ? filePath+'med-cert/'+data.med_cert : filePath+'med-cert'+noDoc;
                $('#med-cert').css('background-image','url("'+med_cert+'")');
                $('#med-cert-link').attr('data-img',med_cert);

                let psa_bc = data.documents[0].psa_birth_cert ? filePath+'psa-bc/'+data.psa_birth_cert : filePath+'psa-bc'+noDoc;
                $('#psa-bc').css('background-image','url("'+psa_bc+'")');
                $('#psa-bc-link').attr('data-img',psa_bc);

                let hd = data.documents[0].honorable_dismissal ? filePath+'hd/'+data.documents[0].honorable_dismissal : filePath+'hd'+noDoc;
                $('#hd').css('background-image','url("'+hd+'")');
                $('#hd-link').attr('data-img',hd);

                let profile_pic = data.profile_pic ? filePath+'applicant-img/'+data.profile_pic : filePath+'applicant-img'+noDoc;
                
                $('#profile-pic').css('background-image', 'url("'+profile_pic+'")');
                $('#profile-pic-link').attr('data-img',profile_pic);

                let status = '';
                if(data.status == 0){
                    status = 'PENDING REVIEW';
                } else if(data.status == 1){
                    status = 'Cashier\'s Hold';
                } else if(data.status == 2){
                    status = 'Accepted';
                } else if(data.status == 3){
                    status = 'Rejected: '+data.comment;
                } else {
                    status = 'Enrolled';
                }
                $('#admission-status').text(status);
                $('#admission-modal').modal('show');
            }
        })
    });
</script>