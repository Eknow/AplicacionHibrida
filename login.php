<?php

    require_once "config.php";

	if (isset($_SESSION['access_token'])) {
		header('Location: index.php');
		exit();
	}

	$loginURL = $gClient->createAuthUrl();

    

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="container" id="container">
	<div class="form-container sign-up-container">
	
	</div>
	<div class="form-container sign-in-container">
		<form action="#">
			<h1>Iniciar sesion</h1>
			<span>Ingrese las credenciales de acceso </span>
			<input type="email" placeholder="Email" />
			<input type="password" placeholder="Contraseña" />
			<a href="#">Olvide mi contraseña</a>
			<button>Iniciar</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Inicia con Google!</h1>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Inicia con Google!</h1>
				<p>Utilice su cuenta de Google para iniciar sesion</p>
                <button onclick="window.location = '<?php echo $loginURL ?>';"  id="signUp" class="ghost">Google</button>
			</div>
		</div>
	</div>
</div>
            </div>
        </div>
    </div>
</body>
<script src="accion.js"></script>
</html>