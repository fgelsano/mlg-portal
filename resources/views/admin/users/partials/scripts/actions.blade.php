<script>
    // Initialize Dropify
    $('.dropify').dropify();

    $(document).on('click', '#addUser', function(e){
        e.preventDefault();
        $('#userForm')[0].reset();
        $('#userSave').attr('data-action','save');
        $('#userSave').html('<i class="fas fa-save"></i> Save');
        $('#userTitle').html('<i class="fas fa-user"></i> New User');

        let imageUrl = '';
        initDropify(imageUrl);

        $('#users-modal').modal('show');
        $('#users-modal').modal('show');
    });
    
    $(document).on('click', '.editUser', function(e){
        e.preventDefault();
        
        let userId = $(this).attr('data-id');
        let routeUrl = "{{ route('users.show','id') }}";
        let editUrl = routeUrl.replace('id', userId);
        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                console.log(data);
                $('#userTitle').html('<i class="fas fa-user"></i> Edit User');

                let image = data.user.profile_pic == 'none' ? 'empty-profile-img.png' : data.user.profile_pic;
                let imageUrl = '{{ asset("storage/uploads/applicant-img") }}'+'/'+image;
                initDropify(imageUrl);

                $('#first-name').val(data.user.first_name);
                $('#last-name').val(data.user.last_name);
                $('#user-email').val(data.user.email);

                let selectedRole = data.user.role;
                $('select#user-role option').each(function(){
                    if($(this).val() == selectedRole){
                        $(this).attr('selected','selected');
                    }
                });

                $('#userSave').attr('data-action','update');
                $('#userForm').attr('data-id',data.user.id);
                $('#userSave').html('<i class="fas fa-save"></i> Update');

                $('#users-modal').modal('show');
            }
        })
    });

    $(document).on('submit','#userForm',function(e){
        e.preventDefault();
        let method = '';
        let action = $('#userSave').attr('data-action');
        if(action == 'save'){
            method = 'POST';
            let form = $('#userForm')[0];
            let formData = new FormData(form);
            formData.append('_method',method);
            formData.append('user-email',$('#user-email').val());

            let routeUrl = "{{ route('users.store') }}";

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    $('#users-modal').modal('hide');
                    $('#users').DataTable().ajax.reload();
                    alertify.success(data.success);
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
        if(action == 'update'){
            method = 'PUT';
            let userId = $('#userForm').attr('data-id');
            let form = $('#userForm')[0];
            let formData = new FormData(form);
            formData.append('_method',method);
            formData.append('user-id',userId);
            formData.append('user-email',$('#user-email').val());

            let routeUrl = "{{ route('users.update','id') }}";
            let editUrl = routeUrl.replace('id', userId);

            $.ajax({
                url: editUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    $('#users-modal').modal('hide');
                    $('#users').DataTable().ajax.reload();
                    alertify.success(data.success);
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
    })

    function initDropify(image){
        let dropify = $('.dropify').dropify({
            defaultFile: image
        });
        dropifyEvent = dropify.data('dropify');
        dropifyEvent.resetPreview();
        dropifyEvent.clearElement();
        dropifyEvent.settings.defaultFile = image;
        dropifyEvent.destroy();
        dropifyEvent.init();
    }

    let firstName = '';
    let lastName = '';
    $(document).on('keyup','#first-name',function(){
        if($('#userSave').attr('data-action') == 'save'){
            let getfirstName = $('#first-name').val();
            firstName = getfirstName.toLowerCase().replace(/\s/g,'.');

            let firstLetter = firstName.split('.');
            let getFirstLetters = '';
            $.each(firstLetter, function(key, value){
                getFirstLetters = getFirstLetters+value.substring(0,1);
                firstName = getFirstLetters;
                $('#user-email').val(firstName+'.'+lastName+'@mlgcl.edu.ph');
            })
        }
    })
    
    $(document).on('keyup','#last-name',function(){
        if($('#userSave').attr('data-action') == 'save'){
            let getLastName = $('#last-name').val();
            lastName = getLastName.toLowerCase().replace(/\s/g,'.');
            $('#user-email').val(firstName+'.'+lastName+'@mlgcl.edu.ph');
        }
    })
</script>