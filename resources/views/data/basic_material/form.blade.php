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
                            <a class="link-fx" href="{{ route('detail_basic_material.index') }}">{{ $title }}</a>
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
                <form action="{{ route('detail_basic_material.update', $data->id) }}" method="POST">
                @method('PUT')
            @else
                <form action="{{ route('detail_basic_material.store') }}" method="POST">
            @endisset
                @csrf
                <div class="row justify-content-center py-sm-3 py-md-5">
                    <div class="col-sm-10 col-md-10">
                        <div class="mb-4">
                            <label class="form-label" for="basic_material">Barang Dasar <span class="text-danger">*</span></label>
                            <select name="basic_material" id="basic_material" class="form-control js-select2 @error('basic_material') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih --</option>
                                @isset($data)
                                    @foreach ($bm as $item)
                                        <option value="{{ $item->id }}" {{ $data->basic_material_id == $item->id ? 'selected' : '' }}>{{ $item->code }} - {{ $item->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($bm as $item)
                                        <option value="{{ $item->id }}" {{ old('basic_material') == $item->id ? 'selected' : '' }}>{{ $item->code }} - {{ $item->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('basic_material')
                                <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ isset($data) ? $data->quantity : old('quantity') }}" min="0">
                            @error('quantity')
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