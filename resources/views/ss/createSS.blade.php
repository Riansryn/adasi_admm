@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form SS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Form SS</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form SS</h5>

                            <!-- General Form Elements -->
                            <form>


                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Table View SS</h5>
                            <br>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#sumbangSaranModal"><i class="fas fa-plus"></i> Tambah</button>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th width="50px">NO</th>
                                        <th width="100px">Nama</th>
                                        <th width="100px">NPK</th>
                                        <th class="text-center" width="100px">Bagian</th>
                                        <th width="100px">Judul Ide</th>
                                        <th width="100px">Tanggal Pengajuan Ide</th>
                                        <th width="100px">Lokasi</th>
                                        <th width="100px">Tanggal Diterapkan</th>
                                        <th width="100px">Pembaruan Terakhir</th>
                                        <th width="100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                            <td class="text-center py-3">{{ $data->users->name ?? '' }}</td>
                                            <td class="text-center py-3">{{ $data->users->npk ?? '' }}</td>
                                            <td class="text-center py-3">{{ $usersRoles[$data->id_user] ?? '' }}</td>
                                            <td class="text-center py-3">{{ $data->judul }}</td>
                                            <td class="text-center py-3">{{ $data->tgl_pengajuan_ide }}</td>
                                            <td class="text-center py-3">{{ $data->lokasi_ide }}</td>
                                            <td class="text-center py-3">{{ $data->tgl_diterapkan }}</td>
                                            <td class="text-center py-3">{{ $data->created_at }}</td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-primary btn-sm" title="Edit"><i
                                                        class="fa-solid fa-edit fa-1x"></i></a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('')"
                                                    title="Hapus"> <i class="fas fa-trash fa-1x"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sumbangSaranModal" tabindex="-1" aria-labelledby="sumbangSaranModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 90%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sumbangSaranModalLabel">Tambah Sumbang Saran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form goes here -->
                            <form id="sumbangSaranForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tgl. pengajuan Ide <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tgl_pengajuan_ide"
                                            name="tgl_pengajuan_ide" required>
                                        <input type="hidden" id="id_user" name="id_user" value="{{ Auth::user()->id }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Lokasi Ide <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="lokasi_ide" name="lokasi_ide"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tgl. Diterapkan<span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tgl_diterapkan"
                                            name="tgl_diterapkan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Judul Ide <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Keadaan Sebelumnya
                                        (Permasalahan) <span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" id="keadaan_sebelumnya" name="keadaan_sebelumnya" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Usulan Ide <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" id="usulan_ide" name="usulan_ide" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image_2" name="image_2">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Keuntungan Dari Penerapan
                                        Ide <span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" id="keuntungan_ide" name="keuntungan_ide" required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="submitForm()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function submitForm() {
                // Ambil data dari formulir
                var formData = new FormData(document.getElementById('sumbangSaranForm'));

                // Kirim data menggunakan AJAX ke route simpanSS
                $.ajax({
                    url: '{{ route('simpanSS') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success
                        console.log(response);
                        // Tutup modal
                        $('#sumbangSaranModal').modal('hide');
                        // Bersihkan formulir
                        document.getElementById('sumbangSaranForm').reset();
                        window.location.href = '{{ route('showSS') }}';
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                        // Tampilkan pesan kesalahan kepada pengguna
                        alert('Gagal menyimpan data. Silakan coba lagi.');
                    }
                });
            }
        </script>

    </main><!-- End #main -->
@endsection
