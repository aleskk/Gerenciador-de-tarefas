<?php

if (session_id() == "") {
  session_start();
}
//session_start();
if (!isset($_SESSION['login'])) {
  header('location: ../index.php');
  exit();
}
