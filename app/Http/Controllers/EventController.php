<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::join('categories', 'events.category_id', '=', 'categories.id')
            ->where('valid', true)
            ->select('events.*', 'categories.name as category_name')
            ->get();
        $organizers = Event::join('users', 'events.organizer_id', '=', 'users.id')
            ->select('events.*', 'users.name as organizer_name')
            ->get();
        return view('organizer.events.all', ['events' => $events ,'organizers'=>$organizers]);
    }
    public function create(){
        $categories = Category::all();
        return view('organizer.events.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'place' => ['required'],
            'date' => ['required'],
            'availablePlaces' => ['required'],
            'auto_confirmation' => ['required'],
        ]);

        Event::create(
            $request->all()
        );

        return redirect()->route('organizer.dashboard');
    }
    public function show($id)
    {
        $event = Event::findOrFail($id)->join('categories', 'events.category_id', '=', 'categories.id')
        ->select('events.*', 'categories.name as category_name')
        ->first();
        $organizer = Event::join('users', 'events.organizer_id', '=', 'users.id')
            ->where('events.id', '=', $id)
            ->select('events.*', 'users.name as organizer_name')
            ->first();
        return view('organizer.events.show', ['event' => $event,'organizer'=>$organizer]);
    }

    public function edit($id)
    {
        $categories = Category::all();
        $events = Event::findOrFail($id)->join('categories', 'events.category_id', '=', 'categories.id')
            ->select('events.*', 'categories.name as category_name')
            ->get();
        $organizer = Event::join('users', 'events.organizer_id', '=', 'users.id')
            ->where('events.id', '=', $id)
            ->select('events.*', 'users.name as organizer_name')
            ->first();
        return view('organizer.events.edit', ['events' => $events,'organizer'=>$organizer, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'place' => ['required'],
            'date' => ['required'],
            'availablePlaces' => ['required'],
            'auto_confirmation' => ['required'],
            'category_id' => ['required'],
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('organizer.dashboard');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('organizer.dashboard');
    }
    public function user(Request $request)
    {
        $categories = Category::all();

        $category = $request->get('category_name');

        $eventsQuery = Event::join('categories', 'events.category_id', '=', 'categories.id')
            ->where('valid', true);

        if ($category) {
            $eventsQuery->where('categories.name', $category);
        }

        $events = $eventsQuery->select('events.*', 'categories.name as category_name')
            ->paginate(9);

        return view('user.events.all', compact('events', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $title = $request->get('title');
        $events = Event::join('categories', 'events.category_id', '=', 'categories.id')
            ->join('users', 'events.organizer_id', '=', 'users.id')
            ->select('events.*', 'categories.name as category_name', 'users.name as organizer_name');
        $events = $events->where('events.title', 'LIKE', "%{$title}%");
        $events = $events->paginate(9);
        return view('user.events.search', ['events' => $events, 'categories' => $categories]);
    }


    public function allEvents()
    {
        $events = Event::join('categories', 'events.category_id', '=', 'categories.id')
            ->select('events.*', 'categories.name as category_name')
            ->get();
        $organizer = Event::join('users', 'events.organizer_id', '=', 'users.id')
            ->select('events.*', 'users.name as organizer_name')
            ->get();
        return view('admin.events.all', ['events' => $events ,'organizer'=>$organizer]);
    }

    public function valid($id)
    {
        $event = Event::findOrFail($id);
        $event->valid = 1;
        $event->save();
        return redirect()->route('event.all')->with('success', 'Event validated successfully!');
    }

}
