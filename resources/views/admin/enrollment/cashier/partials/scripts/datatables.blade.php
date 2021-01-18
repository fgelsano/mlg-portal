{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#cashier-hold').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('cashier.list') }}',
            columns: [
                {
                    data: 'year_level',
                    name: 'year_level'
                },
                {
                    data: 'course',
                    name: 'course'
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
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    type: 'date',
                    targets: [3],
                    visible: false,
                    orderable: false
                }

            ],
            "order": [[5, 'asc']]
        });
    } );
</script>