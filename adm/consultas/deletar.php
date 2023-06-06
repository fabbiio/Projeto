<?php
ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);


    session_start();
    
    require_once('../../config.php');
    require_once("../../config/conexao.php");

    $id_usuario = $_SESSION['id_usuario']; 
   



    if(!empty($_GET['id'])){

        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM usuario where id=$id";
        $result = $conn->query($sqlSelect);
        
        if($result->num_rows > 0){

            $apaga_vendas = "DELETE FROM vendas WHERE id_usuario = $id";
            $apaga_imagens = "DELETE FROM imagens WHERE  id_usuario = $id";
            $apaga_produto = "DELETE FROM produto WHERE id_usuario=$id";
            $apaga = "DELETE FROM usuario WHERE id=$id ";
            
            
            $resultVendas = $conn->query($apaga_vendas);
            $resultDelete = $conn->query($apaga_imagens);
            $resultProduto= $conn->query($apaga_produto);
            $result= $conn->query($apaga);
           
            
            
            }
        header('Location: usuarios.php');
        }

    elseif(!empty($_GET['cod'])){

        $cod = $_GET['cod'];
        $sqlSelect2 = "SELECT * FROM categoria where id=$cod";
        $nresult = $conn->query($sqlSelect2);

        if($nresult->num_rows > 0){

            $apaga_categoria = "DELETE FROM categoria WHERE id = $cod";
            $result= $conn->query($apaga_categoria);

        }

        header('Location: categoria.php');

        }





        
  