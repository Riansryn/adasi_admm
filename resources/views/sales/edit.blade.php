@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Halaman Ubah Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Menu Handling</a></li>
                    <li class="breadcrumb-item active">Halaman Ubah Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Ubah Data</h5>
                        <form action="{{ route('update', $handlings->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="no_wo" class="col-sm-2 col-form-label">No. WO:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="no_wo" name="no_wo"
                                                maxlength="6" style="width: 100%;"
                                                value="{{ $handlings->no_wo }}" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="customer_code" class="col-sm-5 col-form-label">Kode Pelanggan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="customer_id" id="customer_id_code" class="select2"
                                                style="width: 100%" onchange="updateCustomerInfo()">
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        @if ($customer->id == $handlings->customer_id) selected @endif
                                                        data-name_customer="{{ $customer->name_customer }}"
                                                        data-area="{{ $customer->area }}">{{ $customer->customer_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="customer_name" class="col-sm-5 col-form-label">Nama Pelanggan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="customer_name" id="customer_id_name" class="select2"
                                                style="width: 100%" disabled>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->name_customer }}">
                                                        {{ $customer->name_customer }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="area" class="col-sm-5 col-form-label">Area Pelanggan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="area" id="customer_id_area" class="select2" style="width: 100%"
                                                disabled>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->area }}">{{ $customer->area }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="area" class="col-sm-5 col-form-label">Tipe Bahan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="type_id" id="type_id" class="" style="width: 100%">
                                                @foreach ($type_materials as $typeMaterial)
                                                    <option value="{{ $typeMaterial->id }}"
                                                        @if ($typeMaterial->id == $handlings->type_id) selected @endif>
                                                        {{ $typeMaterial->type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="t" class="form-label">T:</label>
                                            <input type="text" class="form-control input-sm" id="thickness"
                                                name="thickness" placeholder="Thickness" style="max-width: 80%;"
                                                value="{{ $handlings->thickness }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">W:</label>
                                            <input type="text" class="form-control input-sm" id="weight"
                                                name="weight" placeholder="Weight" style="max-width: 80%;"
                                                value="{{ $handlings->weight }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">L:</label>
                                            <input type="text" class="form-control input-sm" id="lenght"
                                                name="lenght" placeholder="Lenght" style="max-width: 80%;"
                                                value="{{ $handlings->lenght }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">OD:</label>
                                            <input type="text" class="form-control input-sm" id="outer_diameter"
                                                name="outer_diameter" placeholder="Outer Diameter" style="max-width: 40%"
                                                value="{{ $handlings->outer_diameter }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">ID:</label>
                                            <input type="text" class="form-control input-sm" id="inner_diameter"
                                                name="inner_diameter" placeholder="Inner Diameter" style="max-width: 40%"
                                                value="{{ $handlings->inner_diameter }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="qty" class="form-label">QTY (Kg):</label>
                                            <input type="text" class="form-control input-sm" id="qty"
                                                name="qty" style="max-width: 40%;" value="{{ $handlings->qty }}"
                                                required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pcs" class="form-label">Unit (Pcs):</label>
                                            <input type="text" class="form-control input-sm" id="pcs"
                                                name="pcs" style="max-width: 40%" value="{{ $handlings->pcs }}"
                                                required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="category" class="col-sm-5 col-form-label">Kategori (NG):<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="category" class="form-control" id="category"
                                                style="width: 100%" required>
                                                <option value="">------------------- Category -----------------
                                                </option>
                                                <option value="Retak"
                                                    {{ $handlings->category == 'Retak' ? 'selected' : '' }}>
                                                    Retak</option>
                                                <option value="Pecah"
                                                    {{ $handlings->category == 'Pecah' ? 'selected' : '' }}>
                                                    Pecah</option>
                                                <option value="Etc"
                                                    {{ $handlings->category == 'Etc' ? 'selected' : '' }}>
                                                    Etc
                                                </option>
                                                <!-- Tambahkan opsi statis lainnya jika diperlukan -->
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="hasil_tindak_lanjut" class="col-sm-5 col-form-label">Keterangan:
                                                (Jika ada)</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" rows="5" id="results" name="results" style="width: 100%">{{ $handlings->results }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="process_type" class="col-sm-5 col-form-label">Jenis Proses:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="process_type" class="form-control" id="process_type"
                                                style="width: 100%" required>
                                                <option value="">------------------- Jenis Proses -----------------
                                                </option>
                                                <option value="Heat Treatment"
                                                    {{ $handlings->process_type == 'Heat Treatment' ? 'selected' : '' }}>
                                                    Heat
                                                    treatment</option>
                                                <option value="Cutting"
                                                    {{ $handlings->process_type == 'Cutting' ? 'selected' : '' }}>
                                                    Cutting
                                                </option>
                                                <option value="Machining"
                                                    {{ $handlings->process_type == 'Machining' ? 'selected' : '' }}>
                                                    Machining
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="type_1" class="col-sm-5 col-form-label">Jenis:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="type_1"
                                                    name="type_1" value="Komplain"
                                                    @if ($handlings->type_1 == 'Komplain') checked @endif>
                                                <label class="form-check-label" for="check2">Komplain</label>
                                            </div>
                                            <div class="form-check mr-2">
                                                <input type="checkbox" class="form-check-input" id="type_2"
                                                    name="type_2" value="Klaim"
                                                    @if ($handlings->type_2 == 'Klaim') checked @endif>
                                                <label class="form-check-label" for="check1">Klaim</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="image_upload" class="col-sm-5 col-form-label">Unggah Gambar:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                type="file" id="formFile" name="images[]" accept="image/*"
                                                style="width: 100%" multiple onchange="viewImages(event);">
                                            <small id="fileError" class="text-danger" style="display:none;">Format berkas
                                                tidak sesuai. Silakan unggah gambar.</small>
                                            <!-- error message untuk title -->
                                            @error('image')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="row mt-3">
                                                <div id="imagePreviewContainer" class="row"
                                                    style="display: flex; flex-wrap: wrap;"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row mt-3">
                                                <div id="imagePreviewContainer" class="row">
                                                    <div class="col-lg-12 mb-2 d-flex justify-content-start">
                                                        @foreach(json_decode($handlings->image) as $image)
                                                            <img src="{{ asset('assets/image/' . $image) }}" class="img-fluid rounded mx-1" alt="image" style="max-width: 200px; object-fit: cover;">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3" style="margin-top: 2%">
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mb-4 me-3">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                        <button type="button" class="btn btn-primary mb-4" onclick="goToIndex()">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
        </section>
        <script>
            function updateCustomerInfo() {
                var customerIdCodeSelect = document.getElementById('customer_id_code');
                var customerIdNameSelect = document.getElementById('customer_id_name');
                var customerIdAreaSelect = document.getElementById('customer_id_area');

                var selectedOption = customerIdCodeSelect.options[customerIdCodeSelect.selectedIndex];
                customerIdNameSelect.value = selectedOption.getAttribute('data-name_customer');
                customerIdAreaSelect.value = selectedOption.getAttribute('data-area');
            }

            document.getElementById('formFile').addEventListener('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var imgElement = document.getElementById('uploadedImage');
                    imgElement.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            });

            //cancel upload
            function viewImages(event) {
                const files = event.target.files;
                const previewContainer = document.getElementById('imagePreviewContainer');
                previewContainer.innerHTML = '';

                for (const file of files) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style.maxWidth = '30%'; // Lebar maksimum gambar
                        imgElement.style.height = 'auto'; // Tinggi gambar disesuaikan
                        imgElement.style.marginRight = '10px'; // Spasi antar gambar
                        imgElement.style.marginBottom = '10px'; // Spasi antar baris
                        imgElement.className = 'img-fluid rounded';
                        previewContainer.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>

    </main><!-- End #main -->
@endsection
