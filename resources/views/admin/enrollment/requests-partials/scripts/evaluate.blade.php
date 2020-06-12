{{-- Evaluate Admission --}}
<script>
    $('#rejectAdmission').click(function(){
        $('input[name="button-action"]').val('Reject');
    });
    $(document).on('click', '.evalAdmission', function(e){
        e.preventDefault();
        let admissionId = $(this).attr('data-id');
        let routeUrl = "{{ route('requests.show','id') }}";
        let evalUrl = routeUrl.replace('id', admissionId);
        $.ajax({
            url: evalUrl,
            type: 'GET',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
                
                $('#rejectAdmission').attr('data-id', data.id);
                $('#enrollAdmission').attr('data-id', data.id);
                
                let fullname = data.first_name+' '+data.middle_name+' '+data.last_name;
                $('#fullname').text(fullname);
                $('#requested-by').text(fullname);
                let print_gender = ['Male','Female']
                $('#gender').text(print_gender[data.gender]);
                let print_civil_status = ['Single','Married','Widow','Widower'];
                $('#civil-status').text(print_civil_status[data.civil_status]);
                $('#religion').text(data.religion);
                let print_purok = '';
                if(data.purok){
                    print_purok = 'Purok '+data.purok+',';
                }
                let print_sitio = '';
                if(data.sitio){
                    print_sitio = 'Sitio '+data.sitio+',';
                }
                $('#physical-address').text(print_purok+' '+print_sitio+' '+data.street_barangay+', '+data.municipality+', '+data.province+', Philippines '+data.zip_code);
                let print_courses = ['BSIT','BEED','BSED-Math','BSED-SocSci','SHS-ABM','SHS-HUMSS','SHS-CK','SHS-HK','SHS-BP','SHS-ICT','JHS'];
                $('#course').text(print_courses[data.course]);
                let print_year_level = ['First Year','Second Year','Third Year','Fourth Year','Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
                $('#year-level').text(print_year_level[data.year_level]);
                $('#lrn').text(data.lrn);
                let trans_id = data.id;
                let request_id = trans_id.toString();
                $('#request-id').text(request_id.padStart(6,'0'));
                $('#request-id').attr('data-id', trans_id);
                $('#contact-name').text(data.parent_guardian_name);
                $('#contact-number').text(data.parent_guardian_contact);
                $('#school').text(data.school_graduated);
                $('#school-address').text(data.school_address);
                $('#year').text(data.year_graduated);

                $('#gmc').html(data.gmc ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
                $('#gmc-popover').attr(data.gmc ? {'data-content':'<img src="{{ asset('/storage/uploads/gmc') }}/'+data.gmc+'" width="100%">'} : '');

                $('#sf9-front').html(data.sf9_front ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
                $('#sf9-front-popover').attr(data.sf9_front ? {'data-content':'<img src="{{ asset('/storage/uploads/sf9-front') }}/'+data.sf9_front+'" width="100%">'} : '');

                $('#sf9-back').html(data.sf9_back ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
                $('#sf9-back-popover').attr(data.sf9_back ? {'data-content':'<img src="{{ asset('/storage/uploads/sf9-back') }}/'+data.sf9_back+'" width="100%">'} : '');
                
                $('#med-cert').html(data.med_cert ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
                $('#med-cert-popover').attr(data.med_cert ? {'data-content':'<img src="{{ asset('/storage/uploads/med-cert') }}/'+data.med_cert+'" width="100%">'} : '');

                $('#gwa').html(data.gwa ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
                $('#gwa-popover').attr(data.gwa ? {'data-content':'<img src="{{ asset('/storage/uploads/gwa') }}/'+data.gwa+'" width="100%">'} : '');

                $('#psa-bc').html(data.psa_bc ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
                $('#psa-bc-popover').attr(data.psa_bc ? {'data-content':'<img src="{{ asset('/storage/uploads/psa-bc') }}/'+data.psa_bc+'" width="100%">'} : '');

                $('#hd').html(data.hd ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>');
                $('#hd-popover').attr(data.hd ? {'data-content':'<img src="{{ asset('/storage/uploads/hd') }}/'+data.hd+'" width="100%">'} : '');

                let applicant_img_url = '/storage/uploads/applicant-img/';
                $('#applicant-img').attr('src', applicant_img_url+data.applicant_img);

                $('#admission-modal').modal('show');
            }
        })
    });
</script>