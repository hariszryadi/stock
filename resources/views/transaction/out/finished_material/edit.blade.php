@extends('layouts.app')

@section('content')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Edit {{ $title }}
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('finished_material_out.index') }}">{{ $title }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit {{ $title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        @include('helper.alert')
        <div class="block block-rounded">
            <form action="{{ route('finished_material_out.update', $tfm->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row justify-content-center py-sm-3 py-md-5">
                    <div class="col-sm-10 col-md-10">
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="date">Tanggal <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="date" name="date" value="{{ date('d-m-Y', strtotime($tfm->date)) }}" placeholder="d-m-Y" data-date-format="d-m-Y" style="background-color: #eee; pointer-events: none;" readonly>
                                    @error('date')
                                        <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="category">Kategori <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control" id="category" disabled>
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <option value="3" {{ $tfm->category == '4' ? 'selected' : '' }}>Penjualan</option>
                                        <option value="4" {{ $tfm->category == '5' ? 'selected' : '' }}>Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            @foreach ($tfm->detail as $key => $i)
                                <div class="row row-block {{ $key != 0 ? 'mt-4' : '' }}">
                                    <input type="hidden" name="id_detail[]" value="{{ $i->id }}">
                                    <input type="hidden" name="code[]" value="{{ $i->basic_material_id }}">
                                    <div class="col-sm-9">
                                        <label class="form-label" for="code.{{ $key }}">Barang Jadi <span class="text-danger">*</span></label>
                                        <select name="code[]" id="code.{{ $key }}" class="form-control js-select2" disabled>
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($fm as $item)
                                                <option value="{{ $item->code }}" {{ $i->basic_material_id == $item->id ? 'selected' : '' }}>{{ $item->code }} - {{ $item->name }} - ({{ $item->qty }})</option>
                                            @endforeach
                                        </select>
                                        @error('code.{{ $key }}')
                                            <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-label" for="qty.{{ $key }}">Qty <span class="text-danger">*</span></label>
                                        <input type="number" id="qty.{{ $key }}" class="form-control @error('qty.{{ $key }}') is-invalid @enderror" name="qty[]" value="{{ $i->qty }}" min="0">
                                        @error('qty.{{ $key }}')
                                            <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection