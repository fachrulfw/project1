<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/project/data/init.php';
  unset($_SESSION['SBUser']);
  header('Location: login.php');
?>
