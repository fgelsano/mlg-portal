{{-- Evaluate Admission --}}
<script>
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
</script>