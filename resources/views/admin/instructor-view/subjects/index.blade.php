@extends('layouts.admin')

@section('title', 'Subject Loads')
@section('menu-title', 'Subject Loads')

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
                                    <th scope="col" class="py-3">Schedule</th>
                                    <th scope="col" class="py-3">Units</th>
                                    <th scope="col" class="py-3">Status</th>
                                    <th scope="col" class="py-3">Link</th>
                                    <th scope="col" class="py-3 no-print">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach ($subjects as $subject)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>
                                            {{ $subject->day }} | {{ $subject->time }} at 
                                            @if($subject->type == 0)
                                                Room {{ $subject->location }}
                                            @elseif($subject->type == 1)
                                                Lab {{ $subject->location }}
                                            @else
                                                {{ $subject->location }}
                                            @endif
                                        </td>
                                        <td>{{ $subject->units }}</td>
                                        <td>
                                            @if ($subject->status == 0)
                                                Available
                                            @elseif($subject->status == 1)
                                                Assigned
                                            @elseif($subject->status == 2)
                                                Completed
                                            @elseif($subject->status == 3)
                                                <span class="badge badge-danger">Not Yet Ready</span>
                                            @elseif($subject->status == 4)
                                                <span class="badge badge-success">Ready</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ $subject->url }}" target="_blank">{{ $subject->url }}</a></td>
                                        <td class="no-print">
                                            <a href="" class="btn btn-warning btn-sm editSubject" data-toggle="modal" data-target="#editSubject-modal" data-id="{{ $subject->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="/dashboard/subjects/student-roster/{{ $subject->id }}" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-list"></i> Roster</a>
                                        </td>
                                    </tr> 
                                    @php $count++ @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mb-3">
                            <div class="col-8 col-md-2 offset-8 text-right">
                                Total Units: 
                            </div>
                            <div class="col-4 col-md-1 font-weight-bold">
                                {{ $totalUnits }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <p class="text-center bg-danger text-white py-2">This is a system generated report.</p>
                
                <div class="row my-5 no-print">
                    <div class="col-12 col-md-4">
                        <a href="{{ route('subject-load.print',Auth::user()->profile_id) }}" class="btn btn-warning px-3" target="_blank">
                            <i class="fas fa-print"></i> Print Preview
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @include('admin.instructor-view.subjects.partials.sections.editSubject-modal')
@endsection

@section('scripts')
    @include('admin.instructor-view.subjects.partials.scripts.actions')
@endsection