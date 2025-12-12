<div class="fade-in-up">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Nueva Venta</h1>
                    <p class="header-subtitle text-muted mb-0">
                        Selecciona los libros que el cliente va a comprar.
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="date-badge bg-white shadow-sm rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2">
                        <i class="fas fa-calendar-alt text-primary"></i>
                        <span class="fw-medium text-secondary" id="currentDate"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Carrito de Venta</h3>
                            <button type="button"
                                    class="btn btn-success ms-auto"
                                    id="btnAbrirBuscarLibro">
                                <i class="fas fa-search"></i> Buscar y Agregar Libro
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle" id="tablaCarrito">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Libro</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Cantidad</th>
                                            <th>Desc. (S/)</th>
                                            <th>Subtotal</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4 offset-md-8">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <strong id="carrito_subtotal_text">S/ 0.00</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Descuento total:</span>
                                        <strong id="carrito_desc_total_text">S/ 0.00</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Total:</span>
                                        <strong id="carrito_total_text">S/ 0.00</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Datos del Cliente</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="cv_documento" class="form-label">Documento (DNI/RUC)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cv_documento">
                                    <button class="btn btn-primary" type="button" id="btnBuscarCliente">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="cv_nombre" class="form-label">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="cv_nombre" readonly>
                            </div>
                            <input type="hidden" id="cv_id_cliente">
                            <small class="text-muted">
                                Si el cliente no existe, se consultará la API y se registrará automáticamente.
                            </small>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Comprobante</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="cv_tipo_comprobante" class="form-label">Tipo de Comprobante</label>
                                <select class="form-select" id="cv_tipo_comprobante">
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cv_numero_comprobante" class="form-label">N° de Documento</label>
                                <input type="text" class="form-control" id="cv_numero_comprobante" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Resumen de Pago</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="rp_forma_pago" class="form-label">Forma de pago</label>
                                <select id="rp_forma_pago" class="form-select">
                                    <option value="1" selected>Contado</option>
                                    <option value="2">Crédito (cuotas)</option>
                                </select>
                            </div>

                            <div class="mb-3 d-flex justify-content-between">
                                <span>Total de la venta:</span>
                                <strong id="rp_total_text">S/ 0.00</strong>
                            </div>

                            <button type="button" class="btn btn-primary w-100" id="btnRegistrarVentaVisual">
                                <i class="fas fa-save"></i> Registrar Venta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL BUSCAR LIBRO -->
<div class="modal fade" id="modalBuscarLibro" tabindex="-1" aria-labelledby="modalBuscarLibroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalBuscarLibroLabel">Buscar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <table id="tablaLibrosVenta" class="table hover order-column" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Autor</th>
                            <th>Stock</th>
                            <th>Precio Venta</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCuotas" tabindex="-1" aria-labelledby="modalCuotasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalCuotasLabel">
                    Plan de cuotas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Total de la venta</label>
                        <input type="text" class="form-control" id="cq_total_venta" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Pago inicial</label>
                        <input type="number" min="0" step="0.01" class="form-control" id="cq_pago_inicial" value="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Monto a financiar</label>
                        <input type="text" class="form-control" id="cq_monto_financiar" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Número de cuotas</label>
                        <input type="number" min="1" class="form-control" id="cq_num_cuotas" value="3">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Periodicidad</label>
                        <select id="cq_periodicidad" class="form-select">
                            <option value="mensual" selected>Mensual</option>
                            <option value="quincenal">Quincenal</option>
                            <option value="semanal">Semanal</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha primera cuota</label>
                        <input type="date" class="form-control" id="cq_fecha_inicial">
                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary mb-3" id="btnGenerarCuotas">
                    Generar cuotas
                </button>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Fecha vencimiento</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody id="cq_tbody">
                            
                        </tbody>
                    </table>
                </div>

                <div class="text-end">
                    <small>Total cuotas: <strong id="cq_total_cuotas">S/ 0.00</strong></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmarCuotas">Usar estas cuotas</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

    // FECHA
    const options = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
    document.getElementById('currentDate').textContent =
        new Date().toLocaleDateString('es-ES', options);

    function mostrarMensaje(tipo, texto) {
        Swal.fire({
            toast: true,
            position: "bottom-end",
            icon: tipo,
            title: texto,
            showConfirmButton: false,
            timer: 3000
        });
    }

    // DATATABLE DE LIBROS ACTIVOS EN MODAL
    var tablaLibrosVenta = $('#tablaLibrosVenta').DataTable({
        "ajax": {
            "url": "./controllers/librosController.php?accion=listarLibrosActivos",
            "dataSrc": function(json){
                return json.filter(function(it){ return parseInt(it.estado) === 1; });
            }
        },
        "columns": [
            { "data": "id_libro" },
            { "data": "nombre" },
            { "data": "categoria" },
            { "data": "autor" },
            { "data": "stock" },
            { 
                "data": "precio_venta",
                "render": function(d){ return 'S/ ' + parseFloat(d).toFixed(2); }
            },
            {
                "data": null,
                "defaultContent": `
                    <button class="btn btn-success btn-sm btn-agregar-libro">
                        <i class="fas fa-cart-plus"></i> Agregar
                    </button>
                `
            }
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });

    // ABRIR MODAL BUSCAR LIBRO
    $('#btnAbrirBuscarLibro').on('click', function(){
        $('#modalBuscarLibro').modal('show');
        tablaLibrosVenta.ajax.reload();
    });

    // CARRITO
    let carrito = [];

    function recomputeItem(index){
        const it = carrito[index];
        const bruto = it.precio * it.cantidad;
        if (it.desc_monto < 0) it.desc_monto = 0;
        if (it.desc_monto > bruto) it.desc_monto = bruto;
        it.subtotal = bruto - it.desc_monto;
    }

    function renderCarrito(){
        const tbody = $('#tablaCarrito tbody');
        tbody.empty();

        let subtotal = 0;
        let descTotal = 0;

        carrito.forEach(function(it, idx){
            subtotal += it.subtotal;
            descTotal += it.desc_monto;

            const tr = `
                <tr>
                    <td>${it.nombre}</td>
                    <td>S/ ${it.precio.toFixed(2)}</td>
                    <td>${it.stock}</td>
                    <td>
                        <input type="number" min="1"
                            class="form-control form-control-sm input-cant"
                            data-index="${idx}" value="${it.cantidad}">
                    </td>
                    <td>
                        <input type="number" min="0" step="0.01"
                            class="form-control form-control-sm input-desc"
                            data-index="${idx}" value="${it.desc_monto.toFixed(2)}">
                    </td>
                    <td class="text-end">S/ ${it.subtotal.toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btn-quitar"
                                data-index="${idx}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(tr);
        });

        const total = subtotal;

        $('#carrito_subtotal_text').text('S/ ' + subtotal.toFixed(2));
        $('#carrito_desc_total_text').text('S/ ' + descTotal.toFixed(2));
        $('#carrito_total_text').text('S/ ' + total.toFixed(2));

        $('#rp_total_text').text('S/ ' + total.toFixed(2));
        actualizarVuelto();
    }

    // AGREGAR LIBRO DESDE EL DATATABLE AL CARRITO
    $('#tablaLibrosVenta tbody').on('click', '.btn-agregar-libro', function(){
        const data = tablaLibrosVenta.row($(this).parents('tr')).data();

        const idxExistente = carrito.findIndex(function(it){ return it.id_libro == data.id_libro; });
        if (idxExistente >= 0) {
            const it = carrito[idxExistente];
            if (it.cantidad + 1 > it.stock) {
                mostrarMensaje('warning', 'No hay más stock disponible para este libro.');
            } else {
                it.cantidad += 1;
                recomputeItem(idxExistente);
                renderCarrito();
                mostrarMensaje('success', 'Cantidad actualizada en el carrito.');
            }
        } else {
            const item = {
                id_libro: data.id_libro,
                nombre: data.nombre,
                precio: parseFloat(data.precio_venta),
                stock:  parseInt(data.stock),
                cantidad: 1,
                desc_monto: 0,
                subtotal: 0
            };
            recomputeItem(carrito.push(item) - 1);
            renderCarrito();
            mostrarMensaje('success', 'Libro agregado al carrito.');
        }
    });

    // CAMBIOS DE CANTIDAD + DESCUENTO EN LA TABLA DEL CARRITO
    $('#tablaCarrito').on('input', '.input-cant, .input-desc', function(){
        const idx = $(this).data('index');
        const it  = carrito[idx];

        if ($(this).hasClass('input-cant')) {
            let val = parseInt($(this).val()) || 1;
            if (val < 1) val = 1;

            if (val > it.stock) {
                val = it.stock;
                mostrarMensaje('warning', 'Cantidad máxima permitida: ' + it.stock);
            }
            it.cantidad = val;
            $(this).val(val);
        } else {
            let val = parseFloat($(this).val()) || 0;
            if (val < 0) val = 0;
            it.desc_monto = val;
        }

        recomputeItem(idx);
        renderCarrito();
    });

    // QUITAR ÍTEM DEL CARRITO
    $('#tablaCarrito').on('click', '.btn-quitar', function(){
        const idx = $(this).data('index');
        carrito.splice(idx,1);
        renderCarrito();
    });

    // SELECCIÓN DE CLIENTE
    $('#btnBuscarCliente').on('click', function(){
        const doc = $('#cv_documento').val().trim();
        if (!doc) {
            mostrarMensaje('warning', 'Ingrese un número de documento.');
            return;
        }

        Swal.fire({
            title: 'Buscando cliente...',
            text: 'Verificando en base de datos y API.',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: './controllers/clientesController.php',
            type: 'GET',
            dataType: 'json',
            data: {
                accion: 'buscarOCrearClientePorDocumento',
                documento: doc
            },
            success: function(res){
                Swal.close();

                if (!res.success) {
                    mostrarMensaje('error', res.message || 'No se pudo obtener el cliente.');
                    $('#cv_id_cliente').val('');
                    $('#cv_nombre').val('');
                    return;
                }

                const cli = res.cliente;
                $('#cv_id_cliente').val(cli.id_cliente);
                $('#cv_nombre').val(cli.nombre);

                if (res.origen === 'bd') {
                    mostrarMensaje('success', 'Cliente encontrado en la base de datos.');
                } else if (res.origen === 'api') {
                    mostrarMensaje('success', 'Cliente creado a partir de la API.');
                } else {
                    mostrarMensaje('success', 'Cliente seleccionado.');
                }

                aplicarReglasComprobantePorDocumento();
            },
            error: function(){
                Swal.close();
                mostrarMensaje('error', 'Error al buscar el cliente.');
            }
        });
    });

    function obtenerTotalCarrito() {
        let total = 0;
        carrito.forEach(function(it){ total += it.subtotal; });
        return total;
    }

    function actualizarVuelto() {
        const total = obtenerTotalCarrito();
        let pagado = parseFloat($('#rp_pagado').val()) || 0;
        if (pagado < 0) pagado = 0;

        let vuelto = pagado - total;
        if (vuelto < 0) vuelto = 0;

        $('#rp_vuelto_text').text('S/ ' + vuelto.toFixed(2));
    }

    $('#rp_pagado').on('input', function(){
        actualizarVuelto();
    });

    // CARGAR TIPOS DE COMPROBANTE ACTIVOS EN EL SELECT
    function cargarTiposComprobante() {
        $.ajax({
            url: './controllers/tiposComprobanteController.php',
            type: 'GET',
            dataType: 'json',
            data: { accion: 'listarTiposActivos' },
            success: function(res){
                const $sel = $('#cv_tipo_comprobante');
                $sel.empty();

                if (!Array.isArray(res) || res.length === 0) {
                    $sel.append('<option value="">Sin tipos disponibles</option>');
                    $('#cv_numero_comprobante').val('');
                    return;
                }

                res.forEach(function(tc){
                    const opt = $('<option>')
                        .val(tc.id_tipo)
                        .text(tc.nombre + ' (' + tc.serie + ')')
                        .attr('data-serie', tc.serie);
                    $sel.append(opt);
                });

                aplicarReglasComprobantePorDocumento();
                generarNumeroComprobante();
            },
            error: function(){
                mostrarMensaje('error', 'No se pudieron cargar los tipos de comprobante.');
            }
        });
    }

    // GENERAR NÚMERO COMPROBANTE
    function generarNumeroComprobante() {
        const id_tipo = $('#cv_tipo_comprobante').val();
        if (!id_tipo) {
            $('#cv_numero_comprobante').val('');
            return;
        }

        $.ajax({
            url: './controllers/tiposComprobanteController.php',
            type: 'GET',
            dataType: 'json',
            data: {
                accion: 'obtenerSiguienteNumeroVisual',
                id_tipo: id_tipo
            },
            success: function(res){
                if (!res.success || !res.data) {
                    mostrarMensaje('error', res.message || 'No se pudo obtener el número de comprobante.');
                    $('#cv_numero_comprobante').val('');
                    return;
                }
                $('#cv_numero_comprobante').val(res.data.formato);
            },
            error: function(){
                mostrarMensaje('error', 'Error al obtener el número de comprobante.');
            }
        });
    }

    // CAMBIAR NÚMERO CUANDO CAMBIE EL TIPO
    $('#cv_tipo_comprobante').on('change', function(){
        generarNumeroComprobante();
    });

    // LLAMAR AL CARGAR LA PÁGINA
    cargarTiposComprobante();

    function aplicarReglasComprobantePorDocumento() {
        const doc = $('#cv_documento').val().trim();
        const len = doc.length;

        const $sel = $('#cv_tipo_comprobante');

        $sel.find('option').prop('disabled', false).show();

        if (!doc) {
            return;
        }

        if (len === 8) {
            $sel.find('option').each(function(){
                const idTipo = $(this).val();
                if (idTipo !== '1') {
                    $(this).prop('disabled', true).hide();
                }
            });
        } else if (len === 11) {
            $sel.find('option').each(function(){
                const idTipo = $(this).val();
                if (idTipo !== '2') {
                    $(this).prop('disabled', true).hide();
                }
            });
        } else {
            return;
        }

        if ($sel.find('option:selected').prop('disabled')) {
            const $firstEnabled = $sel.find('option:not(:disabled):first');
            if ($firstEnabled.length) {
                $sel.val($firstEnabled.val());
            }
        }

        generarNumeroComprobante();
    }

    // REGISTRAR VENTA
    $('#btnRegistrarVentaVisual').on('click', function(){

        if (carrito.length === 0) {
            mostrarMensaje('warning', 'Agrega al menos un libro al carrito.');
            return;
        }

        const idCliente = $('#cv_id_cliente').val();
        if (!idCliente) {
            mostrarMensaje('warning', 'Seleccione o registre un cliente primero.');
            return;
        }

        const idTipo = $('#cv_tipo_comprobante').val();
        if (!idTipo) {
            mostrarMensaje('warning', 'Seleccione un tipo de comprobante.');
            return;
        }

        const total = obtenerTotalCarrito();
        if (total <= 0) {
            mostrarMensaje('warning', 'El total de la venta debe ser mayor a 0.');
            return;
        }

        let subtotal = 0;
        let descTotal = 0;
        carrito.forEach(function(it){
            const bruto = it.precio * it.cantidad;
            subtotal   += bruto;
            descTotal  += it.desc_monto;
        });

        const formaPago = parseInt($('#rp_forma_pago').val() || '1', 10);

        let pagoInicial = 0;
        let cuotasParaEnviar = [];

        if (formaPago === 2) {
            if (!Array.isArray(cuotasSeleccionadas) || cuotasSeleccionadas.length === 0) {
                mostrarMensaje('warning', 'Define primero el plan de cuotas en el modal.');
                return;
            }

            pagoInicial = parseFloat($('#cq_pago_inicial').val()) || 0;
            if (pagoInicial < 0) pagoInicial = 0;
            if (pagoInicial > total) pagoInicial = total;

            let sumaCuotas = 0;
            cuotasSeleccionadas.forEach(c => sumaCuotas += c.monto);
            sumaCuotas = +sumaCuotas.toFixed(2);

            const montoFinanciarLocal = +(total - pagoInicial).toFixed(2);
            if (Math.abs(sumaCuotas - montoFinanciarLocal) > 0.01) {
                mostrarMensaje(
                    'warning',
                    'La suma de las cuotas (' + sumaCuotas.toFixed(2) +
                    ') debe ser igual al monto a financiar (' + montoFinanciarLocal.toFixed(2) + ').'
                );
                return;
            }

            cuotasParaEnviar = cuotasSeleccionadas.map(c => ({
                numero: c.numero,
                fecha:  c.fecha,
                monto:  c.monto
            }));
        } else {
            pagoInicial = total;
        }

        const itemsToSend = carrito.map(function(it){
            return {
                id_libro:   it.id_libro,
                cantidad:   it.cantidad,
                precio:     it.precio,
                desc_monto: it.desc_monto,
                subtotal:   it.subtotal
            };
        });

        Swal.fire({
            title: '¿Registrar venta?',
            text: 'Se guardará la venta y se actualizará el stock.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (!result.isConfirmed) return;

            const formData = new FormData();
            formData.append('accion', 'registrarVenta');
            formData.append('id_tipo', idTipo);
            formData.append('id_cliente', idCliente);
            formData.append('subtotal', subtotal.toFixed(2));
            formData.append('descuento_total', descTotal.toFixed(2));
            formData.append('total', total.toFixed(2));
            formData.append('observacion', '');

            formData.append('forma_pago', formaPago);
            formData.append('pago_inicial', pagoInicial.toFixed(2));

            if (formaPago === 2) {
                formData.append('cuotas', JSON.stringify(cuotasParaEnviar));
            }

            formData.append('items', JSON.stringify(itemsToSend));

            $.ajax({
                url: './controllers/ventasController.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(){
                    Swal.fire({
                        title: 'Guardando venta...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(res){
                    Swal.close();

                    if (!res.success) {
                        mostrarMensaje('error', res.message || 'No se pudo registrar la venta.');
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Venta registrada',
                        html: `
                            <p>N° Documento: <strong>${res.numero_doc || ''}</strong></p>
                            <p>Total: <strong>S/ ${total.toFixed(2)}</strong></p>
                        `
                    });

                    carrito = [];
                    renderCarrito();
                    $('#cv_documento').val('');
                    $('#cv_nombre').val('');
                    $('#cv_id_cliente').val('');
                    $('#rp_pagado').val('0');
                    $('#rp_vuelto_text').text('S/ 0.00');
                    $('#rp_forma_pago').val('1');
                    cuotasSeleccionadas = [];
                    generarNumeroComprobante();
                },
                error: function(){
                    Swal.close();
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        });
    });

    //CUOTAS
    let cuotasSeleccionadas = [];
    let totalVenta = 0;
    let montoFinanciar = 0;

    $('#rp_forma_pago').on('change', function(){
        const forma = $(this).val();
        if (forma === '2') {
            totalVenta = obtenerTotalCarrito();
            if (totalVenta <= 0) {
                mostrarMensaje('warning', 'Primero arma la venta (total > 0).');
                $(this).val('1');
                return;
            }

            $('#cq_total_venta').val('S/ ' + totalVenta.toFixed(2));
            $('#cq_pago_inicial').val(0);
            montoFinanciar = totalVenta;
            $('#cq_monto_financiar').val('S/ ' + montoFinanciar.toFixed(2));

            $('#cq_num_cuotas').val(3);
            $('#cq_periodicidad').val('mensual');
            $('#cq_fecha_inicial').val(
                fechaPrimeraCuotaDesdeHoy('mensual')
            );

            $('#cq_tbody').empty();
            $('#cq_total_cuotas').text('S/ 0.00');
            cuotasSeleccionadas = [];

            $('#modalCuotas').modal('show');
        } else {
            cuotasSeleccionadas = [];
        }
    });

    $('#cq_periodicidad').on('change', function () {
        const periodicidad = $(this).val();
        const nuevaFecha = fechaPrimeraCuotaDesdeHoy(periodicidad);
        $('#cq_fecha_inicial').val(nuevaFecha);
    });

    function fechaPrimeraCuotaDesdeHoy(periodicidad) {
        const hoy = new Date();
        if (periodicidad === 'mensual') {
            hoy.setMonth(hoy.getMonth() + 1);
        } else if (periodicidad === 'quincenal') {
            hoy.setDate(hoy.getDate() + 15);
        } else if (periodicidad === 'semanal') {
            hoy.setDate(hoy.getDate() + 7);
        }
        return hoy.toISOString().slice(0, 10);
    }

    function sumarPeriodo(fecha, periodicidad) {
        const f = new Date(fecha.getTime());

        if (periodicidad === 'mensual') {
            f.setMonth(f.getMonth() + 1);
        } else if (periodicidad === 'quincenal') {
            f.setDate(f.getDate() + 15);
        } else if (periodicidad === 'semanal') {
            f.setDate(f.getDate() + 7);
        }
        return f;
    }

    function recomputarMontoFinanciar() {
        let inicial = parseFloat($('#cq_pago_inicial').val()) || 0;
        if (inicial < 0) inicial = 0;
        if (inicial > totalVenta) inicial = totalVenta;
        $('#cq_pago_inicial').val(inicial.toFixed(2));

        montoFinanciar = +(totalVenta - inicial).toFixed(2);
        $('#cq_monto_financiar').val('S/ ' + montoFinanciar.toFixed(2));
    }

    $('#cq_pago_inicial').on('input', function(){
        recomputarMontoFinanciar();
    });


    $('#btnGenerarCuotas').on('click', function(){
        recomputarMontoFinanciar();
        if (montoFinanciar <= 0) {
            mostrarMensaje('warning', 'El monto a financiar debe ser mayor a 0.');
            return;
        }

        let n = parseInt($('#cq_num_cuotas').val()) || 1;
        if (n < 1) n = 1;

        const fechaIniStr   = $('#cq_fecha_inicial').val();
        const periodicidad  = $('#cq_periodicidad').val();

        if (!fechaIniStr) {
            mostrarMensaje('warning', 'Elige la fecha de la primera cuota.');
            return;
        }

        const montoBase = Math.floor((montoFinanciar / n) * 100) / 100;
        let resto = +(montoFinanciar - (montoBase * n)).toFixed(2);

        const tbody = $('#cq_tbody');
        tbody.empty();
        cuotasSeleccionadas = [];

        let fecha = new Date(fechaIniStr);

        for (let i = 1; i <= n; i++) {
            let monto = montoBase;
            if (i === n) monto = +(montoBase + resto).toFixed(2);

            const fechaStr = fecha.toISOString().slice(0,10);

            cuotasSeleccionadas.push({
                numero: i,
                fecha: fechaStr,
                monto: monto
            });

            const tr = `
            <tr>
                <td>${i}</td>
                <td><input type="date" class="form-control form-control-sm cq_fecha"
                    data-index="${i-1}" value="${fechaStr}"></td>
                <td><input type="number" min="0" step="0.01"
                    class="form-control form-control-sm cq_monto"
                    data-index="${i-1}" value="${monto.toFixed(2)}"></td>
            </tr>
            `;
            tbody.append(tr);

            fecha = sumarPeriodo(fecha, periodicidad);
        }

        actualizarTotalCuotas();
    });

    $('#btnConfirmarCuotas').on('click', function(){
        recomputarMontoFinanciar();
        if (montoFinanciar <= 0) {
            mostrarMensaje('warning', 'Monto a financiar debe ser mayor a 0.');
            return;
        }

        let suma = 0;
        cuotasSeleccionadas.forEach(c => suma += c.monto);
        suma = +suma.toFixed(2);

        if (Math.abs(suma - montoFinanciar) > 0.01) {
            mostrarMensaje('warning', 'La suma de cuotas (' + suma.toFixed(2) +
                ') debe ser igual al monto a financiar (' + montoFinanciar.toFixed(2) + ').');
            return;
        }

        $('#modalCuotas').modal('hide');
        mostrarMensaje('success', 'Plan de cuotas asignado.');
    });



    function actualizarTotalCuotas(){
        let suma = 0;
        cuotasSeleccionadas.forEach(c => suma += c.monto);
        $('#cq_total_cuotas').text('S/ ' + suma.toFixed(2));
    }

    $('#cq_tbody').on('input', '.cq_fecha, .cq_monto', function(){
        const idx = $(this).data('index');

        if ($(this).hasClass('cq_fecha')) {
            cuotasSeleccionadas[idx].fecha = $(this).val();
        } else {
            let m = parseFloat($(this).val()) || 0;
            if (m < 0) m = 0;
            cuotasSeleccionadas[idx].monto = m;

            let sumaParcial = 0;
            for (let i = 0; i < cuotasSeleccionadas.length - 1; i++) {
                sumaParcial += cuotasSeleccionadas[i].monto;
            }
            let ultima = +(montoFinanciar - sumaParcial).toFixed(2);
            if (ultima < 0) {
                ultima = 0;
                mostrarMensaje('warning', 'La suma de cuotas no puede superar el monto a financiar.');
            }
            cuotasSeleccionadas[cuotasSeleccionadas.length - 1].monto = ultima;

            $('#cq_tbody .cq_monto').last().val(ultima.toFixed(2));
        }

        actualizarTotalCuotas();
    });

});

$('#cv_documento').on('input blur', function(){
    aplicarReglasComprobantePorDocumento();
});
</script>
