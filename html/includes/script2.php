<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprendendo novos Scripts</title>
</head>
<body>
    <?php
        if(isset($_POST['enviar-formulario'])){

            $formatosPermitidos = array("png", "jpeg", "jpg", "gif");
            $extencao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
            $novonome = uniqid().".$extencao";
            
            if(in_array($extencao, $formatosPermitidos)){
                $pasta = "arquivos/";
                $temporario = $_FILES['arquivo']['tmp_name'];

                if(move_uploaded_file($temporario, $pasta.$novonome)){
                    $mensagem = "Upload feito com sucesso";
                }else{
                    $mensagem = "Erro, não foi possivel fazer o upload!";
                }
            }else{
                $mensagem = "Formato Inválido";
            }
        }
        echo $mensagem;
    ?>

    <h3>Upload Arquivo</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="arquivo"><br>
    <input type="submit" name="enviar-formulario">
    </form>
</body>
</html>