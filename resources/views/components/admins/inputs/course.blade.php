<select name="course_id" id="" class="form-control m-1">
    <option value="">Pilih Mata Kuliah</option>
    @foreach ($courses as $course)
        <option value="{{ $course->id }}" @selected($course->id == $value)>{{ $course->name }}</option>
    @endforeach
</select>