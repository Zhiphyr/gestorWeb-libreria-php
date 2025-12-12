<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Libros | Librería APP</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/catalogo.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <header class="catalog-header sticky-top">
        <div class="container py-3 d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0 fw-bold text-primary"><i class="fas fa-book-open me-2"></i>Librería APP</h1>
            <button class="btn btn-outline-primary d-none d-md-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
                <i class="fas fa-shopping-cart me-2"></i> Ver Carrito
                <span class="badge bg-primary ms-1" id="headerCartCount">0</span>
            </button>
        </div>
    </header>

    <div class="container mb-5">
        
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <div class="carousel-indicators" id="carouselIndicators">
            </div>
            <div class="carousel-inner" id="carouselInner">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <section class="filter-section text-center">
            <div id="categoryFilters" class="d-flex justify-content-center flex-wrap gap-2">
                <button class="category-btn active" data-category="all">Todos</button>
            </div>
        </section>

        <div class="row g-4" id="bookGrid">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
        </div>

    </div>

    <div class="floating-cart-btn" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
        <i class="fas fa-shopping-cart"></i>
        <div class="cart-badge" id="floatingCartCount">0</div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" aria-labelledby="cartSidebarLabel">
        <div class="offcanvas-header bg-light">
            <h5 class="offcanvas-title fw-bold" id="cartSidebarLabel"><i class="fas fa-shopping-bag me-2"></i>Tu Carrito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div id="cartItems" class="flex-grow-1 overflow-auto">
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-shopping-basket fa-3x mb-3"></i>
                    <p>Tu carrito está vacío</p>
                </div>
            </div>
            <div class="border-top pt-3 mt-3">
                <div class="d-flex justify-content-between mb-3">
                    <span class="h5">Total:</span>
                    <span class="h5 fw-bold text-primary" id="cartTotal">S/. 0.00</span>
                </div>
                <button class="btn btn-primary w-100 py-2 fw-bold" onclick="procesarCompra()">
                    Proceder al Pago
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bookDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Detalles del Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 mb-3 mb-md-0">
                            <img src="" id="modalBookImage" class="modal-book-img" alt="Book Cover">
                        </div>
                        <div class="col-md-7">
                            <h2 class="fw-bold mb-2" id="modalBookTitle">Título del Libro</h2>
                            <div class="mb-3">
                                <span class="tag-badge bg-cat" id="modalBookCategory">Categoría</span>
                                <span class="tag-badge bg-author" id="modalBookAuthor">Autor</span>
                            </div>
                            <h3 class="text-primary fw-bold mb-3" id="modalBookPrice">S/. 0.00</h3>
                            
                            <p class="text-muted mb-4" id="modalBookDescription">Descripción del libro...</p>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Editorial</small>
                                    <span class="fw-bold" id="modalBookEditorial">Editorial</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Año</small>
                                    <span class="fw-bold" id="modalBookYear">2023</span>
                                </div>
                            </div>
                            
                            <div class="alert alert-light border d-flex align-items-center" role="alert">
                                <i class="fas fa-box-open me-2 text-primary"></i>
                                <div>
                                    Stock disponible: <strong id="modalBookStock">0</strong>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 py-2 mt-2" id="modalBtnAddCart">
                                <i class="fas fa-cart-plus me-2"></i> Agregar al Carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let allBooks = [];
        let cart = JSON.parse(localStorage.getItem('libraryCart')) || [];

        $(document).ready(function() {
            cargarSliders();
            cargarLibros();
            actualizarInterfazCarrito();
            
            $(document).on('click', '.category-btn', function() {
                $('.category-btn').removeClass('active');
                $(this).addClass('active');
                const category = $(this).data('category');
                filtrarLibros(category);
            });
        });

        function cargarLibros() {
            $.ajax({
                url: 'controllers/librosController.php?accion=listarLibros',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    allBooks = data;
                    renderizarCategorias(data);
                    renderizarLibros(data);
                },
                error: function(err) {
                    console.error('Error loading books:', err);
                    $('#bookGrid').html('<div class="col-12 text-center text-danger">Error al cargar los libros.</div>');
                }
            });
        }

        function cargarSliders() {
            $.ajax({
                url: 'controllers/slidersController.php',
                method: 'GET',
                data: { accion: 'listarSlidersActivos' },
                dataType: 'json',
                success: function(slides) {
                    const indicatorsContainer = $('#carouselIndicators');
                    const innerContainer = $('#carouselInner');

                    indicatorsContainer.empty();
                    innerContainer.empty();

                    if (!slides || slides.length === 0) {
                        innerContainer.html(`
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/1200x400?text=Sin+slides" class="d-block w-100" alt="Slider vacío">
                                <div class="carousel-caption">
                                    <h2 class="display-6 fw-bold">Bienvenido a Librería APP</h2>
                                    <p class="lead">Agrega slides desde el panel de administración.</p>
                                </div>
                            </div>
                        `);
                        return;
                    }

                    slides.forEach(function(slide, index) {
                        const activeClass = index === 0 ? 'active' : '';

                        indicatorsContainer.append(`
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="${index}" class="${activeClass}"></button>
                        `);

                        const titulo = slide.titulo || '';
                        const descripcion = slide.descripcion || '';
                        const imagen = slide.imagen || 'https://via.placeholder.com/1200x400?text=Slide';
                        const enlace = slide.enlace;

                        const captionContent = `
                            <h2 class="display-4 fw-bold">${titulo}</h2>
                            <p class="lead">${descripcion}</p>
                            ${enlace ? `<a href="${enlace}" class="btn btn-primary mt-3">Ver más</a>` : ''}
                        `;

                        innerContainer.append(`
                            <div class="carousel-item ${activeClass}">
                                <img src="${imagen}" class="d-block w-100" alt="${titulo}">
                                <div class="carousel-caption">
                                    ${captionContent}
                                </div>
                            </div>
                        `);
                    });
                },
                error: function(err) {
                    $('#carouselInner').html(`
                        <div class="carousel-item active">
                            <img src="https://via.placeholder.com/1200x400?text=Error+cargando+slider" class="d-block w-100" alt="Error">
                            <div class="carousel-caption">
                                <h2 class="display-6 fw-bold">Error al cargar el slider</h2>
                                <p class="lead">Intenta nuevamente más tarde.</p>
                            </div>
                        </div>
                    `);
                }
            });
        }

        function renderizarCategorias(books) {
            const categories = [...new Set(books.map(book => book.categoria))];
            const container = $('#categoryFilters');

            let html = '<button class="category-btn active" data-category="all">Todos</button>';
            
            categories.forEach(cat => {
                if(cat) {
                    html += `<button class="category-btn" data-category="${cat}">${cat}</button>`;
                }
            });
            container.html(html);
        }

        function renderizarLibros(books) {
            const container = $('#bookGrid');
            container.empty();

            if (books.length === 0) {
                container.html('<div class="col-12 text-center text-muted">No se encontraron libros.</div>');
                return;
            }

            books.forEach(book => {
                if (book.estado != 1 || book.mostrar != 1) return;

                const imagePath = book.foto ? book.foto : 'https://via.placeholder.com/300x450?text=No+Image';
                
                const card = `
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="book-card h-100 d-flex flex-column" onclick="abrirModalLibro(${book.id_libro})">
                            <div class="book-image-container">
                                <img src="${imagePath}" alt="${book.nombre}">
                                ${parseInt(book.stock) < parseInt(book.stock_minimo) ? '<span class="book-badge">¡Últimos!</span>' : ''}
                            </div>
                            <div class="book-details flex-grow-1 d-flex flex-column">
                                <div class="book-title" title="${book.nombre}">${book.nombre}</div>
                                <div class="book-author">${book.autor}</div>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <div class="book-price">S/. ${parseFloat(book.precio_venta).toFixed(2)}</div>
                                </div>
                                <button class="btn-add-cart" onclick="event.stopPropagation(); agregarAlCarrito(${book.id_libro})">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.append(card);
            });
        }

        function filtrarLibros(category) {
            if (category === 'all') {
                renderizarLibros(allBooks);
            } else {
                const filtered = allBooks.filter(book => book.categoria === category);
                renderizarLibros(filtered);
            }
        }

        function abrirModalLibro(id) {
            const book = allBooks.find(b => b.id_libro == id);
            if (!book) return;

            $('#modalBookTitle').text(book.nombre);
            $('#modalBookImage').attr('src', book.foto || 'https://via.placeholder.com/300x450?text=No+Image');
            $('#modalBookCategory').text(book.categoria);
            $('#modalBookAuthor').text(book.autor);
            $('#modalBookPrice').text('S/. ' + parseFloat(book.precio_venta).toFixed(2));
            $('#modalBookDescription').text(book.descripcion);
            $('#modalBookEditorial').text(book.editorial);
            $('#modalBookYear').text(book.año_publicacion);
            $('#modalBookStock').text(book.stock);

            $('#modalBtnAddCart').off('click').on('click', function() {
                agregarAlCarrito(book.id_libro);
                $('#bookDetailModal').modal('hide');
            });

            const modal = new bootstrap.Modal(document.getElementById('bookDetailModal'));
            modal.show();
        }

        function agregarAlCarrito(id) {
            const book = allBooks.find(b => b.id_libro == id);
            if (!book) return;

            const existingItem = cart.find(item => item.id_libro == id);
            
            if (existingItem) {
                if (existingItem.quantity < book.stock) {
                    existingItem.quantity++;
                    mostrarNotificacion('Cantidad actualizada', 'success');
                } else {
                    mostrarNotificacion('No hay más stock disponible', 'warning');
                    return;
                }
            } else {
                cart.push({
                    id_libro: book.id_libro,
                    nombre: book.nombre,
                    precio: parseFloat(book.precio_venta),
                    foto: book.foto,
                    quantity: 1,
                    maxStock: book.stock
                });
                mostrarNotificacion('Agregado al carrito', 'success');
            }

            guardarCarrito();
            actualizarInterfazCarrito();
        }

        function eliminarDelCarrito(id) {
            cart = cart.filter(item => item.id_libro != id);
            guardarCarrito();
            actualizarInterfazCarrito();
        }

        function guardarCarrito() {
            localStorage.setItem('libraryCart', JSON.stringify(cart));
        }

        function actualizarInterfazCarrito() {
            const container = $('#cartItems');
            const countBadge = $('#headerCartCount');
            const floatBadge = $('#floatingCartCount');
            const totalEl = $('#cartTotal');
            
            let total = 0;
            let count = 0;

            if (cart.length === 0) {
                container.html(`
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-shopping-basket fa-3x mb-3"></i>
                        <p>Tu carrito está vacío</p>
                    </div>
                `);
            } else {
                container.empty();
                cart.forEach(item => {
                    total += item.precio * item.quantity;
                    count += item.quantity;

                    const html = `
                        <div class="cart-item">
                            <img src="${item.foto || 'https://via.placeholder.com/60x80'}" alt="${item.nombre}">
                            <div class="cart-item-details">
                                <div class="cart-item-title text-truncate">${item.nombre}</div>
                                <div class="text-muted small">Cant: ${item.quantity}</div>
                                <div class="cart-item-price">S/. ${(item.precio * item.quantity).toFixed(2)}</div>
                            </div>
                            <button class="btn-remove-item" onclick="eliminarDelCarrito(${item.id_libro})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    `;
                    container.append(html);
                });
            }

            countBadge.text(count);
            floatBadge.text(count);
            totalEl.text('S/. ' + total.toFixed(2));
        }

        function mostrarNotificacion(msg, icon = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: icon,
                title: msg
            });
        }

        const WHATSAPP_NUMBER = '51947010376';

        function procesarCompra() {
            if (cart.length === 0) {
                Swal.fire('Carrito vacío', 'Agrega libros antes de procesar el pago.', 'info');
                return;
            }

            let message = 'Hola, quiero hacer un pedido de libros:\n\n';
            cart.forEach(item => {
                message += `- ${item.nombre} (Cant: ${item.quantity}) - S/. ${(item.precio * item.quantity).toFixed(2)}\n`;
            });

            let total = cart.reduce((acc, item) => acc + item.precio * item.quantity, 0);
            message += `\nTotal: S/. ${total.toFixed(2)}\n`;
            message += '\n¿Me puedes ayudar con la compra?';

            const encoded = encodeURIComponent(message);
            const url = `https://wa.me/${WHATSAPP_NUMBER}?text=${encoded}`;

            window.open(url, '_blank');
        }
    </script>
</body>
</html>
