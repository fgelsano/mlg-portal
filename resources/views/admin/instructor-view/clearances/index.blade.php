@extends('layouts.admin')

@section('title', 'eClearance')
@section('menu-title', 'eClearance')

@section('styles')
<style>
    .merriweather{
        font-family: 'Merriweather', serif;
    }
    #logo{
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    @media print {
        .no-print{
            display: none;
        }
    }
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
                                    <th scope="col" class="py-3">Units</th>
                                    <th scope="col" class="py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $key => $subject)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>{{ $subject->units }}</td>
                                        <td class="">
                                            <a href="{{ route('clear-students.show',$subject->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-list"></i> Roster
                                            </a>
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                {{-- <p class="text-center bg-danger text-white py-2">This is a system generated report. Please visit the registrar's office personally if you want it signed by the registrar.</p> --}}
                
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @include('admin.instructor-view.subjects.partials.sections.editSubject-modal')
@endsection

@section('scripts')
    @include('admin.instructor-view.subjects.partials.scripts.actions')
@endsection