<?php

namespace App\Http\Controllers;

use App\Exports\SparepartExport;
use App\Imports\SparepartImport;
use App\Models\Mesin;
use App\Models\Sparepart;
use App\Models\Spa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Validation\Rule;

class SparepartController extends Controller
{
    public function import(Request $request)
    {
        // Jika validasi berhasil, lanjutkan dengan mengimpor data
        $nomorMesin = $request->input('nomor_mesin');
        $filePath = $request->file('file')->getRealPath();

        Excel::import(new SparepartImport($nomorMesin), $filePath, null, \Maatwebsite\Excel\Excel::XLSX, [
            'startRow' => 2
        ]);

        return back();
    }

    public function export(Request $request)
    {
        return Excel::download(new SparepartExport, 'Sparepart - Mesin .xlsx');
    }
}
