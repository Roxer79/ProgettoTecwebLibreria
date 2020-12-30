<?php

include('controlUrlPageout.php');

$formSignup = '';

if(controlUrlPageout()) {

    $formSignup = file_get_contents('../HTML/signup.html');

    if(isset($_GET["error"]) && $_GET["error"] == 'username') $formSignup = str_replace('$ERROREFORMSIGNUP$', '<p class="avviso_php"><span xml:lang="en">Username</span> già utilizzato, inserisci un altro <span xml:lang="en">username</span>.</p>', $formSignup);

    elseif(isset($_GET["error"]) && $_GET["error"] == 'email') $formSignup = str_replace('$ERROREFORMSIGNUP$', '<p class="avviso_php"><span xml:lang="en">Email</span> errata o già usata, inserisci un\'altra <span xml:lang="en">email</span>.</p>', $formSignup);

    elseif(isset($_GET["error"]) && $_GET["error"] == 'rippass') $formSignup = str_replace('$ERROREFORMSIGNUP$', '<p class="avviso_php"><span xml:lang="en">Password</span> di conferma non inserita.</p>', $formSignup);

    elseif(isset($_GET["error"]) && $_GET["error"] == 'diffpass') $formSignup = str_replace('$ERROREFORMSIGNUP$', '<p class="avviso_php">Ripeti <span xml:lang="en">password</span> errata.</p>', $formSignup);

    elseif(isset($_GET["error"]) && $_GET["error"] == 'general') $formSignup = str_replace('$ERROREFORMSIGNUP$',  '<p class="avviso_php">Non tutti i campi dati sono stati compilati correttamente</p>', $formSignup);

    else $formSignup = str_replace('$ERROREFORMSIGNUP$', '', $formSignup);


} else {

    $formSignup = file_get_contents('../HTML/outPage404.html');

}

echo $formSignup;

?>
