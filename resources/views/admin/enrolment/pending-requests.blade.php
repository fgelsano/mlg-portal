@extends('layouts.admin')

@section('title', 'Pending Requests')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pending Requests</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <div class="row">
            <div class="col-12">
                @include('admin.0-partials._messages')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="pending-requests" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>School</th>
                                        <th>Action</th>
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
            $('#pending-requests').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('pending-requests.index') }}',
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
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        type: 'date',
                        targets: [2],
                        visible: false,
                        orderable: false
                    }
    
                ],
                "order": [[ 4, 'asc']]
    
            });
        } );
    </script>
@endsection