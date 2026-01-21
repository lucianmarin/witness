<?php
    ini_set('display_errors', 1);

    setcookie('user', '', 1, '/');
    setcookie('theme', '', 1, '/');

    header('Location: /notes/');
    exit;
?>
