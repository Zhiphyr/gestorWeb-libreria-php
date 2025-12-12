# Sistemas de Gestión Web para una Librería

Este proyecto es un sistema web integral diseñado para la gestión y administración eficiente de una librería. Facilita tanto la administración del inventario como la experiencia de compra para los clientes a través de un catálogo en línea.

## Características Principales

- **Panel de Administración**: Interfaz segura para gestionar el inventario de libros, categorías y usuarios.
- **Catálogo Digital**: Vista pública moderna (`catalogo.php`) con carrusel de destacados y filtrado por categorías.
- **Gestión de Carrito**: Funcionalidad para agregar productos y revisar pedidos.
- **Autenticación**: Sistema de login seguro para administradores.
- **Notificaciones**: Sistema de avisos y alertas en el dashboard.

## Tecnologías Utilizadas

- **Lenguaje Servidor**: PHP
- **Base de Datos**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript (Bootstrap 5)
- **Servidor Local**: XAAMP (Apache)

## Instalación y Configuración

1.  **Requisitos**: Tener instalado XAMPP o un servidor web compatible con PHP y MySQL.
2.  **Clonar/Copiar**: Coloca la carpeta del proyecto `sistema_libreria` en el directorio `htdocs` de XAMPP (usualmente `C:\xampp\htdocs\`).
3.  **Base de Datos**:
    - Abre phpMyAdmin (`http://localhost/phpmyadmin`).
    - Crea una base de datos (verifica el nombre en `conexionDB.php`).
    - Importa el archivo SQL proporcionado (si existe) para crear las tablas.
4.  **Ejecución**:
    - Inicia Apache y MySQL desde el panel de XAMPP.
    - Abre tu navegador y ve a `http://localhost/sistema_libreria`.

## Estructura del Proyecto

- `/controllers`: Lógica de negocio y controladores.
- `/models`: Modelos de acceso a datos.
- `/views`: Vistas y plantillas HTML/PHP.
- `/assets`: Recursos estáticos (CSS, JS, imágenes).
- `admin.php`: Punto de entrada al panel administrativo.
- `catalogo.php`: Catálogo público de libros.

Para crear la base de datos, puedes usar el archivo `sistema_libreria.sql`.
