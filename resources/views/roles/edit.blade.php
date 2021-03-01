@extends('layouts.admin')

@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">

              <div class="card-header ">
                Edit "{{$role->name}}" Role
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

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{route("roles.update",["role"=> $role->id])}}" method="post">
                    @method('PATCH')
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="role_name">Role Name</label>
                                <input type="text" value="{{$role->name}}" name="role_name" id="role_name" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row border-bottom py-2 border-info">
                        <div class="col-2 align-self-center">
                            <h3><strong>Resource</strong></h3>
                        </div>
                        <div class="col-10 align-self-center">
                            <h3><strong>Actions Allowed</strong></h3>
                        </div>
                    </div>
                    @foreach ($policies as $resource => $resource_policies)
                    <div class="row border-bottom py-2 border-info">
                        <div class="col-2 align-self-center">
                            <h4>{{$resource}}</h4>
                        </div>
                        <div class="col-10 align-self-center">
                            <div class="form-group">
                                @foreach ($resource_policies as $policy)                                
                                    <div class="form-check form-check-inline">
                                        <input class="" type="checkbox" id="{{$policy->name}}" value="{{$policy->id}}" name="policies[]" {{$role_policies_ids->contains($policy->id) ? 'checked' : '' }}>
                                        <label class="mt-2 ml-1" for="{{$policy->name}}">{{$policy->action}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>    
                    @endforeach

                    <div class="row p-4">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                </form>


              </div>
            </div>
          </div>
        </div>
@endsection