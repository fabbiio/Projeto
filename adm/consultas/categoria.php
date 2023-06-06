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
    $sql = "SELECT * FROM categoria WHERE  (id LIKE '%$data%' or tipo LIKE '%$data%')";
   }
else{
    $sql = "SELECT * FROM categoria";     
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
    <title>Consulta Categoria</title>
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


        <table class="tabela">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Categoria</th> 
            <th> </th> 
            
            
           
                 
            
        </tr >
        <tbody >
                <?php
                    
    
                    while($user_data = mysqli_fetch_assoc($result)){
                       
                        echo "<tr>";
                        echo "<td>" . $user_data['id'] . "</td>";
                        echo "<td>" . $user_data['tipo'] . "</td>";              
                        echo "<td> 

                
                        <a class='btn btn-sm btn-danger' href='deletar.php?cod=$user_data[id]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16' id='d'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                      </td>";
                        
                        
                        
                        echo"</tr>"; 
                        
                    };   
                ?>

                
        </tbody>       
        
    </table>
    </body>
<script>//Java script da parte de filtrar 
   var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event){
        if(event.key === "Enter")
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'categoria.php?search='+search.value;
    }
</script>
</html>