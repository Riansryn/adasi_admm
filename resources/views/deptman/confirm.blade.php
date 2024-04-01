@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Halaman Konfirmasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('submission') }}">Menu Tindak Lanjut</a></li>
                    <li class="breadcrumb-item active">Halaman Konfirmasi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Konfirmasi</h5>
                        <form action="{{ route('updateConfirm', $handlings->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="no_wo" class="col-sm-2 col-form-label">No. WO</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_wo" name="no_wo"
                                        value="{{ $handlings->no_wo }}" maxlength="15" required readonly>
                                </div>
                            </div>
                            <!-- Customer Code -->
                            <div class="row mb-3">
                                <label for="customer_code" class="col-sm-2 col-form-label">Kode Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" id="customer_id_code" class="w-100 select2" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $handlings->customer_id) selected @endif>
                                                {{ $customer->customer_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Customer Name -->
                            <div class="row mb-3">
                                <label for="customer_name" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" id="customer_id_name" class="w-100 select2" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $handlings->customer_id) selected @endif>
                                                {{ $customer->name_customer }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Area -->
                            <div class="row mb-3">
                                <label for="area" class="col-sm-2 col-form-label">Area Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" id="customer_id_area" class="w-100 select2" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $handlings->customer_id) selected @endif>
                                                {{ $customer->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="area" class="col-sm-2 col-form-label">Tipe Bahan</label>
                                <div class="col-sm-10">
                                    <select name="type_id" id="type_id" class="w-100" disabled>
                                        @foreach ($type_materials as $typeMaterial)
                                            <option value="{{ $typeMaterial->id }}"
                                                @if ($typeMaterial->id == $handlings->type_id) selected @endif>
                                                {{ $typeMaterial->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2 ps-5">
                                <div class="col-md-2">
                                    <label for="t" class="form-label">T:</label>
                                    <input type="text" class="form-control input-sm" id="thickness" name="thickness"
                                        placeholder="Thickness" value="{{ $handlings->thickness }}"
                                        style="max-width: 150px;" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">W:</label>
                                    <input type="text" class="form-control input-sm" id="weight" name="weight"
                                        placeholder="Weight" value="{{ $handlings->weight }}" style="max-width: 150px;"
                                        readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">OD:</label>
                                    <input type="text" class="form-control input-sm" id="outer_diameter"
                                        name="outer_diameter" value="{{ $handlings->outer_diameter }}"
                                        placeholder="Outer Diameter" style="max-width: 150px;" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">ID:</label>
                                    <input type="text" class="form-control input-sm" id="inner_diameter"
                                        name="inner_diameter" value="{{ $handlings->inner_diameter }}"
                                        placeholder="Inner Diameter" style="max-width: 150px;" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">L:</label>
                                    <input type="text" class="form-control input-sm" id="lenght" name="lenght"
                                        placeholder="Lenght" value="{{ $handlings->lenght }}" style="max-width: 150px;"
                                        readonly>
                                </div>
                            </div>
                            <div class="row mb-2 ps-5">
                                <div class="col-md-2">
                                    <label for="qty" class="form-label">Jumlah:</label>
                                    <input type="text" class="form-control input-sm" id="qty" name="qty"
                                        value="{{ $handlings->qty }}" placeholder="(/KG)" style="max-width: 150px;"
                                        required readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="pcs" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control input-sm" id="pcs" name="pcs"
                                        value="{{ $handlings->pcs }}" placeholder="(/PCS)" style="max-width: 150px;"
                                        required readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category" class="col-sm-2 col-form-label">Kategori (NG)</label>
                                <div class="col-sm-10">
                                    <select name="category" class="form-control" id="category" required disabled>
                                        <option value="">------------------- Category -----------------</option>
                                        <option value="Retak" {{ $handlings->category == 'Retak' ? 'selected' : '' }}>
                                            Retak</option>
                                        <option value="Pecah" {{ $handlings->category == 'Pecah' ? 'selected' : '' }}>
                                            Pecah</option>
                                        <option value="Etc" {{ $handlings->category == 'Etc' ? 'selected' : '' }}>Etc
                                        </option>
                                        <!-- Tambahkan opsi statis lainnya jika diperlukan -->
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="hasil_tindak_lanjut" class="col-sm-2 col-form-label">Catatan Hasil:
                                    (optional)</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" id="results" name="results" style="width: 29%" required>{{ $handlings->results }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="process_type" class="col-sm-2 col-form-label">Jenis Proses</label>
                                <div class="col-sm-10">
                                    <select name="process_type" class="form-control" id="process_type" required disabled>
                                        <option value="">------------------- Jenis Proses -----------------</option>
                                        <option value="HeatTreatment"
                                            {{ $handlings->process_type == 'HeatTreatment' ? 'selected' : '' }}>Heat
                                            treatment</option>
                                        <option value="Cutting"
                                            {{ $handlings->process_type == 'Cutting' ? 'selected' : '' }}>Cutting</option>
                                        <option value="Machining"
                                            {{ $handlings->process_type == 'Machining' ? 'selected' : '' }}>Machining
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type_1" class="col-sm-2 col-form-label">Jenis</label>
                                <div class="col-sm-10">
                                    <div class="form-check mr-2">
                                        <input type="checkbox" class="form-check-input" id="type_1" name="type_1" disabled
                                            value="Klaim" @if ($handlings->type_1 == 'Klaim') checked @endif>
                                        <label class="form-check-label" for="check1">Klaim</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="type_1" name="type_1" disabled
                                            value="Komplain" @if ($handlings->type_1 == 'Komplain') checked @endif>
                                        <label class="form-check-label" for="check2">Komplain</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('assets/image/' . $handlings->image) }}"
                                        class="img-fluid img-thumbnail rounded" style="max-width: 350px;">
                                </div>
                            </div>
                            <div class="row mb-3" style="margin-top: 2%">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mb-4 me-2"
                                        onclick="buttonConfirm()">
                                        <i class="fas fa-save"></i> Konfirmasi
                                    </button>
                                    <button type="button" class="btn btn-primary mb-4 me-2" onclick="goToSubmission()">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
        <script>
            function buttonConfirm() {
                // Simulasi validasi
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data telah berhasil di simpan',
                    showConfirmButton: false 
                });
            }

        </script>
    </main><!-- End #main -->
    
@endsection
