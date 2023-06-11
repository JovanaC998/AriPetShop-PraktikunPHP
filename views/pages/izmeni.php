<?php
    require_once "setup/konekcija.php";
    if(!isset($_SESSION["korisnik"])){
        header("location: index.php");       
    } else{
        if($_SESSION["korisnik"]->id_uloga == 1){
            header("location: index.php");
        }
    }

    if (isset($_SESSION['alert_message'])) {
        echo '<script>alert("' . $_SESSION['alert_message'] . '");</script>';
        unset($_SESSION['alert_message']);
    }
?>

   <body>    
      <div class="container py-5">
         <div class="row authorSection">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
               <h1 class="display-5 text-uppercase mb-0">Update Product</h1>
            </div>
            <?php
if (isset($_GET["id"]))
{
    $id = $_GET["id"];
    $upit = "SELECT * FROM proizvodi WHERE id=:id";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id", $id);
    $rezultat = $priprema->execute();
    $rez = $priprema->fetch();
    if ($priprema->rowCount() == 1)
    {
        $upit2 = "SELECT * FROM kategorija";
        $rezultat2 = $konekcija->query($upit2);
        $rez2 = $rezultat2->fetchAll();

        echo "
                                <form action = 'models/izmeniProizvod.php?id=$id' method='POST' enctype='multipart/form-data'>
                                <table class='insertTabela'>
                                    <tr>
                                        <td>Name:</td>
                                        <td><input type='text' required pattern='^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11})*$' title='Example: Royal Canin' name='naziv' value='$rez->naziv'></td>
                                    </tr>
                                    <tr>
                                        <td>Price:</td>
                                        <td><input type='number' required pattern='^\d+(.\d{1,2})?$' title='Example: 12.50' name='cena' value='$rez->cena'></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td><textarea required title='Tell us something about your Product.' name='opis' rows='3'>$rez->opis</textarea></td>
                                    </tr>
                                    <tr>
                                        <td>On Sale:</td>
                                        <td><input type='text' required pattern='^[0-1]{1}$' title='0 OR 1' name='istaknut' value='$rez->istaknut'></td>
            
                                    </tr>   
                                    <tr>
                                        <td>Previous Price <br/>(If product is on sale):</td>
                                        <td><input type='text' pattern='^\d+(.\d{1,2})?$' title='Example: 12.50' name='prethodnaCena' value='$rez->prethodna_cena'></td>
                                    </tr> 
                                    <tr>
                                        <td>Image:</td>
                                        <td><input type='file' id='slika' name='slika'><img id='slikaUpd' src='$rez->slika'></td>
                                    </tr>
                                    <tr>
							        <td>Category</td>
							        <td><select class='listaKategorija' name='listaKategorija'>";
        $i = 1;
        foreach ($rez2 as $kat)
        {
            if ($i == $rez->id_kategorija)
            {
                echo "<option value='$kat->id' selected='$i'>$kat->naziv</option>";
            }
            else
            {
                echo "<option value=$kat->id>$kat->naziv</option>";
            }
            $i++;
        }
        echo "</select>
							            </td>
							        </tr>
                                    <tr> 
                                        <td colspan='2'><input class='btn btn-primary' id='btnUnesi' value='Update' type='submit' name='izmeni'></td>
                                    </tr>   
                                    </table>  
                                    </form>";
    }
    else
    {
        echo "<h1 class='display-5 text-uppercase mb-0 notfound'>PRODUCT NOT FOUND.</h1>";
    }
}
?>
         </div>
      </div>      
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>
      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/waypoints/waypoints.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
      <!-- Template Javascript -->
      <script src="js/main.js"></script>
   </body>
</html>
