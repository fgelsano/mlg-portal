<script>
    $('#enrollForm').on('submit', function(e){
        e.preventDefault();
        let action = $('#action').val();
        if(action == 'enroll'){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Confirm Enrollment?',
                text: "You are about to officially enroll an applicant. Are you sure?",
                icon: 'question',
                confirmButtonText: 'Yes, enroll',
                cancelButtonText: 'No, not yet',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if(result.value){
                    let form = $('#enrollForm')[0];
                    let formData = new FormData(form);
                    let totalUnits = $('#total-units').text();
                    formData.append('units',totalUnits);
                    formData.append('enrolledSubject',selectedSubjects);
                    $.ajax({
                        url: '{{ route("enroll.store") }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data){
                            $('#requests').DataTable().ajax.reload();
                            $('#enroll-modal').modal('hide');
                            Swal.fire({
                                title: 'Enrolled!',
                                text: 'Student is now successfully enrolled!',
                                icon: 'info',
                                footer: '<h2 class="text-center"><strong>'+data.profile.first_name+' '+data.profile.last_name+'</strong> <br>Student #: <span class="text-danger">'+data.profile.school_id+'</span></h2>'
                            })
                        },
                        error: function(err){
                            let error_html = '<ul class="text-left">';
                            $.each(err.responseJSON[0], function(key,existingSubject){
                                $.each(err.responseJSON[1], function(key, value){
                                    if(value.id == existingSubject){
                                        error_html += '<li class="">Student already has '+value.code+'</li>'
                                    }
                                })
                            })
                            error_html += '</ul>';
                            Swal.fire({
                                title: 'Subject/s Exists',
                                icon: 'error',
                                html: error_html
                            })
                        }
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $('#enroll-modal').modal('show');
                }
            })
        } else {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Edit Enrollment?',
                text: "Are you sure you want to edit this enrollment?",
                icon: 'question',
                confirmButtonText: 'Yes, Edit Now',
                cancelButtonText: 'No, Nevermind',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if(result.value){
                    let form = $('#enrollForm')[0];
                    let formData = new FormData(form);
                    let totalUnits = $('#total-units').text();
                    formData.append('units',totalUnits);
                    formData.append('enrolledSubject',selectedSubjects);
                    formData.append('removedSubjects',removedSubjects);
                    $.ajax({
                        url: '{{ route("enroll.store") }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data){
                            $('#requests').DataTable().ajax.reload();
                            $('#enroll-modal').modal('hide');
                            let enrolled = '';
                            if(data.enrolled.length > 0){
                                $.each(data.enrolled, function(key,enrolledSubject){
                                    $.each(data.subjects, function(key, subject){
                                        if(subject.id == enrolledSubject){
                                            enrolled += '<li class="text-left">'+subject.code+' ('+subject.description+') </li>';
                                        }
                                    })
                                })
                            } else {
                                enrolled = '<li class="text-left">None</li>';
                            }
                            let removed = '';
                            if(data.removed.length > 0){
                                $.each(data.removed, function(key, removedSubject){
                                    $.each(data.subjects, function(key, subject){
                                        if(subject.id == removedSubject){
                                            removed += '<li class="text-left">'+subject.code+' ('+subject.description+') </li>';
                                        }
                                    })
                                })
                            } else {
                                removed = '<li class="text-left">None</li>';
                            }
                            Swal.fire({
                                title: 'Enrollment Updated',
                                icon: 'info',
                                html: '<h4 class="mb-3">Enrollment for '+data.profile.first_name+' '+data.profile.last_name+' Updated</h4><h5 class="text-left bg-success p-1 text-white">Added:</h5 class="text-left"><ul>'+enrolled+'</ul>'+'<h5 class="text-left bg-danger p-1 text-white">Removed:</h5 class="text-left"><ul>'+removed+'</ul>'
                            })
                        },
                        error: function(err){
                            let error_html = '<ul class="text-left">';
                            $.each(err.responseJSON[0], function(key,existingSubject){
                                $.each(err.responseJSON[1], function(key, value){
                                    if(value.id == existingSubject){
                                        error_html += '<li class="">Student already has '+value.code+'</li>'
                                    }
                                })
                            })
                            error_html += '</ul>';
                            Swal.fire({
                                title: 'Subject/s Exists',
                                icon: 'error',
                                html: error_html
                            })
                        }
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $('#enroll-modal').modal('show');
                }
            })
        }
    })
</script>