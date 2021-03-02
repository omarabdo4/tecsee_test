<div class="sidebar" data-color="purple" data-background-color="white">
    <div class="logo">
        <p class="simple-text logo-normal">
        Tecsee Test
        </p>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::segment(1)=="tickets" ? "active" : "" }}" data-toggle="collapse" href="#ticketsCollapse" ticket="button" aria-expanded="false" aria-controls="ticketsCollapse">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    <p>{{__('messages.tickets')}}</p>
                </a>
                <div class="collapse {{ Request::segment(1)=="tickets" ? "show" : "" }}" id="ticketsCollapse">
                    <ul class="nav d-flex px-4">
                        <li class="nav-item flex-fill {{ Request::is("tickets") ? "active" : "" }}">
                            <a class="nav-link" href="{{route("tickets.index")}}">{{__('messages.view_all_tickets')}}</a>
                        </li>
                        <li class="nav-item flex-fill {{ Request::is("tickets/create") ? "active" : "" }}">
                            <a class="nav-link" href="{{route("tickets.create")}}">{{__('messages.add_new_ticket')}}</a>
                        </li>
                    </ul>
                </div>
            
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::segment(1)=="roles" ? "active" : "" }}" data-toggle="collapse" href="#rolesCollapse" role="button" aria-expanded="false" aria-controls="rolesCollapse">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <p>{{__('messages.roles')}}</p>
                </a>
                <div class="collapse {{ Request::segment(1)=="roles" ? "show" : "" }}" id="rolesCollapse">
                    <ul class="nav d-flex px-4">
                        <li class="nav-item flex-fill {{ Request::is("roles") ? "active" : "" }}">
                            <a class="nav-link" href="{{route("roles.index")}}">{{__('messages.view_all_roles')}}</a>
                        </li>
                        <li class="nav-item flex-fill {{ Request::is("roles/create") ? "active" : "" }}">
                            <a class="nav-link" href="{{route("roles.create")}}">{{__('messages.add_new_role')}}</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ Request::segment(1)=="users" ? "active" : "" }}" data-toggle="collapse" href="#usersCollapse" role="button" aria-expanded="false" aria-controls="usersCollapse">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <p>{{__('messages.Users')}}</p>
                </a>
                <div class="collapse {{ Request::segment(1)=="users" ? "show" : "" }}" id="usersCollapse">
                    <ul class="nav d-flex px-4">
                        <li class="nav-item flex-fill {{ Request::is("users") ? "active" : "" }}">
                            <a class="nav-link" href="{{route("users.index")}}">{{__('messages.view_all_users')}}</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>