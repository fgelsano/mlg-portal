{{-- Evaluate Admission --}}
<script>
    $('#rejectAdmission').click(function(){
        $('input[name="button-action"]').val('Reject');
    });
    $(document).on('click', '.evalAdmission', function(e){
        e.preventDefault();
        $('#request-loading').removeClass('d-none');
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
                $('#rejectAdmission').attr('data-id', data.profile.id);
                $('#enrollAdmission').attr('data-id', data.profile.id);
                $('#schoolId').text(data.profile.school_id);
                let middleName = data.profile.middle_name;
                if(data.profile.middle_name == null){
                    middleName = '';
                }
                let fullname = data.profile.first_name+' '+middleName+' '+data.profile.last_name;
                $('#fullname').text(fullname);
                $('#requested-by').text(fullname);
                let print_gender = ['Gender','Male','Female']
                $('#gender').text(print_gender[data.profile.gender]);
                $('#contact').text(data.profile.contact_number);
                let print_civil_status = ['Civil Status','Single','Married','Widow','Widower'];
                $('#civil-status').text(print_civil_status[data.profile.civil_status]);
                $('#religion').text(data.profile.religion);
                let print_purok = '';
                if(data.profile.purok){
                    print_purok = 'Purok '+data.profile.purok
                }
                let print_sitio = '';
                if(data.profile.sitio){
                    print_sitio = 'Sitio '+data.profile.sitio;
                }

                let purokSitio = '';
                if(print_purok == '' || print_sitio == ''){
                    purokSitio = '';
                } else if(print_purok == ''){
                    purokSitio = print_sition;
                } else {
                    purokSitio = print_purok+' '+print_sitio+', ';
                }

                $('#physical-address').text(purokSitio+data.profile.barangay+', '+data.profile.municipality+', '+data.profile.province+', Philippines '+data.profile.zipcode);

                let courseSelected = '';
                let courseList = data.courses;
                $.each(courseList, function(key,value){
                    if(value.id == data.profile.course){
                        courseSelected = value.code;
                    }
                })
                $('#course').text(courseSelected);
                
                let print_year_level = ['Year Level','First Year','Second Year','Third Year','Fourth Year'];
                $('#year-level').text(print_year_level[data.profile.year_level]);
                let lrn = '';
                if(data.profile.lrn == '0'){
                    lrn = 'NO LEARNER\'S REFERENCE NUMBER';
                }
                $('#lrn').text(lrn);
                // let trans_id = data.profile.id;
                // let request_id = trans_id.toString();
                // $('#request-id').text(request_id.padStart(6,'0'));
                // $('#request-id').attr('data-id', trans_id);
                $('#parent-name').text(data.profile.emergency_contact_name);
                $('#parent-contact').text(data.profile.emergency_contact_number);
                $('#school-graduated').html(data.profile.school_graduated+' (Graduated: '+data.profile.year_graduated+')');
                $('#school-address').text(data.profile.school_address);

                let filePath = '/storage/uploads/';
                let noDoc = '/no-document-uploaded.jpg';

                let gmc = data.profile.documents[0].good_moral != 'No Data' ? filePath+'gmc/'+data.profile.documents[0].good_moral : filePath+'gmc'+noDoc;
                $('#gmc').css('background-image','url("'+gmc+'")');
                $('#gmc-link').attr('data-img',gmc);

                let sf9_front = data.profile.documents[0].report_card_front != 'No Data' ? filePath+'sf9-front/'+data.profile.documents[0].report_card_front : filePath+'sf9-front'+noDoc;
                $('#sf9-front').css('background-image','url("'+sf9_front+'")');
                $('#sf9-front-link').attr('data-img',sf9_front);

                let sf9_back = data.profile.documents[0].report_card_back != 'No Data' ? filePath+'sf9-back/'+data.profile.documents[0].report_card_back : filePath+'sf9-back'+noDoc;
                $('#sf9-back').css('background-image','url("'+sf9_back+'")');
                $('#sf9-back-link').attr('data-img',sf9_back);

                let med_cert = data.profile.documents[0].med_cert != 'No Data' ? filePath+'med-cert/'+data.profile.documents[0].med_cert : filePath+'med-cert'+noDoc;
                $('#med-cert').css('background-image','url("'+med_cert+'")');
                $('#med-cert-link').attr('data-img',med_cert);

                let psa_bc = data.profile.documents[0].psa_birth_cert != 'No Data' ? filePath+'psa-bc/'+data.profile.documents[0].psa_birth_cert : filePath+'psa-bc'+noDoc;
                $('#psa-bc').css('background-image','url("'+psa_bc+'")');
                $('#psa-bc-link').attr('data-img',psa_bc);

                let hd = data.profile.documents[0].honorable_dismissal != 'No Data' ? filePath+'hd/'+data.profile.documents[0].honorable_dismissal : filePath+'hd'+noDoc;
                $('#hd').css('background-image','url("'+hd+'")');
                $('#hd-link').attr('data-img',hd);

                let profile_pic = data.profile.profile_pic != 'No Data' ? filePath+'applicant-img/'+data.profile.profile_pic : filePath+'applicant-img'+noDoc;
                
                $('#profile-pic').css('background-image', 'url("'+profile_pic+'")');
                $('#profile-pic-link').attr('data-img',profile_pic);

                let status = '';
                if(data.profile.status == 0){
                    status = 'PENDING REVIEW';
                } else if(data.profile.status == 1){
                    status = 'Cashier\'s Hold';
                } else if(data.profile.status == 2){
                    status = 'Accepted';
                } else if(data.profile.status == 3){
                    status = 'Rejected: '+data.profile.comment;
                } else if(data.profile.status == 4){
                    status = 'Enrolled';
                }
                $('#admission-status').text(status);
                
                $('#request-loading').addClass('d-none');
                
                $('#admission-modal').modal('show');
                
            }
        })
    });
</script>