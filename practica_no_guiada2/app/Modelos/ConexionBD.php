<?php
// Clase para manejar la conexión a la base de datos
class ConexionBD {
    private $conexion;
    private $error;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $this->conexion = new PDO($dsn, DB_USER, DB_PASS);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->error = "No se conecta: " . $e->getMessage();
            $this->registrarError($this->error);
            die("No te conectaste rivisa");
        }
    }

    public function obtenerConexion() {
        return $this->conexion;
    }

    public function obtenerError() {
        return $this->error;
    }

    public function registrarError($mensaje) {
        $fecha = date('Y-m-d H:i:s');
        $contenido = "[$fecha] $mensaje" . PHP_EOL;
        if (!is_dir(dirname(LOG_PATH))) {
            mkdir(dirname(LOG_PATH), 0777, true);
        }
        file_put_contents(LOG_PATH, $contenido, FILE_APPEND);
    }

    public function __destruct() {
        $this->conexion = null;
    }
}
?>