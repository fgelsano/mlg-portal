{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#enrollees').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('enroll.index') }}',
            columns: [
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'middle_name',
                    name: 'middle_name'
                },
                {
                    data: 'course',
                    name: 'course'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    type: 'date',
                    targets: [4],
                    visible: false,
                    orderable: false
                }

            ],
            "order": [[ 4, 'asc']]

        });
    } );
</script>