@extends('layouts.app')
@section('title')
Ticket-List
@endsection
@section('content')
<div class="row gy-4">

  <div class="col-12">
    <div class="">
      <h3 class="card-title mb-sm-0 me-2"> Ticket List</h3>
      <p>List of Ticket are given below</p>

    </div>
    <hr>
  </div>

  <div class="col-12">

    <div class="card p-3">
        <div class="table-responsive text-nowrap mb-5">
            <table class="table">
                <thead>
                    <tr class="h5">
                        <th>Sr.No</th>
                        <th>Ticket Id</th>
                        <th>User Name</th>
                        <th>question</th>
                        <th>reply</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($ticketList as $list )

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $list->ticket_id}}</td>
                        <td>{{ $list->user_id }}</td>

                        <td>{{ $list->question }}</td>
                        <td>{{ $list->reply }}</td>
                        <td><span class="badge rounded-pill bg-label-success"><i class="fas fa-check me-1"></i>{{ $list->status }}</span></td>
                        <td>
                            <a href="{{ route('user.ticket.edit',$list->ticket_id) }}" class="text-danger text-opacity-75 pe-1 border-2 border-end border-danger"><i class="fas fa-edit"></i></a>
                            <form onsubmit="return confirm('Are you sure you want to delete this ticket?')"  action="{{ route('user.ticket.delete', $list->ticket_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn p-0 text-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



  </div>

  </div>




@endsection
