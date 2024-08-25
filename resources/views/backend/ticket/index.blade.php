@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Ride Ticket</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            @can('ticket-create')
                <div class="text-end pt-2">
                    <a href="{{ route('ticket.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                        Add Ticket</a>
                </div>
            @endcan
        </div>
        <hr>
        <div class="custom-scrollbar-table">
            <div class="d-flex justify-content-end pb-3">
                <div class="col-12 col-md-3">
                    <input type="text" class="form-control" id="search" placeholder="Search by Number or Ref Code">
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SalesMan</th>
                        <th>Ref Code</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>#{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->name }}</td>
                            <td>{{ $ticket->ref_code }}</td>
                            <td>{{ $ticket->created_at }}</td>
                            <td>
                                @if ($ticket->status == 1)
                                    Active
                                @elseif($ticket->status == 2)
                                    Inactive
                                @endif
                            </td>
                            <td class="d-flex justify-content-end">
                                @can('ticket-print')
                                    <a href="{{ route('ticket.print', $ticket->id) }}" class="btn btn-primary mx-1"><i
                                            class="bi bi-printer"></i></a>
                                @endcan

                                @can('ticket-delete')
                                        <form class="deleteForm" action="{{ route('ticket.destroy', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btnDelete"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tbody id="content" class="searchdata"></tbody>
            </table>
            @if ($tickets->hasPages())
                <div class="">{{ $tickets->links() }}</div>
            @endif
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#search').on('keyup', function(){
            $value = $(this).val();

            if($value){
                $('.alldata').hide();
                $('searchdata').show();
            }else{
                $('.alldata').show();
                $('searchdata').hide();
            }

            $.ajax({
                type : 'get',
                url  : '{{URL::to('ridesearch')}}',
                data : {'search':$value},
         
                success:function(data){
                    console.log(data);
                    $('#content').html(data);
                }
            });
            // alert($value);
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btnDelete', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this ticket?')) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
    
    
@endsection
