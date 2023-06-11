<?php
require_once "config.php";
zabeleziPristupStranici();

try {
    $konekcija = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $ex){
    echo $ex->getMessage();
}


function zabeleziPristupStranici() {
    $belezenje_stranica = array(
        '/sajtPraktikumPhp/index.php?page=home',
        '/sajtPraktikumPhp/index.php?page=service',
        '/sajtPraktikumPhp/index.php?page=product',
        '/sajtPraktikumPhp/index.php?page=login',
        '/sajtPraktikumPhp/index.php?page=price',
        '/sajtPraktikumPhp/index.php?page=about',
    );

    
    $trenutna_stranica = $_SERVER['REQUEST_URI'];

    if (in_array($trenutna_stranica, $belezenje_stranica)) {
        $open = fopen(LOG_FAJL, "a");
        if ($open) {
            $date = date('d-m-Y H:i:s');
            fwrite($open, "{$_SERVER['REQUEST_URI']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
            fclose($open);
        }
    }

}
?>