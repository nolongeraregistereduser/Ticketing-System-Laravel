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
            body {
                font-family: 'Instrument Sans', sans-serif;
            }
            .gradient-bg {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
                position: relative;
                overflow: hidden;
            }
            .gradient-bg::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 50%);
                animation: pulse 15s ease-in-out infinite;
            }
            .gradient-bg::after {
                content: '';
                position: absolute;
                bottom: -50%;
                right: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(14, 165, 233, 0.08) 0%, transparent 50%);
                animation: pulse 20s ease-in-out infinite reverse;
            }
            @keyframes pulse {
                0%, 100% { transform: translate(0, 0) scale(1); }
                50% { transform: translate(30px, -30px) scale(1.1); }
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 
                            0 0 0 1px rgba(255, 255, 255, 0.1);
            }
            .logo-icon {
                background: linear-gradient(135deg, #6366f1 0%, #0ea5e9 100%);
                box-shadow: 0 10px 40px -10px rgba(99, 102, 241, 0.5);
            }
            .btn-primary {
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px -3px rgba(99, 102, 241, 0.5);
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px -5px rgba(99, 102, 241, 0.6);
            }
            .input-field {
                transition: all 0.3s ease;
                border: 2px solid #e2e8f0;
            }
            .input-field:focus {
                border-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            }
            .floating-shapes {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 0;
            }
            .shape {
                position: absolute;
                border-radius: 50%;
                opacity: 0.1;
            }
            .shape-1 {
                width: 300px;
                height: 300px;
                background: #6366f1;
                top: 10%;
                left: 10%;
                animation: float 20s ease-in-out infinite;
            }
            .shape-2 {
                width: 200px;
                height: 200px;
                background: #0ea5e9;
                bottom: 20%;
                right: 15%;
                animation: float 15s ease-in-out infinite reverse;
            }
            .shape-3 {
                width: 150px;
                height: 150px;
                background: #8b5cf6;
                top: 60%;
                left: 5%;
                animation: float 18s ease-in-out infinite 2s;
            }
            @keyframes float {
                0%, 100% { transform: translate(0, 0) rotate(0deg); }
                33% { transform: translate(30px, -30px) rotate(120deg); }
                66% { transform: translate(-20px, 20px) rotate(240deg); }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 gradient-bg">
            <!-- Floating Shapes -->
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
            
            <!-- Logo -->
            <div class="relative z-10 mb-8">
                <a href="/" class="flex items-center space-x-3">
                    <div class="logo-icon w-14 h-14 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white">TicketSys</span>
                </a>
            </div>

            <!-- Card -->
            <div class="relative z-10 w-full sm:max-w-md px-8 py-10 glass-card rounded-3xl mx-4">
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <p class="relative z-10 mt-8 text-sm text-slate-400">
                &copy; {{ date('Y') }} TicketSys. All rights reserved.
            </p>
        </div>
    </body>
</html>
