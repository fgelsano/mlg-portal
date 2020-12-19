@extends('layouts.admin')

@section('title', 'Grades')
@section('menu-title', 'Grades')

@section('styles')
<style>
    #grade-sheet-title{
        position: absolute;
        bottom: 10px;
        right: 0px;
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card px-3 m-3">
            <div class="card-body">
                <div id="profile-section">
                    @include('admin.student-view.grades.sections.profile')
                </div>
                <div class="row mt-3">
                    @if($displayGrade->name == 'Yes')
                        <div class="col-12 table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="table-primary py-3">
                                        <th scope="col" class="py-3">Code</th>
                                        <th scope="col" class="py-3">Description</th>
                                        <th scope="col" class="py-3">Instructor</th>
                                        <th scope="col" class="py-3">Schedule</th>
                                        <th scope="col" class="py-3">Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->code }}</td>
                                            <td>{{ $subject->description }}</td>
                                            <td>{{ $subject->first_name }} {{ $subject->last_name }}</td>
                                            <td>{{ $subject->day }} | {{ $subject->time }} | {{ $subject->classroomType }} {{ $subject->location }}</td>
                                            <td>
                                                @if($subject->grade == null)
                                                    <p class="m-0 text-danger">No Grade</p>
                                                @else
                                                    <p class="m-0">{{ $subject->grade }}</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="text-center bg-danger text-white py-2">This is a system generated report. Please visit the registrar's office personally if you want a signed copy.</p>
                        </div>
                    @else
                        <div class="col-12">
                            <p class="bg-danger text-white p-3">
                                Display grade is not yet activated by the registrar. Please come back later.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer no-print bg-white">
                <button class="btn btn-warning px-3" id="print-grade-sheet">
                    <i class="fa fa-print"></i>
                    Print Grade Sheet
                </button>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    <script>
        $('#print-grade-sheet').click(function(){
            $('#content-wrapper').css('background-color','#fff');
            alert('IMPORTANT REMINDER!\n Enable the "Background Graphics" option first before printing.\n This will allow the images to be included in the printout.')
            window.print();
            $('#content-wrapper').css('background-color','#f8f9fc');
        })
    </script>
@endsection