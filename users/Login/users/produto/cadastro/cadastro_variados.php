
<?php
  session_start();
  require_once('../../../config/conexao.php');

  $sql_code_perecivel = "SELECT * FROM tipo_perecivel order by nome asc";
  $sql_perecivel = $conn->query($sql_code_perecivel);

  $sql_code_nperecivel = "SELECT * FROM tipo_perecivel order by nome asc";
  $sql_nperecivel = $conn->query($sql_code_nperecivel);

  $sql = "SELECT * FROM categoria"; 
  $result = $conn->query($sql);

 

  if(isset($_POST['nome']) and !empty($_POST['nome'])){ # Pegando os valores
    
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $marca = $_POST['marca'];
    $fornecedor = $_POST['fornecedor'];
    $id_usuario = $_SESSION['id_usuario']; 
    

    

    $sql = "INSERT INTO produto values (NULL, '$nome','VARIADO', '$categoria' , '$quantidade', '$preco','$fornecedor','$marca','2055/12/30',now(),'$id_usuario')"; # Comando sql (varchar tem que ter aspas simples)
    $exec = $conn->query($sql); #realizando consulta
    header('Location: ../../../index.php');//
    }
?>

<!------------------------------------------------------------------------------------------------>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Variados</title>
    <link rel="stylesheet" href="../../../css/style.css">

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
            <li><a href="../../../index.php">Home</a></li>
            <li>
                <a href="#">Cadastrar</a>
                <ul class="cadastrar">
                    <li><a href="cadastro_variados.php">Variados</a> </li>  
                    <li><a href="cadastro_perecivel.php">Pereciveis</a> </li> 
                </ul>
            </li>

            <li ><a href="#" >Estoque</a>
                <ul class="cadastrar">
                    <li><a href="../consulta/produtos.php"> Consultar</a></li>
                    
                    <li><a href="#"> Excluir</a></li>
                    
                </ul>
            </li>
            <li><a href="#">Usuario</a>
                <ul class="cadastrar">
                        <li><a href="../../usuario/usuario.php"> Editar</a></li>
                        <li><a href="#"> Editar</a></li>
                    </ul>
        
            </li>
            <li><a href="#">Quem somos</a></li>
            <li><a href="../../Login/login.php">Sair</a></li>

        </ul>
    </nav>
 <!---------------------------------------------------------------------------------------------------------------------->
 <div class="title">
    
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16" style="margin-left:519px;">
        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
    </svg>

    <h1 class="cadastro_var">Cadastro Produto Variados</h1>
</div>
<div class="cadastro_produto">
    <form method="post">
        <label>Nome</label>
        <input type="text"  name="nome" placeholder="PRODUTO" required>
        <br>
        <label>Categoria</label>
        <select class="form-select" name="categoria"  style="font-size:13px" required > 
        <option value="" >SELECIONE</option> 
        <?php
      while($user_data = mysqli_fetch_assoc($result)){
                        
        echo "<option>" . $user_data['tipo']."</option>";
      }
      ?>
        </select>
        <br>
        <label>Quantidade</label>
        <input type="number"  name="quantidade" required placeholder="QUANTIDADE">
        <br>
        <label>Preço</label>
        <input type="number"  name="preco" step="0.01" required placeholder="PREÇO" >
        <br> 
        <label>Fornecedor</label>
        <input type="text" name="fornecedor" step="0.01" required placeholder="FORNECEDOR">
        <br>
        <label>Marca</label>
        <input type="text" name="marca" step="0.01" required placeholder="MARCA">
        <br>
      
      <input type="submit" value="Adicionar" class="add" name="add">
    </form>
</div>

</body>
</html>