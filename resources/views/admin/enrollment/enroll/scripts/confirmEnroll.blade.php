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
                    $.ajax({
                        url: '{{ route("enroll.store") }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data){
                            console.log(data)
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
                            console.log(err)
                            let error_html = '<ul class="text-left">';
                            for(let x = 0; x < err.responseJSON.error.length; x++){
                                error_html += '<li class="text-left">'+err.responseJSON[x]+'</li>';
                                if(x==err.responseJSON.length){
                                    error_html += '</ul>';
                                }
                            }
                            // toastr["error"](error_html);
                            alertify.error(error_html);
                        }
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    $('#enroll-modal').modal('show');
                }
            })
        } else {
            console.log('Update Enrollment');
        }
    })
</script>