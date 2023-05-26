<?php
    require_once('../../../config.php');
    require_once('../../../config/conexao.php');
    if(!isset($_SESSION)){
        session_start();
    }



    if(!isset($_SESSION['login'])){
        header('Location: '.BASEURL.'users/Login/login.php');
    }
    $_SESSION['id_usuario'];
    $id_usuario = $_SESSION['id_usuario']; 
    $usuario = $_SESSION['usuario'];
       
       
    $sql = "SELECT * FROM produto WHERE id_usuario ='$id_usuario'"; # instrucao sql (consulta no formato texto)
    $result = $conn->query($sql);
    
    
    $sql = "SELECT caminho_imagem as caminho FROM usuario WHERE id ='$id_usuario'"; # instrucao sql (consulta no formato texto)
    $img = $conn->query($sql);

    $sql = "SELECT * FROM tabela_venda WHERE id_usuario ='$id_usuario'";
    $result = $conn->query($sql);
    
    //unset($_SESSION['carrinho']);
    
    if(isset($_GET['id'])){

        if(!isset($_SESSION['carrinho'])){            
             $_SESSION['carrinho'][] = array("id" => "{$_GET['id']}", "qtd" => "1");
             //var_dump($_SESSION['carrinho']);
        }else{
            $id_cods = array_column($_SESSION['carrinho'], 'id');

            if(!in_array($_GET['id'],$id_cods)){
                $_SESSION['carrinho'][] = array("id" => "{$_GET['id']}", "qtd" => "1");
            }
            //var_dump($_SESSION['carrinho']);  
        }

        
        
        
    }
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas</title>
    <link rel="stylesheet" href="<?php echo BASEURL?>css/style.css">
    


    <!--------------------------------------------------------------------------------------------------------------------------->
    
  <!--------------------------------------------------------------------------------------------------------------------------->  
</head>
<body class="Arquivo">
    <div class="topo">
        <ul>
            <h1>Controle de Estoque</h1>
            <?php
                if (mysqli_num_rows($img) > 0){
                    foreach ( $img as $obg ){
                        ?>
                        <img class="img" src="<?php echo BASEURL . "usuario/". $obg['caminho'];?>">
                        <?php
                    }
                }else{
                    echo "<img class='img' src='usuario/img/person.png'> alt='Sem Foto'";
                    
                }
            ?>
            <h1 class="nome"><?php echo $usuario ?></h1>
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
                        <li><a href="#"> Excluir</a></li>
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
    
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </svg>
        <h1 class="home">Vendas</h1>  
</div>
<!------------------------------------------------------------>
<div class="vendas1">
    <?php
        
        while($user_data = mysqli_fetch_assoc($result)){
           
            echo "<div class='card'>";
                ?>
                <img src="<?php echo BASEURL . "users/produto/cadastro/". $user_data['caminho'];?>">
                <?php
                echo "<div class='descricao'>";
                
                    echo $user_data['nome'];
                echo "</div>";
                echo "<div class='preco'>";
                    echo "<strong>R$ " . number_format($user_data['preco'],2,",",".") . "</strong>";
                echo "</div>";
                echo "<div class='carrinho'>";
                    ?>
                
                    <a href="vender.php?id=<?php echo $user_data['id_produto']  ?>" class='botao' ><button class='confirma'>Adicionar</button></a>
                    <?php
                echo "</div>";
            echo "</div>";      
        }    
    ?>
    
</div>
</body>
</html>


