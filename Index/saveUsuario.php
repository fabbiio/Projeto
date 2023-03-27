<?php
    include_once('conexao.php');

    if(isset($_POST['update'])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $email = $_POST['quantidade'];
        $telefone = $_POST['preco'];
        $sexo = $_POST['marca'];
        $data_nasc = 

        $sqlUpdate = "UPDATE produto SET nome='$nome', tipo='$tipo', quantidade='$quantidade', preco='$preco', marca='$marca'
        WHERE id='$id'";

        $result = $conn->query($sqlUpdate);

        header('Location: ../index.php');
    }
?>
