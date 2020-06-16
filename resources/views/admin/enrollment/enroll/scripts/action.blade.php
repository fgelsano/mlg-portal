<script>
    let subject = [];
    function selectedSubject($id){
        subject.push($id);
        return subject;
    }

    $(document).on('click', '.enrollSubject', function(e){
        e.preventDefault();
        let subjectId = $(this).attr('data-id');
        let selectedSubjects = selectedSubject(subjectId);
        
        let routeUrl = "{{ route('subjects.pick','id') }}";
        let editUrl = routeUrl.replace('id', subjectId); 
        
        $(this).click(function(){
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex){
                    return $(table.row(dataIndex).node()).addClass('d-none');
                }
            );
            table.draw();
        })
        
        $.ajax({
            url: editUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                let code = data[0].code;
                let desc = data[0].description;
                let type = '';
                if(data[0].type == 0){
                    type = 'Room';
                } else {
                    type = 'Lab';
                }
                let sched = data[0].day+' '+data[0].time+' at '+type+' '+data[0].location;
                let instructor = data[0].instructor_name;

                if($('#empty-row').attr('data-stat') == 'empty'){
                    $('#enrolled-subjects').html('');
                    $('#enrolled-subjects').html('<tr><td>'+code+'</td><td>'+desc.substr(0,20)+'...'+'</td><td>'+sched+'</td><td>'+instructor+'</td><td><button class="removeSubject btn btn-sm btn-danger" data-id="'+subjectId+'"><i class="fas fa-trash"></i></button></td></tr>');
                    $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+data[0].id+'">');
                    $('#enrolled-subjects').attr('data-empty', '1');
                } else {
                    $('#enrolled-subjects').html($('#enrolled-subjects').html());
                    $('#enrolled-subjects').append('<tr><td>'+code+'</td><td>'+desc.substr(0,20)+'...'+'</td><td>'+sched+'</td><td>'+instructor+'</td><td><button class="removeSubject btn btn-sm btn-danger" data-id="'+subjectId+'"><i class="fas fa-trash"></i></button></td></tr>');
                    $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+data[0].id+'">');
                    $('#enrolled-subjects').attr('data-empty', '1');
                }

                $('.enrollSubject[data-id="'+subjectId+'"]').addClass('d-none');
                // $('#subjects-modal').modal('show');
            }
        })
    });

    $(document).on('click', '.removeSubject', function(){
       $(this).closest('tr').remove();
       let subjectId = $(this).attr('data-id');
       $('.enrollSubject[data-id="'+subjectId+'"]').removeClass('d-none'); 
    });
</script>