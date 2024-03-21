<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Handling;
use App\Models\Customer;
use App\Models\TypeMaterial;
use App\Models\ScheduleVisit;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class HandlingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Handling::with('customers', 'type_materials')
            ->orderByRaw('FIELD(status, 0) DESC, created_at DESC')
            ->whereIn('status', [0, 1, 2, 3])
            ->paginate();


        return view('sales.handling', compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function barChart(){
        // Mengambil data dari database
        $handlings = Handling::select('status', 'status_2', 'created_at')->get();
    
        // Mengonversi data ke format yang sesuai untuk JavaScript
        $bulan = [];
        $data1 = [];
        $data2 = [];
    
        foreach ($handlings as $handling) {
            $bulan[] = $handling->created_at->format('F'); // Formatkan tanggal menjadi nama bulan
            $data1[] = $handling->status;
            $data2[] = $handling->status_2;
        }
    
        return view('dashboard.dashboardHandling', compact('bulan', 'data1', 'data2'));
    }
    

    public function changeStatus($id)
    {
        // Temukan data berdasarkan ID
        $data = Handling::findOrFail($id);

        // Ubah status menjadi 3 (Close)
        $data->status = 3;
        $data->save();

        // Redirect kembali ke halaman yang sesuai (opsional)
        return redirect()->route('index')->with('success', 'Status changed successfully.');
    }

    public function showHistory($id)
    {
        //get handlings by ID
        $handlings = Handling::findOrFail($id);

        $customers = Customer::all();
        $type_materials = TypeMaterial::all();
        $data = ScheduleVisit::where('handling_id', $id)->get();

        //render view with handlings
        return view('sales.showHistory', compact('handlings', 'customers', 'type_materials', 'data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {

        $customers = Customer::all();
        $type_materials = TypeMaterial::all();

        return view('sales.create', compact('customers', 'type_materials'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        // Cek apakah file gambar diunggah
        // Cek apakah file gambar diunggah
        if ($request->hasFile('image')) {
            // Validasi file gambar
            $request->validate([
                'image' => 'image|mimes:jpeg,jpg,png',
            ]);

            // Pindahkan foto ke direktori public/assets/foto
            $image = $request->file('image');
            $imagePath = $image->hashName(); // Gunakan hashname sebagai nama file
            $image->move(public_path('assets/image'), $imagePath);
        } else {
            $imagePath = null;
        }
        // Dapatkan tahun saat ini
        $currentYear = date('Y');

        // Buat nomor WO dengan menambahkan tahun saat ini
        $no_wo = 'WO/' . $currentYear . '/' . $request->no_wo;
        // Buat data handling
        Handling::create([
            'no_wo'             => $no_wo,
            'customer_id'       => $request->customer_id,
            'type_id'           => $request->type_id,
            'thickness'         => $request->thickness,
            'weight'            => $request->weight,
            'outer_diameter'    => $request->outer_diameter,
            'inner_diameter'    => $request->inner_diameter,
            'lenght'            => $request->lenght,
            'qty'               => $request->qty,
            'pcs'               => $request->pcs,
            'category'          => $request->category,
            'process_type'      => $request->process_type,
            'type_1'            => $request->type_1,
            'image'             => $imagePath, // Simpan nama file gambar atau null jika tidak ada gambar yang diunggah
            'status'            => 0,
            'status_2'          => 0
        ]);

        //redirect to index
        return redirect()->route('index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get handlings by ID
        $handlings = Handling::findOrFail($id);
        $customers = Customer::all();
        $type_materials = TypeMaterial::all();

        //render view with handlings
        return view('sales.edit', compact('handlings', 'customers', 'type_materials'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get post by ID
        $handlings = Handling::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            if ($request->hasFile('image')) {
                // Validasi file gambar
                $request->validate([
                    'image' => 'image|mimes:jpeg,jpg,png',
                ]);

                // Pindahkan foto ke direktori public/assets/foto
                $image = $request->file('image');
                $imagePath = $image->hashName(); // Gunakan hashname sebagai nama file
                $image->move(public_path('assets/image'), $imagePath);
            } else {
                $imagePath = null;
            }

            //delete old image
            // Hapus gambar lama jika ada
            if ($handlings->image) {
                $oldImagePath = public_path('assets/image/' . $handlings->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            //update post with new image
            $handlings->update([
                'no_wo'                 => $request->no_wo,
                'customer_id'           => $request->customer_id,
                'type_id'               => $request->type_id,
                'thickness'             => $request->thickness,
                'weight'                => $request->weight,
                'outer_diameter'        => $request->outer_diameter,
                'inner_diameter'        => $request->inner_diameter,
                'lenght'                => $request->lenght,
                'qty'                   => $request->qty,
                'pcs'                   => $request->pcs,
                'category'              => $request->category,
                'process_type'          => $request->process_type,
                'type_1'                => $request->type_1,
                'image'                 => $imagePath,
                'status'                => 0

            ]);
        } else {
            //update post without image
            $handlings->update([
                'no_wo'                 => $request->no_wo,
                'customer_id'           => $request->customer_id,
                'type_id'               => $request->type_id,
                'thickness'             => $request->thickness,
                'weight'                => $request->weight,
                'outer_diameter'        => $request->outer_diameter,
                'inner_diameter'        => $request->inner_diameter,
                'lenght'                => $request->lenght,
                'qty'                   => $request->qty,
                'pcs'                   => $request->pcs,
                'category'              => $request->category,
                'process_type'          => $request->process_type,
                'type_1'                => $request->type_1,
                'status'                => 0
            ]);
        }

        //redirect to index
        return redirect()->route('index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function delete($id): RedirectResponse
    {
        //get post by ID
        $handlings = Handling::findOrFail($id);

        //delete old image
        // Hapus gambar lama jika ada
        if ($handlings->image) {
            $oldImagePath = public_path('assets/image/' . $handlings->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        //delete post
        $handlings->delete();

        //redirect to index
        return redirect()->route('index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
