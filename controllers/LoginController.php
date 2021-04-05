<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController{
    public static function login(Router $router){
        $errores = [];
        $auth = new Admin;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Admin($_POST);
            $errores = $auth->validar();
            if (empty($errores)){
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if (!$resultado){
                    $errores = Admin::getErrores();
                } else {
                // Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if ($autenticado){
                        $auth->autenticar(); 
                    } else {
                        $errores = Admin::getErrores(); 
                    }
                //Autenticar al usuario
                }
            }
        }

        $router->render('auth/login',[
            'errores' => $errores,
            'auth' => $auth
        ]);
    }
    public static function logout(){
        session_start();
        $_SESSION = [];
        header('location: /');
    }


}