<?php
session_start();

require_once __DIR__ . '/../class/usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
	$action = $_POST['action'];

	if ($action === 'login') {
		$tipo = trim($_POST['tipo_documento'] ?? $_POST['tipoDocumento'] ?? '');
		$documento = trim($_POST['documento'] ?? '');
		$contrasena = trim($_POST['contrasena'] ?? '');

		if ($documento === '' || $contrasena === '') {
			$_SESSION['login_error'] = 'Complete los campos.';
			header('Location: login.php');
			exit;
		}

		$usuario = new usuarios();
		$usuario->setDocumento($documento);
		$usuario->consultar();

		$stored = $usuario->getContrasena();
		// Validar contraseña con MD5
		if ($stored && $stored === MD5($contrasena)) {
			$_SESSION['user'] = [
				'documento' => $usuario->getDocumento(),
				'nombres' => $usuario->getNombres(),
				'apellidos' => $usuario->getApellidos(),
				'correo' => $usuario->getCorreo()
			];
			header('Location: index.php');
			exit;
		} else {
			$_SESSION['login_error'] = 'Documento o contraseña incorrectos.';
			header('Location: login.php');
			exit;
		}
	}

	if ($action === 'register') {
		$tipo = trim($_POST['tipo_documento'] ?? $_POST['tipoDocumento'] ?? '');
		$documento = trim($_POST['documento'] ?? '');
		$correo = trim($_POST['correo'] ?? '');
		$nombres = trim($_POST['nombres'] ?? '');
		$apellidos = trim($_POST['apellidos'] ?? '');
		$contrasena = trim($_POST['contrasena'] ?? '');
		$confirm = trim($_POST['confirm_contrasena'] ?? '');
		$id_cargo = trim($_POST['id_cargo'] ?? '2');

		if ($documento === '' || $contrasena === '' || $nombres === '') {
			$_SESSION['login_error'] = 'Complete los campos requeridos.';
			header('Location: login.php');
			exit;
		}

		if ($contrasena !== $confirm) {
			$_SESSION['login_error'] = 'Las contraseñas no coinciden.';
			header('Location: login.php');
			exit;
		}

		// verificar si ya existe
		$check = new usuarios();
		$check->setDocumento($documento);
		$check->consultar();
		if ($check->getNombres()) {
			$_SESSION['login_error'] = 'El usuario ya existe.';
			header('Location: login.php');
			exit;
		}

		$hash = password_hash($contrasena, PASSWORD_DEFAULT);
		$nuevo = new usuarios($tipo, $documento, $correo, $nombres, $apellidos, $hash, $id_cargo);
		$nuevo->insertar();
		$_SESSION['login_error'] = 'Registro exitoso. Ahora inicie sesión.';
		header('Location: login.php');
		exit;
	}
}

?>
