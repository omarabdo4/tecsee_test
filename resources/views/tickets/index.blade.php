@extends('layouts.admin')

@section('content')
  {{-- modals --}}
  @foreach ($tickets as $ticket)    
  <div class="modal fade" id="deleteModal{{$ticket["id"]}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$ticket["id"]}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel{{$ticket["id"]}}">Are you sure you want to delete this ticket ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>        
          <button class="btn btn-danger" onclick="document.getElementById('delete-form{{$ticket["id"]}}').submit();">
              Yes
          </button>
          <form id="delete-form{{$ticket["id"]}}" action="{{route("tickets.destroy",["ticket"=>$ticket->id])}}" method="POST" style="display: none;">
              @csrf
              @method("DELETE")
          </form>
        </div>
      </div>
    </div>
  </div>                                  
  @endforeach

        <div class="row">
          <div class="col-md-12">
            <div class="card ">

              <div class="card-header ">
                <h4>
                  Tickets
                </h4>
              </div>
              
              <div class="card-body ">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">                  
                @foreach ($tickets as $ticket)
                  <div class="col-sm-12 col-md-4">
                      <div class="card">
                          <div class="card-header">
                              Ticket Owner : {{$ticket->owner->name}}
                          </div>
                          <div class="card-body">
                              <div class="card text-white bg-dark">
                                <div class="card-body">
                                  <p class="card-text">{{$ticket->content}}</p>
                                </div>
                              </div>
                              <p>Status : {{$ticket->status == 1 ? 'closed' : 'opened'}}</p>
                              <p class="text-muted">Due At : {{$ticket->due_at}}</p>
                              <p class="card-text">
                                Assigned Users :
                                <div class="row">
                                @foreach ($ticket->assigned_users as $user)
                                    <div class="col-sm-8 col-md-4">
                                      <div class="card text-white bg-info">
                                        <div class="card-body">
                                          {{$user->name}}
                                        </div>
                                      </div>
                                    </div>
                                @endforeach
                                </div>
                              </p>
                              {{-- TODO : use @can here --}}
                              @if ($ticket->status == 1)
                                  <a href="{{route('tickets.open',["ticket" => $ticket->id ])}}" class="btn btn-warning">Open</a>
                              @else
                                  <a href="{{route('tickets.close',["ticket" => $ticket->id ])}}" class="btn btn-primary">Close</a>
                              @endif
                              
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$ticket->id}}">
                                  Delete &ThickSpace;
                                  <i class="fas fa-trash"></i>
                              </button>

                          </div>
                      </div>
                  </div>
                @endforeach
                </div>

                {{ $tickets->links() }}

              </div>
            </div>
          </div>
        </div>
@endsection