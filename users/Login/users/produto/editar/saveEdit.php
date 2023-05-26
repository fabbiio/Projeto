<?php
    include_once('../config/conexao.php');

    if(isset($_POST['update'])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        $marca = $_POST['marca'];

        $sqlUpdate = "UPDATE produto SET tipo='$tipo', quantidade='$quantidade', preco='$preco', marca='$marca'
        WHERE id='$id'";

        $result = $conn->query($sqlUpdate);

        header('Location: ../index.php');
    }
?>
