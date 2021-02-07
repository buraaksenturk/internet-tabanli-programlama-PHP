<?php
// Çıkış yapmak isteyen kullanıcının Session'ı sonlandırılıyor
session_start();
$_SESSION["kullaniciID"]="";
header('Location: ../../index.html');
exit;
?>