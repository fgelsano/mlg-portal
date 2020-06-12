<script>
    
    $(document).on('click', '#addInstructor', function(){
       $('#instructorForm')[0].reset();
       $('#instructorSave').html('<i class="fas fa-save"></i> Save');
       $('#instructorSave').attr('data-action','Save');
       $('#instructorTitle').html('<i class="fas fa-chalkboard-teacher"></i> New Instructor')
       $('#formMethod').val('');
       $('#alerts').addClass('d-none');
       $('#alerts').removeClass('d-block');
    });
    $(document).on('click', '.editInstructor', function(e){
        e.preventDefault();
        $('#alerts').addClass('d-none');
        $('#alerts').removeClass('d-block');
        let instructorId = $(this).attr('data-id');
        let routeUrl = "{{ route('instructors.edit','id') }}";
        let editUrl = routeUrl.replace('id', instructorId);
        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#instructorTitle').html('<i class="fas fa-chalkboard-teacher"></i> Edit Instructor');
                $('#last-name').val(data.last_name);
                $('#first-name').val(data.first_name);
                $('#middle-name').val(data.middle_name);
                
                let selectedStat = data.status;
                $('select#status option').each(function(){
                    if($(this).val() == selectedStat){
                        $(this).attr('selected','selected');
                    }
                });
                
                $('#alerts').addClass('d-none');
                $('#instructorSave').attr('data-action','Update');
                $('#instructorForm').attr('data-id',data.id);
                $('#instructorSave').html('<i class="fas fa-save"></i> Update');
                $('#formMethod').val('PUT');
                $('#instructor-modal').modal('show');
            }
        })
    });
</script>