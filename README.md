# Proyecto Web MVC: Lift and Shift con Docker

Laboratorio #4 de Cloud Computing (Universidad Católica de Pereira).
Autor: **Juan Esteban García Morillo**

Aplicación web tradicional en PHP (patrón MVC, front controller con `.htaccess`) migrada a contenedores con Docker Compose: PHP 8.2 + Apache, MySQL 8.0 y phpMyAdmin.

## Cómo ejecutarlo y dónde tomar las evidencias

Requisito: Docker Desktop abierto y corriendo.

1. **Clonar y entrar al proyecto**
   ```bash
   git clone <URL-de-este-repositorio>
   cd lift-and-shift-mvc
   ```
   📸 **Evidencia A (informe, paso 1):** la terminal con el `git clone` y el árbol del proyecto abierto en VS Code (`controllers/`, `models/`, `views/`, `.htaccess`, `Dockerfile`, `docker-compose.yml`).

2. **Revisar los cambios de configuración**
   📸 **Evidencia B (paso 2):** `conexion.php` en VS Code mostrando `$host = "db-mysql"`.
   📸 **Evidencia C (paso 3):** el `Dockerfile`.
   📸 **Evidencia D (paso 4):** el `docker-compose.yml` con los tres servicios.

3. **Levantar los contenedores**
   ```bash
   docker compose up --build
   ```
   La primera vez tarda unos minutos descargando imágenes. Espera hasta ver en el log de MySQL `ready for connections`.
   📸 **Evidencia E (paso 5):** la terminal con el build terminado y los tres contenedores creados.
   📸 **Evidencia F:** Docker Desktop (pestaña *Containers*) con `mvc_app_container`, `mvc_mysql_container` y `mvc_phpmyadmin_container` en verde, o el resultado de `docker ps` en otra terminal.

4. **Crear y modificar la tabla en phpMyAdmin** → http://localhost:8085 (usuario `root`, contraseña `clave_secreta_nube`)
   - Selecciona la base `db_proyecto_mvc` → pestaña **SQL** → pega y ejecuta el contenido de `sql/contactos.sql` (crea la tabla y luego el `ALTER TABLE` que agrega `correo` y `comentario`).
   📸 **Evidencia G:** la pestaña SQL con el script y el mensaje verde de éxito.
   📸 **Evidencia H:** la pestaña **Estructura** de `contactos` donde se vean las columnas `correo VARCHAR(255)` y `comentario TEXT`.

5. **Probar la aplicación** → http://localhost:8080
   📸 **Evidencia I (entregable obligatorio):** la sección **Mis gustos personales** (http://localhost:8080/gustos) con la barra de dirección visible, mostrando el diseño y colores nuevos.
   📸 **Evidencia J (opcional):** la página de inicio con el nuevo estilo.

6. **Enviar el formulario de contacto** → http://localhost:8080/contacto
   Llena nombre, correo y comentario con datos reales tuyos.
   📸 **Evidencia K:** el formulario lleno, antes de enviar.
   📸 **Evidencia L (entregable obligatorio):** el mensaje verde "¡Mensaje guardado con éxito en la Base de Datos!".

7. **Comprobar la persistencia** → phpMyAdmin → `db_proyecto_mvc` → `contactos` → **Examinar**
   📸 **Evidencia M (entregable obligatorio):** la fila con el correo y el comentario que escribiste en la web.
   📸 **Evidencia N (opcional, suma puntos):** ejecuta `docker compose down` y luego `docker compose up` otra vez; vuelve a abrir la tabla y toma captura mostrando que el registro sigue ahí. Esto demuestra que el volumen `datos-persistentes` conserva los datos aunque se destruyan los contenedores.

8. **Subir a GitHub**
   📸 **Evidencia O:** la página del repositorio en GitHub con los archivos.

Para apagar todo: `Ctrl + C` y luego `docker compose down` (agrega `-v` solo si quieres borrar también los datos de MySQL).

## Cambios realizados

| Archivo | Cambio |
|---|---|
| `conexion.php` | Host `db-mysql` (nombre del servicio en Compose), base `db_proyecto_mvc`, credenciales del contenedor |
| `Dockerfile` | Imagen `php:8.2-apache`, extensiones `pdo pdo_mysql`, `mod_rewrite`, permisos para `www-data` |
| `docker-compose.yml` | Servicios `web-app`, `db-mysql` (con healthcheck) y `phpmyadmin`, volumen `datos-persistentes` |
| `.dockerignore` | Evita copiar `.git` y archivos de despliegue a la imagen |
| `sql/contactos.sql` | Tabla `contactos` + `ALTER TABLE` con `correo` y `comentario` |
| `models/ContactoModel.php` | `INSERT` con los tres campos usando consultas preparadas |
| `controllers/SiteController.php` | Validación de campos vacíos y formato de correo; ruta `gustos` |
| `views/contacto.php` | Formulario con correo (`type="email"`) y comentario (`textarea`) |
| `views/gustos.php` | Nueva sección "Mis gustos personales" |
| `views/header.php`, `views/footer.php`, `assets/css/estilos.css` | Nuevo diseño completo (paleta lavanda, ciruela y violeta) |

## Si algo falla

- **"Error de conexión" al abrir el 8080:** MySQL aún está iniciando; espera unos segundos y recarga.
- **Puerto 3306, 8080 u 8085 ocupado:** cierra WAMP/XAMPP o cualquier MySQL local antes de `docker compose up`.
- **Aviso "the attribute `version` is obsolete":** es solo una advertencia de Docker Compose moderno; se dejó la línea porque la guía la pide.
- **Cambié CSS o vistas y no se ven:** como el código se copia dentro de la imagen, hay que reconstruir con `docker compose up --build`.
