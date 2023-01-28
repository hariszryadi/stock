@extends('layouts.app')

@section('content')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Tambah {{ $title }}
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('finished_material_in.index') }}">{{ $title }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Tambah {{ $title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <form action="{{ route('finished_material_in.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center py-sm-3 py-md-5">
                    <div class="col-sm-10 col-md-10">
                        <div class="mb-4">
                            <label class="form-label" for="date">Tanggal <span class="text-danger">*</span></label>
                            <input type="text" class="js-flatpickr form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" placeholder="d-m-Y" data-date-format="d-m-Y">
                            @error('date')
                                <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="row row-block">
                                <div class="col-sm-9">
                                    <label class="form-label" for="code.0">Barang Dasar <span class="text-danger">*</span></label>
                                    <select name="code[]" id="code.0" class="form-control js-select2 @error('code.0') is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        @foreach ($fm as $item)
                                            <option value="{{ $item->id }}" {{ old('code.0') == $item->id ? 'selected' : '' }}>{{ $item->code }} - {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('code.0')
                                        <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" for="qty.0">Qty <span class="text-danger">*</span></label>
                                    <input type="number" id="qty.0" class="form-control @error('qty.0') is-invalid @enderror" name="qty[]" value="{{ old('qty.0') }}" min="0">
                                    @error('qty.0')
                                        <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="button" class="btn btn-sm btn-success add"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    $('.add').click(function() {
        var index = $('.row-block').length;
        $('.row-block:last').after(`<div class="row row-block mt-4">
                                        <div class="col-sm-9">
                                            <label class="form-label" for="code.${index}">Barang Dasar <span class="text-danger">*</span></label>
                                            <select name="code[]" id="code.${index}" class="form-control js-select2 @error('code.${index}') is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                @foreach ($fm as $item)
                                                    <option value="{{ $item->id }}" {{ old('code.${index}') == $item->id ? 'selected' : '' }}>{{ $item->code }} - {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="form-label" for="qty.${index}">Qty <span class="text-danger">*</span></label>
                                            <input type="number" id="qty.${index}" class="form-control @error('qty.${index}') is-invalid @enderror" name="qty[]" value="{{ old('qty.0') }}" min="0">
                                        </div>
                                        <div class="col-sm-1 col-relative">
                                            <button type="button" class="btn btn-sm btn-danger remove"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>`);

        $('.js-select2').select2();
    });

    $(document).on('click', '.remove', function() {
        $(this).parent().closest('.row-block').remove();
    });
</script>
@endsection