<?php
    
    ini_set('display_errors',1);
    ini_set('display_startup.erros',1);
    error_reporting(E_ALL);
    require_once('../../../config.php');
    require_once('../../../config/conexao.php');

 

    if(isset($_POST['update'])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $categoria = $_POST['categoria'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        $marca = $_POST['marca'];
        $data = $_POST['validade'];
        $fornecedor = $_POST['fornecedor'];
        $validade = $_POST['validade'];
        echo $validade;

        $sqlUpdate = "UPDATE produto SET nome = '$nome', categoria='$categoria', quantidade='$quantidade', preco ='$preco', marca='$marca' , fornecedor = '$fornecedor', data_validade = '$validade'
        WHERE id='$id'";

        $result = $conn->query($sqlUpdate);

        header('Location:'.BASEURL.'users/produto/consulta/editar.php');
    }
?>
