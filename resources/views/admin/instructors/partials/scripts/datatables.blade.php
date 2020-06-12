{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#instructors').DataTable({
            initComplete: function(){
                $('.dataTables_filter ').append('<button type="button" id="addInstructor" class="btn btn-sm btn-primary ml-3" data-toggle="modal" data-target="#instructor-modal">New Instructor</button>');
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('instructors.index') }}',
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
                    targets: [4],
                    visible: false,
                    orderable: false
                }

            ],
            "order": [[ 4, 'asc']]

        });
    } );
</script>