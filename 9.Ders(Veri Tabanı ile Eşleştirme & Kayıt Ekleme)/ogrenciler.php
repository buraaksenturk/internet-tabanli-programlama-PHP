<?php
require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'php_ders',
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
<?php include('baglantilar.html'); ?>
    <h1>Öğrenci Kayıt Sayfası</h1>
    <form action="" method="post">
        Ad Soyad:<br><input type="text" name="ad_soyad"><br><br>
        E-Posta:<br><input type="email" name="eposta"><br><br>
        Yaş:<br><input type="number" name="yas"><br><br>
        <input type="submit" value="Öğrenci Kaydet"><br>
    </form>
<table>
<tr>
    <td>ID</td>
    <td>AD SOYAD</td>
    <td>EPOSTA</td>
    <td>YAŞ</td>
</tr>
<?php
$ogrenciler = $database -> select("ogrenciler","*");
foreach($ogrenciler as $ogrenci){
    echo "<tr>
        <td>".$ogrenci["id"]."</td>
        <td>".$ogrenci["ad_soyad"]."</td>
        <td>".$ogrenci["eposta"]."</td>
        <td>".$ogrenci["yas"]."</td>
    </tr>";
}
?>
</table>
</body>
</html>
<?php
$adSoyad="";
$ePosta="";
$yas="";
if(isset($_POST["ad_soyad"]) && isset($_POST["eposta"]) && isset($_POST["yas"])){
    if($_POST["ad_soyad"]!="" && $_POST["eposta"]!="" && $_POST["yas"]!=""){
        $adSoyad=$_POST["ad_soyad"];
        $ePosta=$_POST["eposta"];
        $yas=$_POST["yas"];

        //Kayıt işlemi yapmalıyız
        $database->insert("ogrenciler", ["ad_soyad" => $adSoyad,"eposta" => $ePosta,"yas" => $yas]);
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