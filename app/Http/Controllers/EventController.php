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
            ->select('events.*', 'categories.name as category_name')
            ->get();
        $organizer = Event::join('users', 'events.organizer_id', '=', 'users.id')
            ->select('events.*', 'users.name as organizer_name')
            ->get();
        return view('organizer.events.all', ['events' => $events ,'organizer'=>$organizer]);
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
            'category_id' => ['required'],
        ]);

        Event::create(
            $request->all()
        );

        return redirect()->route('organizer.dashboard');
    }
    public function show($id)
    {
        $events = Event::findOrFail($id)->join('categories', 'events.category_id', '=', 'categories.id')
        ->select('events.*', 'categories.name as category_name')
        ->get();
        $organizer = Event::join('users', 'events.organizer_id', '=', 'users.id')
            ->where('events.id', '=', $id)
            ->select('events.*', 'users.name as organizer_name')
            ->first();
        return view('organizer.events.show', ['events' => $events,'organizer'=>$organizer]);
    }

    public function edit($id)
    {
        $events = Event::findOrFail($id)->join('categories', 'events.category_id', '=', 'categories.id')
            ->select('events.*', 'categories.name as category_name')
            ->get();
        $organizer = Event::join('users', 'events.organizer_id', '=', 'users.id')
            ->where('events.id', '=', $id)
            ->select('events.*', 'users.name as organizer_name')
            ->first();
        return view('organizer.events.edit', ['events' => $events,'organizer'=>$organizer]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
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

        $events = Event::join('categories', 'events.category_id', '=', 'categories.id')
            ->join('users', 'events.organizer_id', '=', 'users.id')
            ->select('events.*', 'categories.name as category_name', 'users.name as organizer_name');

        $category = $request->get('category_name');

        if ($category) {
            $events = $events->where('categories.name', $category);
        }

        $events = $events->paginate(9);

        return view('user.events.all', ['events' => $events, 'categories' => $categories]);
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
}
