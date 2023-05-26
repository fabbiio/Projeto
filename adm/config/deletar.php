<?php

ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);

    include("../../config/conexao.php");
    require_once('../../config.php'); 
   
    if(!empty($_GET['id'])){ # Pegando os valores

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM categoria where id=$id";
        $result = $conn->query($sqlSelect);

        if($result->num_rows > 0){

            $sqlDelete = "DELETE FROM categoria WHERE id=$id";
            $resultDelete = $conn->query($sqlDelete);
            header('Location:' .BASEURL.'adm/cadastrar/categoria.php');
            }
        }
    
    