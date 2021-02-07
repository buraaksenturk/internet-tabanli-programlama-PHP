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
    <h1>Ders Kayıt Sayfası</h1>
    <form action="" method="POST">
        Kod:<br><input type="text" name="kod"><br><br>
        Ad:<br><input type="text" name="ad"><br><br>
        <input type="submit" value="Dersi Kaydet"><br>
    </form>
<table>
    <tr>
        <td>ID</td>
        <td>KOD</td>
        <td>AD</td>
    </tr>
<?php
$dersler = $database -> select("dersler","*");
foreach($dersler as $ders){
    echo "<tr>
        <td>".$ders["id"]."</td>
        <td>".$ders["kod"]."</td>
        <td>".$ders["ad"]."</td>
    </tr>";
}
?>
</table>
</body>
</html>
<?php
$kod="";
$ad="";
if(isset($_POST["kod"]) && isset($_POST["ad"])){
    if($_POST["kod"]!="" && $_POST["ad"]!=""){
        $kod=$_POST["kod"];
        $ad=$_POST["ad"];

        //Kayıt işlemi yapmalıyız
        $database->insert("dersler", ["kod" => $kod,"ad" => $ad]);
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