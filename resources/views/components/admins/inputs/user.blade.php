<select name="user_id" id="" class="form-control m-1">
    <option value="">Pilih Mahasiswa</option>
    @foreach ($users as $user)
        <option value="{{ $user->id }}" @selected($user->id == $value)>{{ $user->name }}</option>
    @endforeach
</select>