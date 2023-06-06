<?php
ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);

session_start();

require_once('../config.php'); 
require_once( ABSPATH . 'config/conexao.php');



   
if(!isset($_SESSION['login'])){
    header('Location: '.BASEURL.'adm/login/index.php');
   }

   
$_SESSION['id_usuario'];
$id_usuario = $_SESSION['id_usuario']; 
 

$sql = "SELECT * FROM produto WHERE id_usuario ='$id_usuario'"; # instrucao sql (consulta no formato texto)
$result = $conn->query($sql);


    
    
    $var = "SELECT COUNT(id) tot FROM `produto` WHERE id_usuario = '$id_usuario'";
    $exec = $conn->query($var);
    while($valor = $exec->fetch_object()){
        $quantidade=  $valor->tot;
    }

$for = "SELECT  * from  produtos_usuario ";
    $pizza = $conn->query($for);

    $tot = $pizza->num_rows;

    $dadospizza1 ="['nome_usuario', 'Quantidade'],";
    while($pizzafornecedor = $pizza->fetch_object()){
        $dadospizza1 .= "['{$pizzafornecedor->nome_usuario}', {$pizzafornecedor->quantidade}],";

    }
        $dadospizza1 = rtrim($dadospizza1,",");
  /********************************************************************************** */

    $qp = "SELECT COUNT(id) as qtd_produtos FROM produto";
    $produtos = $conn->query($qp);

    foreach($produtos as $topr){
        $total_produtos =  $topr['qtd_produtos'] ;

    }

    $qf = "SELECT fornecedor, COUNT(id) as total FROM produto  GROUP by fornecedor";
    $fornededor = $conn->query($qf);
    $linha = 0;
    foreach($fornededor as $topf){
        $total_fornecedor =  $topf['total'];
        $linha = $linha+1;
    }
    
    $sql = "SELECT * FROM produto "; # instrucao sql (consulta no formato texto)
    $result = $conn->query($sql);

    $total1 = 0;
    while($user_data = mysqli_fetch_assoc($result)){
        
        $total1 += $user_data['preco'] * $user_data['quantidade'];


    }

    $qu = "SELECT  COUNT(id) as total FROM usuario ";
    $usuarios = $conn->query($qu);
    
    foreach($usuarios as $totu){
        $total_usuarios =  $totu['total'];
       
    }

?>


<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="../css/style.css">

    <!--------------------------------------------------------------------------------------------------------------------------->
    
  <!--------------------------------------------------------------------------------------------------------------------------->  
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
            <li><a href="index.php">Home</a></li>
            <li>
                <a href="#">Cadastrar</a>
                <ul class="cadastrar">
                    <li><a href="./cadastrar/usuarios.php">Usuarios</a> </li>  
                    <li><a href="./cadastrar/categoria.php">Categorias</a> </li> 
                </ul>
            </li>

            <li ><a href="#" >Consulta</a>
                <ul class="cadastrar">
                    <li><a href="./consultas/estoque.php"> Estoque</a></li>
                    <li><a href="./consultas/usuarios.php"> Usuarios</a></li>
                    <li><a href="./consultas/categoria.php"> Categorias</a></li>
                    
                </ul>
            </li>
            
            <li><a href="../adm/login/index.php">Sair</a></li>

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
                        <div class="numbers"><?php echo $total_produtos?></div>
                        <div class="cardName">Estoque Total</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $linha;?></div>
                        <div class="cardName">Fornecedores</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php  echo  $total_usuarios; ?></div>
                        <div class="cardName">Usuarios </div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php  echo  "R$ " . number_format($total1,2,",",".")  ?></div>
                        <div class="cardName">Valor Estoque</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>


    <div class="pizza">
        <div id="piechart" style="width: 550px; height: 500px; margin-top: 0px; padding-right:30px; border: none; position:absolute" ></div>
        <div id="chart_div" style="width: 1000px; height: 350px;  padding-right:30px; border: none; position:absolute; margin-left:420px; margin-top:50px"></div>
        
        
    </div>
</body>
<!-------------------------------------------------------Pizza----------------------------------------------------------------------------------------------->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          <?php echo $dadospizza1;?>
        ]);

        var options = {
          title: 'Estoque Usuarios'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

<!---------------------------------------------------------Grafico Area------------------------------------------------------------------------------------------------------->



<!-----------------------------------------------------------Grafico de Combinacao-------------------------------------------------------------------------------------------------->
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
          title: 'Estoque Usuarios',
          vAxis: {title: 'Total Estoque'},
          hAxis: {title: 'Usuarios'},
          seriesType: 'bars',
          colors: ['dodgerblue'],
          series: {5: {type: 'line'}}

          
        };
        
        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>



</html>