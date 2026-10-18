-- Ejecutar en phpMyAdmin (http://localhost:8085) sobre la base db_proyecto_mvc

-- 1) Tabla base que entrega la guía
CREATE TABLE contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2) Reto: agregar correo (tipo correo) y comentario (texto amplio)
--    MySQL no tiene un tipo "correo": se usa VARCHAR(255), el máximo práctico de un email,
--    y la validación de formato se hace en PHP con filter_var(FILTER_VALIDATE_EMAIL).
ALTER TABLE contactos
    ADD COLUMN correo VARCHAR(255) NOT NULL AFTER nombre,
    ADD COLUMN comentario TEXT NOT NULL AFTER correo;

-- 3) Verificación
DESCRIBE contactos;
SELECT * FROM contactos ORDER BY id DESC;
