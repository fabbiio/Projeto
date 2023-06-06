<?php

session_start();
require_once('../../config.php'); 
require_once( ABSPATH . 'config/conexao.php');
//require_once('../config/config_adm.php');


if(!isset($_SESSION['login'])){
    header('Location: ./Login_v1/login.php');
}

    $_SESSION['id_usuario'];
    $id_usuario = $_SESSION['id_usuario']; 


if(isset($_POST['tipo']) and !empty($_POST['tipo'])){

    
    $tipo = strtoupper($_POST['tipo']);

    $sql = "SELECT * FROM categoria";
    $result = $conn->query($sql);
    
    $exis = 0;
    if($result->num_rows >= 0){
        while($data = mysqli_fetch_assoc($result)){
            $tipo2 = $data['tipo'];
            if($tipo == $tipo2){
                $exis = 1;
                break;               
            }
            else{
                $exis = 2;
            }
        }

    if($exis == 1){
        echo "Ja existe";
        }

    else{
        $sql = "INSERT INTO categoria values (NULL, '$tipo')";
        $exec = $conn->query($sql);
        echo "inserido";              
        }
    }
   
}
?>
<!----------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Categoria</title>
    <link rel="stylesheet" href="../../css/style.css">
    
</head>
<body>
    <div class="topo">
        <ul>
            <h1>Portal Administrador</h1>
        </ul>
    </div>
<!---------------------------------------------------------------------------------------------------------------------->
    <nav class="menu">
            <ul class="opcoes">
                <li><a href="../index.php">Home</a></li>
                <li>
                    <a href="#">Cadastrar</a>
                    <ul class="cadastrar">
                        <li><a href="usuarios.php">Usuarios</a> </li>  
                        <li><a href="categoria.php">Categorias</a> </li> 
                    </ul>
                </li>

                <li ><a href="#" >Consulta</a>
                    <ul class="cadastrar">
                        <li><a href="../consultas/estoque.php"> Estoque</a></li>
                        <li><a href="../consultas/usuarios.php"> Usuarios</a></li>
                        <li><a href="../consultas/categoria.php"> Categorias</a></li>
                        
                    </ul>
                </li>
                
                <li><a href="../../adm/login/index.php">Sair</a></li>

            </ul>
        </nav>
 <!---------------------------------------------------------------------------------------------------------------------->
        <div class="title">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="margin-left:620px;">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <h1 class="home">Adicionar Categoria</h1>
        </div>
<!--------------------------------------------------------------------------------------->
  
    
    
    <div class="divisao3">
        <form method="post">
            <div class="pesquisa">
                    <input type="text" class='adicionar' name="tipo" placeholder="Adicionar">
                        <button type="submit" class="pes">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                    </button>
                
            </div>
        </form>
    </div>
    
    <div>
        <table class="tabela">
            <tr>
                <th>#</th>
                <th>Tipo</th>
                
            </tr>
            <tbody >

            <?php
                $sql = "SELECT * FROM categoria";
                $exec = $conn->query($sql);

                while($tipo = mysqli_fetch_assoc($exec)){

                    
                    echo "<tr>";
                        echo "<td>" . $tipo['id'] . "</td>";
                        echo "<td>" . $tipo['tipo'] . "</td>";
                       
                    echo "</tr>";

                }
            ?>
            <tbody >
        </table>
    </div>


</html>