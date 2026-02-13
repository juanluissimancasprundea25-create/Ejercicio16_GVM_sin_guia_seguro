<?php

class Alumno {
    private $conexion;
    private $tabla = 'alumnos';

    public function __construct($conexionBD) {
        $this->conexion = $conexionBD->obtenerConexion();
    }

    // Obtener todos los alumnos
    public function obtenerTodos() {
        try {
            $query = "SELECT id, nombre, email, edad, fecha_creacion FROM " . $this->tabla . " ORDER BY id DESC";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->registrarError("Error al obtener alumnos: " . $e->getMessage());
            return false;
        }
    }

    // Obtener un alumno por ID
    public function obtenerPorId($id) {
        try {
            $query = "SELECT id, nombre, email, edad, fecha_creacion FROM " . $this->tabla . " WHERE id = :id LIMIT 1";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $alumno = $stmt->fetch();
            return ($alumno) ? $alumno : false;
        } catch (PDOException $e) {
            $this->registrarError("Error al obtener alumno por ID: " . $e->getMessage());
            return false;
        }
    }

    // Actualizar alumno
    public function actualizar($id, $nombre, $email, $edad) {
        try {
            $query = "UPDATE " . $this->tabla . " 
                      SET nombre = :nombre, email = :email, edad = :edad 
                      WHERE id = :id";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->registrarError("Error al actualizar alumno: " . $e->getMessage());
            return false;
        }
    }

    // Validar datos del formulario
    public function validarDatos($nombre, $email, $edad) {
        $errores = array();
        if (empty(trim($nombre))) {
            $errores[] = "Pon el nombre chavalin";
        } elseif (strlen(trim($nombre)) < 3) {
            $errores[] = "Tiene que tener como minimo 3 letras , no te hagas -_-";
        }
        if (!empty(trim($email))) {
            if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $errores[] = "Ese correo no vale , pon otro :)";
            }
        }
        if (empty(trim($edad))) {
            $errores[] = "Pon edad , no te hagas el gracioso >:(";
        } elseif (!is_numeric(trim($edad))) {
            $errores[] = "La edad tiene que ser un numero , no te hagas -_-";
        } elseif (trim($edad) <= 0 || trim($edad) > 120) {
            $errores[] = "La edad tiene que ser mayor que 1 y menor que 120";
        }
        return $errores;
    }

    private function registrarError($mensaje) {
        $fecha = date('Y-m-d H:i:s');
        $contenido = "[$fecha] $mensaje" . PHP_EOL;
        if (!is_dir(dirname(LOG_PATH))) {
            mkdir(dirname(LOG_PATH), 0777, true);
        }
        
        file_put_contents(LOG_PATH, $contenido, FILE_APPEND);
    }
}
?>