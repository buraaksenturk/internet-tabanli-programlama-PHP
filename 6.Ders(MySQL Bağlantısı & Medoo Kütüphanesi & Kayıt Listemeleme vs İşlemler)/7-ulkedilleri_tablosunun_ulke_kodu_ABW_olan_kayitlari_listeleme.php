<?php
// If you installed via composer, just use this code to require autoloader on the top of your projects.
require 'medoo.php';
    
// Using Medoo namespace
use Medoo\Medoo;
    
$database = new Medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => 'word',
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
    <link rel="stylesheet" href="janjan.css">
</head>
<body>
    <table class="blueTable">
        <thead>
            <tr>
            <th>Ülke Kodu</th>
            <th>Dil</th>
            <th>Dİl Resmi Mi?</th>
            <th>Oran</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $kayitlar=$database->select("ulkedilleri","*",["ulke_kodu"=>"ABW"]);
            foreach ($kayitlar as $satir) {
                $dil="";
                if($satir["resmi_mi"]=="T"){
                    $dil="<span style='color:green'>Resmi</span>";
                }
                else{
                    $dil="<span style='color:red'>Resmi Değil</span>";
                }
                echo "<tr>
                        <td>".$satir["ulke_kodu"]."</td>
                        <td><a href='https://en.wikipedia.org/wiki/".$satir["dil"]."' target='_blank'>".$satir["dil"]."</a></td>
                        <td>".$dil."</td>
                        <td>".$satir["oran"]."</td>
                    </tr>";
            }
        ?>
        </tbody>
    </table>
</body>
</html>