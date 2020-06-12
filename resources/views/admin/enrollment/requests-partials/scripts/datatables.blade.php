{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#requests').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('requests.index') }}',
            columns: [
                {
                    data: 'id',
                    name: 'request_id'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'school_graduated',
                    name: 'school'
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
                {
                    data: 'created_at',
                    name: 'created_at',
                    type: 'date',
                    targets: [5],
                    visible: false,
                    orderable: false
                }

            ],
            "order": [[ 5, 'asc']]
        });
    } );
</script>