{{-- Course Details --}}
<div class="row">
    <div class="col-12 col-md-9 form-group">
        <select name="course" id="course" class="form-control" onInput="this.className = 'form-control'">
            <option selected disabled>Select a Course</option>
            @foreach ($courses as $course)
                <option value="{{$course->id}}">{{$course->name}} ({{$course->code}})</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <select name="year-level" id="year-level" class="form-control" onInput="this.className = 'form-control'">
            <option selected disabled>Select Year Level</option>
            <option value="1">First Year</option>
            <option value="2">Second Year</option>
            <option value="3">Third Year</option>
            <option value="4">Fourth Year</option>
        </select>
    </div>
</div>