<?php
    require_once('../config/conexao.php');
    if(isset($_GET['id']) and !empty($_GET['id'])){

        $id = $_GET['id'];

        echo $id;

        $sql = "DELETE  from administrador where id= $id"; 
        $exec = $conn->query($sql);
        header('Location: ../Login_v1/login.php');
    }

    

    
?>