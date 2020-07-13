<script>
    let selectedSubjects = [];
    let removedSubjects = [];
    let totalUnits = Number('0');
    $(document).on('click', '.enrollSubject', function(e){
        e.preventDefault();
        let subjectId = $(this).attr('data-id');
        
        let routeUrl = "{{ route('subjects.pick','id') }}";
        let editUrl = routeUrl.replace('id', subjectId); 
        let table = $('#enroll-subjects').DataTable();       
        // console.log(Array.isArray((selectedSubjects)));
        if(selectedSubjects.includes(Number(subjectId)) == true){
            Swal.fire({
                title: 'You have already added this subject.',
                icon: 'error'
            })
        } else {
            $.ajax({
                url: editUrl,
                type: 'GET',
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    let code = data[0].code;
                    let desc = data[0].description;
                    let units = data[0].units;
                    let type = '';
                    if(data[0].type == 0){
                        type = 'Room';
                    } else {
                        type = 'Lab';
                    }
                    let sched = data[0].day+' '+data[0].time+' at '+type+' '+data[0].location;
                    let instructor = data[0].first_name + ' ' + data[0].last_name;

                    if($('#empty-row').attr('data-stat') == 'empty'){
                        $('#enrolled-subjects').html('');
                        $('#enrolled-subjects').html('<tr class="addedSubject"><td>'+code+'</td><td>'+desc.substr(0,20)+'...'+'</td><td>'+sched+'</td><td>'+instructor+'</td><td class="text-center">'+units+'</td><td><button class="removeSubject btn btn-sm btn-danger" data-units="'+units+'" data-id="'+subjectId+'"><i class="fas fa-trash"></i></button></td></tr>');
                        // $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+subjectId+'">');
                        selectedSubjects.push(Number(subjectId));
                        $('#enrolled-subjects').attr('data-empty', '1');
                    } else {
                        $('#enrolled-subjects').html($('#enrolled-subjects').html());
                        $('#enrolled-subjects').append('<tr class="addedSubject"><td>'+code+'</td><td>'+desc.substr(0,20)+'...'+'</td><td>'+sched+'</td><td>'+instructor+'</td><td class="text-center">'+units+'</td><td><button class="removeSubject btn btn-sm btn-danger" data-units="'+units+'" data-id="'+subjectId+'"><i class="fas fa-trash"></i></button></td></tr>');
                        // $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+subjectId+'">');
                        selectedSubjects.push(Number(subjectId));
                        $('#enrolled-subjects').attr('data-empty', '1');
                    }
                    let unit = units;
                    totalUnits = Number(totalUnits) + Number(unit);
                    $('#total').html('<div class="col-6 col-md-2 offset-8 font-weight-bold">Total Units</div><div class="col-6 col-md-1 font-weight-bold text-center" id="total-units">'+totalUnits+'</div>');
                    // console.log(selectedSubjects);
                }
            })
        }
    });

    $(document).on('click', '.removeSubject', function(){
        $(this).closest('tr').remove();
        let subjectId = $(this).attr('data-id');
        let addedSubject = $('#enrolled-subjects').find('.addedSubject');
        if(addedSubject.length == 0){
            $('#enrolled-subjects').append('<tr class="table-danger text-center text-white" id="empty-row" data-stat="empty"><td colspan="7">No Enrolled Subject</td></tr>');
        }

        let subjectUnit = $(this).attr('data-units');
        totalUnits = totalUnits - Number(subjectUnit);
        $('#total-units').text(totalUnits);

        selectedSubjects = jQuery.grep(selectedSubjects, function(value){
            return value != subjectId;
        })
        removedSubjects.push(subjectId);
        console.log(selectedSubjects);
    });

    $(document).on('click', '.editEnrollment', function(e){
        e.preventDefault();
        $('#action').val('editEnrollment');
        
        let admissionId = $(this).attr('data-id');
        let routeUrl = "{{ route('requests.show','id') }}";
        let editEnrollmentUrl = routeUrl.replace('id', admissionId);
        $.ajax({
            url: editEnrollmentUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#enrolled-subjects').empty();
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
                $('#enroll-profile-pic-link').attr('data-img',profile_pic);

                let addedSubject = $('#enrolled-subjects').find('.addedSubject');
                if(addedSubject.length == 0){
                    $('#enrolled-subjects').html('<tr class="table-danger text-center text-white" id="empty-row" data-stat="empty"><td colspan="7">No Enrolled Subject</td></tr>');
                }

                $('#action').val('editEnrollment');

                let routeUrl = "{{ route('enrolledSubjects.get','id') }}";
                let enrollUrl = routeUrl.replace('id', admissionId);
                $.ajax({
                    url: enrollUrl,
                    type: 'GET',
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
                        $('#enrolled-subjects').html('');
                        selectedSubjects = [];
                        totalUnits = [];
                        $.each(data, function(key, value){
                            selectedSubjects.push(value.subject_id);
                            totalUnits = Number(totalUnits) + Number(value.units);
                            let code = value.code;
                            let desc = value.description;
                            let units = value.units;
                            let type = '';
                            if(value.locationType == 0){
                                type = 'Room';
                            } else {
                                type = 'Lab';
                            }
                            let sched = value.day+' '+value.time+' at '+type+' '+value.location;
                            let instructor = value.first_name + ' ' + value.last_name;
                            $('#enrolled-subjects').append('<tr class="addedSubject"><td>'+code+'</td><td>'+desc.substr(0,20)+'...'+'</td><td>'+sched+'</td><td>'+instructor+'</td><td class="text-center">'+units+'</td><td><button class="removeSubject btn btn-sm btn-danger" data-units="'+units+'" data-id="'+value.subject_id+'"><i class="fas fa-trash"></i></button></td></tr>');
                        })
                        $('#total').html('<div class="col-6 col-md-2 offset-8 font-weight-bold">Total Units</div><div class="col-6 col-md-1 font-weight-bold text-center" id="total-units">'+totalUnits+'</div>');
                    },
                    error: function(data){

                    }
                })
                        
                $('#enroll-modal').modal('show');
            }
        })
    });
    $(document).on('click', '.caption-link', function(e){
        let file = $(this).attr('data-img');
        $('#enroll-document-img').attr('src',file);
        $('#enroll-document-viewer').modal('show');
    })
</script>