<?php
require_once 'includes/auth.php';
redirectIfNotLoggedIn();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Evaluación Práctica #2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Panel Principal</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <h5>¡Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h5>
                            <p class="mb-0">Has iniciado sesión correctamente en el sistema.</p>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Cálculo de Figuras</h5>
                                        <p class="card-text">Calcula áreas y volúmenes de diferentes figuras geométricas.</p>
                                        <a href="figures.php" class="btn btn-outline-primary">Ir al Módulo</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card text-center h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Información del Sistema</h5>
                                        <p class="card-text">Sistema desarrollado con PHP, Bootstrap 5 y MySQL.</p>
                                        <button class="btn btn-outline-info" disabled>Próximamente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>