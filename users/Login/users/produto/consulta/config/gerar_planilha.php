<?php
    session_start();
    include_once('../../../../config/conexao.php');
    if(!isset($_SESSION['login'])){
        header('Location: ../../../Login/login.php');
    }
    $_SESSION['id_usuario'];
    $id_usuario = $_SESSION['id_usuario']; 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Contato</title>
    </head>
    <body>
        <?php
            include_once('../../../../config/conexao.php');    

            $arquivo = 'tabela_estoque.xls';
            $sql = "SELECT * FROM produto WHERE id_usuario ='$id_usuario'";
            $result = $conn->query($sql);
            
            $total1 = 0;
            $total2 = 0;
            $total3 = 0;

            //Titulo Tabela
            $html='';
            $html .= '<table border="1">';
            $html .= '<tr>';
            $html .= '<td colspan="7">Quantidade no Estoque</td>'; 
            $html .= '</tr>'; 
            
            //Nome das colunas
            $html .= '<tr>';
            $html .= '<td><b>ID</b></td>';
            $html .= '<td><b>Nome</b></td>';
            $html .= '<td><b>Tipo</b></td>';
            $html .= '<td><b>Categoria</b></td>';
            $html .= '<td><b>Quantidade</b></td>';
            $html .= '<td><b>Preço Unid</b></td>';
            $html .= '<td><b>Fornecedor</b></td>';
            $html .= '<td><b>Marca</b></td>';
            $html .= '<td><b>Validade</b></td>';
            $html .= '<td><b>Valor Total</b></td>';
            $html .= '<tr>';
            

            while($user_data= mysqli_fetch_assoc($result)){
                $somit = $user_data['preco'] * $user_data['quantidade'];
                $total1 += $user_data['quantidade'];
                $total2 += $user_data['preco'] ;
                $total3 += $user_data['preco'] * $user_data['quantidade'];

                $html .= '<tr>';
                $html .= '<td>'.$user_data["id"].'</td>';
                $html .= '<td>'.$user_data["nome"].'</td>';
                $html .= '<td>'.$user_data["tipo"].'</td>';
                $html .= '<td>'.$user_data["categoria"].'</td>';
                $html .= '<td>'.$user_data["quantidade"].'</td>';
                $html .= '<td>'.$user_data["preco"].'</td>';
                $html .= '<td>'.$user_data["fornecedor"].'</td>';
                $html .= '<td>'.$user_data["marca"].'</td>';
                $html .= '<td>'.$user_data["data_validade"].'</td>';
                $html .= '<td>'.$somit .'</td>';
                $html .= '</tr>'; 
            }
            $html .= '<tr>';
            $html .= '<td colspan="4"><b>Total</b></td>';
            $html .= '<td>' .$total1 .'</td>';
            $html .= '<td>' .$total2 .'</td>';
            $html .= '<td> </td>';
            $html .= '<td> </td>';
            $html .= '<td> </td>';
            $html .= '<td>'.$total3 .'</td>';
            $html .= '</tr>'; 
           

            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/x-msexcel");
            header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
            header ("Content-Description: PHP Generated Data" );
            // Envia o conteúdo do arquivo
            echo $html;
        ?>
    </body>
</html>