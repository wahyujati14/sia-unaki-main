@extends('admin.layouts.master',['title'=>'Periode'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Periode',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Periode', 
            'slug' => 'registration_periodes'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('registration_periodes.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mulai</th>
                    <th>Berakhir</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($registration_periodes as $registration_periode)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$registration_periode->name}}</td>
                        <td>{{date('d-m-Y H:i:s', strtotime($registration_periode->start_at))}}</td>
                        <td>{{date('d-m-Y H:i:s', strtotime($registration_periode->end_at))}}</td>
                        <td class="row m-auto">
                          <a class="text-white badge badge-{{($registration_periode->is_active)?'success':'danger'}}">{{($registration_periode->is_active)?'Aktif':'Tidak Aktif'}}</a></td>
                        <td class="row m-auto">
                          <a href="{{route('registration_periodes.edit', $registration_periode->id)}}" class="badge badge-primary">Edit</a>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

