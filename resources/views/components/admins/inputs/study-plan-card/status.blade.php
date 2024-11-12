<select name="status" id="" class="form-control m-1">
    <option value="">Pilih Status</option>
    @foreach ($statuses as $index => $status)
        <option value="{{ $index }}" @selected($status == $value)>
            {{ $status }}
        </option>
    @endforeach
</select>