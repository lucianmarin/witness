<?php
    $password = '95192c98732387165bf8e396c0f2dad2';

    if (md5($_GET['key']) === $password) {
        setcookie('user', $password, time() + (3600 * 24 * 365), '/');
    }

    if ($_GET['theme'] === 'white') {
        setcookie('theme', 'white', time() + (3600 * 24 * 365), '/');
    }

    if ($_GET['theme'] === 'black') {
        setcookie('theme', 'black', time() + (3600 * 24 * 365), '/');
    }

    if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER'] != "") {
        $url = $_SERVER['HTTP_REFERER'];
    } else {
        $url = "/notes/";
    }

    header("Location: ".$url);
    exit;
?>
