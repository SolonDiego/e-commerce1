<?php
    function create_form_input($name, $type, $label = '', $errors = array(), $option = array()){
        $value = false;
        if(isset($_POST[$name])) $value = $_POST[$name];
        if($value && get_magic_quotes_gpc()) $value = stripslashes($value);

        echo "<div class=\"form-group";
        if(array_key_exists($name, $errors)) echo " has-error";
        echo "\">";        
    }