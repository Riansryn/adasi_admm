<?php

namespace App\Imports;

use App\Models\Sparepart;
use App\Models\Mesin;
use Maatwebsite\Excel\Concerns\ToModel;

class SparepartImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Buat model Sparepart dan hubungkan dengan model Mesin yang ditemukan
        return new Sparepart([
            'Nama' => $row['Nama'],
            'Deskripsi' => $row['Deskripsi'],
            'Jumlah Stok' => $row['Jumlah Stok'],
        ]);
    }

    public function headingRowNumber(): int
    {
        return 1; // Nomor baris header
    }
}
