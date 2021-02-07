<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>Araçlar</td>
            <td>İşlem</td>
        </tr>
        <?php
        $araclar=array("BMW","TOFAŞ","Mercedes","Volvo","Toyota","Renault","Citroen");
        foreach ($araclar as $arac) {
            echo "<td>".$arac."</td><td><a href='sil.php?deger=$arac'>SİL</a></td></tr>";
        }
        ?>
    </table>
</body>
</html>
