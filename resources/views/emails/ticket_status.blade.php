@component('mail::message')
# Hello From Omar Abdelfatah

<h3>
    This Ticket Status Changed
</h3>

<h4>content : {{$ticket->content}}</h4>
<h4>due at : {{$ticket->due_at}}</h4>
<h4>Status : {{$ticket->status == 1 ? 'closed' : 'reopened'}}</h4>

Thanks,<br>
{{ config('app.name') }}
@endcomponent