<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Client\Request;

class TareaController extends Controller
{

    function index(){
        $tareasAltas = Tarea::where('idPrioridad', 1)->orderBy('fechaEstimadaFinalizacion','DESC')->get();
        $tareasMedias = Tarea::where('idPrioridad', 2)->orderBy('fechaEstimadaFinalizacion','DESC')->get();
        $tareasBajas = Tarea::where('idPrioridad', 3)->orderBy('fechaEstimadaFinalizacion','DESC')->get();
        $data = ['data' => [
            'altas'=>$tareasAltas,
            'medias'=>$tareasMedias,
            'bajas'=>$tareasBajas
        ]];
        return response()->json($data);
    }

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

    function update($id, Request $request) {
        $datos = $request->all();
        $tarea = tarea :: find($id);
        $tarea -> nombre = $datos ['nombre'];
        $tarea -> fecha = $datos ['fecha'];
        $tarea->save();
        $data = ['data' => $tarea];
        return response()->json($data);
    }

    function destroy($id) {
        $tarea= tarea :: find($id);
        if (empty ($tarea)) {
            $data = ['data' => 'No se encuentra registrada la tarea'];
            return response() -> json ($data, 404);
        }
        $tarea -> delete();
        $data = ['data' => 'Tarea eliminada'];
        return response() -> json($data); 
    }
}
