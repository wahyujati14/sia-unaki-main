@extends('admin.layouts.master')
@section('title', 'Informasi / Berita')
@section('content')
<section class="section">
        <div class="section-header">
            <h1>{{ request()->routeIs('news.create') ? 'Tambah Informasi / Berita' : 'Edit Informasi / Berita' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{route('news.index')}}">Informasi / Berita</a></div>
                <div class="breadcrumb-item">
                    {{ request()->routeIs('News.create') ? 'Tambah Informasi / Berita' : 'Edit Informasi / Berita' }}
                </div>
            </div>
        </div>
    <div class="section-body">
    <div class="card card-primary">
    <div class="card-body">
        <form action="{{ request()->routeIs('news.create') ? route('news.store'): route('news.update', @$news->id) }}"  method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
            @csrf
            <x-form.put-method />
            <x-form.image-upload value="{{@$news->image}}" />
            <div class="form-group">
                <label>Judul</label>
                <input name="title" class="form-control" type="text" value="{{@$news->title ?? old('title')}}" tabindex="1" required>
                <div class="invalid-feedback">
                      Judul harus diisi
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="news_category_id" class="form-control" tabindex="2">
                    <option value="">--Pilih Kategori--</option>
                    @foreach($categories as $category)
                    <option {{$category->id == @$news->news_category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea style="min-height: 100px;" name="description" tabindex="3" class="form-control">{{@$news->description ?? old('description')}}</textarea>
                <div class="invalid-feedback">
                      Deskripsi harus diisi
                </div>
            </div>
            <x-action.cancel url="{{route('news.index')}}" />
            <x-action.save/>
        </form>
    </div>
</div>
    </div>
<section>
@endsection
