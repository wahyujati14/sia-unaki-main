@extends('admin.layouts.master')
@section('title', 'Kategori Informasi / Berita')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kategori Informasi / Berita</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Kategori Informasi / Berita</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
        <x-action.create action="{{route('news-category.create')}}" />
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th width="3%">No</th>
                        <th>Kategori</th>
                        <th width="25%">Action</th>
                    </thead>
                    <tbody>
                        @foreach($newsCategories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td class="row m-auto">
                                <x-action.edit action="{{route('news-category.edit',$category->id)}}" />
                                <x-action.delete id="{{$category->id}}" action="{{route('news-category.destroy',$category->id)}}" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$newsCategories->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
