<?php
include 'config.php';

function getMenu() {
    $menu = array(
        array("url" => "./MenuRest.php", "name" => "MENU"),
        array("url" => "contacto.php", "name" => "CONTACTO"),
        array("url" => "nosotros.php", "name" => "NOSOTROS"),
    );

    if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] != "") {
        $role_id = $_SESSION["Rol"];
        
        // Basado en el ID del rol, construye el menú
        switch ($role_id) {
            case 4: // Asumiendo 1 es Restaurante
                $menu[] = array("url" => "./infoPlatillos.php", "name" => "PLATILLOS");
                $menu[] = array("url" => "./PedidosRest.php", "name" => "PEDIDOS");
                $menu[] = array("url" => "./planilla.php", "name" => "PLANILLA");
                $menu[] = array("url" => "./MesasRest.php", "name" => "RESERVAS");
                break;
            
            case 3: // Asumiendo 2 es Proveedor
                $menu[] = array("url" => "productos.php", "name" => "PRODUCTOS");
                $menu[] = array("url" => "historial.php", "name" => "HISTORIAL");
                break;

            case 1: // Asumiendo 3 es Administrador
                $menu[] = array("url" => "./usuario.php", "name" => "USUARIOS");
                $menu[] = array("url" => "./RestaurantesAdmin.php", "name" => "RESTAURANTES");
                $menu[] = array("url" => "./EditarTablas.php", "name" => "TABLAS A EDITAR");
                break;

            case 2: // Asumiendo 4 es Usuario
            default:
                $menu[] = array("url" => "reservas.php", "name" => "RESERVAS");
                $menu[] = array("url" => "./carritoHTML.php", "name" => "CARRITO");
                $menu[] = array("url" => "./HistorialUser.php", "name" => "HISTORIAL");
                break;
        }

        $menu[] = array("url" => "./salir.php", "name" => "SALIR");
    } else {
        $menu[] = array("url" => "./inicio_sesion.php", "name" => "INICIAR SESIÓN");
    }

    return $menu;
}
?>
