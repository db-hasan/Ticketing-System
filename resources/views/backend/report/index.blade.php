@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Report Query</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Query</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end pt-2">
                <a href="{{ route('dashboard') }}" class="btn btn-primary"><i class="fa-regular fa-eye"></i>
                    Dashboard</a>
            </div>
        </div>
        <hr>

        <div class="row ">
            <div class="col-md-6">
                <div class="card p-3">
                    <form action="{{ route('report.sales') }}" method="post">
                        @csrf
                        <div class="row g-3 pt-3">
                            <div class="col-md-12">
                                <label for="sales" class="form-label">Sales Report</label>
                                <select id="sales" class="form-select" disabled>
                                    <option selected>All Sales</option>
                                </select>
                            </div>
                            <div class="col-md-6 pb-4">
                                <label for="formsalesdate" class="form-label">Form Date</label>
                                <input type="date" class="form-control" id="formsalesdate" name="formsalesdate" required>
                                @error('formsalesdate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 pb-4">
                                <label for="tosalesdate" class="form-label">To Date</label>
                                <input type="date" class="form-control" id="tosalesdate" name="tosalesdate" required>
                                @error('tosalesdate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row g-1 pb-3">
                            <button type="submit" class="btn btn-primary fw-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3">
                    <form action="{{ route('report.seller') }}" method="post">
                        @csrf
                        <div class="row g-3 pt-3">

                            <div class="col-md-12">
                                <label for="seller" class="form-label">Seller Report</label>
                                <select id="seller" class="form-select" disabled>
                                    <option selected>All Seller</option>
                                </select>
                            </div>
                            <div class="col-md-6 pb-4">
                                <label for="formsellerdate" class="form-label">Form Date</label>
                                <input type="date" class="form-control" id="formsellerdate" name="formsellerdate"
                                    required>
                                @error('formsellerdate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 pb-4">
                                <label for="tosellerdate" class="form-label">To Date</label>
                                <input type="date" class="form-control" id="tosellerdate" name="tosellerdate" required>
                                @error('tosellerdate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="row g-1 pb-3">
                            <button type="submit" class="btn btn-primary fw-100">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </main>
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }} "></script>
@endsection
