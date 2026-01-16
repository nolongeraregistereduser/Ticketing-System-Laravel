<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-slate-800">Create New Ticket</h1>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <h3 class="text-lg font-semibold text-slate-800">Submit a Support Request</h3>
                <p class="text-sm text-slate-500 mt-1">Fill out the form below and our team will get back to you</p>
            </div>
            
            <form method="POST" action="{{ route('tickets.store') }}" class="p-6 space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                    <input id="title" 
                           name="title" 
                           type="text" 
                           value="{{ old('title') }}"
                           class="block w-full px-4 py-3 rounded-xl border-2 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:ring-0 transition-colors"
                           placeholder="Brief description of your issue"
                           required 
                           autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
                    <select id="category_id" 
                            name="category_id" 
                            class="block w-full px-4 py-3 rounded-xl border-2 border-slate-200 text-slate-800 focus:outline-none focus:border-cyan-500 focus:ring-0 transition-colors"
                            required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                    <textarea id="description"
                              name="description"
                              rows="6"
                              class="block w-full px-4 py-3 rounded-xl border-2 border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:ring-0 transition-colors resize-none"
                              placeholder="Please provide as much detail as possible about your issue..."
                              required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl text-sm font-semibold hover:from-cyan-600 hover:to-blue-700 transition-all shadow-lg shadow-cyan-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Ticket
                    </button>
                    <a href="{{ route('tickets.index') }}" class="inline-flex items-center px-6 py-3 bg-slate-100 text-slate-700 rounded-xl text-sm font-semibold hover:bg-slate-200 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
