<div class="card card-primary">
    <div class="card-header">
      <h4>Sekolah Asal</h4>
    </div>
    <div class="card-body">
      <table>
        <tr>
          <td>Sekolah</td>
          <td>:</td>
          <td>{{$student->school_origin?->name}}</td>
        </tr>
        <tr>
          <td>Jurusan</td>
          <td>:</td>
          <td>{{$student->school_origin?->major}}</td>
        </tr>
        <tr>
          <td>Lulusan Tahun</td>
          <td>:</td>
          <td>{{$student->school_origin?->graduation_year}}</td>
        </tr>
      </table>
    </div>
  </div>