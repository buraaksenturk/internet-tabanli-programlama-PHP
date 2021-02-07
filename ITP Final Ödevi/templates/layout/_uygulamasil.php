<?php
require '_base.php';
error_reporting(0);
if(isset($_GET["id"])){
    $silinecekuyg_id=$_GET["id"];
    
    $uygsilmee=$database->get("385215_tbl_chatuygulamalari","*", ["chat_id" => $silinecekuyg_id]);
    $mesajsilmee=$database->get("385215_tbl_mesajlar","*", ["chat_uygulamasi" => $silinecekuyg_id]);
    if($uygsilmee>0){
        //aktivasyon yap
        $data = $database->delete("385215_tbl_chatuygulamalari", ["chat_id" => $silinecekuyg_id]);
        $dataa = $database->delete("385215_tbl_mesajlar", ["chat_uygulamasi" => $silinecekuyg_id]);
        echo '<link rel="stylesheet" href="../../static/css/aktifet.css">
        <link rel="icon" type="image/jpeg" href="../../static/img/kodomega.jpeg">
            <div class="container" id="container">
                <div class="form-container sign-up-container">
                    <form action="../anasayfa.php" method="POST">
                        <h1>Uygulama silme işlemi başarılı bir şekilde gerçekleşti.</h1>
                        <button>Anasayfaya geri dön</button>
                    </form>
                </div>
            </div>';
    }else{
        header('Location: ../chatuygulamalari.php?m=uygulama_hata');
    }
}
?>
