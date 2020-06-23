{{-- Evaluate Admission --}}
<script>
    $(document).on('click', '.enrollStudent', function(e){
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
                $('#rejectAdmission').attr('data-id', data.profile.id);
                $('#enrollAdmission').attr('data-id', data.profile.id);
                $('#enrollee-school-id').text(data.profile.school_id);
                $('#applicant-id').val(data.profile.id);
                let fullname = data.profile.first_name+' '+data.profile.middle_name+' '+data.profile.last_name;
                $('#applicant-name').text(fullname);
                
                
                let print_gender = ['Gender','Male','Female']
                $('#enrollee-gender').text(print_gender[data.profile.gender]);
                $('#enrollee-contact').text(data.profile.contact_number);

                let print_civil_status = ['Civil Status','Single','Married','Widow','Widower'];
                $('#enrollee-civil-status').text(print_civil_status[data.profile.civil_status]);
                $('#enrollee-religion').text(data.profile.religion);

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

                $('#enrollee-physical-address').text(purokSitio+data.profile.barangay+','+data.profile.municipality+','+data.profile.province+', Philippines '+data.profile.zipcode);

                let courseSelected = '';
                let courseList = data.courses;
                $.each(courseList, function(key,value){
                    if(value.id == data.profile.course){
                        courseSelected = value.code;
                    }
                })
                $('#enrollee-course').text(courseSelected);
                
                let print_year_level = ['Year Level','First Year','Second Year','Third Year','Fourth Year'];
                $('#enrollee-year-level').text(print_year_level[data.profile.year_level]);

                let filePath = '/storage/uploads/';
                let noDoc = '/no-document-uploaded.jpg';
                let profile_pic = data.profile.profile_pic ? filePath+'applicant-img/'+data.profile.profile_pic : filePath+'applicant-img'+noDoc;
                $('#enroll-profile-pic').css('background-image', 'url("'+profile_pic+'")');
                $('#profile-pic-link').attr('data-img',profile_pic);

                let addedSubject = $('#enrolled-subjects').find('.addedSubject');
                if(addedSubject.length == 0){
                    $('#enrolled-subjects').html('<tr class="table-danger text-center text-white" id="empty-row" data-stat="empty"><td colspan="7">No Enrolled Subject</td></tr>');
                }
                $('#enroll-modal').modal('show');
            }
        })
    });
</script>