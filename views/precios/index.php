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
                    <button type="button" data-toggle="modal" data-target="#agregar_precio" class="btn btn-warning">Registrar Precio&nbsp;&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                    <div class="modal fade" id="agregar_precio" tabindex="-1" aria-labelledby="agregar_precioLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="agregar_precioLabel">Registrar Precio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body agregar_precios_modal">

                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Tipo de Registro</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link disabled" style="display: none;" id="pills-tab-producto" data-toggle="pill" data-target="#pills-productos" type="button" role="tab" aria-controls="pills-productos" aria-selected="false" disabled>Seleccionar producto</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link disabled" style="display: none;" id="pills-tab-proveedor" data-toggle="pill" data-target="#pills-proveedores" type="button" role="tab" aria-controls="pills-proveedores" aria-selected="false" disabled>Seleccionar proveedor</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <h1>¿Como quieres registrar el precio?</h1>
                                            <div class="seccion_botones">
                                                <button id="registrar_por_producto">Por producto</button>
                                                <button id="registrar_por_proveedor">Por proveedor</button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-productos" role="tabpanel" aria-labelledby="pills-tab-producto">
                                            <h3>Selecciona tus productos para registrar sus precios.</h3>
                                            <form id="busqueda_exahustiva" method="GET">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Buscar producto..." aria-label="Buscar producto" id="search-input">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button"><i class="fas fa-filter"></i></button>
                                                    </div>
                                                </div>
                                            </form>

                                            <main class="container pt-3 contenedor_table_productos" style="display: none;">
                                                <div class="card mb-3">
                                                    <div class="card-header">Resultados de búsqueda de productos</div>
                                                    <div class="card-block p-0">
                                                        <table class="table table-bordered table-sm m-0" id="product-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccionar</th>
                                                                    <th>ID Producto</th>
                                                                    <th>Nombre de Producto</th>
                                                                    <th>Código de Barras</th>
                                                                    <th>Estatus</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Los resultados se agregarán aquí mediante AJAX -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </main>
                                            <main class="container pt-3">
                                                <div class="card mb-3">
                                                    <div class="card-header">Productos seleccionados</div>
                                                    <div class="card-block p-0">
                                                        <table class="table table-bordered table-sm m-0" id="product-selected-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccionar</th>
                                                                    <th>ID Producto</th>
                                                                    <th>Nombre de Producto</th>
                                                                    <th>Nombre de Proveedor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Los resultados se agregarán aquí mediante AJAX -->
                                                            </tbody>
                                                        </table>
                                                        <div id="provider-collapse" class="collapse mt-3">
                                                            <table id="provider-table" class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Seleccionar</th>
                                                                        <th>ID Proveedor</th>
                                                                        <th>Proveedor</th>
                                                                        <th>Estatus</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Los proveedores se agregarán aquí -->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </main>
                                        </div>
                                        <div class="tab-pane fade" id="pills-proveedores" role="tabpanel" aria-labelledby="pills-tab-proveedores">
                                            Proveedores
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("../includes/footer.php") ?>
    </div>
    <?php include("../includes/scripts.php"); ?>
    <script src="../assets/dist/js/registro_precios.js"></script>
</body>

</html>