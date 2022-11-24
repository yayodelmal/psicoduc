<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function obtenerUnidades(){
        $client = new Client();

        $resultado = $client->request('GET', env('API_ENDPOINT'),[
            'query' => [
                'wstoken' => env('API_KEY'),
                'wsfunction' => 'core_course_get_courses',
                'moodlewsrestformat' => 'json'
            ]
        ]);

        $listJsonResult = json_decode($resultado->getBody()->getContents());
        $nuevaLista = [];

        foreach($listJsonResult as $item){
            array_push($nuevaLista, [
                'id' => $item->id,
                'shortname' => $item->shortname,
                'fullname' => $item->fullname,
                'visible' => $item->visible
            ]);
        }
        
        //Quitar el que viene con el nombre de la app porque nada que ver po wn xd 
        unset($nuevaLista[0]);
        
        usort($nuevaLista, function($a, $b){
            return strtolower($a['fullname']) > strtolower($b['fullname']);
        });

        return $nuevaLista;
    }

    public function obtenerFuncionario($valor, $tipo = 'email'){

        $client = new Client();

        $resultado = $client->request('GET', env('API_ENDPOINT'),[
            'query' => [
                'wstoken' => env('API_KEY'),
                'wsfunction' => 'core_user_get_users_by_field',
                'moodlewsrestformat' => 'json',
                'field' => $tipo,
                'values[0]' => $valor
            ]
        ]);

        $resultado = json_decode($resultado->getBody()->getContents());
        return $resultado;

    }

    public function obtenerUnidadesFuncionario($valor){
        
        $client = new Client();
        
        $resultado = $client->request('GET', env('API_ENDPOINT'),[
            'query' => [
                'wstoken' => env('API_KEY'),
                'wsfunction' => 'core_enrol_get_users_courses',
                'moodlewsrestformat' => 'json',
                'userid' => $valor
            ]
        ]);

        $resultado = json_decode($resultado->getBody()->getContents());
        return $resultado;
        
    }

    public function obtenerUnidadesId($id, $tipo = 'id'){
        $client = new Client();

        $resultado = $client->request('GET', env('API_ENDPOINT'),[
            'query' => [
                'wstoken' => env('API_KEY'),
                'wsfunction' => 'core_course_get_courses_by_field',
                'moodlewsrestformat' => 'json',
                'field' => $tipo,
                'value' => $id
            ]
        ]);

        $resultado = json_decode($resultado->getBody()->getContents());

        return $resultado->courses[0];
    }

    public function crearFuncionario($nombre_usuario, $contrasenia, $nombre, $apellidos, $email){
        
        $client = new Client();

        $resultado = $client->request('GET', env('API_ENDPOINT'),[
            'query' => [
                'wstoken' => env('API_KEY'),
                'wsfunction' => 'core_user_create_users',
                'moodlewsrestformat' => 'json',
                'users[0][username]' => $nombre_usuario,
                'users[0][password]' => $contrasenia,
                'users[0][firstname]' => $nombre,
                'users[0][lastname]' => $apellidos,
                'users[0][email]' => $email
            ]
        ]);

        $resultado = json_decode($resultado->getBody()->getContents());
        return $resultado;
    }

    //El rol 5 --> corresponde al de estudiante en moodle
    public function matricularCurso($userId, $courseId, $roleId = 5){
        
        $client = new Client();

        $resultado = $client->request('GET', env('API_ENDPOINT'),[
            'query' => [
                'wstoken' => env('API_KEY'),
                'wsfunction' => 'enrol_manual_enrol_users',
                'moodlewsrestformat' => 'json',
                'enrolments[0][userid]' => $userId,
                'enrolments[0][courseid]' => $courseId,
                'enrolments[0][roleid]' => $roleId,
                'enrolments[0][timestart]' => 0,
                'enrolments[0][timeend]' => 0,
                'enrolments[0][suspend]' => 0
            ]
        ]);

        $resultado = json_decode($resultado->getBody()->getContents());
        return $resultado;
    }

    public function actualizarContraseniaFuncionario ($id, $password){
        
        $client = new Client();

        $resultado = $client->request('GET', env('API_ENDPOINT'),[
            'query' => [
                'wstoken' => env('API_KEY'),
                'wsfunction' => 'core_user_update_users',
                'moodlewsrestformat' => 'json',
                'users[0][id]' => $id,
                'users[0][password]' => $password
            ]
        ]);

        $resultado = json_decode($resultado->getBody()->getContents());

        return $resultado;
    }

}
