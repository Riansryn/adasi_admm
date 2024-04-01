<?php

namespace App\Imports;

use App\Models\Sparepart;
use App\Models\Mesin;
use Illuminate\Validation\Rule;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class SparepartImport implements ToModel
{
    protected $nomorMesin;

    public function __construct($nomorMesin)
    {
        $this->nomorMesin = $nomorMesin;
    }

    public function model(array $row)
    {
        // Check if there are any duplicate records based on nomor_mesin, nama, deskripsi, and jumlah
        $duplicateRecords = Sparepart::where('nomor_mesin', $this->nomorMesin)
            ->where('nama', $row[1])
            ->where('deskripsi', $row[2])
            ->where('jumlah', $row[3])
            ->exists();

        // If duplicate records exist, return null
        if ($duplicateRecords) {
            return null;
        }

        return new Sparepart([
            'nomor_mesin' => $this->nomorMesin,
            'nama' => $row[1] ?? null,
            'deskripsi' => $row[2] ?? null,
            'jumlah' => $row[3] ?? null,
        ]);
    }

    public function getHeadingRow(): int
    {
        return 1; // Nomor baris header
    }
}
