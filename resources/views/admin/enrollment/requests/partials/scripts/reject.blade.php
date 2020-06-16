{{-- Evaluate Admission --}}
{{-- <script>
    $(document).on('click', '#rejectAdmission', function(e){
        e.preventDefault();
        alertify.confirm()
        .setting({
            'title':'Rejecting Admission',
            'message': 'Are you sure you want to reject this request?',
            'onok': function(){
                alertify.prompt("Rejecting Request","Please enter a reject reason.", "Reject Reason",
                function(evt, value ){
                    let form = $('#admission-form')[0];
                    let formData = new FormData(form);
                    let admissionId = $('#rejectAdmission').attr('data-id');
                    let routeUrl = "{{ route('requests.update','id') }}";
                    let rejectUrl = routeUrl.replace('id', admissionId);
                    let method = 'PUT';
                    let action = 'Reject';
                    formData.append('rejectReason',value);
                    formData.append('_method', method);
                    formData.append('buttonAction', action);
                    $.ajax({
                        url: rejectUrl,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data){
                            $('#admission-modal').modal('hide');
                            $('#requests').DataTable().ajax.reload();
                        }
                    })
                    alertify.success('Application rejected because of ' + value);
                },
                function(){
                    $('#admission-modal').modal('show');
                });
            },
            'oncancel': function(){
                $('#admission-modal').modal('show');
            }
        }).show();
    });
</script> --}}

<script>
    $(document).on('click', '#rejectAdmission', function(e){
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-success mr-3'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Reject this Request?',
            text: "Are you sure you want to reject this request?",
            icon: 'question',
            confirmButtonText: 'Yes, reject',
            cancelButtonText: 'No, go back',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            reverseButtons: true
        }).then((result) => {
            if(result.value){
                Swal.fire({
                    html: '<textarea id="reject-reason" placeholder="Type your reject reason here..." rows="10"></textarea>',
                    title: 'Please type reject reason',
                    icon: 'info',
                    showCancelButton: true,
                    preConfirm: () => {
                        let rejectReason = $('#reject-reason').val();
                        let form = $('#admission-form')[0];
                        let formData = new FormData(form);
                        let admissionId = $('#rejectAdmission').attr('data-id');
                        let routeUrl = "{{ route('requests.update','id') }}";
                        let rejectUrl = routeUrl.replace('id', admissionId);
                        let method = 'PUT';
                        let action = 'Reject';
                        formData.append('rejectReason',rejectReason);
                        formData.append('_method', method);
                        formData.append('buttonAction', action);
                        $.ajax({
                            url: rejectUrl,
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data){
                                $('#admission-modal').modal('hide');
                                $('#requests').DataTable().ajax.reload();
                            }
                        })
                        alertify.success('Application rejected because of \"' + rejectReason + '\"');
                    }
                })
                
            } else {

            }
        })
    })
</script>