<div class="section-header">
    <h1>{{$title}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="#" style="text-decoration: none;">Dashboard</a></div>
      @foreach ($breadcrumbs as $breadcrumb)
        <div class="breadcrumb-item"><a href="{{url('admin/'.$breadcrumb['slug'])}}" style="color:grey; text-decoration: none;">{{$breadcrumb['name']}}</a></div>
      @endforeach
      {{-- <div class="breadcrumb-item"><a href="{{$slug}}">{{$name}}</a></div> --}}
    </div>
</div>