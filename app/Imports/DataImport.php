<?php

namespace App\Imports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Data([
            'name' => $row['name'],
            'alamat' => $row['alamat'],
            'kavling' => $row['kavling'],
            'lokasi' => $row['lokasi'],
            'tipe' => $row['tipe'],
            'spk' => $row['spk'],
            'harga_deal' => $row['harga_deal'],
            'cicilan' => $row['cicilan'],
            'uang_masuk' => $row['uang_masuk'],
            'progres' => $row['progres'],
            // Add other columns here if needed
        ]);
    }
}