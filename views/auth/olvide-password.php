<h1 class="nombre-pagina">Olvide Mi Password</h1>
<p class="descripcion-pagina">Reestablece tu password ingresando tu email a continuacion</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form action="/olvide" method="POST" class="formulario">
    <div class="campo">
        <label for="email">E-Mail:</label>
        <input type="email" id="email" name="email" placeholder="Tu E-Mail">
    </div>

    <input type="submit" class="boton" value="Enviar Instrucciones">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>