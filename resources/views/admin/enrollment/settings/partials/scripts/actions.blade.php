<script>
    $(document).on('click', '#addOption', function(e){
        e.preventDefault();
        $('#alerts').addClass('d-none');
        $('#alerts').removeClass('d-block');
        $('#optionForm')[0].reset();
        $('#optionTitle').html('<i class="fas fa-list"></i> New Option');
        $('#formMethod').val('');
        
        $('#optionSave').html('<i class="fas fa-save"></i> Save');
        $('#optionSave').attr('data-action','Save');
    });
    
    $(document).on('click', '.editOption', function(e){
        e.preventDefault();
        $('#alerts').addClass('d-none');
        $('#alerts').removeClass('d-block');
        let optionId = $(this).attr('data-id');
        let routeUrl = "{{ route('options.edit','id') }}";
        let editUrl = routeUrl.replace('id', optionId);
        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#optionTitle').html('<i class="fas fa-list"></i> Edit Option');

                $('#name').val(data.name);
                $('#type').val(data.type);
                $('#extra').val(data.extra);
                
                $('#alerts').addClass('d-none');
                $('#optionSave').attr('data-action','Update');
                $('#optionForm').attr('data-id',data.id);
                $('#optionSave').html('<i class="fas fa-save"></i> Update');
                $('#formMethod').val('PUT');
                $('#options-modal').modal('show');
            }
        })
    });
</script>