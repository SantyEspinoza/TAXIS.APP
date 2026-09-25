<?php
require_once 'conexion2.php';
$conn = new Connection();
$pdo = $conn->getConnection();
$stmt = $pdo->query("SELECT * FROM datos ORDER BY fecha_hora DESC");
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAXIS.APP - Registros</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
        }
        h1 { color: #1e3a5f; margin-bottom: 8px; font-size: 26px; }
        .subtitle { color: #718096; font-size: 14px; margin-bottom: 24px; }
        .search-box { position: relative; margin-bottom: 24px; }
        .search-box i {
            position: absolute; left: 16px; top: 50%;
            transform: translateY(-50%); color: #a0aec0;
        }
        .search-box input {
            width: 100%; padding: 14px 16px 14px 44px;
            border: 2px solid #e2e8f0; border-radius: 12px;
            font-size: 14px; font-family: 'Inter', sans-serif;
            background: #f7fafc; outline: none;
        }
        .search-box input:focus { border-color: #2c5282; background: #fff; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th {
            background: #f7fafc; color: #2c5282;
            padding: 12px; text-align: left;
            font-weight: 600; border-bottom: 2px solid #e2e8f0;
        }
        td {
            padding: 12px; border-bottom: 1px solid #edf2f7;
            color: #4a5568;
        }
        tr:hover td { background: #f7fafc; }
        .empty { text-align: center; padding: 40px; color: #a0aec0; }
        .total { margin-top: 20px; color: #718096; font-size: 13px; }
        .back {
            display: inline-block; margin-top: 24px;
            color: #2c5282; text-decoration: none; font-weight: 500;
        }
        .back:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-list"></i> Registros de Viajes</h1>
        <p class="subtitle">Total de solicitudes almacenadas</p>

        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar por nombre, correo o teléfono...">
        </div>

        <table id="tabla">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Celular</th>
                    <th>Ciudad</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha/Hora</th>
                    <th>Pago</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($registros) === 0): ?>
                    <tr><td colspan="9" class="empty">No hay registros aún</td></tr>
                <?php else: ?>
                    <?php foreach ($registros as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['nombre_y_apellidos']) ?></td>
                            <td><?= htmlspecialchars($r['direccion_email']) ?></td>
                            <td><?= htmlspecialchars($r['num_celular']) ?></td>
                            <td><?= htmlspecialchars($r['ciudad']) ?></td>
                            <td><?= htmlspecialchars($r['origen']) ?></td>
                            <td><?= htmlspecialchars($r['destino']) ?></td>
                            <td><?= htmlspecialchars($r['fecha_hora']) ?></td>
                            <td><?= htmlspecialchars($r['metodo_pago']) ?></td>
                            <td><?= htmlspecialchars($r['identifiquese']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <p class="total">Total: <?= count($registros) ?> registros</p>
        <a href="index.php" class="back"><i class="fas fa-arrow-left"></i> Volver al formulario</a>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#tabla tbody tr');
            filas.forEach(fila => {
                fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
