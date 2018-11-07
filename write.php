<?php
    require_once("require/tools.php");
    require_once("require/BoardDao.php");

    session_start();
    $title =issetrequest("title");
    $writer=$_SESSION["name"];
    $content=issetrequest("content");

    $dao = new BoardDao();
    
    $dao->insertMsg($writer,$title,$content);

    alertGo("글이 등록 되었습니다","board.php");
?>