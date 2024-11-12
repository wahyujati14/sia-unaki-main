@if (session()->has('success'))
<div class="alert alert-success alert-has-icon">
<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
<div class="alert-body">
    <div class="alert-title">Success</div>
    {{session()->get('success')}}
</div>
</div>
@elseif(session()->has('failed'))
<div class="alert alert-danger alert-has-icon">
<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
<div class="alert-body">
    <div class="alert-title">Danger</div>
    {{session()->get('failed')}}
</div>
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
