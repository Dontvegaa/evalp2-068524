<?php
require_once 'includes/auth.php';
redirectIfNotLoggedIn();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Figuras - Evaluación Práctica #2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Cálculo de Área y Volumen de Figuras</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $result; ?>
                        
                        <ul class="nav nav-tabs mb-4" id="figureTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="cylinder-tab" data-bs-toggle="tab" data-bs-target="#cylinder" type="button">
                                    Cilindro
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="rectangle-tab" data-bs-toggle="tab" data-bs-target="#rectangle" type="button">
                                    Rectángulo
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="figureTabsContent">
                            <!-- Cilindro -->
                            <div class="tab-pane fade show active" id="cylinder" role="tabpanel">
                                <form method="POST" action="">
                                    <input type="hidden" name="figure" value="cylinder">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="radius" class="form-label">Radio del Cilindro</label>
                                            <input type="number" class="form-control" id="radius" name="radius" step="0.01" min="0.01" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="height" class="form-label">Altura del Cilindro</label>
                                            <input type="number" class="form-control" id="height" name="height" step="0.01" min="0.01" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong>Fórmulas:</strong></p>
                                        <ul>
                                            <li>Área Total = 2πr(r + h)</li>
                                            <li>Volumen = πr²h</li>
                                        </ul>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Calcular</button>
                                </form>
                            </div>
                            
                            <!-- Rectángulo -->
                            <div class="tab-pane fade" id="rectangle" role="tabpanel">
                                <form method="POST" action="">
                                    <input type="hidden" name="figure" value="rectangle">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="base" class="form-label">Base del Rectángulo</label>
                                            <input type="number" class="form-control" id="base" name="base" step="0.01" min="0.01" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="height" class="form-label">Altura del Rectángulo</label>
                                            <input type="number" class="form-control" id="height" name="height" step="0.01" min="0.01" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong>Fórmulas:</strong></p>
                                        <ul>
                                            <li>Área = b × h</li>
                                            <li>Perímetro = 2(b + h)</li>
                                        </ul>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Calcular</button>
                                </form>
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