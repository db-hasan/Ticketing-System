@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>New Ticket Create</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
            <form method="post" action="{{ route('ticket.store') }}" enctype="multipart/form-data" class="row g-3 p-3">
                @csrf
        
                <div class="col-md-12 pb-3">
                    <label for="ride_id" class="form-label">Select Ride<span class="text-danger">*</span></label>
                    <select class="js-example-basic-multiple" name="ride_id[]" multiple="multiple">
                        <option value="">Choose a Ride</option>
                        @foreach($rides as $ride)
                            <option value="{{ $ride->id }}">{{ $ride->name }}</option>
                        @endforeach
                    </select>
                    @error('ride_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
        
                <div class="col-md-12 pb-3">
                    <label for="number" class="form-label">Number<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="number" name="number" value="{{ old('number') }}" required>
                    @error('number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        
    </main>
@endsection
