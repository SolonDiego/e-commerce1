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
        $reg_errors['first_name'] = 'Please enter your first name';
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