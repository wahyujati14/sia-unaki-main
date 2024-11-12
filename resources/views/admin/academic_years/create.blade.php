@extends('admin.layouts.master',['title'=>'Tambah Tahun Akademik'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Tahun Akademik',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Tahun Akademik', 
            'slug' => 'academic_years'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('academic_years.store')}}" method="POST">
                <div class="card-header">
                <h4>Tahun Akademik</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @php
                        $years = date('Y');
                    @endphp
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="first_year" id="" required class="form-control">
                            <option value="">PILIH</option>
                            @for ($i = $years - 5; $i <= $years + 5; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="odd_even" id="" required class="form-control">
                            <option value="">PILIH</option>
                            <option value="GANJIL">GANJIL</option>
                            <option value="GENAP">GENAP</option>
                        </select>
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