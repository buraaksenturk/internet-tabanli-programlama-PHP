<?php 
$kisinin_ismi = $_POST["isim"];
$kisinin_yasi = $_POST["yas"];
$kisinin_fr = $_POST["fav_renk"];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .kutu{
            width:10px;
            height:10px;
            background-color:<?php echo $kisinin_fr; ?>
        }
    </style>
</head>
<body>
    <?php 
        echo "Merhaba ".$kisinin_ismi;
        echo "<br>Yaşınız: ".$kisinin_yasi;
        echo "<br>Favori Renginiz: <div class='kutu'></div>";
    ?>
</body>
</html>