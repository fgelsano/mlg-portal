{{-- Course Details --}}
<div class="row">
    <div class="col-12 col-md-9 form-group">
        <select name="course" id="course" class="form-control">
            <option value="" selected disabled>Select a Course</option>
            @foreach ($courses as $course)
                <option value="{{$course->id}}">{{$course->name}} ({{$course->code}})</option>
            @endforeach
            {{-- <option value="4">Senior High School - ABM</option>
            <option value="6">Senior High School - HUMSS</option>
            <option value="7">Senior High School - Cookery</option>
            <option value="8">Senior High School - Housekeeping</option>
            <option value="9">Senior High School - Bread & Pastry</option>
            <option value="10">Senior High School - ICT</option>
            <option value="11">Junior High School</option> --}}
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <select name="year-level" id="year-level" class="form-control">
            <option value="" selected disabled>Select Year Level</option>
            <option value="0">First Year</option>
            <option value="1">Second Year</option>
            <option value="2">Third Year</option>
            <option value="3">Fourth Year</option>
            {{-- <option value="4">Grade 7</option>
            <option value="5">Grade 8</option>
            <option value="6">Grade 9</option>
            <option value="7">Grade 10</option>
            <option value="8">Grade 11</option>
            <option value="9">Grade 12</option> --}}
        </select>
    </div>
</div>