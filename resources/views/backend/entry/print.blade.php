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
            font-size: 8px !important;
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
            <div class="comp-name"><strong>Bangladesh Air Force Museum</strong></div>
            <address class="text-center">
                <span>Agargaon, Dhaka - Bangladesh</span><br>
                <span>Phone: (816) 741-5790</span><br>
                <span>Email: email@client.com</span><br>
                <span>Website: <a href="#">bafmuseum.mil.bd</a></span>
            </address>
        </div>
        <div class="row inv-content">
            <div class="col-6">
                <div class="">
                    <span>{{ $entry->prices->name }}</span>
                </div>
                <div class="">
                    <span>Date:</span>
                    <span>{{ $today }}</span>
                </div>
                <div class="">
                    <span>Price:</span>
                    <span>Tk. {{ $entry->price }}</span>
                </div>
                <div class="">
                    <span>PH:</span>
                    <span>{{ $entry->number }}</span>
                </div>
            </div>
            <div class="col-6 text-end">{!! $qrCode !!}</div>
        </div>
        <hr>
        <div class="thankyou text-center">
            <span>Thank you</span>
        </div>
    </div>
    
</div>

<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    window.print();
</script>
