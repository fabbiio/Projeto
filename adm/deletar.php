<?php
    include("../config/conexao.php");
   
    if(!empty($_GET['id'])){ # Pegando os valores

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM produto where id=$id";
        $result = $conn->query($sqlSelect);

        if($result->num_rows > 0){

            $sqlDelete = "DELETE FROM produto WHERE id=$id";
            $resultDelete = $conn->query($sqlDelete);
            }
        }
    header('Location: index.php');