<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Estado;
use Illuminate\Http\Request;

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

    function filter(Request $request){
        $datos = $request -> all();
        $tareas = new Tarea;
        if (!empty($datos['fechaInicio']) && !empty($datos['fechaFin'])) {
            $tareas->whereBetween('fechaEstimadaFinalizacion', [$datos['fechaInicio'], $datos['fechaFin']]);
        }
        if (!empty($datos['prioridad'])) {
            $tareas->where('idPrioridad', $datos['prioridad']);
        }
        if (!empty($datos['nombre'])) {
            $tareas->where('idEmpleado', $datos['nombre']);
        }
        if (!empty($datos['titulo'])) {
            $tareas->where('titulo', 'like', '%' . $datos['titulo'] . '%');
        }
        $data = $tareas->get();
        return response()->json($data);
    }

    function estado($id, Request $request) {
        $datos = $request->all();
        $estado = Estado::find($id);
        $estado->id= $datos['idEstado'];
        $estado -> save();
        $data = ['data' => $estado];
        return response() -> json($data);
    }

    function reasignar ($id, Request $request) {
        $datos = $request->all();
        $tarea = Tarea::find($id);
        if ($tarea) {
            $tarea->idEmpleado= $datos['idEmpleado'];
            $tarea -> save();
            $data = ['data' => $tarea];
            return response() -> json($data);
        } else {
            return response() -> json(['error' => 'Tarea no encontrada'], 404);
        }
    }


    function store(Request $request)
    {
        $datos = $request->all();
        $tarea = new Tarea();
        $tarea->titulo = $datos['titulo'];
        $tarea->descripcion =$datos['descripcion'];
        $tarea->fechaEstimadaFinalizacion =$datos['fechaEstimadaFinalizacion'];
        $tarea->fechaFinalizacion =$datos['fechaFinalizacion'];
        $tarea->creadorTarea =$datos['creadorTarea'];
        $tarea->observaciones =$datos['observaciones'];
        $tarea->idEmpleado =$datos['idEmpleado'];
        $tarea->idEstado= $datos['idEstado'];
        $tarea->idPrioridad=$datos['idPrioridad'];
        $tarea->created_at=$datos['created_at'];
        $tarea->updated_at=$datos['updated_at'];
        $tarea->save();
        $data = ['data' => $tarea];
        return response()->json($data);
    }

    function update($id, Request $request) {
        $datos = $request->all();
        $tarea = Tarea :: find($id);
        if (!$tarea){
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }
        $tarea -> titulo = $datos ['titulo'];
        $tarea -> fechaEstimadaFinalizacion = $datos ['fechaEstimadaFinalizacion'];
        $tarea->fechaFinalizacion =$datos['fechaFinalizacion'];
        $tarea -> creadorTarea = $datos ['creadorTarea'];
        $tarea -> observaciones = $datos ['observaciones'];
        $tarea->save();
        $data = ['data' => $tarea];
        return response()->json($data);
    }

    function destroy($id) {
        $tarea= Tarea :: find($id);
        if (empty ($tarea)) {
            $data = ['data' => 'No se encuentra registrada la tarea'];
            return response() -> json ($data, 404);
        }
        $tarea -> delete();
        $data = ['data' => 'Tarea eliminada'];
        return response() -> json($data); 
    }
}
