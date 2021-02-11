<script>
    $(document).on('click', '.viewProfile', function(e){
        e.preventDefault();
        let profileId = $(this).attr('data-id');
        let routeUrl = "{{ route('profile.edit','id') }}";
        let profileUrl = routeUrl.replace('id', profileId);
        $.ajax({
            url: profileUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#schoolId').text(data.school_id);
                let middleName = data.middle_name;
                if(data.middle_name == null){
                    middleName = '';
                }
                let fullname = data.first_name+' '+middleName+' '+data.last_name;
                $('#fullname').text(fullname);
                $('#requested-by').text(fullname);
                let print_gender = ['Gender','Male','Female']
                $('#gender').text(print_gender[data.gender]);
                $('#contact').text(data.contact_number);
                let print_civil_status = ['Civil Status','Single','Married','Widow','Widower'];
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

                let courseList = ['Course','BSIT','BEED','BSED-Math','BSED-SocStu'];
                $('#course').text(courseList[data.course]);
                
                let print_year_level = ['Year Level','First Year','Second Year','Third Year','Fourth Year'];
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
                
                let gmc = data.documents[0].good_moral != 'No Data' ? filePath+'gmc/'+data.documents[0].good_moral : filePath+'gmc'+noDoc;
                $('#gmc').css('background-image','url("'+gmc+'")');
                $('#gmc-link').attr('data-image',gmc);

                let sf9_front = data.documents[0].report_card_front != 'No Data' ? filePath+'sf9-front/'+data.documents[0].report_card_front : filePath+'sf9-front'+noDoc;
                $('#sf9-front').css('background-image','url("'+sf9_front+'")');
                $('#sf9-front-link').attr('data-image',sf9_front);

                let sf9_back = data.documents[0].report_card_back != 'No Data' ? filePath+'sf9-back/'+data.documents[0].report_card_back : filePath+'sf9-back'+noDoc;
                $('#sf9-back').css('background-image','url("'+sf9_back+'")');
                $('#sf9-back-link').attr('data-image',sf9_back);

                let med_cert = data.documents[0].med_cert != 'No Data' ? filePath+'med-cert/'+data.documents[0].med_cert : filePath+'med-cert'+noDoc;
                $('#med-cert').css('background-image','url("'+med_cert+'")');
                $('#med-cert-link').attr('data-image',med_cert);

                let psa_bc = data.documents[0].psa_birth_cert != 'No Data' ? filePath+'psa-bc/'+data.documents[0].psa_birth_cert : filePath+'psa-bc'+noDoc;
                $('#psa-bc').css('background-image','url("'+psa_bc+'")');
                $('#psa-bc-link').attr('data-image',psa_bc);

                let hd = data.documents[0].honorable_dismissal != 'No Data' ? filePath+'hd/'+data.documents[0].honorable_dismissal : filePath+'hd'+noDoc;
                $('#hd').css('background-image','url("'+hd+'")');
                $('#hd-link').attr('data-image',hd);

                let profile_pic = data.profile_pic != 'No Data' ? filePath+'applicant-img/'+data.profile_pic : filePath+'applicant-img'+noDoc;
                
                $('#profile-pic').css('background-image', 'url("'+profile_pic+'")');
                $('#profile-pic-link').attr('data-image',profile_pic);

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
                $('#profile-modal').modal('show');
            }
        })
    });

    $(document).on('click', '.caption-link', function(e){
        let file = $(this).attr('data-image');
        $('#document-img').attr('src',file);
        $('#document-viewer').modal('show');
    })

    $(document).on('click', '#btnFilter', function(e){
        e.preventDefault();

        let form = $('#filterGradeForm')[0];
        let formData = new FormData(form);

        let profileId = $(this).attr('data-id');
        let routeUrl = "{{ route('grades.filter','id') }}";
        let profileUrl = routeUrl.replace('id', profileId);
        $.ajax({
            url: profileUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                console.log(data.givenGrade);
                $('#subjectListItems').empty();
                let count = 1;
                let grade = '';
                let clearance = '';
                $.each(data.givenGrade,function(key,value){
                    if(value.clearance == 'Not Cleared'){
                        clearance = '<span class="badge badge-danger">Not Cleared</span>';
                    } else {
                        clearance = '<span class="badge badge-success">Cleared</span>';
                    }
                    if(value.grade == 'No Grade Yet'){
                        grade = 'font-weight-bold';
                    } else if(value.grade == '5.0'){
                        grade = 'font-weight-bold text-danger';
                    } else if(value.grade == 'NG'){
                        grade = 'font-weight-bold text-info';
                    } else if(value.grade == 'INC'){
                        grade = 'font-weight-bold text-warning';
                    } else {
                        grade = 'font-weight-bold text-success';
                    }
                    $('#subjectListItems').append(
                        '<tr>'+
                            '<td>'+ count +'</td>'+
                            '<td>'+ value.code +'</td>'+
                            '<td>'+ value.description +'</td>'+
                            '<td>'+ clearance +'</td>'+
                            '<td class="'+grade+'">'+ value.grade +'</td>'+
                        '</tr>'
                    );
                    count++;
                });
            },
            error: function(err){
                console.log(err);
                $('#subjectListItems').empty();
                $('#subjectListItems').append(
                    '<tr><td colspan="5"><div class="alert alert-danger py-3 mt-2 mb-5 text-center">Sorry, there\'s no subjects found in this criteria! Try to filter with another criteria again.</div></td></tr>'
                );
            }
        })
    });
</script>