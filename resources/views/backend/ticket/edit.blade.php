@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Update Ticket</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end pt-2">
                <a href="{{ route('ticket.index') }}" class="btn btn-primary"><i class="fa-regular fa-eye"></i>
                    View
                    Ticket</a>
            </div>
        </div>
        <hr>
        <div class="card">
            <form method="post" action="{{ route('ticket.update', $ticket->id) }}" enctype="multipart/form-data"
                class="row g-3 p-3">
                @csrf
                @method('PUT')

                <label for="ride" class="form-label">Select Ride<span class="text-danger">*</span></label>
                <div class="d-flex flex-wrap mt-0">
                    @foreach ($rides as $ride)
                        <div class="form-check me-3 mb-2">
                            <input class="form-check-input" id="check{{ $ride->id }}" value="{{ $ride->id }}"
                                name="ride[]" type="checkbox" @if (in_array($ride->id, $ticket->details->pluck('ride_id')->toArray())) checked @endif>
                            <label class="form-check-label" for="check{{ $ride->id }}">{{ $ride->name }}</label>
                            <br>
                            <span>Tk. {{ $ride->price }}</span>
                        </div>
                    @endforeach
                </div>
                <strong>Total:</strong>
                @error('ride')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

    </main>
@endsection
