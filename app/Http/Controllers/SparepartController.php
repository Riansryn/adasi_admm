<?php

namespace App\Http\Controllers;

use App\Imports\SparepartImport;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Validation\Rule;

class SparepartController extends Controller
{
    public function import(Request $request)
    {
        // Jika validasi berhasil, lanjutkan dengan mengimpor data
        $nomorMesin = $request->input('nomor_mesin');
        Excel::import(new SparepartImport($nomorMesin), $request->file('file'));

        // Kembali ke halaman sebelumnya setelah import selesai
        return back();
    }
}
