<?php
require_once 'includes/auth.php';
redirectIfNotLoggedIn();

$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $side1 = floatval($_POST['side1']);
    $side2 = floatval($_POST['side2']);
    $side3 = floatval($_POST['side3']);
    
    // Validar que los lados formen un triángulo
    if ($side1 > 0 && $side2 > 0 && $side3 > 0 && 
        $side1 + $side2 > $side3 && 
        $side1 + $side3 > $side2 && 
        $side2 + $side3 > $side1) {
        
        // Calcular perímetro
        $perimeter = $side1 + $side2 + $side3;
        
        // Calcular área usando fórmula de Herón
        $s = $perimeter / 2;
        $area = sqrt($s * ($s - $side1) * ($s - $side2) * ($s - $side3));
        
        // Determinar tipo de triángulo
        if ($side1 == $side2 && $side2 == $side3) {
            $triangleType = "Equilátero";
        } elseif ($side1 == $side2 || $side1 == $side3 || $side2 == $side3) {
            $triangleType = "Isósceles";
        } else {
            $triangleType = "Escaleno";
        }
        
        // Verificar si es triángulo rectángulo
        $sides = [$side1, $side2, $side3];
        sort($sides);
        $isRightTriangle = abs(pow($sides[2], 2) - (pow($sides[0], 2) + pow($sides[1], 2))) < 0.0001;
        
        $result = "
            <div class='alert alert-success'>
                <h5>Resultados del Triángulo:</h5>
                <p><strong>Lado 1:</strong> " . number_format($side1, 2) . " unidades</p>
                <p><strong>Lado 2:</strong> " . number_format($side2, 2) . " unidades</p>
                <p><strong>Lado 3:</strong> " . number_format($side3, 2) . " unidades</p>
                <p><strong>Tipo de Triángulo:</strong> {$triangleType}" . 
                   ($isRightTriangle ? " (Rectángulo)" : "") . "</p>
                <p><strong>Perímetro:</strong> " . number_format($perimeter, 2) . " unidades</p>
                <p><strong>Área:</strong> " . number_format($area, 2) . " unidades²</p>
            </div>
        ";
    } else {
        $result = "<div class='alert alert-danger'>Los lados ingresados no forman un triángulo válido. Recuerda que la suma de dos lados debe ser mayor que el tercer lado.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triángulos - Evaluación Práctica #2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .triangle-img {
            max-width: 200px;
            margin: 20px auto;
            display: block;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Módulo de Triángulos</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $result; ?>
                        
                        <div class="text-center mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/
                                 alt="Triángulo" class="triangle-img">
                            <p class="text-muted">Ingresa las longitudes de los tres lados del triángulo</p>
                        </div>
                        
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="side1" class="form-label">Lado 1</label>
                                    <input type="number" class="form-control" id="side1" name="side1" 
                                           step="0.01" min="0.01" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="side2" class="form-label">Lado 2</label>
                                    <input type="number" class="form-control" id="side2" name="side2" 
                                           step="0.01" min="0.01" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="side3" class="form-label">Lado 3</label>
                                    <input type="number" class="form-control" id="side3" name="side3" 
                                           step="0.01" min="0.01" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h6>Fórmulas Utilizadas:</h6>
                                <ul class="list-unstyled">
                                    <li>• <strong>Perímetro:</strong> P = a + b + c</li>
                                    <li>• <strong>Área (Fórmula de Herón):</strong> 
                                        A = √[s(s-a)(s-b)(s-c)] donde s = (a+b+c)/2</li>
                                    <li>• <strong>Tipos de Triángulos:</strong>
                                        <ul>
                                            <li>Equilátero: 3 lados iguales</li>
                                            <li>Isósceles: 2 lados iguales</li>
                                            <li>Escaleno: 0 lados iguales</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-info">Calcular Propiedades del Triángulo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>