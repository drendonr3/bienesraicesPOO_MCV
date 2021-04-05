<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error){ ?>
            <div class="alerta error">
                <p><?php echo $error?></p>
            </div>
        <?php } ?>
        <form action="" class="formulario" method="POST" action='/login'>
        <fieldset>
                <legend>E-mail y Password</legend>
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu E-mail" id="email" name="email" require value="<?php echo $auth->email;?>">
                <label for="password">Pasword</label>
                <input type="password" placeholder="Contraseña" id="password" name="password" require>
            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
</main>