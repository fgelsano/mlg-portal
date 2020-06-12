<script>
    $(document).on('click', '#addSubject', function(e){
        e.preventDefault();
        $('#subjectForm')[0].reset();
        $('#subjectSave').html('<i class="fas fa-save"></i> Save');
        $('#subjectSave').attr('data-action','Save');
        $('#subjectTitle').html('<i class="fas fa-book"></i> New Subject')
        $('#formMethod').val('');
        $('#alerts').addClass('d-none');
        $('#alerts').removeClass('d-block');

        getOptionsList();
    });

    
    $(document).on('click', '.editSubject', function(e){
        e.preventDefault();
        $('#alerts').addClass('d-none');
        $('#alerts').removeClass('d-block');
        getOptionsList()
        let subjectId = $(this).attr('data-id');
        let routeUrl = "{{ route('subjects.edit','id') }}";
        let editUrl = routeUrl.replace('id', subjectId);
        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                fillSelectedItem(data);
                
                $('#subjectTitle').html('<i class="fas fa-book"></i> Edit Subject');
                
                $('#code').val(data.code);
                $('#description').val(data.description);

                $('#alerts').addClass('d-none');
                $('#subjectSave').attr('data-action','Update');
                $('#subjectForm').attr('data-id',data.id);
                $('#subjectSave').html('<i class="fas fa-save"></i> Update');
                $('#formMethod').val('PUT');

                $('#subjects-modal').modal('show');
            }
        })
    });

    function fillDropBoxes(data){
        let categories = '<option selected disabled>Subject Category</option>';
        $.each(data.categories,function(key,value){
            categories = categories + '<option value="'+value.id+'">'+value.name+'</option>';
        });
        $('#category').html(categories);

        let roomsLabs = '<option selected disabled>Classroom or Labs</option>';
        $.each(data.roomslabs,function(key,value){
            roomsLabs = roomsLabs + '<option value="'+value.id+'">'+value.name+'</option>';
        });
        $('#room-lab').html(roomsLabs);

        let schedules = '<option selected disabled>Schedule</option>';
        $.each(data.schedules,function(key,value){
            schedules = schedules + '<option value="'+value.id+'">'+value.schedule+'</option>';
        });
        $('#schedule').html(schedules);

        let sy = '<option selected disabled>School Year</option>';
        $.each(data.sy,function(key,value){
            sy = sy + '<option value="'+value.id+'">'+value.name+'</option>';
        })
        $('#sy').html(sy);

        $('#sem').html('<option selected disabled>Semester</option><option value="1">First Semester</option><option value="2">Second Semester</option>');
    }

    function getOptionsList(){
        let listUrl = "{{ route('options.lists') }}";
        
        $.ajax({
            url: listUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                let instructors = '<option selected disabled>Instructor</option>';
                $.each(data.instructors,function(key,value){
                    instructors = instructors + '<option value="'+value.id+'">'+value.first_name+' '+value.last_name+'</option>';
                });
                $('#instructor').html(instructors);

                fillDropBoxes(data);
                
                $('#subjectTitle').html('<i class="fas fa-book"></i> Add Subject');
                $('#alerts').addClass('d-none');
                $('#instructorSave').attr('data-action','Update');
                $('#instructorForm').attr('data-id',data.id);
                $('#instructorSave').html('<i class="fas fa-save"></i> Update');
                $('#formMethod').val('');
                $('#subjects-modal').modal('show');
            }
        })
    }

    function fillSelectedItem(data){
        let selectedCategory = data.category;
        $('select#category option').each(function(){
            if($(this).val() == selectedCategory){
                $(this).attr('selected','selected');
            }
        });

        let selectedInstructor = data.instructor;
        $('select#instructor option').each(function(){
            if($(this).val() == selectedInstructor){
                $(this).attr('selected','selected');
            }
        });

        let selectedLocation = data.location;
        $('select#room-lab option').each(function(){
            if($(this).val() == selectedLocation){
                $(this).attr('selected','selected');
            }
        });

        let selectedSchedule = data.schedules;
        $('select#schedule option').each(function(){
            if($(this).val() == selectedSchedule){
                $(this).attr('selected','selected');
            }
        });

        let selectedSY = data.sy;
        $('select#sy option').each(function(){
            if($(this).val() == selectedSY){
                $(this).attr('selected','selected');
            }
        });

        let selectedSem = data.sem;
        $('select#sem option').each(function(){
            if($(this).val() == selectedSem){
                $(this).attr('selected','selected');
            }
        });
    }
</script>