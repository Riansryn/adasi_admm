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
                <!-- Section 1 - Form -->
                <div class="col-mt-4">
                    <div class="card">
                        <div class="accordion">
                            <div class="card-body">
                                <h5 class="card-title">Form Lihat Mesin</h5>
                                <!-- Form di sini -->
                                <div class="collapse" id="updateProgress">
                                    <form enctype="multipart/form-data">

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
                                            <label for="nama_mesin" class="form-label">Nama Mesin</label>
                                            <input type="text" class="form-control" id="nama_mesin" name="nama_mesin" value="{{ $mesin->nama_mesin }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="no_mesin" class="form-label">No Mesin</label>
                                            <input type="text" class="form-control" id="no_mesin" name="no_mesin" value="{{ $mesin->no_mesin }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="merk" class="form-label">Merk</label>
                                            <input type="text" class="form-control" id="merk" name="merk" value="{{ $mesin->merk }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="type" class="form-label">Type</label>
                                            <input type="text" class="form-control" id="type" name="type" value="{{ $mesin->type }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="mfg_date" class="form-label">Manufacturing date</label>
                                            <input type="number" class="form-control" id="mfg_date" name="mfg_date" placeholder="YYYY" min="1900" max="{{ date('Y') }}" value="{{ $mesin->mfg_date }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="acq_date" class="form-label">Acquisition date</label>
                                            <input type="number" class="form-control" id="acq_date" name="acq_date" placeholder="YYYY" min="1900" max="{{ date('Y') }}" value="{{ $mesin->acq_date }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="text" class="form-control" id="age" name="age" readonly value="{{ $mesin->age }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="preventive_date" class="form-label">Schedule Preventive Date</label>
                                            <input type="date" class="form-control" id="preventive_date" name="preventive_date" value="{{ $mesin->preventive_date }}">
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
                                    <h5 class="card-title">Table List Sparepart</h5>
                                </b>
                                <div class="collapse" id="updateProgress">
                                    <table class="table table-bordered datatable" id="table1" style="width:100%">
                                        <!-- Isi tabel 1 disini -->
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Sparepart</th>
                                                <th>Vendor</th>
                                                <th>Leadtime</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Item 1</td>
                                                <td>Vendor A</td>
                                                <td>3 Hari</td>
                                            </tr>
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
                                    <h5 class="card-title">Table History Kerusakan Mesin</h5>
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