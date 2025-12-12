<div class="fade-in-up">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Perfiles</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Perfiles</p>
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
                            <h3 class="card-title">Listado de Perfiles</h3>
                            <button type="button" class="btn btn-primary ms-auto" style="background-color: #3b82f6; border-color: #3b82f6;" 
                                data-bs-toggle="modal" data-bs-target="#modalAgregarPerfil">
                                <i class="fas fa-plus"></i> Agregar Perfil
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tablaPerfiles" class="table hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>DESCRIPCIÓN</th>
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

<!--MODAL PARA AGREGAR UN PERFIL-->
<div class="modal fade" id="modalAgregarPerfil" tabindex="-1" aria-labelledby="modalAgregarPerfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalAgregarPerfilLabel">Registrar nuevo perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioAgregarPerfil" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" style="background-color: #3b82f6; border-color: #3b82f6;">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--MODAL PARA EDITAR UN PERFIL-->
<div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalEditarPerfilLabel">Editar perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioEditarPerfil" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="editarId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="editarId" name="id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarDescripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editarDescripcion" name="descripcion" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" style="background-color: #3b82f6; border-color: #3b82f6;">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPermisos" tabindex="-1" aria-labelledby="modalPermisosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalPermisosLabel">Gestionar Permisos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Seleccione las opciones a las que este perfil tendrá acceso:</p>
                <form id="formPermisos" enctype="multipart/form-data">
                    <input type="hidden" name="id_perfil" id="idPerfilPermisos">
                    <div id="contenedorOpciones"></div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-white" style="background-color: #3b82f6; border-color: #3b82f6;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // DATATABLE DE PERFILES
        var tabla = $('#tablaPerfiles').DataTable({
            "ajax": {
                "url": "./controllers/perfilesController.php?accion=obtenerPerfiles",
                "dataSrc": ""
            },
            "columns": [
                {"data": "id"},
                {"data": "nombre"},
                {"data": "descripcion"},
                {"data": "estado"},
                {
                    "data": null,
                    "defaultContent": `<button class= "btn btn-secondary btn-sm btn-permisos"><i class="bi bi-shield-check"></i></button>
                                       <button class="btn btn-info btn-sm btn-editar"><i class="bi bi-pencil-square"></i></button>
                                       <button class="btn btn-warning btn-sm btn-estado"><i class="bi bi-toggle-off"></i></button>
                                       <button class="btn btn-danger btn-sm btn-eliminar"><i class="bi bi-trash"></i></button>`,
                    "render": function (data, type, row) {
                        if (row.id == 1) {
                            return `
                                <button class="btn btn-secondary btn-sm btn-permisos" disabled>
                                    <i class="bi bi-shield-check"></i>
                                </button>
                                <button class="btn btn-info btn-sm btn-editar" disabled>
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-warning btn-sm btn-estado" disabled>
                                    <i class="bi bi-toggle-off"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-eliminar" disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            `;
                        }
                    }    
                }
            ],
            "columnDefs": [
                {
                    targets: 3,
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
                {
                    targets: 4,        
                    className: "dt-left"
                }
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

        // AGREGAR PERFIL
        $('#formularioAgregarPerfil').submit(function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append('accion', 'agregarPerfil');

            $.ajax({
                url: './controllers/perfilesController.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#modalAgregarPerfil').modal('hide');
                        mostrarMensaje('success', 'Perfil agregado correctamente');
                        tabla.ajax.reload();
                    } else {
                        mostrarMensaje('error', 'Error al agregar el perfil ' + (response.message || ''));
                    }
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        });

        // LIMPIAR FORMULARIO DE REGISTRO
        $('#modalAgregarPerfil').on('hidden.bs.modal', function() {
            $('#formularioAgregarPerfil')[0].reset();
        });

        // CAMBIAR ESTADO
        $('#tablaPerfiles tbody').on('click', '.btn-estado', function() {
            var data = tabla.row($(this).parents('tr')).data();
            var id = data.id;
            var nuevoEstado = data.estado == 1 ? 0 : 1;
            var texto = nuevoEstado == 1
                ? "El perfil se activará"
                : "El perfil se desactivará";

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
                    cambiarEstadoPerfil(id, nuevoEstado);
                }
            });
        });

        function cambiarEstadoPerfil(id, nuevoEstado) {
            $.ajax ({
                url: './controllers/perfilesController.php',
                type: 'POST',
                data: {
                    accion: 'cambiarEstadoPerfil',
                    id: id,
                    nuevoEstado: nuevoEstado
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        mostrarMensaje('success', 'Estado del perfil actualizado correctamente');
                        tabla.ajax.reload();
                    } else {
                        mostrarMensaje('error', 'Error al actualizar el estado del perfil' + (response.message || ''));
                    }
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        }

        // ELIMINAR, SOFT DELETE -> ESTADO = 2
        $('#tablaPerfiles tbody').on('click', '.btn-eliminar', function() {
            var data = tabla.row($(this).parents('tr')).data();
            var id = data.id;
            var texto = "El perfil se eliminará";

            Swal.fire({
                title: "¿Eliminar perfil?",
                text: texto,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarPerfil(id);
                }
            });
        });

        function eliminarPerfil(id) {
            $.ajax ({
                url: './controllers/perfilesController.php',
                type: 'POST',
                data: {
                    accion: 'eliminarPerfil',
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        mostrarMensaje('success', 'Perfil eliminado correctamente');
                        tabla.ajax.reload();
                    } else {
                        mostrarMensaje('error', 'Error al eliminar el perfil' + (response.message || ''));
                    }
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        }

        //ACTUALIZAR UN PERFIL
        $('#tablaPerfiles tbody').on('click', '.btn-editar', function() {
            var data = tabla.row($(this).parents('tr')).data();
            $('#editarId').val(data.id);
            $('#editarNombre').val(data.nombre);
            $('#editarDescripcion').val(data.descripcion);
            $('#modalEditarPerfil').modal('show');
        });

        //GUARDAR CAMBIOS DE EDICION
        $('#formularioEditarPerfil').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('accion', 'actualizarPerfil');

            $.ajax ({
                url: './controllers/perfilesController.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#modalEditarPerfil').modal('hide');
                        mostrarMensaje('success', 'Perfil editado correctamente');
                        tabla.ajax.reload();
                    } else {
                        mostrarMensaje('error', 'Error al editar el perfil' + (response.message || ''));
                    }
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        });

        //PERMISOS
        //ABRIR MODAL DE PERMISOS
        $('#tablaPerfiles tbody').on('click', '.btn-permisos', function() {
            var data = tabla.row($(this).parents('tr')).data();
            cargarPermisosPerfil(data.id);
        });

        function cargarPermisosPerfil(idPerfil) {
            $.ajax({
                url: './controllers/opcionesController.php',
                type: 'POST',
                data: {
                    accion: 'obtenerPermisos',
                    id_perfil: idPerfil
                },
                dataType: 'json',
                success: function(response) {
                    if (!response.success) {
                        mostrarMensaje('error', 'Error al cargar permisos' + (response.message || ''));
                        return;
                    }

                    const opciones = response.data.todas;
                    const asignadas = response.data.asignadas;
                    let html = "";

                    opciones.forEach(op => {
                        const isChecked = asignadas.includes(op.id) ? "checked" : "";
                        html += `
                        <label class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="opciones[]" value="${op.id}" ${isChecked}>
                            <i class="${op.icono}"></i> ${op.nombre}
                        </label>`;
                    });
                    
                    
                    $("#contenedorOpciones").html(html);
                    $("#idPerfilPermisos").val(idPerfil);
                    $("#modalPermisos").modal("show");
                }
            });
        }

        //GUARDAR PERMISOS
        $("#formPermisos").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('accion', 'guardarPermisos');
            
            $.ajax({
                url: './controllers/opcionesController.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (!response.success) {
                        mostrarMensaje('error', 'Error al guardar permisos' + (response.message || ''));
                        return;
                    }
                    mostrarMensaje('success', 'Permisos guardados correctamente');
                    $("#modalPermisos").modal("hide");
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor');
                }
            });
        });

        // FECHA ACTUAL
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', options);
    });
</script>