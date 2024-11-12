@extends('admin.layouts.master',['title'=>'Jadwal KRS'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Jadwal KRS',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Jadwal KRS', 
            'slug' => 'schedule_study_plan_cards'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('schedule_study_plan_cards.update', $schedule->id)}}" method="POST">
                <div class="card-header">
                <h4>Jadwal KRS</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <x-admins.inputs.academic-year required :value="$schedule->academic_year_id"/>
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <x-admins.inputs.study-program required :value="$schedule->study_program_id"/>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="datetime-local" name="start_time" value="{{ $schedule->start_time }}" class="form-control" required id="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="datetime-local" name="end_time" value="{{ $schedule->end_time }}" class="form-control" required id="">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection