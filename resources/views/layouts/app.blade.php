<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TicketSys') }}</title>

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
                background: rgba(14, 165, 233, 0.1);
                border-left-color: #0ea5e9;
            }
            .nav-item.active {
                background: rgba(14, 165, 233, 0.15);
                border-left-color: #0ea5e9;
            }
            .nav-item.active .nav-icon {
                color: #0ea5e9;
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
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-white">TicketSys</h1>
                            <p class="text-xs text-slate-400">Support Portal</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-8 px-4">
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Menu</p>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="nav-icon w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-cyan-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        <span class="{{ request()->routeIs('dashboard') ? 'text-white font-semibold' : 'text-slate-300' }}">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('tickets.index') }}" 
                       class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent {{ request()->routeIs('tickets.*') ? 'active' : '' }}">
                        <svg class="nav-icon w-5 h-5 mr-3 {{ request()->routeIs('tickets.*') ? 'text-cyan-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <span class="{{ request()->routeIs('tickets.*') ? 'text-white font-semibold' : 'text-slate-300' }}">My Tickets</span>
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" 
                       class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <svg class="nav-icon w-5 h-5 mr-3 {{ request()->routeIs('profile.*') ? 'text-cyan-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="{{ request()->routeIs('profile.*') ? 'text-white font-semibold' : 'text-slate-300' }}">Profile</span>
                    </a>

                    @if(Auth::user()->role === 'admin')
                    <div class="mt-6 pt-6 border-t border-slate-700/50">
                        <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Admin</p>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-item flex items-center px-4 py-3 mb-2 rounded-xl border-l-4 border-transparent">
                            <svg class="nav-icon w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-slate-300">Admin Panel</span>
                        </a>
                    </div>
                    @endif
                </nav>
                
                <!-- User Info at Bottom -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-700/50">
                    <div class="flex items-center justify-between bg-slate-800/50 rounded-xl p-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->role }}</p>
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
                            @if (isset($header))
                                {{ $header }}
                            @endif
                            <p class="text-sm text-slate-500 mt-1">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('tickets.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl text-sm font-medium hover:from-cyan-600 hover:to-blue-700 transition-all shadow-lg shadow-cyan-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                New Ticket
                            </a>
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
