<?php
require('./includes/config.inc.php');
redirect_invalid_user('user_admin');
require(MYSQL);
$page_title = "Add a Site Content Page";
include('./includes/header.html');
$add_page_errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['title'])) {
        $t = escape_data(strip_tags($_POST['title']), $dbc);
    } else {
        $add_page_errors['title'] = "Por favor, insira um titulo!";
    }

    if (filter_var($_POST['category'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
        $cat = $_POST['category'];
    } else {
        $add_page_errors['category'] = "Por favor, insira uma categoria!";
    }

    if (!empty($_POST['description'])) {
        $d = escape_data(strip_tags($_POST['description']), $dbc);
    } else {
        $add_page_errors['description'] = "Por favor, insira uma descrição!";
    }

    if (!empty($_POST['content'])) {
        $allowed = "<div><p><span><br><a><img><h1><h2><h3><h4><ul><ol><li><blockquote>";
        $c = escape_data(strip_tags($_POST['content'], $allowed), $dbc);
    } else {
        $add_page_errors['content'] = "Por favor, insira um conteudo!";
    }

    if (empty($add_page_errors)) {
        $q = "INSERT INTO pages (categories_id, title, description, content) VALUES ($cat, '$t', '$d', '$c')";
        $r = mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) === 1) {
            echo "<div class=\"alert alert-sucess\"><h3>A página foi adicionada!</h3></div>";
            $_POST = array();
        } else {
            trigger_error('The page could not be added due to a system error. We apologize for any inconvenience.');
        }
    }
}

require('./includes/form_functions.inc.php');
?>

<h1>Add a Site Content Page</h1>
<form action="add_page.php" method="POST" accept-charset="utf-8">
    <fieldset>
        <legend>Fill out the form to add a page of content</legend>
        <?php
        create_form_input('title', 'text', 'Title', $add_page_errors);
        echo "<div class=\"form-group";
        if (array_key_exists('category', $add_page_errors)) echo "has-error";
        echo "\"><label for=\"category\" class=\"control-label\">Category</label
        <select name=\"category\" class=\"form-control\">
        <option>Select One</option>";
        $q = "SELECT id, category FROM categories ORDER BY category ASC";
        $r = mysqli_query($dbc, $q);
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            echo "<option value=\"$row[0]\"";
            if (isset($_POST['category']) && ($_POST['category'] == $row[0])) echo ' selected="selected"';
            echo ">$row[1]</option>\n";
        }
        echo "</select>";
        if (array_key_exists('category', $add_page_errors)) echo '<span class="help-block">' . $add_page_errors['category'] . '</span>';
        echo '</div>';

        create_form_input('description', 'textarea', 'Description', $add_page_errors);
        create_form_input('content', 'textarea', 'Content', $add_page_errors);
        ?>

        <input type="submit" name="submit_button" value="Add This Page" id="submit_button" class="btn btn-default" />

        ?>
    </fieldset>
</form>

<?php include('./includes/footer.html'); ?>