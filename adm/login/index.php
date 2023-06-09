<?php
	ini_set('display_errors',1);
	ini_set('display_startup.erros',1);
	error_reporting(E_ALL);
    
	require_once('../../config.php');
	require_once( ABSPATH . 'config/conexao.php');
	


    session_start();
    session_destroy();

    if (isset($_POST['email']) and !empty(($_POST['email']))) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        require_once(ABSPATH . 'config/conexao.php');

        $sql = "SELECT * FROM administrador where email='$email' and senha='$senha'";
        $exec = $conn->query($sql);

        if ($exec->num_rows > 0) {
            session_start();
            while ($linhas = $exec->fetch_object()) {
                $_SESSION['login'] = $linhas->email;
                $_SESSION['senha'] = $linhas->senha;
                $_SESSION['usuario'] = $linhas->nome;
                $_SESSION['id_usuario'] = $linhas->id;
            }

            $_SESSION['login'] = $email;

            header('Location: ' . BASEURL . 'adm/index.php');

        } else {
            header('Location: index.php?msg=1');
        }
    }
	
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login Administrador</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo BASEURL?>users/Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>users/Login/css/styleestoque.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo BASEURL?>users/Login/images/estoque1.jpg" alt="jpg">
				</div>

				<form class="login100-form validate-form" method="post" action="">
					<span class="login100-form-title">
						<h1 style="color: dodgerblue;">Administrador</h1>
						
					</span>
					<?php
							if(isset($_GET['msg'])){            
						?>
								<div class="alert alert-danger" role="alert">
									Usuario ou Senha Incorretos !!!
								</div>
						<?php        
							}
						?>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="senha" placeholder="Senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="<?php echo BASEURL?>users/Login/login.php">
							Portal Usuario
							<i class="fa " aria-hidden="true"></i>
						</a>
						<br>
						
							
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
<script src="<?php echo BASEURL?>users/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo BASEURL?>users/Login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo BASEURL?>users/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo BASEURL?>users/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo BASEURL?>users/Login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<!--===============================================================================================-->
	<script src="<?php echo BASEURL?>users/Login/js/main.js"></script>
	
</body>
</html>