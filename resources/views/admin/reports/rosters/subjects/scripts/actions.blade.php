<script>
    $(document).on('click', '.viewStudentProfile', function(e){
        e.preventDefault();
        $('#request-loading').removeClass('d-none');
        let studentId = $(this).attr('data-id');
        let routeUrl = "{{ route('requests.show','id') }}";
        let viewUrl = routeUrl.replace('id', studentId);
        $.ajax({
            url: viewUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                console.log(data);
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
                $('#lrn').text(data.profile.lrn);

                $('#parent-name').text(data.profile.emergency_contact_name);
                $('#parent-contact').text(data.profile.emergency_contact_number);
                $('#school-graduated').html(data.profile.school_graduated+' (Graduated: '+data.profile.year_graduated+')');
                $('#school-address').text(data.profile.school_address);

                let filePath = '/storage/uploads/';
                let noDoc = '/no-document-uploaded.jpg';

                let profile_pic = data.profile.profile_pic != 'No Data' ? filePath+'applicant-img/'+data.profile.profile_pic : filePath+'applicant-img'+noDoc;
                
                $('#profile-pic').css('background-image', 'url("'+profile_pic+'")');
                $('#profile-pic-link').attr('data-img',profile_pic);

                $('#request-loading').addClass('d-none');
                
                $('#viewStudent-modal').modal('show');
                
            }
        })
    });
    $(document).on('click', '.caption-link', function(e){
        $('#document-title').text($('#requested-by').text());
        $('#document-img').attr('src',$(this).attr('data-img'));
        $('#document-viewer').modal('show');
    });
</script>