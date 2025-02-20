<x-admin-layout>
    <x-slot name="header">
        Assign Ticket: {{ $ticket->title }}
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <form action="{{ route('admin.tickets.updateAssignment', $ticket) }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-4">
                    <label for="agent_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Assign to Agent</label>
                    <select name="agent_id" id="agent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select an agent</option>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $ticket->assigned_to == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Assign Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
