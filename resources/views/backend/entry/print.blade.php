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
        <div class="text-center">
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code Not Found">
        </div>
        <table class="inv-content">
            <tr>
              <td>Name</td>
              <td>: {{ $entry->prices->name }}</td>
            </tr>
            <tr>
              <td>Date</td>
              <td>: {{ $today }}</td>
            </tr>
            <tr>
              <td>Price</td>
              <td>: Tk. {{ $entry->price }}</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>: {{ $entry->number }}</td>
            </tr>
        </table>
        <div class="thankyou text-center">
            <span>Thank you</span>
        </div>
    </div>
    
</div>

<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    function invoice() {
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = document.getElementById('invoice').innerHTML;
        window.print();
        document.body.innerHTML = originalContent;
    }
    window.onload = invoice;
    
</script>




