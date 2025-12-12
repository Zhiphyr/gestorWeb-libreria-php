<div class="fade-in-up">
    <!-- Welcome Section -->
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Clientes</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Clientes</p>
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
                            <h3 class="card-title">Listado de Clientes</h3>
                            <button type="button" class="btn btn-primary ms-auto" style="background-color: #3b82f6; border-color: #3b82f6;" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">
                                <i class="fas fa-plus"></i> Agregar Cliente
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tablaClientes" class="table hover order-column" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>DOCUMENTO</th>
                                        <th>TELEFONO</th>
                                        <th>CORREO</th>
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

<!--MODAL PARA AGREGAR UN CLIENTE-->
<div class="modal fade" id="modalAgregarCliente" tabindex="-1" aria-labelledby="modalAgregarClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalAgregarClienteLabel">Registrar cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioAgregarCliente" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="documento" class="form-label">Número de Documento</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary" id="btnBuscarDocumento" type="button"><i class="bi bi-search"></i></button>
                            </div>
                            <input type="number" class="form-control" id="documento" name="documento" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>                    
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--MODAL PARA EDITAR UN CLIENTE-->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="modalEditarClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalEditarClienteLabel">Editar cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioEditarCliente" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="editarId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="editarId" name="id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editarDocumento" class="form-label">Número de Documento</label>
                        <input type="number" class="form-control" id="editarDocumento" name="documento" readonly>
                    </div> 
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                    </div>                    
                    <div class="mb-3">
                        <label for="editarTelefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="editarTelefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarCorreo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="editarCorreo" name="correo" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var tabla = $('#tablaClientes').DataTable({
            "ajax": {
                "url": "./controllers/clientesController.php?accion=listarClientes",
                "dataSrc": ""
            },
            "columns": [
                { "data": "id_cliente" },
                { "data": "nombre" },
                { "data": "documento" },
                { 
                    "data": "telefono",
                    "render": function (data) {
                        return data == null
                            ? '<p>N/A</p>'
                            : data;
                    }
                },
                { 
                    "data": "correo",
                    "render": function (data) {
                        return data == null
                            ? '<p>N/A</p>'
                            : data;
                    }
                },
                {
                    "data": "estado",
                    "render": function (data) {
                        return data == 1
                            ? '<span class="badge bg-success">Activo</span>'
                            : '<span class="badge bg-danger">Inactivo</span>';
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
                {
                    targets: 2,
                    className: "dt-left"
                },
                {
                    targets: 3,
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

        // BUSCAR DOCUMENTO (DNI/RUC)
        $('#btnBuscarDocumento').on('click', function () {
            const doc = $('#documento').val().trim();
            if (!doc) {
                mostrarMensaje('warning', 'Ingresa un número de documento.');
                return;
            }

            let url = '';
            if (doc.length === 8) {
                url = 'https://miapi.cloud/v1/dni/' + doc;
            } else {
                url = 'https://miapi.cloud/v1/ruc/' + doc;
            }

            Swal.fire({
                title: 'Buscando...',
                text: 'Consultando datos del documento.',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            fetch(url, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjo2MjIsImV4cCI6MTc2NTA3MjY1OH0.chzu244kjV7RoWz9bENDPLn3QHl_SBYaWWBbMi6cyLM',
                    'Content-Type': 'application/json'
                }
            })
            .then(resp => resp.json())
            .then(data => {
                Swal.close();

                if (!data.success || !data.datos) {
                    mostrarMensaje('info', 'No se encontraron datos para ese documento.');
                    return;
                }

                if (doc.length === 8) {
                    const d = data.datos;
                    const nombreCompleto = `${d.nombres} ${d.ape_paterno} ${d.ape_materno}`.trim();
                    $('#nombre').val(nombreCompleto);
                } else {
                    const nombreRuc = data.datos.razon_social || data.datos.nombre || '';
                    if (nombreRuc) {
                        $('#nombre').val(nombreRuc);
                    }
                }

                mostrarMensaje('success', 'Datos del documento cargados.');
            })
            .catch(err => {
                Swal.close();
                console.error(err);
                mostrarMensaje('error', 'Error al consultar los datos del documento.');
            });
        });

        // REGISTRAR CLIENTE
        $('#formularioAgregarCliente').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('accion', 'registrarCliente');

            $.ajax({
                url: "./controllers/clientesController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalAgregarCliente').modal('hide');
                        mostrarMensaje("success", response.message || "Cliente registrado correctamente.");
                        tabla.ajax.reload();
                        $('#formularioAgregarCliente')[0].reset();
                    } else {
                        mostrarMensaje("error", response.message || "No se pudo registrar el cliente.");
                    }
                },
                error: function () {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        $('#modalAgregarCliente').on('hidden.bs.modal', function () {
            $('#formularioAgregarCliente')[0].reset();
        });

        // CARGAR DATOS EN MODAL EDITAR
        let idClienteEditar = null;

        $('#tablaClientes tbody').on('click', '.btn-editar', function () {
            const data = tabla.row($(this).parents('tr')).data();
            idClienteEditar = data.id_cliente;

            $('#editarId').val(data.id_cliente);
            $('#editarDocumento').val(data.documento);
            $('#editarNombre').val(data.nombre);
            $('#editarTelefono').val(data.telefono);
            $('#editarCorreo').val(data.correo);

            $('#modalEditarCliente').modal('show');
        });

        // ACTUALIZAR CLIENTE
        $('#formularioEditarCliente').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('accion', 'actualizarCliente');
            formData.append('id_cliente', idClienteEditar);

            $.ajax({
                url: "./controllers/clientesController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $('#modalEditarCliente').modal('hide');
                        mostrarMensaje("success", response.message || "Cliente actualizado correctamente.");
                        tabla.ajax.reload();
                    } else {
                        mostrarMensaje("error", response.message || "No se pudo actualizar el cliente.");
                    }
                },
                error: function () {
                    mostrarMensaje("error", "Error de comunicación con el servidor.");
                }
            });
        });

        $('#modalEditarCliente').on('hidden.bs.modal', function () {
            $('#formularioEditarCliente')[0].reset();
        });

        // CAMBIAR ESTADO
        $('#tablaClientes tbody').on('click', '.btn-estado', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_cliente;
            const nuevoEstado = data.estado == 1 ? 0 : 1;
            const texto = nuevoEstado == 1
                ? "El cliente se activará."
                : "El cliente se desactivará.";

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
                        url: "./controllers/clientesController.php",
                        type: "POST",
                        data: {
                            accion: 'cambiarEstadoCliente',
                            id_cliente: id,
                            nuevoEstado: nuevoEstado
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Estado del cliente actualizado correctamente.");
                                tabla.ajax.reload();
                            } else {
                                mostrarMensaje("error", response.message || "Error al cambiar el estado del cliente.");
                            }
                        },
                        error: function () {
                            mostrarMensaje("error", "Error de comunicación con el servidor.");
                        }
                    });
                }
            });
        });

        // ELIMINACIÓN SOFT (estado = 2)
        $('#tablaClientes tbody').on('click', '.btn-eliminar', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id = data.id_cliente;

            Swal.fire({
                title: "¿Eliminar cliente?",
                text: "El cliente se marcará como eliminado y no aparecerá en el listado.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./controllers/clientesController.php",
                        type: "POST",
                        data: {
                            accion: 'eliminarCliente',
                            id_cliente: id
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                mostrarMensaje("success", response.message || "Cliente eliminado correctamente.");
                                tabla.ajax.reload();
                            } else {
                                mostrarMensaje("error", response.message || "Error al eliminar el cliente.");
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