<form action="" method="POST">    
<input type="text" name="deger"><br/>    
<input type="submit" value="Gönder"><br/><br/>
</form>

<?php
function BoslukSil($Deger) {    
    $Sil=str_replace(" ","",$Deger);
    return $Sil;
    }
    if(isset($_POST["deger"])){    
        $GelenDeger=$_POST["deger"];    
        echo BoslukSil($GelenDeger);
    }
    else{
        
    }
?>