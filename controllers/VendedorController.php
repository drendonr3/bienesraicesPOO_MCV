<?php 
namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public static function crear(Router $router){
        $vendedor = new Vendedor();
            // Arreglo con Mensajes de Errores
        $errores=Vendedor::getErrores();
        if ($_SERVER['REQUEST_METHOD']==='POST'){ 
            // Crea una nueva instancia 
            $vendedor= new vendedor($_POST['vendedor']);          
            $errores = $vendedor->validar();
            
            //Revisar el arreglo
            if (empty($errores)){
                //Guarda en la base de datos
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear',[
            'vendedor' => $vendedor,
            'errores' =>$errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin'); 
        $vendedor = Vendedor::find($id);

        $errores=Vendedor::getErrores();
        if ($_SERVER['REQUEST_METHOD']==='POST'){ 
            $args =$_POST['vendedor'];
            // Sincronizar con datos del usuario
            $vendedor->sincronizar($args);
            $errores = $vendedor->validar();
            //Revisar el arreglo
            if (empty($errores)){
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/actualizar',[
            'vendedor' => $vendedor,
            'errores' =>$errores
        ]);
    }
    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $idDelete = $_POST['id'];
            $idDelete = filter_var($idDelete,FILTER_VALIDATE_INT);
            if ($idDelete){
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($idDelete);
                    //Eliminar la propiedad
                    $vendedor->eliminar();
                }
            }
        }
    }
}