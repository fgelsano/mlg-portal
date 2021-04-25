<script>
    $(document).on('click', '#btnAddBill', function(e){
        e.preventDefault();
        $('#add-billing-modal').modal('show');
    });
    $("#add-billing-modal").on("hidden", function(){
        $('#add-bill-form')[0].reset();
    });
    $(document).on('click', '#btn-new-deduction', function(e){
        e.preventDefault();
        $('#new-deduction-inputs').append(
                '<div class="row">'+
                    '<div class="col-md-6 col-12">'+
                        '<label for="payment-desc" class="mb-0">Payment Description<span class="text-danger">*</span></label>'+
                        '<input type="text" name="deduction-description[]" class="form-control" required>'+
                    '</div>'+
                    '<div class="col-md-6 col-12">'+
                        '<label for="payment-desc" class="mb-0">Amount<span class="text-danger">*</span></label>'+
                        '<div class="input-group mb-1">'+
                        '<div class="input-group-prepend">'+
                            '<span class="input-group-text" id="peso-symbol">₱</span>'+
                            '</div>'+
                            '<input type="text" name="deduction-amount[]" class="form-control input-deduction" placeholder="00.00" aria-label="Tuition Fee" aria-describedby="Tuition Fee">'+
                        '</div>'+
                    '</div>'+
                '</div>'
        );
    })
    $(document).on('keyup','.input-deduction',function(){
        let totalDeductions = 0;
        $('.input-deduction').each(function(){
            totalDeductions += Number($(this).val());
        })
        $('#view-total-deduction').text('₱ '+totalDeductions);
        $('#total-deductions').val(totalDeductions);

        let totalFees = $('#total-fees').val();
        let miscFees = $('#total-deductions').val();

        let totalBalance = parseFloat(totalFees) - parseFloat(miscFees);
        
        $('#total-balance').text('₱ '+totalBalance);

        if(totalBalance > 0){
            $('#total-balance').removeClass('text-success');
            $('#total-balance').addClass('text-danger');
            $('#balance-type').removeClass('badge-success');
            $('#balance-type').addClass('badge-danger');
            $('#balance-type').text('');
            $('#balance-type').text('COLLECTIBLE');
        } else {
            $('#total-balance').removeClass('text-danger');
            $('#total-balance').addClass('text-success');
            $('#balance-type').removeClass('badge-danger');
            $('#balance-type').addClass('badge-success');
            $('#balance-type').text('');
            $('#balance-type').text('REFUNDABLE');
        }
        if(totalBalance == 0){
            $('#balance-type').text('');
            $('#balance-type').text('Fully Paid');
            $('#balance-type').removeClass('badge-danger');
            $('#balance-type').addClass('badge-success');
        }
    });
    $(document).on('keyup','#input-tuition-fee',function(){
        let totalFees = 0;
        
        let tuitionFee = $('#input-tuition-fee').val() === '' ? '0' : $('#input-tuition-fee').val();
        let miscFee = $('#input-misc-fee').val() === '' ? '0' : $('#input-misc-fee').val();

        totalFees = parseFloat(tuitionFee) + parseFloat(miscFee);
        $('#view-total-fees').text('₱ '+totalFees);
        $('#total-fees').val(totalFees);

        let feesTotal = $('#total-fees').val();
        let feesMisc = $('#total-deductions').val();

        let totalBalance = parseFloat(feesTotal) - parseFloat(feesMisc);
        
        $('#total-balance').text('₱ '+totalBalance);
        if(totalBalance > 0){
            $('#total-balance').removeClass('text-success');
            $('#total-balance').addClass('text-danger');
            $('#balance-type').removeClass('badge-success');
            $('#balance-type').addClass('badge-danger');
            $('#balance-type').text('');
            $('#balance-type').text('COLLECTIBLE');
        } else {
            $('#total-balance').removeClass('text-danger');
            $('#total-balance').addClass('text-success');
            $('#balance-type').removeClass('badge-danger');
            $('#balance-type').addClass('badge-success');
            $('#balance-type').text('');
            $('#balance-type').text('REFUNDABLE');
        }
    });
    $('#input-misc-fee').keyup(function(){
        let totalFees = 0;
        
        let tuitionFee = $('#input-tuition-fee').val() === '' ? '0' : $('#input-tuition-fee').val();
        let miscFee = $('#input-misc-fee').val() === '' ? '0' : $('#input-misc-fee').val();

        totalFees = parseFloat(tuitionFee) + parseFloat(miscFee);
        $('#view-total-fees').text('₱ '+totalFees);
        $('#total-fees').val(totalFees);

        let feesTotal = $('#total-fees').val();
        let feesMisc = $('#total-deductions').val();

        let totalBalance = parseFloat(feesTotal) - parseFloat(feesMisc);
        
        $('#total-balance').text('₱ '+totalBalance);

        $('#total-balance').text('₱ '+totalBalance);
        if(totalBalance > 0){
            $('#total-balance').removeClass('text-success');
            $('#total-balance').addClass('text-danger');
            $('#balance-type').removeClass('badge-success');
            $('#balance-type').addClass('badge-danger');
            $('#balance-type').text('');
            $('#balance-type').text('COLLECTIBLE');
        } else {
            $('#total-balance').removeClass('text-danger');
            $('#total-balance').addClass('text-success');
            $('#balance-type').removeClass('badge-danger');
            $('#balance-type').addClass('badge-success');
            $('#balance-type').text('');
            $('#balance-type').text('REFUNDABLE');
        }
    });
    $(document).on('click', '#addBillSave', function(e){
        e.preventDefault();
        let billForm = $('#add-bill-form')[0];
        let formData = new FormData(billForm);
        let studentId = $('#add-billing-modal').attr('data-id');

        let balance = $('#balance-type').text();
        let balanceType = '';
        
        if(balance === 'FULLY PAID'){
            balanceType = 0;
        }else if(balance === 'COLLECTIBLE'){
            balanceType = 1;
        }else if(balance === 'REFUNDABLE'){
            balanceType = 2;
        }

        formData.append('student-id',studentId);
        formData.append('balance-type',balanceType);
        
        let routeUrl = "{{ route('billing-accounts.store') }}";
        let storeUrl = routeUrl.replace('id', studentId);
        $.ajax({
            url: storeUrl,
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
                $('#add-billing-modal').modal('show');
                Swal.fire({
                    icon: 'success',
                    text: 'Bill Successfully Added!'
                }).then(function(){
                    window.location.href = "/dashboard/billing-accounts/"+data.id;
                });
            },
            error: function(err){
                // console.log(err);
                let error_html = '';
                let errors = err.responseJSON;
                console.log(errors);
                // Swal.fire({
                //     icon: 'error',
                //     text: err.responseText
                // })
                $.each(errors, function(key, response){
                    $.each(response, function(key, value){
                        error_html += '<p class="text-left">'+value+'</p>';
                        // if(value == err.responseJSON.length){
                        //     error_html += '</ul>'
                        // }
                    })
                    alertify.error(error_html);
                }) 
            }
        });
        // $.ajax({
        //     url: storeUrl,
        //     type: 'POST',
        //     contentType: false,
        //     processData: false,
        //     dataType: 'json',
        //     success: function(data){
        //         console.log(data);
        //         $('#instructorTitle').html('<i class="fas fa-chalkboard-teacher"></i> Edit Instructor');
        //         $('#last-name').val(data.last_name);
        //         $('#first-name').val(data.first_name);
        //         $('#middle-name').val(data.middle_name);
        //         $('#email').val(data.email);

        //         let selectedStatus = data.role;
        //         $('select#status option').each(function(){
        //             if($(this).val() == selectedStatus){
        //                 $(this).attr('selected','selected');
        //             }
        //         });
                
        //         let selectedStat = data.status;
        //         $('select#status option').each(function(){
        //             if($(this).val() == selectedStat){
        //                 $(this).attr('selected','selected');
        //             }
        //         });
                
        //         $('#alerts').addClass('d-none');
        //         $('#instructorSave').attr('data-action','Update');
        //         $('#instructorForm').attr('data-id',data.id);
        //         $('#instructorSave').html('<i class="fas fa-save"></i> Update');
        //         $('#formMethod').val('PUT');
        //         $('#instructor-modal').modal('show');
        //     }
        // })
    });
</script>