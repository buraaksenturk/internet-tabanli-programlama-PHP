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
<?php
echo "Merhaba Ali";
$foto = "";
$foto = $database->get("users","fotograf",["users_id" => $_SESSION["kullaniciID"]]);
echo '<img src="'.$foto.'" style="width:100px;" alt="Profil Fotosu">';
?>
</body>
</html>