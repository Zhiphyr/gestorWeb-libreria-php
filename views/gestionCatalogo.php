<div class="fade-in-up">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="header-title mb-1 fw-bold text-gradient">Gestión de Catálogo</h1>
                    <p class="header-subtitle text-muted mb-0">Bienvenido al panel de administración de Catálogo. Administra los sliders y libros que deseas agregar al catálogo.</p>
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
            <div class="row g-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Listado de Sliders (Arrastra para reordenar)</h3>
                            <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalAgregarSlide">
                                <i class="fas fa-plus"></i> Agregar Slider
                            </button>
                        </div>
                        <div class="card-body">
                            <ul id="listaSliders" class="list-group">
                                
                            </ul>
                            <small class="text-muted d-block mt-2">
                                Arrastra los elementos para cambiar el orden. Se guarda automáticamente.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-3">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Listado de Libros</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablaLibros" class="table hover order-column" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>CATEGORIA</th>
                                            <th>AUTOR</th>
                                            <th>EDITORIAL</th>
                                            <th>PRECIO VENTA</th>
                                            <th>STOCK</th>
                                            <th>PUBLICADO</th>
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

<!-- MODAL AGREGAR SLIDE -->
<div class="modal fade" id="modalAgregarSlide" tabindex="-1" aria-labelledby="modalAgregarSlideLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff6ff">
                <h5 class="modal-title text-muted text-uppercase fw-bold" id="modalAgregarSlideLabel">Agregar slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioAgregarSlide" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
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
                    <button type="submit" class="btn btn-primary text-white" style="background-color: #3b82f6; border-color: #3b82f6;">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        // DATATABLE DE LIBROS
        var tabla = $('#tablaLibros').DataTable({
            "ajax": {
                "url": "./controllers/librosController.php?accion=listarLibrosGestionCatalogo",
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
                { "data": "nombre" },
                { "data": "categoria" },
                { "data": "autor" },
                { "data": "editorial" },
                { 
                    "data": "precio_venta",
                    "render": function (data) {
                        return `S/. ${parseFloat(data).toFixed(2)}`;
                    }
                },
                { "data": "stock" },
                {
                    "data": "mostrar",
                    "render": function (data) {
                        return data == 1
                            ? `<span class="badge bg-success">Publicado</span>`
                            : `<span class="badge bg-danger">Oculto</span>`;
                    }
                },
                {
                    "data": null,
                    "defaultContent": `
                        <button class="btn btn-info btn-sm btn-editar"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-warning btn-sm btn-mostrar"><i class="bi bi-toggle-off"></i></button>
                    `
                }
            ],
            "columnDefs": [
                {
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    className: "dt-center"
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

            // Categoría
            const $cat = $('#modalEditarLibro .js-categoria');
            $cat.empty().append(new Option(data.categoria, data.id_categoria, true, true)).trigger('change');

            // Autor
            const $aut = $('#modalEditarLibro .js-autor');
            $aut.empty().append(new Option(data.autor, data.id_autor, true, true)).trigger('change');

            // Editorial
            const $edi = $('#modalEditarLibro .js-editorial');
            $edi.empty().append(new Option(data.editorial, data.id_editorial, true, true)).trigger('change');

            $('#modalEditarLibro').modal('show');
        });

        // ACTUALIZAR LIBRO
        $('#formularioEditarLibro').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('accion', 'actualizarLibroCatalogo');

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

        // TOGGLE MOSTRAR/OCULTAR EN CATÁLOGO
        $('#tablaLibros tbody').on('click', '.btn-mostrar', function () {
            const data = tabla.row($(this).parents('tr')).data();
            const id_libro = data.id_libro;
            const estadoActual = parseInt(data.mostrar, 10); // 1 o 0
            const nuevoEstado = estadoActual === 1 ? 0 : 1;

            const textoAccion = nuevoEstado === 1 
                ? '¿Publicar este libro en el catálogo?' 
                : '¿Ocultar este libro del catálogo?';

            Swal.fire({
                icon: 'question',
                title: 'Confirmar',
                text: textoAccion,
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: './controllers/librosController.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        accion: 'actualizarMostrar',
                        id_libro: id_libro,
                        mostrar: nuevoEstado
                    },
                    success: function(res){
                        if (!res.success) {
                            mostrarMensaje('error', res.message || 'No se pudo actualizar el estado.');
                            return;
                        }
                        mostrarMensaje('success', res.message || 'Estado actualizado.');
                        tabla.ajax.reload(null, false);
                    },
                    error: function(){
                        mostrarMensaje('error', 'Error de comunicación con el servidor.');
                    }
                });
            });
        });

        // CARGAR LISTA DE SLIDERS
        function cargarSliders() {
            $.ajax({
                url: "./controllers/slidersController.php",
                type: "GET",
                data: { accion: 'listarSliders' },
                dataType: "json",
                success: function (data) {
                    const lista = $('#listaSliders');
                    lista.empty();
                    if (!data || data.length === 0) {
                        lista.append('<li class="list-group-item text-muted">No hay slides registrados.</li>');
                        return;
                    }
                    data.forEach(function (item) {
                        const li = `
                            <li class="list-group-item d-flex align-items-center justify-content-between" data-id="${item.id_slide}">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="handle text-muted" style="cursor:move;"><i class="fas fa-arrows-alt"></i></span>
                                    <img src="${item.imagen}" style="width:70px;height:auto;border-radius:4px;" alt="">
                                    <div>
                                        <div class="fw-bold">${item.titulo || '(Sin título)'}</div>
                                        <small class="text-muted">${item.descripcion || ''}</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-danger btn-eliminar"><i class="bi bi-trash"></i></button>
                            </li>`;
                        lista.append(li);
                    });

                    activarSortable();
                }
            });
        }

        function activarSortable() {
            $("#listaSliders").sortable({
                handle: ".handle",
                update: function (event, ui) {
                    let orden = [];
                    $("#listaSliders").children('li').each(function () {
                        orden.push($(this).data('id'));
                    });
                    $.ajax({
                        url: "./controllers/slidersController.php",
                        type: "POST",
                        data: {
                            accion: 'actualizarOrden',
                            'orden[]': orden
                        },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                mostrarMensaje('success', res.message || 'Orden actualizado.');
                            } else {
                                mostrarMensaje('error', res.message || 'Error al actualizar el orden.');
                            }
                        },
                        error: function () {
                            mostrarMensaje('error', 'Error de comunicación al actualizar el orden.');
                        }
                    });
                }
            }).disableSelection();
        }

        // REGISTRAR SLIDE
        $('#formularioAgregarSlide').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('accion', 'registrarSlider');

            $.ajax({
                url: "./controllers/slidersController.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(res) {
                    if (res.success) {
                        $('#modalAgregarSlide').modal('hide');
                        mostrarMensaje('success', res.message || 'Slide registrado.');
                        $('#formularioAgregarSlide')[0].reset();
                        cargarSliders();
                    } else {
                        mostrarMensaje('error', res.message || 'No se pudo registrar el slide.');
                    }
                },
                error: function () {
                    mostrarMensaje('error', 'Error de comunicación con el servidor.');
                }
            });
        });

        $('#modalAgregarSlide').on('hidden.bs.modal', function() {
            $('#formularioAgregarSlide')[0].reset();
        });

        // ELIMINAR SLIDE
        $('#listaSliders').on('click', '.btn-eliminar', function() {
            const li = $(this).closest('li');
            const id = li.data('id');

            Swal.fire({
                title: "¿Eliminar slide?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./controllers/slidersController.php",
                        type: "POST",
                        data: {
                            accion: 'eliminarSlider',
                            id_slide: id
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res.success) {
                                mostrarMensaje('success', res.message || 'Slide eliminado.');
                                cargarSliders();
                            } else {
                                mostrarMensaje('error', res.message || 'No se pudo eliminar el slide.');
                            }
                        },
                        error: function () {
                            mostrarMensaje('error', 'Error de comunicación con el servidor.');
                        }
                    });
                }
            });
        });

        // INICIALIZAR SLIDERS
        cargarSliders();

        // FECHA ACTUAL
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', options);
    });
</script>