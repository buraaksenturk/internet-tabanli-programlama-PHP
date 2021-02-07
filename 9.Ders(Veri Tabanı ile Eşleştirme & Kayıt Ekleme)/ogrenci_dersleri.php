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
    <h1>Öğrenci Dersleri Sayfası</h1>
    <form action="" method="POST">
        Öğrenci Adı:<br><input type="text" name="ad">
        <input type="submit" value="ARA"><br>
    </form>
</body>
</html>
<?php
$ad="";
if(isset($_POST["ad"])){
    if($_POST["ad"]!=""){
        $ad=$_POST["ad"];
        $sonuclar = $database->select("ogrenciler", "*", ["ad_soyad[~]" => $ad]);
        if ($sonuclar != ""){
            echo "Bulunan öğrenciler:<br>";
            foreach($sonuclar as $sonuc){
                echo '<a href="?id='.$sonuc["id"].'">'.$sonuc["ad_soyad"].'</a><br>';
            }
        }
    }
}
$ogrenci_id="";
if(isset($_GET["id"])){
    if($_GET["id"] !=""){
        $ogrenci_id_=$_GET["id"];
        $dersler=$database->query(
            "SELECT * FROM dersler WHERE id in( select ders_id from ogrenci_dersleri where ogrenci_id =$ogrenci_id_)"
            )->fetchAll();
            if($dersler !=""){
                foreach($dersler as $ders){
                    echo $ders["kod"]." - ".$ders["ad"]."<br>";
                }
            }
    }
}
?>