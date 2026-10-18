<!-- views/header.php -->
<?php $seccion = isset($url) ? $url : 'inicio'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juan Esteban García Morillo · Proyecto Web MVC</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Vinculación del archivo CSS externo -->
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header class="barra">
        <a class="marca" href="inicio">
            <span class="marca-inicial" aria-hidden="true">JE</span>
            <span class="marca-nombre">Juan Esteban García Morillo</span>
        </a>
        <nav aria-label="Secciones">
            <ul>
                <li><a href="inicio" <?php if ($seccion === 'inicio') echo 'aria-current="page"'; ?>>Inicio</a></li>
                <li><a href="servicios" <?php if ($seccion === 'servicios') echo 'aria-current="page"'; ?>>Servicios</a></li>
                <li><a href="gustos" <?php if ($seccion === 'gustos') echo 'aria-current="page"'; ?>>Mis gustos personales</a></li>
                <li><a href="contacto" <?php if ($seccion === 'contacto') echo 'aria-current="page"'; ?>>Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main id="contenedor-principal">
