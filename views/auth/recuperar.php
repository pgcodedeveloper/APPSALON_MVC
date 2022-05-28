<h1 class="nombre-pagina">Reestablecer tu Password</h1>
<p class="descripcion-pagina">Ingrese su nuevo Password</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<?php if($error) return; ?>
<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Tu nuevo Password">
    </div>

    <input type="submit" class="boton" value="Reestablecer Password">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>