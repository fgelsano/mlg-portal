{{-- Evaluate Admission --}}
<script>
    $(document).on('click', '#enrollAdmission', function(e){
        e.preventDefault();
        
        let id = $('#enrollAdmission').attr('data-id');
        $('#applicant-id').val(id);

        let form = $('#acceptForm')[0];
        let formData = new FormData(form);
        
        let routeUrl = "{{ route('requests.update','id') }}";

        let acceptUrl = routeUrl.replace('id', id);
        
        $.ajax({
            url: acceptUrl,
            type: 'POST',
            contentType: false,
            processData: false,
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){      
                $('#requests').DataTable().ajax.reload();
                $('#admission-modal').modal('hide');
                alertify.success('Request Accepted and now waiting for Cashier\'s cofirmation!');
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
    });
</script>