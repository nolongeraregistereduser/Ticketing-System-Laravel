<x-admin-layout>
    <x-slot name="header">
        All Tickets
    </x-slot>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border-b p-2">ID</th>
                <th class="border-b p-2">Title</th>
                <th class="border-b p-2">Status</th>
                <th class="border-b p-2">Assigned To</th>
                <th class="border-b p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td class="border-b p-2">{{ $ticket->id }}</td>
                    <td class="border-b p-2">{{ $ticket->title }}</td>
                    <td class="border-b p-2">{{ $ticket->status }}</td>
                    <td class="border-b p-2">{{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</td>
                    <td class="border-b p-2">
                        <a href="{{ route('admin.tickets.assign', $ticket) }}" class="text-blue-500">Assign</a>
                        <a href="{{ route('admin.tickets.edit', $ticket) }}" class="text-green-500 hover:text-green-700 ml-2">Change Status</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
</x-admin-layout>
