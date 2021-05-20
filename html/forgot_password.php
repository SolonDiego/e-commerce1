<?php
require('./includes/config.inc.php');
require(MYSQL);
$page_title = 'Forgot Your Password';
include('./includes/header.html');

$pass_errors = array();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $q = 'SELECT id FROM users WHERE email = "' .escape_data($_POST['email'], $dbc). '"';
        $r = mysqli_query($dbc, $q);
        if(mysqli_num_rows($r) === 1){
            list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
        }else{
            $pass_errors['email'] = 'O endereço de e-mail enviado não corresponde aos arquivados!';
        }
    }else{
        $pass_errors['email'] = 'Por favor, insira um e-mail valido';
    }
}

if(empty($pass_errors)){
    $p = substr(md5(uniqid(rand(), true)),10,15);
    $q = "UPDADE users SET pass= '" . password_hash($p, PASSWORD_BCRYPT). "' WHERE id=$uid LIMIT 1";
    $r = mysqli_query($dbc, $q);
    if(mysqli_affected_rows($dbc) === 1){
        
    }
}