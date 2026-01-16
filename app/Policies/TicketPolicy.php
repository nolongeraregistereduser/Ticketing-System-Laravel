<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tickets.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view the tickets list
    }

    /**
     * Determine whether the user can view the ticket.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        // Admins can view all tickets
        if ($user->role === 'admin') {
            return true;
        }

        // Users can only view their own tickets
        return $user->id === $ticket->user_id;
    }

    /**
     * Determine whether the user can create tickets.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create tickets
    }

    /**
     * Determine whether the user can update the ticket.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        // Only admins can update tickets
        return $user->role === 'admin' && $ticket->status !== 'closed';
    }

    /**
     * Determine whether the user can assign the ticket.
     */
    public function assign(User $user, Ticket $ticket): bool
    {
        // Only admins can assign tickets
        return $user->role === 'admin';
    }


    public function delete(User $user, Ticket $ticket): bool
    {
        // Admin can delete any ticket
        if ($user->role === 'admin') {
            return true;
        }

        

        // 1. Not in 'in_progress'  &&
        // 2. own ticket 
        return $user->id === $ticket->user_id && 
               $ticket->status !== 'in_progress';
    }
}
