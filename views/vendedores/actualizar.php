<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error){?>
            <div class="error alerta">
                <?php echo '' . $error;?>
            </div>
        <?php  }  ?>

        <form action="" class="formulario" method="POST">
            <?php include __DIR__ .'/formulario.php';?>
            <input type="submit" value="Guardar Cambios" class="boton-verde">
        </form>
    </main>
