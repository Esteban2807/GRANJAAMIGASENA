<?php
include_once 'class/usuarios.php';
include_once __DIR__ . '/lib/reset_token.php';
$emailConfig = include __DIR__ . '/config/email.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doc = $_POST['documento'] ?? '';
    $p1 = $_POST['password'] ?? '';
    $p2 = $_POST['password_confirm'] ?? '';
    if ($doc && $p1 && $p2 && $p1 === $p2) {
        $u = new usuarios();
        $u->setDocumento($doc);
        $u->consultar();
        $u->setContrasena($p1);
        $u->actualizar();
        header("Location: login.php");
        exit;
    } else {
        $error = true;
    }
}
$documento = '';
$token = $_GET['token'] ?? '';
if ($token) {
    list($ok, $docFromToken) = parseResetToken($token, $emailConfig['reset_token_secret'], $emailConfig['reset_token_ttl'] ?? 1800);
    if ($ok) {
        $documento = $docFromToken;
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
    <title>Nueva contraseña</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <header class="header"><?php include './config/header.php' ?></header>
    <main class="container">
        <div class="content-card">
            <div class="card-header">
                <h1 class="card-title"><i class="fas fa-lock"></i> Nueva contraseña</h1>
            </div>
            <div class="card-body">
                <form action="reset_password.php" method="POST">
                    <input type="hidden" name="documento" value="<?= htmlspecialchars($documento) ?>">
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Confirmar contraseña:</label>
                        <input type="password" name="password_confirm" id="password_confirm" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action"><i class="fas fa-save"></i> Guardar</button>
                        <a href="login.php" class="btn-cancel"><i class="fas fa-times"></i> Cancelar</a>
                    </div>
                    <?php if (!empty($error)): ?>
                        <div class="empty-state">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Verifique los campos.</p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer"><?php include './config/footer.php' ?></footer>
</body>
</html>
