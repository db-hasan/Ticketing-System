@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Sales Report</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="{{route('invoice.sales')}}" type="button" class="btn btn-success">PDF</a>
                    <button type="button" class="btn btn-warning">CSV</button>
                    <button type="button" class="btn btn-danger">Print</button>
                </div>
            </div>
        </div>
        <hr>

        <div class="row justify-content-center">
            <div class="row mb-3">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col" class="text-uppercase">#SL</th>
                          <th scope="col" class="text-uppercase">Name</th>
                          <th scope="col" class="text-uppercase text-end">Unit Price</th>
                          <th scope="col" class="text-uppercase text-end">QTY</th>
                          <th scope="col" class="text-uppercase text-end">Amount</th>
                        </tr>
                      </thead>
                      <tbody class="table-group-divider">
                        <tr>
                          <th scope="row">1</th>
                          <td>Ride 1 - This is Ride 1</td>
                          <td class="text-end">75</td>
                          <td class="text-end">2</td>
                          <td class="text-end">150</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Ride 2 - This is Ride 2</td>
                          <td class="text-end">100</td>
                          <td class="text-end">3</td>
                          <td class="text-end">300</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Ride 3 - This is Ride 3</td>
                          <td class="text-end">150</td>
                          <td class="text-end">3</td>
                          <td class="text-end">450</td>
                        </tr>
                        <tr>
                          <th scope="row" colspan="4" class="text-uppercase text-end">Total</th>
                          <td class="text-end">Tk. 950</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>



        

    </main>
@endsection
