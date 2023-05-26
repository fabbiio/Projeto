<?php
    require_once('../../config.php'); 
    require_once( ABSPATH . 'config/conexao.php');
    

    if(isset($_SESSION['id_usuario'])){
        $sql = "SELECT * FROM administrador where id='{$_SESSION['id_usuario']}'";
		$exec = $conn->query($sql);
		if($exec->num_rows > 0){
			while($linhas = $exec->fetch_object()){
				$_SESSION['usuario'] = $linhas->nome;
			}
        }
    }

