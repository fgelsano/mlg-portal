@extends('layouts.admin')

@section('title', 'Cashier\'s Hold')
@section('menu-title', 'Cashier\'s Hold')

@section('styles')
<style>
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
        
                        <div class="table-responsive">
                            <table id="cashier-hold" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>School Graduated</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    {{-- DataTables --}}
    <script>
        $(document).ready( function () {
            $('#cashier-hold').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('cashier.list') }}',
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
                        data: 'school_graduated',
                        name: 'school'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                "order": [[ 3, 'asc']]
            });
        } );
    </script>
@endsection