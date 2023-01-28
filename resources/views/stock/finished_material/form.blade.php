@extends('layouts.app')

@section('content')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        {{ isset($data) ? 'Edit' : 'Tambah' }} {{ $title }}
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('finished_material.index') }}">{{ $title }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            {{ isset($data) ? 'Edit' : 'Tambah' }} {{ $title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            @isset($data)
                <form action="{{ route('finished_material.update', $data->id) }}" method="POST">
                @method('PUT')
            @else
                <form action="{{ route('finished_material.store') }}" method="POST">
            @endisset
                @csrf
                <div class="row justify-content-center py-sm-3 py-md-5">
                    <div class="col-sm-10 col-md-10">
                        <div class="mb-4">
                            <label class="form-label" for="code">Kode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ isset($data) ? $data->code : old('code') }}" placeholder="Kode">
                            @error('code')
                                <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="name">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($data) ? $data->name : old('name') }}" placeholder="Nama Barang">
                            @error('name')
                                <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="qty">Qty <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ isset($data) ? $data->qty : old('qty') }}" min="0">
                            @error('qty')
                                <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="price">Harga <span class="text-danger">*</span></label>
                            <input type="text" class="form-control price-format @error('price') is-invalid @enderror" id="price" name="price" value="{{ isset($data) ? number_format($data->price,0,',',',') : old('price') }}">
                            @error('price')
                                <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">{{ isset($data) ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection