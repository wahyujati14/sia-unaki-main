<div class="card author-box card-primary">
    <div class="card-header">
        <h4>PRODI</h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <td>Fakultas </td>
                <td> : </td>
                <td>{{ $student->study_programs_selected?->faculty?->name }}</td>
            </tr>
            <tr>
                <td>Program Studi </td>
                <td> : </td>
                <td>{{ $student->study_programs_selected?->name }}</td>
            </tr>
            <tr>
                <td>Dosen Wali </td>
                <td> : </td>
                <td>{{ $student->user_lecturers?->name }}</td>
            </tr>
            <tr>
                <td>IPK </td>
                <td> : </td>
                <td>{{ $student->ongoing_semester_performance_index }}</td>
            </tr>
            <tr>
                <td>Semester </td>
                <td> : </td>
                <td>{{ $student->cummulative_performance_index }}</td>
            </tr>
        </table>
    </div>
</div>
