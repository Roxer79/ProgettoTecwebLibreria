<?php

session_start();

include('controlUrlPageout.php');

$location = '';
$bool = true;

if(controlUrlPageout()) {

    if(!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) $location = 'Location: profilo.php?error=email';
    elseif(!empty($_POST["password"]) && empty($_POST["ripetiPassword"])) $location = 'Location: profilo.php?error=rippass';
    elseif($_POST["password"] != $_POST["ripetiPassword"]) $location = 'Location: profilo.php?error=diffpass';
    else {

        include('connessioneDatabase.php');

        $username = $_SESSION["username"];

        $password = $_POST["password"];
        $email = $_POST["email"];

        //controllo che non esista già email o la password
        $query_controllo = "SELECT * FROM utente WHERE email = '$email' OR (username = '$username' AND password = '$password')";

        if($controllo = mysqli_query($connessioneDatabase, $query_controllo)) {

            while(($risultatiControllo = mysqli_fetch_assoc($controllo)) && $bool) {

                if($risultatiControllo["email"] == $_POST["email"]) {
                    $bool = false;
                    $location = 'Location: profilo.php?error=email';
                } elseif($risultatiControllo["password"] == $_POST["password"]) {
                    $bool = false;
                    $location = 'Location: profilo.php?error=doppiapass';
                } else {
                    $bool = true;
                }

            }

            mysqli_free_result($controllo);

        } else {

            $bool = true;

        }

        $query_profilo = '';
        if($email == "") $query_profilo = "UPDATE utente SET password = '$password' WHERE username = '$username'";
        elseif($password == "") $query_profilo = "UPDATE utente SET email = '$email' WHERE username = '$username'";
        else $query_profilo = "UPDATE utente SET email = '$email', password = '$password' WHERE username = '$username'";

        if($bool && ($bool = mysqli_query($connessioneDatabase, $query_profilo))) $location = 'Location: profilo.php?error=general';
        elseif($location != "") $location;
        else $location = 'Location: ../HTML/erroreDatabase.html';

        mysqli_close($connessioneDatabase);

    }

} else {

    $location = 'Location: ../HTML/outPage404.html';

}

header($location);
exit();

?>
