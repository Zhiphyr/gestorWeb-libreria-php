<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Libreria APP</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preload" href="assets/css/adminlte.css" as="style" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media='all'" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/adminlte.css" />
    <!--DATATABLES CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <div class="admin-logo">
                <i class="fas fa-book-open"></i>
                <span>Libreria APP</span>
            </div>
        </div>

        <nav class="admin-sidebar-menu">
            <div class="nav flex-column" id="sidebarMenu"></div>
        </nav>

        <div class="admin-sidebar-footer p-3 border-top">
            <div class="admin-user-profile d-flex align-items-center gap-3">
                <div class="admin-user-avatar d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="admin-user-info">
                    <h4 class="fs-6 mb-0 text-dark"><?php echo $_SESSION['nombre']; ?></h4>
                    <p class="small text-muted mb-0"><?php echo $_SESSION['perfil']; ?></p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main-content d-flex flex-column min-vh-100">
        <header class="admin-top-bar d-flex justify-content-between align-items-center px-4 py-2 bg-white border-bottom sticky-top">
            <button class="admin-toggle-btn">
                <i class="fas fa-bars fs-4"></i>
            </button>
            <div class="admin-top-bar-actions">
                <a href="catalogo.php" target="_blank" class="admin-btn-visit text-white" style="background-color: #3b82f6; border-color: #3b82f6;">
                    <i class="fas fa-external-link-alt"></i> Visitar Página
                </a>
                <a href="index.php" class="admin-btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </header>

        <div class="admin-dashboard-content">
            <div class="admin-welcome-section text-center fade-in-up">
                <div class="welcome-icon-container mb-4 pulse-animation">
                    <i class="fas fa-book-reader"></i>
                </div>
                <h1 class="welcome-title mb-3">Bienvenido al Sistema de Gestión</h1>
                <p class="welcome-subtitle text-muted mb-5">Libreria APP - Tu solución integral para el control de inventario y ventas</p>
                
                <div class="row justify-content-center gap-4">
                    <div class="col-auto">
                        <div class="welcome-stat-card">
                            <i class="fas fa-book text-primary mb-2"></i>
                            <h5>Gestión de Libros</h5>
                            <p class="small text-muted">Administra tu catálogo</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="welcome-stat-card">
                            <i class="fas fa-users text-success mb-2"></i>
                            <h5>Usuarios</h5>
                            <p class="small text-muted">Control de acceso</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="welcome-stat-card">
                            <i class="fas fa-chart-line text-info mb-2"></i>
                            <h5>Reportes</h5>
                            <p class="small text-muted">Estadísticas clave</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
    <!-- Select2 -->    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    
    

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>

    <script src="assets/js/admin.js"></script>
    <script src="assets/js/adminlte.js"></script>

    <script>
        window.ID_USUARIO_SESION = <?php echo (int)$_SESSION['id_perfil']; ?>;
        function AbrirPagina(urlx) {
            $.ajax({
                method: "POST",
                url: urlx
            }).done(function (retorno) {
                $(".admin-dashboard-content").html(retorno);
            });
        }

        // CARGAR OPCIONES DEL USUARIO
        $(document).ready(function() {
            fetch('controllers/opcionesController.php?accion=listarOpciones&id_perfil='+<?php echo $_SESSION['id_perfil']; ?>)
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    console.error("Error al cargar opciones:", data.message);
                    return;
                }
                renderSidebar(data.data);
            })
            .catch(err => console.error("Error de red o JSON:", err));

            function renderSidebar(opciones) {
                const cont = document.querySelector('.admin-sidebar-menu .nav');
                let html = "";

                opciones.forEach(opt => {
                    html += `
                    <a href="#" onclick="AbrirPagina('${opt.ruta}')" class="admin-menu-item">
                        <i class="${opt.icono}"></i>
                        <span>${opt.nombre}</span>
                    </a>
                    `;
                });
                cont.innerHTML = html;
            }

            $(document).on('click', '.admin-menu-item', function() {
                $('.admin-menu-item').removeClass('active');
                $(this).addClass('active');
            });

        });

    </script>
</body>
</html>
