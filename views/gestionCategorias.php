<div class="fade-in-up">
    <!-- Welcome Section -->
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Categorias</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Categorias</p>
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
                <!-- TARJETA DE CATEGORIAS TOTALES -->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2 small text-uppercase fw-bold">Total Categorías</h6>
                                    <h3 id="cardTotalCategorias" class="mb-1 fw-bold text-dark">0</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-folder text-primary fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TARJETA DE CATEGORIAS ACTIVAS -->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2 small text-uppercase fw-bold">Categorías Activas</h6>
                                    <h3 id="cardCategoriasActivas" class="mb-1 fw-bold text-dark">0</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-check text-success fs-4"></i>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

                <!-- TARJETA DE CATEGORIAS INACTIVAS -->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2 small text-uppercase fw-bold">Categorías Inactivas</h6>
                                    <h3 id="cardCategoriasInactivas" class="mb-1 fw-bold text-dark">0</h3>
                                </div>
                                <div class="bg-danger bg-opacity-10 p-3 rounded-3">
                                    <i class="fas fa-xmark text-danger fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Listado de Categorías</h3>
                            <button type="button" class="btn btn-primary ms-auto" style="background-color: #3b82f6; border-color: #3b82f6;" 
                                data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
                                <i class="fas fa-plus"></i> Agregar Categoría
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tablaCategorias" class="table hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>DESCRIPCION</th>
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

<!--MODAL PARA AGREGAR UNA CATEGORIA-->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalAgregarCategoriaLabel">Registrar nueva categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioAgregarCategoria" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--MODAL PARA EDITAR UNA CATEGORIA-->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalEditarCategoriaLabel">Editar categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioEditarCategoria" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="editarId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="editarId" name="id_categoria" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarDescripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="editarDescripcion" name="descripcion" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // ACTUALIZAR CONTADORES
        actualizarContadoresCategorias();
        
        // DATATABLE DE CATEGORIAS
        var tabla = $('#tablaCategorias').DataTable({
            "ajax": {
                "url": "./controllers/categoriasController.php?accion=obtenerCategorias",
                "dataSrc": ""
            },
            "columns": [
                {"data": "id_categoria"},
                {"data": "nombre"},
                {"data": "descripcion"},
                {"data": "estado"},
                {
                    "data": null,
                    "defaultContent": `<button class="btn btn-info btn-sm btn-editar"><i class="bi bi-pencil-square"></i></button>
                                       <button class="btn btn-warning btn-sm btn-estado"><i class="bi bi-toggle-off"></i></button>
                                       <button class="btn btn-danger btn-sm btn-eliminar"><i class="bi bi-trash"></i></button>`,
                }
            ],
            "columnDefs": [
                { targets: 0, width: "60px" },
                { targets: 1, width: "160px" },
                { targets: 2, width: "450px" },
                {
                    targets: 3,
                    width: "120px",
                    render: function (data, type, row) {
                        if (data == 1) {
                            return `<span class="badge bg-success">Activo</span>`;
                        } else {
                            return `<span class="badge bg-danger">Inactivo</span>`;
                        }
                    }
                },
                {
                    targets: 0,        
                    className: "dt-left"
                },
                { targets: 4, width: "150px" }
            ],
            
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

        // REGISTRAR CATEGORIA
        $('#formularioAgregarCategoria').on('submit', function (e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append('accion', 'registrarCategoria');

            $.ajax({
                url: "./controllers/categoriasController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalAgregarCategoria').modal('hide');

                        // Mensajes personalizados según la acción
                        if (response.accion === 'restaurada') {
                            mostrarMensaje("success", response.message || "Categoría restaurada correctamente.");
                        } else if (response.accion === 'creada') {
                            mostrarMensaje("success", response.message || "Categoría registrada correctamente.");
                        } else {
                            mostrarMensaje("success", response.message || "Operación realizada correctamente.");
                        }

                        tabla.ajax.reload();
                        actualizarContadoresCategorias();
                    } else {
                        mostrarMensaje("error", response.message || "Error al registrar la categoría.");
                    }
                },
                error: function () {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        // LIMPIAR FORMULARIO DE REGISTRO
        $('#modalAgregarCategoria').on('hidden.bs.modal', function () {
            $('#formularioAgregarCategoria')[0].reset();
        });

        //ACTUALIZAR UNA CATEGORIA
        $('#tablaCategorias').on('click', '.btn-editar', function () {
            var data = tabla.row($(this).parents('tr')).data();
            $('#editarId').val(data.id_categoria);
            $('#editarNombre').val(data.nombre);
            $('#editarDescripcion').val(data.descripcion);
            $('#modalEditarCategoria').modal('show');
        });

        //GUARDAR CAMBIOS DE EDICIÓN
        $('#formularioEditarCategoria').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('id_categoria', $('#editarId').val());
            formData.append('accion', 'actualizarCategoria');

            $.ajax({
                url: "./controllers/categoriasController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalEditarCategoria').modal('hide');
                        mostrarMensaje("success", response.message || "Categoría actualizada correctamente.");
                        tabla.ajax.reload();
                        actualizarContadoresCategorias();
                    } else {
                        mostrarMensaje("error", response.message || "Error al actualizar la categoría.");
                    }
                },
                error: function (xhr, status, error) {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        // LIMPIAR FORMULARIO DE EDICIÓN AL CERRAR MODAL
        $('#modalEditarCategoria').on('hidden.bs.modal', function () {
            $('#formularioEditarCategoria')[0].reset();
        });

        // CAMBIAR ESTADO
        $('#tablaCategorias tbody').on('click', '.btn-estado', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_categoria;
            const nuevoEstado = data.estado == 1 ? 0 : 1;
            const texto = nuevoEstado == 1
                ? "La categoría se activará"
                : "La categoría se desactivará";

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
                        url: "./controllers/categoriasController.php",
                        type: "POST",
                        data: {
                            accion: 'cambiarEstadoCategoria',
                            id_categoria: id,
                            nuevoEstado: nuevoEstado
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Estado de la categoría actualizado correctamente.");
                                tabla.ajax.reload();
                                actualizarContadoresCategorias();
                            } else {
                                mostrarMensaje("error", response.message || "Error al cambiar el estado de la categoría.");
                            }
                        },
                        error: function () {
                            mostrarMensaje("error", "Error de comunicación con el servidor.");
                        }
                    });
                }
            });
        });

        // ELIMINAR, SOFT DELETE -> ESTADO = 2
        $('#tablaCategorias tbody').on('click', '.btn-eliminar', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_categoria;

            Swal.fire({
                title: "¿Eliminar categoría?",
                text: "La categoría se eliminará.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./controllers/categoriasController.php",
                        type: "POST",
                        data: {
                            accion: 'eliminarCategoria',
                            id_categoria: id
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Categoría eliminada correctamente.");
                                tabla.ajax.reload();
                                actualizarContadoresCategorias();
                            } else {
                                mostrarMensaje("error", response.message || "Error al eliminar la categoría.");
                            }
                        },
                        error: function () {
                            mostrarMensaje("error", "Error de comunicación con el servidor.");
                        }
                    });
                }
            });
        });

        // CONTADORES PARA LAS TARJETAS
        function actualizarContadoresCategorias() {
            $.ajax({
                url: "./controllers/categoriasController.php",
                type: "GET",
                data: { accion: 'contadores' },
                dataType: "json",
                success: function (data) {
                    $("#cardTotalCategorias").text(data.total);
                    $("#cardCategoriasActivas").text(data.activas);
                    $("#cardCategoriasInactivas").text(data.inactivas);
                }
            });
        }

        // FECHA ACTUAL
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', options);
    });
</script>