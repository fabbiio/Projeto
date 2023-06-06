
<?php
  ini_set('display_errors',1);
  ini_set('display_startup.erros',1);
  error_reporting(E_ALL);

 session_start();
  require_once('../../../config.php');
 require_once('../../../config/conexao.php');

 

 if(!empty($_GET['id'])){ # Pegando os valores

  $id = $_GET['id'];

  $sqlSelect = "SELECT * FROM produto where id=$id";
  $result = $conn->query($sqlSelect);

  $sqlSelect = "SELECT * FROM imagens where id_produto =$id";
  $imagens = $conn->query($sqlSelect);

  if($result->num_rows > 0){
      while($user_data = mysqli_fetch_assoc($result)){
          $id = $user_data['id'];
          $nome = $user_data['nome'];
          $tipo = $user_data['tipo'];
          $categoria = $user_data['categoria'];
          $quantidade = $user_data['quantidade'];
          $preco = $user_data['preco'];
          $fornecedor = $user_data['fornecedor'];
          $marca = $user_data['marca'];
          $validade = $user_data['data_validade'];
      }

      while($user_data = mysqli_fetch_assoc($imagens)){
        $imagem = $user_data['nome'];
      }
  }

  else{
        header('Location: '.BASEURL.'users/consulta/editar.php');
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
        <title>Editar Estoque</title>
        <link rel="stylesheet" href="<?php echo BASEURL?>css/style.css">

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
            
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="margin-left:620px;">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <h1 class="home">Editar Produto</h1>
        </div>
    <!---------------------------------------------------------------------------------------------------->
    <br><br>
    <form action="saveedit.php" method="post">
        
        <label for="">Produto:</label>
        <input type="text"  name="nome" value="<?php echo $nome?>" maxlength="45" >
        <br>
        <label>Tipo</label>
        <input type="text"  name="tipo" value="<?php echo $tipo?>" disabled >
        <br>
        
        <label>Categoria</label>
        <select class="form-select" name="categoria"  style="font-size:13px"  required >
        <option><?php echo $categoria?></option>
        <?php
            
            
            $sql = "SELECT * FROM categoria" ;
            $result = $conn->query($sql);
            while($user_data = mysqli_fetch_assoc($result)){
                echo "<option>" . $user_data['tipo']."</option>";
        }
      ?> 
        </select>
        <br>
        <label>Quantidade</label>
        <input type="number"  name="quantidade" value="<?php echo $quantidade?>">
        <br>
        <label>Data Validade</label>
        <input type="date"  name="validade" value="<?php echo $validade?>">
        <br>
        <br>
        <label>Preço</label>
        <input type="number" name="preco" step="0.01" value="<?php echo $preco?>">
        <br> 
        <label>Fornecedor</label>
        <input type="text" name="fornecedor"  value="<?php echo $fornecedor?>">
        <br>
        <label>Marca</label>
        <input type="text" name="marca" value="<?php echo $marca?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
      
        
        <br>
        <br>
        <br>
      
      
      <input type="submit" value="Atualizar" class="add" name="update">
    </form>
    </div>

</body>
</html>