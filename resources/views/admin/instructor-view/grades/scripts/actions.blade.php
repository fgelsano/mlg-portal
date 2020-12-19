<script>
    $(document).on('click','#saveGrades',function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Submit Grade/s',
            text: 'Are you sure you want to submit grade/s',
            icon: 'question',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: '<i class="fas fa-check mr-2"></i>Yes, Go Ahead!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>No, Not Yet',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if(result.isConfirmed){
                let form = $('#grades')[0];
                let formData = new FormData(form);
                let subjectId = $('#grades').attr('data-subject');

                formData.append('subjectId',subjectId);
                
                let routeUrl = "{{ route('instructor-grades.store') }}";
                // let routeUrl = url.replace('id', subjectId);

                $.ajax({
                    url: routeUrl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
                        Swal.fire({
                            title: 'Grade/s Submitted!',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
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

    $(document).on('click','.btnEditGrade',function(e){
        e.preventDefault();
        let id = $(this).attr('data-grade-id');
        $('#'+id).attr('type','text');
        $('#grade-'+id).hide();
        $('.btnEditGrade').hide();
        $(this).hide();
        $('.'+id).removeClass('d-none');
        $('.btnCancelEdit-'+id).removeClass('d-none');
    })

    $(document).on('click','.btnCancelEdit',function(e){
        e.preventDefault();
        let id = $(this).attr('data-grade-id');
        $('#'+id).attr('type','hidden');
        $('#grade-'+id).show();
        $('.btnEditGrade').show();
        $(this).hide();
        $('.'+id).addClass('d-none');
    })

    $(document).on('click','.btnUpdateGrade',function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Update Grade?',
            text: 'Are you sure you want to change this student\'s grade?',
            icon: 'question',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: '<i class="fas fa-check mr-2"></i>Yes, Go Ahead!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>No, Not Yet',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if(result.isConfirmed){
                let id = $(this).attr('data-grade-id');
                let gradeId = $('#'+id).attr('id');
                let grade = $('#'+id).val();

                let formData = new FormData();

                formData.append('gradeId',gradeId);
                formData.append('grade',grade);

                let method = 'PUT';
                formData.append('_method',method);

                let url = "{{ route('instructor-grades.update','id') }}";
                let routeUrl = url.replace('id', id);

                $.ajax({
                    url: routeUrl,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data){
                        Swal.fire({
                            title: 'Grade Updated!',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        })
                    },
                    error: function(err){
                        Swal.fire({
                            title: 'Oops, something went wrong.',
                            icon: 'error'
                        })
                    }
                });
            }
        });
    })

    // Initialize Dropify
    $('.dropify').dropify();
</script>