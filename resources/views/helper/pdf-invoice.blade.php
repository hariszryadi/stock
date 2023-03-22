<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" id="css-main" href="{{ base_path('public/assets/css/oneui.css') }}">
    <style>
        .space {
            display: inline-block;
            width: 125px;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        thead th {
            width: 25%;
        }
    </style>
</head>
<body>
    <h2 class="text-center">{{ $data[0]->status == 1 ? 'Invoice Barang Masuk' : 'Invoice Barang Keluar' }}</h2>
    <p style="margin-bottom: 8px;"><span class="space">No. Invoice</span> : <b>{{ $data[0]->invoice }}</b></p>
    <p><span class="space">Tanggal</span> : <b>{{ date('d-m-Y', strtotime($data[0]->date)) }}</b></p>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 20%;">Kode</th>
                <th>Nama Barang</th>
                <th class="text-center" style="width: 10%;">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td align="center">{{ $item->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>