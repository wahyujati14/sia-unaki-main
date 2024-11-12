<select name="status" id="" class="form-control m-1">
    <option value="">Pilih Status</option>
    @foreach ($statuses as $index => $status)
        <option value="{{ $index }}" @selected($index == $value)>
            {{ $status }}
        </option>
    @endforeach
</select>