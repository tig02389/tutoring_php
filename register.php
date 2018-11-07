<?php
    require_once("require/tools.php");
    require_once("require/MemberDao.php");
    $mdao=new MemberDao();
    $id=issetrequest("rhopeid");
    $pw=issetrequest("rhopepw");
    $name=issetrequest("rhopename");
    $addr=issetrequest("rhopeaddr");
    $email=issetrequest("rhopeemail");
    $hobby=issetrequest("rhopehobby");
    $mdao->Minsert($id,$pw,$name,$addr,$email);
    $i=0;
    $issethobby=isset($hobby[0]);
    while($issethobby){
        $issethobby=isset($hobby[$i]);
        $mdao->Hinsert($id,$hobby[$i]);
        $i++;
    }
    alertGo("회원가입 완료!","index.php");
?>