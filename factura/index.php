<?php
    $tipo = "N";
    require_once($_SERVER['DOCUMENT_ROOT'].'/utils/verificarLogeo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FACTURACION</title>
    <?php 
        include '../../head.php';
    ?>
    <link type="text/css" rel="stylesheet" href="/static/css/facturacion/style.css">
</head>
<body>
    
    <?php 
    // inportar el head
        include '../nav.php';
    ?>

<main>
        <div id="fromListaProductos" class="content">
            <div v-show="cargando" class="progress">
                <div class="indeterminate"></div>
            </div>
            <table class="highlight tableBodyScroll">
                <thead id="tablaProducto">
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th style="width: 92px;">Item</th>
                        <th>Descripcion</th>
                        <th style="width: 150px;">Cantidad</th>
                        <th style="width: 150px;">Precio</th>
                        <th style="width: 150px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-show="!cargando" v-for="(item, index) in listaProductos">
                        <td class="boder" style="width: 35px;">
                            <i class="large material-icons" v-on:click="eliminar(item.id, $event)">delete</i>
                        </td>
                        <td class="boder" style="width: 50px;">{{ index+1 }}</td>
                        <td class="boder" ><img v-bind:src="item.imagen"></td>
                        <td class="boder detalle">{{ item.nombre }}</td>
                        <td class="boder">{{ item.cantidad }}</td>
                        <td class="boder">{{ item.precio }}</td>
                        <td>$ {{ item.subtotal }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="row total-detail">
                <a class="button waves-effect btn-flat" v-on:click="aceptar(listaProductos.length, formatPrice(total) )"> COMPLETAR COMPRA </a>
                <span> $ {{formatPrice(total)}}</span>
                <label> TOTAL </label>
            </div>
        </div>

        <?php 
            // inportar el modal eliminar
            require_once($_SERVER['DOCUMENT_ROOT'].'/utils/eliminar.php');
            // inportar el modal crear - editar libros
            
	        include 'modalFacturacion.php';
        ?>
    </main>

</body>

<?php 
    // inportar los script
    include '../../script.php';
?>  
<!-- incorporar los scripts de ventas -->
<script type="text/javascript" src="/static/js/factura/main.js"></script>
<script type="text/javascript" src="/static/js/factura/rest.js"></script>
</html>