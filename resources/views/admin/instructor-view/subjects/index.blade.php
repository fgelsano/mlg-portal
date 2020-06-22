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
                                    <th scope="col" class="py-3 no-print">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $key => $subject)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>
                                            @foreach ($schedules as $schedule)
                                                @if ($schedule->id == $subject->schedule)
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
                                        <td>{{ $subject->units }}</td>
                                        <td class="no-print">
                                            <a href="" class="btn btn-warning btn-sm editSubject">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr> 
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
                    <div class="col-12 col-md-2 offset-md-5">
                        <a href="{{ route('subject-load.print',Auth::user()->profile_id) }}" class="btn btn-warning px-3" target="_blank">
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