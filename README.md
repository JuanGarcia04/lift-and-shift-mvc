# Proyecto Web MVC: Lift and Shift con Docker

Aplicación web en PHP con patrón MVC, migrada de un entorno tradicional (WAMP) a contenedores Docker siguiendo la estrategia **Lift and Shift**: la aplicación se traslada a un entorno nuevo con los mínimos cambios en su código.

Laboratorio #4 de Cloud Computing, Universidad Católica de Pereira.
Autor: **Juan Esteban García Morillo**

## Tecnologías

- PHP 8.2 + Apache (con `mod_rewrite` para el front controller del `.htaccess`)
- MySQL 8.0
- phpMyAdmin
- Docker y Docker Compose

## Arquitectura

| Servicio | Imagen | Puerto | Función |
|---|---|---|---|
| `web-app` | Construida con el `Dockerfile` | 8080 | La aplicación PHP MVC |
| `db-mysql` | `mysql:8.0` | 3306 | Base de datos, con el volumen `datos-persistentes` |
| `phpmyadmin` | `phpmyadmin/phpmyadmin` | 8085 | Administración gráfica de MySQL |

Dentro de la red de Docker Compose los servicios se encuentran por su nombre: la aplicación se conecta a MySQL usando el host `db-mysql`, no `localhost`. Los datos se guardan en un volumen, así que se conservan aunque los contenedores se eliminen.

## Requisitos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) instalado y en ejecución.
- Los puertos 8080, 8085 y 3306 libres. Si tienes WAMP, XAMPP o un MySQL local, ciérralos antes de iniciar.

No se necesita instalar PHP, Apache, MySQL ni XAMPP: todo corre dentro de los contenedores.

## Cómo levantar el proyecto

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/JuanGarcia04/lift-and-shift-mvc.git
   cd lift-and-shift-mvc
   ```

2. **Construir e iniciar los contenedores**
   ```bash
   docker compose up --build
   ```
   La primera vez tarda unos minutos mientras descarga las imágenes. Los servicios están listos cuando en el log de MySQL aparece `ready for connections`.

3. **Crear la tabla de la base de datos** (solo la primera vez)
   - Entra a phpMyAdmin en http://localhost:8085 (usuario `root`, contraseña `clave_secreta_nube`).
   - Selecciona la base `db_proyecto_mvc`, abre la pestaña **SQL** y ejecuta el contenido de [`sql/contactos.sql`](sql/contactos.sql).

4. **Abrir la aplicación** en http://localhost:8080

| Sección | URL |
|---|---|
| Inicio | http://localhost:8080/inicio |
| Servicios | http://localhost:8080/servicios |
| Mis gustos personales | http://localhost:8080/gustos |
| Contacto (guarda nombre, correo y comentario en MySQL) | http://localhost:8080/contacto |

## Comandos útiles

| Acción | Comando |
|---|---|
| Iniciar en segundo plano | `docker compose up --build -d` |
| Ver los contenedores activos | `docker ps` |
| Aplicar cambios en el código (reconstruye solo la app) | `docker compose up --build -d web-app` |
| Detener y eliminar los contenedores (conserva los datos) | `docker compose down` |
| Eliminar también los datos de MySQL | `docker compose down -v` |

Como el `Dockerfile` copia el código dentro de la imagen (`COPY . /var/www/html/`), los cambios en archivos PHP o CSS se ven solo después de reconstruir la imagen de `web-app`.

## Estructura del proyecto

```
lift-and-shift-mvc/
├── index.php                  Punto de entrada (front controller)
├── .htaccess                  Redirige todas las URL a index.php
├── conexion.php               Conexión PDO a MySQL (host db-mysql)
├── controllers/
│   └── SiteController.php     Enrutamiento y validación del formulario
├── models/
│   └── ContactoModel.php      Inserta los contactos en la base de datos
├── views/                     Encabezado, pie y una vista por sección
├── assets/css/estilos.css     Estilos del sitio
├── sql/contactos.sql          Creación y modificación de la tabla contactos
├── Dockerfile                 Imagen de la aplicación (PHP 8.2 + Apache)
├── docker-compose.yml         Orquestación de los tres servicios
└── .dockerignore              Archivos excluidos de la imagen
```

## Cambios respecto a la aplicación original

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
| `views/header.php`, `views/footer.php`, `assets/css/estilos.css` | Nuevo diseño (paleta lavanda, ciruela y violeta) |

## Solución de problemas

- **"Error de conexión" al abrir el puerto 8080:** MySQL todavía está iniciando; espera unos segundos y recarga.
- **"port is already allocated":** otro programa usa el puerto 8080, 8085 o 3306; cierra WAMP, XAMPP o el MySQL local.
- **Aviso "the attribute `version` is obsolete":** es solo una advertencia de las versiones nuevas de Docker Compose; no afecta el funcionamiento.
- **No veo un cambio de CSS:** reconstruye `web-app` y recarga el navegador con `Ctrl + F5`.
