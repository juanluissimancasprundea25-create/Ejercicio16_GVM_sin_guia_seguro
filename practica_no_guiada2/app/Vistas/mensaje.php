<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        
        .mensaje-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 500px;
        }
        
        .mensaje-exito {
            color: #28a745;
            font-size: 2em;
            margin-bottom: 20px;
        }
        
        .mensaje-error {
            color: #dc3545;
            font-size: 2em;
            margin-bottom: 20px;
        }
        
        p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #555;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.2s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="mensaje-container">
        <?php if ($tipo === 'exito'): ?>
            <div class="mensaje-exito">Bien</div>
            <h2>Todo ha ido bien :D</h2>
        <?php else: ?>
            <div class="mensaje-error">Mal</div>
            <h2>Uyyyyyy... Algoi a salido mal</h2>
        <?php endif; ?>
        
        <p><?php echo htmlspecialchars($mensaje); ?></p>
        
        <a href="index.php?accion=listar" class="btn">Volver</a>
    </div>
</body>
</html>