{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#users').DataTable({
            initComplete: function(){
                $('.dataTables_filter ').append('<button type="button" id="addUser" class="btn btn-sm btn-primary ml-3"><i class="fas fa-user"></i> Add User</button>');
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.index') }}',
            columns: [
                {
                    data: 'profile_pic',
                    name: 'profile_pic'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
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
                },

            ],
            "order": [[ 5, 'asc']]

        });
    } );
</script>