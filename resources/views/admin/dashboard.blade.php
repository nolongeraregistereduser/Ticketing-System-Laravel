<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Bienvenue dans l'espace administrateur</h3>
                    
                    <!-- Ajoutez ici le contenu spécifique à l'administrateur -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium mb-2">Gestion des utilisateurs</h4>
                            <!-- Ajoutez vos liens ou contenu ici -->
                        </div>
                        
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium mb-2">Statistiques</h4>
                            <!-- Ajoutez vos statistiques ici -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 