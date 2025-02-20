<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ticket #') . $ticket->id }}
            </h2>
            <div class="flex space-x-4">
                @if($ticket->status !== 'closed' && auth()->user()->role === 'admin')
                    <a href="{{ route('tickets.edit', $ticket) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Modifier') }}
                    </a>
                @endif
                @if($ticket->status === 'open' && (auth()->user()->role === 'admin' || auth()->id() === $ticket->user_id))
                    <form action="{{ route('tickets.close', $ticket) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Fermer le Ticket') }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Ticket Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium">{{ __('Informations du Ticket') }}</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <span class="font-semibold">{{ __('Titre:') }}</span>
                                    <p class="mt-1">{{ $ticket->title }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold">{{ __('Catégorie:') }}</span>
                                    <p class="mt-1">{{ $ticket->category->name }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold">{{ __('Description:') }}</span>
                                    <p class="mt-1 whitespace-pre-line">{{ $ticket->description }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium">{{ __('Statut et Attribution') }}</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <span class="font-semibold">{{ __('Statut:') }}</span>
                                    <p class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($ticket->status === 'open') bg-yellow-100 text-yellow-800
                                            @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ __($ticket->status) }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <span class="font-semibold">{{ __('Créé par:') }}</span>
                                    <p class="mt-1">{{ $ticket->creator->name }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold">{{ __('Agent Assigné:') }}</span>
                                    <p class="mt-1">{{ $ticket->agent ? $ticket->agent->name : __('Non assigné') }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold">{{ __('Créé le:') }}</span>
                                    <p class="mt-1">{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold">{{ __('Dernière mise à jour:') }}</span>
                                    <p class="mt-1">{{ $ticket->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->role === 'admin' && $ticket->status !== 'closed')
                        <!-- Assign Ticket Form -->
                        <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium">{{ __('Assigner le Ticket') }}</h3>
                            <form action="{{ route('tickets.assign', $ticket) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <select name="agent_id" class="rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <option value="">{{ __('Sélectionner un agent') }}</option>
                                        @foreach(\App\Models\User::where('role', 'admin')->get() as $admin)
                                            <option value="{{ $admin->id }}" {{ $ticket->assigned_to == $admin->id ? 'selected' : '' }}>
                                                {{ $admin->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-primary-button>{{ __('Assigner') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
