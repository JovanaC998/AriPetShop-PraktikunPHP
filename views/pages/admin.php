<?php
include_once "models/functions.php";
if (isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->id_uloga == 2) {
echo"
<body>
      <!-- about Start -->
      <div class='container py-5 moja'>
         <div class='row'>
            <div class='border-start border-5 border-primary ps-5 mb-5' style='max-width: 600px;'>
               <h6 class='text-primary text-uppercase'>Informations About Website Data</h6>
               <h1 class='display-5 text-uppercase mb-0'>Admin Panel</h1>
            </div>
            <div>
            <h3 class='nasloviAdmin'>Products</h3>
            <table class='tabelaProizvodi'>
                                    <tr>
                                        <th class='tabelaIdProizvodi'>Id</th>
                                        <th class='tabelaNazivProizvodi'>Name</th>
                                        <th class='tabelaCenaProizvodi'>Price</th>
                                        <th class='tabelaPutanjaSlikeProizvodi'>Image</th>
                                        <th class='tabelaIdProizvodi'>On Sale</th>
                                        <th class='tabelaKategodijaProizvodi'>Category Name</th>
                                        <th class='taster'>Update</th>
                                        <th class='taster'>Delete</th>
                                    </tr>";
                                        $upit = "SELECT *,p.id as pId, p.naziv as nazivP, k.naziv as nazivK FROM proizvodi as p INNER JOIN kategorija as k ON p.id_kategorija=k.id ORDER BY p.id";
                                        $proizvodi = $konekcija->query($upit);

                                        foreach($proizvodi as $proizvod){
                                            echo "<tr>
                                            <td class='tabelaIdProizvodi'>$proizvod->pId</td>
                                            <td class='tabelaNazivProizvodi'>$proizvod->nazivP</td>
                                            <td class='tabelaCenaProizvodi'>$proizvod->cena</td>
                                            <td class='tabelaPutanjaSlikeProizvodi'>$proizvod->slika</td>
                                            <td class='tabelaIdProizvodi'>$proizvod->istaknut</td>
                                            <td class='tabelaKategodijaProizvodi'>$proizvod->nazivK</td>
                                            <td class='taster'><a href='index.php?page=izmeni&id=$proizvod->pId'><button class='btn btn-primary' type='submit' name='izmeni'>Update</button></a></td>
                                            <td class='taster'><a href='models/izbrisi.php?id=$proizvod->pId'><button class='btn btn-primary' type='submit' name='izbrisi'>Delete</button></a></td>
                                            </tr>";
                                        }
                                echo "</table> 
                                <h3 class='nasloviAdmin'>New Proudct</h3>
                                <form action='models/unesi.php' name='formaDodaj'  method='POST' enctype='multipart/form-data'>
                                <table class='insertTabela'>
                                    <tr>
                                        <td>Name:</td>
                                        <td><input type='text' required pattern='^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11})*$' title='Example: Royal Canin' name='naziv'></td>
                                    </tr>
                                    <tr>
                                        <td>Price:</td>
                                        <td><input type='number' required pattern='^\d+(.\d{1,2})?$' title='Example: 12.50' name='cena'></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td><input type='text' required title='Tell us something about your Product.' name='opis'></td>
                                    </tr>
                                    <tr>
                                        <td>On Sale:</td>
                                        <td><input type='text' required pattern='^[0-1]{1}$' title='0 OR 1' name='istaknut'></td>
                                    </tr>   
                                    <tr>
                                        <td>Previous Price <br/>(If product is on sale):</td>
                                        <td><input type='text' pattern='^\d+(.\d{1,2})?$' title='Example: 12.50' name='prethpdnaCena'></td>
                                    </tr> 
                                    <tr>
                                        <td>Image:</td>
                                        <td><input type='file' id='slika' required name='slika'></td>
                                    </tr>
                                    <tr>
                                        <td>Category:</td>
                                        <td><select class='listaKategorija' id='ddlKategorija' name='listaKategorija'>
                                        <option value='0'>Choose Category</option>";
                                        $upit2 = "SELECT * FROM kategorija";
                                        $rezultat2 = $konekcija->query($upit2);
                                        $rez2 = $rezultat2->fetchAll();
                                        foreach ($rez2 as $kat) {
                                            echo "<option value='" . $kat->id . "'>" . $kat->naziv . "</option>";
                                        }                                           
                                        echo "</select>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'><input class='btn btn-primary' id='btnUnesi' value='Insert' type='submit' name='unesi'></td>
                                        </tr>   
                                        </table>  
                                        </form>  
                                        <h3 class='nasloviAdmin'>Users</h3> 
                                        <table class='tabelaProizvodi'>
                                            <tr>
                                                <th class='tabelaIdProizvodi'>Id</th>
                                                <th class='tabelaNazivProizvodi'>First Name</th>
                                                <th class='tabelaNazivProizvodi'>Last Name</th>
                                                <th class='tabelaPutanjaSlikeProizvodi'>Email</th>
                                                <th class='tabelaPutanjaSlikeProizvodi'>Date Of Registration</th>
                                                <th class='taster'>Delete</th>
                                            </tr>";

                                            $upit3 = "SELECT * FROM korisnik WHERE id_uloga = 1";
                                            $rezultat3 = $konekcija->query($upit3);
                                            
                                            foreach ($rezultat3 as $kor) {
                                                echo "<tr>
                                                    <td class='tabelaIdProizvodi'>$kor->id</td>
                                                    <td class='tabelaNazivProizvodi'>$kor->ime</td>
                                                    <td class='tabelaNazivProizvodi'>$kor->prezime</td>
                                                    <td class='tabelaPutanjaSlikeProizvodi'>$kor->email</td>
                                                    <td class='tabelaPutanjaSlikeProizvodi'>$kor->datum_registracije</td>
                                                    <td class='taster'><a href='models/izbrisiKorisnike.php?id=$kor->id'><button class='btn btn-primary' type='submit' name='izbrisiKorisnike'>Delete</button></a></td>
                                                </tr>";
                                            }
                                            
                                            echo "</table>
                                            <h3 class='nasloviAdmin'>Number of users logged in within the last 24 hours : <span style='color:#656565;'>". brojUlogovanihKorisnikaUPoslednjih24h() .".</span></h3>                                            

                                            <h3 class='nasloviAdmin'>Blocked Users</h3> 
                                            <table class='tabelaProizvodi'>
                                                <tr>
                                                    <th class='tabelaIdProizvodi'>Id</th>
                                                    <th class='tabelaNazivProizvodi'>First Name</th>
                                                    <th class='tabelaNazivProizvodi'>Last Name</th>
                                                    <th class='tabelaPutanjaSlikeProizvodi'>Email</th>
                                                    <th class='taster'>Unblock</th>
                                                </tr>";
                                            
                                            $upit4 = "SELECT * FROM korisnik WHERE blokiran = 1";
                                            $rezultat4 = $konekcija->query($upit4);
                                            
                                            foreach ($rezultat4 as $kor) {
                                                echo "<tr>
                                                    <td class='tabelaIdProizvodi'>$kor->id</td>
                                                    <td class='tabelaNazivProizvodi'>$kor->ime</td>
                                                    <td class='tabelaNazivProizvodi'>$kor->prezime</td>
                                                    <td class='tabelaPutanjaSlikeProizvodi'>$kor->email</td>
                                                    <td class='taster'><a href='models/odblokiraj.php?id=$kor->id'><button class='btn btn-primary' type='submit' name='odblokiraj'>Unblock</button></a></td>
                                                </tr>";
                                            }
                                            
                                            echo "</table>  
                                            <h3 class='nasloviAdmin'>Statistics In Last 24 Hours</h3>
                                            <table class='tabelaProizvodi'>
                                                <tr>
                                                    <th class='tabelaNazivProizvodi'>Page</th>
                                                    <th class='tabelaNazivProizvodi'>Number of visits</th>
                                                    <th class='tabelaNazivProizvodi'>Percentage</th>
                                                </tr>";
                                            
                                            $log = fopen("data/log.txt", 'r');
                                            $redovi = file("data/log.txt");
                                            $prethodniDan = strtotime('-1 day', time());
                                            
                                            $statistika = [];
                                            $brojRedova = count($redovi);
                                            
                                            for ($i = 0; $i < $brojRedova; $i++) {
                                                $red = explode("\t", $redovi[$i]);
                                                $stranica = $red[0];
                                                $vreme = strtotime($red[1], time());
                                                if($vreme > $prethodniDan){

                                                    if (array_key_exists($stranica, $statistika)) {
                                                        $statistika[$stranica]++;
                                                    } else {
                                                        $statistika[$stranica] = 1;
                                                    }
                                                }
                                            }
                                            
                                            $ukupanBrojPoseta = array_sum($statistika);
                                            
                                            foreach ($statistika as $stranica => $brojPoseta) {
                                                $procenat = round(($brojPoseta / $ukupanBrojPoseta) * 100, 2);
                                            
                                                echo "<tr>
                                                    <td class='tabelaNazivProizvodi'>$stranica</td>
                                                    <td class='tabelaNazivProizvodi'>$brojPoseta</td>
                                                    <td class='tabelaNazivProizvodi'>$procenat%</td>
                                                </tr>";
                                            }
                                            
                                            fclose($log);
                                            
                                            echo "</table>
                                            <h3 class='nasloviAdmin'>Categories</h3> 
                                            <table class='tabelaProizvodi' id='tabelaKategorije'>
                                                <tr>
                                                    <th class='tabelaIdProizvodi'>Id</th>
                                                    <th class='naziv'>Category Name</th>
                                                    <th class='taster'>Delete</th>
                                                </tr>";
                                            
                                            $upit3 = "SELECT * FROM kategorija";
                                            $rezultat3 = $konekcija->query($upit3);
                                            
                                            foreach ($rezultat3 as $kat) {
                                                echo "<tr>
                                                    <td class='tabelaIdProizvodi'>$kat->id</td>
                                                    <td class='naziv'>$kat->naziv</td>
                                                    <td class='taster'><a href='models/izbrisiKategorije.php?id=$kat->id'><button class='btn btn-primary mojbtn' type='submit' name='izbrisiKorisnike'>Delete</button></a></td>
                                                </tr>";
                                            }
                                            
                                            echo "</table>  
                                            <h3 class='nasloviAdmin'>New Category</h3>
                                            <form action='models/unesiKategorijuTip.php' name='formaDodaj'  method='POST'>
                                                <table class='insertTabela tabelaTip'>
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td><input type='text' required pattern='^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11})*$' title='Example: Blanket' name='nazivKategorija'></td>
                                                        <td colspan='2'><input class='btn btn-primary' value='Insert' type='submit' name='unesiKategoriju'></td>
                                                    </tr>
                                                </table>  
                                            </form>";
                                            
                                            if (isset($_SESSION['alert_message'])) {
                                                echo '<script>alert("' . $_SESSION['alert_message'] . '");</script>';
                                                unset($_SESSION['alert_message']);
                                            }
                                            
                                            echo "<h3 class='nasloviAdmin'>Types</h3> 
                                            <table class='tabelaProizvodi tabelaTip'>
                                                <tr>
                                                    <th class='tabelaIdProizvodi'>Id</th>
                                                    <th class='naziv'>Typ Name</th>
                                                    <th class='taster'>Delete</th>
                                                </tr>";
                                            
                                            $upit3 = "SELECT * FROM tip";
                                            $rezultat3 = $konekcija->query($upit3);
                                            
                                            foreach ($rezultat3 as $tip) {
                                                echo "<tr>
                                                    <td class='tabelaIdProizvodi'>$tip->id</td>
                                                    <td class='naziv'>$tip->naziv</td>
                                                    <td class='taster'><a href='models/izbrisiTip.php?id=$tip->id'><button class='btn btn-primary mojbtn' type='submit' name='izbrisiKorisnike'>Delete</button></a></td>
                                                </tr>";
                                            }
                                            
                                            echo "</table>  
                                            <h3 class='nasloviAdmin'>New Type</h3>
                                            <form action='models/unesiKategorijuTip.php' name='formaDodaj'  method='POST'>
                                                <table class='insertTabela tabelaTip'>
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td><input type='text' required pattern='^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11})*$' title='Example: Rabbit' name='nazivTip'></td>
                                                        <td colspan='2'><input class='btn btn-primary' value='Insert' type='submit' name='unesiTip'></td>
                                                    </tr>
                                                </table>  
                                            </form>  
                                            <h3 class='nasloviAdmin'>Survey Results</h3> 
                                            <table class='tabelaProizvodi tabelaTip'>
                                                <tr>
                                                    <th class='naziv'>First Name</th>
                                                    <th class='naziv'>Last Name</th>
                                                    <th class='taster'>Answer</th>
                                                </tr>";
                                            
                                            $upit4 = "SELECT k.ime as ime, k.prezime as prezime, o.odg as odgovor From korisnik k inner join korisnik_odgovor ko ON k.id = ko.id_korisnika INNER join odgovor o ON ko.id_odgovora = o.id";
                                            $rezultat4 = $konekcija->query($upit4);
                                            
                                            foreach ($rezultat4 as $ank) {
                                                echo "<tr>
                                                    <td class='tabelaIdProizvodi'>$ank->ime</td>
                                                    <td class='naziv'>$ank->prezime</td>
                                                    <td class='naziv'>$ank->odgovor</td>
                                                </tr>";
                                            }
                                            
                                            echo "</table> 
                                            <h3 class='nasloviAdmin'>Messages Results</h3> 
                                            <table class='tabelaProizvodi'>
                                                <tr>
                                                    <th class='tabelaIdProizvodi'>Id</th>
                                                    <th class='naziv'>Full Name</th>
                                                    <th class='tabelaPutanjaSlikeProizvodi'>Email</th>
                                                    <th class='naziv'>Phone</th>
                                                    <th class='tabelaPutanjaSlikeProizvodi'>Message</th>
                                                    <th class='naziv'>Date of Message</th>
                                                    <th class='naziv'>Type</th>
                                                </tr>";
                                            
                                            $upit5 = "SELECT *, p.id as pId, t.id as tId FROM poruka as p INNER JOIN tip as t ON p.id_tip=t.id ORDER BY p.id";
                                            $rezultat5 = $konekcija->query($upit5);
                                            
                                            foreach ($rezultat5 as $mess) {
                                                echo "<tr>
                                                    <td class='tabelaIdProizvodi'>$mess->id_korisnik</td>
                                                    <td class='naziv'>$mess->ime_prezime</td>
                                                    <td class='tabelaPutanjaSlikeProizvodi'>$mess->email</td>
                                                    <td class='naziv'>$mess->telefon</td>
                                                    <td class='tabelaPutanjaSlikeProizvodi'>$mess->tekst_poruke</td>
                                                    <td class='naziv'>$mess->datum_poruke</td>
                                                    <td class='naziv'>$mess->naziv</td>
                                                </tr>";
                                            }
                                            
                                            echo "</table>"; 
                                        }
                                            else{
                                                echo "<h4 class='text-body m-5'>You do not have access to this page</h4>";
                                             }
                                            ?>
                                            
                                            </div>
                                            </div>
                                            </div>
                                            
                                            <!-- about End -->
                                            
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
                                            