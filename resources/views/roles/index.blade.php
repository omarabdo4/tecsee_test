@extends('layouts.admin')

@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">

              <div class="card-header ">
                Roles
              </div>
              
              <div class="card-body ">

                <ul>
                @foreach ($roles as $role)
                    <li>
                      {{$role->name}}
                      <a href="{{route('roles.edit',['role' => $role->id ])}}" class="btn btn-info my-4 mx-4">
                        Edit
                        <i class="fa fa-edit" aria-hidden="true"></i>
                      </a>
                    </li>
                @endforeach
                </ul>

              </div>
            </div>
          </div>
        </div>
@endsection