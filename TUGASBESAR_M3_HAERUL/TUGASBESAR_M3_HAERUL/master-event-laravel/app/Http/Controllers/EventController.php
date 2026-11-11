<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required',
            'kategori'  => 'required',
            'durasi'    => 'required',
            'deskripsi' => 'required',
            'materi'    => 'required',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'judul'     => 'required',
            'kategori'  => 'required',
            'durasi'    => 'required',
            'deskripsi' => 'required',
            'materi'    => 'required',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus!');
    }
}