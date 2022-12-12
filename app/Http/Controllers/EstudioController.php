<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervencion;

class EstudioController extends Controller
{
    public function index()
    {
        $unidad = array();

        $lista = Intervencion::orderbydesc('id_intervencion')->paginate(10);
        $resultado = json_decode(json_encode($lista), true);

            foreach($resultado["data"] as $item){
                $listadeunidades = $this->obtenerUnidadesId($item["curso_id"]);
                $unidad[$item["curso_id"]] = [$listadeunidades->fullname];
            }

        return view('estudios.listarEstudios', ['listaDeIntervenciones' => $lista], ['listaDeUnidades' => $unidad]);
    }


}
