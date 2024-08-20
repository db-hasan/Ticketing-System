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
                    View
                    Ticket</a>
            </div>
            @endcan
        </div>
        <hr>

        <div class="row justify-content-center mt-5 ms-2" id="invoice">
            <p><strong>Reference Code:</strong> {{ $entry->ref_code }}</p>
            <p><strong>Phone Number:</strong> {{ $entry->number }}</p>
            <p><strong>Price:</strong> Tk. {{ $entry->price }}</p>
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

