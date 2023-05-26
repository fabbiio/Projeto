<?php
    //$dados = $_FILES['arquivo'];
    //var_dump($dados);

    if(!empty($_FILES['arquivo']['tmp_name'])){
        $arquivo = new DOMDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);
        
        $linhas = $arquivo->getElementsByTagName("Row");
        //var_dump($linhas);

        foreach($linhas as $linha){
            $id = $linha->getElementsByTagName("Data")->Item(0)-> nodeValue;
            echo "$id <br>";
        }

        foreach($linhas as $linha){
            $nome = $linha->getElementsByTagName("Data")->Item(1)-> nodeValue;
            echo "$nome <br>";
        }
        foreach($linhas as $linha){
            $tipo = $linha->getElementsByTagName("Data")->Item(2)-> nodeValue;
            echo "$tipo <br>";
        }

    }

?>