<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <?php foreach($errores as $error){?>
        <div class="error alerta">
            <?php echo '' . $error;?>
        </div>
    <?php  }  ?>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <form class="formulario" method="POST">
        <?php include __DIR__ . '/formulario.php';?>
        <input type="submit" value="Registrar Vendedor(a)" class="boton-verde">
    </form>
</main>