{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#profiles').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('profiles.index') }}',
            columns: [
                {
                    data: 'profile_id',
                    name: 'profile_id'
                },
                {
                    data: 'school_id',
                    name: 'school_id'
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
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'action',
                    name: 'action'
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
            "order": [[5, 'asc'],[4,'desc']]
        });
    } );
</script>