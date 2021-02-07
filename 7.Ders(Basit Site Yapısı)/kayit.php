<?php
require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'ybs',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 
	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
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
    <h1>Kayıt Sayfası</h1>
    <form action="" method="post">
        Ad Soyad:<br><input type="text" name="ad_soyad"><br><br>
        E-Posta:<br><input type="email" name="eposta"><br><br>
        Şifre:<br><input type="password" name="sifre"><br><br>
        <input type="submit" value="Kayıt Ol"><br>
        <a href="giris.php">Giriş Yap</a>
    </form>
</body>
</html>
<?php
$adSoyad="";
$sifre="";
$ePosta="";
if(isset($_POST["ad_soyad"]) && isset($_POST["eposta"]) && isset($_POST["sifre"])){
    if($_POST["ad_soyad"]!="" && $_POST["eposta"]!="" && $_POST["sifre"]!=""){
        $adSoyad=$_POST["ad_soyad"];
        $ePosta=$_POST["eposta"];
        $sifre=$_POST["sifre"];

        //Kayıt işlemi yapmalıyız
        $database->insert("kullnicilar", ["ad_soyad" => $adSoyad,"eposta" => $ePosta,"sifre" => $sifre]);
        $son_eklenen_id = $database->id();
        if($son_eklenen_id>0){
            echo '<script>alert("Kayıt oluşturuldu, aktif olunca giriş yapabilirsiniz.")</script>';
        }else{
            echo '<script>alert("Kayıt oluşturulurken hata!Lütfen tekrar deneyiniz.")</script>';
        }
    }else{
        echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.")</script>';
    }    
}
?>