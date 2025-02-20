<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTicketController extends Controller
{
    /**
     * Display a listing of all tickets for admin.
     */
    public function index()
    {
        $tickets = Ticket::with(['creator', 'agent', 'category'])->latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for assigning a ticket to an agent.
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $agents = User::where('role', 'agent')->get();
        return view('admin.tickets.assign', compact('ticket', 'agents'));
    }

    /**
     * Update the ticket's assigned agent.
     */
    public function updateAssignment(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'agent_id' => 'required|exists:users,id'
        ]);

        $ticket->update(['assigned_to' => $validated['agent_id']]);
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket assigned successfully.');
    }

    /**
     * Update the status of a ticket.
     */
    /**
     * Show the form for editing the ticket status
     */
    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    /**
     * Update the status of a ticket
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed'
        ]);

        $ticket->update(['status' => $validated['status']]);
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket status updated successfully.');
    }
}
