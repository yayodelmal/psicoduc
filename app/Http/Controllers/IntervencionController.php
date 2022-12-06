<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervencion;
use Mockery\Undefined;

class IntervencionController extends Controller
{
    public function index(Request $request){

        $lista = Intervencion::orderbydesc('id_intervencion')->paginate(10);
        //dd($lista);
        return view('intervenciones.intervenciones',['listaDeIntervenciones' => $lista]);
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
