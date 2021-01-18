<script>
    $(document).on('click','.editSubject', function(e){
        e.preventDefault();
        let subjectId = $(this).attr('data-id');

        let route = "{{ route('subjects.edit','id') }}";
        let subjectkUrl = route.replace('id',subjectId);

        $.ajax({
            url: subjectkUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#code').text(data.code);
                $('#description').text(data.description);
                let locationType = '';
                if(data.locationType == 0){
                    locationType = 'Room ';
                } else if(data.locationType == 1){
                    locationType = 'Lab ';
                } else if(data.locationType == 2){
                    locationType = 'House ';
                }
                
                $('#schedule').text(data.day+' ('+data.time+' - '+locationType+data.location+')');
                $('#subject-link').val(data.url);
                $('select#status option').each(function(){
                    if($(this).val() == data.status){
                        $(this).attr('selected','selected');
                    }
                })
                $('#editSubjectForm').attr('data-id',subjectId);
            }
        })
    })
    $(document).on('click','#updateSubject',function(e){
        e.preventDefault();
        let subjectId = $('#editSubjectForm').attr('data-id');
    
        let form = $('#editSubjectForm')[0];
        let formData = new FormData(form);
        formData.append('status',$('#status').val());
        
        let routeUrl = "{{ route('instructorSubject.update','id') }}";
        let editSubjectUrl = routeUrl.replace('id', subjectId);

        let route = "{{ route('instructor-subjects.show','id') }}";
        let redirectUrl = route.replace('id',"{{ Auth::user()->profile_id }}");
        $.ajax({
            url: editSubjectUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                Swal.fire({
                    title: 'Subject Updated',
                    icon: 'success'
                }).then(function(){
                    window.location.href = redirectUrl;
                })
            },
            error: function(err){
                console.log(err);
                alertify.error(err.responseJSON.error);
            }
        });
    })
</script>