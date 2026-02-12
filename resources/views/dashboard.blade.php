@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-stone-950 pt-24 px-6">

    <div class="max-w-7xl mx-auto">

        <!-- CARD PRINCIPAL -->
        <div class="bg-stone-900 text-stone-100 rounded-[2rem] shadow-2xl p-10">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-12">
                <h1 class="text-3xl font-semibold flex items-center gap-4">
                    <span class="bg-orange-500 text-black w-12 h-12 rounded-full flex items-center justify-center text-xl">
                        📊
                    </span>
                    Dashboard GPS
                </h1>

                <span class="text-stone-400 text-sm">
                    Sistema de Gestión
                </span>
            </div>

            <!-- MÉTRICAS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-black rounded-2xl p-6 border border-stone-800 hover:border-orange-500 transition">
                    <p class="text-stone-400 text-sm">Total GPS</p>
                    <p class="text-4xl font-bold mt-3 text-orange-500">
                        {{ $totalGps ?? 12 }}
                    </p>
                </div>

                <div class="bg-black rounded-2xl p-6 border border-stone-800 hover:border-orange-500 transition">
                    <p class="text-stone-400 text-sm">GPS Activos</p>
                    <p class="text-4xl font-bold mt-3 text-white">
                        {{ $gpsActivos ?? 9 }}
                    </p>
                </div>

                <div class="bg-black rounded-2xl p-6 border border-stone-800 hover:border-orange-500 transition">
                    <p class="text-stone-400 text-sm">GPS Inactivos</p>
                    <p class="text-4xl font-bold mt-3 text-red-500">
                        {{ $gpsInactivos ?? 3 }}
                    </p>
                </div>

                <div class="bg-black rounded-2xl p-6 border border-stone-800 hover:border-orange-500 transition">
                    <p class="text-stone-400 text-sm">Transportes</p>
                    <p class="text-4xl font-bold mt-3 text-white">
                        {{ $totalTransportes ?? 5 }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection