<?php
require('./includes/config.inc.php');
require(MYSQL);
$page_title = 'Forgot Your Password';
include('./includes/header.html');

$pass_errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $q = 'SELECT id FROM users WHERE email = "' . escape_data($_POST['email'], $dbc) . '"';
        $r = mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) === 1) {
            list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
        } else {
            $pass_errors['email'] = 'O endereço de e-mail enviado não corresponde aos arquivados!';
        }
    } else {
        $pass_errors['email'] = 'Por favor, insira um e-mail valido';
    }
}

if (empty($pass_errors)) {
    $p = substr(md5(uniqid(rand(), true)), 10, 15);
    $q = "UPDADE users SET pass= '" . password_hash($p, PASSWORD_BCRYPT) . "' WHERE id=$uid LIMIT 1";
    $r = mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc) === 1) {
        $body = "Your password to log into <whatever site> has been temporarily changed to $p.
         Please log in using that password and this email address. Then you may change your password to something more familiar.";
        mail($_POST['email'], "Sua senha temporaria.", $body, 'From: sdiegogm@gmail.com');

        echo "<h1>Sua senha foi mudada.</h1><p>Você receberá a nova senha temporária por e-mail. Depois de fazer o login com a nova senha, você pode alterá-la clicando no link \"Alterar senha\".</p>";
        include('./includes/footer.html');
        exit();
    }else{
        trigger_error('Não foi possível alterar sua senha devido a um erro do sistema. Pedimos desculpas por qualquer inconveniente.');
    }
}

require_once('./includes/form_functions.inc.php');

?>

<h1>Redefina sua senha</h1>
<p>Digite seu email abaixo para redefinir sua senha.</p>
<form action="forgot_password.php" method="POST" accept-charset="utf-8">
    <?php create_form_input('email', 'email', 'E-mail', $pass_errors); ?>
    <input type="submit" name="submit_button" value="Redefinir &rarr;" id="submit_button" class="btn btn-default">
</form>

<?php include('./includes/footer.html'); ?>
