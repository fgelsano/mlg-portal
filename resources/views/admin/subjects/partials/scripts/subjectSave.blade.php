<script>
    $('#subjectForm').on('submit',function(event){
        event.preventDefault();
        let action = $('#subjectSave').attr('data-action');
        
        if(action == 'Save'){
            console.log('Adding New Subject');
            let form = $('#subjectForm')[0];
            let formData = new FormData(form);
            $.ajax({
                url: '{{ route("subjects.store") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    $('#subjects').DataTable().ajax.reload();
                    $('#subjects-modal').modal('hide');
                    alertify.success('Subject Added!')
                },
                error: function(err){
                    console.log(err)
                    let error_html = '<ul class="text-left">';
                    for(let x = 0; x < err.responseJSON.error.length; x++){
                        error_html += '<li class="text-left">'+err.responseJSON.error[x]+'</li>';
                        if(x==err.responseJSON.error.length){
                            error_html += '</ul>';
                        }
                    }
                    // toastr["error"](error_html);
                    alertify.error(error_html);
                }
            });
        } else {
            console.log('Updating Subjects');
            let form = $('#subjectForm')[0];
            let formData = new FormData(form);

            let instructorId = $(this).attr('data-id');
            
            let routeUrl = "{{ route('subjects.update','id') }}";
            let editUrl = routeUrl.replace('id', instructorId);

            $.ajax({
                url: editUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    $('#subjects').DataTable().ajax.reload();
                    $('#subjects-modal').modal('hide');
                    alertify.success('Subject Updated!')
                },
                error: function(err){
                    console.log(err)
                    let error_html = '<ul class="text-left">';
                    for(let x = 0; x < err.responseJSON.error.length; x++){
                        error_html += '<li class="text-left">'+err.responseJSON.error[x]+'</li>';
                        if(x==err.responseJSON.error.length){
                            error_html += '</ul>';
                        }
                    }
                    alertify.error(error_html);
                }
            });
        }
    });
</script>