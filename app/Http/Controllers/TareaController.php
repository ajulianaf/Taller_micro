<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Client\Request;

class TareaController extends Controller
{
    function store(Request $request)
    {
        $datos = $request->all();
        $tarea = new tarea();
        $tarea->nombre = $datos['nombre'];
        $datos['fecha'];
        $tarea->save();
        $data = ['data' => $tarea];
        return response()->json($data);
    }
}
