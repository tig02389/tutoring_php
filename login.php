<?php
    require_once("require/tools.php");
    require_once("require/MemberDao.php");

    $id=issetrequest("id");
    $pw=issetrequest("pw");

    $dao=new memberdao;

    $memberInfo=$dao->mGet($id);

    if($memberInfo["id"]){
        if($memberInfo["pw"]==$pw){
            session_start();
            $_SESSION["id"]=$id;
            $_SESSION["name"]=$memberInfo["name"];
            alertClose("로그인되었습니다","index.php");
        }
    }
    alertback("회원정보를 확인하세요");
?>