<?php
include_once "../setup/konekcija.php";
include_once "functions.php";
$brojPoStrani = 10;
$ukupno = brojProizvoda();

if (isset($_GET["kat_id"]) || isset($_GET["search"]))  {
    $kategorijaId = $_GET["kat_id"];
    $search = $_GET["search"];

    if (is_numeric($kategorijaId) && $kategorijaId > 0) {
        $countUpitKat = "SELECT COUNT(*) AS brojProizvoda from proizvodi WHERE id_kategorija =:kategorijaId";
        $pripremaKat = $konekcija->prepare($countUpitKat);
        $pripremaKat->bindParam(":kategorijaId", $kategorijaId);
        
        $rezultatCountKat = $pripremaKat->execute();
        $rezultat = $pripremaKat->fetch(); 
        $brojRezKat = $rezultat->brojProizvoda;
        $ukupno = $brojRezKat;
    }

    if($search != "") {
        $countUpitSearch = "SELECT COUNT(*) AS brojProizvoda FROM proizvodi WHERE naziv LIKE :search";
        $pripremaSearch = $konekcija->prepare($countUpitSearch);
        $pripremaSearch->bindValue(":search", "%" . $search . "%");

        $rezultatCountSearch = $pripremaSearch->execute();
        $rezultat = $pripremaSearch->fetch();
        $brojRezSearch = $rezultat->brojProizvoda;
        $ukupno = $brojRezSearch;
    } 

    if(is_numeric($kategorijaId) && $kategorijaId > 0 && $search != ""){
        $countUpitAll = "SELECT COUNT(*) AS brojProizvoda from proizvodi WHERE id_kategorija = :kategorijaId AND naziv LIKE :search";
        $pripremaAll = $konekcija->prepare($countUpitAll);

        $pripremaAll->bindValue(":kategorijaId", $kategorijaId);
        $pripremaAll->bindValue(":search", "%" . $search . "%");
        
        $rezultatCountAll = $pripremaAll->execute();
        $rezultat = $pripremaAll->fetch();
        $brojRezAll = $rezultat->brojProizvoda;
        $ukupno = $brojRezAll;
    }

    $ukupno = ceil($ukupno / $brojPoStrani);

} else {
    $ukupno = brojProizvoda();
}

echo "<ul id='stilPaginacija'>";
	for($i=1;$i<$ukupno+1;$i++){
		echo "<li  class='pag'><a class='promenaStrane' data-id='$i' href='index.php?page=product&strana=$i'>$i</a></li>";
	}
	echo "</ul>";

?>