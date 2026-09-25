<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAXIS.APP - Registro de Viaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }
        .logo { text-align: center; margin-bottom: 8px; }
        .logo i { font-size: 40px; color: #2c5282; }
        .logo h1 {
            font-size: 26px;
            color: #1e3a5f;
            margin-top: 8px;
            font-weight: 700;
        }
        .subtitle {
            text-align: center;
            color: #718096;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .success-msg {
            background: #f0fff4;
            border-left: 4px solid #38a169;
            color: #22543d;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s ease;
        }
        .success-msg.show { display: flex; }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .field {
            position: relative;
            margin-bottom: 16px;
        }
        .field i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 15px;
        }
        .field input, .field select {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            background: #f7fafc;
            transition: all 0.2s;
            outline: none;
        }
        .field input:focus, .field select:focus {
            border-color: #2c5282;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(44,82,130,0.1);
        }
        .row {
            display: flex;
            gap: 12px;
        }
        .row .field { flex: 1; }
        .btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #2c5282, #1e3a5f);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(44,82,130,0.4); }
        .btn:active { transform: translateY(0); }
        .list-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #2c5282;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }
        .list-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <i class="fas fa-taxi"></i>
            <h1>TAXIS.APP</h1>
        </div>
        <p class="subtitle">Registro de solicitud de servicio</p>

        <div class="success-msg" id="successMsg">
            <i class="fas fa-check-circle"></i>
            <span>Registro guardado correctamente</span>
        </div>

        <form action="form_controller.php" method="POST" id="taxiForm">
            <div class="field">
                <i class="fas fa-user"></i>
                <input type="text" name="nombre" placeholder="Nombre completo" required>
            </div>
            <div class="field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Correo electrónico" required>
            </div>
            <div class="field">
                <i class="fas fa-phone"></i>
                <input type="tel" name="celular" placeholder="Número de celular" maxlength="10" required>
            </div>
            <div class="field">
                <i class="fas fa-id-card"></i>
                <select name="tipo" required>
                    <option value="">Selecciona una opción</option>
                    <option value="Pasajero">Pasajero</option>
                    <option value="Conductor">Conductor</option>
                </select>
            </div>
            <div class="field">
                <i class="fas fa-city"></i>
                <input type="text" name="ciudad" placeholder="Ciudad" required>
            </div>
            <div class="row">
                <div class="field">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="origen" placeholder="Origen" required>
                </div>
                <div class="field">
                    <i class="fas fa-flag-checkered"></i>
                    <input type="text" name="destino" placeholder="Destino" required>
                </div>
            </div>
            <div class="row">
                <div class="field">
                    <i class="fas fa-calendar"></i>
                    <input type="date" name="fecha" required>
                </div>
                <div class="field">
                    <i class="fas fa-clock"></i>
                    <input type="time" name="hora" required>
                </div>
            </div>
            <div class="field">
                <i class="fas fa-credit-card"></i>
                <select name="pago" required>
                    <option value="">Método de pago</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </div>
            <button type="submit" class="btn">Registrar Viaje</button>
        </form>

        <a href="listado.php" class="list-link">Ver registros</a>
    </div>

    <script>
        const params = new URLSearchParams(window.location.search);
        if (params.get('status') === 'ok') {
            const msg = document.getElementById('successMsg');
            msg.classList.add('show');
            document.getElementById('taxiForm').reset();
            setTimeout(() => msg.classList.remove('show'), 4000);
        }
    </script>
</body>
</html>
