<?php

session_start();

include('controlUrlPageout.php');

$profilo = '';

if(controlUrlPageout()) {

    if(isset($_SESSION["username"])) {

        $profilo = file_get_contents('../HTML/user.html');

        if(isset($_GET["error"]) && $_GET["error"] == 'email') $profilo = str_replace('$ERROREUSER$', '<p class="avviso_php"><span xml:lang="en">Email</span> errata o già usata, inserisci un\'altra <span xml:lang="en">email</span>.</p>', $profilo);

        elseif(isset($_GET["error"]) && $_GET["error"] == 'diffpass') $profilo = str_replace('$ERROREUSER$', '<p class="avviso_php">Ripeti <span xml:lang="en">password</span> errata.</p>', $profilo);

        elseif(isset($_GET["error"]) && $_GET["error"] == 'rippass') $profilo = str_replace('$ERROREUSER$', '<p class="avviso_php"><span xml:lang="en">Password</span> di conferma non inserita.</p>', $profilo);

        elseif(isset($_GET["error"]) && $_GET["error"] == 'doppiapass') $profilo = str_replace('$ERROREUSER$', '<p class="avviso_php"><span xml:lang="en">Password</span> uguale a quella attuale. Inseriscene una diversa.</p>', $profilo);

        elseif(isset($_GET["error"]) && $_GET["error"] == 'general') $profilo = str_replace('$ERROREUSER$', '<p class="avviso_php">Modifica effettuata correttamente.</p>', $profilo);

        else $profilo = str_replace('$ERROREUSER$', '', $profilo);

        $profilo = str_replace('$NOMECOGNOMEUTENTE$', $_SESSION["username"], $profilo);

        include('connessioneDatabase.php');

        $username = $_SESSION["username"];

        $query_email = "SELECT * FROM utente WHERE username = '$username'";

        if($email = mysqli_query($connessioneDatabase, $query_email)) {

            $risultatoEmail = mysqli_fetch_assoc($email);
            $profilo = str_replace('$EMAILATTUALE$', $risultatoEmail["email"], $profilo);
            mysqli_free_result($email);

        } else $profilo = file_get_contents('../HTML/erroreDatabase.html');

        mysqli_close($connessioneDatabase);

    } else {

        $profilo = file_get_contents('../HTML/outPage404.html');

    }

} else {

    $profilo = file_get_contents('../HTML/outPage404.html');

}

echo $profilo;

?>
