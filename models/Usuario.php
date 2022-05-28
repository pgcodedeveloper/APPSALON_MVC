<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla= 'usuarios';
    protected static $columnasDB= ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args=[])
    {   
        $this->id= $args['id'] ?? null;
        $this->nombre= $args['nombre'] ?? "";
        $this->apellido= $args['apellido'] ?? "";
        $this->email= $args['email'] ?? "";
        $this->password= $args['password'] ?? "";
        $this->telefono= $args['telefono'] ?? "";
        $this->admin= $args['admin'] ?? '0';
        $this->confirmado= $args['confirmado'] ?? '0';
        $this->token= $args['token'] ?? "";
    }

    public function validarCuenta(){

        if(!$this->nombre){
            self::$alertas['error'][]="Debe ingresar un nombre";
        }
        if(!$this->apellido){
            self::$alertas['error'][]="Debe ingresar un apellido";
        }
        if(!$this->email){
            self::$alertas['error'][]="Debe ingresar un email";
        }
        if(!$this->password){
            self::$alertas['error'][]="Debe ingresar un password";
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][]="Debe ingresar un password mayor a 6 carácteres";
        }
        if(!$this->telefono){
            self::$alertas['error'][]="Debe ingresar un teléfono";
        }

        return self::$alertas;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][]="Debe ingresar un email";
        }
        if(!$this->password){
            self::$alertas['error'][]="Debe ingresar un password";
        }
        return self::$alertas;
    }
    public function existeUser(){
        $query= " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1 ";

        $resultado= self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas['error'][]= "El Usuario ya existe";
        }
        return $resultado;
    }

    public function hashPassword(){
        $this->password= password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token= uniqid(); 
    }

    public function verificarPasswordAndConfirmado($password){
        $resultado = password_verify($password,$this->password);
        if(!$resultado || !$this->confirmado){
            
            self::$alertas['error'][]= "El usuario no esta confirmado o el password no es correcto";
        }
        else{
            return true;
            
        }
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][]="Debe ingresar un email";
        }
        return self::$alertas;
    }
    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][]="Debe ingresar un password";
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][]="Debe ingresar un password mayor a 6 carácteres";
        }
        return self::$alertas;
    }
}