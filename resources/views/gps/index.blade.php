@extends('layouts.app')

@section('content')

<div class="w-full px-8">

    <!-- CARD PRINCIPAL -->
    <div class="bg-stone-900 text-stone-100 rounded-[2rem] shadow-2xl p-10">

        <h1 class="text-3xl font-semibold mb-10 flex items-center gap-4">
            <span class="bg-stone-800 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                📡
            </span>
            Gestión de GPS
        </h1>
        <div class="flex gap-6 mb-8">

            <select id="filtroEstado"
                class="mb-4 bg-stone-800 text-stone-100 rounded-xl px-4 py-2">
                <option value="todos">Todos</option>
                <option value="activo">Activos</option>
                <option value="inactivo">Inactivos</option>
            </select>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

            <!-- ========================
                 LISTADO
            ========================= -->
            <div class="lg:col-span-3">
                <!-- BUSCADOR -->
                <input
                    id="searchInput"
                    type="text"
                    placeholder="Buscar GPS..."
                    class="mb-6 w-full bg-stone-800 text-stone-100 rounded-full px-6 py-4
                           placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-amber-500
                           transition" />

                <!-- TABLA CON SCROLL INTERNO -->
                <div class="max-h-[75vh] overflow-y-auto rounded-2xl border border-stone-800 shadow-inner">

                    <table id="gpsTable" class="w-full text-sm">

                        <thead class="text-stone-400 bg-stone-900 sticky top-0 z-10 border-b border-stone-700">
                            <tr>
                                <th class="py-4 text-left px-6">Placa</th>
                                <th class="py-4 text-left px-6">Transporte</th>
                                <th class="py-4 text-left px-6">Enlace</th>
                                <th class="py-4 text-left px-6">Usuario</th>
                                <th class="py-4 text-left px-6">Contraseña</th>
                                <th class="py-4 text-left px-6">Estado</th>
                                <th class="py-4 text-right px-6">Acción</th>

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
                                <td class="py-4 px-6">{{ $item->placa }}</td>
                                <td class="py-4 px-6">{{ $item->transporte->nombre }}</td>
                                <td class="py-4 px-6">
                                    <a href="{{ $item->plataforma }}" target="_blank"
                                        class="text-amber-400 hover:underline">
                                        Ir
                                    </a>
                                </td>
                                <td class="py-4 px-6">{{ $item->usuario }}</td>
                                <td class="py-4 px-6">{{ $item->contrasena }}</td>
                                <td class="py-4 px-6">
                                    <button
                                        class="toggleEstado relative inline-flex items-center h-6 rounded-full w-11 transition-colors duration-300 
                    {{ $item->estado ? 'bg-green-500' : 'bg-stone-600' }}"
                                        data-id="{{ $item->id }}"
                                        data-estado="{{ $item->estado ? 1 : 0 }}">
                                        <span
                                            class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform duration-300
            {{ $item->estado ? 'translate-x-6' : 'translate-x-1' }}">
                                        </span>
                                    </button>
                                </td>



                                <td class="py-4 px-6 text-right">
                                    <button type="button"
                                        class="editar text-stone-400 hover:text-amber-400 transition text-lg">
                                        ✏️
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>

            <!-- ========================
                 FORMULARIO
            ========================= -->
            <div class="sticky top-24 h-fit">

                <div class="bg-black/40 rounded-2xl p-8 space-y-6 shadow-lg">

                    <h2 class="text-xl font-semibold">
                        Registro / Edición
                    </h2>

                    <button type="button"
                        id="btnNuevo"
                        class="w-full bg-amber-500 text-black rounded-full py-3 font-semibold
                               hover:scale-[1.02] active:scale-95 transition-all duration-150">
                        + Nuevo GPS
                    </button>

                    <form method="POST" action="/gps" id="gpsForm" class="space-y-4">
                        @csrf
                        <input type="hidden" name="gps_id" id="gps_id">

                        <select name="tipo_vehiculo" id="tipo_vehiculo"
                            class="w-full rounded-xl px-4 py-3 bg-stone-800 text-stone-100 focus:ring-2 focus:ring-amber-500">
                            <option value="">Selecciona tipo</option>
                            <option value="Camion">Camion</option>
                            <option value="Cabezal">Cabezal</option>
                        </select>

                        <select name="transporte_id" id="transporte_id"
                            class="w-full rounded-xl px-4 py-3 bg-stone-800 text-stone-100 focus:ring-2 focus:ring-amber-500">
                            <option value="">Selecciona transporte</option>
                            @foreach ($transportes as $transporte)
                            <option value="{{ $transporte->id }}">
                                {{ $transporte->nombre }}
                            </option>
                            @endforeach
                        </select>

                        <input type="text" name="placa" id="placa" placeholder="Placa"
                            class="w-full rounded-xl px-4 py-3 bg-stone-800 text-stone-100 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <input type="text" name="plataforma" id="plataforma" placeholder="Plataforma"
                            class="w-full rounded-xl px-4 py-3 bg-stone-800 text-stone-100 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <select name="destino" id="destino"
                            class="w-full rounded-xl px-4 py-3 bg-stone-800 text-stone-100 focus:ring-2 focus:ring-amber-500">
                            <option value="">Selecciona destino</option>
                            <option value="OPC">OPC</option>
                            <option value="ACOPIO">ACOPIO</option>
                        </select>

                        <input type="text" name="usuario" id="usuario" placeholder="Usuario"
                            class="w-full rounded-xl px-4 py-3 bg-stone-800 text-stone-100 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <input type="text" name="contrasena" id="contrasena" placeholder="Contraseña"
                            class="w-full rounded-xl px-4 py-3 bg-stone-800 text-stone-100 placeholder-stone-500 focus:ring-2 focus:ring-amber-500">

                        <button
                            type="submit"
                            class="w-full bg-white text-stone-900 rounded-full py-4 font-semibold
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