@extends('layouts.app', ['hideNav' => true])

@section('content')


<div class="w-full max-w-6xl">

    <!-- CARD PRINCIPAL -->
    <div class="bg-stone-900 text-stone-100 rounded-[2rem] shadow-2xl p-8">

        <h1 class="text-2xl font-semibold mb-8 flex items-center gap-3">
            <span class="bg-stone-800 rounded-full w-10 h-10 flex items-center justify-center">
                📡
            </span>
            Gestión de GPS
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LISTADO -->
            <div class="lg:col-span-2">

                <!-- BUSCADOR -->
                <input
                    id="searchInput"
                    type="text"
                    placeholder="Buscar GPS..."
                    class="mb-4 w-full bg-stone-800 text-stone-100 rounded-full px-4 py-3
                           placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-amber-500
                           transition" />

                <table id="gpsTable" class="w-full text-sm">
                    <thead class="text-stone-400 border-b border-stone-700">
                        <tr>
                            <th class="py-3 text-left">Placa</th>
                            <th class="py-3 text-left">Transporte</th>
                            <th class="py-3 text-left">Enlace</th>
                            <th class="py-3 text-left">Usuario</th>
                            <th class="py-3 text-left">Contraseña</th>
                            <th class="py-3 text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gps as $item)
                        <tr
                            class="border-b border-stone-800 hover:bg-stone-800/60 transition"
                            data-id="{{ $item->id }}"
                            data-transporte="{{ $item->transporte_id }}"
                            data-tipo="{{ $item->tipo_vehiculo }}"
                            data-placa="{{ $item->placa }}"
                            data-plataforma="{{ $item->plataforma }}"
                            data-usuario="{{ $item->usuario }}"
                            data-contrasena="{{ $item->contrasena }}"
                            data-destino="{{ $item->destino }}">
                            <td class="py-4">{{ $item->placa }}</td>
                            <td class="py-4">{{ $item->transporte->nombre }}</td>
                            <td class="py-4">
                                @if($item->plataforma)
                                <a href="{{ $item->plataforma }}"
                                    target="_blank"
                                    class="text-amber-400 hover:underline">
                                    Ir
                                </a>
                                @else
                                —
                                @endif
                            </td>
                            <td class="py-4">{{ $item->usuario ?? '—' }}</td>
                            <td class="py-4">{{ $item->contrasena ?? '—' }}</td>

                            <td class="py-4 text-right">
                                <button type="button"
                                    class="editar text-stone-400 hover:text-amber-400 transition">
                                    ✏️
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

            <!-- FORMULARIO -->
            <div class="sticky top-24">
                <div class="bg-black/40 rounded-2xl p-6 space-y-4">

                    <h2 class="text-lg font-semibold">
                        Registro / Edición
                    </h2>

                    <form method="POST" action="/gps" id="gpsForm" class="space-y-4">
                        <input type="hidden" name="gps_id" id="gps_id">
                        @csrf
                        <select name="tipo_vehiculo" id="tipo_vehiculo" class="w-full bg-stone-800 text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500">
                            <option>Camion</option>
                            <option>Cabezal</option>
                        </select>

                        <select name="transporte_id" id="transporte_id"
                            class="w-full rounded-xl px-4 py-3
                                    bg-stone-800 text-stone-100
                                    focus:ring-2 focus:ring-amber-500
                                    @error('transporte_id') border-2 border-red-500 @enderror">

                            <option value="">Selecciona transporte</option>

                            @foreach ($transportes as $transporte)
                            <option value="{{ $transporte->id }}"
                                {{ old('transporte_id') == $transporte->id ? 'selected' : '' }}>
                                {{ $transporte->nombre }}
                            </option>
                            @endforeach
                        </select>
                        @error('transporte_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror



                        <input type="text" placeholder="Placa" name="placa" id="placa"
                            class="w-full bg-stone-800 text-stone-100 rounded-xl px-4 py-3 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <input type="text" placeholder="Plataforma" name="plataforma" id="plataforma"
                            class="w-full bg-stone-800 text-stone-100 rounded-xl px-4 py-3 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <select name="destino" id="destino" class="w-full bg-stone-800 text-stone-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500">
                            <option>OPC</option>
                            <option>ACOPIO</option>
                        </select>

                        <input type="text" placeholder="Usuario" name="usuario" id="usuario"
                            class="w-full bg-stone-800 text-stone-100 rounded-xl px-4 py-3 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <input type="text" placeholder="Contraseña" name="contrasena" id="contrasena"
                            class="w-full bg-stone-800 text-stone-100 rounded-xl px-4 py-3 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <button
                            id="guardar"
                            class="w-full bg-white text-stone-900 rounded-full py-3 font-semibold
                                   hover:scale-[1.02] active:scale-95 transition-all duration-150">
                            Guardar GPS
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection