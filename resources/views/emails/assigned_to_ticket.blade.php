@component('mail::message')
# Hello From Omar Abdelfatah

<h3>
    This Ticket Assigned To You
</h3>

<h4>content : {{$ticket->content}}</h4>
<h4>due at : {{$ticket->due_at}}</h4>

Thanks,<br>
{{ config('app.name') }}
@endcomponent