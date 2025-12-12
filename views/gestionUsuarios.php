<div class="fade-in-up">
    <!-- Welcome Section -->
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Usuarios</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Usuarios</p>
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
            <div class="row g-4 mb-5">
                <!-- TARJETA DE USUARIOS REGISTRADOS-->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa fas fa-user fa-lg"></i>
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill"> </span>
                            </div>
                            <h2 class="mb-1 fw-bold text-dark" id="cardRegistrados">0</h2>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Usuarios Registrados</p>
                        </div>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <!-- TARJETA DE USUARIOS ACTIVOS-->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-success bg-opacity-10 text-success rounded-3 p-3">
                                    <i class="fa fas fa-user-check fa-lg"></i>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill"> </span>
                            </div>
                            <h2 class="mb-1 fw-bold text-dark" id="cardActivos">0</h2>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Usuarios Activos</p>
                        </div>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <!-- TARJETA DE USUARIOS INACTIVOS-->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden stat-card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-3 p-3">
                                    <i class="fa fas fa-user-xmark fa-lg"></i>
                                </div>
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill"> </span>
                            </div>
                            <h2 class="mb-1 fw-bold text-dark" id="cardInactivos">0</h2>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Usuarios Inactivos</p>
                        </div>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Listado de Usuarios</h3>
                            <button type="button" class="btn btn-primary ms-auto" style="background-color: #3b82f6; border-color: #3b82f6;" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
                                <i class="fas fa-plus"></i> Agregar Usuario
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tablaUsuarios" class="table hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>USUARIO</th>
                                        <th>PERFIL</th>
                                        <th>CORREO</th>
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

<!--MODAL PARA AGREGAR UN USUARIO-->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalAgregarUsuarioLabel">Registrar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioAgregarUsuario" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="clave" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="clave" name="clave" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_perfil" class="form-label">Perfil</label>
                        <select class="form-select" id="id_perfil" name="id_perfil" required>
                            <option value="" disabled selected>Seleccione un perfil...</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--MODAL PARA EDITAR UN USUARIO-->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalEditarUsuarioLabel">Editar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioEditarUsuario" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="editarId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="editarId" name="id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarUsuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="editarUsuario" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarCorreo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="editarCorreo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarIdPerfil" class="form-label">Perfil</label>
                        <select class="form-select" id="editarIdPerfil" name="id_perfil" required>
                            <option value="" disabled selected>Seleccione un perfil...</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // ACTUALIZAR CONTADORES
        actualizarContadores();

        // DATATABLE DE USUARIOS
        var tabla = $('#tablaUsuarios').DataTable({
            "ajax": {
                "url": "./controllers/usuariosController.php?accion=listarUsuarios",
                "dataSrc": ""
            },
            "columns": [
                { "data": "id" },
                { "data": "nombre" },
                { "data": "usuario" },
                { "data": "perfil" },
                { "data": "correo" },
                { "data": "estado" },
                {
                    "data": "fecha_registro",
                    "render": function (data) {
                        if (!data) return "";
                        const f = new Date(data);
                        return f.toLocaleDateString('es-PE');
                    }
                },
                {
                    "data": null,
                    "defaultContent": `<button class="btn btn-info btn-sm btn-editar"><i class="bi bi-pencil-square"></i></button>
                                       <button class="btn btn-warning btn-sm btn-estado"><i class="bi bi-toggle-off"></i></button>
                                       <button class="btn btn-danger btn-sm btn-eliminar"><i class="bi bi-trash"></i></button>`,              
                }
            ],
            "columnDefs": [
                {
                    targets: 5,
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
                    targets: 6,        
                    className: "dt-left"
                },
                {
                    targets: 7,        
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

        //CARGAR PERFILES PARA REGISTRO
        $('#modalAgregarUsuario').on('shown.bs.modal', function () {
            $.ajax({
                url: "./controllers/usuariosController.php?accion=cargarPerfiles",
                type: "GET",
                dataType: "json",
                success: function (perfiles) {

                    let select = $("#id_perfil");
                    select.empty();
                    select.append('<option value="" disabled selected>Seleccione un perfil...</option>');

                    perfiles.forEach(function(perfil) {
                        select.append(`<option value="${perfil.id}">${perfil.nombre}</option>`);
                    });
                },
                error: function () {
                    mostrarMensaje("error", "No se pudieron cargar los perfiles.");
                }
            });
        });

        // REGISTRAR USUARIOS
        $('#formularioAgregarUsuario').on('submit', function (e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append('accion', 'registrarUsuario');

            $.ajax({
                url: "./controllers/usuariosController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalAgregarUsuario').modal('hide');
                        mostrarMensaje("success", "Usuario registrado correctamente.");
                        tabla.ajax.reload();
                        actualizarContadores();
                    } else {
                        mostrarMensaje("error", "Error al registrar el usuario.");
                    }
                },
                error: function () {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        // LIMPIAR FORMULARIO DE REGISTRO
        $('#modalAgregarUsuario').on('hidden.bs.modal', function() {
            $('#formularioAgregarUsuario')[0].reset();
        });

        // CARGAR PERFILES Y SELECCIONAR ACTUAL AL EDITAR
        let idUsuarioEditar = null;

        $('#tablaUsuarios tbody').on('click', '.btn-editar', function () {
            const data = tabla.row($(this).parents('tr')).data();

            idUsuarioEditar = data.id;

            $('#editarId').val(data.id);
            $('#editarNombre').val(data.nombre);
            $('#editarUsuario').val(data.usuario);
            $('#editarCorreo').val(data.correo);
            cargarSelectPerfiles(data.id_perfil);
            $('#modalEditarUsuario').modal('show');
        });

        function cargarSelectPerfiles(perfilSeleccionado) {
            $.ajax({
                url: './controllers/usuariosController.php',
                type: 'POST',
                data: { accion: 'cargarPerfiles' },
                dataType: 'json',
                success: function (response) {
                    const select = $('#editarIdPerfil');
                    select.empty();
                    select.append(`<option disabled>Seleccione un perfil...</option>`);
                    response.forEach(item => {
                        const selected = item.id == perfilSeleccionado ? 'selected' : '';
                        select.append(`<option value="${item.id}" ${selected}>${item.nombre}</option>`);
                    });
                }
            });
        }

        // GUARDAR CAMBIOS DE EDICION
        $('#formularioEditarUsuario').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('accion', 'actualizarUsuario');

            $.ajax({
                url: './controllers/usuariosController.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#modalEditarUsuario').modal('hide');
                        mostrarMensaje('success', 'Usuario actualizado correctamente.');
                        tabla.ajax.reload();
                        actualizarContadores();
                    } else {
                        mostrarMensaje('error', 'Error al actualizar el usuario.' + (response.message || ''));
                    }
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
            
        });

        // LIMPIAR FORMULARIO DE EDICION
        $('#modalEditarUsuario').on('hidden.bs.modal', function() {
            $('#formularioEditarUsuario')[0].reset();
        });

        // CAMBIAR ESTADO
        $('#tablaUsuarios tbody').on('click', '.btn-estado', function() {
            var data = tabla.row($(this).parents('tr')).data();
            var id = data.id;
            var nuevoEstado = data.estado == 1 ? 0 : 1;
            var texto = nuevoEstado == 1
                ? "El usuario se activará"
                : "El usuario se desactivará";

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
                    cambiarEstadoUsuario(id, nuevoEstado);
                }
            });
        });

        function cambiarEstadoUsuario(id, nuevoEstado) {
            $.ajax ({
                url: './controllers/usuariosController.php',
                type: 'POST',
                data: {
                    accion: 'cambiarEstadoUsuario',
                    id: id,
                    nuevoEstado: nuevoEstado
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        mostrarMensaje('success', 'Estado del usuario cambiado correctamente');
                        tabla.ajax.reload();
                        actualizarContadores();
                    } else {
                        mostrarMensaje('error', 'Error al cambiar el estado del usuario' + (response.message || ''));
                    }
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        }

        // ELIMINAR, SOFT DELETE -> ESTADO = 2
        $('#tablaUsuarios tbody').on('click', '.btn-eliminar', function() {
            var data = tabla.row($(this).parents('tr')).data();
            var id = data.id;
            var texto = "El usuario se eliminará";

            Swal.fire({
                title: "¿Eliminar usuario?",
                text: texto,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarUsuario(id);
                }
            });
        });

        function eliminarUsuario(id) {
            $.ajax ({
                url: './controllers/usuariosController.php',
                type: 'POST',
                data: {
                    accion: 'eliminarUsuario',
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        mostrarMensaje('success', 'Usuario eliminado correctamente');
                        tabla.ajax.reload();
                        actualizarContadores();
                    } else {
                        mostrarMensaje('error', 'Error al eliminar el usuario' + (response.message || ''));
                    }
                },
                error: function() {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        }

        //CONTADORES
        function actualizarContadores(){
            $.ajax({
                url: "./controllers/usuariosController.php",
                type: "GET",
                data: { accion: 'contadores' },
                dataType: "json",
                success: function (data) {
                    $("#cardRegistrados").text(data.registrados);
                    $("#cardActivos").text(data.activos);
                    $("#cardInactivos").text(data.inactivos);
                }
            });
        }

        // FECHA ACTUAL
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', options);
        
    });
</script>