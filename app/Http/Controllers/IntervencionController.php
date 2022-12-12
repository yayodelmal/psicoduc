<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervencion;

class IntervencionController extends Controller
{
    public function index(Request $request){

        $unidad = array();

        $lista = Intervencion::orderbydesc('id_intervencion')->paginate(10);
        $resultado = json_decode(json_encode($lista), true);
        
            foreach($resultado["data"] as $item){
                $listadeunidades = $this->obtenerUnidadesId($item["curso_id"]);
                $unidad[$item["curso_id"]] = [$listadeunidades->fullname];
            }
        
        return view('intervenciones.intervenciones',['listaDeIntervenciones' => $lista], ['listaDeUnidades' => $unidad]);
    }

    public function finalizarIntervencion(Request $request, $id){

        try{
            
            $finalizar = Intervencion::find($id);
            $finalizar->estado = 0;
            $finalizar->save();

            return back()->with('status', 'Intervención finalizada correctamente.');
        }catch(\Exception $e){
            return back()->with('statuserror', 'No se pudo finalizar la intervención.');
        }


    }

    public function crearIntervencion(Request $request){
        $listadeunidades = $this->obtenerUnidades();
        return view('intervenciones.crearintervencion', ['listadeunidades' => $listadeunidades]);
        
    }

    public function registrarIntervencion(Request $request){

        $post = $request->all();

        $validacion = false;

        //Validar que no exista una intervención activa 
        $resultado = Intervencion::where("curso_id", $post["unidad"])->orderbydesc("id_intervencion")->first();
        $resultado = json_decode(json_encode($resultado), true);

 
        if($resultado == null){
            $validacion = true;
        }else{
            if(in_array($resultado["estado"], $resultado)){
                if(($resultado["estado"]) == 1){
                    $validacion = false;
                    return back()->with('statuserror', 'No fue posible crear la intervención debido a que ya existe una activa.');
                }else{
                    $validacion = true;
                }
            }
        }

        //Guardar
        if($validacion == true){
            try{
                $intervencion = new Intervencion();
                $intervencion->curso_id = $post["unidad"] ?? null;
                $intervencion->periodo = $post["mes"]." ".$post["anio"] ?? null;
                $intervencion->instrumentos = $post["instrumento"] ?? null;
                $intervencion->jefatura_directa = $post["jefaturadirecta"] ?? null;
                $intervencion->jefatura = $post["jefatura"] ?? null;
                $intervencion->estado = "1";
                $intervencion->save();

                return view('intervenciones.enlaceinstrumento')->with('status', 'Intervención creada exitosamente.');

            }catch(\Exception $e){

                return back()->with('statuserror', 'No fue posible crear la intervención.');
            }
        }else{
            return back()->with('statuserror', 'No fue posible crear la intervención.');
        }
            
    }


}
