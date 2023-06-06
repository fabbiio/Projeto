
<?php
 
 session_start();
 require_once('../../../config.php');
 require_once('../../../config/conexao.php');
 

 if(!isset($_SESSION['login'])){
     header('Location: ../../Login/login.php');
 }
     $_SESSION['id_usuario'];
     $id_usuario = $_SESSION['id_usuario']; 
     $usuario = $_SESSION['usuario'];
 
     $sql = "SELECT caminho_imagem as caminho FROM usuario WHERE id ='$id_usuario'"; # instrucao sql (consulta no formato texto)
     $img = $conn->query($sql);
     
 if(!empty($_GET['search']) or $_GET)
 {
     $data = $_GET['search'];
     $sql = "SELECT * FROM produto WHERE  (id LIKE '%$data%' or nome LIKE '%$data%' or tipo LIKE '%$data%'or categoria LIKE '%$data%' or fornecedor LIKE '%$data%'  or marca LIKE '%$data%' or data_validade LIKE '%$data%') and  id_usuario ='$id_usuario'";
 }
 else{
     $sql = "SELECT * FROM produto WHERE id_usuario ='$id_usuario'"; # instrucao sql (consulta no formato texto)
     
 }
 $result = $conn->query($sql);

?>

<!----------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Estoque</title>
        <link rel="stylesheet" href="../../../css/style.css">

        <!--------------------------------------------------------------------------------------------------------------------------->
        
    <!--------------------------------------------------------------------------------------------------------------------------->  
    </head>
<body class="Arquivo">
    <div class="topo">
        <ul>
            <h1>Controle de Estoque</h1>
            <?php
                if (mysqli_num_rows($img) > 0){
                    foreach ( $img as $obg ){
                        ?>
                        <img class="img" src="<?php echo BASEURL . "usuario/". $obg['caminho'];?>">
                        <?php
                    }
                }else{
                    echo "<img class='img' src='usuario/img/person.png'> alt='Sem Foto'";
                    
                }
            ?>
            <h1 class="nome"><?php echo $usuario ?></h1>
        </ul>
    </div>

    <!---------------------------------------------------------------------------------------------------------------------->
    <nav class="menu">
        <ul class="opcoes">
            <li><a href="<?php echo BASEURL?>">Home</a></li>
            <li>
                <a href="#">Cadastrar</a>
                <ul class="cadastrar">
                    <li><a href="<?php echo BASEURL?>users/produto/cadastro/cadastro_variados.php">Variados</a> </li>  
                    <li><a href="<?php echo BASEURL?>users/produto/cadastro/cadastro_perecivel.php">Pereciveis</a> </li> 
                </ul>
            </li>

            <li ><a href="#" >Estoque</a>
                <ul class="cadastrar">
                    <li><a href="<?php echo BASEURL?>users/produto/consulta/produtos.php"> Consultar</a></li>
                    <li><a href="<?php echo BASEURL?>users/produto/consulta/editar.php"> Editar</a></li>
                   
                    
                </ul>
            </li>
            
            <li><a href="#">Vendas</a>
                <ul class="cadastrar">
                    <li><a href="<?php echo BASEURL?>users/produto/venda/vender.php"> Vender</a></li>
                    <li><a href="<?php echo BASEURL?>users/produto/venda/carrinho.php">Meu Carrinho</a></li>
                </ul>
            </li>
            <li><a href="<?php echo BASEURL?>users/Login/login.php">Sair</a></li>

        </ul>
    </nav>
    <!---------------------------------------------------------------------------------------------------------------------->
        <div class="title">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="margin-left:620px;">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <h1 class="home">Editar Estoque</h1>
        </div>
    <!--------------------------------------------------------------------------------------------------------------------->    
        
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
    <!--------------------------------------------------------------------------------------------------------------------------------->
    <div class="divisao1" >
        <?php
            if($result->num_rows <= 0)
            {
                $te= "Estoque Vazio";             
            }
            else
            {
                $te = "Produtos Disponiveis";
            }     
            ?>

            <h1><?php echo $te ?></h1>
    </div>

    <div class="oi">
        <h1> <br></h1>
    </div>

    <table class="tabela">
        <tr>
        <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Tipo</th>
            <th scope="col">Categoria</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço Und.</th>
            <th scope="col">Fornecedor</th>
            <th scope="col">Marca</th>
            <th scope="col">Validade</th>
            <th></th>
            
            
            
        </tr >
        <tbody >
            <?php				
                $total1 = 0;
                $total2 = 0;
                $total3 = 0;
                    
                while($user_data = mysqli_fetch_assoc($result)){
                    $somit = $user_data['preco'] * $user_data['quantidade'];
                    $total1 += $user_data['quantidade'];
                    $total2 += $user_data['preco'] ;
                    $total3 += $user_data['preco'] * $user_data['quantidade'];
                    $data = date('d/m/Y',strtotime($user_data['data_validade']));

                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . $user_data['nome'] . "</td>"; 
                    echo "<td>" . $user_data ['tipo'] . "</td>" ; 
                    echo "<td>" . $user_data ['categoria'] . "</td>" ;                      
                    echo "<td>" . $user_data['quantidade'] . "</td>";                     
                    echo "<td>R$ " . number_format($user_data['preco'],2,",",".") . "</td>";
                    echo "<td>" . $user_data ['fornecedor'] . "</td>" ;     
                    echo "<td> " . $user_data['marca'] ."</td>";
                    echo "<td>" . $data . "</td>" ;  
                    echo "<td> 

                                <a class='btn btn-sm btn-primary' href='../editar/atualizar.php?id=$user_data[id]' title='Editar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16' id='a'>
                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            
                                </a>
                        
                                <a class='btn btn-sm btn-danger' href='../editar/deletar.php?id=$user_data[id] '>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16' id='d'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                </a>
                    
                               
                                
                              </td>";

                      
                   
                   
                    };   
                ?>
                
                      
        </tbody>    
    </table>
</body>
<!------------------------------------------------------------------------------------------------------------------------------------------->
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
         window.location = 'produtos.php?search='+search.value;
     }
 </script>
</html>