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
                                  <h5 class="card-title">Chart CT Bubut</h5>
                                  <canvas id="chartCTBubut" width="200" height="50"></canvas>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Chart Summary Repair Maintenance</h5>
                                        <canvas id="sumarryData" width="200" height="50"></canvas>
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
                        <div class="col-12">
                            <div class="card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Chart Klaim dan Komplain <span></span></h5>
                                    <div>
                                        <label for="yearDropdown">Pilih Tahun:</label>
                                        <select id="yearDropdown" onchange="updateChart()" style="margin-bottom: 1%">
                                            <!-- Opsi tahun akan diisi melalui JavaScript -->
                                        </select>
                                        <canvas id="myChart" width="200" height="50"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Reports -->

                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
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
var ctbubutData = {!! $chartCTBubut !!};

// Memetakan total status 1 (status_2=0) dari data
var status1 = [];
for (var i = 1; i <= 12; i++) {
    var found = ctbubutData.find(function(item) {
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
    var found = ctbubutData.find(function(item) {
        return parseInt(item.month) === i;
    });
    if (found) {
        status2.push(found.total_status_3);
    } else {
        status2.push(0);
    }
}

var ctx = document.getElementById('chartCTBubut').getContext('2d');

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

var sumarryData = {!! json_encode($sumarryData) !!};

// Inisialisasi array untuk bulan-bulan
var months = [];
for (var i = 1; i <= 12; i++) {
    months.push(getMonthName(i));
}

// Memetakan total status 1 (status_2=0) dari data
var status1 = [];
for (var i = 1; i <= 12; i++) {
    var found = sumarryData.find(function(item) {
        return parseInt(item.month) === i && item.section === 'CUTTING';
    });
    if (found) {
        status1.push(found.total);
    } else {
        status1.push(0);
    }
}

// Memetakan total status 2 (status=3) dari data
var status2 = [];
for (var i = 1; i <= 12; i++) {
    var found = sumarryData.find(function(item) {
        return parseInt(item.month) === i && item.section === 'HEAT TREATMENT';
    });
    if (found) {
        status2.push(found.total);
    } else {
        status2.push(0);
    }
}

// Memetakan total status 3 (status=3) dari data
var status3 = [];
for (var i = 1; i <= 12; i++) {
    var found = sumarryData.find(function(item) {
        return parseInt(item.month) === i && item.section === 'MACHINING';
    });
    if (found) {
        status3.push(found.total);
    } else {
        status3.push(0);
    }
}

// Memetakan total status 4 (status=3) dari data
var status4 = [];
for (var i = 1; i <= 12; i++) {
    var found = sumarryData.find(function(item) {
        return parseInt(item.month) === i && item.section === 'MACHINING CUSTOM';
    });
    if (found) {
        status4.push(found.total);
    } else {
        status4.push(0);
    }
}

var ctx = document.getElementById('sumarryData').getContext('2d');

var sumarryChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Cutting',
            data: status1,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1
        }, {
            label: 'Heat Treatment',
            data: status2,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1
        }, {
            label: 'Machining',
            data: status3,
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1
        }, {
            label: 'Machining Custom',
            data: status4,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
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





        </script>

    </main><!-- End #main -->
@endsection
