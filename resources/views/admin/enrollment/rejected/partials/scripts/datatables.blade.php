{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#rejects').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('rejected.index') }}',
            columns: [
                {
                    data: 'year_level',
                    name: 'year_level'
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
                    data: 'comment',
                    name: 'comment'
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
                    visible: false,
                    orderable: false
                }

            ],
            "order": [5, 'asc']
        });
    } );
</script>