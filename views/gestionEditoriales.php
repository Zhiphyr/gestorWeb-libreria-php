<div class="fade-in-up">
    <!-- Welcome Section -->
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Editoriales</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Editoriales</p>
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
                            <h3 class="card-title">Listado de Editoriales</h3>
                            <button type="button" class="btn btn-primary ms-auto" style="background-color: #3b82f6; border-color: #3b82f6;" 
                                data-bs-toggle="modal" data-bs-target="#modalAgregarEditorial">
                                <i class="fas fa-plus"></i> Agregar Editorial
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tablaEditoriales" class="table hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>ESTADO</th>
                                        <th>FECHA REGISTRO</th>
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

<!--MODAL PARA AGREGAR UN EDITORIAL-->
<div class="modal fade" id="modalAgregarEditorial" tabindex="-1" aria-labelledby="modalAgregarEditorialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalAgregarEditorialLabel">Registrar editorial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioAgregarEditorial" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--MODAL PARA EDITAR UN EDITORIAL-->
<div class="modal fade" id="modalEditarEditorial" tabindex="-1" aria-labelledby="modalEditarEditorialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalEditarEditorialLabel">Editar editorial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioEditarEditorial" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // DATATABLE DE EDITORIALES
        var tabla = $('#tablaEditoriales').DataTable({
            "ajax": {
                "url": "./controllers/editorialesController.php?accion=listarEditoriales",
                "dataSrc": ""
            },
            "columns": [
                { "data": "id_editorial" },
                { "data": "nombre" },
                {
                    "data": "estado",
                    "render": function (data) {
                        return data == 1
                            ? `<span class="badge bg-success">Activo</span>`
                            : `<span class="badge bg-danger">Inactivo</span>`;
                    }
                },
                {
                    "data": "fecha_creacion",
                    "render": function (data) {
                        if (!data) return "";
                        const f = new Date(data);
                        return f.toLocaleDateString('es-PE');
                    }
                },
                {
                    "data": null,
                    "defaultContent": `
                        <button class="btn btn-info btn-sm btn-editar"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-warning btn-sm btn-estado"><i class="bi bi-toggle-off"></i></button>
                        <button class="btn btn-danger btn-sm btn-eliminar"><i class="bi bi-trash"></i></button>
                    `
                }
            ],
            "columnDefs": [
                {
                    targets: 0,        
                    className: "dt-left"
                },
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

        // REGISTRAR EDITORIAL
        $('#formularioAgregarEditorial').on('submit', function (e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append('accion', 'registrarEditorial');

            $.ajax({
                url: "./controllers/editorialesController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalAgregarEditorial').modal('hide');

                        if (response.accion === 'restaurado') {
                            mostrarMensaje("success", response.message || "Editorial restaurada correctamente.");
                        } else if (response.accion === 'creado') {
                            mostrarMensaje("success", response.message || "Editorial registrada correctamente.");
                        } else {
                            mostrarMensaje("success", response.message || "Operación realizada correctamente.");
                        }

                        tabla.ajax.reload();
                        $('#formularioAgregarEditorial')[0].reset();
                    } else {
                        mostrarMensaje("error", response.message || "No se pudo registrar la editorial.");
                    }
                },
                error: function () {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        // LIMPIAR FORMULARIO DE REGISTRO
        $('#modalAgregarEditorial').on('hidden.bs.modal', function () {
            $('#formularioAgregarEditorial')[0].reset();
        });

        // EDITAR: abrir modal con datos
        let idEditorialEditar = null;

        $('#tablaEditoriales tbody').on('click', '.btn-editar', function () {
            const data = tabla.row($(this).parents('tr')).data();
            idEditorialEditar = data.id_editorial;

            $('#editarNombre').val(data.nombre);
            $('#modalEditarEditorial').modal('show');
        });

        // GUARDAR EDICIÓN
        $('#formularioEditarEditorial').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('accion', 'actualizarEditorial');
            formData.append('id_editorial', idEditorialEditar);

            $.ajax({
                url: "./controllers/editorialesController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalEditarEditorial').modal('hide');
                        mostrarMensaje("success", response.message || "Editorial actualizada correctamente.");
                        tabla.ajax.reload();
                    } else {
                        mostrarMensaje("error", response.message || "No se pudo actualizar la editorial.");
                    }
                },
                error: function () {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        // CAMBIAR ESTADO
        $('#tablaEditoriales tbody').on('click', '.btn-estado', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_editorial;
            const nuevoEstado = data.estado == 1 ? 0 : 1;
            const texto = nuevoEstado == 1
                ? "La editorial se activará."
                : "La editorial se desactivará.";

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
                        url: "./controllers/editorialesController.php",
                        type: "POST",
                        data: {
                            accion: 'cambiarEstadoEditorial',
                            id_editorial: id,
                            nuevoEstado: nuevoEstado
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Estado de la editorial actualizado correctamente.");
                                tabla.ajax.reload();
                            } else {
                                mostrarMensaje("error", response.message || "Error al cambiar el estado de la editorial.");
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
        $('#tablaEditoriales tbody').on('click', '.btn-eliminar', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_editorial;

            Swal.fire({
                title: "¿Eliminar editorial?",
                text: "La editorial se marcará como eliminada.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./controllers/editorialesController.php",
                        type: "POST",
                        data: {
                            accion: 'eliminarEditorial',
                            id_editorial: id
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Editorial eliminada correctamente.");
                                tabla.ajax.reload();
                            } else {
                                mostrarMensaje("error", response.message || "Error al eliminar la editorial.");
                            }
                        },
                        error: function () {
                            mostrarMensaje("error", "Error de comunicación con el servidor.");
                        }
                    });
                }
            });
        });

        // FECHA ACTUAL
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', options);
    });
</script>