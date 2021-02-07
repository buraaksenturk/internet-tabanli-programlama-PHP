<?php
// session kontrol
if(!isset($_SESSION["kullaniciID"]) || $_SESSION["kullaniciID"]==""){
    header('Location: ../../index.html');
    exit;
}
?>