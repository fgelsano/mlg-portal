{{-- DataTables --}}
<script>
    $(document).ready( function () {
        $('#billing-accounts').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('billing-accounts.index') }}',
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
                    data: 'course',
                    name: 'course'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },

            ],
            "order": [[ 1, 'asc']]

        });
    } );
</script>