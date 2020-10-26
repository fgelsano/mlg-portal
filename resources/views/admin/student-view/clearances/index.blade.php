@extends('layouts.admin')

@section('title', 'eClearance')
@section('menu-title', 'eClearance')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-12 table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr class="table-primary py-3">
                                    <th scope="col" class="py-3">#</th>
                                    <th scope="col" class="py-3">Code</th>
                                    <th scope="col" class="py-3">Description</th>
                                    <th scope="col" class="py-3">Type</th>
                                    <th scope="col" class="py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clearances as $key => $clearance)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $clearance->code }}</td>
                                        <td>{{ $clearance->description }}</td>
                                        @if($clearance->type == '0')
                                            <td>Lecture</td>
                                        @elseif($clearance->type == '1')
                                            <td>Laboratory</td>
                                        @endif
                                        @if($clearance->clearanceId == Null)
                                            <td><span class="badge badge-danger px-3">Not Cleared</span></td>
                                        @else
                                            <td><span class="badge badge-success px-3">Cleared</span></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')

@endsection