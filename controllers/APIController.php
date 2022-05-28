<?php 

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;
use MVC\Router;

class APIController{
    public static function index(){
        $servicios= Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar(){
        
        $cita= new Cita($_POST);
        $respuesta= $cita->guardar();

        $id= $respuesta['id'];

        $idServicios= explode(",",$_POST['servicios']);

        foreach($idServicios as $idServicio){
            $args=[
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio= new CitaServicio($args);
            $citaServicio->guardar();
        }

        $resultado= [
            'respuesta' => $respuesta
        ];
        echo json_encode($resultado);
    }

    public static function eliminar(){
        isAdmin();
        $idCita= $_POST['id'];
        $cita= Cita::find($idCita);
        $respuesta= $cita->eliminar();
        $resultado= [
            'respuesta' => $respuesta
        ];
        echo json_encode($resultado);
    }

    public static function eliminarSer(){
        isAdmin();
        $idSer= $_POST['id'];
        $servicio= Servicio::find($idSer);
        if(!$servicio) return;
        $respuesta= $servicio->eliminar();
        
        $resultado= [
            'respuesta' => $respuesta
        ];
        echo json_encode($resultado);
    }
}