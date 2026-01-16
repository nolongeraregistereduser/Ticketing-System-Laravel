<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TicketSys') }} - Administration</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .sidebar-gradient {
                background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            }
            .nav-item {
                transition: all 0.2s ease;
            }
            .nav-item:hover {
                background: rgba(99, 102, 241, 0.1);
                border-left-color: #6366f1;
            }
            .nav-item.active {
                background: rgba(99, 102, 241, 0.15);
                border-left-color: #6366f1;
            }
            .nav-item.active .nav-icon {
                color: #6366f1;
            }
            .stat-card {
                transition: all 0.3s ease;
            }
            .stat-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
            }
            .table-row:hover {
                background: #f8fafc;
            }
            .badge {
                font-size: 0.75rem;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-weight: 600;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="w-72 sidebar-gradient fixed h-full">
                <!-- Logo -->
                <div class="flex items-center px-6 h-20 border-b border-slate-700/50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-white">TicketSys</h1>
                            <p class="text-xs text-slate-400">Admin Panel</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-8 px-4">
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Menu</p>
                    
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="nav-icon w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        <span class="{{ request()->routeIs('admin.dashboard') ? 'text-white font-semibold' : 'text-slate-300' }}">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.tickets.index') }}" 
                       class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
                        <svg class="nav-icon w-5 h-5 mr-3 {{ request()->routeIs('admin.tickets.*') ? 'text-indigo-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <span class="{{ request()->routeIs('admin.tickets.*') ? 'text-white font-semibold' : 'text-slate-300' }}">Tickets</span>
                    </a>
                    
                    <a href="{{ route('admin.categories.index') }}" 
                       class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <svg class="nav-icon w-5 h-5 mr-3 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span class="{{ request()->routeIs('admin.categories.*') ? 'text-white font-semibold' : 'text-slate-300' }}">Categories</span>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" 
                       class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <svg class="nav-icon w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-indigo-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="{{ request()->routeIs('admin.users.*') ? 'text-white font-semibold' : 'text-slate-300' }}">Users</span>
                    </a>
                </nav>
                
                <!-- User Info at Bottom -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-700/50">
                    <div class="flex items-center justify-between bg-slate-800/50 rounded-xl p-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400">Administrator</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="p-2 text-slate-400 hover:text-white hover:bg-slate-700 rounded-lg transition-colors" title="Logout">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 ml-72">
                <!-- Top Header -->
                <header class="bg-white border-b border-slate-200 sticky top-0 z-10">
                    <div class="flex justify-between items-center px-8 py-5">
                        <div>
                            <h1 class="text-2xl font-bold text-slate-800">{{ $header ?? 'Dashboard' }}</h1>
                            <p class="text-sm text-slate-500 mt-1">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </header>

                <!-- Main Content Area -->
                <main class="p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
