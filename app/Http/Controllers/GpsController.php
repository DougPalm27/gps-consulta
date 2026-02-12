<?php

namespace App\Http\Controllers;

use App\Models\Gps;
use App\Models\Transporte;
use Illuminate\Http\Request;

class GpsController extends Controller
{
    // 👉 ESTE ES EL INDEX
    public function index()
    {
        $transportes = Transporte::orderBy('nombre')->get();
        $gps = Gps::with('transporte')->get();

        return view('gps.index', compact('transportes', 'gps'));
    }

    public function store(Request $request)
    {
        if ($request->gps_id) {
            $gps = Gps::findOrFail($request->gps_id);
            $gps->update($request->only([
                'transporte_id',
                'tipo_vehiculo',
                'placa',
                'plataforma',
                'destino',
                'usuario',
                'contrasena',
            ]));
        } else {
            Gps::create($request->only([
                'transporte_id',
                'tipo_vehiculo',
                'placa',
                'plataforma',
                'destino',
                'usuario',
                'contrasena',
            ]));
        }

        return redirect()->back();
    }
}
