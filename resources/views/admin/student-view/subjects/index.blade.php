@extends('layouts.admin')

@section('title', 'Subjects & Schedules')
@section('menu-title', 'Subjects & Schedules')

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
                                    <th scope="col" class="py-3">Instructor</th>
                                    <th scope="col" class="py-3">Schedule</th>
                                    <th scope="col" class="py-3">Units</th>
                                    <th scope="col" class="py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profile->enrollments as $key => $enrollment)
                                    <tr>
                                        @foreach ($subjects as $subject)
                                            @if($subject->id == $enrollment->subject_id)
                                                <td>{{ $key+1 }}.</td>
                                                <td class="code">{{ $subject->code }}</td>
                                                <td class="desc">{{ $subject->description }}</td>
                                                <td class="instructor">
                                                    @foreach ($instructors as $instructor)
                                                        @if($instructor->id == $subject->instructor)
                                                            {{ $instructor->first_name . ' ' . $instructor->last_name  }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="schedule">
                                                    @foreach ($schedules as $schedule)
                                                        @if($schedule->id == $subject->schedule)
                                                            {{ $schedule->day }} ({{ $schedule->time }}) at 
                                                            @if($schedule->type == 0)
                                                                Room {{ $schedule->location }}
                                                            @elseif($schedule->type == 1)
                                                                Lab {{ $schedule->location }}
                                                            @else
                                                                Home
                                                            @endif
                                                            
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="units text-center">{{ $subject->units }}</td>
                                                <td class="action">
                                                    @if ($subject->status == 0)
                                                        <span class="badge badge-danger py-2 px-3"><i class="fas fa-times-circle"></i> No Instructor</span>
                                                    @endif
                                                    @if ($subject->status == 1)
                                                        <span class="badge badge-warning py-2 px-3"><i class="fas fa-check"></i> Assigned to Instructor</span>
                                                    @endif
                                                    @if ($subject->status == 2)
                                                        <a href="{{ $subject->url }}" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Completed</a>
                                                    @endif
                                                    @if ($subject->status == 3)
                                                        <span class="badge badge-danger py-2 px-3"><i class="fas fa-times"></i> Not Yet Ready</span>
                                                    @endif
                                                    @if ($subject->status == 4)
                                                        <a href="{{ $subject->url }}" class="btn btn-sm btn-primary px-3"><i class="far fa-folder-open"></i> Open</a>
                                                    @endif
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mb-3">
                            <div class="col-8 col-md-2 offset-9 text-right">
                                Total Units: 
                            </div>
                            <div class="col-4 col-md-1 text-center font-weight-bold">
                                {{ $totalUnits }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <p class="text-center bg-danger text-white py-2">This is a system generated report.</p>
                
                <div class="row my-5 no-print">
                    <div class="col-12 col-md-2 offset-md-5">
                        <a href="{{ route('cor.print',$profile->id) }}" class="btn btn-warning px-3" target="_blank">
                            <i class="fas fa-print"></i> Print COR
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
@endsection