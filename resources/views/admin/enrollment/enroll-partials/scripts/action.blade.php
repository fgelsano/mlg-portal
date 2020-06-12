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

    $(document).on('click', '.enrollSubject', function(e){
        e.preventDefault();
        let subjectId = $(this).attr('data-id');

        let routeUrl = "{{ route('subjects.pick','id') }}";
        let editUrl = routeUrl.replace('id', subjectId); 
        
        $('input[name="enrolledSubject"]').val(subjectId);

        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                let code = data[0].code;
                let desc = data[0].description;
                let sched = data[0].schedule;
                let loc = data[0].location;
                let instructor = data[0].first_name+' '+data[0].last_name;
                if($('#empty-row').attr('data-stat') == 'empty'){
                    $('#enrolled-subjects').html('');
                    $('#enrolled-subjects').html('<tr><td>'+code+'</td><td>'+desc+'</td><td>'+loc+' ('+sched+')'+'</td><td>'+instructor+'</td><td><button class="removeSubject btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td></tr>');
                    $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+data[0].id+'">');
                    $('#enrolled-subjects').attr('data-empty', '1');
                } else {
                    $('#enrolled-subjects').html($('#enrolled-subjects').html());
                    $('#enrolled-subjects').append('<tr><td>'+code+'</td><td>'+desc+'</td><td>'+loc+' ('+sched+')'+'</td><td>'+instructor+'</td><td><button class="removeSubject btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td></tr>');
                    $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+data[0].id+'">');
                    $('#enrolled-subjects').attr('data-empty', '1');
                }
                
                $('#subjects-modal').modal('show');
            }
        })
    });

    $(document).on('click', '.removeSubject', function(){
       $(this).closest('tr').remove();

    });
</script>