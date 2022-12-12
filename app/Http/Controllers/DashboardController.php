<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricular;
use App\Models\CClima;
use App\Models\Intervencion;

class DashboardController extends Controller
{
    public function index(){

        $dashboardData = array();
        $contarFuncionarios = 0;
        $contarAplicaciones = 0;

        $listadeunidades = $this->obtenerUnidades();
        $contador = 0;

        //Total de intervenciones que estan activas
        $intervencionesTotal = Intervencion::all()->count();
        $dashboardData["Total_intervenciones"] = $intervencionesTotal;

        //Total de unidades
        $dashboardData["Total_unidades"] = count($listadeunidades);

        //Traer intervenciones activas
        $intervencionesActivas = Intervencion::where('estado', '1')->get();
        $intervencionesActivas = json_decode(json_encode($intervencionesActivas), true);

        foreach($intervencionesActivas as $item){

            foreach($listadeunidades as $item2){
                if($item2["id"] == $item["curso_id"]){
                    $dashboardData["intervencion"][$contador]["unidad"] = $item2["fullname"];
                }
            }

            $listaFuncionarios = Matricular::where('curso_id', $item["curso_id"])->count();
            $dashboardData["intervencion"][$contador]["total_funcionarios"] = $listaFuncionarios;
            $contarFuncionarios = $contarFuncionarios + $listaFuncionarios;

            $aplicacionClima = CClima::where('id_curso', $item["curso_id"])->count();
            $contarAplicaciones = $contarAplicaciones + $aplicacionClima;

            //Traer periodo de la intervención
            $dashboardData["intervencion"][$contador]["periodo"] = $item["periodo"];

            if($aplicacionClima == 0 && $listaFuncionarios == 0){
                $dashboardData["intervencion"][$contador]["promedio"] = 0;
                $contador = $contador + 1;
            }else{
                $promedio = round(($aplicacionClima * 100)/$listaFuncionarios);
                $dashboardData["intervencion"][$contador]["promedio"] = $promedio;
                $contador = $contador + 1;
            }
        }

        //Traer el avance de todo
        $dashboardData["Avance"] = round(($contarAplicaciones * 100)/$contarFuncionarios);

        //Traer pendientes por contestar
        $dashboardData["Pendientes"] = ($contarFuncionarios - $contarAplicaciones);

        //dd($dashboardData);

        return view('welcome',['dashboardData' => $dashboardData]);
    }

    public function traerFuncionariosUnidad(){

        $Data = array();

        $listadeunidades = $this->obtenerUnidades();
        $contador = 0;

        //Traer intervenciones activas
        $intervencionesActivas = Intervencion::where('estado', '1')->get();
        $intervencionesActivas = json_decode(json_encode($intervencionesActivas), true);



        foreach($intervencionesActivas as $item){

            foreach($listadeunidades as $item2){
                if($item2["id"] == $item["curso_id"]){
                    $Data["intervencion"][$contador]["unidad"] = $item2["fullname"];
                }
            }

            $listaFuncionarios = Matricular::where('curso_id', $item["curso_id"])->count();
            $Data["intervencion"][$contador]["total_funcionarios"] = $listaFuncionarios;
            $contador = $contador + 1;
        }

        return $Data;
    }
}
