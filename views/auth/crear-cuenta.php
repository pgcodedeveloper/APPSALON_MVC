<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form action="/crear-cuenta" class="formulario" method="POST">

    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php echo s($user->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" placeholder="Tu Apellido" value="<?php echo s($user->apellido); ?>">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Tu Teléfono" value="<?php echo s($user->telefono); ?>">
    </div>

    <div class="campo">
        <label for="email">E-Mail:</label>
        <input type="email" name="email" id="email" placeholder="Tu E-Mail" value="<?php echo s($user->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Clave:</label>
        <input type="password" name="password" id="password" placeholder="Tu Clave">
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>