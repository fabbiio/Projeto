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


if(isset($_POST['nome']) and !empty($_POST['nome'])){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];
    

    $sql = "SELECT * FROM usuario";
    $result = $conn->query($sql);
    
    $exis = 0;
    if($result->num_rows >= 0){
        while($data = mysqli_fetch_assoc($result)){
            $email2 = $data['email'];
            if($email == $email2){
                $exis = 1;
                break;               
            }
            else{
                $exis = 2;
            }
        }

    if($exis == 1){
        echo "Ja existe";
        }

    else{
        $sql = "INSERT INTO usuario values (NULL, '$nome' , '$email' , '$senha' , '$cidade' , '$telefone')";
        $exec = $conn->query($sql);
        echo "inserido";              
        }
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
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="../../css/style.css">
    
</head>
<body>
    <div class="topo">
        <ul>
            <h1>Adicionar Usuario</h1>
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
                <li><a href="#">Usuario</a>
                    <ul class="cadastrar">
                            <li><a href=""> Editar</a></li>
                            <li><a href="#"> Excluir</a></li>
                        </ul>
            
                </li>
                <li><a href="#">Quem somos</a></li>
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
    <form action="" method="post" >
  
       
        <label for="">Nome:</label >
        <input  type="text" name="nome" placeholder="Digite o seu nome" required >
    
        <label for="">E-mail:</label>
        <input  type="email" name="email" placeholder="Digite o seu e-mail" required>
    
        <label for="">Senha:</label>
        <input  type="password" name="senha" placeholder="Digite a sua senha" minlength="8" required >
    
        <label for="">Cidade:</label>
        <input  type="text" name="cidade" placeholder="Digite sua Cidade"  required >
        
        <label for="" >Telefone</label>
        <input class="telefone" type="tel" name="telefone" id="telefone" placeholder=Telefone value="(00) 0000-0000"required>
        
        
        

        <br>
        <br>
        
    
        <input type="submit" class=volt1 value="Cadastrar" link rel=”author” >
       
        
      </form>
</div>

</body>
</html>