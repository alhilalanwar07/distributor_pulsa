<?php

namespace App\Imports;

use App\Models\Outlet;
use Maatwebsite\Excel\Concerns\ToModel;

class OutletsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Outlet([
            'kode_outlet' => $row[0],
            'nama_outlet' => $row[1],
            'nama_pemilik' => $row[2],
            'alamat_outlet' => $row[3],
            'telepon_pemilik' => $row[4],
            'cabang_id' => $row[5],
            'foto_outlet' => $row[6],
        ]);
    }
}
