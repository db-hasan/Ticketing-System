@extends('backend/layouts')
@section('content')
    <main id="main" class="main">

        <div class="row ">
            <h3>Sales Report</h3>
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="row g-3 pt-3">
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Sales Report</label>
                            <select id="inputState" class="form-select" disabled>
                            <option selected>All Sales</option>
                            </select>
                        </div>
                        <div class="col-md-6 pb-4">
                            <label for="inputPassword4" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-md-6 pb-4">
                            <label for="inputPassword4" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="inputPassword4">
                        </div>
                    </div>
                    <div class="row g-1 pb-3">
                        <button type="submit" class="btn btn-primary fw-100">Submit</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3">
                    <div class="row g-3 pt-3">
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Seller Report</label>
                            <select id="inputState" class="form-select">
                            <option selected>Select Seller</option>
                            </select>
                        </div>

                        <div class="col-md-6 pb-4">
                            <label for="inputPassword4" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-md-6 pb-4">
                            <label for="inputPassword4" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="inputPassword4">
                        </div>
                    </div>
                    <div class="row g-1 pb-3">
                        <button type="submit" class="btn btn-primary fw-100">Submit</button>
                    </div>
                </div>
                
            </div>
        </div>

    </main>
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }} "></script>
@endsection
