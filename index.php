<?php
session_start();
require('all_fns.php');

do_html_header('Money In');
if(isset($_SESSION['flash'])){
  echo $_SESSION['flash'];
  unset($_SESSION['flash']);
}
?>
<h1>Home Page</h1>