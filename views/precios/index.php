<?php
session_start();
if (empty($_SESSION['activa'])) {
    header("Location: ../../public/login.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<?php include("../includes/header.php"); ?>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <?php include("../includes/navbar.php") ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><i class="fas fa-list-alt"></i>&nbsp;&nbsp;Listado de Precios de Productos</h1>
                            <p>En esta sección se administrará todos los precios de los productos registrados en el sistema.</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo $root; ?>views/home.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Operaciones</li>
                                <li class="breadcrumb-item active">Registro de Precios</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            title: '¿Cómo desea consultar los precios?',
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: 'Por Producto',
                            denyButtonText: 'Por Proveedor',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?php echo $root; ?>views/precios/productos.php';
                            } else if (result.isDenied) {
                                window.location.href = '<?php echo $root; ?>views/precios/proveedores.php';
                            }
                        })
                    </script>
                </div>
            </div>
        </div>
        <?php include("../includes/footer.php") ?>
    </div>
    <?php include("../includes/scripts.php"); ?>
    <!--<script src="../assets/dist/js/registro_precios.js"></script>-->
</body>

</html>