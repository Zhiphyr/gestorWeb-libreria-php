<div class="fade-in-up">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Inventario</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Inventario</p>
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

    <div class="app-content mt-2">
        <div class="container-fluid">    
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Inventario de Libros</h3>
                            <button type="button" class="btn btn-primary ms-auto" style="background-color: #3b82f6; border-color: #3b82f6;" 
                                data-bs-toggle="modal" data-bs-target="#modalAgregarLibro">
                                <i class="fas fa-plus"></i> Nuevo Ingreso
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablaLibros" class="table hover order-column" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>ID</th>
                                            <th>ISBN</th>
                                            <th>NOMBRE</th>
                                            <th>PRECIO COMPRA</th>
                                            <th>PRECIO VENTA</th>
                                            <th>STOCK</th>
                                            <th>STOCK MINIMO</th>
                                            <th>FECHA INGRESO</th>
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
</div>

<!--MODAL PARA AGREGAR UN LIBRO-->
<div class="modal fade" id="modalAgregarLibro" tabindex="-1" aria-labelledby="modalAgregarLibroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalAgregarLibroLabel">Registrar libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioAgregarLibro" enctype="multipart/form-data">
                    <h5 class="text-muted text-uppercase fw-bold text-center">Información del libro</h5>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Portada</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary" id="btnBuscarISBN" type="button"><i class="bi bi-search"></i></button>
                                </div>
                                <input type="text" class="form-control" id="isbn" name="isbn" required>
                            </div>
                        </div>
                        <div class="mb-3 col-md-5">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="id_categoria" class="form-label">Categoria</label>
                            <select name="id_categoria" id="id_categoria" class="form-select js-categoria"></select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="autor" class="form-label">Autor</label>
                            <select name="id_autor" id="id_autor" class="form-select js-autor"></select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="editorial" class="form-label">Editorial</label>
                            <select name="id_editorial" id="id_editorial" class="form-select js-editorial"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="año_publicacion" class="form-label">Año de Publicación</label>
                            <input type="number" class="form-control" id="año_publicacion" name="año_publicacion" required min="1900" max="2100">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="numero_paginas" class="form-label">Número de Paginas</label>
                            <input type="number" class="form-control" id="numero_paginas" name="numero_paginas" required min="1">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="idioma" class="form-label">Idioma</label>
                            <input type="text" class="form-control" id="idioma" name="idioma" required>
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-muted text-uppercase fw-bold text-center">Información de stock y precio</h5>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required min="1">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="stock_minimo" class="form-label">Stock Minimo</label>
                            <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" required min="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="precio_compra" class="form-label">Precio Compra</label>
                            <input type="number" class="form-control" id="precio_compra" name="precio_compra" required min="1" step="0.01">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="precio_venta" class="form-label">Precio Venta</label>
                            <input type="number" class="form-control" id="precio_venta" name="precio_venta" required min="1" step="0.01">
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="mostrar_catalogo" name="mostrar_catalogo" value="1">
                        <label class="form-check-label" for="mostrar_catalogo">Mostrar en catálogo</label>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" style="background-color: #3b82f6; border-color: #3b82f6;">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--MODAL PARA EDITAR UN LIBRO-->
<div class="modal fade" id="modalEditarLibro" tabindex="-1" aria-labelledby="modalEditarLibroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalEditarLibroLabel">Editar libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioEditarLibro" enctype="multipart/form-data">
                    <h5 class="text-muted text-uppercase fw-bold text-center">Información del libro</h5>
                    <div class="mb-3">
                        <label for="editarId_libro" class="form-label">ID</label>
                        <input type="text" class="form-control" id="editarId_libro" name="id_libro" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editarFoto" class="form-label">Portada</label>
                        <input type="file" class="form-control" id="editarFoto" name="foto">
                        <input type="hidden" id="editarFoto_actual" name="foto_actual">
                        <div class="mt-2">
                            <img id="editarPreviewFoto" src="" alt="Portada actual" style="max-width: 120px; border-radius: 4px;">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="editarIsbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="editarIsbn" name="isbn" readonly>
                        </div>
                        <div class="mb-3 col-md-5">
                            <label for="editarNombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="editarId_categoria" class="form-label">Categoria</label>
                            <select name="id_categoria" id="editarId_categoria" class="form-select js-categoria"></select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editarDescripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="editarDescripcion" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="editarId_autor" class="form-label">Autor</label>
                            <select name="id_autor" id="editarId_autor" class="form-select js-autor"></select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="editarId_editorial" class="form-label">Editorial</label>
                            <select name="id_editorial" id="editarId_editorial" class="form-select js-editorial"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="editarAño_publicacion" class="form-label">Año de Publicación</label>
                            <input type="number" class="form-control" id="editarAño_publicacion" name="año_publicacion" required min="1900" max="2100">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="editarNumero_paginas" class="form-label">Número de Paginas</label>
                            <input type="number" class="form-control" id="editarNumero_paginas" name="numero_paginas" required min="1">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="editarIdioma" class="form-label">Idioma</label>
                            <input type="text" class="form-control" id="editarIdioma" name="idioma" required>
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-muted text-uppercase fw-bold text-center">Información de stock y precio</h5>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="editarStock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="editarStock" name="stock" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="editarStock_minimo" class="form-label">Stock Minimo</label>
                            <input type="number" class="form-control" id="editarStock_minimo" name="stock_minimo" required min="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="editarPrecio_compra" class="form-label">Precio Compra</label>
                            <input type="number" class="form-control" id="editarPrecio_compra" name="precio_compra" required min="1" step="0.01">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="editarPrecio_venta" class="form-label">Precio Venta</label>
                            <input type="number" class="form-control" id="editarPrecio_venta" name="precio_venta" required min="1" step="0.01">
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="editar_mostrar_catalogo" name="mostrar_catalogo" value="1">
                        <label class="form-check-label" for="editar_mostrar_catalogo">Mostrar en catálogo</label>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" style="background-color: #3b82f6; border-color: #3b82f6;">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETALLE LIBRO -->
<div class="modal fade" id="modalDetalleLibro" tabindex="-1" aria-labelledby="modalDetalleLibroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalDetalleLibroLabel">
                    Detalle del Libro
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 mt-3">
                        <div class="mb-3">
                            <strong>Portada:</strong>
                            <div class="">
                                <img id="d_foto" src="" alt="Portada actual" style="max-width: 250px; border-radius: 4px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mt-3">
                        <div class="mb-3">
                            <p class="mb-1">
                                <strong>ISBN:</strong>
                                <span id="d_isbn"></span>
                            </p>
                            <p class="mb-1">
                                <strong>Fecha y Hora de Ingreso:</strong>
                                <span id="d_fecha_ingreso"></span>
                            </p>
                            <p class="mb-1">
                                <strong>Nombre:</strong>
                                <span id="d_nombre"></span>
                            </p>
                            <p class="mb-1">
                                <strong>Categoria:</strong>
                                <span id="d_categoria"></span>
                            </p>
                            <p class="mb-1">
                                <strong>Autor:</strong>
                                <span id="d_autor"></span>
                            </p>
                            <p class="mb-1">
                                <strong>Editorial:</strong>
                                <span id="d_editorial"></span>
                            </p>
                            <p class="mb-1">
                                <strong>En el Catálogo:</strong>
                                <span id="d_mostrar"></span>
                            </p>
                            <p class="mb-1">
                                <strong>Descripción:</strong>
                                <span id="d_descripcion"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL MOVIMIENTO INVENTARIO -->
<div class="modal fade" id="modalMovimientoInventario" tabindex="-1" aria-labelledby="modalMovimientoInventarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalMovimientoInventarioLabel">
                    Movimiento de Inventario
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formMovimientoInventario">
                    <input type="hidden" id="mi_id_libro">
                    <div class="mb-2">
                        <strong>Libro:</strong> <span id="mi_nombre_libro"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Stock actual:</strong> <span id="mi_stock_actual"></span>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="mi_tipo" class="form-label">Tipo de movimiento</label>
                        <select id="mi_tipo" class="form-select" required>
                            <option value="INGRESO">Ingreso</option>
                            <option value="AJUSTE_POSITIVO">Ajuste positivo</option>
                            <option value="AJUSTE_NEGATIVO">Ajuste negativo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mi_cantidad" class="form-label">Cantidad</label>
                        <input type="number" min="1" class="form-control" id="mi_cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="mi_motivo" class="form-label">Motivo (opcional)</label>
                        <textarea id="mi_motivo" class="form-control" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        Guardar movimiento
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL HISTORIAL INVENTARIO -->
<div class="modal fade" id="modalHistorialInventario" tabindex="-1" aria-labelledby="modalHistorialInventarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalHistorialInventarioLabel">
                    Historial de Movimientos
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p><strong>Libro:</strong> <span id="hi_nombre_libro"></span></p>
                <div class="table-responsive">
                    <table id="tablaHistorialInventario" class="table table-bordered align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Stock antes</th>
                                <th class="text-center">Stock después</th>
                                <th class="w-25 text-center">Motivo</th>
                            </tr>
                        </thead>
                        <tbody id="hi_tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // DATATABLE DE LIBROS
        var tabla = $('#tablaLibros').DataTable({
            "ajax": {
                "url": "./controllers/librosController.php?accion=listarLibros",
                "dataSrc": ""
            },
            "columns": [
                { 
                    "data": "foto",
                    "render": function (data, type, row) {
                        if (!data) return '';
                        return `<img src="${data}" alt="Portada" style="width:45px; height:auto; border-radius:4px;">`;
                    }
                },
                { "data": "id_libro" },
                { "data": "isbn" },
                { "data": "nombre" },
                { 
                    "data": "precio_compra",
                    "render": function (data) {
                        return `S/. ${parseFloat(data).toFixed(2)}`;
                    }
                },
                { 
                    "data": "precio_venta",
                    "render": function (data) {
                        return `S/. ${parseFloat(data).toFixed(2)}`;
                    }
                },
                {
                    "data": "stock",
                    "render": function (data, type, row) {
                        if (parseInt(row.stock) < parseInt(row.stock_minimo)) {
                            return `<span style="color:red; font-weight:bold;">${data}</span>`;
                        }
                        return data;
                }
                },
                { "data": "stock_minimo" },
                { 
                    "data": "fecha_creacion",
                    "render": function (data) {
                        if (!data) return "";
                        const f = new Date(data);
                        return f.toLocaleDateString('es-PE');
                    }
                },
                {
                    "data": "estado",
                    "render": function (data) {
                        return data == 1
                            ? `<span class="badge bg-success">Activo</span>`
                            : `<span class="badge bg-danger">Inactivo</span>`;
                    }
                },
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "defaultContent": `
                            <button class="btn btn-primary btn-sm btn-ver"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-success btn-sm btn-inventario"><i class="bi bi-box-seam"></i></button>
                            <button class="btn btn-info btn-sm btn-editar"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-warning btn-sm btn-estado"><i class="bi bi-toggle-off"></i></button>
                            <button class="btn btn-danger btn-sm btn-eliminar"><i class="bi bi-trash"></i></button>
                        `,
                    "render": function(data, type, row) {
                        if (window.ID_USUARIO_SESION === 1) {
                            return `
                                <button class="btn btn-primary btn-sm btn-ver"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-success btn-sm btn-inventario"><i class="bi bi-box-seam"></i></button>
                                <button class="btn btn-info btn-sm btn-editar"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-warning btn-sm btn-estado"><i class="bi bi-toggle-off"></i></button>
                                <button class="btn btn-danger btn-sm btn-eliminar"><i class="bi bi-trash"></i></button>
                                <button class="btn btn-sm btn-secondary btn-historial" title="Ver historial">
                                    <i class="bi bi-clock-history"></i>
                                </button>
                            `
                        }
                    }
                }
            ],
            "createdRow": function (row, data, dataIndex) {
                if (parseInt(data.stock) < parseInt(data.stock_minimo)) {
                    $(row).addClass('table-danger');
                }
            },
            "columnDefs": [
                {
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    className: "dt-center"
                },
                {
                    target: 10,
                    className: "dt-center",
                    width: "20%"
                }
            ],
            "order": [[1, "asc"]],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });

        // MOSTRAR MENSAJE
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

        // EVENTO PARA VER LOS DETALLES DEL LIBRO
        $('#tablaLibros tbody').on('click', '.btn-ver', function() {
            const data = tabla.row($(this).parents('tr')).data();
            const id_libro = data.id_libro;

            // IMAGEN ACTUAL
            if (data.foto) {
                $('#d_foto').attr('src', data.foto).show();
            } else {
                $('#d_foto').attr('src', '').hide();
            }

            $('#d_isbn').text(data.isbn);
            $('#d_fecha_ingreso').text(data.fecha_creacion);
            $('#d_nombre').text(data.nombre);
            $('#d_categoria').text(data.categoria);
            $('#d_autor').text(data.autor);
            $('#d_editorial').text(data.editorial);
            $('#d_mostrar').text(
                data.mostrar === '1' ? 'Sí' : 'No'
            );
            $('#d_descripcion').text(data.descripcion);
            $('#modalDetalleLibro').modal('show');
        });

        // CARGAR SELECT2 PARA CATEGORÍA / AUTOR / EDITORIAL PARA EL FORMULARIO DE REGISTRAR
        var $modalAgregar = $('#modalAgregarLibro');
        var $contentAgregar = $modalAgregar.find('.modal-content');

        // CATEGORIAS
        $('#modalAgregarLibro .js-categoria').select2({
            dropdownParent: $contentAgregar,
            placeholder: 'Seleccione una categoría',
            ajax: {
                url: './controllers/librosController.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        accion: 'buscarCategorias',
                        term: params.term || ''
                    };
                },
                processResults: function (data) {
                    return data;
                },
                cache: true
            },
            theme: 'bootstrap-5',
            width: '100%'
        });
        
        // AUTORES Y CREACION DESDE EL SELECT2
        $('#modalAgregarLibro .js-autor').select2({
            dropdownParent: $contentAgregar,
            placeholder: 'Seleccione o escriba un autor',
            tags: true,
            ajax: {
                url: './controllers/librosController.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        accion: 'buscarAutores',
                        term: params.term || ''
                    };
                },
                processResults: function (data) {
                    return data;
                },
                cache: true
            },
            createTag: function (params) {
                return {
                    id: 'new:' + params.term,
                    text: params.term,
                    isNew: true
                };
            },
            theme: 'bootstrap-5',
            width: '100%'
        }).on('select2:select', function (e) {
            var data = e.params.data;
            if (data.isNew) {
                $.ajax({
                    url: './controllers/librosController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        accion: 'crearAutorRapido',
                        nombre: data.text
                    },
                    success: function (res) {
                        if (res.success) {
                            var newOption = new Option(res.text, res.id, true, true);
                            $('.js-autor').append(newOption).trigger('change');
                        } else {
                            mostrarMensaje('error', 'No se pudo crear el autor.');
                        }
                    }
                });
            }
        });

        // EDITORIALES Y CREACION DESDE EL SELECT2
        $('#modalAgregarLibro .js-editorial').select2({
            dropdownParent: $contentAgregar,
            placeholder: 'Seleccione o escriba una editorial',
            tags: true,
            ajax: {
                url: './controllers/librosController.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        accion: 'buscarEditoriales',
                        term: params.term || ''
                    };
                },
                processResults: function (data) {
                    return data;
                },
                cache: true
            },
            createTag: function (params) {
                return {
                    id: 'new:' + params.term,
                    text: params.term,
                    isNew: true
                };
            },
            theme: 'bootstrap-5',
            width: '100%'
        }).on('select2:select', function (e) {
            var data = e.params.data;
            if (data.isNew) {
                $.ajax({
                    url: './controllers/librosController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        accion: 'crearEditorialRapida',
                        nombre: data.text
                    },
                    success: function (res) {
                        if (res.success) {
                            var newOption = new Option(res.text, res.id, true, true);
                            $('.js-editorial').append(newOption).trigger('change');
                        } else {
                            mostrarMensaje('error', 'No se pudo crear la editorial.');
                        }
                    }
                });
            }
        });

        // REGISTRAR LIBRO
        $('#formularioAgregarLibro').on('submit', function (e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append('accion', 'registrarLibro');

            $.ajax({
                url: "./controllers/librosController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalAgregarLibro').modal('hide');

                        if (response.accion === 'restaurado') {
                            mostrarMensaje("success", response.message || "Libro restaurado correctamente.");
                        } else if (response.accion === 'creado') {
                            mostrarMensaje("success", response.message || "Libro registrado correctamente.");
                        } else {
                            mostrarMensaje("success", response.message || "Operación realizada correctamente.");
                        }

                        tabla.ajax.reload();
                        $('#formularioAgregarLibro')[0].reset();
                        $('.js-categoria, .js-autor, .js-editorial').val(null).trigger('change');
                    } else {
                        mostrarMensaje("error", response.message || "No se pudo registrar el libro.");
                    }
                }
            });
        });

        // LIMPIAR FORMULARIO DE REGISTRO
        $('#modalAgregarLibro').on('hidden.bs.modal', function () {
            $('#formularioAgregarLibro')[0].reset();
        });

        // BUSCAR DATOS POR ISBN API DE GOOGLE BOOKS
        $('#btnBuscarISBN').on('click', function () {
            const isbn = $('#isbn').val().trim();
            if (!isbn) {
                mostrarMensaje('warning', 'Ingresa un ISBN primero.');
                return;
            }

            // MENSAJE DE BUSCANDO
            let swalLoading;
            Swal.fire({
                title: 'Buscando libro...',
                text: 'Consultando Google Books por ISBN.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: 'https://www.googleapis.com/books/v1/volumes',
                method: 'GET',
                dataType: 'json',
                data: {
                    q: 'isbn:' + isbn
                },
                success: function (res) {
                    Swal.close();

                    if (!res.totalItems || !res.items || res.items.length === 0) {
                        mostrarMensaje('info', 'No se encontró ningún libro con ese ISBN.');
                        return;
                    }

                    const volume = res.items[0];
                    const info = volume.volumeInfo || {};

                    // TITULO Y DESCRIPCION
                    if (info.title) {
                        $('#nombre').val(info.title);
                    }
                    if (info.description) {
                        $('#descripcion').val(info.description);
                    }

                    // AUTOR
                    const authors = info.authors || [];
                    if (authors.length > 0) {
                        const autorNombre = authors[0];
                        const autorSelect = $('#id_autor');

                        // SELECCIONAR AUTOR SI ESTA EN EL SELECT
                        $.ajax({
                            url: './controllers/librosController.php',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                accion: 'buscarAutores',
                                term: autorNombre
                            },
                            success: function (data) {
                                const results = (data && data.results) ? data.results : [];

                                if (results.length > 0) {
                                    // SELECCIONA EL AUTOR SI EXISTE EN LA BASE DE DATOS
                                    const autorExistente = results[0];
                                    const opt = new Option(autorExistente.text, autorExistente.id, true, true);
                                    autorSelect.append(opt).trigger('change');
                                } else {
                                    // SI NO EXISTE CREARLO EN LA BASE DE DATOS
                                    $.ajax({
                                        url: './controllers/librosController.php',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {
                                            accion: 'crearAutorRapido',
                                            nombre: autorNombre
                                        },
                                        success: function (res) {
                                            if (res.success) {
                                                const newOpt = new Option(res.text, res.id, true, true);
                                                autorSelect.append(newOpt).trigger('change');
                                            } else {
                                                mostrarMensaje('error', 'No se pudo crear el autor desde Google Books.');
                                            }
                                        },
                                        error: function () {
                                            mostrarMensaje('error', 'Error al crear el autor desde Google Books.');
                                        }
                                    });
                                }
                            },
                            error: function () {
                                mostrarMensaje('error', 'Error al buscar el autor en la base de datos.');
                            }
                        });
                    }

                    // EDITORIAL
                    if (info.publisher) {
                        const editorialNombre = info.publisher;
                        const editorialSelect = $('#id_editorial');

                        // BUSCAR EDITORIAL EN LA BASE DE DATOS
                        $.ajax({
                            url: './controllers/librosController.php',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                accion: 'buscarEditoriales',
                                term: editorialNombre
                            },
                            success: function (data) {
                                const results = (data && data.results) ? data.results : [];

                                if (results.length > 0) {
                                    // SI YA EXISTE SELECCIONARLA
                                    const edExistente = results[0];
                                    const opt = new Option(edExistente.text, edExistente.id, true, true);
                                    editorialSelect.append(opt).trigger('change');
                                } else {
                                    // SI NO EXISTE CREARLA EN LA BASE DE DATOS
                                    $.ajax({
                                        url: './controllers/librosController.php',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {
                                            accion: 'crearEditorialRapida',
                                            nombre: editorialNombre
                                        },
                                        success: function (res) {
                                            if (res.success) {
                                                const newOptEd = new Option(res.text, res.id, true, true);
                                                editorialSelect.append(newOptEd).trigger('change');
                                            } else {
                                                mostrarMensaje('error', 'No se pudo crear la editorial desde Google Books.');
                                            }
                                        },
                                        error: function () {
                                            mostrarMensaje('error', 'Error al crear la editorial desde Google Books.');
                                        }
                                    });
                                }
                            },
                            error: function () {
                                mostrarMensaje('error', 'Error al buscar la editorial en la base de datos.');
                            }
                        });
                    }

                    // AÑO DE PUBLICACION
                    if (info.publishedDate) {
                        const yearMatch = info.publishedDate.match(/\d{4}/);
                        if (yearMatch) {
                            $('#año_publicacion').val(yearMatch[0]);
                        }
                    }

                    // NUMERO DE PAGINAS
                    if (info.pageCount) {
                        $('#numero_paginas').val(info.pageCount);
                    }

                    // IDIOMA
                    if (info.language) {
                        let idiomaTexto = info.language;
                        if (idiomaTexto.toLowerCase() === 'es') idiomaTexto = 'Español';
                        if (idiomaTexto.toLowerCase() === 'en') idiomaTexto = 'Inglés';
                        $('#idioma').val(idiomaTexto);
                    }

                    // PORTADA
                    let portadaUrl = null;

                    if (info.imageLinks && info.imageLinks.thumbnail) {
                        portadaUrl = info.imageLinks.thumbnail.replace('zoom=1', 'zoom=0');

                        $('#cover_from_google').remove();
                        $('<input>', {
                            type: 'hidden',
                            id: 'cover_from_google',
                            name: 'cover_from_google',
                            value: portadaUrl
                        }).appendTo('#formularioAgregarLibro');

                        mostrarMensaje('success', 'Libro encontrado y campos rellenados. Se usará la portada de Google Books si no subes una imagen.');
                    } else {
                        mostrarMensaje('success', 'Libro encontrado. Algunos campos fueron rellenados.');
                    }
                },
                error: function (xhr) {
                    Swal.close();
                    mostrarMensaje('error', 'Error al consultar Google Books. Intenta de nuevo.');
                    console.error('Google Books error:', xhr);
                }
            });
        });

        // CARGAR SELECT2 PARA CATEGORÍA / AUTOR / EDITORIAL PARA EL FORMULARIO DE EDITAR
        var $modalEditar = $('#modalEditarLibro');
        var $contentEditar = $modalEditar.find('.modal-content');

        // CATEGORIAS
        $('#modalEditarLibro .js-categoria').select2({
            dropdownParent: $contentEditar,
            placeholder: 'Seleccione una categoría',
            ajax: {
                url: './controllers/librosController.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        accion: 'buscarCategorias',
                        term: params.term || ''
                    };
                },
                processResults: function (data) {
                    return data;
                },
                cache: true
            },
            theme: 'bootstrap-5',
            width: '100%'
        });
        
        // AUTORES Y CREACION DESDE EL SELECT2
        $('#modalEditarLibro .js-autor').select2({
            dropdownParent: $contentEditar,
            placeholder: 'Seleccione o escriba un autor',
            tags: true,
            ajax: {
                url: './controllers/librosController.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        accion: 'buscarAutores',
                        term: params.term || ''
                    };
                },
                processResults: function (data) {
                    return data;
                },
                cache: true
            },
            createTag: function (params) {
                return {
                    id: 'new:' + params.term,
                    text: params.term,
                    isNew: true
                };
            },
            theme: 'bootstrap-5',
            width: '100%'
        }).on('select2:select', function (e) {
            var data = e.params.data;
            if (data.isNew) {
                $.ajax({
                    url: './controllers/librosController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        accion: 'crearAutorRapido',
                        nombre: data.text
                    },
                    success: function (res) {
                        if (res.success) {
                            var newOption = new Option(res.text, res.id, true, true);
                            $('.js-autor').append(newOption).trigger('change');
                        } else {
                            mostrarMensaje('error', 'No se pudo crear el autor.');
                        }
                    }
                });
            }
        });

        // EDITORIALES Y CREACION DESDE EL SELECT2
        $('#modalEditarLibro .js-editorial').select2({
            dropdownParent: $contentEditar,
            placeholder: 'Seleccione o escriba una editorial',
            tags: true,
            ajax: {
                url: './controllers/librosController.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        accion: 'buscarEditoriales',
                        term: params.term || ''
                    };
                },
                processResults: function (data) {
                    return data;
                },
                cache: true
            },
            createTag: function (params) {
                return {
                    id: 'new:' + params.term,
                    text: params.term,
                    isNew: true
                };
            },
            theme: 'bootstrap-5',
            width: '100%'
        }).on('select2:select', function (e) {
            var data = e.params.data;
            if (data.isNew) {
                $.ajax({
                    url: './controllers/librosController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        accion: 'crearEditorialRapida',
                        nombre: data.text
                    },
                    success: function (res) {
                        if (res.success) {
                            var newOption = new Option(res.text, res.id, true, true);
                            $('.js-editorial').append(newOption).trigger('change');
                        } else {
                            mostrarMensaje('error', 'No se pudo crear la editorial.');
                        }
                    }
                });
            }
        });
        
        // CARGAR DATOS EN EL MODAL DE EDICIÓN
        $('#tablaLibros tbody').on('click', '.btn-editar', function () {
            const data = tabla.row($(this).parents('tr')).data();

            $('#editarId_libro').val(data.id_libro);
            $('#editarIsbn').val(data.isbn);
            $('#editarNombre').val(data.nombre);
            $('#editarDescripcion').val(data.descripcion);
            $('#editarAño_publicacion').val(data.año_publicacion);
            $('#editarNumero_paginas').val(data.numero_paginas);
            $('#editarIdioma').val(data.idioma);
            $('#editarStock').val(data.stock);
            $('#editarStock_minimo').val(data.stock_minimo);
            $('#editarPrecio_compra').val(data.precio_compra);
            $('#editarPrecio_venta').val(data.precio_venta);
            
            // MOSTRAR EN CATALOGO
            if (data.mostrar == 1) {
                $('#editar_mostrar_catalogo').prop('checked', true);
            } else {
                $('#editar_mostrar_catalogo').prop('checked', false);
            }

            // IMAGEN ACTUAL
            $('#editarFoto_actual').val(data.foto || '');
            if (data.foto) {
                $('#editarPreviewFoto').attr('src', data.foto).show();
            } else {
                $('#editarPreviewFoto').attr('src', '').hide();
            }

            // CATEGORIA
            const $cat = $('#modalEditarLibro .js-categoria');
            $cat.empty().append(new Option(data.categoria, data.id_categoria, true, true)).trigger('change');

            // AUTOR
            const $aut = $('#modalEditarLibro .js-autor');
            $aut.empty().append(new Option(data.autor, data.id_autor, true, true)).trigger('change');

            // EDITORIAL
            const $edi = $('#modalEditarLibro .js-editorial');
            $edi.empty().append(new Option(data.editorial, data.id_editorial, true, true)).trigger('change');

            $('#modalEditarLibro').modal('show');
        });

        // ACTUALIZAR LIBRO
        $('#formularioEditarLibro').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('accion', 'actualizarLibro');

            $.ajax({
                url: "./controllers/librosController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalEditarLibro').modal('hide');
                        mostrarMensaje("success", response.message || "Libro actualizado correctamente.");
                        tabla.ajax.reload();
                    } else {
                        mostrarMensaje("error", response.message || "No se pudo actualizar el libro.");
                    }
                },
                error: function (xhr) {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        // LIMPIAR FORMULARIO DE EDICIÓN AL CERRAR
        $('#modalEditarLibro').on('hidden.bs.modal', function () {
            $('#formularioEditarLibro')[0].reset();
            $('#editarPreviewFoto').attr('src', '').hide();
            $('#editarId_categoria').val(null).trigger('change');
            $('#editarId_autor').val(null).trigger('change');
            $('#editarId_editorial').val(null).trigger('change');
        });

        // CAMBIAR ESTADO
        $('#tablaLibros tbody').on('click', '.btn-estado', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_libro;
            const nuevoEstado = data.estado == 1 ? 0 : 1;
            const texto = nuevoEstado == 1
                ? "El libro se activará."
                : "El libro se desactivará.";

            Swal.fire({
                title: "¿Cambiar estado?",
                text: texto,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, cambiar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./controllers/librosController.php",
                        type: "POST",
                        data: {
                            accion: 'cambiarEstadoLibro',
                            id_libro: id,
                            nuevoEstado: nuevoEstado
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Estado del libro actualizado correctamente.");
                                tabla.ajax.reload();
                            } else {
                                mostrarMensaje("error", response.message || "Error al cambiar el estado del libro.");
                            }
                        },
                        error: function () {
                            mostrarMensaje("error", "Error de comunicación con el servidor.");
                        }
                    });
                }
            });
        });

        // ELIMINAR
        $('#tablaLibros tbody').on('click', '.btn-eliminar', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_libro;

            Swal.fire({
                title: "¿Eliminar libro?",
                text: "El libro se marcará como eliminado y no aparecerá en el listado.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./controllers/librosController.php",
                        type: "POST",
                        data: {
                            accion: 'eliminarLibro',
                            id_libro: id
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Libro eliminado correctamente.");
                                tabla.ajax.reload();
                            } else {
                                mostrarMensaje("error", response.message || "Error al eliminar el libro.");
                            }
                        },
                        error: function () {
                            mostrarMensaje("error", "Error de comunicación con el servidor.");
                        }
                    });
                }
            });
        });

        // CLICK EN BOTON INVENTARIO (MOVIMIENTO)
        $('#tablaLibros tbody').on('click', '.btn-inventario', function(){
            const data = $('#tablaLibros').DataTable().row($(this).parents('tr')).data();
            $('#mi_id_libro').val(data.id_libro);
            $('#mi_nombre_libro').text(data.nombre);
            $('#mi_stock_actual').text(data.stock);
            $('#mi_cantidad').val('');
            $('#mi_motivo').val('');
            $('#mi_tipo').val('INGRESO');
            $('#modalMovimientoInventario').modal('show');
        });

        // ENVIAR MOVIMIENTO
        $('#formMovimientoInventario').on('submit', function(e){
            e.preventDefault();
            const id_libro = $('#mi_id_libro').val();
            const tipo     = $('#mi_tipo').val();
            const cantidad = $('#mi_cantidad').val();
            const motivo   = $('#mi_motivo').val();

            if (!id_libro || !cantidad || cantidad <= 0) {
                mostrarMensaje('warning', 'Complete la información del movimiento.');
                return;
            }

            $.ajax({
                url: './controllers/inventarioController.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    accion: 'registrarMovimiento',
                    id_libro: id_libro,
                    tipo: tipo,
                    cantidad: cantidad,
                    motivo: motivo
                },
                beforeSend: function(){
                    Swal.fire({
                        title: 'Registrando movimiento...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(res){
                    Swal.close();
                    if (!res.success) {
                        mostrarMensaje('error', res.message || 'No se pudo registrar el movimiento.');
                        return;
                    }
                    mostrarMensaje('success', res.message);
                    $('#modalMovimientoInventario').modal('hide');
                    $('#tablaLibros').DataTable().ajax.reload(null, false);
                },
                error: function(){
                    Swal.close();
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        });

        var tablaHistorialInventario = $('#tablaHistorialInventario').DataTable({
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            data: [],
            columns: [
                { data: 'fecha_mov', className: 'text-center' },
                { data: 'usuario',   className: 'text-center' },
                { data: 'tipo',      className: 'text-center',  render: function(data){
                    return data.replace(/_/g, " ");
                }},
                { data: 'cantidad',  className: 'text-center' },
                { data: 'stock_anterior', className: 'text-center' },
                { data: 'stock_nuevo',    className: 'text-center' },
                { data: 'motivo',    className: 'text-center' }
            ],
            order: [[0, 'desc']],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });

        $('#tablaLibros tbody').on('click', '.btn-historial', function(){
            const data = $('#tablaLibros').DataTable().row($(this).parents('tr')).data();
            const id_libro = data.id_libro;

            $('#hi_nombre_libro').text(data.nombre);

            $.ajax({
                url: './controllers/inventarioController.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    accion: 'listarMovimientos',
                    id_libro: id_libro
                },
                success: function(res){
                    if (!res.success) {
                        mostrarMensaje('error', res.message || 'No se pudo obtener el historial.');
                        return;
                    }
                    tablaHistorialInventario.clear();
                    tablaHistorialInventario.rows.add(res.data);
                    tablaHistorialInventario.draw();

                    $('#modalHistorialInventario').modal('show');
                },
                error: function(){
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        });

        // FECHA ACTUAL
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', options);
    });
</script>