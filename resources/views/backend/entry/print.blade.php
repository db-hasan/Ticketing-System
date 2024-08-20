@extends('backend/layouts')
@section('content')
    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1cm; /* Adjust margin to fit the content */
            }

            body * {
                visibility: hidden; /* Hide everything */
            }

            #invoice,
            #invoice * {
                visibility: visible; /* Only make invoice content visible */
            }

            #invoice {
                position: absolute;
                left: 0;
                top: 0;
            }

            .container{
                width: 350px;
                margin: 10px auto;
            }
        }
    </style>

    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Entry Ticket</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
            @can('ticket-index')
            <div class="text-end pt-2">
                <a href="{{ route('entry.index') }}" class="btn btn-primary"><i class="fa-regular fa-eye"></i>
                    View Ticket</a>
            </div>
            @endcan
        </div>
        <hr>

        <div id="invoice">
            <div class="container">
                <div class="text-center">
                    <h5><strong>Bangladesh Air Force Museum</strong></h5>
                    <address>
                        <span>Agargaon, Dhaka - Bangladesh</span><br>
                        <span>Phone: (816) 741-5790</span><br>
                        <span>Email: email@client.com</span><br>
                        <span>Website: <a href="">bafmuseum.mil.bd</a></span>
                    </address>
                </div>
                <div class="row">
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
            </div>
            <hr>
            <div class="text-center">
                <span>Thank you</span>
            </div>         
        </div>       
    </main>

    <script>
        window.onload = function() {
            window.print();

            // Redirect after a short delay to ensure printing has started
            setTimeout(function() {
                window.location.href = "{{ route('entry.create') }}";
            }, 1000); // Adjust the delay as needed
        };
    </script>
@endsection
