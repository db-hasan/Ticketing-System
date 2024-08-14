@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Ticket List</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            @can('ticket-create')
            <div class="text-end pt-2">
                <a href="{{ route('ticket.create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Add Ticket</a>
            </div>
            @endcan
        </div>
        <hr>
        <div class="custom-scrollbar-table">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NO</th>
                        <th>SalesMan</th>
                        <th>Ref Code</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>#{{ $ticket->id}}</td>
                            <td>{{ $ticket->user->name}}</td>
                            <td>{{ $ticket->ref_code}}</td>
                            <td>{{ $ticket->number}}</td>
                            <td>{{ $ticket->created_at}}</td>
                            <td>
                                @if($ticket->status == 1)
                                    Active
                                @elseif($ticket->status == 2)
                                    Inactive
                                @endif
                            </td>
                            <td class="d-flex justify-content-end">
                                @can('ticket-edit')
                                <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-primary mx-1"><i class="bi bi-pencil-square"></i></a>
                                @endcan

                                @can('ticket-delete')
                                <form class="deleteForm" action="{{ route('ticket.destroy', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btnDelete"><i class="bi bi-trash"></i></button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }} "></script>
@endsection
