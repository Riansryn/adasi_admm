<?php

namespace App\Http\Controllers;

use App\Imports\SparepartImport;
use App\Models\Sparepart;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SparepartController extends Controller
{
    public function import()
    {
        Excel::import(new SparepartImport, request()->file('file'));

        return back();
    }

    public function model(array $row)
    {
        // Ambil nomor_mesin dari baris data yang diimpor
        $nomorMesin = $row['nomor_mesin'];

        // Cari model Mesin berdasarkan nomor_mesin
        $mesin = Mesin::where('no_mesin', $nomorMesin)->first();

        // Buat model Sparepart dan hubungkan dengan model Mesin yang ditemukan
        return new Sparepart([
            'nama_sparepart' => $row['nama_sparepart'],
            // Isi kolom lainnya sesuai dengan struktur file Excel Anda
            'no_mesin' => $mesin ? $mesin->no_mesin : null, // Simpan ID mesin jika ditemukan, jika tidak, simpan null
        ]);
    }
}
