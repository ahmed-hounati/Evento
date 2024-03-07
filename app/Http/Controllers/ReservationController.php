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
        if ($event->auto_confirmation) {
            $reservation->valid = 1;
        }
        $reservation->save();
        return redirect()
            ->route('user.all')
            ->with('success', 'Your reservation has been made successfully.');
    }

    public function allReservations($id)
    {
        $event = Event::with('reservations.user')->find($id);

        if (!$event) {
            return redirect()
                ->route('event.error')
                ->with('error', 'Event not found.');
        }

        $reservations = $event->reservations;

        return view('organizer.events.reservations', ['reservations' => $reservations]);
    }
    public function valid($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(!$reservation){
            return redirect()->back()->with('error', 'Reservation not found');
        }
        $reservation->valid = 1;
        $reservation->save();
        return redirect()->route('organizer.all')->with('success', 'user validated successfully!');
    }

    public function showTicket(Request $request, $event_id)
    {
        $ticket = $request->user()->reservations()->with('event', 'user')
            ->where('event_id', $event_id)
            ->where('valid', true)
            ->first();
        return view('user.events.ticket', ['ticket' => $ticket]);
    }


}
