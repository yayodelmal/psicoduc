<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricular;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MatriculaController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $lista = Matricular::orderbydesc('id')->paginate(10);
        return view('matricula.index',['listaDeMatricula' => $lista]);
    }

    public function crear_funcionario(){
        $listadeunidades = $this->obtenerUnidades();
        return view('matricula.crear', ['listadeunidades' => $listadeunidades]);

    }

    private function reglasValidacionFuncionario(array $datosValidar){

        $messages = [
            'required' => 'El :attribute es requerido.',
            'unidad.min' => 'La unidad es requerida.',
        ];

        return Validator::make($datosValidar,
            [
                'nombre' => 'required|string|min:3|max:60',
                'apellidos' => 'required|string|min:3|max:60',
                'unidad' => 'required|numeric|min:1',
                'email' => 'required|email:rfc,dns',
                'nombre_usuario' => 'required|string|min:5|max:60',
                'contrasenia' => 'required|string|min:6|max:60',
            ],
            $messages
        );
    }

    public function guardar_funcionario(Request $request){

        $datosFormulario = $request->all();
        
        $ejecutar = $this->reglasValidacionFuncionario($datosFormulario);
        $ejecutar->validate();
    
        $usuario = $this->obtenerFuncionario($datosFormulario['email']);
        
        //Falta validar si el usuario existe en la base de datos de Laravel.


        //Validaciones Moodle.
        if(count($usuario) == 0){
            $usuario = $this->obtenerFuncionario($datosFormulario['nombre_usuario'], 'username');
            if(count($usuario) > 0){
                return back()->withInput()->with('statuserror', 'El funcionario ya existe.');
            }
            $this->guardarRegistro($datosFormulario);
        }else{
            
            $unidadDeFuncionario = $this->obtenerUnidadesFuncionario($usuario[0]->id);
            
            if(count($unidadDeFuncionario)>0){
                foreach($unidadDeFuncionario as $unidad){
                    if($unidad->id == $datosFormulario['unidad']){
                        return back()->withInput()->with('statuserror', 'El funcionario ya existe, y ya se encuentra ingresado.');
                    }
                }
            }

            $cantidadDias = 0;
            if($usuario[0]->lastaccess > 0){
                $date = new \DateTime();
                $datenow = new \DateTime();
                $date->setTimestamp($usuario[0]->lastaccess);
                $cantidadDias = $date->diff($datenow)->days;
            }

            $this->guardarRegistro($datosFormulario, 1, $cantidadDias);
        }

        return redirect(route('listaFuncionarios'))->with('status', 'Funcionario creado exitosamente.');
    }

    public function guardarRegistro(array $datosFormulario, $registrado = 0, $cantidadDiasSinIngreso = 0){
        
        $matricular = new Matricular();
        $matricular->nombre = $datosFormulario['nombre']; 
        $matricular->apellidos = $datosFormulario['apellidos']; 
        $matricular->email = $datosFormulario['email']; 
        $matricular->nombre_usuario = $datosFormulario['nombre_usuario']; 
        $matricular->contrasenia = $datosFormulario['contrasenia']; 
        $matricular->curso_id = $datosFormulario['unidad'];
        $matricular->categoria = 'Unidad';

        $datosDeUnidad = $this->obtenerUnidadesId($datosFormulario['unidad']);
        
        $matricular->nombre_corto_curso = $datosDeUnidad->shortname;
        $matricular->nombre_largo_curso = $datosDeUnidad->fullname;
        $matricular->cantidad_dias_ingreso = $cantidadDiasSinIngreso;
        
        // $matricular->registrado = ;

        $matricular->matricula = $registrado;
        $matricular->save();

        return true;
    }

    public function registrar_funcionario(Request $request, $id){

        $resultadoMatricula = false;
        $funcionarioMatricular = Matricular::where('id', $id)->first();

        if(!$funcionarioMatricular->matricula){
            $funcionario = $this->obtenerFuncionario($funcionarioMatricular->email);
            if(count($funcionario) == 0){
                $funcionario = $this->obtenerFuncionario($funcionarioMatricular->nombre_usuario, 'username');
                if(count($funcionario) == 0){
                    
                    //crear nuevo funcionario
                    $nuevoFuncionario = $this->crearFuncionarioMoodle($funcionarioMatricular);

                    //matricular
                    $resultadoMatricula = $this->enviarMatricular($funcionarioMatricular, $nuevoFuncionario[0]->id);

                }else{
                    return back()->with('statuserror', 'El funcionario ya existe, ');
                }
               
            
            }else{
                //matricular
                $funcionario = $this->obtenerFuncionario($funcionarioMatricular->email);
                $resultadoMatricula = $this->enviarMatricular($funcionarioMatricular, $funcionario[0]->id);
            }
        }else{
            //matricular.
            $funcionario = $this->obtenerFuncionario($funcionarioMatricular->email);
            $resultadoMatricula = $this->enviarMatricular($funcionarioMatricular, $funcionario[0]->id);

        }
        //$resultadoMatricula = true;
        //Enviar resultado de matricula.
        if($resultadoMatricula){
            //Enviar correo a funcionario matriculado.
            $resultadoEnvioCorreo = $this->enviarCorreoElectronico($funcionarioMatricular);
            
            if(!$resultadoEnvioCorreo){
                return redirect(route('listaFuncionarios'))->with('statuserror', 'Error, no fue posible enviar el correo electrónico.');
            }

        }else{
            return back()->with('statuserror', 'No fue posible matricular al funcionario.');
        }

        return redirect(route('listaFuncionarios'))->with('status', 'Funcionario matriculado exitosamente.');
    }

    public function enviarMatricular($funcionarioMatricular, $idFuncionario){
        
        try{

            if($funcionarioMatricular->cantidad_dias_ingreso >= 100){
                $this->actualizarContraseniaFuncionario($idFuncionario[0]->id, $funcionarioMatricular->contrasenia);
            }

            //Logica para matricula ---> enrol_manual_enrol_users.
            $matricularFuncionario = true;
            $cursosDelFuncionario = $this->obtenerUnidadesFuncionario($idFuncionario);

            foreach($cursosDelFuncionario as $curso){
                if($curso->id == $funcionarioMatricular->curso_id){
                    $matricularFuncionario = false;
                }
            }
            if($matricularFuncionario){
                $matriculado = $this->matricularCurso($idFuncionario, $funcionarioMatricular->curso_id);
            }

            $funcionarioMatricular->registrado = 1;
            $funcionarioMatricular->save();

        }catch (\Exception $e){
            return false;
        }

        return true;

    }

    public function crearFuncionarioMoodle($matricular){

        $nuevoFuncionario = $this->crearFuncionario(
            $matricular->nombre_usuario,
            $matricular->contrasenia,
            $matricular->nombre,
            $matricular->apellidos,
            $matricular->email
        );

        $matricular->matricula = 1;
        $matricular->save();

        return $nuevoFuncionario;
    }

    public function enviarCorreoElectronico($funcionarioMatricular){
        try{

            $contrasenia = $funcionarioMatricular->contrasenia;

            if($funcionarioMatricular->cantidad_dias_ingreso > 0 && $funcionarioMatricular->cantidad_dias_ingreso <= 100){
                $contrasenia = "Su contraseña no ha sido actualizada";
            }

            $subject = "Bienvenido ". $funcionarioMatricular->nombre_usuario;

            $data = array(  'email' => $funcionarioMatricular->email,
                            'subject' => $subject,
                            'nombrecurso' => $funcionarioMatricular->nombre_largo_curso,
                            'nombrecompleto' => $funcionarioMatricular->nombre . ' ' . $funcionarioMatricular->apellidos,
                            'nombreusuario' => $funcionarioMatricular->nombre_usuario,
                            'contrasenia' => $contrasenia
            );

            Mail::send('email.email', ['data' =>$data], function($message) use($data){
                $message->from('info@psicoduc.cl', 'Plataforma psicológica para aplicación de instrumentos');
                $message->to($data['email']);
                $message->subject($data['subject']);
            });

        }catch(\Exception $e){
            return false;
        }
        return true;
    }


}
