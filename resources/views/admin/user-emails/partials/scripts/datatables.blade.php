{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#userEmails').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('userEmails.index') }}',
            columns: [
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'suggested_email',
                    name: 'suggested_email'
                },
                {
                    data: 'created_email',
                    name: 'created_email'
                },
                {
                    data: 'email_password',
                    name: 'email_password'
                },
                {
                    data: 'lms_password',
                    name: 'lms_password'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            "order": [[ 6, 'desc']]

        });
    } );
</script>