@extends('backend/layouts')
@section('content')
<style>
  @media print {
      @page {
          margin: 0;
      }

      body {
          margin: 1cm;
      }

      body * {
          visibility: hidden;
      }

      #invoice, #invoice * {
          visibility: visible;
      }

      #invoice {
          position: absolute;
          left: 0;
          top: 0;
          width: 100%;
      }
  }

  #invoice {
      display: none;
  }
  .invoice-font-size{
    font-size: 18px;
  }
</style>

<main id="main" class="main">
    <div class="d-flex justify-content-between">
        <div class="pagetitle">
            <h1>Seller Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>
        <div class="text-end">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="{{route('report.index')}}" type="button" class="btn btn-success">Query</a>
                <button type="button" class="btn btn-danger" id="printBtn" onclick="printInvoice()">Download & Print</button>
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
                        <th scope="col" class="text-uppercase">Seller Name</th>
                        <th scope="col" class="text-uppercase">Ticket Name</th>
                        <th scope="col" class="text-uppercase text-end">QTY</th>
                        <th scope="col" class="text-uppercase text-end">Amount</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php
                        $grandTotal = 0;
                    @endphp 
                    @foreach($entryData as $userId => $rides)
                        @php
                            $user = \App\Models\User::find($userId);
                            $userTotal = 0;
                        @endphp
                        @foreach($rides as $rideId => $details)
                            <tr>
                                @if($loop->first)
                                    <th rowspan="{{ count($rides) }}" class="align-middle">{{ $user->name }}</th>
                                @endif
                                <td>{{ $details['t_name'] }}</td>
                                <td class="text-end">{{ $details['t_quantity'] }}</td>
                                <td class="text-end">{{ $details['t_amount'] }}</td>
                            </tr>
                            @php
                                $userTotal += $details['t_amount'];
                                $grandTotal += $details['t_amount'];
                            @endphp
                        @endforeach
                        <tr>
                            <th scope="row" colspan="3" class="text-uppercase text-end">Total</th>
                            <th class="text-end">{{ $userTotal }}</th>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row" colspan="3" class="text-uppercase text-end">Grand Total</th>
                        <th class="text-end">{{ $grandTotal }}</th>
                    </tr>
                </tbody>
            </table>         
            
            </div>
          </div>
        </div>
  </div>


  <div class="row justify-content-center mt-5 ms-2" id="invoice">

    <div class="row mb-3">
      <div class="col-8">
        <h4 class=""><strong>Bangladesh Air Force Museum</strong></h4>
        <address class="invoice-font-size">
          <strong class="mb-2">Contact Information</strong><br>
          <span>7657 NW Prairie, Agargaon</span><br>
          <span>Dhaka, Bangladesh</span><br>
          <span>Phone: (816) 741-5790</span><br>
          <span>Email: email@client.com </span><br>
          <span>Website: <a href="">bafmuseum.mil.bd</a></span>
        </address>
      </div>  
      <div class="col-4">
        <h4 class="row">
          <span class="col-6">Invoice #</span>
          <span class="col-6 text-sm-end">INT</span>
        </h4>
        <div class="row invoice-font-size">
          <span class="col-6">Issue Date</span>
          <span class="col-6 text-sm-end">12/10/2025</span>
          <span class="col-6">Form Date</span>
          <span class="col-6 text-sm-end">12/10/2025</span>
          <span class="col-6">To Data</span>
          <span class="col-6 text-sm-end">18/12/2025</span>
        </div> 
      </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-uppercase">Name</th>
                  <th scope="col" class="text-uppercase">Ride</th>
                  <th scope="col" class="text-uppercase text-end">Unit Price</th>
                  <th scope="col" class="text-uppercase text-end">QTY</th>
                  <th scope="col" class="text-uppercase text-end">Amount</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                <tr>
                  <th rowspan="3" class="align-middle">Seller 1</th>
                  <td>Ride 1 - This is Ride 1</td>
                  <td class="text-end">75</td>
                  <td class="text-end">2</td>
                  <td class="text-end">150</td>
                </tr>
                <tr>
                  <td>Ride 2 - This is Ride 2</td>
                  <td class="text-end">100</td>
                  <td class="text-end">3</td>
                  <td class="text-end">300</td>
                </tr>
                <tr>
                  <td>Ride 3 - This is Ride 3</td>
                  <td class="text-end">150</td>
                  <td class="text-end">3</td>
                  <td class="text-end">450</td>
                </tr>
                <tr>
                  <th scope="row" colspan="4" class="text-uppercase text-end">Total</th>
                  <th class="text-end">Tk. 950</th>
                </tr>
                <tr>
                  <th scope="row" colspan="4" class="text-uppercase text-end">Grand Total</th>
                  <th class="text-end ">Tk. 2850</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
</main>

<script>
  function printInvoice() {
      document.getElementById('invoice').style.display = 'block';
      window.print();
      document.getElementById('invoice').style.display = 'none';
  }
</script>
@endsection
