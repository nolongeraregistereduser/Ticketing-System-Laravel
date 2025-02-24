<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agent Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome Agent!
                    <br><br>
                    Tickets Assigned to You:
                    <br><br>
                    @if(count($tickets) > 0)
                        <table class="table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Ticket ID</th>
                                    <th class="px-4 py-2">Title</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $ticket->id }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->title }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->status }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('agent.tickets.edit', $ticket->id) }}" class="text-blue-500">Edit Status</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No tickets assigned to you.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
