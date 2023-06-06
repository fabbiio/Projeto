
<?php


ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);


    session_start();
    
    require_once('../../../config.php');
    require_once("../../../config/conexao.php");

    $id_usuario = $_SESSION['id_usuario']; 
   
    if(!empty($_GET['id'])){ # Pegando os valores

        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM produto where id=$id";
        $result = $conn->query($sqlSelect);
        
        if($result->num_rows > 0){
            $apaga_vendas = "DELETE FROM vendas WHERE id_produto=$id and id_usuario = $id_usuario";
            $apaga_imagens = "DELETE FROM imagens WHERE id_produto=$id and id_usuario = $id_usuario";
            $apaga_produto = "DELETE FROM produto WHERE id=$id";
            

            $resultVendas = $conn->query($apaga_vendas);
            $resultDelete = $conn->query($apaga_imagens);
            $result= $conn->query($apaga_produto);
            
            
            }
            
        }
?>

        <script type="text/javascript">
            alert("o cliente foi excluído");
        </script>
        <?php
    header('Location: ../consulta/editar.php?=');