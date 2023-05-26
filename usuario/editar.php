<?php



session_start();
    if(!isset($_SESSION['login'])){#Se nao existir a secao login 
        header('Location: ../Login_v1/login.php');
    }

    if(isset($_POST['nome']) and !empty(isset($_POST['nome']))){
        $id_post = $_POST['id'];
        $nome_post = $_POST['nome'];
       
        $senha_post = $_POST['senha'];
        $cidade_post = $_POST['cidade'];

        require_once('../config/conexao.php');
        $sql = "UPDATE usuario set nome='$nome_post', senha='$senha_post', cidade='$cidade_post' where id=$id_post";
        $result = $conn->query($sql);
        header('Location: ../index.php');
    }

?>
<html lang="pt-br">
    <head>
        <title>Editar Usuario</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    </head>
    <body>
    <div>
        <h1>Cadastro USuario</h1>
    </div>
    <?php
    require_once('../config/conexao.php');

    $sql = "SELECT * FROM usuario where id=". $_GET['id'];
    $exec = $conn->query($sql);
    
    if($exec->num_rows > 0){
        while($linhas = $exec->fetch_object()){
            $id_usuario =$linhas->id;
            $nome = $linhas->nome;
            $email = $linhas->email;
            $senha = $linhas->senha;
            $cidade = $linhas->cidade;
        }
    }
    
?>
    <div   style="border: solid , none; padding:10px" >
        <form class="row g-3" method="post">
        <div class="col-md-6">
            
            <label for="inputAddress2" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome"value="<?php echo $nome?>">
        </div>
           
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="text" class="form-control" id="senha" name="senha" value="<?php echo $senha?>">
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
        </div>
            
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $cidade?>">
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">State</label>
            <select id="inputState" class="form-select">
            <option selected>Choose...</option>
            <option>...</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="text" class="form-control" id="inputZip">
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
            </div>
        </div>
        <div class="col-12">
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"> 
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="excluir.php?id=<?php echo $id_usuario?>" class="btn btn-danger">Excluir</a>
            <a href="../index.php" class="btn btn-success">Voltar</a>
            
        </div>
        </form>
    </div>
    </body>
</html>