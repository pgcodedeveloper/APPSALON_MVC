<div class="barra">
    <p>Bienvenid@: <span><?php echo $nombre; ?></span></p>
    <button class="boton cerrar-sesion">Cerrar Sesión</button>
</div>

<?php 
if(isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver Citas</a>
        <a class="boton" href="/servicios">Ver Servicios</a>
        <a class="boton" href="/servicios/crear">Nuevo Servicio</a>
    </div>
<?php } ?>
