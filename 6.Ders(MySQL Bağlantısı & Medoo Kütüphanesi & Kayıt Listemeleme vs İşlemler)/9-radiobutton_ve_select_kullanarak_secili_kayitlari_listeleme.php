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
Lütfen Ülke Adını Seçiniz
<form action="" method="GET">
  <select name="kod" id="cars">
<?php 
    $ulkeKayitlari=$database->select("ulkeler","*");
    foreach($ulkeKayitlari as $kayit){
        echo '<option value="'.$kayit["kod"].'">'.$kayit["isim"].'</option>';
    }
?>
  </select><br>
<input type="radio" id="male" name="resmi" value="T">
<label for="male">Resmi Dil</label>
<input type="radio" id="female" name="resmi" value="F">
<label for="female">Resmi Değil</label>
  <input type="submit" value="ARA">
</form><br><br>
<!-- Kayıtların Listelendiği Yer -->
        <?php
        if (isset($_GET["kod"]) && isset($_GET["resmi"])) {
            $kayitlar=$database->select("ulkedilleri","*",["AND"=>["ulke_kodu"=>$_GET["kod"],"resmi_mi"=>$_GET["resmi"]]]);
            echo '<table class="blueTable">
            <thead>
                <tr>
                <th>Ülke Kodu</th>
                <th>Dil</th>
                <th>Dİl Resmi Mi?</th>
                <th>Oran</th>
                </tr>
            </thead>
            <tbody>';
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
        } 
        ?>
        </tbody>
    </table>
</body>
</html>