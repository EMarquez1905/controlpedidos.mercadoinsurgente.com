document.addEventListener('keydown', function (event) {
    if (event.key === 'F1') {
        event.preventDefault();
        const modal = $('#agregar_precio');

        if (modal.is(':visible')) {
            modal.modal('hide');
        } else {
            modal.modal('show');
        }
    }
});


document.getElementById('registrar_por_producto').addEventListener('click', function () {
    // Habilitar el segundo tab
    var profileTab = document.getElementById('pills-tab-producto');
    profileTab.style.display = 'flex';
    profileTab.classList.remove('disabled');
    profileTab.removeAttribute('disabled');
});

document.getElementById('registrar_por_proveedor').addEventListener('click', function () {
    var profileTab = document.getElementById('pills-tab-proveedor');
    profileTab.style.display = 'flex';
    profileTab.classList.remove('disabled');
    profileTab.removeAttribute('disabled');
});


$(document).ready(function () {
    const selectedProducts = []; // Array para almacenar productos seleccionados

    $('#search-input').on('keyup', function () {
        const searchTerm = $(this).val();

        if (searchTerm.trim() === '') {
            $('.contenedor_table_productos').hide();
            $('#product-table tbody').html('');
            return;
        }

        $.ajax({
            url: 'http://localhost/controlpedidos.mercadoinsurgente.com/controllers/productos/search.php',
            type: 'GET',
            data: { search: searchTerm },
            dataType: 'json',
            success: function (data) {
                let rows = '';
                if (data.length > 0) {
                    data.forEach(function (producto) {
                        rows += `
                            <tr>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" data-id="${producto.id_producto}" ${selectedProducts.includes(producto.id_producto) ? 'checked' : ''}>
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                                <td class="text-center">${producto.id_producto}</td>
                                <td>${producto.producto}</td>
                                <td>${producto.codigo_barras}</td>
                                <td>${producto.estatus}</td>
                            </tr>
                        `;
                    });
                    $('.contenedor_table_productos').show();
                } else {
                    rows = '<tr><td colspan="5" class="text-center">No se encontraron productos</td></tr>';
                }
                $('#product-table tbody').html(rows);
                updateSelectedProducts(); // Actualizar productos seleccionados al cargar
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                console.error('Detalles:', jqXHR.responseText);
            }
        });
    });

    // Manejar el cambio de estado de los checkboxes
    $(document).on('change', '.custom-control-input', function () {
        const productId = $(this).data('id');
        if ($(this).is(':checked')) {
            selectedProducts.push(productId);
            fetchProductDetails(productId); // Llamar a la función para obtener detalles del producto
        } else {
            const index = selectedProducts.indexOf(productId);
            if (index > -1) {
                selectedProducts.splice(index, 1);
            }
            updateSelectedTable(); // Actualizar la tabla de seleccionados
        }
    });

    // Función para obtener detalles del producto por ID
    function fetchProductDetails(productId) {
        $.ajax({
            url: 'http://localhost/controlpedidos.mercadoinsurgente.com/controllers/productos/getProductDetails.php', // Cambia la URL según sea necesario
            type: 'GET',
            data: { id: productId },
            dataType: 'json',
            success: function (producto) {
                // Suponiendo que el objeto producto tiene las propiedades id_producto y nombre_proveedor
                addProductToSelectedTable(producto);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX para obtener detalles del producto:', textStatus, errorThrown);
                console.error('Detalles:', jqXHR.responseText);
            }
        });
    }

    // Función para agregar el producto a la tabla de seleccionados
    function addProductToSelectedTable(producto) {
        // Verificar si el producto ya está en la tabla
        const existingRow = $('#product-selected-table tbody tr').filter(function() {
            return $(this).find('.custom-control-input').data('id') === producto.id_producto;
        });
    
        if (existingRow.length > 0) {
            // Si el producto ya está en la tabla, no hacer nada
            return;
        }
    
        let selectedRows = '';
        selectedRows += `
            <tr>
                <td>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" data-id="${producto.id_producto}" checked>
                        <span class="custom-control-indicator"></span>
                    </label>
                </td>
                <td class="text-center">${producto.id_producto}</td>
                <td>${producto.producto}</td>
                <td>
                    ${producto.nombre ? producto.nombre : '<button class="btn btn-warning select-provider" data-product-id="' + producto.id_producto + '">Seleccionar proveedor</button>'}
                </td>
            </tr>
        `;
    
        $('#product-selected-table tbody').append(selectedRows);
    
        // Manejar el clic en el botón de seleccionar proveedor
        $('.select-provider').off('click').on('click', function () {
            const productId = $(this).data('product-id');
            fetchActiveProviders(productId);
        });
    }
    

    function fetchActiveProviders(productId) {
        $.ajax({
            url: 'http://localhost/controlpedidos.mercadoinsurgente.com/controllers/productos/getActiveProviders.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let providerRows = '';
                if (data.length > 0) {
                    data.forEach(function (proveedor) {
                        providerRows += `
                            <tr>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" data-id="${proveedor.id_proveedor}" data-nombre="${proveedor.id_proveedor}">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                                <td>${proveedor.id_proveedor}</td>
                                <td>${proveedor.nombre}</td>
                                <td>${proveedor.estatus}</td>
                            </tr>
                        `;
                    });
                } else {
                    providerRows = '<tr><td colspan="4" class="text-center">No se encontraron proveedores activos</td></tr>';
                }

                $('#provider-table tbody').html(providerRows);
                $('#provider-collapse').collapse('show'); // Mostrar el colapso

                // Manejar el clic en el checkbox de proveedor
                $('.custom-control-input').off('change').on('change', function () {
                    const proveedorId = $(this).data('id'); // Obtener el ID del proveedor
                    const proveedorNombre = $(this).data('nombre');

                    if ($(this).is(':checked')) {
                        // Preguntar al usuario si quiere asignar el proveedor
                        const confirmAssign = confirm(`¿Quieres asignar al proveedor ${proveedorNombre} al producto ${productId}?`);
                        if (confirmAssign) {
                            updateProductProvider(productId, proveedorId); // Llamar a la función para actualizar
                        } else {
                            $(this).prop('checked', false); // Desmarcar el checkbox si el usuario no confirma
                        }
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                $('#provider-table tbody').html('<tr><td colspan="4" class="text-center">Error al cargar proveedores</td></tr>');
            }
        });
    }

    function updateProductProvider(productId, proveedorId) {
        $.ajax({
            url: 'http://localhost/controlpedidos.mercadoinsurgente.com/controllers/productos/updateProductProvider.php',
            type: 'POST',
            data: {
                id_producto: productId,
                id_proveedor: proveedorId
            },
            success: function (response) {
                if (response.status === 'success') {

                    // Eliminar el producto anterior de la tabla de seleccionados
                    removeProductFromSelectedTable(productId);

                    // Agregar el nuevo producto a la tabla de seleccionados
                    fetchProductDetails(productId);

                    $('#provider-collapse').collapse('hide');
                } else {
                    alert('Error al asignar el proveedor. Inténtalo de nuevo.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX para actualizar el proveedor del producto:', textStatus, errorThrown);
                alert('Error al asignar el proveedor. Inténtalo de nuevo.');
            }
        });
    }


    function removeProductFromSelectedTable(productId) {
        // Buscar y eliminar la fila correspondiente al producto en la tabla de seleccionados
        $('#product-selected-table tbody tr').each(function () {
            const rowProductId = $(this).find('.custom-control-input').data('id');
            if (rowProductId === productId) {
                $(this).remove();
            }
        });
    }

    // Función para actualizar la tabla de productos seleccionados
    function updateSelectedTable() {
        $('#product-selected-table tbody').html(''); // Limpiar la tabla antes de actualizar
        selectedProducts.forEach(function (id) {
            fetchProductDetails(id); // Obtener detalles de cada producto seleccionado
        });
    }
});



