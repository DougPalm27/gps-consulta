<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GPS Plataforma</title>
    @vite(['resources/js/app.js'])
</head>

<body
    class="relative min-h-screen
           bg-gradient-to-br from-green-800 via-emerald-700 to-green-600">

    <!-- GRID TEXTURE -->
    <div
        class="absolute inset-0 pointer-events-none
               bg-[linear-gradient(to_right,rgba(255,255,255,0.08)_1px,transparent_1px),
                   linear-gradient(to_bottom,rgba(255,255,255,0.08)_1px,transparent_1px)]
               bg-[size:48px_48px]">
    </div>

    <div class="relative z-10">

        {{-- TOP NAV (solo si NO estamos en modo foco) --}}
        @if (!isset($hideNav) || !$hideNav)
        <header class="py-4 bg-black/90 backdrop-blur-md shadow-lg shadow-black/20">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">

                <div class="flex items-center gap-3 text-white font-semibold text-lg">
                    <div class="bg-white/10 text-white rounded-full w-8 h-8 flex items-center justify-center">
                        🚚
                    </div>
                    GPS Plataforma
                </div>

                <nav class="flex gap-8 text-sm font-medium">
                    <a href="/dashboard"
                       class="text-stone-300 hover:text-white transition">
                        Dashboard
                    </a>
                    <a href="/gps"
                       class="text-stone-300 hover:text-white transition">
                        GPS
                    </a>
                </nav>

            </div>
        </header>
        @endif

        {{-- MAIN --}}
        <main
            class="
                {{ isset($hideNav) && $hideNav
                    ? 'min-h-screen flex items-center justify-center px-6'
                    : 'pb-20'
                }}
            "
        >
            @yield('content')
        </main>

    </div>

</body>
</html>
