@extends('layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<main id="main" class="main">
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Preventive Maintenance</h2>
                            <form id="FPPForm" action="{{ route('mesins.updatePreventive', $mesin->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nama_mesin" class="form-label">
                                        Nama Mesin<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama_mesin" name="nama_mesin" value="{{ $mesin->nama_mesin }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="no_mesin" class="form-label">
                                        No Mesin<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="no_mesin" name="no_mesin" value="{{ $mesin->no_mesin }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">
                                        Type<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="type" name="type" value="{{ $mesin->type }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="mfg_date" class="form-label">
                                        Manufacturing date<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="mfg_date" name="mfg_date" placeholder="YYYY" min="1900" max="{{ date('Y') }}" value="{{ $mesin->mfg_date }}" disabled>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Tabel Checklist Pengecekan</h2>
                            <div class="table-responsive">
                                <!-- Your table goes here -->
                                <table class="table datatable w-100">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Aktivitas</th>
                                            <th scope="col">Checklist</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0 @endphp
                                        @foreach ($detailPreventives as $detailPreventive)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $detailPreventive->perbaikan }}</td>
                                            <td>
                                                <span class="status-badge {{ $detailPreventive->checked_status_color }}">
                                                    @if ($detailPreventive->perbaikan_checked === 1)
                                                    Sudah Terceklis
                                                    @else
                                                    Belum Terceklis
                                                    @endif
                                                </span>
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
    </section>
</main>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Menangkap elemen input file
        var gambarInput = document.getElementById('gambar');

        // Menangkap elemen gambar
        var gambarPreview = document.getElementById('gambarPreview');

        // Mengatur listener untuk input file
        fotoInput.addEventListener('change', function() {
            previewImage(this, gambarPreview);
        });

        // Fungsi untuk menampilkan preview gambar
        function previewImage(input, previewElement) {
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                previewElement.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>

<style>
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .checked {
        background-color: #4CAF50;
        color: white;
    }

    .unchecked {
        background-color: #F44336;
        color: white;
    }
</style>
