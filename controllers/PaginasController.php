<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $router->render('paginas/index',[
            'propiedades'=> $propiedades,
            'inicio' => true
        ]);
    }
    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render('paginas/anuncios',[
            'propiedades'=> $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar('propiedades');
        $propiedad = Propiedad::find($id);
        $router->render('paginas/anuncio',[
            'propiedad'=> $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router){
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $mensaje=null;
            $respuestas = $_POST['contacto'];

            // Crear una instancia de PHPmailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username='c55393b9076601';
            $mail->Password='80fe28dc8c9a86';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del mail
            $mail->setFrom('admin@bienesracices.com');
            $mail->addAddress('daniel.rendon@assis.com.co');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir Contenido
            $contenido= '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            foreach($respuestas as $key => $value){
                $contenido .= '<p>' .$key .': ' .  $value .'</p>';
            }
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Eso es texto alternativo sin HTML';
            // Enviar el email
            if ($mail ->send()) {
                $mensaje = 'Mensaje enviado Correctamente';
            } else {
                $mensaje = 'El mensaje no se pudo enviar...';
            }
        }
        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }
}