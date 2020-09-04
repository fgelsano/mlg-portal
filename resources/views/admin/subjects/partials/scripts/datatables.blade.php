{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#subjects').DataTable({
            initComplete: function(){
                $('.dataTables_filter ').append('<button type="button" id="addSubject" class="btn btn-sm btn-primary ml-3" data-toggle="modal" data-target="#subjects-modal"><i class="fas fa-book"></i> New Subject</button>');
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('subjects.index') }}',
            columns: [
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'instructor',
                    name: 'instructor'
                },
                {
                    data: 'schedule',
                    name: 'schedule'
                },
                {
                    data: 'type',
                    name: 'type'
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