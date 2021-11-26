<?php

if (session_id() == "") {
  session_start();
}
//session_start();
if (!isset($_SESSION['email'])) {
  header('location: ../index.php');
  exit();
}
