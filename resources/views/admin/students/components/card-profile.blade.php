<div class="card author-box card-primary">
    <div class="card-body">
        <div class="author-box-left">
            @if ($student->user_information?->avatar)
                <img alt="image" src="{{ url('storage/' . $student->user_information->avatar) }}"
                    class="rounded-circle author-box-picture">
            @else
                <img alt="image" src="{{ url('/') }}/stisla-master/assets/img/avatar/avatar-1.png"
                    class="rounded-circle author-box-picture">
            @endif
            <div class="clearfix"></div>
            <a href="#" class="btn btn-primary mt-3 follow-btn" data-follow-action="alert('follow clicked');"
                data-unfollow-action="alert('unfollow clicked');">{{ $student->nim ? $student->nim : 'Belum ada NIM' }}</a>
        </div>
        <div class="author-box-details">
            <div class="author-box-name">
                {{ $student->name }}
            </div><br>
            <table>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $student->email }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td>{{ $student->phone }}</td>
                </tr>
                <tr>
                    <td>Jalur Pendaftaran</td>
                    <td>:</td>
                    <td>{{ $student->user_information?->registration_path?->name }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pendaftaran</td>
                    <td>:</td>
                    <td>{{ date('Y-m-d', strtotime($student->created_at)) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
