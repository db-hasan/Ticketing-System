<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<style>
    @media print {
        .container {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif !important;
        }

        @page {
            margin: 0;
        }

        .container a{
            text-decoration: none;
        }
        .company-info .comp-name {
            font-size: 6px !important;
            font-weight: 600;
        }
        .company-info address span{
            font-size: 6px !important;
        }
        .inv-content {
            font-size: 6px !important;
        }
        .thankyou{
            font-size: 8px !important; 
        }

    }
</style>

<div id="invoice">
    <div class="container">
        <div class="company-info">
            <div class="comp-name text-center">Bangladesh Air Force Museum</div>
            <address class="text-center">
                <span>Agargaon, Dhaka - Bangladesh</span><br>
                <span>Phone: (816) 741-5790</span><br>
                <span>Email: email@client.com</span><br>
                <span>Website: <a href="#">bafmuseum.mil.bd</a></span>
            </address>
        </div>
        <table class="table inv-content">
            <thead>
                <tr>
                    <th scope="col" class="text-uppercase">Name</th>
                    <th scope="col" class="text-uppercase text-end">Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($ticket->details as $detail)
                    @php
                        $total += $detail->price;
                    @endphp
                    <tr>
                        <td>{{ $detail->ride->name }}</td>
                        <td class="text-end">{{ $detail->price }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td scope="row" class="text-end">Total</td>
                    <td class="text-end">Tk. {{ $total }}</td>
                </tr>
            </tbody>
        </table>
        <div class="thankyou text-center">
            <span>Thank you</span>
        </div>
    </div>
    
</div>

<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    window.print();
</script>
