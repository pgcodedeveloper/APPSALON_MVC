<h1 class="nombre-pagina">Actualizar Servicio</h1>

<p class="descripcion-pagina">Modifique los campos</p>

<?php include_once __DIR__ . '/../templates/alertas.php'?>

<form method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'?>
    <input type="submit" value="Actualizar Servicio" class="boton">
</form>

<a href="/servicios" class="boton-volver">Vorver</a>