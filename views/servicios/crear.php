<h1 class="nombre-pagina">Crear nuevo Servicio</h1>

<p class="descripcion-pagina">Llene todos los campos</p>

<?php include_once __DIR__ . '/../templates/alertas.php'?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'?>
    <input type="submit" value="Guardar Servicio" class="boton">
</form>

<a href="/servicios" class="boton-volver">Volver</a>