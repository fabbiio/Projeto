<?php
ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);


session_start();

require_once('../../config.php'); 
require_once( ABSPATH . 'config/conexao.php');

//require_once('/config/config_adm.php');


if(!isset($_SESSION['login'])){
    header('Location: ./Login_v1/login.php');
}

    $_SESSION['id_usuario'];
    $id_usuario = $_SESSION['id_usuario']; 

if(isset($_POST['nome']) and  !empty($_POST['nome'])){
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
        
    $pasta = "../../usuario/img/";
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
      
      header('Location: ../consultas/usuarios.php') ;  
    }          
}
?>
<!----------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuarios</title>
    <link rel="stylesheet" href="../../css/style.css">
    
</head>
<body>
    <div class="topo">
        <ul>
            <h1>Portal Administrador</h1>
        </ul>
    </div>
<!---------------------------------------------------------------------------------------------------------------------->
    <nav class="menu">
            <ul class="opcoes">
                <li><a href="../index.php">Home</a></li>
                <li>
                    <a href="#">Cadastrar</a>
                    <ul class="cadastrar">
                        <li><a href="usuarios.php">Usuarios</a> </li>  
                        <li><a href="categoria.php">Categorias</a> </li> 
                    </ul>
                </li>

                <li ><a href="#" >Consulta</a>
                    <ul class="cadastrar">
                        <li><a href="../consultas/estoque.php"> Estoque</a></li>
                        <li><a href="../consultas/usuarios.php"> Usuarios</a></li>
                        <li><a href="../consultas/categoria.php"> Categorias</a></li>
                        
                    </ul>
                </li>
                
                <li><a href="../../adm/login/index.php">Sair</a></li>

            </ul>
        </nav>
 <!---------------------------------------------------------------------------------------------------------------------->
 <div class="title">
    
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="icon" viewBox="0 0 16 16">
        <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/> 
    </svg>

    <h1 class="home">Novo Usuario</h1>
    

</div>
<div>
    <br>
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
    
    
    <br>
    <label for=""  >Insira a Imagem</label>
    <input type="file" name='imagem' required>
    <br>
    <br>
    
    <input type="submit" class=volt1 value="Cadastrar" link rel=”author” >
       
        
      </form>
</div>

</body>
</html>