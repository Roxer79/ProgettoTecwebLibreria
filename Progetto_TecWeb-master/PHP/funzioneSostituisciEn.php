<?php

function sostituisciEn($parola) {

    while(strpos($parola, '[en]') !== false) {

        $parola = str_replace('[en]', '<span xml:lang="en">', $parola);

    }

    while(strpos($parola, '[/en]') !== false) {

        $parola = str_replace('[/en]', '</span>', $parola);

    }

    return $parola;

}

?>
