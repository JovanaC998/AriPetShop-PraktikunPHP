<?php
if(isset($_SESSION['korisnik'])){
    $id=$_SESSION['korisnik']->id;
    $upit="SELECT id_korisnika FROM korisnik_odgovor WHERE id_korisnika=$id";
    $rezultat=$konekcija->query($upit);
    if($rezultat->rowCount()>0){
        $rezultat->fetch();
        echo "<div class='bg-light mb-5 p-5 col-lg-5 mine mineNb'>
            <h6 class='text-uppercase mb-2'>Survey Results</h6>";
            $upitOdg="SELECT * from odgovor WHERE id_anketa = 1";
            $rezultatOdg=$konekcija->query($upitOdg);
            foreach($rezultatOdg->fetchAll() as $rez){
                $upitCount="SELECT COUNT(id_odgovora) AS br from korisnik_odgovor WHERE id_odgovora = :idOdg";
                $pripremaCount = $konekcija->prepare($upitCount);
                $pripremaCount->bindParam(":idOdg", $rez->id);
                $rezultatCount = $pripremaCount->execute();
                $brojOdgovora = $pripremaCount->fetch()->br;
               echo" <p class='pNm'>$rez->odg : <span class='spanNm'>$brojOdgovora</span> </p>";
            }
        echo"</div>";
    }
    else{
        echo "<div class='bg-light mb-5 p-5 col-lg-5 mine'>
                <h6 class='text-uppercase mb-1'>Take Survey</h6>";
                    $upit = 'SELECT * FROM anketa WHERE aktivna = 1';
                    $ankete = $konekcija->query($upit)->fetchAll();
                    foreach($ankete as $anketa):
                        echo "<div class='d-flex align-items-center mb-2'>
                            <p class='mb-md-0'>$anketa->pitanje</p>
                        </div>
                        <form method='POST' action='models/anketa.php'>";
                        $upit="SELECT * FROM odgovor";
                        $rezultat=$konekcija->query($upit);
                        $odgovori=$rezultat->fetchAll();
                     
                        foreach($odgovori as $odg){
                            echo "<div class='d-flex align-items-center mb-3'>
                                    <input type='radio' value='$odg->id' name='answer'><label class='label'>$odg->odg</label>
                                </div>";
                        }
                    endforeach;
                    echo "<input type='hidden' id='idK' name='idK' value='$id'/>
                    <input type='submit' id='btnAnketa' class='btn btn-primary' name='btnAnketa' value='Submit'/>
                    </form>
        </div>";
    }  
}
?>
