<?php

session_start();

include('assembloMetaTitolo.php');
include('assembloHeader.php');
include('controlUrl.php');
include('assembloMenu.php');
include('assembloBreadcrumb.php');
include('assembloBody.php');

$index = file_get_contents('../HTML/index.html');

$header = assembloHeader();
$index = str_replace('$HEADER$', $header, $index);

$metaTitolo = '';
$menu = '';
$breadcrumb = '';
$body = '';

//controllo per come assemblare header e menù
if(controlUrl()) {

    $metaTitolo = assembloMeta(true);
    $menu = assembloMenu(true);
    $breadcrumb = assembloBreadcrumb(true);
    $body = assembloBody(true);

} else {

    $metaTitolo = assembloMeta(false);
    $menu = assembloMenu(false);
    $breadcrumb = assembloBreadcrumb(false);
    $body = assembloBody(false);

}

$index = str_replace('$METATITOLO$', $metaTitolo, $index);
$index = str_replace('$MENU$', $menu, $index);
$index = str_replace('$BREADCRUMB$', $breadcrumb, $index);
$index = str_replace('$BODY$', $body, $index);

echo $index;

?>
