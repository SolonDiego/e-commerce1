<?php
require('./includes/config.inc.php');
redirect_invalid_user();
require(MYSQL);
$page_title = "Change you Password";
include('./includes/header.html');
$pass_errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['current'])) {
        $current = $_POST['current'];
    } else {
        $pass_errors['current'] = "Por favor, insira a sua senha atual";
    }

    if (preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,}$/', $_POST['pass1'])) {
        if ($_POST['pass1'] == $_POST['pass2']) {
            $p = $_POST['pass1'];
        } else {
            $pass_errors['pass2'] = 'Sua senha não corresponde à senha confirmada!';
        }
    } else {
        $pass_errors['pass1'] = 'Por favor, insira uma senha válida!';
    }

    if (empty($pass_errors)) {

        $q = "SELECT pass FROM users WHERE id={$_SESSION['user_id']}";
        $r = mysqli_query($dbc, $q);
        list($hash) = mysqli_fetch_array($r, MYSQLI_NUM);
        if (password_verify($current, $hash)) {
            $q = "UPDATE users SET pass='"  .  password_hash($p, PASSWORD_BCRYPT) .  "' WHERE id={$_SESSION['user_id']} LIMIT 1";
            if ($r = mysqli_query($dbc, $q)) {
                echo '<h1>Sua senha foi mudada.</h1>';
                include('./includes/footer.html');
                exit();
            } else {
                trigger_error('Não foi possível alterar sua senha devido a um erro do sistema. Pedimos desculpas por qualquer inconveniente.');
            }
        } else {
            $pass_errors['current'] = 'Sua senha atual está incorreta!';
        }
    }
}

require_once('./includes/form_functions.inc.php');
?>
<h1>Change Your Password</h1>
<p>Use the form below to change your password.</p>
<form action="change_password.php" method="post" accept-charset="utf-8">
    <?php
    create_form_input('current', 'password', 'Current Password', $pass_errors);
    create_form_input('pass1', 'password', 'Password', $pass_errors);
    echo '<span class="help-block">Must be at least 6 characters long, with at least one lowercase letter, one uppercase letter, and one number.</span>';
    create_form_input('pass2', 'password', 'Confirm Password', $pass_errors);
    ?>
    <input type="submit" name="submit_button" value="Change &rarr;" id="submit_button" class="btn btn-default" />
</form>

<?php
include('./includes/footer.html');
?>