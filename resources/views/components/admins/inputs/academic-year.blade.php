<select name="academic_year_id" class="form-control m-1" {{ $attributes }}>
    <option value="">Pilih Tahun Ajaran</option>
    @foreach ($academic_years as $year)
        <option value="{{ $year->id }}" @selected($year->id == $value)>{{ $year->toDescriptionString()  }}</option>
    @endforeach
</select>