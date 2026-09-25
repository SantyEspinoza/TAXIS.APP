<?php
require_once 'conexion2.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $celular = $_POST['celular'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $origen = $_POST['origen'] ?? '';
    $destino = $_POST['destino'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $pago = $_POST['pago'] ?? '';

    $fecha_hora = $fecha . ' ' . $hora . ':00';

    $conn = new Connection();
    $conn->store_data($nombre, $email, $ciudad, $origen, $destino, $fecha_hora, $pago, $tipo, $celular);

    // Envío de correo de confirmación
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'taxisapp.soporte@gmail.com';
        $mail->Password   = getenv('GMAIL_APP_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('taxisapp.soporte@gmail.com', 'TAXIS.APP');
        $mail->addAddress($email, $nombre);

        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de solicitud - TAXIS.APP';
        $mail->Body    = "
            <h2>Hola, " . htmlspecialchars($nombre) . "</h2>
            <p>Tu solicitud de viaje ha sido registrada con éxito.</p>
            <ul>
                <li><b>Ciudad:</b> " . htmlspecialchars($ciudad) . "</li>
                <li><b>Origen:</b> " . htmlspecialchars($origen) . "</li>
                <li><b>Destino:</b> " . htmlspecialchars($destino) . "</li>
                <li><b>Fecha y hora:</b> " . htmlspecialchars($fecha_hora) . "</li>
                <li><b>Método de pago:</b> " . htmlspecialchars($pago) . "</li>
            </ul>
            <p>Gracias por usar <b>TAXIS.APP</b>.</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar correo: " . $mail->ErrorInfo);
    }

    header("Location: index.php?status=ok");
    exit;
}
