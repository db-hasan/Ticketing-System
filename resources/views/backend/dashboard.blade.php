@extends('backend/layouts')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
      
              <!-- Left side columns -->
              <div class="col-lg-8">
                <div class="row">

                  @php
                      $todaySales = $todayTiketSales + $todayRideSales;
                      $monthlySales = $monthlyTiketSales + $monthlyRideSales;
                      $yearlySales = $yearlyTiketSales + $yearlyRideSales;
                  @endphp
      
                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                      <div class="card-body">
                        <h5 class="card-title">Sales <span>| Today</span></h5>
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                          </div>
                          <div class="ps-3">
                            <h6>Tk. {{ $todaySales }}</h6>
                            <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Today Sales Amount</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Sales Card -->
      
                  <!-- Revenue Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                      <div class="card-body">
                        <h5 class="card-title">Sales <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                          </div>
                          <div class="ps-3">
                            <h6>Tk. {{ $monthlySales}}</h6>
                            <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Monthly Sales Amount</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Revenue Card -->
                  <!-- Revenue Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                      <div class="card-body">
                        <h5 class="card-title">Revenue <span>| This Year</span></h5>
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                          </div>
                          <div class="ps-3">
                            <h6>Tk. {{ $yearlySales}}</h6>
                            <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Yearly Sales Amount</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Revenue Card -->
                  
                  {{-- <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Bar CHart</h5>
          
                        <!-- Bar Chart -->
                        <canvas id="barChart" style="max-height: 400px;"></canvas>
                        <script>
                          document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#barChart'), {
                              type: 'bar',
                              data: {
                                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                datasets: [{
                                  label: 'Bar Chart',
                                  data: [65, 59, 80, 81, 56, 55, 40],
                                  backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                  ],
                                  borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                  ],
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
                          });
                        </script>
                        <!-- End Bar CHart -->
          
                      </div>
                    </div>
                  </div> --}}

                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card customers-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#" id="todayCustomer" data-count="{{ $todayCustomers }}">Today</a></li>
                                <li><a class="dropdown-item" href="#" id="monthlyCustomer" data-count="{{ $monthlyCustomers }}">This Month</a></li>
                                <li><a class="dropdown-item" href="#" id="yearlyCustomer" data-count="{{ $yearlyCustomers }}">This Year</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Customers <span id="customerLavel">| Today</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="customerCount">{{ $todayCustomers }}</h6>
                                    <span class="text-muted small pt-2 ps-1">Total Customers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                
                
                  <!-- End Customers Card -->
      
                  <!-- Top Selling -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card top-selling overflow-auto">
                      <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                          <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                          </li>
      
                          <li><a class="dropdown-item" href="#">Today</a></li>
                          <li><a class="dropdown-item" href="#">This Month</a></li>
                          <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                      </div>
      
                      <div class="card-body pb-0">
                        <h5 class="card-title">Entry Ticket <span>| Today</span></h5>
                        <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col" class="text-end">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($todayEntrySalesByUsers as $todayEntrySalesByUser)
                            <tr>
                                <td>{{ $todayEntrySalesByUser->user->name }}</td>
                                <td class="text-end">{{ number_format($todayEntrySalesByUser->total_sales, 2) }}</td>
                            </tr>
                            @endforeach

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div><!-- End Top Selling -->
                  <!-- Top Selling -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card top-selling overflow-auto">
                      <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                          <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                          </li>
      
                          <li><a class="dropdown-item" href="#">Today</a></li>
                          <li><a class="dropdown-item" href="#">This Month</a></li>
                          <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                      </div>
      
                      <div class="card-body pb-0">
                        <h5 class="card-title">Ride Ticket <span>| Today</span></h5>
                        <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col" class="text-end">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($todayRideSalesByUsers as $todayRideSalesByUser)
                            <tr>
                                <td>{{ $todayRideSalesByUser->user->name }}</td>
                                <td class="text-end">{{ number_format($todayRideSalesByUser->total_sales, 2) }}</td>
                            </tr>
                            @endforeach

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div><!-- End Top Selling -->

                </div>
              </div><!-- End Left side columns -->
      
              <!-- Right side columns -->
              <div class="col-lg-4">
                <!-- Recent Activity -->
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Recent Activity <span>| Ride Ticket</span></h5>
                    <div class="activity">
                      
                      @foreach ($rideTickets as $rideTicket)
                      <div class="activity-item d-flex">
                        <div class="activite-label">{{ $rideTicket->created_at->format('H:i') }}</div>
                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                        <div class="activity-content">
                          {{ $rideTicket->ride->name}}
                        </div>
                      </div>
                      @endforeach

                    </div>
                  </div>
                </div>
            </div>
          </section>

    </main>

    

    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const todayCustomer = document.getElementById('todayCustomer');
          const monthlyCustomer = document.getElementById('monthlyCustomer');
          const yearlyCustomer = document.getElementById('yearlyCustomer');

          const customerCount = document.getElementById('customerCount');
          const customerLavel = document.getElementById('customerLavel');

          todayCustomer.addEventListener('click', function(event) {
              event.preventDefault();
              customerCount.textContent = this.getAttribute('data-count');
              customerLavel.textContent = "| Today";
          });

          monthlyCustomer.addEventListener('click', function(event) {
              event.preventDefault();
              customerCount.textContent = this.getAttribute('data-count');
              customerLavel.textContent = "| This Month";
          });

          yearlyCustomer.addEventListener('click', function(event) {
              event.preventDefault();
              customerCount.textContent = this.getAttribute('data-count');
              customerLavel.textContent = "| This Year";
          });
      });
    </script>

@endsection
