<script>
    $(document).on('click', '.makePayment', function(e){
        e.preventDefault();
        $('#paymentForm')[0].reset();
        let studentId = $(this).attr('data-id');
        
        let routeUrl = "{{ route('payments.show','id') }}";
        let getStudentUrl = routeUrl.replace('id', studentId);
        $.ajax({
            url: getStudentUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){                
                let applicantOrStudent = 'Student';
                if(data.student.school_id == 0){
                    applicantOrStudent = 'Applicant';
                }

                $('#applicant-student').text(applicantOrStudent);

                let studentId = data.student.school_id;
                if(applicantOrStudent == 'Applicant'){
                    studentId = data.student.profile_id;
                }

                $('#student-id').text(studentId);
                $('#student-name').text(data.student.first_name + ' ' + data.student.middle_name + ' ' +data.student.last_name);

                let selectedCourse = '';
                $.each(data.courses, function(key,value){
                    if(value.id == data.student.course){
                        selectedCourse = value.code;
                    }
                })
                $('#course-code').text(selectedCourse);

                let yearLevels = ['1st Year','2nd Year','3rd Year','4th Year'];
                $('#year-level').text(yearLevels[data.student.year_level-1]);
                $('#balance').val(data.student.balance);
                $('#previous-balance').val(data.student.balance);
                $('#comments').html(data.student.others);
                $('#acceptPayment').attr('data-id',studentId);
                
                $('#payment-id').val(data.student.id); // id = payment.id

                $('#payment-modal').modal('show');
            }
        })
    })

    $(document).on('click', '#acceptPayment', function(e){
        e.preventDefault();

        let studentId = $(this).attr('data-id');
        
        let form = $('#paymentForm')[0];
        let formData = new FormData(form);
        
        let routeUrl = "{{ route('payments.update','id') }}";
        let paymentUrl = routeUrl.replace('id', studentId);

        $.ajax({
            url: paymentUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                $('#payment-modal').modal('hide');
                $('#payments').DataTable().ajax.reload();
                alertify.success('Payment Accepted!');
                
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger mr-3'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Payment Accepted',
                    text: "Do you want to print payment confirmation?",
                    icon: 'question',
                    confirmButtonText: 'Yes, Print Confirmation',
                    cancelButtonText: 'No, Don\'t Mind',
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if(result.value){
                        let confirmationUrl = "{{ route('confirmation.print','id') }}";
                        let redirectUrl = confirmationUrl.replace('id',data.data.id);
                        window.open(redirectUrl,'blank');
                    } 
                })
            },
            error: function(err){
                let error_html = '<ul class="text-left">';
                for(let x = 0; x < err.responseJSON.error.length; x++){
                    error_html += '<li class="text-left">'+err.responseJSON.error[x]+'</li>';
                    if(x==err.responseJSON.error.length){
                        error_html += '</ul>';
                    }
                }
                // toastr["error"](error_html);
                alertify.error(error_html);
            }
        });
    })

    $(document).on('click', '.acceptAdmission', function(e){
        e.preventDefault();
        let studentId = $(this).attr('data-id');
        let balance = $(this).attr('data-balance');

        if(balance != '0.00'){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Unpaid Balance',
                text: "This applicant still has an unpaid balance, are you sure you want to release Cashier's Hold?",
                icon: 'question',
                confirmButtonText: 'Yes, Accept',
                cancelButtonText: 'No, Not Yet',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if(result.value){
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger mr-3'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Releasing Cashier\'s Hold',
                        text: "Are you sure you want to accept this applicant for enrollment?",
                        icon: 'question',
                        confirmButtonText: 'Yes, Accept',
                        cancelButtonText: 'No, Not Yet',
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            let formData = new FormData();
                            formData.append('requestType','CashierAccepted');
                            formData.append('_method','PUT');
                            let routeUrl = "{{ route('requests.update','id') }}";
                            let acceptUrl = routeUrl.replace('id', studentId);

                            $.ajax({
                                url: acceptUrl,
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data){
                                    console.log(data);
                                    alertify.success('Applicant accepted for enrollment!');        
                                    $('#payments').DataTable().ajax.reload();
                                },
                                error: function(err){
                                    console.log(err)
                                    let error_html = '<ul class="text-left">';
                                    for(let x = 0; x < err.responseJSON.error.length; x++){
                                        error_html += '<li class="text-left">'+err.responseJSON.error[x]+'</li>';
                                        if(x==err.responseJSON.error.length){
                                            error_html += '</ul>';
                                        }
                                    }
                                    // toastr["error"](error_html);
                                    alertify.error(error_html);
                                }
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            alertify.error('<p class="text-left"><strong>Accept Cancelled!</strong> <br>Just click Accept button again once you\'re ready to accept the applicant.</p>');
                        }
                    })
                } else {
                    alertify.error('<p class="text-left"><strong>Accept Cancelled!</strong> <br>Just click Accept button again once you\'re ready to accept the applicant.</p>');
                }
            })
        } else {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Removing Cashier\'s Hold',
                text: "Are you sure you want to accept this applicant for enrollment?",
                icon: 'question',
                confirmButtonText: 'Yes, Accept',
                cancelButtonText: 'No, Not Yet',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('requestType','CashierAccepted');
                    formData.append('_method','PUT');
                    let routeUrl = "{{ route('requests.update','id') }}";
                    let acceptUrl = routeUrl.replace('id', studentId);

                    $.ajax({
                        url: acceptUrl,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data){
                            console.log(data);
                            alertify.success('Applicant accepted for enrollment!');        
                            $('#payments').DataTable().ajax.reload();
                        },
                        error: function(err){
                            console.log(err)
                            let error_html = '<ul class="text-left">';
                            for(let x = 0; x < err.responseJSON.error.length; x++){
                                error_html += '<li class="text-left">'+err.responseJSON.error[x]+'</li>';
                                if(x==err.responseJSON.error.length){
                                    error_html += '</ul>';
                                }
                            }
                            // toastr["error"](error_html);
                            alertify.error(error_html);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alertify.error('<p class="text-left"><strong>Accept Cancelled!</strong> <br>Just click Accept button again once you\'re ready to accept the applicant.</p>');
                }
            })
        }
    })

    $(document).on('click', '.printPaymentConfirmation', function(e){
        e.preventDefault();
        let paymentId = $(this).attr('data-id');
        let confirmationUrl = "{{ route('confirmation.print','id') }}";
        let redirectUrl = confirmationUrl.replace('id',paymentId);
        window.open(redirectUrl,'blank');
    })
</script>