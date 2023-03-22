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
            margin-top: 24px;
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
    <h2 class="text-center">{{ $title }}</h2>
    <p style="margin-bottom: 8px;"><span class="space">Kode</span> : <b>{{ $bm->code }}</b></p>
    <p style="margin-bottom: 8px;"><span class="space">Nama Barang</span> : <b>{{ $bm->name }}</b></p>
    <p style="margin-bottom: 8px;"><span class="space">Dari Tanggal</span> : <b>{{ date('d-m-Y', strtotime($start_date)) }}</b></p>
    <p style="margin-bottom: 8px;"><span class="space">Sampai Tanggal</span> : <b>{{ date('d-m-Y', strtotime($end_date)) }}</b></p>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Tanggal</th>
                <th class="text-center" style="width: 10%;">Masuk</th>
                <th class="text-center" style="width: 10%;">Keluar</th>
                <th class="text-center" style="width: 10%;">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
                function getMasuk($status, $qty) {
                    if(str_contains($qty, ',')>0) {
                        return explode(',', $qty)[0];
                    } else {
                        if ($status == 1) {
                            return $qty;
                        } else {
                            return '0';
                        }
                    }
                }

                function getKeluar($status, $qty) {
                    if(str_contains($qty, ',')>0) {
                        return explode(',', $qty)[1];
                    } else {
                        if ($status == 0) {
                            return $qty;
                        } else {
                            return '0';
                        }
                    }
                }

                function getSaldo($qty) {
                    if (str_contains($qty, ',')>0) {
                        return explode(',', $qty)[0] + explode(',', $qty)[1];
                    } else {
                        return $qty;
                    }
                }
            @endphp

            @if (!empty($data))
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                        <td class="text-center">{{ getMasuk($item->status, $item->qty) }}</td>
                        <td class="text-center">{{ getKeluar($item->status, $item->qty) }}</td>
                        <td class="text-center">{{ getSaldo($item->qty) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right;"><b>TOTAL</b></td>
                    <td class="text-center"><b>{{ $total }}</b></td>
                </tr>
            @else
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>