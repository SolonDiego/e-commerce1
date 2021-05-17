<?php
require('config.inc.php');
require(MYSQL);

$this_page = basename($_SERVER['PHP_SELF']);
$this_page2 = $_SERVER['PHP_SELF'];
$this_page3 = $_SERVER['REQUEST_METHOD'];

echo $this_page;

echo "<br>" . $this_page2;

echo "<br>" . $this_page3;

echo "<hr>";

$q = "SELECT id, username, type, pass, IF(date_expires >= NOW(), true, false) as expired FROM users WHERE email = 'sdiegogm@gmail.com'";
$r = mysqli_query($dbc, $q);
$rows = mysqli_num_rows($r);

echo $rows;

echo "<hr>";

//$row1 = mysqli_fetch_array($r, MYSQLI_NUM);

//var_dump($row1);

$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

var_dump($dbc);

var_dump($row);

var_dump($r);


