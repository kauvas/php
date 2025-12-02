<?php

session_start();


if(!isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
    session_destroy();
    header('location: index.php');
}

if(!isset($_SESSION['cpf']) || $_SESSION['cpf'] == '') {
    session_destroy();
    header('location: index.php');
}

if(!isset($_SESSION['senha']) || $_SESSION['senha'] == '') {
    session_destroy();
    header('location: index.php');
}