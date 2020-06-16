<script>
    $('#instructorForm').on('submit',function(event){
        event.preventDefault();
        let action = $('#instructorSave').attr('data-action');
        
        if(action == 'Save'){
            console.log('Adding New Instructor');
            let form = $('#instructorForm')[0];
            let formData = new FormData(form);
            $.ajax({
                url: '{{ route("instructors.store") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    $('#instructor-modal').modal('hide');
                    $('#instructors').DataTable().ajax.reload();
                    alertify.success('Instructor Added!');
                },
                error: function(err){
                    console.log(err)
                        let error_html = '<ul class="text-left">';
                        for(let x = 0; x < err.responseJSON.length; x++){
                            error_html += '<li class="text-left">'+err.responseJSON[x]+'</li>';
                            if(x==err.responseJSON.length){
                                error_html += '</ul>';
                            }
                        }
                        alertify.error(error_html);
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
                    $('#alerts-message').html(data.success);
                    $('#instructor-modal').modal('hide');
                    $('#instructors').DataTable().ajax.reload();
                    alertify.success('Instructor Details Updated!');
                },
                error: function(err){
                    console.log(err)
                        let error_html = '<ul class="text-left">';
                        for(let x = 0; x < err.responseJSON.length; x++){
                            error_html += '<li class="text-left">'+err.responseJSON[x]+'</li>';
                            if(err.responseJSON.message){
                                error_html += err.responseJSON.message;
                            }
                            if(x==err.responseJSON.length){
                                error_html += '</ul>';
                            }
                        }
                        alertify.error(error_html);
                }
            });
        }
    });
</script>