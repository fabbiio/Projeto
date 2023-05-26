<?php
ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);

session_start();
require_once('config.php'); 
require_once('config/conexao.php');
include ('global.php');

if(!isset($_SESSION['login'])){
     header('Location: '.BASEURL.'users/Login/login.php');
 }
    $_SESSION['id_usuario'];
    $id_usuario = $_SESSION['id_usuario']; 
    $usuario = $_SESSION['usuario'];
    
    
    $sql = "SELECT * FROM produto WHERE id_usuario ='$id_usuario'"; # instrucao sql (consulta no formato texto)
    $result = $conn->query($sql);


    $sql = "SELECT caminho_imagem as caminho FROM usuario WHERE id ='$id_usuario'"; # instrucao sql (consulta no formato texto)
    $img = $conn->query($sql);
    
    $total1 = 0;
    $total2 = 0;
    $total3 = 0;
                    
    while($user_data = mysqli_fetch_assoc($result)){
        $somit = $user_data['preco'] * $user_data['quantidade'];
        $total1 += $user_data['quantidade'];
        $total2 += $user_data['preco'] ;
        $total3 += $user_data['preco'] * $user_data['quantidade'];
        $data = date('d/m/Y',strtotime($user_data['data_validade']));
        $for = $user_data['fornecedor'];
    }
    
    $var = "SELECT COUNT(id) tot FROM `produto` WHERE id_usuario = '$id_usuario'";
    $exec = $conn->query($var);
    while($valor = $exec->fetch_object()){
        $quantidade=  $valor->tot;
    }
    
/******************************************************************************* */
$for = "SELECT fornecedor, COUNT(id) as Total FROM `produto` WHERE id_usuario = '$id_usuario' GROUP by fornecedor";
    $pizza = $conn->query($for);

    $tot = $pizza->num_rows;

    $dadospizza1 ="['Fornecedor', 'Total'],";
    while($pizzafornecedor = $pizza->fetch_object()){
        $dadospizza1 .= "['{$pizzafornecedor->fornecedor}', {$pizzafornecedor->Total}],";

    }
        $dadospizza1 = rtrim($dadospizza1,",");

/****************************************************************************************************************** */

#Tabela de Ultimos Cadastrados

$sql = "SELECT * from ultimos_cadastros where id_usuario = '$id_usuario' ORDER by status_cadastro desc limit 5 ";
$tab = $conn->query($sql);
    

?>



<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="<?php echo BASEURL?>css/style.css">
    <link rel="stylesheet" href="<?php echo BASEURL?>bootstrap-5.3.0/css/bootstrap-grid.css">
</head>
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

<!--------------------------------------------------------Menu-------------------------------------------------------------->
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
            <li><a href="#">Usuario</a>
                <ul class="cadastrar">
                        <li><a href="<?php echo BASEURL?>users/usuario/usuario.php"> Editar</a></li>
                        <li><a href="#"> Excluir</a></li>
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
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="icon" viewBox="0 0 16 16">
            <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/> 
        </svg>
        <h1 class="home">Pagina Inicial</h1>
    </div>
        
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">
                    <?php
                        echo $total1 ;  
                    ?>
                </div>
                <div class="cardName">Estoque Total</div>
            </div>

            <div class="iconBx">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
            </div>
        </div>
    
            
        <div class="card">
            <div>
                <div class="numbers"><?php echo $quantidade ?></div>
                <div class="cardName">Variedades</div>
            </div>
            <div class="iconBx">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                    <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                </svg>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"><?php echo $tot ?></div>
                <div class="cardName">Fornecedores</div>
            </div>
            <div class="iconBx">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"> 
                    <?php
                        echo  "R$" . number_format($total3,2,",",".") ;
                    ?>
                </div>
                <div class="cardName">Valor Estoque</div>
            </div>
            <div class="iconBx">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                </svg>
            </div>
        </div>

    </div>
   
    <br><br>

    <!-----------------------------------------------Tabela----------------------------------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-12">

                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Ultimos Cadastrados</h2>
                            <a href="<?php echo BASEURL?>users/produto/consulta/produtos.php" class="btn">Ver Todos</a>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nome</td>
                                    <td>Valor</td>  
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $cont = 0 ;
                                    while($arq = mysqli_fetch_assoc($tab)){
                                        $cont = $cont + 1;
                                        echo "<tr>";
                                        echo "<td>" . $cont ."º" . "</td>";
                                        echo "<td>" . $arq['nome'] . "</td>";
                                        echo "<td>R$ " . number_format($arq['preco'],2,",",".") . "</td>";
                                        echo "<tr>";
                                    }
                                ?>
                                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <!------------------------------------------------Graficos-------------------------------------------------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 ">
                <div id="piechart" style="width: 100%; height: 350px; " ></div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 ">
                <div id="chart_div" style="width: 100%; height: 350px;  "></div>
            </div>
        </div>
    </div>

</body>
</html>
<!-------------------------------------------------------Pizza----------------------------------------------------------------------------------------------->
<?php

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          <?php echo $dadospizza1;?>
        ]);

        var options = {
          title: 'Fornecedores'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>





<!-----------------------------------------------------------Grafico de Coluna-------------------------------------------------------------------------------------------------->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">




      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            <?php echo $dadospizza1;?>
        ]);

        var options = {
          title : 'Distribuidores',
          vAxis: {title: 'Produtos Fornecidos'},
          hAxis: {title: 'Fornecedores'},
          seriesType: 'bars',
          colors: ['gray'],
          series: {5: {type: 'line'}}
          
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    <script>
        $(document).ready(function(){
        setInterval(function(){cache_clear()},3000);
        });
        function cache_clear()
        {
        window.location.reload(true);
        }
    </script>


</html>