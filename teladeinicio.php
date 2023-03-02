<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("location: index.php");
        exit;
    }
?>


Seja bem vindo!!!
<a href="sair.php">Sair</a>