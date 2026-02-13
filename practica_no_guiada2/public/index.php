<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DB_HOST', 'localhost');
define('DB_NAME', 'centro3');
define('DB_USER', 'root');
define('DB_PASS', 'root123');
define('DB_CHARSET', 'utf8mb4');

define('LOG_PATH', __DIR__ . '/../storage/errores.log');


require_once '../app/Modelos/ConexionBD.php';
require_once '../app/Modelos/Alumno.php';
require_once '../app/Controladores/ControladorAlumnos.php';


$accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';
$controlador = new ControladorAlumnos();

switch ($accion) {
    case 'listar':
        $controlador->listarAlumnos();
        break;
    case 'editar':
        $controlador->mostrarFormularioEditar();
        break;
    case 'actualizar':
        $controlador->actualizarAlumno();
        break;
    default:
        $controlador->listarAlumnos();
        break;
}
?>