<?php
// controllers/SiteController.php
require_once 'models/ContactoModel.php';

class SiteController
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function manejarPeticion()
    {
        // Capturar sección actual
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'inicio';
        $mensaje_db = "";

        // Procesar formulario si es la sección contacto y viene por POST
        if ($url === 'contacto' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
            $nombre     = trim($_POST['nombre'] ?? '');
            $correo     = trim($_POST['correo'] ?? '');
            $comentario = trim($_POST['comentario'] ?? '');

            if ($nombre === '' || $correo === '' || $comentario === '') {
                $mensaje_db = "<p class='alerta alerta-error'>Por favor, completa todos los campos.</p>";
            } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mensaje_db = "<p class='alerta alerta-error'>El correo no tiene un formato válido.</p>";
            } else {
                $modelo = new ContactoModel($this->conexion);
                $exito = $modelo->guardarContacto($nombre, $correo, $comentario);
                
                if ($exito) {
                    $mensaje_db = "<p class='alerta alerta-ok'>¡Tu información se ha guardado correctamente!</p>";
                } else {
                    $mensaje_db = "<p class='alerta alerta-error'>No fue posible guardar tu información. Por favor, inténtalo nuevamente.</p>";
                }
            }
        }

        // Cargar los componentes visuales (Vistas)
        require_once 'views/header.php';

        switch ($url) {
            case 'inicio':
                require_once 'views/inicio.php';
                break;
            case 'servicios':
                require_once 'views/servicios.php';
                break;
            case 'gustos':
                require_once 'views/gustos.php';
                break;
            case 'contacto':
                require_once 'views/contacto.php';
                break;
            default:
                require_once 'views/404.php';
                break;
        }

        require_once 'views/footer.php';
    }
}
