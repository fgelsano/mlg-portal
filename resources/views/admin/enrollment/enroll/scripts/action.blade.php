<script>
    let selectedSubjects = [];
    let totalUnits = Number('0');
    $(document).on('click', '.enrollSubject', function(e){
        e.preventDefault();
        let subjectId = $(this).attr('data-id');
        
        let routeUrl = "{{ route('subjects.pick','id') }}";
        let editUrl = routeUrl.replace('id', subjectId); 
        let table = $('#enroll-subjects').DataTable();       
        
        if(selectedSubjects.includes(subjectId) == true){
            Swal.fire({
                title: 'You have already added this subject.',
                icon: 'error'
            })
        } else {
            selectedSubjects.push(subjectId);
            
            $.ajax({
                url: editUrl,
                type: 'GET',
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    let code = data[0].code;
                    let desc = data[0].description;
                    let units = data[0].units;
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
                        $('#enrolled-subjects').html('<tr class="addedSubject"><td>'+code+'</td><td>'+desc.substr(0,20)+'...'+'</td><td>'+sched+'</td><td>'+instructor+'</td><td class="text-center">'+units+'</td><td><button class="removeSubject btn btn-sm btn-danger" data-units="'+units+'" data-id="'+subjectId+'"><i class="fas fa-trash"></i></button></td></tr>');
                        $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+subjectId+'">');
                        $('#enrolled-subjects').attr('data-empty', '1');
                    } else {
                        $('#enrolled-subjects').html($('#enrolled-subjects').html());
                        $('#enrolled-subjects').append('<tr class="addedSubject"><td>'+code+'</td><td>'+desc.substr(0,20)+'...'+'</td><td>'+sched+'</td><td>'+instructor+'</td><td class="text-center">'+units+'</td><td><button class="removeSubject btn btn-sm btn-danger" data-units="'+units+'" data-id="'+subjectId+'"><i class="fas fa-trash"></i></button></td></tr>');
                        $('#enrolled-subjects').append('<input type="hidden" name="enrolledSubject[]" value="'+subjectId+'">');
                        $('#enrolled-subjects').attr('data-empty', '1');
                    }
                    let unit = Number(units);
                    totalUnits = totalUnits + unit;
                    $('#total').html('<div class="col-6 col-md-2 offset-8 font-weight-bold">Total Units</div><div class="col-6 col-md-1 font-weight-bold text-center" id="total-units">'+totalUnits+'</div>');
                }
            })
        }
    });

    $(document).on('click', '.removeSubject', function(){
        $(this).closest('tr').remove();
        let subjectId = $(this).attr('data-id');
        let addedSubject = $('#enrolled-subjects').find('.addedSubject');
        if(addedSubject.length == 0){
            $('#enrolled-subjects').append('<tr class="table-danger text-center text-white" id="empty-row" data-stat="empty"><td colspan="7">No Enrolled Subject</td></tr>');
        }

        let subjectUnit = $(this).attr('data-units');
        totalUnits = totalUnits - Number(subjectUnit);
        $('#total-units').text(totalUnits);

        selectedSubjects = jQuery.grep(selectedSubjects, function(value){
            return value != subjectId;
        })
    });
</script>