<?php
require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'itp',
	'server' => 'localhost',
	'username' => 'root',
	'password' => ''
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        Kullanıcı Adı <input type="text" name="kad"><br>
        Şifre <input type="password" name="sifre"><br>
        <input type="submit" value="Kaydet"><br>
    </form>
    <a href="hatirlat.php">Şifremi unuttum</a>
</body>
</html>
<?php
if(isset($_POST["kad"]) && isset($_POST["sifre"])){
    if($_POST["kad"]!="" && $_POST["sifre"]!="" ){
        $kAd=$_POST["kad"];
        $sifre=$_POST["sifre"];
        //Kayıt işlemi yapmalıyız
        $user=$database->get("users","id", ["AND" =>["kad" => $kAd, "sifre" => $sifre,"aktif_mi" => 1]]);
        if($user>0){
            header('Location:panel.php');
        }else{
            header('Location:giris.php?m=kullanici_hata');
        }
    }
}
?>