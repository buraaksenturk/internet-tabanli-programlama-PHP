<?php
    $araclar=array("BMW","TOFAŞ","Mercedes","Volvo","Toyota","Renault","Citroen");
    echo "<ul>";
    for ($i=0; $i <count($araclar) ; $i++) { 
        echo "<li>".$araclar[$i]."</li>";
    }
    echo "</ul>";
?>