<?php
session_start();
$_SESSION["kullaniciID"]="";
header('Location: profil.php');
exit;
?>