<?php
    require_once("require/tools.php");
    require_once("require/CommentDao.php");
    session_start();
    $cdao=new CommentDao();
    $num=issetrequest("num");
    $content=issetrequest("comment");
    $cdao->commentInsert($num,$_SESSION["name"],$content);
    alertGo("됫네요","view.php?num=$num");
?>