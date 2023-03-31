<?php
    require_once("../config/conexao.php");
   
    if(!empty($_GET['id'])){ # Pegando os valores

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM produto where id=$id";
        $result = $conn->query($sqlSelect);

        if($result->num_rows > 0){
            while($user_data = mysqli_fetch_assoc($result)){
                $id = $user_data['id'];
                $nome = $user_data['nome'];
                $tipo = $user_data['tipo'];
                $quantidade = $user_data['quantidade'];
                $preco = $user_data['preco'];
                $marca = $user_data['marca'];
            }
        }

        else{
            header('Location: ../index.php');
        }
        
    }
?>


<!DOCTYPE html>
<html>
  <head>
    <title>>Atualizar de Estoque</title>
    
    <link rel="stylesheet" href="../Css/styleestoque.css">
    <link rel="stylesheet" href="../Css/styleusers.css">
    
  </head>
  <body style="background-color:white">
    <a href="../index.php" class="inicial">PAGINA INICIAL</a>
    <a href="../Login_v1/login.php" class="off">Logout</a>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <h1 style="color:blue">EDITAR</h1>

    <form action="saveEdit.php" method="post">
        <label for="">Produto:</label>
        <input type="text"  name="nome" value="<?php echo $nome?>" disabled>
        <br>
        <select class="form-select" name="tipo" style="font-size:13px" required >  
        <option value="">SELECIONE O TIPO</option>
        <option>ALIMENTO PERECIVEL</option>
        <option>ALIMENTO NÃO-PERECIVEL</option>
        <option>DOCUMENTOS</option>
        <option>ACESSÓRIOS</option>
        <option>ACESSÓRIOS PARA INFORMÁTICA</option>
        <option>ACESSÓRIOS PARA VEICULOS</option>
        <option>ADESIVOS</option>
        <option>ALUMINIO</option>
        <option>ALVENARIA</option>
        <option>AMOSTRA</option>
        <option>ANIMAIS VIVOS</option>
        <option>ANTENAS</option>
        <option>APARELHOS ELETRONICOS</option>
        <option>APOSTILAS</option>
        <option>CADERNOS</option>
        <option>ARTIGOS PARA CAES</option>
        <option>ARTIGOS PARA GATOS</option>
        <option>ARTIGOS PARA FESTAS</option>
        <option>AUTO PEÇAS</option>
        <option>BEBIDAS</option>
        <option>BRINQUEDOS</option>
        <option>COSMETICOS</option>
        <option>ELETRODOMESTICOS</option>
        <option>EQUIPAMENTOS ELETRONICOS</option>
        <option>EQUIPAMENTOS PARA INFORMÁTICA</option>
        <option>FERRAMENTAS</option>
        <option>MATERIAL DE LIMPEZA</option>
        <option>MATERIAL ESCOLAR</option>
        <option>ROUPAS</option>
        <option>OUTROS</option>
      </select>
      <br>
        <br>
        <label for="">Quantidade:</label>
        <input type="number"  name="quantidade" value="<?php echo $quantidade?>">
        <br>
        <label for="">Preço:</label>
        <input type="number" name="preco" step="0.01" value="<?php echo $preco?>">
        <br>
        <label for="">Marca:</label>
        <input type="text" name="marca" step="0.01" value="<?php echo $marca?>">
        <br>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="submit" value="Atualizar" class="att" name="update" id="update">    
    </form>
    
    <footer>
        <p> Todos os direitos reservados. </p>
    </footer>
  </body>
</html>

