<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if(auth()->user()->hasReserve($event->id)){
            return redirect()->back()->withErrors('You already reserved this event.');
        }
        $reservation = new Reservation;
        $reservation->user_id = auth()->id();
        $reservation->event_id = $event->id;
        $reservation->save();
        return redirect()
            ->route('user.all')
            ->with('success', 'Your reservation has been made successfully.');
    }

    public function showTicket(Request $request, $event_id)
    {
        $Ticket = $request->user()->reservations()->where('event_id', $event_id)->where('valid', true)->first();

        return view('user.events.ticket', ['ticket' => $Ticket]);
    }
}
