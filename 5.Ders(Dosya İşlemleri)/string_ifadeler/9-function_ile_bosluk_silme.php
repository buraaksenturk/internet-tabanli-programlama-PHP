<?php

$icerik="Merhaba arkadaşlar nasılsınız?";

function BoslukSil($Deger) {    
    $Sil=str_replace(" ","",$Deger);
    return $Sil;
    }
    echo BoslukSil($icerik);
?>