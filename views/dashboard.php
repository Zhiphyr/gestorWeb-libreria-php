<div class="fade-in-up">
    <!-- Welcome Section -->
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Dashboard</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Libreria APP</p>
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
            <div class="row g-4 mb-0">
                <!-- Card 1 -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fas fa-users fa-lg"></i>
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">Ingresos</span>
                            </div>
                            <h2 class="mb-1 fw-bold text-dark" id="badgeIngresosDia">S/. 0.00</h2>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Ingresos del Día</p>
                        </div>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-success bg-opacity-10 text-success rounded-3 p-3">
                                    <i class="fas fa-book fa-lg"></i>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Activas</span>
                            </div>
                            <h2 class="mb-1 fw-bold text-dark" id="badgeLibrosCatalogo">0</h2>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Libros en Catálogo</p>
                        </div>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                                    <i class="fas fa-shopping-cart fa-lg"></i>
                                </div>
                            </div>
                            <h2 class="mb-1 fw-bold text-dark" id="badgeVentasMes">0</h2>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Número de Ventas del Mes</p>
                        </div>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-info bg-opacity-10 text-info rounded-3 p-3">
                                    <i class="fas fa-tags fa-lg"></i>
                                </div>
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill">Ingresos</span>
                            </div>
                            <h2 class="mb-1 fw-bold text-dark" id="badgeIngresosMes">S/. 0.00</h2>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Ingresos del Mes</p>
                        </div>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 mt-4">
                <!-- Acciones rápidas y graficos circulares -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-gradient-primary text-white overflow-hidden position-relative"
                        style="background: linear-gradient(135deg, #1d4ed8, #3b82f6);">
                        <div class="card-body p-4 position-relative z-1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="fw-bold mb-1">Acciones rápidas</h4>
                                    <p class="mb-0 text-white-50 small">
                                        Accede en un clic a las secciones más usadas del sistema.
                                    </p>
                                </div>
                                <div class="d-none d-md-block">
                                    <i class="fas fa-bolt fa-2x text-white-50"></i>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-12">
                                    <button type="button"
                                            class="btn btn-light text-primary w-100 fw-semibold text-start py-3 px-3 d-flex align-items-center gap-3 shadow-sm border-0 rounded-3 quick-action-btn"
                                            onclick="AbrirPagina('views/crearVenta.php')">
                                        <span class="quick-action-icon rounded-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-cash-register"></i>
                                        </span>
                                        <span>
                                            <span class="d-block">Nueva venta</span>
                                            <small class="text-muted">Registrar una venta rápida</small>
                                        </span>
                                    </button>
                                </div>

                                <div class="col-12">
                                    <button type="button"
                                            class="btn btn-light text-primary w-100 fw-semibold text-start py-3 px-3 d-flex align-items-center gap-3 shadow-sm border-0 rounded-3 quick-action-btn"
                                            onclick="AbrirPagina('views/gestionInventario.php')">
                                        <span class="quick-action-icon rounded-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-book-medical"></i>
                                        </span>
                                        <span>
                                            <span class="d-block">Nuevo libro</span>
                                            <small class="text-muted">Agregar un libro al catálogo</small>
                                        </span>
                                    </button>
                                </div>

                                <div class="col-12">
                                    <button type="button"
                                            class="btn btn-light text-primary w-100 fw-semibold text-start py-3 px-3 d-flex align-items-center gap-3 shadow-sm border-0 rounded-3 quick-action-btn"
                                            onclick="AbrirPagina('views/gestionClientes.php')">
                                        <span class="quick-action-icon rounded-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                                        <span>
                                            <span class="d-block">Nuevo cliente</span>
                                            <small class="text-muted">Registrar un nuevo cliente</small>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Top 7 categorías con más libros en el catálogo -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0 fw-bold">Top 7 categorías con más libros en el catálogo</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="chartTopCategorias" height="80"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Top 5 clientes con más compras -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0 fw-bold">Top 5 clientes con más compras</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="chartTopClientes" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ingresos mensuales (Contado vs Crédito) -->
            <div class="row g-4 mt-4">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold">
                                Ingresos mensuales (Contado vs Crédito)
                            </h5>
                            <select id="selectAñoIngresos" class="form-select form-select-sm ms-auto" style="width:auto;">
                                
                            </select>
                        </div>
                        <div class="card-body">
                            <canvas id="chartIngresosMensuales" height="80"></canvas>
                        </div>  
                    </div>
                </div>
            </div>

            <!-- Cuotas por cobrar del Mes y lista de movimientos de inventario -->
            <div class="row g-4 mt-4">
                <!-- Cuotas por cobrar del Mes -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold">Cuotas por cobrar del Mes</h5>
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill ms-auto" id="badgeCuotasPorCobrar">0</span>
                        </div>
                        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                            <p class="text-muted small mb-3">
                                Cuotas pendientes que están próximas a vencer
                            </p>
                            <ul class="list-group list-group-flush" id="listaCuotasPorCobrar"></ul>
                        </div>
                    </div>
                </div>

                <!-- Lista de movimientos de inventario -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Últimos movimientos de inventario</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush" id="listaMovimientos">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Libros con stock bajo y ultimas ventas -->
            <div class="row g-4 mt-4">
                <!-- Libros con stock bajo -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold">Libros con stock bajo</h5>
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill ms-auto" id="badgeLibrosBajoStock">0</span>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">
                                Libros cuyo stock actual es menor que el stock mínimo configurado.
                            </p>
                            <ul class="list-group list-group-flush" id="listaLibrosBajoStock">
                                
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Ultimas ventas -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold">Últimas ventas</h5>
                        </div>
                        <div class="card-body" style="max-height: 260px; overflow-y: auto;">
                            <ul class="list-group list-group-flush" id="listaUltimasVentas"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        // CARGAR FECHA ACTUAL
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', options);

        cargarLibrosBajoStock();

        actualizarCardsDashboard();

        cargarGraficoTopCategorias();

        cargarGraficoTopClientes();

        inicializarSelectorAñoIngresos();

        cargarGraficoIngresosMensuales();

        cargarUltimosMovimientos();

        cargarCuotasPorCobrarMes();

        cargarUltimasVentas();
    });

    // CARGAR LIBROS CON STOCK BAJO
    function cargarLibrosBajoStock() {
        $.ajax({
            url: "./controllers/librosController.php",
            type: "GET",
            data: { accion: 'librosBajoStock' },
            dataType: "json",
            success: function (data) {
                const lista = $('#listaLibrosBajoStock');
                lista.empty();

                if (!data || data.length === 0) {
                    lista.append('<li class="list-group-item text-muted small">No hay libros con stock bajo.</li>');
                    $('#badgeLibrosBajoStock').text(0);
                    return;
                }

                $('#badgeLibrosBajoStock').text(data.length);

                data.forEach(function (libro) {
                    const porcentaje = libro.stock_minimo > 0 
                        ? Math.round((libro.stock / libro.stock_minimo) * 100)
                        : 0;

                    const item = `
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-0 me-3 flex-grow-1">
                                <div class="fw-bold">${libro.nombre}</div>
                                <small class="text-muted">
                                    Stock: <span class="text-danger fw-bold">${libro.stock}</span> /
                                    Mínimo: <span class="fw-bold">${libro.stock_minimo}</span>
                                </small>
                            </div>
                            <span class="badge bg-danger rounded-pill">${porcentaje}%</span>
                        </li>
                    `;
                    lista.append(item);
                });
            },
            error: function () {
                const lista = $('#listaLibrosBajoStock');
                lista.empty();
                lista.append('<li class="list-group-item text-danger small">Error al cargar los libros con stock bajo.</li>');
                $('#badgeLibrosBajoStock').text('!');
            }
        });
    }

    // ACTUALIZAR CARDS DEL DASHBOARD
    function actualizarCardsDashboard() {

        // LIBROS EN CATÁLOGO
        $.ajax({
            url: "./controllers/librosController.php",
            type: "GET",
            data: { accion: 'contadores' },
            dataType: "json",
            success: function (data) {
                $('#badgeLibrosCatalogo').text(data.activos || 0);
            }
        });

        // VENTAS DEL MES
        $.ajax({
            url: "./controllers/ventasController.php",
            type: "GET",
            data: { accion: 'contadores' },
            dataType: "json",
            success: function (data) {
                $('#badgeVentasMes').text(data.ventas_mes || 0);
            }
        });

        // INGRESOS DEL DIA Y DEL MES
        $.ajax({
            url: "./controllers/ventasController.php",
            type: "GET",
            data: { accion: 'ingresos' },
            dataType: "json",
            success: function (res) {
                if (!res || !res.success) return;

                const dia = parseFloat(res.ingresos_dia || 0).toFixed(2);
                const mes = parseFloat(res.ingresos_mes || 0).toFixed(2);

                $('#badgeIngresosDia').text('S/. ' + dia);
                $('#badgeIngresosMes').text('S/. ' + mes);
            }
        });
    }

    // GRAFICO DE CATEGORIAS CON MAS LIBROS EN EL CATALOGO
    function cargarGraficoTopCategorias() {
        $.ajax({
            url: "./controllers/librosController.php",
            type: "GET",
            data: { accion: 'topCategorias' },
            dataType: "json",
            success: function (res) {
                const labels = res.labels || [];
                const data   = res.data   || [];

                const ctx = document.getElementById('chartTopCategorias').getContext('2d');

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Cantidad de libros',
                            data: data,
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.7)',
                                'rgba(16, 185, 129, 0.7)',
                                'rgba(245, 158, 11, 0.7)',
                                'rgba(239, 68, 68, 0.7)',
                                'rgba(139, 92, 246, 0.7)',
                                'rgba(236, 72, 153, 0.7)',
                                'rgba(246, 138, 92, 0.23)',
                            ],
                            borderColor: 'white',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            },
            error: function () {
                console.error("Error al cargar datos para el gráfico de categorías.");
            }
        });
    }

    // CARGAR ULTIMOS MOVIMIENTOS
    function cargarUltimosMovimientos() {
        $.ajax({
            url: './controllers/inventarioController.php',
            type: 'GET',
            dataType: 'json',
            data: { accion: 'ultimosMovimientos' },
            success: function(res) {
                if (!res.success) {
                    return;
                }
                const ul = $('#listaMovimientos');
                ul.empty();

                if (res.data.length === 0) {
                    ul.append('<li class="list-group-item text-muted">No hay movimientos registrados.</li>');
                    return;
                }

                res.data.forEach(function(m) {
                    // Formatear tipo
                    let tipo = m.tipo
                        .toLowerCase()
                        .replace('_', ' ')
                        .replace(/\b\w/g, c => c.toUpperCase());

                    const li = `
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-semibold">${m.libro}</div>
                                <small>${tipo} · Cant: ${m.cantidad} · Antes: ${m.stock_anterior} · Después: ${m.stock_nuevo}</small><br>
                                <small>Por: ${m.usuario}${m.motivo ? ' · ' + m.motivo : ''}</small>
                            </div>
                            <span class="badge bg-light text-muted border rounded-pill">${m.fecha_mov}</span>
                        </li>
                    `;
                    ul.append(li);
                });
            }
        });
    }
    
    // SELECTOR DE AÑO DE INGRESOS
    function inicializarSelectorAñoIngresos() {
        const select = $('#selectAñoIngresos');
        const añoActual = new Date().getFullYear();
        select.empty();

        for (let a = añoActual; a >= añoActual - 4; a--) {
            select.append(`<option value="${a}">${a}</option>`);
        }

        select.val(añoActual);

        select.on('change', function() {
            cargarGraficoIngresosMensuales();
        });
    }

    // GRAFICO DE LINEA DE INGRESOS MENSUALES
    var chartIngresosMensuales = null;

    function cargarGraficoIngresosMensuales() {
        const año = $('#selectAñoIngresos').val() || new Date().getFullYear();

        $.ajax({
            url: "./controllers/ventasController.php",
            type: "GET",
            data: { accion: 'ingresosMensuales', año: año },
            dataType: "json",
            success: function(res) {
                if (!res || !res.success) return;

                const rows = res.data || [];

                const nombresMes = [
                    'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
                ];

                const labels    = rows.map(r => nombresMes[r.mes - 1]);
                const datosCont = rows.map(r => parseFloat(r.contado || 0).toFixed(2));
                const datosCred = rows.map(r => parseFloat(r.credito || 0).toFixed(2));

                const canvas = document.getElementById('chartIngresosMensuales');
        
                const ctx = canvas.getContext('2d');

                if (chartIngresosMensuales) {
                    chartIngresosMensuales.destroy();
                }

                chartIngresosMensuales = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Contado',
                                data: datosCont,
                                borderColor: 'rgba(34, 197, 94, 1)',
                                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                                tension: 0.2,
                                fill: true
                            },
                            {
                                label: 'Crédito (pagos)',
                                data: datosCred,
                                borderColor: 'rgba(59, 130, 246, 1)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.2,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'S/. ' + value.toFixed(2);
                                    }
                                }
                            }
                        },
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(ctx) {
                                        const v = parseFloat(ctx.parsed.y || 0).toFixed(2);
                                        return ctx.dataset.label + ': S/. ' + v;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    }

    // CARGAR CUOTAS POR COBRAR
    function cargarCuotasPorCobrarMes() {
        $.ajax({
            url: "./controllers/ventasController.php",
            type: "GET",
            data: { accion: 'cuotasPorCobrarMes' },
            dataType: "json",
            success: function (res) {
                const ul = $('#listaCuotasPorCobrar');
                ul.empty();

                if (!res || !res.success || !res.data || res.data.length === 0) {
                    ul.append('<li class="list-group-item text-muted small">No hay cuotas pendientes este mes.</li>');
                    $('#badgeCuotasPorCobrar').text(0);
                    return;
                }

                $('#badgeCuotasPorCobrar').text(res.data.length);

                res.data.forEach(function(c) {
                    const pendiente = parseFloat((c.monto_pendiente || 0)).toFixed(2);

                    const hoyStr = new Date().toISOString().slice(0, 10);
                    const fechaVen = c.fecha_vencimiento;
                    let extraClass = '';
                    let mensaje = 'Pendiente';

                    if (fechaVen === hoyStr) {
                        extraClass = ' cuota-hoy';
                        mensaje = 'Hoy';
                    } else if (fechaVen < hoyStr) {
                        extraClass = ' cuota-vencida';
                        mensaje = 'Vencida';
                    }

                    const item = `
                        <li class="list-group-item d-flex justify-content-between align-items-start${extraClass}">
                            <div class="ms-0 me-3 flex-grow-1">
                                <div class="fw-bold">
                                    ${c.cliente}
                                    <br>
                                    ${c.numero_documento}
                                </div>
                                <small class="text-muted">
                                    Cuota #${c.numero_cuota} · Vence: ${c.fecha_vencimiento}
                                </small><br>
                                <small class="text-danger fw-bold">
                                    ${mensaje}: S/ ${pendiente}
                                </small>
                            </div>
                        </li>
                    `;
                    ul.append(item);
                });
            },
            error: function () {
                const ul = $('#listaCuotasPorCobrar');
                ul.empty();
                ul.append('<li class="list-group-item text-danger small">Error al cargar las cuotas por cobrar.</li>');
                $('#badgeCuotasPorCobrar').text('!');
            }
        });
    }

    // CARGAR ULTIMAS VENTAS
    function cargarUltimasVentas() {
        $.ajax({
            url: "./controllers/ventasController.php",
            type: "GET",
            data: { accion: 'ultimasVentas' },
            dataType: "json",
            success: function(res) {
                const ul = $('#listaUltimasVentas');
                ul.empty();

                if (!res || !res.success || !res.data || res.data.length === 0) {
                    ul.append('<li class="list-group-item text-muted small">No hay ventas registradas.</li>');
                    return;
                }

                res.data.forEach(function(v) {
                    const total = parseFloat(v.total || 0).toFixed(2);
                    const tipoPago = (parseInt(v.forma_pago) === 2) ? 'Crédito' : 'Contado';
                    const badgeClass = (parseInt(v.forma_pago) === 2)
                        ? 'badge bg-info text-dark'
                        : 'badge bg-primary';

                    const li = `
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-0 me-3 flex-grow-1">
                                <div class="fw-bold">${v.numero_documento} · ${v.cliente}</div>
                                <small>Vendedor: <span class="fw-bold">${v.vendedor}</span></small><br>
                                <small class="text-muted">${v.fecha_venta}</small><br>
                                <small>Importe: <span class="fw-bold">S/ ${total}</span></small>
                            </div>
                            <span class="${badgeClass}">${tipoPago}</span>
                        </li>
                    `;
                    ul.append(li);
                });
            },
            error: function() {
                const ul = $('#listaUltimasVentas');
                ul.empty();
                ul.append('<li class="list-group-item text-danger small">Error al cargar las últimas ventas.</li>');
            }
        });
    }

    // GRAFICO DE TOP CLIENTES
    function cargarGraficoTopClientes() {
        $.ajax({
            url: "./controllers/ventasController.php",
            type: "GET",
            data: { accion: 'topClientes' },
            dataType: "json",
            success: function(res) {
                if (!res || !res.success) return;

                const labels = res.labels || [];
                const data   = res.data   || [];

                const canvas = document.getElementById('chartTopClientes');
                if (!canvas) {
                    console.error('No se encontró el canvas chartTopClientes');
                    return;
                }
                const ctx = canvas.getContext('2d');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Número de compras',
                            data: data,
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.8)',
                                'rgba(16, 185, 129, 0.8)',
                                'rgba(245, 158, 11, 0.8)',
                                'rgba(239, 68, 68, 0.8)',
                                'rgba(139, 92, 246, 0.8)'
                            ],
                            borderColor: 'white',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(ctx) {
                                        const valor = ctx.parsed;
                                        const nombre = ctx.label || '';
                                        return nombre + ': ' + valor + ' compras';
                                    }
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
            }
        });
    }

    
</script>
