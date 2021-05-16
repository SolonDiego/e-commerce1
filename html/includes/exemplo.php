<?php
$this_page = basename($_SERVER['PHP_SELF']);
$this_page2 = $_SERVER['PHP_SELF'];
$this_page3 = $_SERVER['REQUEST_METHOD'];

echo $this_page;

echo "<br>" . $this_page2;

echo "<br>" . $this_page3;
