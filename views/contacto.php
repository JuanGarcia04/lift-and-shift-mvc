<h2>Página de Contacto</h2>

<!-- El controlador inyecta esta variable aquí si existe un mensaje -->
<?php echo $mensaje_db; ?>

<form action="" method="POST" class="form-contacto">
    <label for="nombre">Tu nombre</label>
    <input type="text" id="nombre" name="nombre" maxlength="100" required>

    <label for="correo">Tu correo</label>
    <input type="email" id="correo" name="correo" maxlength="255" required>

    <label for="comentario">Comentario</label>
    <textarea id="comentario" name="comentario" rows="5" required></textarea>

    <button type="submit">Enviar mensaje</button>
</form>
