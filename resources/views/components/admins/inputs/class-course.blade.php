<select name="class_course_id" id="" class="form-control m-1">
    <option value="">Pilih Kelas</option>
    @foreach ($courses as $course)
        <option value="{{ $course->id }}" @selected($course->id == $value)>
            {{ $course->course->name}} - {{ $course->lecturer->name }}
        </option>
    @endforeach
</select>