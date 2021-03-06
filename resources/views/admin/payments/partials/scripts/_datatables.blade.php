{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#payments').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('payments.index') }}',
            columns: [
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
                    data: 'course',
                    name: 'course'
                },
                {
                    data: 'year_level',
                    name: 'year_level'
                },
                {
                    data: 'balance',
                    name: 'balance'
                },
                {
                    data: 'status',
                    name: 'status'
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
            "order": [[6, 'asc'],[8,'desc']]
        });
    } );
</script>