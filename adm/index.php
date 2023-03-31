<?php
    session_start();
    require_once('../config/conexao.php');
    

    if(!isset($_SESSION['login'])){
        header('Location: ./Login_v1/login.php');
    }
    $_SESSION['id_usuario'];
    $id_usuario = $_SESSION['id_usuario']; 
    

    if(!empty($_GET['search']) or $_GET)
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM produtos_cadastrados WHERE  (ID_Produto LIKE '%$data%' or nome LIKE '%$data%' or Usuario LIKE '%$data%' or tipo like '%$data%' or marca LIKE '%$data%')";
    }
    else{
        $sql = "SELECT * FROM produtos_cadastrados"; # instrucao sql (consulta no formato texto)
        
    }
    $result = $conn->query($sql);
   
?>


<!----------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="../Css/styleestoque.css">
    
<body >
<div class="dropdown">
            <button class="mainmenubtn">Menu</button>
            <div class="dropdown-child">
                <a href="../Usuario/editar.php?id=<?php echo $id_usuario?>">Meu Perfil</a>
                <a href="#">Configurações</a>
                <a href="../Login_v1/login.php">Sair</a>
                
                
            </div>
        </div>
    <header>
        <h1 class="titulo">Meu Estoque</h1>
        <!-------------------------------------------------------->
      
            
        <!-------------------------------------------------------->
        <h1 >
           <a href="#" class="usuario"> 
                <?php echo $_SESSION['usuario'];?>
           </a>
        </h1>      
    </header>    
    <nav>
        <ul>
            
            <li><a href="../config/importar.php">Importar</a></li>
            <li><a href="../config/gerar_planilha.php">Exportar</a></li>                      
                      
        </ul>
    </nav>
    <div>
        <table class="tabela">      
        <?php
            if($result->num_rows <= 0)
            {
                $te= "Estoque Vazio";             
            }
            else
            {
                $te = "Itens Disponiveis";
            }     
        ?>
        </div>
        <div class="pesquisa">
            <input type="search" class='form-control' placeholder="Pesquisar" id="pesquisar" >
            <button onclick="searchData()" class="pes">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>    
        </div>
        <br><br>
        <div>
            <h1 style="color:dodgerblue; "><?php echo $te ?></h1>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>  
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço Und.</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Valor Total</th>
                    <th class="espaco"></th>
                   
                    
                </tr >
            </thead>
            <tbody >
                <?php
                    $total1 = 0;
                    $total2 = 0;
                    $total3 = 0;
                    
                    while($user_data = mysqli_fetch_assoc($result)){
                        
                        $total1 += $user_data['quantidade'];
                        $total2 += $user_data['preco'] ;
                        $total3 += $user_data['preco'] * $user_data['quantidade'];
                        

                        echo "<tr>";
                        echo "<td>" . $user_data['ID_Produto'] . "</td>";
                        echo "<td>" . $user_data['nome'] . "</td>";              
                        echo "<td>" . $user_data['quantidade'] . "</td>";                     
                        echo "<td>R$ " . number_format($user_data['preco'],2,",",".") . "</td>";
                        echo "<td> " . $user_data['marca'] ."</td>";
                        echo "<td>" . $user_data ['tipo'] . "</td>" ; 
                        echo "<td>" . $user_data ['Usuario'] . "</td>" ;       
                        echo "<td>R$". number_format($user_data['Preco_Total'],2,",",".") ."</td>";
                        echo "<td> 

                        <a class='btn btn-sm btn-primary' href='atualizar.php?id=$user_data[ID_Produto]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16' id='a'>
                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                    
                        </a>
                
                        <a class='btn btn-sm btn-danger' href='deletar.php?id=$user_data[ID_Produto]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16' id='d'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                      </td>";
                        echo"<tr>"; 
                       
                    };   
                ?>
               
                <tr >                 
                   <td colspan="2" style="background-color:darkblue;color:white">Total</td> 
                   <td style="background-color:darkblue;color:white"><?php echo $total1;?></td>
                   <td style="background-color:darkblue;color:white">R$ <?php echo number_format($total2,2,",",".");?></td>
                   <td style="background-color:darkblue;color:white"></td>
                   <td colspan="2" style="background-color:darkblue;color:white"></td> 
                   <td style="background-color:darkblue;color:white">R$ <?php echo number_format($total3,2,",",".");?></td>
                   <td style="background-color:darkblue;color:white"></td>
                </tr>
               
                
                </table>
            </tbody> 
    </div>
    
    <br><br>
    <footer>
        <p> Todos os direitos reservados. </p>
    </footer>
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
        window.location = 'index.php?search='+search.value;
    }
</script>
</html>







