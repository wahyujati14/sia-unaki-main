@extends('admin.layouts.master')
@section('title', 'Informasi / Berita')
@section('content')
<section class="section">
        <div class="section-header">
            <h1>{{ request()->routeIs('news-category.create') ? 'Tambah Informasi / Berita' : 'Edit Informasi / Berita' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{route('news-category.index')}}">Informasi / Berita</a></div>
                <div class="breadcrumb-item">
                    {{ request()->routeIs('news-category.create') ? 'Tambah Informasi / Berita' : 'Edit Informasi / Berita' }}
                </div>
            </div>
        </div>
    <div class="section-body">
    <div class="card card-primary">
    <div class="card-body">
        <form action="{{ request()->routeIs('news-category.create') ? route('news-category.store'): route('news-category.update', @$newsCategory->id) }}"  method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
            @csrf
            <x-form.put-method />
            <div class="form-group">
                <label>Kategori</label>
                <input name="name" class="form-control" type="text" value="{{@$newsCategory->name ?? old('name')}}" tabindex="1" required>
                <div class="invalid-feedback">
                      Kategori harus diisi
                </div>
            </div>
            <x-action.cancel url="{{route('news-category.index')}}" />
            <x-action.save/>
        </form>
    </div>
</div>
    </div>
<section>
@endsection
