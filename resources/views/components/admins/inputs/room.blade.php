<select name="room_id" id="" class="form-control m-1">
    <option value="">Pilih Ruangan</option>
    @foreach ($rooms as $room)
        <option value="{{ $room->id }}" @selected($room->id == $value)>{{ $room->name }}</option>
    @endforeach
</select>