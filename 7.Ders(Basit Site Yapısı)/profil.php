<?php
require 'Medoo.php';
session_start();
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

if(!isset($_SESSION["kullaniciID"]) || $_SESSION["kullaniciID"]==""){
    header('Location: giris.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Profil Sayfası</h1>
    <?php
    $kullanici = $database->get("kullnicilar", "*", ["id" => $_SESSION["kullaniciID"]]);
    ?>
    <h3>Merhaba sayın, <?php echo $kullanici["ad_soyad"]; ?></h3>
    <a href="cikis.php">Çıkış Yap</a>
</body>
</html>