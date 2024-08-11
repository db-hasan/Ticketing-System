@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Ride List</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end pt-2">
                <a href="{{ route('ride.create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Add Ride</a>
            </div>
        </div>
        <hr>
        <div class="custom-scrollbar-table">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ride Name</th>
                        <th>Ride Price</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rides as $ride)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $ride->name}}</td>
                            <td>{{ $ride->price}}</td>
                            <td>
                                @if($ride->status == 1)
                                    Active
                                @elseif($ride->status == 2)
                                    Inactive
                                @endif
                            </td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('ride.edit', $ride->id) }}" class="btn btn-primary mx-1"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }} "></script>
@endsection
