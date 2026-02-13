<?php

class ControladorAlumnos {
    private $alumnoModelo;
    private $conexionBD;

    public function __construct() {
        $this->conexionBD = new ConexionBD();
        $this->alumnoModelo = new Alumno($this->conexionBD);
    }

    // Mostrar listado de alumnos
    public function listarAlumnos() {
        $alumnos = $this->alumnoModelo->obtenerTodos();
        include '../app/Vistas/listado.php';
    }

    // Mostrar formulario de edición
    public function mostrarFormularioEditar() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if (!$id || !is_numeric($id)) {
            $_SESSION['error'] = "Ese ID no sirve :(";
            header('Location: index.php?accion=listar');
            exit;
        }
        $alumno = $this->alumnoModelo->obtenerPorId($id);
        if (!$alumno) {
            $_SESSION['error'] = "No esta ese alumno :(";
            header('Location: index.php?accion=listar');
            exit;
        }
        include '../app/Vistas/editar.php';
    }

    // Actualizar alumno
    public function actualizarAlumno() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=listar');
            exit;
        }
        
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
        if (!$id || !is_numeric($id)) {
            $_SESSION['error'] = "Si que vale este ID :)";
            header('Location: index.php?accion=listar');
            exit;
        }
        
        $errores = $this->alumnoModelo->validarDatos($nombre, $email, $edad);
        if (!empty($errores)) {
            $_SESSION['errores_formulario'] = $errores;
            $_SESSION['datos_formulario'] = array(
                'id' => $id,
                'nombre' => $nombre,
                'email' => $email,
                'edad' => $edad
            );
            header('Location: index.php?accion=editar&id=' . $id);
            exit;
        }

        $resultado = $this->alumnoModelo->actualizar($id, trim($nombre), trim($email), trim($edad));
        if ($resultado) {
            $_SESSION['exito'] = "Actualizado :D";
        } else {
            $_SESSION['error'] = "No hemos podido actualizar : (";
        }
        header('Location: index.php?accion=listar');
        exit;
    }
}
?>