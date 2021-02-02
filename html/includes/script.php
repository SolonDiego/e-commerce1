<?php
                    $pages = array(
                        'Home'=> 'index.php',
                        'About' => '#',
                        'Contact' => '#',
                        'Register' => 'register.php'
                    );

                    $this_page = basename($_SERVER['PHP_SELF']);

                    foreach($pages as $k => $v){
                      echo "<li";
                      if($this_page == $v) echo "class=\"active\"";
                      echo "><a href=\"" . $v. "\">".$k."</a></li>";
                    }

                    if(isset($_SESSION['user_id'])){

                      echo "<li class=\"dropdown\">
                      <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Account
                      <b class=\"caret\"></b></a>
                      <ul class=\"dropdown-menu\">
                        <li><a href=\"logout.php\">Logout</a></li>
                        <li><a href=\"renew.php\">Renew</a></li>
                        <li><a href=\"change_password.php\">Change Password</a></li>
                        <li><a href=\"favorites.php\">Favorites</a></li>
                        <li><a href=\"recommendations.php\">Recommendations</a></li>
                        </ul>
                      </li>";

                    }

                    if(isset($_SESSION['user_admin'])){

                      echo "
                      <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Admin <b class=\"caret\"></b></a>
                        <ul class=\"dropdown-menu\">
                          <li><a href=\"add_page.php\">Add Page</a></li>
                          <li><a href=\"add_pdf.php\">Add PDF</a></li>
                          <li><a href=\"#\">Something else here</a></li>
                        </ul>
                      </li>";

                    }

                    if(!isset($_SESSION['user_id'])){
                      require('./login_form.inc.php');
                    }

                   
                ?>
                <br>
                <hr>
                <h1>Calculo de parcelas</h1>
                <form action="" method="GET">
                    Total Venda: 
                    <input type="decimal" name="valor">
                    <br>
                    Qtde Parcelas: 
                    <input type="number" name="qtdeparcelas">
                    <br>
                    <input type="submit" value="Calcular">
                </form>

                <?php
                  $total = isset($_GET['valor'])?$_GET['valor']:1;
                  $qtdeparcelas = isset($_GET['qtdeparcelas'])?$_GET['qtdeparcelas']:1;
                  $calculo = $total/$qtdeparcelas; 
                  $parcela = truncate($calculo,2);
                  $parcela1 = ($total -($parcela*$qtdeparcelas))+ $parcela;
                  echo "1 ° Parcela - R$" . number_format($parcela1, 2, '.', ','). "<br>";
                  for($i=2;$i<=$qtdeparcelas;$i++){
                    echo "$i ° Parcela - R$" . number_format($parcela, 2, '.', ','). "<br>";
                  }
                  
                  
                  function truncate($val, $f="0"){
                    if(($p = strpos($val, '.')) !== false) {
                      $val = floatval(substr($val, 0, $p + 1 + $f));
                    }
                    return $val;
                  }

                  $password = "1234567diego";
                  $senha = '$2y$10$6J/uDcjZJQyRNKtLt0EbfeI6GhdRg5WqSxjA84C.ni..fiqCI/IhK';

                  $hash = password_hash($password, PASSWORD_BCRYPT);
                  
                  echo "<br>O password é " . $hash;

                  if(password_verify($password, $senha)){
                    echo "<br> senha correta";
                  }else{
                    echo "<br>senha incorreta";
                  }


                  echo "<hr>";

                  echo "Exemplos<br>";

                  // pesquisar no manual do php as variaveis reservadas.
                  echo $_SERVER['PHP_SELF']."<br>";
                  echo $_SERVER['SERVER_NAME']."<br>";
                  echo $_SERVER['SCRIPT_FILENAME']."<br>";
                  echo $_SERVER['DOCUMENT_ROOT']."<br>";
                  echo $_SERVER['SERVER_PORT']."<br>";
                  echo $_SERVER['REMOTE_ADDR']."<br>";

                  echo "<hr>";

                  //pesquisar filtros de validação do php
                  echo "<h3>Filtro de Validação</h3></br>"
                ?>

              <?php
                  if(isset($_POST['enviar-formulario'])){
                    $erros = array();

                    if(!filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT)){
                       "Idade precisa ser um inteiro"; 
                    }
                    if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
                      $erros[] = "Email Inválido"; 
                    }
                    if(!filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT)){
                      $erros[] ="Peso precisa ser um float"; 
                    }
                    if(!filter_input(INPUT_POST, 'ip', FILTER_VALIDATE_IP)){
                      $erros[] ="IP inválido"; 
                    }
                    if(!filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL)){
                      $erros[] ="URL invalida"; 
                    }

                    if(!empty($erros)){
                      foreach($erros as $erro){
                        echo "<li>$erro</li>";
                      }
                    }else{
                      echo "Parabéns, seus dados estão corretos!";
                    }
                  }
                  
                ?>

              <form action="<?php echo basename($_SERVER['PHP_SELF'])?>" method="POST">
                  Idade: <input type="text" name="idade"><br>
                  Email: <input type="text" name="email"><br>
                  Peso: <input type="text" name="peso"><br>
                  IP: <input type="text" name="ip"><br>
                  URL: <input type="text" name="url"><br>
                  <button type="submit" name="enviar-formulario">Enviar</button>                  
              </form>

              <hr>

              <h3>Sanitize</h3>

              <?php
                //procurar por filtros sanitize

                if(isset($_POST['enviar-formulario'])){
                  $erros = array();

                  $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
                  echo $nome . "<br>";

                  $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
                  if(!filter_var($idade, FILTER_VALIDATE_INT)){
                    $erros[] = "Idade precisa ser um inteiro;";
                  }else{
                    echo $idade . "<br>";
                  }

                  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                  echo $email . "<br>";

                  $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
                  echo $url . "<br>";
                }

                if(!empty($erros)){
                  foreach($erros as $erro){
                    echo "<li>$erro</li>";
                  }
                }else{
                  echo "Parabéns, seus dados estão corretos!";
                }
              ?>

              <form action="<?php echo basename($_SERVER['PHP_SELF'])?>" method="POST">
                  Nome: <input type="text" name="nome"><br>
                  Idade: <input type="text" name="idade"><br>
                  Email: <input type="text" name="email"><br>                
                  URL: <input type="text" name="url"><br>
                  <button type="submit" name="enviar-formulario">Enviar</button>                  
              </form>

              <hr>

              <?php
                ///session_start();
                echo $_SESSION['cor'] . "<br>" . $_SESSION['carro'] . "<br>" . session_id();
              ?>