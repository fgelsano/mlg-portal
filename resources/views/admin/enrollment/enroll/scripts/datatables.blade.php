{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#enroll-subjects').DataTable({
            processing: true,
            serverSide: true,
            
            scrollCollapse: true,

            ajax: '{{ route('enroll-subjects.list') }}',
            columns: [
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'description',
                    name: 'discription'
                },
                {
                    data: 'instructor',
                    name: 'instructor'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'units',
                    name: 'units'
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
            "order": [[ 4, 'asc']],
            'select': {
                style: 'multi'
            }
        });
    } );
</script>