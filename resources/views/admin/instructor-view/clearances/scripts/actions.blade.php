<script>
    $('#selectAll').click( function () {
        $('input[type="checkbox"]').prop('checked', this.checked)
    });

    $('input[type="checkbox"]').change(function(){
        if(this.checked){
            $('.updateBtn').removeAttr('disabled');
            // $('#clearStatus').val(1).trigger('click');
            $('#clearStatus').show('slow');
        } else {
            // $('#btnClearStudents').attr('disabled','disabled');
            $('#clearStatus').val(0).trigger('click');
        }
    });

    $(document).on('click','.updateBtn',function(e){
        e.preventDefault();
        let action = $(this).attr('data-action');
        let checkBoxCount = $('input[type="checkbox"]:checked').length;
        let studentCount = '';
        let studentThis = '';
        if(checkBoxCount > 1){
            studentCount = 's';
            studentThis = 'hese'
        } else {
            studentCount = '';
            studentThis = 'his';
        }
        Swal.fire({
            title: action + ' Student'+studentCount,
            text: 'Are you sure you want to mark t'+ studentThis +' student'+ studentCount +' as '+ action +'d?',
            icon: 'question',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: '<i class="fas fa-check mr-2"></i>Yes, Go Ahead!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>No, Not Yet',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if(result.isConfirmed){
                let form = $('#clearStudents')[0];
                let formData = new FormData(form);
                
                formData.append('action',action);
                
                let routeUrl = "{{ route('clear-students.store') }}";

                $.ajax({
                    url: routeUrl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
                        location.reload();
                        Swal.fire({
                            title: 'Student'+studentCount + ' ' + action + '!',
                            icon: 'success'
                        })
                    },
                    error: function(err){
                        // console.log(err);
                        // alertify.error(err.responseJSON.status);
                    }
                });
            }
        })
    })

    $(document).on('click','.approveStudent',function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Clear Student',
            text: 'Are you sure you want to mark this student as cleared?',
            icon: 'question',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: '<i class="fas fa-check mr-2"></i>Yes, Go Ahead!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>No, Not Yet',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if(result.isConfirmed){
                let studentId = $(this).attr('data-student-id');
                let subjectId = $(this).attr('data-subject');

                let form = $('#clearStudents')[0];
                let formData = new FormData(form);

                formData.append('studentId',studentId);
                formData.append('subjectId',subjectId);
                formData.append('action','Clear');
                
                let routeUrl = "{{ route('clear-students.store') }}";

                $.ajax({
                    url: routeUrl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
                        location.reload();
                        Swal.fire({
                            title: 'Student Cleared!',
                            icon: 'success'
                        })
                    },
                    error: function(err){
                        // console.log(err);
                        // alertify.error(err.responseJSON.status);
                    }
                });
            }
        })
    })
</script>