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
                    <!--<button type="button" data-toggle="modal" data-target="#agregar_precio" class="btn btn-warning">Registrar Precio&nbsp;&nbsp;&nbsp;<i class="fas fa-plus"></i></button>-->
                    <!--<div class="modal fade" id="agregar_precio" tabindex="-1" aria-labelledby="agregar_precioLabel" aria-hidden="true">
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
                    </div>-->
                    <div class="consultar_producto" style="border-radius: 10px; padding: 10px;display: flex;align-items: center;justify-content: space-around;">
                        <div class="form-group" style="margin-bottom: 0;width: 24%;">
                            <label for="" class="form-label">Producto:</label>
                            <input type="text" name="producto_id" id="producto_id" class="form-control" style="cursor: pointer;" onclick="abrirModal();">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;width: 24%;">
                            <label for="" class="form-label">Nombre del producto:</label>
                            <input type="text" name="producto" id="producto" class="form-control">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;width: 24%;">
                            <label for="" class="form-label">Unidad de medida:</label>
                            <input type="text" name="unidad_medida" id="unidad_medida" class="form-control">
                        </div>
                        <div class="modal fade" id="listado_productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Seleccionar Producto</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="busqueda_exahustiva_productos" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Buscar producto..." aria-label="Buscar producto" id="search-input">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-filter"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <main class="pt-3 contenedor_table_productos_listado">
                                            <div class="card mb-3" style="height: auto;">
                                                <div class="card-header">Resultados de Busqueda</div>
                                                <div class="card-block p-0">
                                                    <table class="table table-bordered table-sm m-0" id="product-table">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Producto</th>
                                                                <th>Estatus</th>
                                                                <th>Seleccionar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;width: 24%;">
                            <label for="" class="form-label">Usuario:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" name="usuario" id="usuario" class="form-control">
                        </div>
                    </div>
                    <main class="pt-3 contenedor_table_productos">
                        <div class="card mb-3" style="height: 400px;">
                            <div class="card-header">Listado de precios por producto</div>
                            <div class="card-block p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm m-0" id="precios-table-listado">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th>Proveedor</th>
                                                <th>Nombre</th>
                                                <th>Precio Actual</th>
                                                <th>Fecha captura</th>
                                                <th>Usuario</th>
                                                <th>Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </main>
                    <div class="consultar_producto" style="border-radius: 10px; padding: 20px;">
                        <span style="margin-bottom: 10px;">Agregar proveedor</span>
                        <div class="row" style="margin-top: 10px;">
                            <div class=" col-12" style="display: flex; justify-content: space-around;">
                                <form id="agregarProveedor" style="width: 100%;">
                                    <div class="form-group" style="display: flex; justify-content: space-around;">
                                        <input type="hidden" name="producto_id_reg" id="producto_id_reg" class="form-control" placeholder="Producto">
                                        <div style="width: 19.7%;">
                                            <label for="" class="form-label">Proveedor: </label>
                                            <input type="text" name="proveedor_id" id="proveedor_id_reg" class="form-control" placeholder="Proveedor" style="cursor: pointer;" onclick="abrirModalProveedores()">
                                        </div>
                                        <div style="width: 19.7%;">
                                            <label for="" class="form-label">Nombre del proveedor:</label>
                                            <input type="text" name="proveedor" id="proveedor_reg" class="form-control" placeholder="Nombre del Proveedor">
                                        </div>
                                        <div style="width: 19.7%;">
                                            <label for="" class="form-label">Precio de costo:</label>
                                            <input type="text" name="precio" id="precio_reg" class="form-control" placeholder="Precio">
                                        </div>
                                        <div style="width: 19.7%;">
                                            <label for="" class="form-label">Fecha de Inicio:</label>
                                            <input type="date" name="fecha_inicio" id="fecha_inicio_reg" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                        </div>
                                        <div style="width: 19.7%;">
                                            <label for="" class="form-label">Fecha final:</label>
                                            <input type="date" name="fecha_final" id="fecha_final_reg" class="form-control">
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-warning" id="btn-add-precio" style="display: block;margin: auto;">Guardar Proveedor</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="listado_proveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Seleccionar Proveedor</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="busqueda_exahustiva_proveedor" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Buscar proveedor..." aria-label="Buscar producto" id="search-input-providers">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-filter"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <main class="pt-3 contenedor_table_productos_listado">
                                            <div class="card mb-3" style="height: auto;">
                                                <div class="card-header">Resultados de Busqueda</div>
                                                <div class="card-block p-0">
                                                    <table class="table table-bordered table-sm m-0" id="providers-table">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Proveedor</th>
                                                                <th>Estatus</th>
                                                                <th>Seleccionar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
    <script>
        function abrirModal() {
            $('#listado_productos').modal('show');
        }

        function abrirModalProveedores() {
            $('#listado_proveedores').modal('show');
        }


        $(document).ready(function() {
            // Mostrar todos los productos inicialmente
            loadAllProducts();
            loadAllProviders();

            $('#search-input').on('input', function() {
                var searchTerm = $(this).val();
                if (searchTerm.trim() === '') {
                    // Si el campo de búsqueda está vacío, mostrar todos los productos
                    loadAllProducts();
                } else {
                    // Si hay un término de búsqueda, realizar la búsqueda
                    searchProducts(searchTerm);
                }
            });

            $('#search-input-providers').on('input', function() {
                var searchTerm = $(this).val();
                if (searchTerm.trim() === '') {
                    // Si el campo de búsqueda está vacío, mostrar todos los productos
                    loadAllProviders();
                } else {
                    // Si hay un término de búsqueda, realizar la búsqueda
                    searchProviders(searchTerm);
                }
            });

            function loadAllProducts() {
                $.ajax({
                    url: '../../controllers/precios/PreciosController.php',
                    type: 'GET',
                    data: {
                        listado: 'productos'
                    },
                    success: function(data) {
                        $('#product-table tbody').html(data);
                    }
                });
            }

            function loadAllProviders() {
                $.ajax({
                    url: '../../controllers/precios/PreciosController.php',
                    type: 'GET',
                    data: {
                        listado: 'proveedores'
                    },
                    success: function(data) {
                        $('#providers-table tbody').html(data);
                    }
                });
            }

            function searchProviders(searchTerm) {
                $.ajax({
                    url: '../../controllers/precios/PreciosController.php',
                    type: 'GET',
                    data: {
                        search_proveedores: searchTerm,
                        busqueda: 'proveedores' // Agregar el tipo de búsqueda
                    },
                    success: function(data) {
                        $('#providers-table tbody').html(data);
                    }
                });
            }

            function searchProducts(searchTerm) {
                $.ajax({
                    url: '../../controllers/precios/PreciosController.php',
                    type: 'GET',
                    data: {
                        search: searchTerm,
                        busqueda: 'productos' // Agregar el tipo de búsqueda
                    },
                    success: function(data) {
                        $('#product-table tbody').html(data); // Corregido para productos
                    }
                });
            }

        });
    </script>
    <script>
        // Espera a que el DOM se cargue completamente
        $(document).ready(function() {
            // Detecta el cambio en cualquier checkbox con clase .custom-control-input
            $(document).on('change', '.check-producto', function() {
                if ($(this).is(":checked")) {
                    // Obtiene el id_producto desde el atributo data-id-producto
                    var idProducto = $(this).data('id-producto');



                    // Realiza la llamada AJAX al controlador
                    $.ajax({
                        url: '../../controllers/precios/PreciosController.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id_producto: idProducto
                        },
                        success: function(producto) {
                            listarPreciosProductos(idProducto);
                            $("#producto_id").val(producto.id_producto);
                            $("#producto").val(producto.producto);
                            $("#unidad_medida").val(producto.unidad_medida);
                            $("#usuario").val(producto.usuario);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en la petición AJAX: " + error);
                        }
                    });

                    // Cierra el modal con id "listado_productos"
                    $("#listado_productos").modal('hide');
                }
            });

            function listarPreciosProductos(idProducto) {
                console.log(idProducto);
                $.ajax({
                    url: '../../controllers/precios/PreciosController.php',
                    type: 'GET',
                    dataType: 'html', // Le indicas a jQuery que espere HTML
                    data: {
                        id_producto: idProducto,
                        listado: 'precios_productos'
                    },
                    success: function(data) {
                        //console.log(data);
                        document.getElementById('producto_id_reg').value = idProducto;
                        $('#precios-table-listado tbody').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la petición AJAX de listado de precios: " + error);
                    }
                });

            }
            $(document).on('change', '.check-proveedores', function() {
                if ($(this).is(":checked")) {
                    // Obtiene el id_producto desde el atributo data-id-producto
                    var idProveedor = $(this).data('id-proveedor');

                    // Realiza la llamada AJAX al controlador
                    $.ajax({
                        url: '../../controllers/precios/PreciosController.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id_proveedor: idProveedor
                        },
                        success: function(proveedor) {
                            $("#proveedor_id_reg").val(proveedor.id_proveedor);
                            $("#proveedor_reg").val(proveedor.nombre);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en la petición AJAX: " + error);
                        }
                    });

                    // Cierra el modal con id "listado_productos"
                    $("#listado_proveedores").modal('hide');
                }
            });
        });

        document.getElementById('btn-add-precio').addEventListener('click', function() {
            var productoId = document.getElementById('producto_id_reg').value;
            var proveedorId = document.getElementById('proveedor_id_reg').value;
            var precio = document.getElementById('precio_reg').value;
            var fechaInicio = document.getElementById('fecha_inicio_reg').value;
            var fechaFinal = document.getElementById('fecha_final_reg').value;
            console.log({
                productoId,
                proveedorId,
                precio,
                fechaInicio,
                fechaFinal
            });
            $.ajax({
                url: '../../controllers/precios/PreciosController.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    productoId: productoId,
                    proveedorId: proveedorId,
                    precio: precio,
                    fechaInicio: fechaInicio,
                    fechaFinal: fechaFinal,
                    usuarioId: <?php echo $_SESSION['usuario_id'] ?>
                },
                success: function(data) {
                    listarPreciosProductosAdd(productoId);
                },
                error: function(xhr, status, error) {
                    console.error("Status: " + status);
                    console.error("Error: " + error);
                    console.error("Response: " + xhr.responseText);
                }
            });
        });

        function listarPreciosProductosAdd(idProducto) {
            console.log(idProducto);
            $.ajax({
                url: '../../controllers/precios/PreciosController.php',
                type: 'GET',
                dataType: 'html', // Le indicas a jQuery que espere HTML
                data: {
                    id_producto: idProducto,
                    listado: 'precios_productos'
                },
                success: function(data) {
                    //console.log(data);
                    document.getElementById('producto_id_reg').value = idProducto;
                    $('#precios-table-listado tbody').html(data);
                    document.getElementById('agregarProveedor').reset();
                },
                error: function(xhr, status, error) {
                    console.error("Error en la petición AJAX de listado de precios: " + error);
                }
            });

        }
    </script>

</body>

</html>