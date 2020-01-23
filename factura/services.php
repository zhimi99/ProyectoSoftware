<?php
    $tipo = "N";
    require_once($_SERVER['DOCUMENT_ROOT'].'/utils/verificarLogeo.php');
    if(isset($_POST['accion'])){
        switch($_POST['accion']){
            case "get":
                if(isset($_SESSION['carrito'])){
                    echo $_SESSION['carrito']['cant'];
                }else{
                    echo '0';
                }
            break;
            case "delete":
            if(isset($_POST['id']) && isset($_SESSION['carrito'])){
                $carrito = $_SESSION['carrito'];
                $cant = $carrito['productos']['"'.$_POST['id'].'"'];
                $carrito['cant'] -= $cant;
                unset($carrito['productos']['"'.$_POST['id'].'"']);
                $_SESSION['carrito'] = $carrito;
            }
            break;
            case "listC":
                if(isset($_SESSION['carrito'])){
                    $productos = $_SESSION['carrito']['productos'];
                    $ids_prod = str_replace('"','',"(".implode(",",array_keys($productos)).")");
                    $sql= "SELECT id, nombre, precio, imagen FROM producto WHERE id in ".$ids_prod.";";
                    $result= mysqli_query($conn, $sql); 
                    echo '[';                  
                    while($fila=mysqli_fetch_assoc($result)){      
                        echo '{';
                        echo  '"id":"'.$fila['id'].'",';
                        echo  '"nombre":"'.$fila['nombre'].'",';
                        echo  '"precio":'.$fila['precio'].',';
                        echo  '"cantidad":'.$productos['"'.$fila['id'].'"'].',';
                        echo  '"imagen":"data:image/png;base64,'.base64_encode($fila['imagen']).'"';
                        echo '},';
                    }
                }else{
                    echo '[]';
                }
            break;
            case "compra":
            if(isset($_POST['id_targ']) && isset($_POST['id_user']) && 
               isset($_POST['total']) && isset($_POST['detalle'])){
                // desavilito el autocommit 
                $conn->autocommit(FALSE);

                // realiza el insert de la factura
                $sql = "INSERT INTO factura (id_usuario, id_tarjeta, fecha, total)
                        VALUES (".$_POST['id_user'].",".$_POST['id_targ'].",now(),".$_POST['total'].");";
                // verifica que el sql se haya ejecutado correctamente
                if ($conn->query($sql) === TRUE) {
                    $id_fac =  $conn->insert_id;
                    foreach ($_POST['detalle'] as $item) {
                        // realiza el insert del detalle
                        $sql = "INSERT INTO detalle (id_producto, id_factura, cantidad, total)
                                VALUES (".$item['id'].",".$id_fac.",".$item['cantidad'].",".$item['total'].");";
                        // verifica que el sql se haya ejecutado correctamente
                        if ($conn->query($sql) !== TRUE) {
                            echo 'ERROR AL GRABAR LA COMPRA';
                            $conn->rollback();
                            $conn->close();
                            exit;
                        }
                    }
                    $conn->commit();
                    unset($_SESSION['carrito']);
                }else{
                    echo 'ERROR AL GRABAR LA COMPRA';
                    $conn->rollback();
                }
            }
            break;
            case "user_data":
                // recupera el id del usuario logeado
                $user = $_SESSION['user_session'];
                // recupera los datos del usuario
                $sql= "SELECT id, nombre, apellido, correo
                       FROM usuario WHERE id=".$user['id'].";";
                $result= mysqli_query($conn, $sql);                    
                echo '{';
                while($fila=mysqli_fetch_assoc($result)){      
                    echo  '"id":"'.$fila['id'].'",';
                    echo  '"nombres":"'.$fila['apellido'].' '.$fila['nombre'].'",';
                    echo  '"correo":"'.$fila['correo'].'"';
                }
                // recupera las tarjetas asosiadas al usaurio
                $sql= "SELECT id, CONCAT( 'VISA',' ', LPAD(SUBSTRING(numero, -4), 15, '*')) AS numero
                       FROM tarjeta 
                       WHERE id_usuario=".$user['id'].";";
                $result= mysqli_query($conn, $sql); 
                if ($result) {
                    echo ',"tarjetas":'.json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC)); 
                }else{
                    echo ',"tarjetas": []';
                }
                echo '}';
            break;
            default:
                echo 'No existe el metodo solicitado';
        }
        $conn->close();
        exit;
    }   
?>

