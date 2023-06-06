<?php
 
 session_start();
 require_once('../../config.php');
 require_once('../../config/conexao.php');

 if(!isset($_SESSION['login'])){
    header('Location: '.BASEURL.'users/Login/login.php');
  }
  $_SESSION['id_usuario'];
  $id_usuario = $_SESSION['id_usuario']; 
  $usuario = $_SESSION['usuario'];

  $sqlSelect = "SELECT * FROM usuario where id=$id_usuario";
  $result = $conn->query($sqlSelect);



  if($result->num_rows > 0){
    while($user_data = mysqli_fetch_assoc($result)){
        $id = $user_data['id'];
        $nome = $user_data['nome'];
        $email = $user_data['email'];
        $senha = $user_data['senha'];
        $cidade = $user_data['cidade'];
   
    }
}
 ?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meu Perfil</title>
        <link rel="stylesheet" href="../../css/style.css">

        <!--------------------------------------------------------------------------------------------------------------------------->
        
    <!--------------------------------------------------------------------------------------------------------------------------->  
    </head>
    <body>
        <div class="topo">
            <ul>
                <h1>Controle de Estoque</h1>
            </ul>
        </div>
    <!---------------------------------------------------------------------------------------------------------------------->
    <nav class="menu">
        <ul class="opcoes">
            <li><a href="<?php echo BASEURL?>">Home</a></li>
            <li>
                <a href="#">Cadastrar</a>
                <ul class="cadastrar">
                    <li><a href="<?php echo BASEURL?>users/produto/cadastro/cadastro_variados.php">Variados</a> </li>  
                    <li><a href="<?php echo BASEURL?>users/produto/cadastro/cadastro_perecivel.php">Pereciveis</a> </li> 
                </ul>
            </li>

            <li ><a href="#" >Estoque</a>
                <ul class="cadastrar">
                    <li><a href="<?php echo BASEURL?>users/produto/consulta/produtos.php"> Consultar</a></li>
                    <li><a href="<?php echo BASEURL?>users/produto/consulta/editar.php"> Editar</a></li>
                   
                    
                </ul>
            </li>
            <li><a href="#">Usuario</a>
                <ul class="cadastrar">
                        <li><a href="<?php echo BASEURL?>users/usuario/usuario.php"> Editar</a></li>
                        <li><a href="<?php echo BASEURL?>users/usuario/excluir.php"> Excluir</a></li>
                    </ul>
        
            </li>
            <li><a href="#">Vendas</a>
                <ul class="cadastrar">
                    <li><a href="<?php echo BASEURL?>users/produto/venda/vender.php"> Vender</a></li>
                    <li><a href="<?php echo BASEURL?>users/produto/venda/carrinho.php">Meu Carrinho</a></li>
                </ul>
            </li>
            <li><a href="<?php echo BASEURL?>users/Login/login.php">Sair</a></li>

        </ul>
    </nav>
    <!---------------------------------------------------------------------------------------------------------------------->
        <div class="title">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
              </svg>
            <h1 class="home">Meu Perfil</h1>
        </div>
        <br><br>
        <form action="" method="post"  class="formusu"  enctype="multipart/form-data">
  
 
        <label for="" class="cadu">Nome:</label >
        <input class="cadi" type="text" name="nome" value="<?php echo $nome?>" required >

        <label for="" class="cadu">E-mail:</label>
        <input class="cadi" type="email" name="email"  value="<?php echo $email?>" required>

        <label for="" class="cadu">Senha:</label>
        <input  class="cadi" type="number" name="senha" value="<?php echo $senha?>" minlength="8" required >

        <label for="" class="cadu">Cidade:</label>
        <input class="cadi" type="text" name="cidade"  value="<?php echo $cidade?>"  required >
        
        
  
  
        <br>
        <br>
  

        <input type="submit" class=volt1 value="Atualizar" link rel=”author” >
        <a href="<?php echo BASEURL?>index.php"class="volt1">Voltar</a>
  
        </form>
    </body>
</html>