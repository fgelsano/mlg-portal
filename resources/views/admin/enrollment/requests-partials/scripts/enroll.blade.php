{{-- Evaluate Admission --}}
<script>
    $(document).on('click', '#enrollAdmission', function(e){
        e.preventDefault();
        
        let id = $('#enrollAdmission').attr('data-id');
        $('#applicant-id').val(id);

        let form = $('#acceptForm')[0];
        let formData = new FormData(form);
        
        let routeUrl = "{{ route('requests.update','id') }}";

        let acceptUrl = routeUrl.replace('id', id);
        
        $.ajax({
            url: acceptUrl,
            type: 'POST',
            contentType: false,
            processData: false,
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){      
                alertify.success('Request Accepted and now waiting for Cashier\'s cofirmation!');
                $('#requests').DataTable().ajax.reload();
                $('#admission-modal').modal('hide');
                // alertify.confirm()
                // .setting({
                //     'title':'Request Accepted',
                //     'message': 'Do you wish to proceed to enrollment?',
                //     'onok': function(){
                //         let admissionId = id;
                //         let routeUrl = "{{ route('requests.show','id') }}";
                //         let enrolUrl = routeUrl.replace('id', admissionId);
                //         $.ajax({
                //             url: enrolUrl,
                //             type: 'GET',
                //             contentType: false,
                //             processData: false,
                //             dataType: 'json',
                //             success: function(data){
                                
                //                 $('#admission-modal').modal('hide');
                //                 $('#confirmedEnroll').attr('data-id', data.id);
                                
                //                 let fullname = data.first_name+' '+data.middle_name+' '+data.last_name;
                //                 $('#enrollee-fullname').text(fullname);
                //                 $('#enrollee-name').text(fullname);
                //                 let print_gender = ['Male','Female']
                //                 $('#enrollee-gender').text(print_gender[data.gender]);
                //                 let print_civil_status = ['Single','Married','Widow','Widower'];
                //                 $('#enrollee-civil-status').text(print_civil_status[data.civil_status]);
                //                 $('#enrollee-religion').text(data.religion);
                //                 let print_purok = '';
                //                 if(data.purok){
                //                     print_purok = 'Purok '+data.purok
                //                 }
                //                 let print_sitio = '';
                //                 if(data.sitio){
                //                     print_sitio = 'Sitio '+data.sitio;
                //                 }
                //                 $('#enrollee-physical-address').text(print_purok+' '+print_sitio+', '+data.street_barangay+', '+data.municipality+', '+data.province+', Philippines '+data.zip_code);
                //                 let print_courses = ['BSIT','BEED','BSED-Math','BSED-SocSci','SHS-ABM','SHS-HUMSS','SHS-CK','SHS-HK','SHS-BP','SHS-ICT','JHS'];
                //                 $('#enrollee-course').text(print_courses[data.course]);

                //                 let print_year_level = ['First Year','Second Year','Third Year','Fourth Year','Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
                //                 $('#enrollee-year-level').text(print_year_level[data.year_level]);
                                
                                
                //                 let trans_id = data.id;
                //                 let request_id = trans_id.toString();
                //                 $('#enrollee-request-id').text(request_id.padStart(6,'0'));
                                
                //                 let applicant_img_url = '/storage/uploads/applicant-img/';
                //                 $('#enrollee-applicant-img').attr('src', applicant_img_url+data.applicant_img);

                //                 $('#enrolled-subjects').attr('data-empty','0');

                //                 $('#enrolled-subjects').html('<tr class="bg-danger text-white py-0" data-stat="empty" id="empty-row"><td colspan="5" class="text-center">No Enrolled Subject Yet</td></tr>');

                //                 $('#enrol-modal').modal('show');
                //             }
                //         })
                //     },
                //     'oncancel': function(){
                //         alertify.success('Request Accepted!');
                //         $('#requests').DataTable().ajax.reload();
                //         $('#admission-modal').modal('hide');
                //     }
                // }).show();

            }
        });
    });
</script>