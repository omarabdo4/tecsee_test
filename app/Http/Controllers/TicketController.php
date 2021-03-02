<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

use App\Jobs\NotifyUsersAssignedToTicket;
use App\Jobs\NotifyUserTicketStatus;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authenticated_user = $request->user();
        
        if($authenticated_user->role->name == "owner"){
            $tickets = Ticket::paginate();
        }else{
            $tickets = Ticket::whereHas('assigned_users', function (Builder $query) use($authenticated_user) {
                $query->where('user_ticket.user_id', $authenticated_user->id);
            })
            ->orWhere("user_id",$authenticated_user->id)
            ->with('owner','assigned_users')
            ->latest()
            ->paginate();
        }
        return view('tickets.index',["tickets" => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('tickets.create',["users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_users_ids = User::where('id','!=',$request->user()->id)->pluck('id');

        $request->validate([
            'due_at' => ['date_format:Y-m-d H:i:s'],
            'content' => ['required','string','max:1000'],
            'user_ids' => ['array','min:1','max:500'],
            'user_ids.*' => ['integer', Rule::in($all_users_ids)]
        ]);

        $ticket = new Ticket();
        $ticket->content = $request->content;
        $ticket->user_id = $request->user()->id;
        $ticket->due_at = $request->due_at;
        $ticket->save();
        $ticket->assigned_users()->attach($request->user_ids);

        NotifyUsersAssignedToTicket::dispatch($ticket);

        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('status','ticket deleted successfully');
    }

    public function open(Ticket $ticket)
    {
        if($ticket->status != 1){
            abort(400);
        }
        $ticket->status = 2;
        $ticket->save();
        NotifyUserTicketStatus::dispatch($ticket);
        return redirect()->back()->with('status','ticket updated successfully');
    }

    public function close(Ticket $ticket)
    {
        if($ticket->status == 1){
            abort(400);
        }
        $ticket->status = 1;
        $ticket->save();
        NotifyUserTicketStatus::dispatch($ticket);
        return redirect()->back()->with('status','ticket updated successfully');
    }

}
