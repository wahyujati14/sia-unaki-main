@extends('admin.layouts.master',['title'=>'Edit Periode'])
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Edit Periode',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Edit Periode', 
            'slug' => 'registration_periodes'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('registration_periodes.update', $registration_periode->id)}}" method="POST">
                <div class="card-header">
                <h4>Edit Periode</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Nama Periode</label>
                      <input type="text" class="form-control" name="name" value="{{$registration_periode->name}}">
                    </div>
                    <div class="form-group">
                      <label>Start Date</label>
                      <input type="date" class="form-control" name="start_at" value="{{date('Y-m-d', strtotime($registration_periode->start_at))}}">
                    </div>
                    <div class="form-group">
                      <label>End Date</label>
                      <input type="date" class="form-control" name="end_at" value="{{date('Y-m-d', strtotime($registration_periode->end_at))}}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" id="" class="form-control">
                          <option value="true" {{($registration_periode->is_active == true)?'selected':''}}>Aktif</option>
                          <option value="false" {{($registration_periode->is_active == false)?'selected':''}}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('js')
{{-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(".datepicker").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        changeYear: true,
        showButtonPanel: true,
        autoclose:true //to close picker once year is selected
    });
</script>
@endpush