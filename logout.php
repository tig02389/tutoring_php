<?php
    require_once("require/tools.php");
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    // $tu=combineUrl("index.php","","");
    header("Location: index.php");
    // justback();

?>