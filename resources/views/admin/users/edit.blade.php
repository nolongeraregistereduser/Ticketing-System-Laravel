<x-admin-layout>
    <x-slot name="header">
        Modifier un Utilisateur
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name">Nom</label>
                    <input type="text" name="name" value="{{ $user->name }}" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required>
                </div>
                <div>
                    <label for="role">Rôle</label>
                    <select name="role" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>Agent</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div>
                    <button type="submit">Mettre à jour l'Utilisateur</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
