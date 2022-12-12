<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CClima;
use Illuminate\Support\Facades\DB;
use App\Models\Matricular;
use App\Models\Intervencion;


class CuestionarioClima extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('pasarela.autenticacion');
    }

    public function pasarelaMoodle(){
        return view('pasarela.autenticacion');
    }

    public function verificarFuncionarioMoodle(Request $request){

        $post = $request->all();
        $userData = array();

        $funcionarioData = Matricular::where('email',$post["email"] )->first();

        if($funcionarioData == null){
            $userData["status"] = false;
            return redirect(route('pasarelaMoodle'))->with('statuserror', 'Correo o contraseña inválido.');
        }

        if($post["password"] == $funcionarioData->contrasenia){
            $funcionario = $this->obtenerFuncionario($post["email"]);

            if(count($funcionario) == 0){
                $userData["status"] = false;
                return redirect(route('pasarelaMoodle'))->with('statuserror', 'El usuario no se encuentra ingresado a Moodle.');
            }

            $userData["email_user"] = $funcionario[0]->email;
            $userData["nombre_user"] = $funcionario[0]->firstname;
            $userData["apellidos_user"] = $funcionario[0]->lastname;

            $intervencion = $this->obtenerUnidadesFuncionario($funcionario[0]->id);
            $userData["curso_user"] = $intervencion[0]->id;
            $userData["status"] = true;

            //return response()->json($userData);

            //La pregunta de fuego es si ya ha respondido el cuestionario.

            $Cuestionario = CClima::where('email',$post["email"] )
            ->where('id_curso',$userData["curso_user"])
            ->first();

            if($Cuestionario == null){
                return view('instrumentos.cuestionario-clima',['userData' => $userData]);
            }else{
                return redirect(route('pasarelaMoodle'))->with('statuserror', 'Usted ya ha contestado el Cuestionario de Clima del área '.$intervencion[0]->fullname);
            }

        }else{
            $userData["status"] = false;
            return redirect(route('pasarelaMoodle'))->with('statuserror', 'Correo o contraseña inválido.');
        }

    }

    public function definirResultadoTabla($media){

        //Resultado basado en media.
        if($media >= 1.00 && $media <= 1.99){
            return "Muy favorable";
        }
        elseif($media >= 2.00 && $media <= 2.49){
            return "Favorable";
        }
        elseif($media >= 2.50 && $media <= 2.99){
            return "Regular";
        }
        elseif($media >= 3.00 && $media <= 3.49){
            return "Desfavorable";
        }
        elseif($media >= 3.50 && $media <= 4.00){
            return "Muy desfavorable";
        }
    }

    public function vistaEstudio($id){

        if (CClima::where('id_intervencion', $id)->exists()){

            $EstudioClima = $this->traerRespuestas($id);
            $listJsonResult = json_decode($EstudioClima->getContent());
            return view('instrumentos.estudio-clima-organizacional', ['EstudioClima' => $listJsonResult]);

        }else{
            return back()->with('statuserror', 'Aún no hay registros de instrumentos respondidos.');
        }


    }

    public function traerRespuestas($id){


        $estudioClima = array();

        $sumaEstructura = 0;
        $estructuraSumatoria = 0;
        $estructuraVarianza = 0;
        $estructuraDesviacion = 0;
        $cantidadPregunta = 0;
        $contador = 0;
        $array_aux = [];

        $estructura = "SELECT p01,p02,p03,p04,p05,p06,p07,p08 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($estructura);
        $estudioClima['estructura'] = json_decode(json_encode($sql), true);

            for($a = 0; $a < count($estudioClima['estructura']); $a++ ){
                $contador = (count($estudioClima['estructura'][$a]));
                $cantidadPregunta += $contador;
            }

            for($a = 0; $a < count($estudioClima['estructura']); $a++ ){
                $contador = (array_sum($estudioClima['estructura'][$a]));
                $sumaEstructura += $contador;
            }

            $estructuraMedia = ($sumaEstructura/$cantidadPregunta);
            $estructuraMedia = bcdiv($estructuraMedia, 1, 2);
            $estructuraMedia = floatval($estructuraMedia);
            $estudioClima['estructura_media'] = $estructuraMedia;

            $estructuraRespuestas = [];

            for($a = 0; $a < count($estudioClima['estructura']); $a++ ){
                $array_aux = array_values($estudioClima['estructura'][$a]);
                foreach($array_aux as $item){
                    array_push($estructuraRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $estructuraSumatoria = pow(($estructuraRespuestas[$a] - $estructuraMedia), 2);
                $estructuraVarianza = $estructuraVarianza + $estructuraSumatoria;
            }

            $estructuraVarianza = ($estructuraVarianza/($cantidadPregunta - 1));
            $estudioClima['estructura_varianza'] = $estructuraVarianza;

            //Calcular la desviación
            $estructuraDesviacion = sqrt($estructuraVarianza);
            $estructuraDesviacion = round($estructuraDesviacion, 2);
            $estudioClima['estructura_desviacion'] = $estructuraDesviacion;

            //Resultado basado en media.
            $resultadoEstructura = $this->definirResultadoTabla($estructuraMedia);
            $estudioClima['estructura_resultado'] = $resultadoEstructura;


        $sumaResponsabilidad = 0;
        $responsabilidadSumatoria = 0;
        $responsabilidadVarianza = 0;
        $responsabilidadDesviacion = 0;
        $cantidadPregunta = 0;

        $responsabilidad = "SELECT p09, p10, p11, p12, p13, p14, p15 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($responsabilidad);
        $estudioClima['responsabilidad'] = json_decode(json_encode($sql), true);

            for($a = 0; $a < count($estudioClima['responsabilidad']); $a++ ){
                $contador = (count($estudioClima['responsabilidad'][$a]));
                $cantidadPregunta += $contador;
            }

            for($a = 0; $a < count($estudioClima['responsabilidad']); $a++ ){
                $contador = (array_sum($estudioClima['responsabilidad'][$a]));
                $sumaResponsabilidad += $contador;
            }

            $responsabilidadMedia = ($sumaResponsabilidad/$cantidadPregunta);
            $responsabilidadMedia = bcdiv($responsabilidadMedia, 1, 2);
            $responsabilidadMedia = floatval($responsabilidadMedia);
            $estudioClima['responsabilidad_media'] = $responsabilidadMedia;

            $responsabilidadRespuestas = [];

            for($a = 0; $a < count($estudioClima['responsabilidad']); $a++ ){
                $array_aux = array_values($estudioClima['responsabilidad'][$a]);
                foreach($array_aux as $item){
                    array_push($responsabilidadRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $responsabilidadSumatoria = pow(($responsabilidadRespuestas[$a] - $responsabilidadMedia), 2);
                $responsabilidadVarianza = $responsabilidadVarianza + $responsabilidadSumatoria;
            }

            $responsabilidadVarianza = ($responsabilidadVarianza/($cantidadPregunta - 1));
            $estudioClima['responsabilidad_varianza'] = $responsabilidadVarianza;

            //Calcular la desviación
            $responsabilidadDesviacion = sqrt($responsabilidadVarianza);
            $responsabilidadDesviacion = round($responsabilidadDesviacion, 2);
            $estudioClima['responsabilidad_desviacion'] = $responsabilidadDesviacion;

            //Resultado basado en media.
            $resultadoResponsabilidad = $this->definirResultadoTabla($responsabilidadMedia);
            $estudioClima['responsabilidad_resultado'] = $resultadoResponsabilidad;


        $sumaRecompensa = 0;
        $recompensaSumatoria = 0;
        $recompensaVarianza = 0;
        $recompensaDesviacion = 0;
        $cantidadPregunta = 0;

        $recompensa = "SELECT p16, p17, p18, p19, p20 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($recompensa);
        $estudioClima['recompensa'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['recompensa']); $a++ ){
            $contador = (count($estudioClima['recompensa'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['recompensa']); $a++ ){
            $contador = (array_sum($estudioClima['recompensa'][$a]));
            $sumaRecompensa += $contador;
        }

            $recompensaMedia = ($sumaRecompensa/$cantidadPregunta);
            $recompensaMedia = bcdiv($recompensaMedia, 1, 2);
            $recompensaMedia = floatval($recompensaMedia);
            $estudioClima['recompensa_media'] = $recompensaMedia;

            $recompensaRespuestas = [];
            for($a = 0; $a < count($estudioClima['recompensa']); $a++ ){
                $array_aux = array_values($estudioClima['recompensa'][$a]);
                foreach($array_aux as $item){
                    array_push($recompensaRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $recompensaSumatoria = pow(($recompensaRespuestas[$a] - $recompensaMedia), 2);
                $recompensaVarianza = $recompensaVarianza + $recompensaSumatoria;
            }

            $recompensaVarianza = ($recompensaVarianza/($cantidadPregunta - 1));
            $estudioClima['recompensa_varianza'] = $recompensaVarianza;

            //Calcular la desviación
            $recompensaDesviacion = sqrt($recompensaVarianza);
            $recompensaDesviacion = round($recompensaDesviacion, 2);
            $estudioClima['recompensa_desviacion'] = $recompensaDesviacion;

            //Resultado basado en media.
            $resultadoRecompensa = $this->definirResultadoTabla($recompensaMedia);
            $estudioClima['recompensa_resultado'] = $resultadoRecompensa;



        $sumaDesafio = 0;
        $desafioSumatoria = 0;
        $desafioVarianza = 0;
        $desafioDesviacion = 0;
        $cantidadPregunta = 0;

        $desafio = "SELECT p21, p22, p23, p24, p25, p26 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($desafio);
        $estudioClima['desafio'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['desafio']); $a++ ){
            $contador = (count($estudioClima['desafio'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['desafio']); $a++ ){
            $contador = (array_sum($estudioClima['desafio'][$a]));
            $sumaDesafio += $contador;
        }

            $desafioMedia = ($sumaDesafio/$cantidadPregunta);
            $desafioMedia = bcdiv($desafioMedia, 1, 2);
            $desafioMedia = floatval($desafioMedia);
            $estudioClima['desafio_media'] = $desafioMedia;

            $desafioRespuestas = [];
            for($a = 0; $a < count($estudioClima['desafio']); $a++ ){
                $array_aux = array_values($estudioClima['desafio'][$a]);
                foreach($array_aux as $item){
                    array_push($desafioRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $desafioSumatoria = pow(($desafioRespuestas[$a] - $desafioMedia), 2);
                $desafioVarianza = $desafioVarianza + $desafioSumatoria;
            }

            $desafioVarianza = ($desafioVarianza/($cantidadPregunta - 1));
            $estudioClima['desafio_varianza'] = $desafioVarianza;

            //Calcular la desviación
            $desafioDesviacion = sqrt($desafioVarianza);
            $desafioDesviacion = round($desafioDesviacion, 2);
            $estudioClima['desafio_desviacion'] = $desafioDesviacion;

            //Resultado basado en media.
            $resultadoDesafio = $this->definirResultadoTabla($desafioMedia);
            $estudioClima['desafio_resultado'] = $resultadoDesafio;



        $sumaRelaciones = 0;
        $relacionesSumatoria = 0;
        $relacionesVarianza = 0;
        $relacionesDesviacion = 0;
        $cantidadPregunta = 0;

        $relaciones = "SELECT p27, p28, p29, p30, p31 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($relaciones);
        $estudioClima['relaciones'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['relaciones']); $a++ ){
            $contador = (count($estudioClima['relaciones'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['relaciones']); $a++ ){
            $contador = (array_sum($estudioClima['relaciones'][$a]));
            $sumaRelaciones += $contador;
        }

            $relacionesMedia = ($sumaRelaciones/$cantidadPregunta);
            $relacionesMedia = bcdiv($relacionesMedia, 1, 2);
            $relacionesMedia = floatval($relacionesMedia);
            $estudioClima['relaciones_media'] = $relacionesMedia;

            $relacionesRespuestas = [];
            for($a = 0; $a < count($estudioClima['relaciones']); $a++ ){
                $array_aux = array_values($estudioClima['relaciones'][$a]);
                foreach($array_aux as $item){
                    array_push($relacionesRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $relacionesSumatoria = pow(($relacionesRespuestas[$a] - $relacionesMedia), 2);
                $relacionesVarianza = $relacionesVarianza + $relacionesSumatoria;
            }

            $relacionesVarianza = ($relacionesVarianza/($cantidadPregunta - 1));
            $estudioClima['relaciones_varianza'] = $relacionesVarianza;

            //Calcular la desviación
            $relacionesDesviacion = sqrt($relacionesVarianza);
            $relacionesDesviacion = round($relacionesDesviacion, 2);
            $estudioClima['relaciones_desviacion'] = $relacionesDesviacion;

            //Resultado basado en media.
            $resultadoRelaciones = $this->definirResultadoTabla($relacionesMedia);
            $estudioClima['relaciones_resultado'] = $resultadoRelaciones;


        $sumaCooperacion = 0;
        $cooperacionSumatoria = 0;
        $cooperacionVarianza = 0;
        $cooperacionDesviacion = 0;
        $cantidadPregunta = 0;

        $cooperacion = "SELECT p32, p33, p34, p35, p36 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($cooperacion);
        $estudioClima['cooperacion'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['cooperacion']); $a++ ){
            $contador = (count($estudioClima['cooperacion'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['cooperacion']); $a++ ){
            $contador = (array_sum($estudioClima['cooperacion'][$a]));
            $sumaCooperacion += $contador;
        }

            $cooperacionMedia = ($sumaCooperacion/$cantidadPregunta);
            $cooperacionMedia = bcdiv($cooperacionMedia, 1, 2);
            $cooperacionMedia = floatval($cooperacionMedia);
            $estudioClima['cooperacion_media'] = $cooperacionMedia;

            $cooperacionRespuestas = [];
            for($a = 0; $a < count($estudioClima['cooperacion']); $a++ ){
                $array_aux = array_values($estudioClima['cooperacion'][$a]);
                foreach($array_aux as $item){
                    array_push($cooperacionRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $cooperacionSumatoria = pow(($cooperacionRespuestas[$a] - $cooperacionMedia), 2);
                $cooperacionVarianza = $cooperacionVarianza + $cooperacionSumatoria;
            }

            $cooperacionVarianza = ($cooperacionVarianza/($cantidadPregunta - 1));
            $estudioClima['cooperacion_varianza'] = $cooperacionVarianza;

            //Calcular la desviación
            $cooperacionDesviacion = sqrt($cooperacionVarianza);
            $cooperacionDesviacion = round($cooperacionDesviacion, 2);
            $estudioClima['cooperacion_desviacion'] = $cooperacionDesviacion;

            //Resultado basado en media.
            $resultadoCooperacion = $this->definirResultadoTabla($cooperacionMedia);
            $estudioClima['cooperacion_resultado'] = $resultadoCooperacion;


        $sumaEstandares = 0;
        $estandaresSumatoria = 0;
        $estandaresVarianza = 0;
        $estandaresDesviacion = 0;
        $cantidadPregunta = 0;

        $estandares = "SELECT p37, p38, p39, p40, p41, p42 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($estandares);
        $estudioClima['estandares'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['estandares']); $a++ ){
            $contador = (count($estudioClima['estandares'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['estandares']); $a++ ){
            $contador = (array_sum($estudioClima['estandares'][$a]));
            $sumaEstandares += $contador;
        }

            $estandaresMedia = ($sumaEstandares/$cantidadPregunta);
            $estandaresMedia = bcdiv($estandaresMedia, 1, 2);
            $estandaresMedia = floatval($estandaresMedia);
            $estudioClima['estandares_media'] = $estandaresMedia;

            $estandaresRespuestas = [];
            for($a = 0; $a < count($estudioClima['estandares']); $a++ ){
                $array_aux = array_values($estudioClima['estandares'][$a]);
                foreach($array_aux as $item){
                    array_push($estandaresRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $estandaresSumatoria = pow(($estandaresRespuestas[$a] - $estandaresMedia), 2);
                $estandaresVarianza = $estandaresVarianza + $estandaresSumatoria;
            }

            $estandaresVarianza = ($estandaresVarianza/($cantidadPregunta - 1));
            $estudioClima['estandares_varianza'] = $estandaresVarianza;

            //Calcular la desviación
            $estandaresDesviacion = sqrt($estandaresVarianza);
            $estandaresDesviacion = round($estandaresDesviacion, 2);
            $estudioClima['estandares_desviacion'] = $estandaresDesviacion;

            //Resultado basado en media.
            $resultadoEstandares = $this->definirResultadoTabla($estandaresMedia);
            $estudioClima['estandares_resultado'] = $resultadoEstandares;


        $sumaConflicto = 0;
        $conflictoSumatoria = 0;
        $conflictoVarianza = 0;
        $conflictoDesviacion = 0;
        $cantidadPregunta = 0;

        $conflicto = "SELECT p43, p44, p45, p46 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($conflicto);
        $estudioClima['conflicto'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['conflicto']); $a++ ){
            $contador = (count($estudioClima['conflicto'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['conflicto']); $a++ ){
            $contador = (array_sum($estudioClima['conflicto'][$a]));
            $sumaConflicto += $contador;
        }

            $conflictoMedia = ($sumaConflicto/$cantidadPregunta);
            $conflictoMedia = bcdiv($conflictoMedia, 1, 2);
            $conflictoMedia = floatval($conflictoMedia);
            $estudioClima['conflicto_media'] = $conflictoMedia;

            $conflictoRespuestas = [];
            for($a = 0; $a < count($estudioClima['conflicto']); $a++ ){
                $array_aux = array_values($estudioClima['conflicto'][$a]);
                foreach($array_aux as $item){
                    array_push($conflictoRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $conflictoSumatoria = pow(($conflictoRespuestas[$a] - $conflictoMedia), 2);
                $conflictoVarianza = $conflictoVarianza + $conflictoSumatoria;
            }

            $conflictoVarianza = ($conflictoVarianza/($cantidadPregunta - 1));
            $estudioClima['conflicto_varianza'] = $conflictoVarianza;

            //Calcular la desviación
            $conflictoDesviacion = sqrt($conflictoVarianza);
            $conflictoDesviacion = round($conflictoDesviacion, 2);
            $estudioClima['conflicto_desviacion'] = $conflictoDesviacion;

            //Resultado basado en media.
            $resultadoConflicto = $this->definirResultadoTabla($conflictoMedia);
            $estudioClima['conflicto_resultado'] = $resultadoConflicto;


        $sumaIdentidad = 0;
        $identidadSumatoria = 0;
        $identidadVarianza = 0;
        $identidadDesviacion = 0;
        $cantidadPregunta = 0;

        $identidad = "SELECT p47, p48, p49, p50 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($identidad);
        $estudioClima['identidad'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['identidad']); $a++ ){
            $contador = (count($estudioClima['identidad'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['identidad']); $a++ ){
            $contador = (array_sum($estudioClima['identidad'][$a]));
            $sumaIdentidad += $contador;
        }

            $identidadMedia = ($sumaIdentidad/$cantidadPregunta);
            $identidadMedia = bcdiv($identidadMedia, 1, 2);
            $identidadMedia = floatval($identidadMedia);
            $estudioClima['identidad_media'] = $identidadMedia;

            $identidadRespuestas = [];
            for($a = 0; $a < count($estudioClima['identidad']); $a++ ){
                $array_aux = array_values($estudioClima['identidad'][$a]);
                foreach($array_aux as $item){
                    array_push($identidadRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $identidadSumatoria = pow(($identidadRespuestas[$a] - $identidadMedia), 2);
                $identidadVarianza = $identidadVarianza + $identidadSumatoria;
            }

            $identidadVarianza = ($identidadVarianza/($cantidadPregunta - 1));
            $estudioClima['identidad_varianza'] = $identidadVarianza;

            //Calcular la desviación
            $identidadDesviacion = sqrt($identidadVarianza);
            $identidadDesviacion = round($identidadDesviacion, 2);
            $estudioClima['identidad_desviacion'] = $identidadDesviacion;

            //Resultado basado en media.
            $resultadoIdentidad = $this->definirResultadoTabla($identidadMedia);
            $estudioClima['identidad_resultado'] = $resultadoIdentidad;


        //Traer Totales
        $sumaTotales = 0;
        $totalesSumatoria = 0;
        $totalesVarianza = 0;
        $totalesDesviacion = 0;
        $cantidadPregunta = 0;

        $total = "SELECT p01,p02,p03,p04,p05,p06,p07,p08,p09,p10,p11,p12,p13,p14,p15,p16,p17,p18,p19,p20,p21,p22,p23,p24,p25,p26,p27,p28,p29,p30,p31,p32,p33,p34,p35,p36,p37,p38,p39,p40,p41,p42,p43,p44,p45,p46,
        p47,p48,p49,p50 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($total);
        $estudioClima['totales'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['totales']); $a++ ){
            $contador = (count($estudioClima['totales'][$a]));
            $cantidadPregunta += $contador;
        }

        for($a = 0; $a < count($estudioClima['totales']); $a++ ){
            $contador = (array_sum($estudioClima['totales'][$a]));
            $sumaTotales += $contador;
        }

            $totalesMedia = ($sumaTotales/$cantidadPregunta);
            $totalesMedia = bcdiv($totalesMedia, 1, 2);
            $totalesMedia = floatval($totalesMedia);
            $estudioClima['totales_media'] = $totalesMedia;

            $totalesRespuestas = [];
            for($a = 0; $a < count($estudioClima['totales']); $a++ ){
                $array_aux = array_values($estudioClima['totales'][$a]);
                foreach($array_aux as $item){
                    array_push($totalesRespuestas, $item);
                }
            }

            //calcular varianza
            for($a=0; $a<$cantidadPregunta; $a++){
                $totalesSumatoria = pow(($totalesRespuestas[$a] - $totalesMedia), 2);
                $totalesVarianza = $totalesVarianza + $totalesSumatoria;
            }

            $totalesVarianza = ($totalesVarianza/($cantidadPregunta - 1));
            $estudioClima['totales_varianza'] = $totalesVarianza;

            //Calcular la desviación
            $totalesDesviacion = sqrt($totalesVarianza);
            $totalesDesviacion = round($totalesDesviacion, 2);
            $estudioClima['totales_desviacion'] = $totalesDesviacion;

            //Resultado basado en media.
            $resultadoTotales = $this->definirResultadoTabla($totalesMedia);
            $estudioClima['totales_resultado'] = $resultadoTotales;


        $cantidadPregunta = 0;
        $sumaLiderazgo = 0;
        $array_auxuliar = [];

        $liderazgo = "SELECT p51_1, p51_2, p52_1, p52_2, p53_1, p53_2, p54_1, p54_2, p55_1, p55_2, p56_1, p56_2, p57_1, p57_2, p58_1, p58_2, p59_1, p59_2, p60_1, p60_2 FROM cuestionario_clima WHERE id_intervencion = ".$id;
        $sql = DB::select($liderazgo);
        $estudioClima['liderazgo'] = json_decode(json_encode($sql), true);

        for($a = 0; $a < count($estudioClima['liderazgo']); $a++ ){
            $array_auxuliar[$a] = ((array_sum($estudioClima['liderazgo'][$a]))/20);
        }
        $estudioClima['liderazgo_data'] = $array_auxuliar;

        //dd($estudioClima);
        return response()->json($estudioClima);
    }

    public function cuestionarioFinalizado($unidad){
        return view('instrumentos.cuestionario-clima-finalizado', ['unidad' => $unidad]);
    }

    public function guardarCuestionarioClima(Request $request)
    {

        $post = $request->all();

        //Validar que efectivamente el funcionario no haya contestado el formulario antes.

        //Si no hay registro de que el funcionario no haya contestado y el Email y el curso son correctos, procedo a guardar.
        //preguntar si "Clima" tiene el "correo" y "curso" del usuario  if (isset($cuestionarioClima->email && $cuestionarioClima->curso_id))

        $Cuestionario = CClima::where('email',$post["email"] )
            ->where('id_curso',$post["id_curso"])
            ->first();

        if($Cuestionario == null){
            $traerIntervencion = Intervencion::where('estado', '1')->where('curso_id', '11')->first();
        $resultado = json_decode(json_encode($traerIntervencion), true);

        try {

            $cuestionarioClima = new CClima();

            $cuestionarioClima->email = $post["email"] ?? null;
            $cuestionarioClima->id_curso = $post["id_curso"] ?? null;

            $cuestionarioClima->genero = $post["genero"] ?? null;
            $cuestionarioClima->edad = $post["edad"] ?? null;
            $cuestionarioClima->p01 = $post["p01"] ?? null;
            $cuestionarioClima->p02 = $post["p02"] ?? null;
            $cuestionarioClima->p03 = $post["p03"] ?? null;
            $cuestionarioClima->p04 = $post["p04"] ?? null;
            $cuestionarioClima->p05 = $post["p05"] ?? null;
            $cuestionarioClima->p06 = $post["p06"] ?? null;
            $cuestionarioClima->p07 = $post["p07"] ?? null;
            $cuestionarioClima->p08 = $post["p08"] ?? null;
            $cuestionarioClima->p09 = $post["p09"] ?? null;
            $cuestionarioClima->p10 = $post["p10"] ?? null;
            $cuestionarioClima->p11 = $post["p11"] ?? null;
            $cuestionarioClima->p12 = $post["p12"] ?? null;
            $cuestionarioClima->p13 = $post["p13"] ?? null;
            $cuestionarioClima->p14 = $post["p14"] ?? null;
            $cuestionarioClima->p15 = $post["p15"] ?? null;
            $cuestionarioClima->p16 = $post["p16"] ?? null;
            $cuestionarioClima->p17 = $post["p17"] ?? null;
            $cuestionarioClima->p18 = $post["p18"] ?? null;
            $cuestionarioClima->p19 = $post["p19"] ?? null;
            $cuestionarioClima->p20 = $post["p20"] ?? null;
            $cuestionarioClima->p21 = $post["p21"] ?? null;
            $cuestionarioClima->p22 = $post["p22"] ?? null;
            $cuestionarioClima->p23 = $post["p23"] ?? null;
            $cuestionarioClima->p24 = $post["p24"] ?? null;
            $cuestionarioClima->p25 = $post["p25"] ?? null;
            $cuestionarioClima->p26 = $post["p26"] ?? null;
            $cuestionarioClima->p27 = $post["p27"] ?? null;
            $cuestionarioClima->p28 = $post["p28"] ?? null;
            $cuestionarioClima->p29 = $post["p29"] ?? null;
            $cuestionarioClima->p30 = $post["p30"] ?? null;
            $cuestionarioClima->p31 = $post["p31"] ?? null;
            $cuestionarioClima->p32 = $post["p32"] ?? null;
            $cuestionarioClima->p33 = $post["p33"] ?? null;
            $cuestionarioClima->p34 = $post["p34"] ?? null;
            $cuestionarioClima->p35 = $post["p35"] ?? null;
            $cuestionarioClima->p36 = $post["p36"] ?? null;
            $cuestionarioClima->p37 = $post["p37"] ?? null;
            $cuestionarioClima->p38 = $post["p38"] ?? null;
            $cuestionarioClima->p39 = $post["p39"] ?? null;
            $cuestionarioClima->p40 = $post["p40"] ?? null;
            $cuestionarioClima->p41 = $post["p41"] ?? null;
            $cuestionarioClima->p42 = $post["p42"] ?? null;
            $cuestionarioClima->p43 = $post["p43"] ?? null;
            $cuestionarioClima->p44 = $post["p44"] ?? null;
            $cuestionarioClima->p45 = $post["p45"] ?? null;
            $cuestionarioClima->p46 = $post["p46"] ?? null;
            $cuestionarioClima->p47 = $post["p47"] ?? null;
            $cuestionarioClima->p48 = $post["p48"] ?? null;
            $cuestionarioClima->p49 = $post["p49"] ?? null;
            $cuestionarioClima->p50 = $post["p50"] ?? null;

            $cuestionarioClima->p51_1 = $post["p51_1"] ?? null;
            $cuestionarioClima->p51_2 = $post["p51_2"] ?? null;
            $cuestionarioClima->p52_1 = $post["p52_1"] ?? null;
            $cuestionarioClima->p52_2 = $post["p52_2"] ?? null;
            $cuestionarioClima->p53_1 = $post["p53_1"] ?? null;
            $cuestionarioClima->p53_2 = $post["p53_2"] ?? null;
            $cuestionarioClima->p54_1 = $post["p54_1"] ?? null;
            $cuestionarioClima->p54_2 = $post["p54_2"] ?? null;
            $cuestionarioClima->p55_1 = $post["p55_1"] ?? null;
            $cuestionarioClima->p55_2 = $post["p55_2"] ?? null;
            $cuestionarioClima->p56_1 = $post["p56_1"] ?? null;
            $cuestionarioClima->p56_2 = $post["p56_2"] ?? null;
            $cuestionarioClima->p57_1 = $post["p57_1"] ?? null;
            $cuestionarioClima->p57_2 = $post["p57_2"] ?? null;
            $cuestionarioClima->p58_1 = $post["p58_1"] ?? null;
            $cuestionarioClima->p58_2 = $post["p58_2"] ?? null;
            $cuestionarioClima->p59_1 = $post["p59_1"] ?? null;
            $cuestionarioClima->p59_2 = $post["p59_2"] ?? null;
            $cuestionarioClima->p60_1 = $post["p60_1"] ?? null;
            $cuestionarioClima->p60_2 = $post["p60_2"] ?? null;

            $cuestionarioClima->pd_01 = $post["pd_01"] ?? null;
            $cuestionarioClima->pd_02 = $post["pd_02"] ?? null;
            $cuestionarioClima->pd_03 = $post["pd_03"] ?? null;
            $cuestionarioClima->pd_04 = $post["pd_04"] ?? null;

            $cuestionarioClima->s1_promedio = $post["s1_promedio"] ?? null;
            $cuestionarioClima->s2_promedio = $post["s2_promedio"] ?? null;
            $cuestionarioClima->s2_des_estandard = $post["s2_des_estandard"] ?? null;
            $cuestionarioClima->id_intervencion = $resultado["id_intervencion"];

            $cuestionarioClima->save();

            //$finalizado = $this->cuestionarioFinalizado($post["id_curso"]);
            return true;

        } catch (\Illuminate\Database\QueryException $ex) {

            return $ex;
        }

        }else{
            echo("Ya ha respondido.");
        }
    }



}
