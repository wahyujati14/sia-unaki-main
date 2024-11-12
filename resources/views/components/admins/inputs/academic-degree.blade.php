<select name="academic_degree_id" id="" class="form-control m-1">
    <option value="">Pilih Gelar Pendidikan</option>
    @foreach ($degrees as $degree)
        <option value="{{ $degree->id }}" @selected($degree->id == $value)>{{ $degree->name }}</option>
    @endforeach
</select>