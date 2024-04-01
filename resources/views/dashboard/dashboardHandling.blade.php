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
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Chart Klaim dan Komplain <span></span></h5>
                                    <div>
                                        <label for="yearDropdown">Pilih Tahun:</label>
                                        <select id="yearDropdown" onchange="updateChart()" style="margin-bottom: 5%">
                                            <!-- Opsi tahun akan diisi melalui JavaScript -->
                                        </select>
                                        <canvas id="myChart" width="200" height="113"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Chart Periode</h5>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="start_month">Bulan Mulai:</label>
                                            <input type="date" id="start_month" name="start_month"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_month">Bulan Akhir:</label>
                                            <input type="date" id="end_month" name="end_month" class="form-control">
                                        </div>
                                        <div class="input-group-append" style="margin-top: 3%">
                                            <button class="btn btn-primary" type="button"
                                                id="submit_dates">Submit</button>
                                            <a href="{{ route('dashboardHandling') }}" class="btn btn-primary btn-sm"
                                                style="font-size: 18px;">
                                                Muat Ulang
                                            </a>
                                        </div>
                                    </div>
                                    <canvas id="chartAllPeriode" width="200" height="90"
                                        style="margin-top: 5%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.getElementById('submit_dates').addEventListener('click', function() {
                var startDate = document.getElementById('start_month').value;
                var endDate = document.getElementById('end_month').value;
                // Validasi apakah kedua tanggal sudah dipilih
                if (startDate === "" || endDate === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Harap pilih tanggal mulai dan tanggal akhir.'
                    });
                    return; // Hentikan eksekusi jika tanggal belum dipilih
                }
                // Kirim data ke backend menggunakan AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/getChartData?start_date=' + startDate + '&end_date=' + endDate, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Tangani data yang diterima dari backend
                        var data = JSON.parse(xhr.responseText);
                        drawChart(data);
                    }
                };
                xhr.send();
            });

            function drawChart(data) {
                var labels = Object.keys(data);
                var values = Object.values(data);

                var ctx = document.getElementById('chartAllPeriode').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Status',
                            data: values,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
            // Tambahkan event listener untuk inputan tanggal mulai dan tanggal akhir
            // document.getElementById("start_month").addEventListener("change", updateChart);
            // document.getElementById("end_month").addEventListener("change", updateChart);
            // Fungsi untuk memperbarui chart berdasarkan tanggal mulai dan tanggal akhir yang dipilih
            // function updateChart() {
            //     var startMonth = document.getElementById("start_month").value;
            //     var endMonth = document.getElementById("end_month").value;

            //     // Lakukan AJAX request untuk mengambil data chart berdasarkan tanggal mulai dan tanggal akhir yang dipilih
            //     $.ajax({
            //         url: '/dashboardHandling', // Ganti dengan endpoint yang sesuai di backend Anda
            //         type: 'GET',
            //         data: {
            //             start_month: startMonth,
            //             end_month: endMonth
            //         },
            //         success: function(response) {
            //             // Respons dari server berisi data yang sesuai dengan rentang tanggal yang dipilih
            //             // Gunakan data ini untuk memperbarui chart
            //             updateChartWithData(response);
            //         },
            //         error: function(xhr, status, error) {
            //             console.error(xhr.responseText);
            //         }
            //     });
            // }
            // // Fungsi untuk memperbarui kedua chart dengan data yang diterima dari server
            // function updateChartWithData(data) {
            //     // Di sini Anda dapat menggunakan data yang diterima dari server untuk memperbarui kedua chart
            //     // Pastikan Anda telah memiliki logika untuk memperbarui kedua chart sesuai dengan data yang diterima
            // }
            // var years = {!! $years !!};

            // // Mendapatkan konteks dari canvas
            // var ctx = document.getElementById('chartAllPeriode').getContext('2d');

            // // Membuat array untuk label tahun
            // var yearLabels = years.map(function(yearData) {
            //     return yearData.years;
            // });

            // // Membuat array untuk total_status_2_0
            // var totalStatus2Data = years.map(function(yearData) {
            //     return yearData.total_status_2_0;
            // });

            // // Membuat array untuk total_status_3
            // var totalStatus3Data = years.map(function(yearData) {
            //     return yearData.total_status_3;
            // });

            // // Membuat chart
            // var myChart = new Chart(ctx, {
            //     type: 'bar',
            //     data: {
            //         labels: yearLabels,
            //         datasets: [{
            //             label: 'Open',
            //             data: totalStatus2Data,
            //             backgroundColor: 'rgba(255, 99, 132, 0.2)',
            //             borderColor: 'rgba(255, 99, 132, 1)',
            //             borderWidth: 1
            //         }, {
            //             label: 'Close',
            //             data: totalStatus3Data,
            //             backgroundColor: 'rgba(54, 162, 235, 0.2)',
            //             borderColor: 'rgba(54, 162, 235, 1)',
            //             borderWidth: 1
            //         }]
            //     },
            //     options: {
            //         scales: {
            //             yAxes: [{
            //                 ticks: {
            //                     beginAtZero: true
            //                 }
            //             }]
            //         }
            //     }
            // });

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
                return monthNames[monthNumber - 1];
            }

            // Mendapatkan data dari controller Laravel
            var chartData = {!! $data !!};

            // Inisialisasi array untuk bulan-bulan
            var months = [];
            for (var i = 1; i <= 12; i++) {
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
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna hijau untuk 'Open'
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Close',
                        data: status2,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna hitam yang lebih gelap untuk 'Close'
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
