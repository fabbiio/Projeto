<?php
    require_once("../config/conexao.php");

    
   

        if(isset($_POST['nome']) and  !empty($_POST['nome'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cidade = $_POST['cidade'];
            $telefone = $_POST['telefone'];
            
            if(isset($email) != isset($emailsalvo)){

              
              $sql = "INSERT INTO usuario values (NULL, '$nome', '$email','$senha','$cidade', '$telefone')";
              $exec = $conn->query($sql);
      
              
      
      
              echo "Cadastro Efetuado";
              header("Location: ../Login_v1/login.php");
            }
            
          
        }

   
?>          




<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../Css/styleestoque.css">
  <link rel="stylesheet" href="../Css/styleusers.css">
</head>

<body>
  
  <h1 style="color:dodgerblue">CADASTRO DE USUÁRIO</h1>
  <form action="" method="post" >
  
 
    <label for="">Nome:</label >
    <input class="cad" type="text" name="nome" placeholder="Digite o seu nome" required >

    <label for="">E-mail:</label>
    <input class="cad" type="email" name="email" placeholder="Digite o seu e-mail" required>

    <label for="">Senha:</label>
    <input  class="cad" type="password" name="senha" placeholder="Digite a sua senha" minlength="8" required >

    <label for="">Cidade:</label>
    <input class="cad" type="text" name="cidade" placeholder="Digite sua Cidade"  required >
    
    <label for="" >Telefone</label>
    <input class="cad" type="tel" name="telefone" id="telefone" placeholder=Telefone value="(00) 0000-0000"required>
    <button type="reset"></button>
    
    <br>
    <br>
    

    <input type="submit" class=volt1 value="Cadastrar" link rel=”author” >
    <a href="../Login_v1/login.php" class="volt">Voltar</a>
    
  </form>
  <br>
  <?php
							if(isset($_GET['msg'])){            
						?>
								<div class="alert alert-danger" role="alert">
                E-mail ja Cadastrado
                </div>
						<?php        
							}
						?>
  <br><br>
  <footer>
              
        <p> Todos os direitos reservados. </p>
    </footer>

</body>

</html>

