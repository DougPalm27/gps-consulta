<?php

namespace App\Http\Controllers;

use App\Models\Gps;
use App\Models\Transporte;
use Illuminate\Http\Request;

class GpsController extends Controller
{
    // LISTADO
    public function index()
    {
        $transportes = Transporte::orderBy('nombre')->get();
        $gps = Gps::with('transporte')->latest()->get();

        $activos = Gps::where('estado', 1)->count();
        $inactivos = Gps::where('estado', 0)->count();

        return view('gps.index', compact('transportes', 'gps', 'activos', 'inactivos'));
    }

    // CREAR / ACTUALIZAR
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_vehiculo' => 'required|string|max:50',
            'transporte_id' => 'required|exists:transportes,id',
            'placa' => 'required|string|max:20|unique:gps,placa,' . $request->gps_id,
            'plataforma' => 'required|string|max:255',
            'destino' => 'required|string|max:150',
            'usuario' => 'required|string|max:100',
            'contrasena' => 'required|string|max:150',

        ]);

        if ($request->gps_id) {

            $gps = Gps::findOrFail($request->gps_id);
            $gps->update($validated);
        } else {
            $validated['estado'] = 1;
            $gps = Gps::create($validated);
        }

        return response()->json([
            'success' => true,
            'gps' => $gps->load('transporte')
        ]);
    }

    public function toggleEstado(Gps $gps)
    {
        $gps->estado = !$gps->estado;
        $gps->save();

        return response()->json([
            'success' => true,
            'estado' => $gps->estado,
            'id' => $gps->id
        ]);
    }
}
