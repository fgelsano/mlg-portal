<script>
    $(document).ready(function(){
        getOptionsList();
    })
    $(document).on('click', '#addSubject', function(e){
        e.preventDefault();
        $('#subjectForm')[0].reset();
        $('#subjectSave').html('<i class="fas fa-save"></i> Save');
        $('#subjectSave').attr('data-action','Save');
        $('#subjectTitle').html('<i class="fas fa-book"></i> New Subject')
        $('#formMethod').val('');
        $('#alerts').addClass('d-none');
        $('#alerts').removeClass('d-block');        
        $('#subjects-modal').modal('show');
    });

    
    $(document).on('click', '.editSubject', function(e){
        e.preventDefault();
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
                console.log('Edit Subject');
                console.log(data);
                fillSelectedItem(data);
                
                $('#code').val(data.code);
                $('#description').val(data.description);
                $('#url').val(data.url);

                $('#subjectForm').attr('data-id',data.id);

                $('#subjectTitle').html('<i class="fas fa-book"></i> Edit Subject');
                $('#subjectSave').html('<i class="fas fa-save"></i> Update');
                $('#subjectSave').attr('data-action','Update');
                $('#formMethod').val('PUT');

                $('#subjects-modal').modal('show');
            }
        })
    });

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

                let categories = '<option selected disabled>Subject Category</option>';
                $.each(data.subjectDetails,function(key,value){
                    if(value.type == 'subject-category'){
                        categories = categories + '<option value="'+value.id+'">'+value.name+'</option>';
                    }
                });
                $('#category').html(categories);

                let schedules = '<option selected disabled>Schedule</option>';
                $.each(data.schedules,function(key,value){
                    let locType = '';
                    if(value.type == 0){
                        locType = 'Room';
                    } else if(value.type == 1){
                        locType = 'Lab';
                    } else {
                        locType = 'Home';
                    }
                    schedules = schedules + '<option value="'+value.id+'">'+value.day+', '+locType+' '+value.location+' ('+value.time+')</option>';
                });
                $('#schedule').html(schedules);

                let ay = '<option selected disabled>School Year</option>';
                $.each(data.subjectDetails,function(key,value){
                    if(value.type == 'ay'){
                        ay = ay + '<option value="'+value.id+'">'+value.name+'</option>';
                    }            
                })

                $('#ay').html(ay);
                $('#sem').html('<option value="" disabled selected>Semester</option><option value="0">Summer</option><option value="1">First Semester</option><option value="2">Second Semester</option>');
                $('#subject-type').html('<option value="" disabled selected>Subject Type</option><option value="0">Lecture</option><option value="1">Lab</option>');

                $('#instructorSave').attr('data-action','Update');
                $('#instructorForm').attr('data-id',data.id);
                $('#instructorSave').html('<i class="fas fa-save"></i> Update');
                $('#formMethod').val('');
            }
        })
    }

    function fillSelectedItem(data){
        let selectedCategory = data.category;
        $('select#category option').each(function(){
            if($(this).val() == selectedCategory){
                $(this).attr('selected','selected');
                console.log('Selected Category: '+$(this).text());
            }
        });

        let selectedInstructor = data.instructor;
        $('select#instructor option').each(function(){
            if($(this).val() == selectedInstructor){
                $(this).attr('selected','selected');
            }
        });

        let selectedSchedule = data.schedule;
        $('select#schedule option').each(function(){
            if($(this).val() == selectedSchedule){
                $(this).attr('selected','selected');
            }
        });

        let selectedSY = data.academic_year;
        $('select#ay option').each(function(){
            if($(this).val() == selectedSY){
                $(this).attr('selected','selected');
            }
        });

        let selectedSem = data.semester;
        $('select#sem option').each(function(){
            if($(this).val() == selectedSem){
                $(this).attr('selected','selected');
            }
        });

        let selectedSubType = data.type;
        $('select#subject-type option').each(function(){
            if($(this).val() == selectedSubType){
                $(this).attr('selected','selected');
            }
        });

        $('#units').val(data.units);
    }
</script>