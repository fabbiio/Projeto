<?php

  ini_set('display_errors',1);
  ini_set('display_startup.erros',1);
  error_reporting(E_ALL);
  require_once('../config.php');
  require_once("../config/conexao.php");

    
   
  

    if(isset($_POST['nome']) and  !empty($_POST['nome'])){

      //if(!isset($_POST['imagem'])){


        //$nome = $_POST['nome'];
        //$email = $_POST['email'];
        //$senha = $_POST['senha'];
        //$cidade = $_POST['cidade'];
        //$imagem = $_FILES['imagem'];
        
        //$sql = "INSERT INTO usuario values ('$nome', '$email','$senha','$cidade',NULL,NULL )";
        //$exec = $conn->query($sql); 
        //echo "Cadastro Efetuado";
        //header('Location: '.BASEURL.'users/Login/login.php');

      //}else{
     
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cidade = $_POST['cidade'];
        $imagem = $_FILES['imagem'];
                
        if($imagem['error']){
          die("Falha ao Enviar Imagem");
        }
          
        if($imagem['size'] > 2097152){
          die("Arquivo Muito grande !! MAX: 2MB");
        }
            
        $pasta = "img/";
        $nomefotoenviada = $imagem['name'];
        $novonomefoto = uniqid();
        $extensao = strtolower(pathinfo($nomefotoenviada,PATHINFO_EXTENSION));
          
        if($extensao != "jpg"  and $extensao != 'png' and $extensao != 'jpeg'){
          die("Tipo de Arquivo não aceito");
        }
          
        $path = $pasta . $novonomefoto . "." . $extensao;
        $nomefotoenviada = $imagem['name'];
        $deu_certo = move_uploaded_file($imagem["tmp_name"], $path);
          
        if($deu_certo){
                  
          $sql = "INSERT INTO usuario values (NULL, '$nome', '$email','$senha','$cidade' , '$nomefotoenviada', '$path')";
          $exec = $conn->query($sql); 
          echo "Cadastro Efetuado";
          
          header('Location: '.BASEURL.'users/Login/login.php');
        }          
      } 
?>          




<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../css/style.css">
  
</head>

<body>
  <br>
  <h1 style="text-align: center; color: red;">CADASTRO DE USUÁRIO</h1>
  <br>

  <form action="" method="post"  class="formusu"  enctype="multipart/form-data">
  
 
    <label for="" class="cadu">Nome:</label >
    <input class="cadi" type="text" name="nome" placeholder="Digite o seu nome" required >

    <label for="" class="cadu">E-mail:</label>
    <input class="cadi" type="email" name="email" placeholder="Digite o seu e-mail" required>

    <label for="" class="cadu">Senha:</label>
    <input  class="cadi" type="password" name="senha" placeholder="Digite a sua senha" minlength="8" required >

    <label for="" class="cadu">Cidade:</label>
    <input class="cadi" type="text" name="cidade" placeholder="Digite sua Cidade"  required >
    
   
    <button type="submit" class="sal" value="Cadastrar" name="Cadastrar"></button>
    <br>
    <label for=""  >Insira a Imagem</label>
    <input type="file" name='imagem' required>
    
    <br>
    <br>
    

    <input type="submit" class=volt1 value="Cadastrar" link rel=”author” >
    <a href="<?php echo BASEURL?>users/Login/login.php"class="volt1">Voltar</a>
    
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


</body>

</html>

