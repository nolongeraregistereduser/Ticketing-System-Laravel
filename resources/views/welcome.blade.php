<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TicketSys - Modern Support Ticketing System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .hero-gradient {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            }
            .glow {
                box-shadow: 0 0 60px rgba(6, 182, 212, 0.3);
            }
            .feature-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            }
            .float-animation {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(60px);
                opacity: 0.4;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/80 backdrop-blur-lg border-b border-slate-700/50">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">TicketSys</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl text-sm font-semibold hover:from-cyan-600 hover:to-blue-700 transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2.5 text-slate-300 hover:text-white text-sm font-medium transition-colors">
                                Sign In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl text-sm font-semibold hover:from-cyan-600 hover:to-blue-700 transition-all">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
            <!-- Background Elements -->
            <div class="blob w-96 h-96 bg-cyan-500 top-20 -left-48"></div>
            <div class="blob w-80 h-80 bg-blue-600 bottom-20 right-0"></div>
            <div class="blob w-64 h-64 bg-purple-500 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="max-w-7xl mx-auto px-6 py-32 relative z-10">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-flex items-center px-4 py-2 bg-cyan-500/10 rounded-full mb-6">
                            <span class="w-2 h-2 rounded-full bg-cyan-400 mr-2 animate-pulse"></span>
                            <span class="text-cyan-400 text-sm font-medium">Modern Support System</span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                            Streamline Your
                            <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
                                Customer Support
                            </span>
                        </h1>
                        <p class="text-xl text-slate-400 mb-8 leading-relaxed">
                            A powerful ticketing system built with Laravel. Manage support requests, assign agents, and resolve issues faster than ever before.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-2xl text-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition-all shadow-lg shadow-cyan-500/30">
                                    Go to Dashboard
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-2xl text-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition-all shadow-lg shadow-cyan-500/30">
                                    Get Started Free
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-slate-800 text-white rounded-2xl text-lg font-semibold hover:bg-slate-700 transition-all border border-slate-700">
                                    Sign In
                                </a>
                            @endauth
                        </div>
                        
                        <!-- Stats -->
                        <div class="flex gap-8 mt-12 pt-8 border-t border-slate-700/50">
                            <div>
                                <p class="text-3xl font-bold text-white">3</p>
                                <p class="text-slate-400 text-sm">User Roles</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-white">5</p>
                                <p class="text-slate-400 text-sm">Categories</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-white">∞</p>
                                <p class="text-slate-400 text-sm">Tickets</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dashboard Preview -->
                    <div class="hidden lg:block float-animation">
                        <div class="bg-slate-800/50 backdrop-blur-lg rounded-3xl p-6 border border-slate-700/50 glow">
                            <div class="flex items-center mb-6">
                                <div class="flex space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="bg-slate-700/50 rounded-xl p-4">
                                    <p class="text-slate-400 text-xs">Open Tickets</p>
                                    <p class="text-2xl font-bold text-white">12</p>
                                </div>
                                <div class="bg-slate-700/50 rounded-xl p-4">
                                    <p class="text-slate-400 text-xs">In Progress</p>
                                    <p class="text-2xl font-bold text-cyan-400">8</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="bg-slate-700/50 rounded-xl p-3 flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-400 to-blue-500 mr-3"></div>
                                    <div class="flex-1">
                                        <p class="text-white text-sm font-medium">New ticket assigned</p>
                                        <p class="text-slate-400 text-xs">2 minutes ago</p>
                                    </div>
                                </div>
                                <div class="bg-slate-700/50 rounded-xl p-3 flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-500 mr-3"></div>
                                    <div class="flex-1">
                                        <p class="text-white text-sm font-medium">Ticket #45 resolved</p>
                                        <p class="text-slate-400 text-xs">15 minutes ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-800 mb-4">Powerful Features</h2>
                    <p class="text-xl text-slate-500 max-w-2xl mx-auto">Everything you need to manage customer support efficiently</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="feature-card bg-slate-50 rounded-3xl p-8 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center mb-6 shadow-lg shadow-cyan-200">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Ticket Management</h3>
                        <p class="text-slate-500 leading-relaxed">Create, track, and manage support tickets with a clean, intuitive interface. Full lifecycle tracking from open to resolved.</p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="feature-card bg-slate-50 rounded-3xl p-8 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center mb-6 shadow-lg shadow-purple-200">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Role-Based Access</h3>
                        <p class="text-slate-500 leading-relaxed">Three distinct roles: Users create tickets, Agents process them, and Admins manage everything with full control.</p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="feature-card bg-slate-50 rounded-3xl p-8 transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center mb-6 shadow-lg shadow-emerald-200">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Category System</h3>
                        <p class="text-slate-500 leading-relaxed">Organize tickets with customizable categories. Technical Support, Billing, Account Issues, and more.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tech Stack Section -->
        <section class="py-24 bg-slate-900">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4">Built With Modern Tech</h2>
                    <p class="text-xl text-slate-400">Powered by the best tools in web development</p>
                </div>
                
                <div class="flex flex-wrap justify-center gap-8">
                    <div class="flex items-center space-x-3 bg-slate-800/50 rounded-2xl px-6 py-4">
                        <div class="w-10 h-10 rounded-lg bg-red-500/10 flex items-center justify-center">
                            <span class="text-red-500 font-bold text-lg">L</span>
                        </div>
                        <span class="text-white font-semibold">Laravel 10</span>
                    </div>
                    <div class="flex items-center space-x-3 bg-slate-800/50 rounded-2xl px-6 py-4">
                        <div class="w-10 h-10 rounded-lg bg-cyan-500/10 flex items-center justify-center">
                            <span class="text-cyan-500 font-bold text-lg">T</span>
                        </div>
                        <span class="text-white font-semibold">Tailwind CSS</span>
                    </div>
                    <div class="flex items-center space-x-3 bg-slate-800/50 rounded-2xl px-6 py-4">
                        <div class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center">
                            <span class="text-purple-500 font-bold text-lg">V</span>
                        </div>
                        <span class="text-white font-semibold">Vite</span>
                    </div>
                    <div class="flex items-center space-x-3 bg-slate-800/50 rounded-2xl px-6 py-4">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center">
                            <span class="text-blue-500 font-bold text-lg">M</span>
                        </div>
                        <span class="text-white font-semibold">MySQL</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-gradient-to-r from-cyan-500 to-blue-600">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">Ready to Get Started?</h2>
                <p class="text-xl text-cyan-100 mb-8">Join now and experience seamless support ticket management</p>
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white text-cyan-600 rounded-2xl text-lg font-semibold hover:bg-cyan-50 transition-all shadow-lg">
                        Go to Dashboard
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-cyan-600 rounded-2xl text-lg font-semibold hover:bg-cyan-50 transition-all shadow-lg">
                        Create Free Account
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                @endauth
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 py-12 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center space-x-3 mb-4 md:mb-0">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-white">TicketSys</span>
                    </div>
                    <p class="text-slate-400 text-sm">
                        &copy; {{ date('Y') }} TicketSys. Built with Laravel & Tailwind CSS.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
