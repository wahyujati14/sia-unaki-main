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
    <div class="section-body">
      <form method="GET" action="{{ route('schedule_study_plan_cards.index') }}">
        <div class="card">
          <div class="card-header">
            <h4>Search Form</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <x-admins.inputs.academic-year :value="request()->get('academic_year_id')"/>
            </div>
            <div class="form-group">
              <x-admins.inputs.study-program :value="request()->get('study_program_id')"/>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Cari</button>
          </div>
        </div>
      </form>
      
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('schedule_study_plan_cards.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Tahun Ajaran</th>
                    <th>Program Studi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Durasi</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $schedule->academic_year->toDescriptionString() }}</td>
                        <td>{{ $schedule->study_program->name }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>{{ $schedule->duration }}</td>
                        <td class="row m-auto">
                            <a href="{{route('schedule_study_plan_cards.edit', $schedule->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('schedule_study_plan_cards.destroy', $schedule->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
                {{ $schedules->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection