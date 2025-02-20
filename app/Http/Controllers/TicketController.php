<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Admins can see all tickets
            $tickets = Ticket::with(['creator', 'agent', 'category'])
                ->latest()
                ->paginate(10);
        } else {
            // Regular users can only see their tickets
            $tickets = $user->tickets()
                ->with(['agent', 'category'])
                ->latest()
                ->paginate(10);
        }

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket
     */
    public function create()
    {
        $categories = Categories::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created ticket
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ticket = $user->tickets()->create($validated);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket créé avec succès.');
    }

    /**
     * Display the specified ticket
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        
        $ticket->load(['creator', 'agent', 'category']);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the ticket
     */
    public function edit(Ticket $ticket)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        
        if ($ticket->status === 'closed') {
            return back()->with('error', 'Les tickets fermés ne peuvent pas être modifiés.');
        }

        $categories = Categories::all();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    /**
     * Update the specified ticket
     */
    public function update(Request $request, Ticket $ticket)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        if ($ticket->status === 'closed') {
            return back()->with('error', 'Les tickets fermés ne peuvent pas être modifiés.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:open,in_progress,closed'
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket mis à jour avec succès.');
    }

    /**
     * Assign the ticket to an agent
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $this->authorize('assign', $ticket);

        if (!$ticket->canBeModified()) {
            return back()->with('error', 'Les tickets fermés ne peuvent pas être modifiés.');
        }

        $validated = $request->validate([
            'agent_id' => 'required|exists:users,id'
        ]);

        $ticket->update([
            'assigned_to' => $validated['agent_id']
        ]);

        return back()->with('success', 'Ticket assigné avec succès.');
    }

    /**
     * Close the ticket
     */
    public function close(Ticket $ticket)
    {
        // Only admin or ticket creator can close the ticket
        if (auth()->user()->role !== 'admin' && auth()->id() !== $ticket->user_id) {
            abort(403, 'Unauthorized action.');
        }

        if ($ticket->status === 'closed') {
            return back()->with('error', 'Ce ticket est déjà fermé.');
        }

        $ticket->update(['status' => 'closed']);

        return back()->with('success', 'Ticket fermé avec succès.');
    }
}
