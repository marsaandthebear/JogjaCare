@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs />
@endsection

@section('styles')
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
<div class="container-fluid">

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Medical Centers</h6>
                            <h2 class="mb-0">{{ DB::table('medicalcenters')->count() }}</h2>
                        </div>
                        <i class="fas fa-hospital fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.medicalcenters.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Medical Care</h6>
                            <h2 class="mb-0">{{ DB::table('medicalcares')->count() }}</h2>
                        </div>
                        <i class="fas fa-heartbeat fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.medicalcares.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Medical Points</h6>
                            <h2 class="mb-0">{{ DB::table('medicalpoints')->count() }}</h2>
                        </div>
                        <i class="fas fa-map-marker-alt fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.medicalpoints.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase font-weight-bold mb-1">Users</h6>
                            <h2 class="mb-0">{{ DB::table('users')->count() }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.users.index') }}" class="text-white">View Details</a>
                    <div><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mb-4">
        <!-- Medical Centers by District -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Medical Centers by District</h5>
                </div>
                <div class="card-body">
                    <canvas id="medicalCentersByDistrict" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Medical Services by Type -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Medical Services by Type</h5>
                </div>
                <div class="card-body">
                    <canvas id="medicalServicesByType" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Medical Costs Range -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Medical Costs Range</h5>
                </div>
                <div class="card-body">
                    <canvas id="medicalCostsChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Monthly Data Trend -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Monthly Data Trend</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyTrend" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activities</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $recentMedicalCenters = DB::table('medicalcenters')
                                        ->orderBy('created_at', 'desc')
                                        ->take(5)
                                        ->get();
                                @endphp
                                
                                @foreach($recentMedicalCenters as $center)
                                <tr>
                                    <td>{{ $center->id }}</td>
                                    <td>{{ $center->name }}</td>
                                    <td>{{ $center->type }}</td>
                                    <td>{{ date('d M Y', strtotime($center->created_at)) }}</td>
                                    <td>
                                        @if($center->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
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
@endsection

@push('after-scripts')
<script>
// Chart initialization with static data
document.addEventListener('DOMContentLoaded', function() {
    // Medical Centers by District Chart
    const districtLabels = ['Bantul', 'Gunungkidul', 'Kulon Progo', 'Sleman', 'Kota Yogyakarta'];
    const districtCounts = [12, 19, 8, 15, 10];
    
    const medicalCenterCtx = document.getElementById('medicalCentersByDistrict').getContext('2d');
    new Chart(medicalCenterCtx, {
        type: 'pie',
        data: {
            labels: districtLabels,
            datasets: [{
                data: districtCounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Distribution by District'
                }
            }
        }
    });

    // Medical Services by Type
    const typeLabels = ['Hospital', 'Clinic', 'Pharmacy', 'Laboratory', 'Specialist'];
    const typeCounts = [25, 30, 15, 10, 5];
    
    const servicesCtx = document.getElementById('medicalServicesByType').getContext('2d');
    new Chart(servicesCtx, {
        type: 'bar',
        data: {
            labels: typeLabels,
            datasets: [{
                label: 'Number of Services',
                data: typeCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Service Distribution by Type'
                }
            }
        }
    });

    // Medical Costs Chart
    const costLabels = ['Consultation', 'Treatment', 'Surgery', 'Check-up', 'Emergency'];
    const lowestPrices = [50000, 100000, 500000, 75000, 200000];
    const highestPrices = [200000, 500000, 5000000, 150000, 750000];
    
    const costsCtx = document.getElementById('medicalCostsChart').getContext('2d');
    new Chart(costsCtx, {
        type: 'bar',
        data: {
            labels: costLabels,
            datasets: [
                {
                    label: 'Lowest Price',
                    data: lowestPrices,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Highest Price',
                    data: highestPrices,
                    backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp. ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Price Range by Service'
                }
            }
        }
    });

    // Monthly Data Trend
    const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const datasets = [
        {
            label: 'Medical Centers',
            data: [5, 7, 8, 10, 12, 15, 16, 18, 20, 22, 24, 25],
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.1)',
            tension: 0.4,
            fill: true
        },
        {
            label: 'Medical Care',
            data: [10, 13, 15, 17, 19, 20, 22, 25, 27, 30, 33, 35],
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.1)',
            tension: 0.4,
            fill: true
        }
    ];
    
    const trendCtx = document.getElementById('monthlyTrend').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Growth Trend'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush