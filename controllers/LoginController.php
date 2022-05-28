<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        
        $alertas=[];
        $auth= new Usuario;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth= new Usuario($_POST);

           $alertas= $auth->validarLogin();

           if(empty($alertas)){
               $user= Usuario::where('email',$auth->email);
               if($user){
                   if($user->verificarPasswordAndConfirmado($auth->password)){
                       session_start();
                       $_SESSION['id']= $user->id;
                       $_SESSION['nombre']= $user->nombre . " " . $user->apellido;
                       $_SESSION['email']= $user->email;
                       $_SESSION['login']= true;
                       
                       if($user->admin === "1"){
                           $_SESSION['admin']= $user->admin ?? null;
                           header('Location: /admin');
                       }
                       else{
                           header('Location: /cita');
                       }
                        
                   }
               }
               else{
                   Usuario::setAlerta('error','El usuario no existe');
               }
           }
        }
        $alertas= Usuario::getAlertas();
        $router->render('auth/login',[
            'alertas' => $alertas
        ]);
    }
    public static function logout(){
        session_start();
        $_SESSION= [];
        header('Location: /');
    }
    public static function olvide(Router $router){
        $alertas=[];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth= new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
                $user= Usuario::where('email',$auth->email);

                if($user && $user->confirmado === '1'){
                    $user->crearToken();
                    $user->guardar();

                    $email= new Email($user->email,$user->nombre,$user->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlerta('exito','Revisa tu casilla');
                }
                else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                }
            }
        }
        $alertas= Usuario::getAlertas();
        $router->render('auth/olvide-password',[
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router){
        $alertas=[];
        $error= false;
        $token= s($_GET['token']);
        $user= Usuario::where('token',$token);
        
        if(empty($user)){
            Usuario::setAlerta('error','Token no válido');
            $error=true;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           
           $password= new Usuario($_POST);
           $alertas= $password->validarPassword();
           
           if(empty($alertas)){
                $user->password= "";
                $user->password= $password->password;
                $user->hashPassword();
                $user->token= "";
                $resultado= $user->guardar();
                if($resultado)
                {
                    header('Location: /');
                }
           }
           
        }

        $alertas= Usuario::getAlertas();
        $router->render('auth/recuperar',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    public static function crear(Router $router){

        $user= new Usuario;
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $user->sincronizar($_POST);
            $alertas= $user->validarCuenta();

            if(empty($alertas)){
                $resultado= $user->existeUser();
                if($resultado->num_rows){
                    $alertas= Usuario::getAlertas();
                }
                else{
                    $user->hashPassword();

                    $user->crearToken();
                    //Enviar el email
                    $email= new Email($user->email,$user->nombre,$user->token);

                    $email->enviarEmail();

                    $resultado= $user->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta',[
            'user' => $user,
            'alertas' => $alertas
        ]);
    }
    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }
    public static function confirmar(Router $router){
        $alertas= [];

        $token= s($_GET['token']);
        $resultado= Usuario::where('token',$token);
        if(empty($resultado)){
            Usuario::setAlerta('error','Token no válido');
        }
        else{
            $resultado->confirmado= "1";
            $resultado->token="";
            $resultado->guardar();
            Usuario::setAlerta('exito','Token válido, cuenta confirmada');
        }
        $alertas= Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}