{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#options').DataTable({
            initComplete: function(){
                $('.dataTables_filter ').append('<button type="button" id="addOption" class="btn btn-sm btn-primary ml-3" data-toggle="modal" data-target="#options-modal"><i class="fas fa-list"></i> New Option</button>');
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('options.index') }}',
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'extra',
                    name: 'extra'
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