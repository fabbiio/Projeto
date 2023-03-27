<?php
require_once('./Classes/Conexao.php');
require_once('./Classes/Select.php');
$usu = new Usuarios();
$dados = $usu->select();
var_dump( $dados );
?>