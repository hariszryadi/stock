<?php

namespace App\Imports;

use App\Models\BasicMaterial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BasicmaterialImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BasicMaterial([
            'code' => $row['kode'] != null ? $row['kode'] : '-',
            'name' => $row['nama_barang'] != null ? $row['nama_barang'] : '-',
            'price' => 0,
            'qty' => 0
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
