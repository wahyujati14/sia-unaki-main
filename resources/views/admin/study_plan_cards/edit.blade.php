@extends('admin.layouts.master',['title'=>'KRS'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'KRS',
        'breadcrumbs' =>
      [    
        [
            'name' => 'KRS', 
            'slug' => 'study_plan_cards'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('study_plan_cards.update', $card->id)}}" method="POST">
                <div class="card-header">
                <h4>KRS</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <x-admins.inputs.academic-year required :value="$card->academic_year_id"/>
                    </div>
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <x-admins.inputs.user required :value="$card->user_id"/>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <x-admins.inputs.study-plan-card.status required :value="$card->status"/>
                    </div>
                    <div class="form-group">
                        <label for="">Catatan</label>
                        <textarea name="note" rows="10" class="form-control" required :value="$card->note"></textarea>
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