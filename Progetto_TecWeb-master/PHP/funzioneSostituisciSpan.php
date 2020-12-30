<?php

function sostituisciSpan($parola) {

    while(strpos($parola, '<span xml:lang="en">') !== false) {

        $parola = str_replace('<span xml:lang="en">', '[en]', $parola);

    }

    while(strpos($parola, '</span>') !== false) {

        $parola = str_replace('</span>', '[/en]', $parola);

    }

    return $parola;

}

?>
