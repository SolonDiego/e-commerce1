<?php
require('./includes/config.inc.php');
require(MYSQL);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include('./includes/login.inc.php');
}
include('./includes/header.html');
?>
<h1>Bem-vindo</h1>
<p class="lead">Bem-vindo ao Saber é poder, um site dedicado a mantê-lo atualizado sobre as informações de segurança e programação da Web que você precisa saber. Blah, blah, blah. Yadda, yadda, yadda.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent consectetur volutpat nunc, eget vulputate quam tristique sit amet. Donec suscipit mollis erat in egestas. Morbi id risus quam. Sed vitae erat eu tortor tempus consequat. Morbi quam massa, viverra sed ullamcorper sit amet, ultrices ullamcorper eros. Mauris ultricies rhoncus leo, ac vehicula sem condimentum vel. Morbi varius rutrum laoreet. Maecenas vitae turpis turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce leo turpis, faucibus et consequat eget, adipiscing ut turpis. Donec lacinia sodales nulla nec pellentesque. Fusce fringilla dictum purus in imperdiet. Vivamus at nulla diam, sagittis rutrum diam. Integer porta imperdiet euismod.</p>

<?php
include('./includes/footer.html');
?>