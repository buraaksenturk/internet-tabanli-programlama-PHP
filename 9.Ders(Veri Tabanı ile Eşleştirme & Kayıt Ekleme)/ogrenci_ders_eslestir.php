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
    <h1>Öğrenci-Ders Eşleştirme Sayfası</h1>
    <form action="" method="post">
        <label for="ogrenciler">Lütfen Öğrenci Adını Seçiniz:</label>
        <select id="ogrenciler" name="ogrenci">
        <?php
            $ogrenciler_ = $database -> select("ogrenciler","*");
            foreach($ogrenciler_ as $ogrenci_){
                echo "<option value='".$ogrenci_["id"]."'>".$ogrenci_["ad_soyad"]."</option>";
            }
        ?>
        </select><br><br>
        <label for="dersler">Lütfen Ders Adını Seçiniz:</label>
        <select id="dersler" name="ders">
        <?php
            $dersler_ = $database -> select("dersler","*");
            foreach($dersler_ as $ders_){
                echo "<option value='".$ders_["id"]."'>".$ders_["kod"]." - ".$ders_["ad"]."</option>";
            }
        ?>
        </select><br><br>
        <input type="submit" value="Öğrenci Kaydet"><br>
    </form>
<table>
<tr>
    <td>ID</td>
    <td>Öğrenci ID</td>
    <td>Öğrenci Ad Soyad</td>
    <td>Ders ID</td>
    <td>Ders Kod</td>
    <td>Ders Ad</td>
</tr>
<?php
$ogrenci_dersleri = $database -> select("ogrenci_dersleri","*");
foreach($ogrenci_dersleri as $ogrenci_dersi){
    $ders_bilgileri_ = $database->get("dersler", "*", ["id" => $ogrenci_dersi["ders_id"]]);
    $ogrenci_bilgileri_ = $database->get("ogrenciler", "*", ["id" => $ogrenci_dersi["ogrenci_id"]]);
    echo "<tr>
        <td>".$ogrenci_dersi["id"]."</td>
        <td>".$ogrenci_dersi["ogrenci_id"]."</td>
        <td>".$ogrenci_bilgileri_["ad_soyad"]."</td>
        <td>".$ogrenci_dersi["ders_id"]."</td>
        <td>".$ders_bilgileri_["kod"]."</td>
        <td>".$ders_bilgileri_["ad"]."</td>
    </tr>";
}
?>
</table>
</body>
</html>
<?php
$ogrenci="";
$ders="";
if(isset($_POST["ogrenci"]) && isset($_POST["ders"])){
    if($_POST["ogrenci"]!="" && $_POST["ders"]!=""){
        $ogrenci=$_POST["ogrenci"];
        $ders=$_POST["ders"];

        //Kayıt işlemi yapmalıyız
        $database->insert("ogrenci_dersleri", ["ogrenci_id" => $ogrenci,"ders_id" => $ders]);
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