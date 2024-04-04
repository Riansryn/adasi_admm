@extends('layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Lihat mesin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-mt-4">
                    <div class="card">
                        <div class="accordion">
                            <div class="card-body">
                                <h5 class="card-title">Form Lihat Mesin</h5>
                                <!-- Form di sini -->
                                <div class="collapse" id="updateProgress">
                                    <form id="mesinForm" action="{{ route('mesins.update', $mesin->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="section" class="form-label">
                                                Section<span style="color: red;">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="section" name="section" value="{{ $mesin->section }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tipe" class="form-label">
                                                Tipe<span style="color: red;">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="tipe" name="tipe" value="{{ $mesin->tipe }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="no_mesin" class="form-label">
                                                Nomor Mesin<span style="color: red;">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="no_mesin" name="no_mesin" value="{{ $mesin->no_mesin }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tanggal_dibuat" class="form-label">
                                                Manufacturing Year<span style="color: red;">*</span>
                                            </label>
                                            <input type="number" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" value="{{ $mesin->tanggal_dibuat }}" min="1900" max="2099" onchange="hitungUmur()" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="umur" class="form-label">Umur<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="umur" name="umur" value="{{ $mesin->umur }}" readonly>
                                            <!-- Jika Anda ingin melakukan perhitungan Age secara otomatis, Anda perlu menambahkan JavaScript untuk menghitungnya. -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="spesifikasi" class="form-label">
                                                Spesifikasi<span style="color: red;">*</span>
                                            </label>
                                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" readonly>{{ $mesin->spesifikasi }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="lokasi" class="form-label">
                                                Lokasi Mesin<span style="color: red;">*</span>
                                            </label>
                                            <select class="form-select" id="lokasi" name="lokasi" disabled>
                                                <option value="" disabled>Pilih Lokasi Mesin</option>
                                                <option value="Deltamas" {{ strtoupper($mesin->lokasi) === 'DELTAMAS' ? 'selected' : '' }}>Deltamas</option>
                                                <option value="DS8" {{ strtoupper($mesin->lokasi) === 'DS8' ? 'selected' : '' }}>DS8</option>
                                                <option value="Surabaya" {{ strtoupper($mesin->lokasi) === 'SURABAYA' ? 'selected' : '' }}>Surabaya</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <div>
                                                @if($mesin->foto)
                                                <img id="fotoPreview" src="{{ asset($mesin->foto) }}" alt="Preview Foto" style="max-width: 200px;">
                                                @else
                                                <p>No image available</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="sparepart" class="form-label">Sparepart</label>
                                            <div>
                                                @if($mesin->sparepart)
                                                <img id="fotoPreview" src="{{ asset($mesin->sparepart) }}" alt="Preview Sparepart" style="max-width: 200px;">
                                                @else
                                                <p>No image available</p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mt-4">
                    <div class="card">
                        <div class="accordion">
                            <div class="card-body">
                                <b>
                                    <h5 class="card-title">Tabel List Sparepart - Mesin {{ $mesin->no_mesin }}</h5>
                                </b>
                                <div class="collapse" id="updateProgress">
                                    <form id="importForm" method="POST" action="{{ route('spareparts.import', ['nomor_mesin' => $mesin->no_mesin]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="file" name="file" class="form-control">
                                        <br>
                                        <button class="btn btn-danger">
                                            Import Sparepart
                                        </button>
                                    </form>
                                    <!-- Bagian HTML untuk menampilkan tabel sparepart -->
                                    <a class="btn btn-success float-end" href="{{ route('spareparts.export', ['nomor_mesin' => $mesin->no_mesin]) }}">Export Data</a>


                                    <br><br>
                                    <table class="table table-bordered datatable" id="table1" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Sparepart</th>
                                                <th>Deskripsi</th>
                                                <th>Jumlah Stok</th>
                                                <th>Tanggal Upload</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($spareparts as $index => $sparepart)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $sparepart->nama_sparepart }}</td>
                                                <td>{{ $sparepart->deskripsi }}</td>
                                                <td>{{ $sparepart->jumlah_stok }}</td>
                                                <td>{{ $sparepart->updated_at}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="accordion">
                                <b>
                                    <h5 class="card-title">Table History Kerusakan Mesin </h5>
                                </b>
                                <div class="collapse" id="updateProgress">
                                    <div class="text-end">
                                        <a href="{{ route('pdf.mesin', ['mesin' => $mesin]) }}" class="pdf-button">
                                            <i class="fas fa-file-pdf"></i> Generate PDF
                                        </a>
                                    </div>
                                    <table class="table table-bordered datatable" id="table2" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor FPP</th>
                                                <th>Mesin</th>
                                                <th>Section</th>
                                                <th>Lokasi</th>
                                                <th>Kendala</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($formperbaikans as $formperbaikan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> <!-- Menggunakan $loop->iteration untuk menampilkan nomor baris -->
                                                <td>{{ $formperbaikan->id_fpp }}</td>
                                                <td>{{ $formperbaikan->mesin }}</td>
                                                <td>{{ $formperbaikan->section }}</td>
                                                <td>{{ $formperbaikan->lokasi }}</td>
                                                <td>{{ $formperbaikan->kendala }}</td>
                                                <td>
                                                    <div style="background-color: {{ $formperbaikan->status_background_color }};
                                        border-radius: 5px; /* Rounded corners */
                                        padding: 5px 10px; /* Padding inside the div */
                                        color: white; /* Text color, adjust as needed */
                                        font-weight: bold; /* Bold text */
                                        text-align: center; /* Center-align text */
                                        text-transform: uppercase; /* Uppercase text */
                                    ">
                                                        {{ $formperbaikan->ubahtext() }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning" href="{{ route('fpps.show', $formperbaikan->id) }}">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
            $('#table2').DataTable();
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</main><!-- End #main -->

<script>
    function handleFormSubmission() {
        // Memeriksa apakah semua isian telah diisi
        var file = document.getElementById('file').value;

        if (file === '') {
            // Menampilkan SweetAlert jika ada isian yang kosong kecuali upload gambar
            Swal.fire({
                title: 'Data belum ada!',
                text: 'Mohon unggah file terlebih dahulu',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            // Jika formulir valid, tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data Sparepart berhasil diunggah.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect or perform any other action after clicking OK
                    document.getElementById('importForm').submit();
                }
            });
        }
    }

    // Event listener for form submission
    document.getElementById('importForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Call the function to handle form submission and show SweetAlert
        handleFormSubmission();
    });
</script>

<style>
    .pdf-button {
        background-color: red;
        /* Warna latar belakang */
        border: none;
        color: white;
        padding: 10px 20px;
        /* Padding agar tombol terlihat lebih luas */
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 4px;
    }

    .pdf-button i {
        margin-right: 5px;
        /* Spasi antara ikon dan teks */
    }
</style>

@endsection
