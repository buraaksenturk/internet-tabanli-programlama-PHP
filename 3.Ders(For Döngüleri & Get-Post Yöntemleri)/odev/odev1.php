<?php 
    $kutu_sayi = $_GET['kutu_sayi'];
    $kutu_renk = $_GET['kutu_renk'];

    echo "<br> Kutu Sayısı:".$kutu_sayi;
	echo "<br> Kutu Rengi:".$kutu_renk;
    for ($i=1; $i <= $kutu_sayi ; $i++) {
        echo '<br>'.$i.')<div style="background-color:'.$kutu_renk.';width:50px;height:50px;"></div>';
    }
?>