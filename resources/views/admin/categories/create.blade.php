<x-admin-layout>
    <x-slot name="header">
        Ajouter une Catégorie
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Nom de la catégorie
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                           required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 dark:bg-indigo-500 text-black rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600">
                        Ajouter la catégorie
                    </button>
                    
                    <a href="{{ route('admin.categories.index') }}" 
                       class="px-4 py-2 bg-gray-600 dark:bg-gray-500 text-black rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout> 