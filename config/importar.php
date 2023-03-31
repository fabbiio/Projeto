<?php

?>
<html>
    <head>
        <title>Importar</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Importar</h1>
        <form method="post" action="processa.php" enctype="multipart/form-data">

            <label>Arquivo</label>

            <input type="file" name="arquivo"><br><br>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </body>
</html>