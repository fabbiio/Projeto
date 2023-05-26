
<?php
ini_set('display_errors',1);
ini_set('display_startup.erros',1);
error_reporting(E_ALL);

    require_once('../../../config.php');
    require_once('../../../config/conexao.php');
    if(!isset($_SESSION)){
        session_start();
    }
    //unset( $_SESSION['carrinho']);
    $result = false; 
    $stock = 0;

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

    //unset($_SESSION['carrinho']);
    if(isset($_SESSION['carrinho']))
    {   
        sort($_SESSION['carrinho']);         
        $ids = "";
        
        if(isset($_GET['rem']))
        {   
            
            $id = $_GET['rem'];
            unset( $_SESSION['carrinho'][$id]);
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);  
            //$_SESSION['carrinho'] = sort($_SESSION['carrinho']);       
        }
        $valor = 0;
        
        foreach ($_SESSION['carrinho'] as $value)
        {
            $ids .= "'{$value['id']}',";  
            if(isset($ids)){
                $valor = 1;
                $stock = 1;                
            }              
        }            
        
        
        if($valor == 1){
            $ids = rtrim($ids,",");
            $sql = "SELECT * from carrinho where id in ($ids) order by id asc";
            $result = $conn->query($sql);
           
        }else{
            $result = false;
        }
        
      
    }    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    

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
        
            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16" style="margin-left: 610px;  ">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
            <h1 class="home">
                <?php
                    if($stock == 0){
                        echo "Carrinho Vazio";
                        $view['preco'] = 0;
                        $valor = 0;
                    }else{
                        echo "Meu Carrinho";
                    }
                ?> 
            </h1>  
    </div>
<!------------------------------------------------------------>
 
    <main class="main">
        <div class="page-title"></div>
        <div class="content">
            <section>
                <table class="venda">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                            $te = 0;

                            if($result == false){
                                $te = 0;
                            }else{
                                $te = 1;

                                $valor = 0;
                                foreach ( $result as $obj => $view){
                                    $valor = $view['preco'] + $valor;
                                    
                                    echo "<tr>";
                                        echo "<td>";
                                            echo "<div class='product'>";
                                            ?>
                                                <img class ="imgcarrinho" src="<?php echo BASEURL . "users/produto/cadastro/". $view['caminho'];?>">
                                                <div class="info">
                                                    <div class="name"><?php echo $view['nome']; ?></div>
                                                    <div class="category"><?php echo $view['categoria']; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo "R$ ".  number_format($view['preco'],2,",","."); ?></td>
                                      
                                        <td> 
                                            <div class="qty">
                                                <button onclick="menos_<?php echo $obj; ?>()"><i class='bx bx-minus'></i></button>
                                                <!--<button><i class='bx bx-minus'></i></button>-->
                                                <span id="valor_<?php echo $obj; ?>"> 1</span>
                                                <button onclick="mais_<?php echo $obj; ?>()"><i class='bx bx-plus'></i></box-icon></button>
                                                <!--<button ><i class='bx bx-plus'></i></box-icon></button>--->
                                            </div>
                                            
                                        </td>
                                        <td><?php echo "R$ ".  number_format($view['preco'],2,",","."); ?></td>
                                        <td>
                                            <a href="carrinho.php?rem=<?php echo $obj; ?>" class="remove"><button class="remove"><i class='bx bx-x'></i></button></a>
                                        </td>
                                    </tr>    
                                    <script>
                                        //VENDA

                                        function venda_<?php echo $obj; ?>(){
                                            console.log("ola")
                                            
                                        }

                                        //estado valor

                                        let numero_<?php echo $obj; ?> = 0

                                        //Alterador
                                        function mais_<?php echo $obj; ?>(){
                                            numero_<?php echo $obj; ?> ++  
                                            mostrar_<?php echo $obj; ?>()
                                        }    
                                        function menos_<?php echo $obj; ?>(){
                                            numero_<?php echo $obj; ?> --
                                            mostrar_<?php echo $obj; ?>()
                                        }

                                        //Jogar na tela value
                                        function mostrar_<?php echo $obj; ?>(){
                                            const valor_<?php echo $obj; ?> = document.querySelector("#valor_<?php echo $obj; ?>")//  ou document.getElementById("valor")
                                            valor_<?php echo $obj; ?>.innerText =numero_<?php echo $obj; ?>
                                        }
                                    

                                    </script>      
                                    <?php    
                                }   
                            }    
                        ?>
                        
                    </tbody>
                </table>
            </section>
            <aside class="finalizar">
                <div class="box">
                    <header>Resumo da Compra</header>
                    <div class="info">
                        <div><span>Sub-Total</span><span><?php echo "R$ ".number_format($valor,2,",",".") ;?></span></div>
                        <div><span>Frete</span><span>Gratuito</span></div>
                        <div><button class="cupom">Adicionar Cupom de Desconto<i class='bx bx-right-arrow-alt' ></i></button></div>
                    </div>
                    <footer>
                        <span>Total</span>
                        <span><?php echo "R$ ".number_format($valor,2,",",".") ;?></span>
                    </footer>
                </div>
              
                <a href="carrinho.php?car=" style="text-decoration:none"><button  class="ven">Finalizar Compra</button></a>
               
            </aside>
        </div>
    </main>
    

</body>
</html>

