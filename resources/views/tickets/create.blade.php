@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="{{asset("css/dtsel.css")}}" />
    <script src="{{asset("js/dtsel.js")}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>        
            (function() {
                instance = new dtsel.DTS('input[name="due_at"]',{
                    showTime: true,
                    direction: 'BOTTOM'
                });
                
                $('.js-example-basic-multiple').select2({
                    width: "resolve",
                    theme: "classic"
                });            
            })();
    </script>
@endpush

@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">

              <div class="card-header ">
                Create New ticket
              </div>
              
              <div class="card-body ">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{route("tickets.store")}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" cols="10" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row py-5">
                        <div class="col-sm-12 col-md-6">
                            <label for="due_at">Due At :</label>
                            <input name="due_at" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group" style="clear:both;">
                                <label for="inputusers">Assign To Users :</label><br>
                                <select id="inputusers" class="js-example-basic-multiple" name="user_ids[]" multiple="multiple" style="width:100%">
                                    @foreach ($users as $user)
                                        @if ($user->id != Auth::user()->id)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row p-4">
                        <button type="submit" class="btn btn-primary">Add ticket</button>
                    </div>
                </form>


              </div>
            </div>
          </div>
        </div>
@endsection