<?php
include_once "../setup/konekcija.php";

$brojPoStrani = 10;
isset($_GET["strana"]) ? $strana=$_GET["strana"] : $strana=0;
$start = 0;
$zahtev = "WHERE 1";

if($strana>0){
    $start=($strana*$brojPoStrani)-$brojPoStrani;
}
else{
	$start=0;
}

if (isset($_GET["kat_id"]) || isset($_GET["search"])) {
    $search = $_GET["search"];
    if ($_GET["kat_id"] != 0 ) {
        $zahtev = "WHERE id_kategorija=".$_GET["kat_id"];
    } 

    if ($_GET["search"] != "") {
        $zahtev = "WHERE naziv LIKE '%$search%'";
    }

    if ($_GET["kat_id"] != 0 && $_GET["search"] != "") {
        $zahtev = "WHERE id_kategorija=".$_GET["kat_id"] . " AND naziv LIKE '%$search%'";
    }
} else {
    $zahtev = "WHERE 1";
}

if (isset($_GET["sort"])) {
    $sort = $_GET["sort"];
    switch ($sort) {
        case 1 : $upit = "SELECT * from proizvodi {$zahtev} ORDER BY cena LIMIT {$start}, {$brojPoStrani}";
        break;
        case 2 : $upit = "SELECT * from proizvodi {$zahtev} ORDER BY cena DESC LIMIT {$start}, {$brojPoStrani}";
        break;
        case 3 : $upit = "SELECT * from proizvodi {$zahtev} ORDER BY naziv LIMIT {$start}, {$brojPoStrani}";
        break;
        case 4 : $upit = "SELECT * from proizvodi {$zahtev} ORDER BY naziv DESC LIMIT {$start}, {$brojPoStrani}";
        break;
        default: $upit = "SELECT * from proizvodi {$zahtev} LIMIT {$start},{$brojPoStrani}";
        break;
    }
} else {
    $upit = "SELECT * from proizvodi {$zahtev} LIMIT $start,$brojPoStrani";
}

$rezultat = $konekcija->query($upit, PDO::FETCH_OBJ)->fetchAll();
echo json_encode($rezultat);
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}