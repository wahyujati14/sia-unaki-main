<select name="study_program_id" class="form-control m-1" {{ $attributes }}>
    <option value="">Pilih Program Studi</option>
    @foreach ($study_programs as $program)
        <option value="{{ $program->id }}" @selected($program->id == $value)>
            {{ $program->code }} - {{ $program->name }}
        </option>
    @endforeach
</select>