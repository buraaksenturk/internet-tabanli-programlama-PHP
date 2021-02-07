<?php
require '_base.php';
error_reporting(0);

if(isset($_GET["id"])){
    $silinecekmesaj_id=$_GET["id"];
    //Kayıt listeleme
    $mesajsilmee=$database->get("385215_tbl_mesajlar","*", ["mesaj_id" => $silinecekmesaj_id]);
    if($mesajsilmee>0){
        // silme işlemi
        $data = $database->delete("385215_tbl_mesajlar", ["mesaj_id" => $silinecekmesaj_id]);
        echo '<link rel="stylesheet" href="../../static/css/aktifet.css">
        <link rel="icon" type="image/jpeg" href="../../static/img/kodomega.jpeg">
            <div class="container" id="container">
                <div class="form-container sign-up-container">
                    <form action="../anasayfa.php" method="POST">
                        <h1>Mesaj silme işlemi başarılı bir şekilde gerçekleşti.</h1>
                        <button>Anasayfaya geri dön</button>
                    </form>
                </div>
            </div>';
    }else{
        // hata alınırsa yönlendirme yapılacak
        header('Location: ../mesajlarilistele.php?m=mesajsilme_hata');
    }
}
?>