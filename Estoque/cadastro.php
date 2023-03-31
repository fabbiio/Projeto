<?php
  session_start();
  require_once('../config/conexao.php');

  $sql_code_perecivel = "SELECT * FROM tipo_perecivel order by nome asc";
  $sql_perecivel = $conn->query($sql_code_perecivel);

  $sql_code_nperecivel = "SELECT * FROM tipo_perecivel order by nome asc";
  $sql_nperecivel = $conn->query($sql_code_nperecivel);



 

  if(isset($_POST['nome']) and !empty($_POST['nome'])){ # Pegando os valores
    
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $marca = $_POST['marca'];
    $id_usuario = $_SESSION['id_usuario']; 

    

    $sql = "INSERT INTO produto values (NULL, '$nome','$tipo','$quantidade', '$preco','$marca','$id_usuario')"; # Comando sql (varchar tem que ter aspas simples)
    $exec = $conn->query($sql); #realizando consulta
    header('Location: ../index.php');//
    }


  
?>
<!DOCTYPE html>
<html>
  <head>
    <title style="font-family:Arial, Helvetica, sans-serif">Adicionar no Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/styleestoque.css">
    <link rel="stylesheet" href="../Css/styleusers.css">
    
  </head>
  <body>
    <a href="../index.php" class="inicial">PAGINA INICIAL</a>
    <a href="../Login_v1/login.php" class="off">Logout</a>
    <div class="titulo">
      <h1 >Adicionar no Estoque</h1>
   
    
    <form action="" method="post" class="c">
      <label>Produto</label>

      <input type="text"  name="nome" placeholder="PRODUTO" required>
      <label>Tipo</label>
      
      <select class="form-select" name="tipo"  style="font-size:13px" required >  
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

  
      <label>Quantidade</label>
      <input type="number"  name="quantidade" required placeholder="QUANTIDADE">
      <br>
      <label>Preço</label>
      <input type="number"  name="preco" step="0.01" required placeholder="PREÇO" >
      <br> 
      <label>Marca</label>
      <input type="text" name="marca" step="0.01" required placeholder="MARCA">
      <br>
      
      <input type="submit" value="Adicionar" class="add" name="add">
      
    </form>
   <br>
    </div>
    <footer>
        <p> Todos os direitos reservados. </p>
    </footer>
  </body>
<script>
jQuery(function(){

  jQuery("div.add submit").click(function(){

      var dados = {};
          dados.add = jQuery(this).attr('name');

      jQuery.ajax({
          url  : 'salvardata.php',
          data : dados,
          type : 'post'
      });

  });

});
</script>
</html>

<?php


//if ( $_POST ){

 // $etapa = $_POST["etapa"];
 // $datahora = date("Y-m-d H:i:s");

  //echo $etapa;
 // echo $datahora;
  //Executar inserção dos dados no banco

//}

?>

