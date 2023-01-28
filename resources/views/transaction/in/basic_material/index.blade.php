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
                <a href="{{ route('basic_material_in.create') }}" class="btn btn-primary btn-sm" title="Tambah"><i class="fa fa-fw fa-plus"></i>&nbsp;Tambah</a>
            </div>
            <div class="block-content block-content-full">
                @include('helper.alert')
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Invoice</th>
                            <th>Tanggal</th>
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
                    url: "{{ route('basic_material_in.index') }}",
                },
                columns: [
                    {
                        data: "id", render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    { data: "invoice" },
                    { data: "date" },
                    { data: "action", orderable: false}
                ],
                columnDefs: [
                    { width: "5%", "targets": [0] },
                    { className: "text-center", "targets": [0, 1, 2, 3] }
                ]
            });
        })
    </script>
@endsection
