<?php
require_once 'includes/auth.php';
redirectIfNotLoggedIn();

$result = '';
$triangleType = '';
$showTriangle = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $side1 = floatval($_POST['side1']);
    $side2 = floatval($_POST['side2']);
    $side3 = floatval($_POST['side3']);
    
    // Validar que los valores sean numéricos y positivos
    if ($side1 <= 0 || $side2 <= 0 || $side3 <= 0) {
        $result = "<div class='alert alert-danger'>
            <i class='bi bi-exclamation-triangle-fill'></i>
            <strong>Error:</strong> Todos los valores deben ser numéricos y positivos.
        </div>";
    }
    // Validar desigualdad triangular
    elseif (!($side1 + $side2 > $side3 && $side1 + $side3 > $side2 && $side2 + $side3 > $side1)) {
        $result = "<div class='alert alert-danger'>
            <i class='bi bi-x-circle-fill'></i>
            <strong>Triángulo Inválido:</strong> Los lados ingresados no cumplen con la desigualdad triangular. 
            La suma de dos lados debe ser mayor que el tercer lado.
        </div>";
    }
    else {
        // Calcular perímetro
        $perimeter = $side1 + $side2 + $side3;
        
        // Calcular área usando fórmula de Herón
        $s = $perimeter / 2;
        $area = sqrt($s * ($s - $side1) * ($s - $side2) * ($s - $side3));
        
        // Determinar tipo de triángulo
        if ($side1 == $side2 && $side2 == $side3) {
            $triangleType = "Equilátero";
            $triangleIcon = "🔺";
            $triangleColor = "success";
            $triangleImage = "equilatero.png";
        } elseif ($side1 == $side2 || $side1 == $side3 || $side2 == $side3) {
            $triangleType = "Isósceles";
            $triangleIcon = "🔻";
            $triangleColor = "info";
            $triangleImage = "isosceles.png";
        } else {
            $triangleType = "Escaleno";
            $triangleIcon = "📐";
            $triangleColor = "warning";
            $triangleImage = "escaleno.png";
        }
        
        // Verificar si es triángulo rectángulo
        $sides = [$side1, $side2, $side3];
        sort($sides);
        $isRightTriangle = abs(pow($sides[2], 2) - (pow($sides[0], 2) + pow($sides[1], 2))) < 0.0001;
        
        $showTriangle = true;
        
        $result = "
            <div class='alert alert-{$triangleColor} border-{$triangleColor}' style='border-left: 5px solid;'>
                <div class='row align-items-center'>
                    <div class='col-md-8'>
                        <h5 class='mb-3'>
                            <span style='font-size: 2rem;'>{$triangleIcon}</span>
                            Triángulo {$triangleType}" . 
                            ($isRightTriangle ? " <span class='badge bg-danger'>Rectángulo</span>" : "") . "
                        </h5>
                        <div class='row'>
                            <div class='col-md-6'>
                                <p class='mb-2'><strong>📏 Lado 1:</strong> " . number_format($side1, 2) . " unidades</p>
                                <p class='mb-2'><strong>📏 Lado 2:</strong> " . number_format($side2, 2) . " unidades</p>
                                <p class='mb-2'><strong>📏 Lado 3:</strong> " . number_format($side3, 2) . " unidades</p>
                            </div>
                            <div class='col-md-6'>
                                <p class='mb-2'><strong>📐 Perímetro:</strong> " . number_format($perimeter, 2) . " unidades</p>
                                <p class='mb-2'><strong>📊 Área:</strong> " . number_format($area, 2) . " unidades²</p>
                                <p class='mb-2'><strong>🏷️ Clasificación:</strong> {$triangleType}</p>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4 text-center'>
                        <div class='triangle-visual triangle-{$triangleColor}'>
                            <div class='triangle-shape'></div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación de Triángulos - Evaluación Práctica #2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            padding: 20px;
        }
        
        .triangle-img {
            max-width: 180px;
            margin: 20px auto;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .triangle-visual {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            position: relative;
        }
        
        .triangle-shape {
            width: 0;
            height: 0;
            border-left: 60px solid transparent;
            border-right: 60px solid transparent;
            margin: 0 auto;
        }
        
        .triangle-success .triangle-shape {
            border-bottom: 104px solid #198754;
        }
        
        .triangle-info .triangle-shape {
            border-bottom: 104px solid #0dcaf0;
        }
        
        .triangle-warning .triangle-shape {
            border-bottom: 104px solid #ffc107;
        }
        
        .formula-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .formula-box h6 {
            color: #667eea;
            font-weight: 600;
        }
        
        .type-example {
            text-align: center;
            margin: 10px 0;
        }
        
        .type-example img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-header text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-triangle"></i>
                            Ejercicio 3: Clasificación de Triángulos
                        </h4>
                        <small>Ingresa los tres lados y descubre el tipo de triángulo</small>
                    </div>
                    <div class="card-body p-4">
                        <?php echo $result; ?>
                        
                        <div class="text-center mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828429.png" 
                                 alt="Triángulo" class="triangle-img">
                        </div>
                        
                        <form method="POST" action="" id="triangleForm">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="side1" class="form-label">
                                        <i class="bi bi-rulers"></i> Lado 1
                                    </label>
                                    <input type="number" class="form-control form-control-lg" 
                                           id="side1" name="side1" 
                                           step="0.01" min="0.01" 
                                           placeholder="Ej: 5.0"
                                           required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="side2" class="form-label">
                                        <i class="bi bi-rulers"></i> Lado 2
                                    </label>
                                    <input type="number" class="form-control form-control-lg" 
                                           id="side2" name="side2" 
                                           step="0.01" min="0.01"
                                           placeholder="Ej: 5.0"
                                           required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="side3" class="form-label">
                                        <i class="bi bi-rulers"></i> Lado 3
                                    </label>
                                    <input type="number" class="form-control form-control-lg" 
                                           id="side3" name="side3" 
                                           step="0.01" min="0.01"
                                           placeholder="Ej: 5.0"
                                           required>
                                </div>
                            </div>
                            
                            <div class="formula-box">
                                <h6><i class="bi bi-calculator"></i> Fórmulas y Reglas:</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2">
                                                <strong>Desigualdad Triangular:</strong><br>
                                                <code>a + b > c</code> para todos los lados
                                            </li>
                                            <li class="mb-2">
                                                <strong>Perímetro:</strong> <code>P = a + b + c</code>
                                            </li>
                                            <li>
                                                <strong>Área (Herón):</strong><br>
                                                <code>A = √[s(s-a)(s-b)(s-c)]</code> donde <code>s = P/2</code>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Tipos de Triángulos:</strong>
                                        <ul class="list-unstyled mb-0 mt-2">
                                            <li>🔺 <strong>Equilátero:</strong> 3 lados iguales</li>
                                            <li>🔻 <strong>Isósceles:</strong> 2 lados iguales</li>
                                            <li>📐 <strong>Escaleno:</strong> 3 lados distintos</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-calculator-fill"></i>
                                    Clasificar Triángulo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación en tiempo real
        document.getElementById('triangleForm').addEventListener('submit', function(e) {
            const side1 = parseFloat(document.getElementById('side1').value);
            const side2 = parseFloat(document.getElementById('side2').value);
            const side3 = parseFloat(document.getElementById('side3').value);
            
            if (side1 <= 0 || side2 <= 0 || side3 <= 0) {
                e.preventDefault();
                alert('Todos los valores deben ser positivos');
            }
        });
    </script>
</body>
</html>