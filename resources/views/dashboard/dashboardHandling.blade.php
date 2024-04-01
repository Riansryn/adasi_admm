@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard Maintenance Handling</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <hr>

        <section class="section dashboard">
            <div class="row">
                <h3 style="display: flex;
            justify-content: center;">Daftar Form Permintaan Perbaikan</h3>
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Open <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($openCount > 0)
                                        <i class="bi bi-envelope-open-fill"></i>
                                    @else
                                        <i class="bi bi-envelope-open-fill"></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $openCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card Today -->

                <!-- Sales Card This Month -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">On Progress <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($onProgressCount > 0)
                                        <i class="bi bi-hourglass-split "></i>
                                    @else
                                        <i class="bi bi-hourglass-split "></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $onProgressCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card This Month -->

                <!-- Revenue Card Today -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Finish <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($finishCount > 0)
                                        <i class="bi bi-check2-all"></i>
                                    @else
                                        <i class="bi bi-check2-all"></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $finishCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Card Today -->

                <!-- Revenue Card This Month -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Closed <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($closedCount > 0)
                                        <i class="bi bi-x-circle-fill"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill"></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $closedCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Card This Month -->
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chart Cutting</h5>
                            <canvas id="chartCutting" width="200" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chart Machining</h5>
                            <canvas id="chartMachining" width="200" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chart Heat Treatment</h5>
                            <canvas id="chartHeatTreatment" width="200" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chart Machining Custom</h5>
                            <canvas id="chartMachiningCustom" width="200" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Summary buat Claim dan Complain -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chart Summary Repair Maintenance</h5>
                            <canvas id="summaryData" width="200" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Waktu Pengerjaan Repair Maintenance</h5>
                <canvas id="summaryData2" width="200" height="50"></canvas>
            </div>
        </div>
    </div>
            </div>
        </section>

        <hr>

        <section class="section dashboard">
            <div class="row">
                <h3 style="display: flex; justify-content: center;">Daftar Form Claim dan Complain</h3>


                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Open</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-envelope-open-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 0)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">On Progress</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hourglass-split "></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 1)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Finish</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check2-all"></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 2)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->
                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-md-6">

                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Close</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 3)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-sm-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Chart Klaim dan Komplain <span></span></h5>
                                    <div>
                                        <label for="yearDropdown">Pilih Tahun:</label>
                                        <select id='date-dropdown' style="width: 7%"></select>
                                        <canvas id="myChart" width="200" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body" style="height: 430px; overflow-y: auto;">
                                    <h5 class="card-title">Chart Periode</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="start_month">Bulan Mulai:</label>
                                            <input type="date" id="start_month" name="start_month" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_month">Bulan Akhir:</label>
                                            <input type="date" id="end_month" name="end_month" class="form-control">
                                        </div>
                                        <canvas id="chartAllPeriode" height="260" style="margin-top: 5%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            //dropdownYear
            let dateDropdown = document.getElementById('date-dropdown');

            let currentYear = new Date().getFullYear();
            let earliestYear = 2020;
            while (currentYear >= earliestYear) {
                let dateOption = document.createElement('option');
                dateOption.text = currentYear;
                dateOption.value = currentYear;
                dateDropdown.add(dateOption);
                currentYear -= 1;
            }

            // Tambahkan event listener untuk input tanggal
            document.getElementById('start_month').addEventListener('change', updateChart);
            document.getElementById('end_month').addEventListener('change', updateChart);

            document.getElementById('end_month').addEventListener('change', function() {
                console.log('End date changed:', this.value); // Tambahkan console.log untuk memeriksa perubahan tanggal
                updateChartPeriode(); // Panggil fungsi updateChart saat nilai end_month berubah
            });
            var Periode; // Variabel untuk menyimpan referensi ke objek Chart

            // Fungsi untuk mengupdate chart
            function updateChartPeriode() {
                var startDate = document.getElementById('start_month').value;
                var endDate = document.getElementById('end_month').value;

                // Kirim data ke backend menggunakan AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/getChartData?start_date=' + startDate + '&end_date=' + endDate, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Tangani data yang diterima dari backend
                        var data = JSON.parse(xhr.responseText);

                        // Hancurkan chart yang ada jika sudah ada
                        if (Periode) {
                            Periode.destroy();
                        }
                        // Buat chart baru
                        drawChart(data);
                    }
                };
                xhr.send();
            }

            // Fungsi untuk membuat chart
            function drawChart(data) {
                var labels = ['Status 2', 'Status'];
                var values = Object.values(data);

                var ctx = document.getElementById('chartAllPeriode').getContext('2d');
                Periode = new Chart(ctx, {
                    type: 'bar',
                    
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.5)', // Biru dengan transparansi 0.5
                                'rgba(255, 99, 132, 0.5)', // Merah dengan transparansi 0.5
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)', // Biru solid
                                'rgba(255, 99, 132, 1)', // Merah solid
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        animation: {
                            duration: 2000, // Animasi durasi 2 detik
                            easing: 'easeInOutQuart' // Efek animasi
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: 'rgba(0, 0, 0, 0.7)', // Warna label sumbu Y
                                    fontSize: 14 // Ukuran font label sumbu Y
                                },
                                gridLines: {
                                    color: 'rgba(0, 0, 0, 0.1)' // Warna garis grid
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: 'rgba(0, 0, 0, 0.7)', // Warna label sumbu X
                                    fontSize: 14 // Ukuran font label sumbu X
                                },
                                gridLines: {
                                    display: false // Sembunyikan garis grid sumbu X
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            labels: {
                                fontColor: 'rgba(0, 0, 0, 0.7)', // Warna teks legenda
                                fontSize: 14, // Ukuran font teks legenda
                                usePointStyle: true // Menggunakan simbol titik pada legenda
                            },
                            onClick: null, // Menonaktifkan interaktivitas pada legenda
                            position: 'bottom', // Letak legenda
                        }
                    }
                });
            }

            //Chart Handling /year
            // Function to update card based on data
            function updateCard(cardId, title, iconId, count) {
                document.getElementById(cardId + 'Title').textContent = title;
                document.getElementById(cardId + 'Icon').className = 'bi bi-' + iconId;
                document.getElementById(cardId + 'Count').textContent = count;
            }

            // Simulate data update every 5 seconds
            setInterval(function() {
                // Simulate new data
                var openCount = Math.floor(Math.random() * 100);
                var onProgressCount = Math.floor(Math.random() * 100);
                var finishCount = Math.floor(Math.random() * 100);
                var closedCount = Math.floor(Math.random() * 100);

                // Update each card
                updateCard('open', 'Open', 'cart', openCount);
                updateCard('onProgress', 'On Progress', 'clock', onProgressCount);
                updateCard('finish', 'Finish', 'currency-dollar', finishCount);
                updateCard('closed', 'Closed', 'check-circle', closedCount);
            }, 5000); // Update every 5 seconds

            // Fungsi untuk mengonversi angka bulan menjadi nama bulan dalam bahasa Inggris
            function getMonthName(monthNumber) {
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                return monthNames[monthNumber];
            }

            // Event listener untuk menangkap perubahan pada dropdown tahun
            dateDropdown.addEventListener('change', function() {
                var selectedYear = this.value; // Mendapatkan tahun yang dipilih dari dropdown
                // Buat permintaan AJAX ke server dengan tahun yang dipilih
                $.ajax({
                    url: '/get-data-by-year', // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: {
                        year: selectedYear
                    }, // Mengirim tahun yang dipilih ke server
                    success: function(response) {
                        // Update chart dengan data baru dari respons server
                        updateChart(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Tampilkan pesan error jika terjadi kesalahan
                    }
                });
            });

            // Fungsi untuk memperbarui chart dengan data baru
            function updateChart(data) {
                // Memetakan data baru ke status1 dan status2
                var status1 = [];
                var status2 = [];
                for (var i = 0; i < 12; i++) {
                    var found = data.find(function(item) {
                        return parseInt(item.month) === i + 1; // Ubah indeks bulan menjadi dimulai dari 1
                    });
                    if (found) {
                        status1.push(found.total_status_2_0);
                        status2.push(found.total_status_3);
                    } else {
                        status1.push(0);
                        status2.push(0);
                    }
                }

                // Perbarui data chart
                myChart.data.datasets[0].data = status1; // Update data untuk status1 (Open)
                myChart.data.datasets[1].data = status2; // Update data untuk status2 (Close)
                myChart.update(); // Perbarui chart
            }
            // Mendapatkan data dari controller Laravel
            var chartData = {!! $data !!};

            // Inisialisasi array untuk bulan-bulan
            // Inisialisasi array untuk bulan-bulan (dimulai dari Januari)
            var months = [];
            for (var i = 0; i < 12; i++) {
                months.push(getMonthName(i));
            }

            // Memetakan total status 1 (status_2=0) dari data
            var status1 = [];
            for (var i = 1; i <= 12; i++) {
                var found = chartData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status1.push(found.total_status_2_0);
                } else {
                    status1.push(0);
                }
            }

            // Memetakan total status 2 (status=3) dari data
            var status2 = [];
            for (var i = 1; i <= 12; i++) {
                var found = chartData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status2.push(found.total_status_3);
                } else {
                    status2.push(0);
                }
            }

            var ctx = document.getElementById('myChart').getContext('2d');


            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Open',
                        data: status1,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Warna biru untuk 'Open'
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }, {
                        label: 'Close',
                        data: status2,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Warna merah untuk 'Close'
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)' // Warna grid sumbu y
                            },
                            ticks: {
                                color: 'rgba(0, 0, 0, 0.7)' // Warna label sumbu y
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)' // Warna grid sumbu x
                            },
                            ticks: {
                                color: 'rgba(0, 0, 0, 0.7)' // Warna label sumbu x
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: 'rgba(0, 0, 0, 0.7)' // Warna label legenda
                            }
                        }
                    },
                    animation: {
                        duration: 1500, // Durasi animasi
                        easing: 'easeInOutQuart' // Efek animasi
                    }
                }
            });
            //end

            // Data cutting chart
            var cuttingData = {!! $chartCutting !!};

            // Inisialisasi array untuk bulan-bulan
            var months = [];
            for (var i = 1; i <= 12; i++) {
                months.push(getMonthName(i));
            }

            // Memetakan total status 1 (status_2=0) dari data
            var status1 = [];
            for (var i = 1; i <= 12; i++) {
                var found = cuttingData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status1.push(found.total_status_2_0);
                } else {
                    status1.push(0);
                }
            }

            // Memetakan total status 2 (status=3) dari data
            var status2 = [];
            for (var i = 1; i <= 12; i++) {
                var found = cuttingData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status2.push(found.total_status_3);
                } else {
                    status2.push(0);
                }
            }

            var ctx = document.getElementById('chartCutting').getContext('2d');

            var chartCutting = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Open',
                        data: status1,
                        backgroundColor: 'rgba(0, 255, 0, 0.2)', // Warna hijau untuk 'Open'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Close',
                        data: status2,
                        backgroundColor: 'rgba(0, 0, 0, 0.4)', // Warna hitam yang lebih gelap untuk 'Close'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            // Data Heat Treatment chart
            var heattreatmentData = {!! $chartHeatTreatment !!};

            // Memetakan total status 1 (status_2=0) dari data
            var status1 = [];
            for (var i = 1; i <= 12; i++) {
                var found = heattreatmentData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status1.push(found.total_status_2_0);
                } else {
                    status1.push(0);
                }
            }

            // Memetakan total status 2 (status=3) dari data
            var status2 = [];
            for (var i = 1; i <= 12; i++) {
                var found = heattreatmentData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status2.push(found.total_status_3);
                } else {
                    status2.push(0);
                }
            }

            var ctx = document.getElementById('chartHeatTreatment').getContext('2d');

            var chartHeatTreatment = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Open',
                        data: status1,
                        backgroundColor: 'rgba(0, 255, 0, 0.2)', // Warna hijau untuk 'Open'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Close',
                        data: status2,
                        backgroundColor: 'rgba(0, 0, 0, 0.4)', // Warna hitam yang lebih gelap untuk 'Close'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data Machining Chart
            var machiningData = {!! $chartMachining !!};

            // Memetakan total status 1 (status_2=0) dari data
            var status1 = [];
            for (var i = 1; i <= 12; i++) {
                var found = machiningData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status1.push(found.total_status_2_0);
                } else {
                    status1.push(0);
                }
            }

            // Memetakan total status 2 (status=3) dari data
            var status2 = [];
            for (var i = 1; i <= 12; i++) {
                var found = machiningData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status2.push(found.total_status_3);
                } else {
                    status2.push(0);
                }
            }

            var ctx = document.getElementById('chartMachining').getContext('2d');

            var chartMachining = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Open',
                        data: status1,
                        backgroundColor: 'rgba(0, 255, 0, 0.2)', // Warna hijau untuk 'Open'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Close',
                        data: status2,
                        backgroundColor: 'rgba(0, 0, 0, 0.4)', // Warna hitam yang lebih gelap untuk 'Close'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data CT Bubut Chart
            var machiningcustomData = {!! $chartMachiningCustom !!};

            // Memetakan total status 1 (status_2=0) dari data
            var status1 = [];
            for (var i = 1; i <= 12; i++) {
                var found = machiningcustomData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status1.push(found.total_status_2_0);
                } else {
                    status1.push(0);
                }
            }

            // Memetakan total status 2 (status=3) dari data
            var status2 = [];
            for (var i = 1; i <= 12; i++) {
                var found = machiningcustomData.find(function(item) {
                    return parseInt(item.month) === i;
                });
                if (found) {
                    status2.push(found.total_status_3);
                } else {
                    status2.push(0);
                }
            }

            var ctx = document.getElementById('chartMachiningCustom').getContext('2d');

            var chartCTBubut = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Open',
                        data: status1,
                        backgroundColor: 'rgba(0, 255, 0, 0.2)', // Warna hijau untuk 'Open'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Close',
                        data: status2,
                        backgroundColor: 'rgba(0, 0, 0, 0.4)', // Warna hitam yang lebih gelap untuk 'Close'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var summaryData = {!! json_encode($summaryData) !!};

// Initialize array for months
var months = [];
for (var i = 1; i <= 12; i++) {
    months.push(getMonthName(i));
}

// Function to find data for a specific section in a month
function findData(month, section) {
    var found = summaryData.find(function(item) {
        return parseInt(item.month) === month && item.section.toUpperCase() === section.toUpperCase();
    });
    return found ? found : { total_status_2_0: 0, total_status_3: 0 };
}

// Map total status for each section and month
var statusData = {};
['CUTTING', 'HEAT TREATMENT', 'MACHINING', 'MACHINING CUSTOM'].forEach(function(section) {
    var openData = [];
    var closedData = [];
    for (var i = 1; i <= 12; i++) {
        var data = findData(i, section);
        openData.push(data.total_status_2_0);
        closedData.push(data.total_status_3);
    }
    statusData[section] = { open: openData, closed: closedData };
});

// Save different colors for each section
const colors = {
    'CUTTING': {
        open: 'rgba(0, 255, 0, 0.2)',
        closed: 'rgba(0, 0, 0, 0.4)'
    },
    'HEAT TREATMENT': {
        open: 'rgba(0, 255, 0, 0.2)',
        closed: 'rgba(0, 0, 0, 0.4)'
    },
    'MACHINING': {
        open: 'rgba(0, 255, 0, 0.2)',
        closed: 'rgba(0, 0, 0, 0.4)'
    },
    'MACHINING CUSTOM': {
        open: 'rgba(0, 255, 0, 0.2)',
        closed: 'rgba(0, 0, 0, 0.4)'
    }
};

var ctx = document.getElementById('summaryData').getContext('2d');

var sumarryChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [
            { label: 'Cutting (Open)', data: statusData['CUTTING'].open, backgroundColor: colors['CUTTING'].open, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 },
            { label: 'Cutting (Closed)', data: statusData['CUTTING'].closed, backgroundColor: colors['CUTTING'].closed, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 },
            { label: 'Heat Treatment (Open)', data: statusData['HEAT TREATMENT'].open, backgroundColor: colors['HEAT TREATMENT'].open, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 },
            { label: 'Heat Treatment (Closed)', data: statusData['HEAT TREATMENT'].closed, backgroundColor: colors['HEAT TREATMENT'].closed, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 },
            { label: 'Machining (Open)', data: statusData['MACHINING'].open, backgroundColor: colors['MACHINING'].open, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 },
            { label: 'Machining (Closed)', data: statusData['MACHINING'].closed, backgroundColor: colors['MACHINING'].closed, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 },
            { label: 'Machining Custom (Open)', data: statusData['MACHINING CUSTOM'].open, backgroundColor: colors['MACHINING CUSTOM'].open, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 },
            { label: 'Machining Custom (Closed)', data: statusData['MACHINING CUSTOM'].closed, backgroundColor: colors['MACHINING CUSTOM'].closed, borderColor: 'rgba(0, 0, 0, 1)', borderWidth: 1 }
        ]
    },
    options: { scales: { y: { beginAtZero: true } } }
});

           // Mengambil data dari PHP dan menetapkannya ke dalam variabel JavaScript
var summaryData2 = {!! json_encode($summaryData2) !!};

// Inisialisasi variabel totalDifference, count, labels, dan data
var totalDifference = 0;
var count = 0;
var labels = [];
var data = [];

// Iterasi melalui setiap item dalam summaryData2
summaryData2.forEach(function(item) {
    // Mengambil perbedaan waktu dalam jam
    var differenceInHours = item.time_difference_hour;

    // Menambahkan perbedaan waktu dalam jam ke totalDifference
    totalDifference += differenceInHours;

    // Menambahkan 1 ke count
    count++;

    // Membuat label dengan menggabungkan id_fpp dan section
    var label = item.id_fpp + " " + item.section;

    // Menambahkan label ke dalam array labels
    labels.push(label);

    // Menambahkan perbedaan waktu dalam jam ke dalam array data
    data.push(differenceInHours);
});

// Menghitung rata-rata perbedaan waktu
var averageDifference = count > 0 ? totalDifference / count : 0;

// Mendapatkan konteks dari elemen canvas dengan ID "summaryData2"
var ctx = document.getElementById('summaryData2').getContext('2d');

// Membuat chart menggunakan library Chart.js
var summaryData2Chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Selisih Waktu (Dalam satuan Jam)',
            data: data,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


        </script>



    </main><!-- End #main -->
@endsection
