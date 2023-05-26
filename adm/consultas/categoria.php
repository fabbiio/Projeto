<?php
 
session_start();
require_once('../../config.php'); 
require_once( ABSPATH . 'config/conexao.php');
   
if(!isset($_SESSION['login'])){
    header('Location: login/');
   }

   
$_SESSION['id_usuario'];
$id_usuario = $_SESSION['id_usuario']; 
   

if(!empty($_GET['search']) or $_GET)
   {
    $data = $_GET['search'];
    $sql = "SELECT * FROM produtos_cadastrados WHERE  (ID_Produto LIKE '%$data%' or nome LIKE '%$data%' or Usuario LIKE '%$data%' or tipo like '%$data%' or marca LIKE '%$data%')";
   }
else{
    $sql = "SELECT * FROM produtos_cadastrados";     
   }
$result = $conn->query($sql);
  
?>



<!--------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="../../css/style.css">
    
</head>
<body>
    <div class="topo">
        <ul>
            <h1>Controle de Estoque</h1>
        </ul>
    </div>
<!---------------------------------------------------------------------------------------------------------------------->
    <nav class="menu">
            <ul class="opcoes">
                <li><a href="../../adm/index.php">Home</a></li>
                <li>
                    <a href="#">Cadastrar</a>
                    <ul class="cadastrar">
                        <li><a href="../cadastrar/usuarios.php">Usuarios</a> </li>  
                        <li><a href="../cadastrar/categoria.php">Categorias</a> </li> 
                    </ul>
                </li>

                <li ><a href="#" >Consulta</a>
                    <ul class="cadastrar">
                        <li><a href="estoque.php"> Estoque</a></li>
                        <li><a href="usuarios.php"> Usuarios</a></li>
                        <li><a href="categoria.php"> Categorias</a></li>
                        
                    </ul>
                </li>
                <li><a href="#">Usuario</a>
                    <ul class="cadastrar">
                            <li><a href="./users/usuario/usuario.php"> Editar</a></li>
                            <li><a href="#"> Excluir</a></li>
                        </ul>
            
                </li>
                <li><a href="#">Quem somos</a></li>
                <li><a href="../../adm/login/index.php">Sair</a></li>

            </ul>
        </nav>
 <!---------------------------------------------------------------------------------------------------------------------->
  
 <div class="title">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="margin-left:620px;">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <h1 class="home">Categorias</h1>
        </div>
    <!--------------------------------------------------------------------------------------------------------------------->    
        <div class="divisao12">
            <h1></h1>
        </div>
        <div>
            <ul class="divisao2">
                <li><a href="./config/importar.php">Importar</a></li>
                <li><a href="./config/gerar_planilha.php">Exportar</a></li> 
            </ul>
        </div>
    <!---------------------------------------------------------------------------------------------------------------------->
        <div class="divisao3">
            <div class="pesquisa">
                <input type="search" class='form-control' placeholder="Pesquisar" id="pesquisar" >
                <button onclick="searchData()" class="pes">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>    
            </div>
        </div>