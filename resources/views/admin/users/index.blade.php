<x-admin-layout>
    <x-slot name="header">
        User Management
    </x-slot>

    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center">
            <svg class="w-5 h-5 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-emerald-700 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border border-slate-100">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                    <p class="text-xs text-slate-500">Administrators</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-100">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\User::where('role', 'agent')->count() }}</p>
                    <p class="text-xs text-slate-500">Support Agents</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-100">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ \App\Models\User::where('role', 'user')->count() }}</p>
                    <p class="text-xs text-slate-500">Regular Users</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-lg font-semibold text-slate-800">All Users</h3>
            <p class="text-sm text-slate-500 mt-1">Manage user accounts and roles</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($users as $user)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-semibold mr-3
                                    @if($user->role === 'admin') bg-gradient-to-br from-indigo-500 to-purple-600
                                    @elseif($user->role === 'agent') bg-gradient-to-br from-emerald-400 to-teal-500
                                    @else bg-gradient-to-br from-slate-400 to-slate-500
                                    @endif">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">ID: {{ $user->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-600">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="role" onchange="this.form.submit()" 
                                    class="text-sm rounded-lg border-slate-200 py-1.5 px-3 focus:ring-indigo-500 focus:border-indigo-500
                                    @if($user->role === 'admin') bg-indigo-50 text-indigo-700
                                    @elseif($user->role === 'agent') bg-emerald-50 text-emerald-700
                                    @else bg-slate-50 text-slate-700
                                    @endif">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>Agent</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-500">{{ $user->created_at->format('M d, Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if(Auth::id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                            @else
                                <span class="text-xs text-slate-400 italic">Current user</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
