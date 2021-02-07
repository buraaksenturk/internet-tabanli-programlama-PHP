<?php
    $icerik="Merhaba Ali";
    $degisen_icerik=str_replace("Ali","Veli",$icerik);
    echo $degisen_icerik;
    echo " Karakter sayısı:".strlen($icerik);
    $ters_icerik=strrev($icerik);
    echo " Ters $icerik==>$ters_icerik";
?>