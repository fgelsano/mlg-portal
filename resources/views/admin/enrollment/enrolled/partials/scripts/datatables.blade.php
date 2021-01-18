{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#enrolled').DataTable({
            // processing: true,
            serverSide: true,
            ajax: '{{ route('enrolled.index') }}',
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
                    data: 'date',
                    name: 'date'
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
            "order": [[6, 'asc']]
        });
    } );
</script>