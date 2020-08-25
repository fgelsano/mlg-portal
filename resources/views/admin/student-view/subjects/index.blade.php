@extends('layouts.admin')

@section('title', 'Subjects & Schedules')
@section('menu-title', 'Subjects & Schedules')

@section('styles')
<style>
    #credsPane{
        display: none;
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
                                    <th scope="col" class="py-3">Instructor</th>
                                    <th scope="col" class="py-3">Schedule</th>
                                    <th scope="col" class="py-3">Type</th>
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
                                                <td class="type">
                                                    {!! $subject->type == 0 ? '<span class="badge badge-warning">Lecture</span>' : '<span class="badge badge-primary">Laboratory</span>'!!}
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
                
                <p class="text-center bg-danger text-white py-2">This is a system generated report. If you need a signed version of this report. Please bring a printed out copy of this report to the registrar's office for signing.</p>
                
                <div class="row mt-5 no-print">
                    <div class="col-12 col-md-2 mb-2">
                        <a href="{{ route('cor.print',$profile->id) }}" class="btn btn-warning btn-sm px-3 btn-block" target="_blank">
                            <i class="fas fa-print"></i> Print COR
                        </a>
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <a href="" class="btn btn-sm btn-primary px-3 btn-block" id="btnShowCreds">
                            <i class="fas fa-unlock-alt"></i>
                            Credentials
                        </a>
                    </div>
                </div>
                <div class="row mt-2 no-print" id="credsPane">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="d-inline">Credentials for <span class="font-weight-bold text-danger">Student Name</span></h5>
                                <button type="button" class="close" data-dismiss="card" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                MLGCL Email Address
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-4">Username: </div>
                                                    <div class="col-12 col-md-8">
                                                        <p class="border-bottom">fgelsano@mlgcl.edu.ph</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">Password: </div>
                                                    <div class="col-12 col-md-8">
                                                        <div class="input-group mb-3">
                                                            <input type="password" class="form-control" value="fgelsano@mlgcl.edu.ph" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-eye"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                MLGCL Learning Management System (LMS)
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-4">Username: </div>
                                                    <div class="col-12 col-md-8">
                                                        <p class="border-bottom">fgelsano@mlgcl.edu.ph</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">Password: </div>
                                                    <div class="col-12 col-md-8">
                                                        <div class="input-group mb-3">
                                                            <input type="password" class="form-control" value="fgelsano@mlgcl.edu.ph" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-eye"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    <script>
        $(document).on('click','#btnShowCreds',function(e){
            e.preventDefault();
            
            $("#credsPane").toggle(1000, function(){
                if($('#credsPane').attr('style') == 'display: block;'){
                    swal.fire({
                        title: 'Reminder! Never share your credentials with anyone.',
                        icon: 'warning'
                    })
                }
            });
            
        })
    </script>
@endsection