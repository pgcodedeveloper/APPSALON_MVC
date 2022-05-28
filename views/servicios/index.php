<h1 class="nombre-pagina">Servicios</h1>

<p class="descripcion-pagina">Administración de Servicios</p>

<?php include_once __DIR__ . '/../templates/barra.php';?>


<ul class="servicios">
    <?php foreach($servicios as $servicio){ ?>
        <li>
            <p>ID: <span id="id"><?php echo $servicio->id; ?></span></p>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span><?php echo $servicio->precio; ?></span></p>

            <div class="acciones-servicios">
                <input type="submit" id="<?php echo $servicio->id; ?>" class="boton-eliminar" value="Eliminar">
                <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>" class="boton-actualizar" >Actualizar</a>
            </div>   
        </li>
    <?php } ?>
</ul>


<?php
    $script="
    <script src='build/js/servicios.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    ";
?>