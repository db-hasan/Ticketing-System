@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Entry Ticket</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            @can('ticket-create')
            <div class="text-end pt-2">
                <a href="{{ route('entry.create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
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
                        <th>Name</th>
                        <th>Ref Code</th>
                        <th>Phone</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="alldata">
                    @foreach ($entries as $entry)
                        <tr>
                            <td>{{ $entry->id}}</td>
                            <td>{{ $entry->user->name}}</td>
                            <td>{{ $entry->prices->name}}</td>
                            <td>{{ $entry->ref_code}}</td>
                            <td>{{ $entry->number}}</td>
                            <td>{{ $entry->price}}</td>
                            <td>{{ $entry->created_at}}</td>
                            <td>
                                @if($entry->status == 1)
                                    Active
                                @elseif($entry->status == 2)
                                    Inactive
                                @endif
                            </td>
                            <td class="d-flex justify-content-end">
                                @can('entry-print')
                                <a href="{{ route('entry.print', $entry->id) }}" class="btn btn-primary mx-1"><i class="bi bi-printer"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tbody id="content" class="searchdata"></tbody>

            </table>
            @if ($entries->hasPages())
                <div class="">{{ $entries->links() }}</div>
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
                url  : '{{URL::to('entrysearch')}}',
                data : {'search':$value},

                success:function(data){
                    console.log(data);
                    $('#content').html(data);
                }
            });
            // alert($value);
        });
    </script>

@endsection
