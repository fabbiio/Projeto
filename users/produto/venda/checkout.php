<?php 
    ini_set('display_errors',1);
    ini_set('display_startup.erros',1);
    error_reporting(E_ALL);
    require_once('../../../config.php');
    require_once('../../../config/conexao.php');
    if(!isset($_SESSION)){
        session_start();
    }

    //var_dump($_SESSION['carrinho']);

    foreach ($_SESSION['carrinho'] as $value)
        {
            $id_usuario = $_SESSION['id_usuario'];
            
            $id_produto = $value['id']; 
            
            $quantidade = $value['qtd'];
            
            $sql = "SELECT * from carrinho where id = $id_produto";
            $result_pro = $conn->query($sql);
            foreach ( $result_pro as $obj => $view){
                $valor = $view['preco'];
                $nome = $view['nome'];
            }
            $total = $valor;
            
            date_default_timezone_set('America/Sao_Paulo');
            $data_saida = date("Y-m-d H:i:s");
           
            
            $sql = "INSERT INTO vendas values (Null,'$id_usuario', '$id_produto','$nome', '$quantidade', '$total', '$data_saida')";
            $add = $conn->query($sql);
        }  
        unset( $_SESSION['carrinho']);
        header('Location: carrinho.php ');
?>