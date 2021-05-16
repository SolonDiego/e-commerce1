<?php
require('./includes/config.inc.php');
require(MYSQL);
$page_title = 'Register';
include('./includes/header.html');
$reg_errors = array();
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['first_name'])){
        $fn = escape_data($_POST['first_name'], $dbc);
    }else{
        $reg_errors['first_name'] = 'Por favor, insira seu primeiro nome!';
    }

    if(preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['last_name'])){
        $ln = escape_data($_POST['last_name'], $dbc);
    }else{
        $reg_errors['last_name'] = 'Por favor, insira seu último nome!';
    }

    if(preg_match('/^[A-Z0-9]{2,45}$/i', $_POST['username'])){
        $u = escape_data($_POST['username'], $dbc);
    }else{
        $reg_errors['username'] = 'Por favor, insira o nome desejado. Utilize apenas letras e números!';
    }

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === $_POST['email']){
        $e = escape_data($_POST['email'], $dbc);
    }else{
        $reg_errors['email'] = 'Por favor insira um endereço de e-mail válido!';
    }

    if(preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,}$/', $_POST['pass1'])){
        if($_POST['pass1'] === $_POST['pass2']){
            $p = $_POST['pass1'];
        }else{
            $reg_errors['pass2'] = 'Sua senha não corresponde à senha confirmada!';
        }
    }else{
        $reg_errors['pass1'] = 'Por favor insira uma senha válida!';
    }

    if(empty($reg_errors)){
        $q = "SELECT email, username FROM users WHERE email = '$e' OR username = '$u'";
        $r = mysqli_query($dbc, $q);
        $rows = mysqli_num_rows($r);
        if($rows === 0){
            $q = "INSERT INTO users (username, email, pass, first_name, last_name, date_expires)
                    VALUES ('$u', '$e', '" . password_hash($p, PASSWORD_BCRYPT). "','$fn', '$ln', ADDDATE(NOW(), INTERVAL 1 MONTH))";
            $r = mysqli_query($dbc, $q);

            if(mysqli_affected_rows($dbc) === 1){
                echo "<div class=\"alert alert-success\"><h3>Obrigado!</h3>
                <p>Obrigado por se registrar! Agora você pode logar e acessar o site.</p></div>";
                $body = "Obrigado por se registrar em qualquer lugar. Blah, blah, blah. \n\n";
                mail($_POST['email'], 'Registro confirmado', $body, 'From: sdiegogm@gmail.com');
                include('./includes/footer.html');
                exit();
            }else{
                trigger_error('Você não pôde ser registrado devido a um erro do sistema. Pedimos desculpas por qualquer inconveniente. Estamos trabalhando para corrigir esse erro.');
            }
        }else{
            if($row === 2){
                $reg_errors['email'] = "Este endereço de email já foi cadastrado. Se você esqueceu sua senha, use o link à esquerda para que sua senha seja enviada a você.";
                $reg_errors['username'] = "Este nome de usuário já foi registrado. Por favor, tente outro.";
            }else{
                $row = mysqli_fetch_array($r, MYSQLI_NUM);
						
				if( ($row[0] === $_POST['email']) && ($row[1] === $_POST['username'])) {
					$reg_errors['email'] = 'Este endereço de email já foi cadastrado. Se você esqueceu sua senha, use o link à esquerda para que sua senha seja enviada a você.';	
					$reg_errors['username'] = 'Este nome de usuário já foi registrado com este endereço de e-mail. Se você esqueceu sua senha, use o link à esquerda para que sua senha seja enviada a você.';
				} elseif ($row[0] === $_POST['email']) { 
					$reg_errors['email'] = 'Este endereço de email já foi cadastrado. Se você esqueceu sua senha, use o link à esquerda para que sua senha seja enviada a você.';						
				} elseif ($row[1] === $_POST['username']) { 
					$reg_errors['username'] = 'Este nome de usuário já foi registrado. Por favor, tente outro nome';			
				}
            }
        }       
    }
}
require_once('./includes/form_functions.inc.php');
?>
<h1>Register</h1>
<p>Access to the site's content is available to registered users at a cost of $10.00 (US) per year.
    Use the form below to begin the registration process. <strong>Note: All fields are required.</strong>
    After completing this form, you'll be presented with the opportunity to securely pay for your yearly
    subscription via <a href="http://www.paypal.com">PayPal</a>.
</p>
<form action="register.php" method="POST" accept-charset="utf-8">
    <?php    
    create_form_input('first_name', 'text', 'First Name', $reg_errors);
    create_form_input('last_name', 'text', 'Last Name', $reg_errors);
    create_form_input('username', 'text', 'Desired Username', $reg_errors);
    echo "<span class=\"help-block\">Only letter and numbers are allowed.</span>";
    create_form_input('email', 'email', 'Email Address', $reg_errors);
    create_form_input('pass1', 'password', 'Password', $reg_errors);
    echo "<span class=\"help-block\">Must be at least 6 characters long, with at least one lowercase letter, one uppercase letter, and one number.</span>";
    create_form_input('pass2', 'password', 'Confirm Password', $reg_errors);    
    ?>
    <input type="submit" name="submit_button" value="Next &rarr;" id="submit_button" class="btn btn-default">
</form>
<?php
include('./includes/footer.html');
?>