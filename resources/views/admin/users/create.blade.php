<x-admin-layout>
    <x-slot name="header">
        Ajouter un Utilisateur
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div>
                    <label for="name">Nom</label>
                    <input type="text" name="name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="role">Rôle</label>
                    <select name="role" required>
                        <option value="admin">Admin</option>
                        <option value="agent">Agent</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div>
                    <button type="submit">Créer Utilisateur</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
