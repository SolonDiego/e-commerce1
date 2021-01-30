<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprendendo novos Scripts</title>
</head>
<body>
    <?php
        // upload de um arquivo
        /*if(isset($_POST['enviar-formulario'])){

            $formatosPermitidos = array("png", "jpeg", "jpg", "gif");
            $extencao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
           
            
            if(in_array($extencao, $formatosPermitidos)){
                $pasta = "arquivos/";
                $temporario = $_FILES['arquivo']['tmp_name'];
                $novonome = uniqid().".$extencao";

                if(move_uploaded_file($temporario, $pasta.$novonome)){
                    $mensagem = "Upload feito com sucesso";
                }else{
                    $mensagem = "Erro, não foi possivel fazer o upload!";
                }
            }else{
                $mensagem = "Formato Inválido";
            }
        }
        echo $mensagem;*/

        //upload de varios arquivos

        if(isset($_POST['enviar-formulario'])){

            $formatosPermitidos = array("png", "jpeg", "jpg", "gif");
            $quantidadeArquivo = count($_FILES['arquivo']['name']);
            $contador = 0;

            while($contador<$quantidadeArquivo){
                $extencao = pathinfo($_FILES['arquivo']['name'][$contador], PATHINFO_EXTENSION);
            
            
                if(in_array($extencao, $formatosPermitidos)){
                    $pasta = "arquivos/";
                    $temporario = $_FILES['arquivo']['tmp_name'][$contador];
                    $novonome = uniqid().".$extencao";

                    if(move_uploaded_file($temporario, $pasta.$novonome)){
                        echo "Upload feito com sucesso para a pasta $pasta.$novonome<br>";
                    }else{
                        echo "Erro ao enviar o arquivo $temporario <br>";
                    }
                }else{
                    echo "$extencao não é permitida<br>";
                }

                $contador++;
            }

            
        }        
    ?>

    <h3>Upload Arquivo</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="arquivo[]" multiple><br>
    <input type="submit" name="enviar-formulario">
    </form>
</body>
</html>