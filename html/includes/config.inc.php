<?php
    if(!defined('LIVE')) DEFINE('LIVE', false);

    DEFINE('CONTACT_EMAIL', 'sdiegogm@gmail.com');
    DEFINE('BASE_URI', 'C:\\wamp64\\www\\e-commerce\\');
    DEFINE('BASE_URL', 'localhost/e-commerce/');
    DEFINE('MYSQL', BASE_URI.'mysql.inc.php');
    DEFINE('PDFS', BASE_URI.'pdfs\\');

    session_start();

    function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars){
        $message = "Um erro ocorreu no script $e_file, na linha $e_line:\n$e_message\n";
        $message .= "<pre>" .print_r(debug_backtrace(),1)."</pre>\n";

        if(!LIVE){
            echo "<div class=\"alert alert-danger\">". nl2br($message) . "</div>";
        }else{
            error_log($message, 1, CONTACT_EMAIL, 'From:sdiegogm@hotmail.com');

            if($e_number != E_NOTICE){
                echo "<div class=\"alert alert-danger\">Ocorreu um erro no sistema. Nós pedimos desculpas pelo inconveniente.</div>";
            }
        }
        return true;
    }

    set_error_handler('my_error_handler');