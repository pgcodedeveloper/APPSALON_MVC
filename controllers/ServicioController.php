<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        isAdmin();

        $servicios= Servicio::all();
        $router->render('servicios/index',[
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router){
        isAdmin();
        
        $servicio= new Servicio;
        $alertas= [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $resultado=  $servicio->guardar();

                if($resultado){
                    header('Location: /servicios');
                }
            }
        }

        
        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router){
        isAdmin();
        $id= $_GET['id'];
        if(!is_numeric($id)){
            header('Location: /servicios');
        };
        $servicio= Servicio::find($id);
        $alertas= [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $resultado=  $servicio->guardar();

                if($resultado){
                    header('Location: /servicios');
                }
            }
        }
        $router->render('servicios/actualizar',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }
}