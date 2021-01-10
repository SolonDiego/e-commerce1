<?php
if(!defined('LIVE')) DEFINE('LIVE', false);
DEFINE('CONTACT_EMAIL', 'sdiegogm@gmail.com');
DEFINE('BASE_URI', 'C:\\wamp64\\www\\e-commerce1\\');
DEFINE('BASE_URL', 'localhost\\e-commerce1\html\\');
DEFINE('MYSQL', BASE_URI.'mysql.inc.php');

session_start();

function my_error_handler($e_number, $e_message, $e_file, $e_line, $_vars){
    $message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
    $message .= "<pre>". print_r(debug_backtrace(),1). "</pre>\n";

    if(!LIVE){
        echo "<div class=\"alert alert-danger\">" . nl2br($message) . "</div>";
    }else{
        error_log($message, 1, CONTACT_EMAIL, 'From:sdiegogm@gmail.com');
        
        if($e_number != E_NOTICE){
            echo "<div class = \"alert alert-danger\"> A system error occurred. We apologize for the inconvenience.</div>";
        }
    }
    return true;
}

set_error_handler('my_erro_handler');