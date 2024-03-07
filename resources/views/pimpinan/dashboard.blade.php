@extends('layout.pimpinanLayout')
@section('content')
<style>
    /* CSS untuk efek hover muncul dan efek 3D */
    .rounded:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }
</style>
<div class="container-fluid pt-3 "  >
    <div class="col-12 tableContent g-2 ">
        <!-- Dashboard Insiden -->
        <div class="container-fluid pt-4 px-4" >
            <div class="row g-4 text-center" >
                <div class="col-sm-12 col-md-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-skull fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Malware</p>
                        <h6 class="mb-0">{{  $totalPerType['Malware'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-bolt fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">DDoS</p>
                        <h6 class="mb-0">{{  $totalPerType['DDoS'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-code fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">SQL Injection</p>
                        <h6 class="mb-0">{{  $totalPerType['SQL Injection'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-envelope fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Phishing</p>
                        <h6 class="mb-0">{{  $totalPerType['Phishing'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-globe fa-3x text-primary mb-2" style="font-size: 2rem;padding: 1px"></i>
                        <p class="mb-2">Web Defacement</p>
                        <h6 class="mb-0">{{  $totalPerType['Web Defacement'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-globe fa-3x text-primary mb-2" style="font-size: 2rem;padding: 1px"></i>
                        <p class="mb-2">Other</p>
                        <h6 class="mb-0">{{  $totalPerType['Other'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-skull fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Pending</p>
                        <h6 class="mb-0">{{  $totalStatus['Pending'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-bolt fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Ditangani</p>
                        <h6 class="mb-0">{{  $totalStatus['Ditangani'] ?? '0' }}</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-code fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Close</p>
                        <h6 class="mb-0">{{  $totalStatus['Close'] ?? '0' }}</h6>
                    </div>
                </div>
            </div>
            <div class="dash">
                <div class="col-sm-12 col-md-6 col-xl-6" >
                    <div class="bg-light rounded p-4" >
                        <h6 class="mb-4">Insiden Type Total</h6>
                        <!-- Set the width of the canvas to 300px -->
                        <canvas id="donutchart" data-total-per-type="{{ json_encode($totalPerType) }}" style="width: 300px;"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6" >
                    <div class="bg-light rounded p-4" >
                        <h6 class="mb-4">Status</h6>
                        <!-- Set the width of the canvas to 300px -->
                        <canvas id="donut" data-total-per-status="{{ json_encode($totalStatus) }}" style="width: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard Insiden -->
    </div>
   
</div>

@endsection
@section('title','Pimpinan | Dashboard')
@push('scripts')
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JavaScript for the donut chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the canvas element
            var ctx = document.getElementById('donutchart').getContext('2d');

            // Parse the JSON data attribute
            var totalPerType = JSON.parse(document.getElementById('donutchart').getAttribute('data-total-per-type'));

            // Prepare data for the chart
            var labels = Object.keys(totalPerType);
            var data = Object.values(totalPerType);

            // Create the donut chart
            var myDonutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 205, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Set to true to maintain aspect ratio
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            // Get the canvas element
            var ctx = document.getElementById('donut').getContext('2d');

            // Parse the JSON data attribute
            var totalStatus = JSON.parse(document.getElementById('donut').getAttribute('data-total-per-status'));

            // Prepare data for the chart
            var labels = Object.keys(totalStatus);
            var data = Object.values(totalStatus);

            // Create the donut chart
            var myDonutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 205, 86, 0.8)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Set to true to maintain aspect ratio
                }
            });
        });
    </script>
@endpush