<?php 
    $urun_ad = $_GET['urun_ad'];
    $urun_miktar = $_GET['urun_miktar'];
    $urun_renk = $_GET['urun_renk'];
    $urun_yukseklik = $_GET['urun_yukseklik'];
    $urun_genislik = $_GET['urun_genislik'];

    echo "<br> Ürün Adı:".$urun_ad;
    echo "<br> Ürün Miktarı:".$urun_miktar;
    echo "<br> Ürün Rengi:".$urun_renk.'"<div style="background-color:'.$urun_renk.';width:'.$urun_yukseklik.'px;height:'.$urun_genislik.'px;"></div>';
?>