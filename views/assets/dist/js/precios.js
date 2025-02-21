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

let precios_productos = [];

//busqueda en tiempo real de productos
$(document).ready(function () {
    $('#search-input').on('input', function () {
        var query = $(this).val();

        if (query.length > 0) {
            $('.table-section').show(); // Cambia a display block
        } else {
            $('.table-section').hide(); // Oculta si no hay texto
        }

        $.ajax({
            url: 'http://localhost/controlpedidos.mercadoinsurgente.com/controllers/productos/buscar_productos.php',
            method: 'POST',
            data: { search: query },
            success: function (data) {
                $('#results-body').html(data);
            }
        });
    });

    // Manejar el clic en el botón de selección
    $(document).on('click', '.select-product', function () {
        var idProducto = $(this).data('id');
        var nombreProducto = $(this).data('nombre');

        // Agregar el producto a la tabla de productos seleccionados
        $('#productos_seleccionados tbody').append(`
            <tr>
                <td>${idProducto}</td>
                <td>${nombreProducto}</td>
                <td class="text-center"><input type="checkbox" checked></td>
                <td>
                    <button type="button" data-toggle="collapse" data-target="#collapseExample${idProducto}" aria-expanded="false" aria-controls="collapseExample${idProducto}">Seleccionar proveedor</button>
                </td>
            </tr>
            <tr class="collapse" id="collapseExample${idProducto}">
                <td colspan="4">
                    <table class="table">
                        <tbody>
                            <!-- Aquí se generará la lista de proveedores -->
                        </tbody>
                    </table>
                </td>
            </tr>
        `);

        // Obtener la lista de proveedores para el producto seleccionado
        $.ajax({
            url: 'http://localhost/controlpedidos.mercadoinsurgente.com/controllers/proveedores/obtener_proveedores.php',
            method: 'GET',
            success: function (data) {
                var proveedores = JSON.parse(data);
                var proveedoresHtml = '';
        
                proveedores.forEach(function (proveedor, index) {
                    proveedoresHtml += `
                        <tr>
                            <td>${proveedor.id_proveedor}</td>
                            <td>${proveedor.nombre}</td>
                        </tr>
                    `;
                });
        
                $('#proveedores_tabla tbody').html(proveedoresHtml);
            }
        });
        
    });

});


