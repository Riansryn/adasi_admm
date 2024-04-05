@extends('layout')

<script src="https://code.highcharts.com/highcharts.js"></script>
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard Maintenance Handling</h1>
            <nav>
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol> -->
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <h3 style="display: flex;
            justify-content: center;">Dashboard Form Permintaan Perbaikan</h3>
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
                            <div id="chartCutting" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartMachining" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartHeatTreatment" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartMachiningCustom" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div id="summaryHighcharts" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>

                <div class="col-sm-6">
                <div class="card">
        <div class="card-body">
        <h5 class="card-title">Waktu Pengerjaan Repair Maintenance</h5>
            <div class="row">
                <div class="col-md-4">
                    <label for="yearDropdown">Pilih Tahun:</label>
                    <select id="date-dropdown2" class="form-control" onchange="updateChart2()">
                    <option value=" " selected>Pilih Tahun</option> <!-- Default option -->
                        @foreach($years2 as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="sectionDropdown">Pilih Section:</label>
                    <select id="section-dropdown" class="form-control" onchange="updateChart2()">
                    <option value=" " selected>Pilih Section </option> <!-- Default option -->
                        @foreach($sections as $section)
                            <option value="{{ $section }}">{{ $section }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

            <div id="repairMaintenance" style="width: 100%; height: auto;"></div>

    </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Periode Waktu Pengerjaan</h5>
            <div class="row">
                <div class="col-md-3">
                    <label for="start_month2">Bulan Mulai:</label>
                    <input type="date" id="start_month2" name="start_month2" class="form-control" onchange="updatePeriodeWaktuPengerjaan()">
                </div>
                <div class="col-md-3">
                    <label for="end_month2">Bulan Akhir:</label>
                    <input type="date" id="end_month2" name="end_month2" class="form-control" onchange="updatePeriodeWaktuPengerjaan()">
                </div>
            </div>
            <canvas id="periodeRepair" style="width: 100%; height: auto;"></canvas>
        </div>
    </div>
</div>


<div class="col-sm-12">
    <div id="highcharts-container" class="card">
        <div class="card-body">
        <h5 class="card-title">Summary FPP Mesin</h5>
            <div class="row">
                <div class="col-md-3">
                    <label for="sectionDropdown">Pilih Section:</label>
                    <select id="section-dropdown2" class="form-control" onchange="updateChartPeriodeMesin()">
                    <option value=" " selected>Pilih Section </option> <!-- Default option -->
                        @foreach($sections as $section)
                            <option value="{{ $section }}">{{ $section }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="start_mesin">Bulan Mulai:</label>
                    <input type="date" id="start_mesin" name="start_mesin" class="form-control" onchange="updateChartPeriodeMesin()">
                </div>
                <div class="col-md-3">
                    <label for="end_mesin">Bulan Akhir:</label>
                    <input type="date" id="end_mesin" name="end_mesin" class="form-control" onchange="updateChartPeriodeMesin()">
                </div>
            </div>
            <div id="periodeRepairMesin" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>
            </div>
        </section>

        <hr>

        <section class="section dashboard">
            <div class="row">
                <h3 style="display: flex; justify-content: center;">Dashboard Form Claim dan Complain</h3>
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
                var labels = ['Open', 'Close'];
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
                            borderWidth: 2,
                            barThickness: 23 // Ukuran batang
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
            for (var i = 0; i <= 12; i++) {
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

            Highcharts.chart('chartCutting', {
        chart: {
            type: 'column'
        },
        title: {
        text: 'Mesin Cutting'
    },
    xAxis: {
        categories: months,
        crosshair: true,
        accessibility: {
            description: 'Bulan'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Repair'
        }
    },
    credits: {  // Configuration to disable credits
        enabled: false
    },
    tooltip: {
    headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
},
plotOptions: {
    column: {
        pointPadding: 0.2,
        borderWidth: 0
    }
},
series: [{
    name: 'Status (Open)',
    data: status1,
    color: 'rgba(0, 150, 0, 0.5)' // Warna hijau yang lebih gelap untuk 'Status (Open)'
}, {
    name: 'Status (Closed)',
    data: status2,
    color: 'rgba(0, 0, 0, 0.7)' // Warna hitam yang lebih terang untuk 'Status (Closed)'
}]

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

            Highcharts.chart('chartHeatTreatment', {
        chart: {
            type: 'column'
        },
        title: {
        text: 'Mesin Heat Treatment'
    },
    xAxis: {
        categories: months,
        crosshair: true,
        accessibility: {
            description: 'Bulan'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Repair'
        }
    },
    credits: {  // Configuration to disable credits
        enabled: false
    },
    tooltip: {
    headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
},
plotOptions: {
    column: {
        pointPadding: 0.2,
        borderWidth: 0
    }
},
series: [{
    name: 'Status (Open)',
    data: status1,
    color: 'rgba(0, 150, 0, 0.5)' // Warna hijau yang lebih gelap untuk 'Status (Open)'
}, {
    name: 'Status (Closed)',
    data: status2,
    color: 'rgba(0, 0, 0, 0.7)' // Warna hitam yang lebih terang untuk 'Status (Closed)'
}]

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

            Highcharts.chart('chartMachining', {
        chart: {
            type: 'column'
        },
        title: {
        text: 'Mesin Machining'
    },
    xAxis: {
        categories: months,
        crosshair: true,
        accessibility: {
            description: 'Bulan'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Repair'
        }
    },
    credits: {  // Configuration to disable credits
        enabled: false
    },
    tooltip: {
    headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
},
plotOptions: {
    column: {
        pointPadding: 0.2,
        borderWidth: 0
    }
},
series: [{
    name: 'Status (Open)',
    data: status1,
    color: 'rgba(0, 150, 0, 0.5)' // Warna hijau yang lebih gelap untuk 'Status (Open)'
}, {
    name: 'Status (Closed)',
    data: status2,
    color: 'rgba(0, 0, 0, 0.7)' // Warna hitam yang lebih terang untuk 'Status (Closed)'
}]

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

            Highcharts.chart('chartMachiningCustom', {
        chart: {
            type: 'column'
        },
        title: {
        text: 'Mesin Maching Custom'
    },
    xAxis: {
        categories: months,
        crosshair: true,
        accessibility: {
            description: 'Bulan'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Repair'
        }
    },
    credits: {  // Configuration to disable credits
        enabled: false
    },
    tooltip: {
    headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
},
plotOptions: {
    column: {
        pointPadding: 0.2,
        borderWidth: 0
    }
},
series: [{
    name: 'Status (Open)',
    data: status1,
    color: 'rgba(0, 150, 0, 0.5)' // Warna hijau yang lebih gelap untuk 'Status (Open)'
}, {
    name: 'Status (Closed)',
    data: status2,
    color: 'rgba(0, 0, 0, 0.7)' // Warna hitam yang lebih terang untuk 'Status (Closed)'
}]

    });

    var summaryData = {!! json_encode($summaryData) !!};

// Initialize array for months
var months = [];
for (var i = 0; i <= 12; i++) {
    months.push(getMonthName(i));
}

// Function to get month name from its number
function getMonthName(monthNumber) {
    var d = new Date();
    d.setMonth(monthNumber - 1);
    return d.toLocaleString('en-us', { month: 'long' });
}

// Get all unique sections
var sections = ['CUTTING', 'HEAT TREATMENT', 'MACHINING', 'MACHINING CUSTOM'];

// Create data series for Highcharts
var seriesData = [];
sections.forEach(function(section) {
    var openArray = [];
    var closedArray = [];
    months.forEach(function(month) {
        // Check if data exists for this section and month
        var sectionData = summaryData.find(data => data.section.toUpperCase() === section && getMonthName(data.month) === month);
        if (sectionData) {
            openArray.push(parseInt(sectionData.total_status_2_0));
            closedArray.push(parseInt(sectionData.total_status_3));
        } else {
            openArray.push(0);
            closedArray.push(0);
        }
    });

    seriesData.push({
        name: section + ' (Open)',
        data: openArray
    }, {
        name: section + ' (Closed)',
        data: closedArray
    });
});

// Create chart using Highcharts
Highcharts.chart('summaryHighcharts', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Summary Repair Maintenance'
    },
    xAxis: {
        categories: months,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Repair Maintenance'
        }
    },
    credits: {  // Configuration to disable credits
        enabled: false
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: seriesData
});
        </script>





<script>
    // Inisialisasi chart dengan data default
var repairMaintenanceChart;

// Inisialisasi dropdown tahun saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    let dateDropdown = document.getElementById('date-dropdown2');
    let currentYear = new Date().getFullYear();
    let earliestYear = 2020; // Tahun awal yang diinginkan
    while (currentYear >= earliestYear) {
        let dateOption = document.createElement('option');
        dateOption.text = currentYear;
        dateOption.value = currentYear;
        dateDropdown.add(dateOption);
        currentYear -= 1;
    }
    // Panggil updateChart2() untuk memuat data awal
    updateChart2();
});

// Event handler untuk perubahan pada dropdown tahun
document.getElementById('date-dropdown2').addEventListener('change', function() {
    updateChart2();
});


function updateChart2() {
    var selectedYear = document.getElementById('date-dropdown2').value;
    var selectedSection = document.getElementById('section-dropdown').value;

    // Lakukan AJAX request untuk mendapatkan data baru berdasarkan tahun dan section yang dipilih
    $.ajax({
        url: '/getRepairMaintenance', // Ganti dengan URL endpoint yang sesuai
        method: 'GET',
        data: {
            year: selectedYear,
            section: selectedSection
        },
        success: function(response) {
            // Label bulan yang sesuai dengan data yang diterima
            var labels = response.labels;

            // Data yang diterima dari respons AJAX
            var data2 = response.data2;

            // Perbarui chart dengan data baru
            if (!repairMaintenanceChart) {
                // Jika chart belum diinisialisasi, lakukan inisialisasi
                repairMaintenanceChart = Highcharts.chart('repairMaintenance', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Waktu Pengerjaan Repair Maintenance (Dalam menit)'
                    },
                    xAxis: {
                        categories: labels
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Waktu (menit)'
                        }
                    },
                    credits: {  // Configuration to disable credits
        enabled: false
    },
                    series: [{
                        name: 'Waktu Pengerjaan (Dalam menit)',
                        data: data2,
                        color: 'red' // Mengatur warna menjadi merah
                    }]
                });
            } else {
                // Jika chart sudah diinisialisasi, perbarui data-nya
                repairMaintenanceChart.xAxis[0].setCategories(labels, false);
                repairMaintenanceChart.series[0].setData(data2, true);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error here
        }
    });
}


// Inisialisasi chart periode waktu pengerjaan dengan data default
var ctxPeriode = document.getElementById('periodeRepair').getContext('2d');
var periodeRepair = new Chart(ctxPeriode, {
    type: 'bar',
    data: {
        labels: ['Waktu Pengerjaan'], // Label waktu pengerjaan saja
        datasets: [{
            label: 'Total Waktu Pengerjaan (Dalam menit)', // Label dataset
            data: [{!! json_encode($periodeWaktuPengerjaan) !!}], // Data waktu pengerjaan akan diisi setelah permintaan AJAX berhasil
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
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

// Fungsi untuk memperbarui chart periode waktu pengerjaan
function updatePeriodeWaktuPengerjaan() {
    var selectedSection = document.getElementById('section-dropdown').value;
    var startMonth = document.getElementById('start_month2').value;
    var endMonth = document.getElementById('end_month2').value;

    // Lakukan AJAX request untuk mendapatkan data periode waktu pengerjaan berdasarkan section dan tanggal yang dipilih
    $.ajax({
        url: '/getPeriodeWaktuPengerjaan',
        method: 'GET',
        data: {
            section: selectedSection,
            start_month2: startMonth,
            end_month2: endMonth
        },
        success: function(response) {
            // Perbarui data chart dengan data baru
            periodeRepair.data.datasets[0].data = [response.total_minute];
            periodeRepair.update();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error here
        }
    });
}


    // Event handler untuk perubahan pada dropdown section
    document.getElementById('section-dropdown').addEventListener('change', function() {
    updateChart2();
    updatePeriodeWaktuPengerjaan(); // Panggil fungsi untuk memperbarui periode waktu pengerjaan
});

document.getElementById('start_month2').addEventListener('change', function() {
    updateChart2();
    updatePeriodeWaktuPengerjaan(); // Panggil fungsi untuk memperbarui periode waktu pengerjaan
});

document.getElementById('end_month2').addEventListener('change', function() {
    updateChart2();
    updatePeriodeWaktuPengerjaan(); // Panggil fungsi untuk memperbarui periode waktu pengerjaan
});

// Fungsi untuk memperbarui chart dengan data mesin menggunakan Highcharts
function updateMesinChart(data) {
    var mesinData = [];

    // Mengisi data mesin dan total FPP
    data.forEach(function(item) {
        mesinData.push({
            name: item.no_mesin,
            y: item.total_fpp
        });
    });

    // Membuat chart menggunakan Highcharts
    Highcharts.chart('periodeRepairMesin', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah FPP Mesin'
        },
        xAxis: {
            type: 'category',
            title: {
                text: 'Mesin'
            }
        },
        yAxis: {
            title: {
                text: 'Total FPP'
            }
        },
        series: [{
            name: 'Total FPP',
            data: mesinData,
            color: 'rgba(75, 192, 192, 0.6)' // Warna latar belakang hijau
        }]
    });
}

// Fungsi untuk memperbarui chart periode waktu pengerjaan untuk mesin
function updateChartPeriodeMesin() {
    var selectedSection = document.getElementById('section-dropdown2').value;
    var startDate = document.getElementById('start_mesin').value;
    var endDate = document.getElementById('end_mesin').value;

    // Lakukan AJAX request untuk mendapatkan data mesin berdasarkan section dan tanggal yang dipilih
    $.ajax({
        url: '/getPeriodeMesin',
        method: 'GET',
        data: {
            section: selectedSection,
            start_mesin: startDate,
            end_mesin: endDate
        },
        success: function(response) {
            // Perbarui chart dengan data baru
            updateMesinChart(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error here
        }
    });
}

// Event handler untuk perubahan pada dropdown section
document.getElementById('section-dropdown2').addEventListener('change', function() {
    updateChartPeriodeMesin();
});

// Event handler untuk perubahan pada input tanggal
document.getElementById('start_mesin').addEventListener('change', function() {
    updateChartPeriodeMesin();
});

document.getElementById('end_mesin').addEventListener('change', function() {
    updateChartPeriodeMesin();
});


</script>

    </main><!-- End #main -->
@endsection
