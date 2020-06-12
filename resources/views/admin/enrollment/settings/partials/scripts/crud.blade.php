<script>
    $('#optionForm').on('submit',function(event){
        event.preventDefault();
        let action = $('#optionSave').attr('data-action');
        console.log(action);
        if(action == 'Save'){
            console.log('Adding New Option');
            let form = $('#optionForm')[0];
            let formData = new FormData(form);
            $.ajax({
                url: '{{ route("options.store") }}',
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
                        $('#alerts').addClass('d-none');
                        $('#alerts').removeClass('alert-danger');
                        $('#optionForm')[0].reset();
                        $('#options').DataTable().ajax.reload();
                        $('#options-modal').modal('hide');
                        alertify.success(data.success)
                    }
                }
            });
        } else {
            console.log('Updating Option');
            let form = $('#optionForm')[0];
            let formData = new FormData(form);

            let optionId = $(this).attr('data-id');
            
            let routeUrl = "{{ route('options.update','id') }}";
            let editUrl = routeUrl.replace('id', optionId);

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
                        $('#options').DataTable().ajax.reload();
                    }
                }
            });
        }
    });
</script>