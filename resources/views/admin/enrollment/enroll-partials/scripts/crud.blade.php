<script>
    $('#enrollForm').on('submit',function(event){
        event.preventDefault();
        let action = $('#confirmedEnroll').attr('data-action');
        let id = $('#confirmedEnroll').attr('data-id');
        let form = $('#enrollForm')[0];
        let formData = new FormData(form);
        
        let subjects = $('#enrolled-subjects').attr('data-empty');  

        if(subjects == '0'){
            alertify.alert('No Subject selected!','Please select at least 1 subject.');
        } else {
            
            if(action == 'Save'){
                console.log('Adding New Enrollee');
                $.ajax({
                    url: '{{ route("enroll.store") }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
                        $('#enrol-modal').modal('hide');
                        $('#requests').DataTable().ajax.reload();
                        alertify.success(data.success)
                    }
                });
            } else {
                console.log('Updating Instructor');
                let form = $('#instructorForm')[0];
                let formData = new FormData(form);

                let instructorId = $(this).attr('data-id');
                
                let routeUrl = "{{ route('instructors.update','id') }}";
                let editUrl = routeUrl.replace('id', instructorId);

                $.ajax({
                    url: editUrl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
                        if(data.error.length > 0){
                            let error_html = '';
                            for(let x = 0; x < data.error.length; x++){
                                error_html += '<p class="m-0">'+data.error[x]+'</p>';
                            }
                            $('#alerts').removeClass('d-none');
                            $('#alerts').addClass('d-block');
                            $('#alerts').addClass('alert-danger');
                            $('#alerts').removeClass('alert-success')
                            $('#alert-title').text('Error:')
                            $('#alerts-message').html(error_html);
                        } else {
                            $('#alerts').addClass('d-block');
                            $('#alerts').removeClass('d-none');
                            $('#alerts').removeClass('alert-danger');
                            $('#alerts').addClass('alert-success');
                            $('#alert-title').text('Success:')
                            $('#alerts-message').html(data.success);
                            $('#instructors').DataTable().ajax.reload();
                        }
                    }
                });
            }

        }
    });
</script>