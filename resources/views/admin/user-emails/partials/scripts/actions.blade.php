<script>
    $(document).on('click','.createUserEmail', function(e){
        e.preventDefault();
        $('#userEmailForm')[0].reset();
        let userId = $(this).attr('data-id');

        let route = "{{ route('userEmails.show','id') }}";
        let userEmailUrl = route.replace('id',userId);

        $.ajax({
            url: userEmailUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                let user_name = data.user.first_name + ' ' + data.user.last_name;
                $('#formMethod').val('Add');
                $('#user-name').text(user_name);
                $('#userEmailTitle').text(user_name);
                $('#modal-action').text('Add');
                $('#user-role').text(data.user.role);
                $('#suggested_email').val(data.user.suggested_email);
                $('#suggested_email').attr('disabled','disabled');
                $('#user_id').val(data.user.user_id);
                $('#formMethod').val('');
                $('#saveUserEmail').html('<i class="fas fa-save"></i> Save');
                $('#user-email-modal').modal('show');
            }
        })
    })
    $(document).on('submit','#userEmailForm',function(e){
        e.preventDefault();
        let form = $('#userEmailForm')[0];
        let formData = new FormData(form);
        
        if($('#formMethod').val() == 'PUT')
            let userId = $('#userEmailForm').attr('data-id');
            let url = "{{ route('userEmails.update','id') }}";
            let routeUrl = url.replace('id',userId);
        } else {
            alert('POST');
            let routeUrl = "{{ route('userEmails.store') }}";
        }

        $.ajax({
            url: routeUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                console.log(data);
                $('#userEmails').DataTable().ajax.reload();
                $('#user-email-modal').modal('hide');
                Swal.fire({
                    title: data.success,
                    icon: 'success'
                })
            },
            error: function(err){
                // console.log(err);
                // alertify.error(err.responseJSON.status);
            }
        });
    })
    $(document).on('click','.editUserEmail', function(e){
        e.preventDefault();
        $('#request-loading').removeClass('d-none');
        let userId = $(this).attr('data-id');
        
        let route = "{{ route('userEmails.edit','id') }}";
        let userEmailUrl = route.replace('id',userId);

        $.ajax({
            url: userEmailUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                let user_name = data.user.first_name + ' ' + data.user.last_name;
                $('#formMethod').val('Edit');
                $('#user-name').text(user_name);
                $('#userEmailTitle').text(user_name);
                $('#modal-action').text('Edit');
                $('#user-role').text(data.user.role);
                $('#suggested_email').val(data.user.suggested_email);
                $('#suggested_email').attr('disabled','disabled');
                $('#created_email').val(data.user.user_email);
                $('#email_password').val(data.user.email_password);
                $('#lms_password').val(data.user.lms_password);
                $('#user_id').val(data.user.user_id);
                $('#formMethod').val('PUT');
                $('#userEmailForm').attr('data-id',data.user.user_id);
                $('#saveUserEmail').html('<i class="fas fa-save"></i> Update');
                $('#request-loading').addClass('d-none');
                $('#user-email-modal').modal('show');
            }
        })
    })
</script>