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
                <li class="breadcrumb-item active">Create customer</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Edit customer</h5>

                            <form id="customerForm" action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="customer_code" class="form-label">
                                        Kode Pelanggan<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="customer_code" name="customer_code" value="{{ $customer->customer_code }}">
                                </div>

                                <div class="mb-3">
                                    <label for="name_customer" class="form-label">
                                        Nama Pelanggan <span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name_customer" name="name_customer" value="{{ $customer->name_customer }}">
                                </div>

                                <div class="mb-3">
                                    <label for="area" class="form-label">
                                        Area<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="area" name="area" value="{{ $customer->area }}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email<span style="color: red;">*</span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}">
                                </div>

                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">
                                        Nomor Telepon<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="no_telp" name="no_telp" value="{{ $customer->no_telp }}">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('customers.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function resetForm() {
            document.getElementById('customerForm').reset();
        }
    </script>
    <script>
        function handleFormSubmission() {
            // Mendapatkan nilai input dari formulir
            var customer_code = document.getElementById('customer_code').value.trim();
            var name_customer = document.getElementById('name_customer').value.trim();
            var area = document.getElementById('area').value.trim();
            // var email = document.getElementById('email').value.trim();
            // var no_telp = document.getElementById('no_telp').value.trim();

            // Melakukan validasi input
            if (customer_code === '' || name_customer === '' || area === '') {
                // Menampilkan SweetAlert jika ada isian yang kosong
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Harap lengkapi semua isian yang diperlukan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false; // Menghentikan pengiriman formulir karena ada isian yang kosong
            }

            // Jika semua isian sudah terisi, lanjutkan pengiriman formulir
            document.getElementById('customerForm').submit();
        }

        // Event listener untuk submit form
        document.getElementById('customerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara default

            // Memanggil fungsi untuk menangani pengiriman formulir dan menampilkan SweetAlert
            handleFormSubmission();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</main><!-- End #main -->
@endsection