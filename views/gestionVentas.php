<div class="fade-in-up">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Ventas</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Ventas</p>
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
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Listado de Ventas</h3>
                            <button type="button" class="btn btn-primary ms-auto" style="background-color: #3b82f6; border-color: #3b82f6;" onclick="AbrirPagina('views/crearVenta.php')" data-bs-toggle="modal" data-bs-target="#modalAgregarVenta">
                                <i class="fas fa-plus"></i> Agregar Venta
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tablaVentas" class="table hover order-column align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>N° DOCUMENTO</th>
                                        <th>CLIENTE</th>
                                        <th>VENDEDOR</th>
                                        <th>FECHA</th>
                                        <th>TOTAL</th>
                                        <th>FORMA PAGO</th>
                                        <th>CUOTAS</th>
                                        <th>SALDO</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETALLE VENTA -->
<div class="modal fade" id="modalDetalleVenta" tabindex="-1" aria-labelledby="modalDetalleVentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalDetalleVentaLabel">
                    Detalle de la Venta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p class="mb-1">
                        <strong>N° Documento:</strong>
                        <span id="dv_numero_documento"></span>
                    </p>
                    <p class="mb-1">
                        <strong>Cliente:</strong>
                        <span id="dv_cliente"></span>
                    </p>
                    <p class="mb-1">
                        <strong>Fecha:</strong>
                        <span id="dv_fecha"></span>
                    </p>
                </div>

                <h6 class="fw-bold mb-2">Productos Vendidos</h6>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Precio Unit.</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="dv_tbody_detalle">
                        </tbody>
                    </table>
                </div>

                <div class="text-end">
                    <span class="fs-5">Total: <strong id="dv_total">S/ 0.00</strong></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGestionCuotas" tabindex="-1" aria-labelledby="modalGestionCuotasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalGestionCuotasLabel">
                    Gestión de Cuotas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">

                <div class="row mb-2">
                    <div class="col-md-6">
                        <p class="mb-1">
                            <strong>Venta:</strong>
                            <span id="gc_numero_documento"></span>
                        </p>
                        <p class="mb-1">
                            <strong>Cliente:</strong>
                            <span id="gc_cliente"></span>
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p class="mb-1">
                            <strong>Total Venta:</strong>
                            <span id="gc_total_venta"></span>
                        </p>
                        <p class="mb-1">
                            <strong>Pago Inicial:</strong>
                            <span id="gc_pago_inicial"></span>
                        </p>
                    </div>
                </div>

                <h6 class="fw-bold mb-2">Plan de Pagos</h6>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th># Cuota</th>
                                <th>Fecha vencimiento</th>
                                <th>Monto</th>
                                <th>Pagado</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="gc_tbody_cuotas"></tbody>
                    </table>
                </div>

                <div class="text-end">
                    <span class="fs-5">Deuda Restante:
                        <strong id="gc_deuda_restante" class="text-danger">S/ 0.00</strong>
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPagoCuota" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold">
                    Registrar Pago
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">
                    <strong>Cuota:</strong> <span id="pc_info_cuota"></span><br>
                    <strong>Monto pendiente:</strong> <span id="pc_monto_pendiente"></span>
                </p>

                <div class="mb-3">
                    <label class="form-label">Medio de Pago</label>
                    <select id="pc_medio_pago" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Yape/Plin">Yape / Plin</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comentario (Opcional)</label>
                    <textarea id="pc_comentario" class="form-control" rows="3"
                        placeholder="Ej: N° de operación, nombre del titular, etc."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmarPagoCuota">
                    Confirmar Pago
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHistorialPagos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold">
                    Historial de Pagos
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">

                <div class="row mb-2">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Venta:</strong> <span id="hp_numero_documento"></span></p>
                        <p class="mb-1"><strong>Total:</strong> <span id="hp_total"></span></p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p class="mb-1"><strong>Cliente:</strong> <span id="hp_cliente"></span></p>
                        <p class="mb-1">
                            <strong>Pago Inicial:</strong> <span id="hp_pago_inicial"></span>
                            &nbsp;&nbsp;
                            <strong>Cuotas:</strong> <span id="hp_cuotas"></span>
                        </p>
                    </div>
                </div>

                <h6 class="fw-bold mb-2">Historial de Pagos</h6>
                <div id="hp_timeline"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

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

    var tablaVentas = $('#tablaVentas').DataTable({
        "ajax": {
            "url": "./controllers/ventasController.php?accion=listarVentas",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_venta" },
            { "data": "numero_boleta" },
            { "data": "cliente" },
            { "data": "vendedor" },
            { "data": "fecha_venta" },
            { 
                "data": "total",
                "render": function(d){ return 'S/ ' + parseFloat(d).toFixed(2); }
            },
            {
                "data": "forma_pago",
                "render": function(d){
                    if (d == 1) return '<span class="badge bg-primary">Contado</span>';
                    if (d == 2) return '<span class="badge bg-info text-dark">Crédito</span>';
                    return '<span class="badge bg-secondary">N/A</span>';
                }
            },
            {
                "data": null,
                "render": function(row){
                    const total  = parseInt(row.total_cuotas || 0);
                    const pagadas = parseInt(row.cuotas_pagadas || 0);
                    if (row.forma_pago != 2 || total === 0 || row.estado == 0) {
                        return '0/0';
                    }
                    return pagadas + '/' + total;
                }
            },
            {
                "data": "saldo_pendiente",
                "render": function(d){
                    const val = parseFloat(d || 0);
                    const clase = val > 0 ? 'text-danger fw-semibold' : 'text-success';
                    return `<span class="${clase}">S/ ${val.toFixed(2)}</span>`;
                }
            },
            { 
                "data": "estado",
                "render": function(d){
                    if (d == 1) return '<span class="badge bg-success">Completada</span>';
                    if (d == 0) return '<span class="badge bg-warning text-dark">Anulada</span>';
                    return '<span class="badge bg-secondary">Eliminada</span>';
                }
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(row){
                    const btnDetalle = `
                        <button class="btn btn-info btn-sm btn-ver-detalle" title="Ver detalle">
                        <i class="bi bi-eye"></i>
                        </button>
                    `;
                    const btnCuotas = (row.forma_pago == 2)
                        ? `<button class="btn btn-warning btn-sm btn-gestionar-cuotas ms-1" title="Gestión de cuotas">
                            <i class="bi bi-wallet2"></i>
                        </button>`
                        : '';
                    const btnHist    = (row.forma_pago == 2)
                        ? `<button class="btn btn-secondary btn-sm btn-historial ms-1" title="Historial de pagos">
                            <i class="bi bi-clock-history"></i>
                        </button>`
                        : '';
                    const btnAnular = (row.estado == 1)
                        ? `<button class="btn btn-danger btn-sm btn-anular ms-1" title="Anular venta">
                            <i class="bi bi-x-circle"></i>
                        </button>`
                        : '';    
                    return btnDetalle + ' ' + btnCuotas + ' ' + btnHist + ' ' + btnAnular;
                }
            }
        ],
        "columnDefs": [
            {
                targets: [0, 1, 3, 4, 5, 6, 7, 8, 9, 10],
                className: 'dt-center',
            },
            {
                targets: 1,
                width: '5%'
            },
            {
                targets: 2,
                width: '10%'
            },
            {
                target: 4,
                width: '10%'
            },
            {
                target: 6,
                width: '5%'
            },
            {
              target: 10,
              width: '15%'
            }
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });

    // BOTON VER DETALLE
    $('#tablaVentas tbody').on('click', '.btn-ver-detalle', function(){
        const data = tablaVentas.row($(this).parents('tr')).data();
        const id_venta = data.id_venta;

        $.ajax({
            url: './controllers/ventasController.php',
            type: 'GET',
            dataType: 'json',
            data: {
                accion: 'obtenerDetalleVenta',
                id_venta: id_venta
            },
            success: function(res){
                if (!res.success) {
                    mostrarMensaje('error', res.message || 'No se pudo obtener el detalle.');
                    return;
                }

                const cab    = res.cabecera;
                const det    = res.detalle || [];
                const cuotas = res.cuotas  || [];

                $('#dv_numero_documento').text(cab.numero_documento);
                $('#dv_cliente').text(cab.cliente);
                $('#dv_fecha').text(cab.fecha_venta);
                $('#dv_total').text('S/ ' + parseFloat(cab.total).toFixed(2));

                const tbody = $('#dv_tbody_detalle');
                tbody.empty();
                det.forEach(function(it){
                    const tr = `
                        <tr>
                            <td>${it.libro}</td>
                            <td>S/ ${parseFloat(it.precio_unit).toFixed(2)}</td>
                            <td>${it.cantidad}</td>
                            <td>S/ ${parseFloat(it.subtotal).toFixed(2)}</td>
                        </tr>
                    `;
                    tbody.append(tr);
                });

                $('#modalDetalleVenta').modal('show');
            },
            error: function(){
                Swal.close();
                mostrarMensaje('error', 'Error de comunicación con el servidor.');
            }
        });
    });

    // BOTON GESTIONAR CUOTAS
    let gcCuotasActuales = [];
    let gcIdVentaActual  = 0;

    $('#tablaVentas tbody').on('click', '.btn-gestionar-cuotas', function(){
        const data = tablaVentas.row($(this).parents('tr')).data();
        const id_venta = data.id_venta;

        $.ajax({
            url: './controllers/ventasController.php',
            type: 'GET',
            dataType: 'json',
            data: {
                accion: 'obtenerDetalleVenta',
                id_venta: id_venta
            },
            success: function(res){
                if (!res.success) {
                    mostrarMensaje('error', res.message || 'No se pudo obtener la venta.');
                    return;
                }

                const cab    = res.cabecera;
                const cuotas = res.cuotas || [];

                gcCuotasActuales = cuotas;
                gcIdVentaActual  = cab.id_venta;

                $('#gc_numero_documento').text(cab.numero_documento);
                $('#gc_cliente').text(cab.cliente);
                $('#gc_total_venta').text('S/ ' + parseFloat(cab.total).toFixed(2));
                $('#gc_pago_inicial').text('S/ ' + parseFloat(cab.pago_inicial || 0).toFixed(2));

                const tbody = $('#gc_tbody_cuotas');
                tbody.empty();

                let deudaRestante = 0;
                let todasAnuladas = cuotas.length > 0;

                cuotas.forEach(function(c){
                    const monto    = parseFloat(c.monto_cuota);
                    const pagado   = parseFloat(c.monto_pagado);
                    const pendiente = Math.max(monto - pagado, 0);

                    let estadoTxt  = '';
                    let badgeClass = 'bg-secondary';

                    if (c.estado == 0) { estadoTxt = 'Pendiente'; badgeClass = 'bg-warning text-dark'; }
                        else if (c.estado == 1) { estadoTxt = 'Pagada'; badgeClass = 'bg-success'; }
                        else if (c.estado == 2) { estadoTxt = 'Atrasada'; badgeClass = 'bg-warning '; }
                        else if (c.estado == 3) { estadoTxt = 'Parcial';  badgeClass = 'bg-info text-dark'; }
                        else if (c.estado == 4) { estadoTxt = 'Anulada'; badgeClass = 'bg-danger'; }

                    if (c.estado != 4) {
                      deudaRestante += pendiente;
                      todasAnuladas = false;
                    }    

                    const btnPagar = (pendiente > 0 && c.estado != 4)
                        ? `<button class="btn btn-primary btn-sm btn-pagar-cuota"
                                data-id-cuota="${c.id_cuota}">
                            <i class="bi bi-cash-stack"></i> Pagar
                        </button>`
                        : '';

                    const tr = `
                        <tr>
                            <td>${c.numero_cuota}</td>
                            <td>${c.fecha_vencimiento}</td>
                            <td>S/ ${monto.toFixed(2)}</td>
                            <td>S/ ${pagado.toFixed(2)}</td>
                            <td><span class="badge ${badgeClass}">${estadoTxt}</span></td>
                            <td>${btnPagar}</td>
                        </tr>
                    `;
                    tbody.append(tr);
                });

                if (todasAnuladas) {
                    deudaRestante = 0;
                }

                $('#gc_deuda_restante').text('S/ ' + deudaRestante.toFixed(2));

                $('#modalGestionCuotas').modal('show');
            },
            error: function(){
                mostrarMensaje('error', 'Error de comunicación con el servidor.');
            }
        });
    });
    
    // BOTON PAGAR CUOTA
    let pcIdCuotaActual = 0;
    let pcIndiceCuota   = -1;

    $('#gc_tbody_cuotas').on('click', '.btn-pagar-cuota', function(){
        const id_cuota = $(this).data('id-cuota');
        const idx = gcCuotasActuales.findIndex(c => parseInt(c.id_cuota) === parseInt(id_cuota));
        if (idx === -1) {
            mostrarMensaje('error', 'No se encontró la cuota.');
            return;
        }

        const cuota = gcCuotasActuales[idx];

        // VALIDAR SI NO EXISTEN CUOTAS PREVIAS SIN PAGAR
        const tienePendientesPrevias = gcCuotasActuales.some(c =>
            c.numero_cuota < cuota.numero_cuota && parseInt(c.estado) !== 1
        );
        if (tienePendientesPrevias) {
            mostrarMensaje('warning', 'No se puede pagar esta cuota mientras haya cuotas anteriores sin pagar.');
            return;
        }

        const monto = parseFloat(cuota.monto_cuota);
        const pagado = parseFloat(cuota.monto_pagado);
        const pendiente = Math.max(monto - pagado, 0);

        if (pendiente <= 0) {
            mostrarMensaje('info', 'Esta cuota ya está pagada.');
            return;
        }

        pcIdCuotaActual = id_cuota;
        pcIndiceCuota   = idx;

        $('#pc_info_cuota').text(`#${cuota.numero_cuota} - ${cuota.fecha_vencimiento}`);
        $('#pc_monto_pendiente').text('S/ ' + pendiente.toFixed(2));
        $('#pc_medio_pago').val('');
        $('#pc_comentario').val('');

        $('#modalPagoCuota').modal('show');
    });

    // REGISTRAR PAGO
    $('#btnConfirmarPagoCuota').on('click', function(){
        if (!pcIdCuotaActual || pcIndiceCuota === -1) return;

        const medio = $('#pc_medio_pago').val();
        const comentario = $('#pc_comentario').val().trim();

        if (!medio) {
            mostrarMensaje('warning', 'Seleccione un medio de pago.');
            return;
        }

        $.ajax({
            url: './controllers/ventasController.php',
            type: 'POST',
            dataType: 'json',
            data: {
                accion: 'registrarPagoCuota',
                id_cuota: pcIdCuotaActual,
                medio_pago: medio,
                comentario: comentario
            },
            beforeSend: function(){
                $('#btnConfirmarPagoCuota').prop('disabled', true);
            },
            success: function(res){
                $('#btnConfirmarPagoCuota').prop('disabled', false);

                if (!res.success) {
                    mostrarMensaje('error', res.message || 'No se pudo registrar el pago.');
                    return;
                }

                mostrarMensaje('success', res.message || 'Pago registrado.');

                const cuota = gcCuotasActuales[pcIndiceCuota];
                const monto = parseFloat(cuota.monto_cuota);
                cuota.monto_pagado = monto;
                cuota.estado = 1; 

                let deudaRestante = 0;
                const tbody = $('#gc_tbody_cuotas');
                tbody.empty();

                gcCuotasActuales.forEach(function(c){
                    const m   = parseFloat(c.monto_cuota);
                    const pag = parseFloat(c.monto_pagado);
                    const pen = Math.max(m - pag, 0);
                    deudaRestante += pen;

                    let estadoTxt  = '';
                    let badgeClass = 'bg-secondary';
                    if (c.estado == 0) { estadoTxt = 'Pendiente'; badgeClass = 'bg-warning text-dark'; }
                        else if (c.estado == 1) { estadoTxt = 'Pagada'; badgeClass = 'bg-success'; }
                        else if (c.estado == 2) { estadoTxt = 'Atrasada'; badgeClass = 'bg-warning '; }
                        else if (c.estado == 3) { estadoTxt = 'Parcial';  badgeClass = 'bg-info text-dark'; }
                        else if (c.estado == 4) { estadoTxt = 'Anulada'; badgeClass = 'bg-danger'; }

                    const btnPagar = (pen > 0 && c.estado != 4)
                        ? `<button class="btn btn-primary btn-sm btn-pagar-cuota"
                                data-id-cuota="${c.id_cuota}">
                            <i class="bi bi-cash-stack"></i> Pagar
                        </button>`
                        : '';

                    const tr = `
                        <tr>
                            <td>${c.numero_cuota}</td>
                            <td>${c.fecha_vencimiento}</td>
                            <td>S/ ${m.toFixed(2)}</td>
                            <td>S/ ${pag.toFixed(2)}</td>
                            <td><span class="badge ${badgeClass}">${estadoTxt}</span></td>
                            <td>${btnPagar}</td>
                        </tr>
                    `;
                    tbody.append(tr);
                });

                $('#gc_deuda_restante').text('S/ ' + deudaRestante.toFixed(2));

                if (typeof res.nuevo_saldo !== 'undefined') {
                    const fila = tablaVentas.row(function(idx, data){
                        return data.id_venta == gcIdVentaActual;
                    });
                    if (fila) {
                        const d = fila.data();
                        d.saldo_pendiente = res.nuevo_saldo;
                        fila.data(d).draw(false);
                    }
                }

                $('#modalPagoCuota').modal('hide');
            },
            error: function(){
                $('#btnConfirmarPagoCuota').prop('disabled', false);
                mostrarMensaje('error', 'Error de comunicación con el servidor.');
            }
        });
    });

    $('#tablaVentas tbody').on('click', '.btn-historial', function(){
        const data = tablaVentas.row($(this).parents('tr')).data();
        abrirHistorialPagos(data.id_venta);
    });

    function abrirHistorialPagos(id_venta){
        $.ajax({
            url: './controllers/ventasController.php',
            type: 'GET',
            dataType: 'json',
            data: {
                accion: 'obtenerHistorialPagos',
                id_venta: id_venta
            },
            success: function(res){
                if (!res.success) {
                    mostrarMensaje('error', res.message || 'No se pudo obtener el historial.');
                    return;
                }

                const cab   = res.cabecera;
                const linea = res.linea || [];

                $('#hp_numero_documento').text(cab.numero_documento);
                $('#hp_cliente').text(cab.cliente);
                $('#hp_total').text('S/ ' + parseFloat(cab.total).toFixed(2));
                $('#hp_pago_inicial').text('S/ ' + parseFloat(cab.pago_inicial || 0).toFixed(2));
                $('#hp_cuotas').text(cab.num_cuotas || 0);

                const cont = $('#hp_timeline');
                cont.empty();

                if (linea.length === 0) {
                    cont.html('<p class="text-muted">Sin cuotas ni pagos registrados.</p>');
                } else {
                    const porCuota = {};
                    linea.forEach(row => {
                        const num = row.numero_cuota;
                        if (!porCuota[num]) porCuota[num] = { info: row, pagos: [] };
                        if (row.id_pago) {
                            porCuota[num].pagos.push({
                                fecha: row.fecha_pago,
                                medio: row.medio_pago,
                                comentario: row.comentario
                            });
                        }
                    });

                    Object.keys(porCuota).sort((a,b)=>a-b).forEach(num => {
                        const c = porCuota[num].info;
                        const pagos = porCuota[num].pagos;

                        let estadoTxt  = 'Pendiente';
                        let iconClass  = 'text-warning';
                        if (c.estado == 0) { estadoTxt = 'Pendiente'; iconClass = 'text-warning'; badgeClass = 'bg-warning text-dark'; }
                        else if (c.estado == 1) { estadoTxt = 'Pagada'; iconClass = 'text-success'; badgeClass = 'bg-success'; }
                        else if (c.estado == 2) { estadoTxt = 'Atrasada'; iconClass = 'text-warning'; badgeClass = 'bg-warning'; }
                        else if (c.estado == 3) { estadoTxt = 'Parcial';  iconClass = 'text-info'; badgeClass = 'bg-info text-dark'; }
                        else if (c.estado == 4) { estadoTxt = 'Anulada'; iconClass = 'text-danger'; badgeClass = 'bg-danger'; }

                        let html = `
                          <div class="mb-3">
                            <div class="d-flex">
                              <div class="me-2">
                                <i class="bi bi-check-circle-fill ${iconClass}" style="font-size:1.4rem;"></i>
                              </div>
                              <div>
                                <strong>Cuota ${c.numero_cuota} - ${estadoTxt}</strong><br>
                                <span>Monto: S/ ${parseFloat(c.monto_cuota).toFixed(2)}</span><br>
                                <span>Vencimiento: ${c.fecha_vencimiento}</span><br>
                        `;

                        if (pagos.length > 0) {
                            const ultimo = pagos[pagos.length - 1];
                            html += `
                                <span>Fecha de Pago: ${ultimo.fecha}</span><br>
                                <span>Medio: ${ultimo.medio}</span><br>
                            `;
                            if (ultimo.comentario) {
                                html += `<span>Comentario: ${ultimo.comentario}</span><br>`;
                            }
                        }

                        html += `
                              </div>
                            </div>
                          </div>
                        `;

                        cont.append(html);
                    });
                }

                $('#modalHistorialPagos').modal('show');
            },
            error: function(){
                mostrarMensaje('error', 'Error de comunicación con el servidor.');
            }
        });
    }

    $('#tablaVentas tbody').on('click', '.btn-anular', function(){
        const row  = tablaVentas.row($(this).parents('tr'));
        const data = row.data();

        if (data.estado != 1) {
            mostrarMensaje('info', 'Solo se pueden anular ventas completadas.');
            return;
        }

        Swal.fire({
            title: '¿Anular venta?',
            text: `Se anulará la venta ${data.numero_boleta}. Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, anular',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (!result.isConfirmed) return;

            $.ajax({
                url: './controllers/ventasController.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    accion: 'anularVenta',
                    id_venta: data.id_venta
                },
                success: function(res){
                    if (!res.success) {
                        mostrarMensaje('error', res.message || 'No se pudo anular la venta.');
                        return;
                    }

                    mostrarMensaje('success', res.message || 'Venta anulada.');

                    data.estado = 0;
                    row.data(data).draw(false);
                    data.saldo_pendiente = 0;
                    row.data(data).draw(false);
                },
                error: function(){
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        });
    });
});
</script>

