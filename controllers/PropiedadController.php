<?php 
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado']?? null;
        $router->render('propiedades/admin',[
            'propiedades'=>$propiedades,
            'vendedores'=>$vendedores,
            'resultado' =>$resultado
        ]);
    }
    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
            // Arreglo con Mensajes de Errores
        $errores=Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD']==='POST'){ 
            // Crea una nueva instancia 
            $propiedad= new Propiedad($_POST['propiedad']);          
            //Crear carpeta
            $carpetaImagenes = '../../imagenes/';
            if (!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            //SUBIR IMAGEN
            $nombreImagen=md5(uniqid(rand(),true)). ".jpg";
            
            // Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen']);
                //$image->fit(800,600);

                //Setear Imagen
                $propiedad->setImagen($nombreImagen);
            }
            $errores = $propiedad->validar();
            
            //Revisar el arreglo
            if (empty($errores)){
                if (!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                //Guarda Imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                // move_uploaded_file($_FILES['imagen']['tmp_name'], CARPETA_IMAGENES . $nombreImagen);
                
                //Guarda en la base de datos
                $propiedad->guardar();

            }
        }

        $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' =>$errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin'); 
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        $errores=Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD']==='POST'){ 
            $args =$_POST['propiedad'];
            // Sincronizar con datos del usuario
            $propiedad->sincronizar($args);
            //SUBIR IMAGEN
            $nombreImagen=md5(uniqid(rand(),true)). ".jpg";
        
            // Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen']);
                //$image->fit(800,600);
                //Setear Imagen
                $propiedad->setImagen($nombreImagen);
            }
            //Validación        
            $errores = $propiedad->validar();

            //Revisar el arreglo
            if (empty($errores)){
                if ($_FILES['propiedad']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }
        $router->render('propiedades/actualizar',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' =>$errores
        ]);
    }
    public static function eliminar(Router $router){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $idDelete = $_POST['id'];
            $idDelete = filter_var($idDelete,FILTER_VALIDATE_INT);
            if ($idDelete){
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($idDelete);
                    //Eliminar la propiedad
                    $propiedad->eliminar();
                }
            }
        }
    }
}