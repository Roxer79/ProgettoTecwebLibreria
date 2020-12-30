<?php

session_start();

include('controlUrl.php');
include('funzioneSostituisciEn.php');

$location = '';
$bool = false;

if(controlUrl()) {

    if(!empty($_POST["commento"])) {

        include('connessioneDatabase.php');

        $utente = $_SESSION["username"];
        $id = $_POST["idcommento"];
        $commento = strip_tags($_POST["commento"]);

        $commento = sostituisciEn($commento);

        $commento = mysqli_real_escape_string($connessioneDatabase, $commento);
        $data = date("Y-m-d H:i:s");

        $query_aggiungiCommento = "UPDATE commento SET testo = '$commento', data_ora = '$data' WHERE ID = '$id'";

        if($bool = mysqli_query($connessioneDatabase, $query_aggiungiCommento)) $location = 'Location: indgen.php?pagina=recensioni&rece=modificatasi';
        else $location = 'Location: ../HTML/erroreDatabase.html';

        mysqli_close($connessioneDatabase);

    } else {

        $bool = true;

    }

    if($bool) $location;
    else $location = 'Location: ../HTML/erroreDatabase.html';


} else {

    if(isset($_SESSION["username"]) && $_SESSION["username"]) $location = 'Location: indgen.php';
    else $location = 'Location: logOut.php';

}

header($location);
exit();

?>
