@extends('layouts.app')

@section('content')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        {{ $title }}
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            {{ $title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                @include('helper.alert')
                <form action="{{ route('recap_basic_material.getRecap') }}" method="post">
                    @csrf
                    <div class="row justify-content-center py-sm-3 py-md-5">
                        <div class="col-sm-10 col-md-10">
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label" for="code.0">Barang Dasar <span class="text-danger">*</span></label>
                                        <select name="code" id="code" class="form-control js-select2 @error('code') is-invalid @enderror">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($bm as $item)
                                                <option value="{{ $item->id }}" {{ old('code') == $item->id ? 'selected' : '' }}>{{ $item->code }} - {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('code')
                                            <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="start_date">Dari Tanggal <span class="text-danger">*</span></label>
                                        <input type="text" class="js-flatpickr form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" placeholder="d-m-Y" data-date-format="d-m-Y">
                                        @error('start_date')
                                            <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="end_date">Sampai Tanggal <span class="text-danger">*</span></label>
                                        <input type="text" class="js-flatpickr form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" placeholder="d-m-Y" data-date-format="d-m-Y">
                                        @error('end_date')
                                            <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    
@endsection
