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
            <div class="block-header block-header-default">
                <a href="{{ route('finished_material.create') }}" class="btn btn-primary btn-sm" title="Tambah"><i class="fa fa-fw fa-plus"></i>&nbsp;Tambah</a>
            </div>
            <div class="block-content block-content-full">
                @include('helper.alert')
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                bLengthChange: true,
                pageLength: 10,
                ajax: {
                    url: "{{ route('finished_material.index') }}",
                },
                columns: [
                    {
                        data: "id", render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    { data: "code" },
                    { data: "name" },
                    { data: "qty" },
                    { data: "unit" },
                    { data: "price" },
                    { data: "action", orderable: false}
                ],
                columnDefs: [
                    { width: "5%", "targets": [0] },
                    { width: "15%", "targets": [1, 5] },
                    { width: "10%", "targets": [3, 4, 6] },
                    { width: "30%", "targets": [2] },
                    { className: "text-center", "targets": [0, 3, 6] }
                ]
            });
        })
    </script>
@endsection
