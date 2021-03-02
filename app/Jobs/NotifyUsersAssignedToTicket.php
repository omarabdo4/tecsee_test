<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\AssignedToTicketMail;

class NotifyUsersAssignedToTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->ticket->assigned_users as $user) {
            // Mail::to('info@tecsee.com')->send(new AssignedToTicketMail($this->ticket));
            Mail::to($user->email)->send(new AssignedToTicketMail($this->ticket));
        }
    }
}
