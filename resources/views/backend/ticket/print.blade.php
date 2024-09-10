@extends('backend/layouts')
@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

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

            body * {
                visibility: hidden;
            }

            #invoice,
            #invoice * {
                visibility: visible;
            }

            #invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

        }
    </style>

    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Print Ride</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="{{ route('ticket.create') }}" type="button" class="btn btn-success">Create</a>
                    <a href="{{ route('ticket.index') }}" type="button" class="btn btn-warning">List</a>
                    <button type="button" class="btn btn-danger" id="printBtn" onclick="printInvoice()">Print</button>
                </div>
            </div>
        </div>
        <hr>

        <div id="invoice">
            <div style="margin: 0; padding: 0; font-family: 'Roboto', sans-serif;">
                <div style="text-align: center;">
                    <div style="font-size: 6px; font-weight: 600;">Bangladesh Air Force Museum</div>
                    <address style="font-size: 6px;">
                        <span>Agargaon, Dhaka - Bangladesh</span><br>
                        <span>Phone: (816) 741-5790</span><br>
                        <span>Email: email@client.com</span><br>
                        <span>Website: <a href="#" style="text-decoration: none;">bafmuseum.mil.bd</a></span>
                    </address>
                </div>
                <div style="text-align: center;">
                    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code Not Found">
                </div>
                <span style="font-size: 7px; margin: 8px;">Date: {{ $ticket->created_at->format('Y-m-d') }}</span>
                <table class="table" style="font-size: 6px;">
                    <thead>
                        <tr>
                            <th scope="col" class="">Name</th>
                            <th scope="col" class="text-end">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($ticket->details as $detail)
                            @php
                                $total += $detail->price;
                            @endphp
                            <tr>
                                <td>{{ $detail->ride->name }}</td>
                                <td class="text-end">{{ $detail->price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-end">Total</td>
                            <td class="text-end">Tk. {{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center; font-size: 6px;">
                    <span>Thank you</span>
                </div>
            </div>

        </div>
    </main>

    <script>
        function invoice() {
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = document.getElementById('invoice').innerHTML;
            window.print();
            document.body.innerHTML = originalContent;
        }
        window.onload = invoice;
    </script>

    <script>
        function printInvoice() {
            document.getElementById('invoice')
            window.print();
        }
    </script>
{{-- @endsection --}}