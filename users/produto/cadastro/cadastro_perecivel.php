
<?php


ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);

  session_start();
  require_once('../../../config.php');
  require_once('../../../config/conexao.php');


  if(!isset($_SESSION['login'])){
    header('Location: '.BASEURL.'users/Login/login.php');
    }

   $_SESSION['id_usuario'];
   $id_usuario = $_SESSION['id_usuario']; 
   $usuario = $_SESSION['usuario'];

    $sql = "SELECT caminho_imagem as caminho FROM usuario WHERE id ='$id_usuario'"; # instrucao sql (consulta no formato texto)
    $img = $conn->query($sql);

  $sql = "SELECT * FROM categoria"; 
  $result = $conn->query($sql);

 

  if(isset($_POST['nome']) and !empty($_POST['nome'])){
    
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $marca = $_POST['marca'];
    $fornecedor = $_POST['fornecedor'];
    $id_usuario = $_SESSION['id_usuario']; 
    $validade = $_POST['validade'];
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
        
        $sql = "INSERT INTO produto values (NULL, '$nome','PERECIVEL','$categoria','$quantidade', '$preco', '$fornecedor','$marca', '$validade',now(),'$id_usuario')"; # Comando sql (varchar tem que ter aspas simples)
        $exec = $conn->query($sql); 
        

        $sql = "SELECT id FROM produto where nome = '$nome' and  id_usuario = '$id_usuario'"; 
        $id = $conn->query($sql);

        while($user_data = mysqli_fetch_assoc($id)){

            $id_produto = $user_data['id'];
        }

            $sql = "INSERT INTO imagens values (NULL, '$nomefotoenviada', '$path', '$id_usuario', '$id_produto')"; 
            $exec = $conn->query($sql); #realizando consulta
            header('Location: cadastro_perecivel?=');//
            
        }
            
    }


    

    

    
?>


<!------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pereciveis</title>
    <link rel="stylesheet" href="../../../css/style.css">

    <!--------------------------------------------------------------------------------------------------------------------------->
    
  <!--------------------------------------------------------------------------------------------------------------------------->  
</head>
<body>
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
    
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16" style="margin-left:530px;">
        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
    </svg>

    <h1 class="cadastro_var">Cadastro Produto Pereciveis</h1>
</div>
<div class="cadastro_produto">
    <form method="post"  enctype="multipart/form-data">

        <label>Nome</label>
        <input type="text"  name="nome" placeholder="PRODUTO" maxlength="45" required>
        <br>
        <label>Categoria</label>
        <select class="form-select" name="categoria"  style="font-size:13px" required >
        <option value="">SELECIONE</option>  
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
        <label>Data Validade</label>
        <input type="date"  name="validade" required placeholder="QUANTIDADE">
        <br>
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
        <label for=""  >Insira a Imagem</label>
        <input type="file" name='imagem'>
        <br>
        <br>
        <br>
      
      <input type="submit" value="Adicionar" class="add" name="add">
    </form>
</div>

</body>
</html>