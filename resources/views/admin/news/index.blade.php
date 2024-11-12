@extends('admin.layouts.master')
@section('title', 'Informasi / Berita')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Informasi / Berita</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Informasi / Berita</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
        <x-action.create action="{{route('news.create')}}" />
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th width="3%">No</th>
                        <th>Image</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th width="25%">Action</th>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><x-image.small src="{{asset($item->image)}}" /></td>
                            <th>{{$item->title}}</th>
                            <th>{!! $item->news_category->name ?? '<i>Uncategory</i>' !!}</th>
                            <th>{{\Illuminate\Support\Str::limit($item->description,50)}}</th>
                            <td class="row m-auto">
                                <x-action.edit action="{{route('news.edit',$item->id)}}" />
                                <x-action.delete id="{{$item->id}}" action="{{route('news.destroy',$item->id)}}" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$news->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
