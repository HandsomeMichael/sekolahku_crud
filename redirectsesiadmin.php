<?php

session_start();
if(!isset($_SESSION['nama']) || (!isset($_SESSION['level']) || $_SESSION['level'] !== 'operator') || !isset($_SESSION['id'])) 
{
    header("Location: index.php");
}

?>