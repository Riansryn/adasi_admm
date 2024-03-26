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
                            <form id="preventiveForm" action="{{ route('mesins.updatePreventive', $mesin->id) }}" method="POST" enctype="multipart/form-data">
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

                                <input type="hidden" name="confirmed_preventive" id="confirmed_preventive" value='0'>

                                <div class="text-end">
                                    <!-- Tombol Finish -->
                                    <button type="button" class="btn btn-primary" onclick="handleFinishButtonClick()">
                                        Finish
                                    </button>

                                    <!-- Tombol Cancel -->
                                    <button type="button" class="btn btn-secondary" onclick="handleCancelButtonClick()">
                                        Cancel
                                    </button>
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
                                <table class="table datatable w-100">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Aktivitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0 @endphp
                                        @foreach ($detailPreventives as $detailPreventive)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $detailPreventive->perbaikan }}</td>
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
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>
<script>
    function handleFinishButtonClick() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengubah status menjadi Finish?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // Set confirmed_preventive value to 1 before submitting the form
                document.getElementById('confirmed_preventive').value = '1';

                // Show success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Status berhasil diubah!',
                    showConfirmButton: false,
                    timer: 1500,
                    didClose: () => {
                        // Submit the form after the success notification is closed
                        document.getElementById('preventiveForm').submit();
                    }
                });
            }
        });
    }
</script>

<script>
    function handleCancelButtonClick() {
        // Menampilkan konfirmasi SweetAlert untuk cancel
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin membatalkan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect atau melakukan tindakan lain jika cancel dikonfirmasi
                window.location.href = "{{ route('maintenance.dashpreventive') }}";
            }
        });
    }
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