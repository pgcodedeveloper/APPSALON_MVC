<h1 class="nombre-pagina">Panel de Administración</h1>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h2>Buscar Cita</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php 
    if(count($citas) === 0){
        echo "<h2>No hay Citas para esta fecha</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php 
        $idCita=0;
        foreach ($citas as $key =>$cita)
        { 
            if($idCita !== $cita->id) 
            { 
                $total= 0; ?>
            
        <li>
            <p>ID: <span><?php echo $cita->id;?></span></p>
            <p>Hora: <span><?php echo $cita->hora;?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente;?></span></p>
            <p>Email: <span><?php echo $cita->email;?></span></p>
            <p>Telefono: <span><?php echo $cita->telefono;?></span></p>

            <h3>Servicios</h3>
            <?php 
                $idCita= $cita->id;
            } 
                $total+= $cita->precio;
            ?>
            <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio;?></p>
            
            <?php 
                $actual= $cita->id;
                $proximo= $citas[$key + 1]->id ?? 0;
                if(esUltimo($actual, $proximo)){ ?>
                    <p class="total">Total a pagar: <span>$<?php echo $total;?></span></p>
                    <input type="submit" class="eliminarCita boton-eliminar" value="Eliminar Cita" id="<?php echo $cita->id; ?>">
            <?php }
        } ?>
    </ul>
</div>

<?php
    $script="
    <script src='build/js/buscador.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    ";
?>