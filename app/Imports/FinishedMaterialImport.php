<?php

namespace App\Imports;

use App\Models\FinishedMaterial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class FinishedMaterialImport implements ToModel, WithHeadingRow
{
    use RemembersRowNumber;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FinishedMaterial([
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
