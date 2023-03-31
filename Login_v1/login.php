<?php
	  session_start();
	  session_destroy();
	  
  
	  if(isset($_POST['email']) and !empty(($_POST['email'])))
	  {
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		require_once('../config/conexao.php');

		$sql = "SELECT * FROM usuario where email='$email' and senha='$senha'";
		$exec = $conn->query($sql);
		
		

		if($exec->num_rows > 0){
			session_start();
			while($linhas = $exec->fetch_object()){
				$_SESSION['login'] = $linhas->email;
				$_SESSION['senha'] = $linhas->senha;
				$_SESSION['usuario'] = $linhas->nome;
				$_SESSION['id_usuario'] = $linhas->id;
			}
			
			$_SESSION['login'] = $email;

			//if (isset($_SESSION['id_usuario']) and $_SESSION['id_usuario'] == 1){
				header('Location: ../index.php');
			//}
			//else{
				//header('Location: ../Index/cliente.php');	
			//}
		}
		else{
			header('Location: login.php?msg=1');
		}
	  }
	
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./css/util.css">
	<link rel="stylesheet" type="text/css" href="./css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./css/styleestoque.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="./images/estoque1.jpg" alt="jpg">
				</div>

				<form class="login100-form validate-form" method="post" action="">
					<span class="login100-form-title">
						<h1 style="color: dodgerblue;">Bem Vindo</h1>
						
					</span>
					<?php
							if(isset($_GET['msg'])){            
						?>
								<div class="alert alert-danger" role="alert">
									Informações Inválidas !!!
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
						<input class="input100" type="password" name="senha" placeholder="Password">
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

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="login_adm.php">
							Portal Administrador
							<i class="fa " aria-hidden="true"></i>
						</a>
						<br>
						<a class="txt2" href="../Usuario/cadastro_usuario.php">
							Criar nova Conta
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
							
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<footer>
        <p style="margin-left:45%"> Todos os direitos reservados. </p>
    </footer>
</body>
</html>