<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    @php
        $totalUsers = \App\Models\User::count();
        $totalCategories = \App\Models\Categories::count();
        $totalTickets = \App\Models\Ticket::count();
        $openTickets = \App\Models\Ticket::where('status', 'open')->count();
        $inProgressTickets = \App\Models\Ticket::where('status', 'in_progress')->count();
        $closedTickets = \App\Models\Ticket::where('status', 'closed')->count();
        $recentTickets = \App\Models\Ticket::with(['user', 'category', 'agent'])->latest()->take(5)->get();
        $agents = \App\Models\User::where('role', 'agent')->count();
    @endphp

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Tickets -->
        <div class="stat-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Tickets</p>
                    <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalTickets }}</p>
                    <div class="flex items-center mt-2 text-sm">
                        <span class="text-emerald-500 font-medium">{{ $openTickets }} open</span>
                        <span class="text-slate-300 mx-2">•</span>
                        <span class="text-amber-500 font-medium">{{ $inProgressTickets }} in progress</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Open Tickets -->
        <div class="stat-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Open Tickets</p>
                    <p class="text-3xl font-bold text-slate-800 mt-2">{{ $openTickets }}</p>
                    <p class="text-sm text-slate-400 mt-2">Awaiting assignment</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="stat-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Users</p>
                    <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalUsers }}</p>
                    <p class="text-sm text-slate-400 mt-2">{{ $agents }} agents available</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="stat-card bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Categories</p>
                    <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalCategories }}</p>
                    <p class="text-sm text-slate-400 mt-2">{{ $closedTickets }} resolved tickets</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center shadow-lg shadow-pink-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tickets Table -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Recent Tickets</h3>
                <p class="text-sm text-slate-500 mt-1">Latest support requests from users</p>
            </div>
            <a href="{{ route('admin.tickets.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                View all →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Ticket</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Agent</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentTickets as $ticket)
                    <tr class="table-row transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-xs font-medium text-slate-400 mr-2">#{{ $ticket->id }}</span>
                                <span class="font-medium text-slate-700">{{ Str::limit($ticket->title, 30) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-400 to-slate-500 flex items-center justify-center text-white text-xs font-medium">
                                    {{ substr($ticket->user->name, 0, 2) }}
                                </div>
                                <span class="ml-3 text-sm text-slate-600">{{ $ticket->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-xs font-medium text-slate-600">
                                {{ $ticket->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->status === 'open')
                                <span class="badge bg-amber-100 text-amber-700">Open</span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="badge bg-blue-100 text-blue-700">In Progress</span>
                            @else
                                <span class="badge bg-emerald-100 text-emerald-700">Closed</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->agent)
                                <span class="text-sm text-slate-600">{{ $ticket->agent->name }}</span>
                            @else
                                <span class="text-sm text-slate-400 italic">Unassigned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ $ticket->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            No tickets found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout> 