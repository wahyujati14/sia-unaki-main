<select name="lecturer_id" id="" class="form-control m-1">
    <option value="">Pilih Dosen</option>
    @foreach ($lecturers as $lecturer)
        <option value="{{ $lecturer->id }}" @selected($lecturer->id == $value)>{{ $lecturer->name }}</option>
    @endforeach
</select>