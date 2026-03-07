<?php
include_once 'class/usuarios.php';
require_once __DIR__ . '/vendor/autoload.php';
$emailConfig = include __DIR__ . '/config/email.php';
include_once __DIR__ . '/lib/reset_token.php';
$sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo_documento'] ?? '';
    $doc = $_POST['documento'] ?? '';
    $u = new usuarios();
    $u->setDocumento($doc);
    $u->consultar();
    if ($u->getCorreo() && $u->getTipoDocumento() === $tipo) {
        $to = $u->getCorreo();
        $subject = 'Restablecer contraseña';
        $secret = $emailConfig['reset_token_secret'];
        $ttl = $emailConfig['reset_token_ttl'] ?? 1800;
        $token = createResetToken($u->getDocumento(), $secret);
        $base = $emailConfig['reset_base_url'] ?: ($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']);
        $link = rtrim($base, '/'). '/reset_password.php?token=' . urlencode($token);
        $html = '<div style="font-family: Arial, sans-serif; color:#222;">
            <h2>Solicitud de restablecimiento de contraseña</h2>
            <p>Hola ' . htmlspecialchars($u->getNombres()) . ',</p>
            <p>Has solicitado restablecer tu contraseña. Haz clic en el botón para continuar:</p>
            <p style="margin:20px 0;">
                <a href="' . htmlspecialchars($link) . '" style="background:#2e7d32;color:#fff;padding:10px 16px;border-radius:6px;text-decoration:none;display:inline-block;">
                    Restablecer contraseña
                </a>
            </p>
            <p>Si no solicitaste este cambio, ignora este mensaje.</p>
            <hr>
            <small>Granja Amiga</small>
        </div>';
        $ok = false;
        if (!empty($emailConfig['use_smtp'])) {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = $emailConfig['smtp']['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $emailConfig['smtp']['username'];
                $mail->Password = $emailConfig['smtp']['password'];
                $mail->SMTPSecure = $emailConfig['smtp']['secure'];
                $mail->Port = $emailConfig['smtp']['port'];
                $mail->CharSet = 'UTF-8';
                $fromEmail = $emailConfig['smtp']['from_email'] ?: $emailConfig['smtp']['username'];
                $fromName = $emailConfig['smtp']['from_name'] ?? 'Granja Amiga';
                $mail->setFrom($fromEmail, $fromName);
                $mail->addAddress($to);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $html;
                $ok = $mail->send();
            } catch (\Exception $e) {
                $ok = false;
            }
        }
        if (!$ok) {
            $headers = [];
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
            $headers[] = 'From: ' . ($emailConfig['fallback_name'] ?? 'Granja Amiga') . ' <' . ($emailConfig['fallback_from'] ?? 'no-reply@localhost') . '>';
            @mail($to, $subject, $html, implode("\r\n", $headers));
        }
        $sent = true;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidé mi contraseña</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-key"></i> Restablecer contraseña</h1>
            </div>
            <div class="card-body">
                <form action="forgot_password.php" method="POST">
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de documento:</label>
                        <select name="tipo_documento" id="tipo_documento" required>
                            <option value="">-- Seleccione --</option>
                            <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                            <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                            <option value="Cédula de extranjería">Cédula de extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="documento">Número de documento:</label>
                        <input type="text" name="documento" id="documento" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-paper-plane"></i> Enviar enlace</button>
                        <a href="login.php" class="btn-cancel"><i class="fas fa-arrow-left"></i> Volver al login</a>
                    </div>
                    <?php if (!empty($error)): ?>
                        <div class="empty-state">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Datos no encontrados.</p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer"><?php include './config/footer.php' ?></footer>
    <?php if (!empty($error)): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'No encontrado',
            text: 'Verifica el tipo y número de documento.'
        });
    </script>
    <?php endif; ?>
    <?php if (!empty($sent)): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Enlace enviado',
            text: 'Revisa tu correo y usa el botón para cambiar tu contraseña.'
        });
    </script>
    <?php endif; ?>
</body>
</html>
