@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Entry Ticket Create</h1>
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
        <div class="card">
            <form method="post" action="{{ route('entry.store') }}" enctype="multipart/form-data" class="row g-3 p-3">
                @csrf
            
                <div class="col-md-12 pb-3">
                    <label for="price" class="form-label">Entry Ticket <span class="text-danger">*</span></label>
                    <select id="price" name="price_id" class="form-select" required>
                        @foreach ($prices as $price)
                            <option selected value="{{ $price->id }}">{{ $price->name }} (Tk. {{ $price->price }})</option>
                        @endforeach
                    </select>
                    @error('price_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="col-md-12 pb-3">
                    <label for="number" class="form-label">Phone Number<span class="text-danger">*</span></label>
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
