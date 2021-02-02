<?php
    setcookie('user', 'Solon Diego', time()+3600);
    setcookie('email', 'sdiegogm@gmail.com', time()+3600);
    setcookie('ultima_pesquisa', 'tenis adidas', time()+3600);

    //var_dump($_COOKIE);

    echo $_COOKIE['user'];