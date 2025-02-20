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
        // Admins and agents can view all tickets
        if ($user->isAdmin() || $user->isAgent()) {
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
        // Admins can update any ticket
        if ($user->isAdmin()) {
            return true;
        }

        // Assigned agents can update their tickets
        if ($user->isAgent() && $ticket->assigned_to === $user->id) {
            return true;
        }

        // Users can update their own tickets if they're not closed
        return $user->id === $ticket->user_id && $ticket->status !== 'closed';
    }

    /**
     * Determine whether the user can assign the ticket.
     */
    public function assign(User $user, Ticket $ticket): bool
    {
        // Only admins can assign tickets
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the ticket.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        // Only admins can delete tickets
        return $user->isAdmin();
    }
}
