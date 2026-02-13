<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .form-container {
            padding: 40px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            font-size: 1.1em;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-primary:hover {
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
        }
        
        .alumno-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            border-left: 4px solid #667eea;
        }
        
        .alumno-info p {
            margin: 5px 0;
            color: #555;
        }
        
        .alumno-info strong {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Alumno</h1>
            <p>Actualiza la informacion del alumno</p>
        </header>
        
        <div class="form-container">
            <?php if (isset($_SESSION['errores_formulario'])): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <strong>Los errores son:</strong>
                    <ul style="margin-top: 10px; margin-left: 20px;">
                        <?php foreach ($_SESSION['errores_formulario'] as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errores_formulario']); ?>
            <?php endif; ?>
            
            <div class="alumno-info">
                <p><strong>ID del Alumno:</strong> <?php echo htmlspecialchars($alumno['id']); ?></p>
                <p><strong>Fecha de Registro:</strong> <?php echo date('d/m/Y H:i', strtotime($alumno['fecha_creacion'])); ?></p>
            </div>
            
            <form action="index.php?accion=actualizar" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($alumno['id']); ?>">
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        value="<?php echo isset($_SESSION['datos_formulario']['nombre']) ? htmlspecialchars($_SESSION['datos_formulario']['nombre']) : htmlspecialchars($alumno['nombre']); ?>"
                        required
                        autofocus
                    >
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo isset($_SESSION['datos_formulario']['email']) ? htmlspecialchars($_SESSION['datos_formulario']['email']) : htmlspecialchars($alumno['email']); ?>"
                    >
                </div>
                
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input 
                        type="number" 
                        id="edad" 
                        name="edad" 
                        value="<?php echo isset($_SESSION['datos_formulario']['edad']) ? htmlspecialchars($_SESSION['datos_formulario']['edad']) : htmlspecialchars($alumno['edad']); ?>"
                        min="1" 
                        max="120"
                        required
                    >
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php?accion=listar" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['datos_formulario'])): ?>
        <script>
            window.onload = function() {
                <?php unset($_SESSION['datos_formulario']); ?>
            };
        </script>
    <?php endif; ?>
</body>
</html>