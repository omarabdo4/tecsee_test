@extends('layouts.admin')

@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">

              <div class="card-header ">
                Users
              </div>
              
              <div class="card-body ">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                        <form action="{{route("users.assign",['user'=> $user->id])}}" method="post" id="assign-form{{$user->id}}">
                          @csrf
                          <div class="form-group">
                            <select name="role_id" class="custom-select" id="inputGroupSelect01" onchange="document.getElementById('assign-form{{$user->id}}').submit();">
                              @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{$user->role->id == $role->id ? 'selected':''}}>{{$role->name}}</option>
                              @endforeach
                            </select>
                          </div>
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