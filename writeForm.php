<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="smarteditor/workspace/js/service/HuskyEZCreator.js" charset="utf-8"></script>
<script>
$(function(){
    //전역변수선언
    var editor_object = [];
     
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: editor_object,
        elPlaceHolder: "content",
        sSkinURI: "smarteditor/workspace/SmartEditor2Skin.html",
        htParams : {
            // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseToolbar : true,            
            // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseVerticalResizer : true,    
            // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
            bUseModeChanger : true,
        }
    });
     
    //전송버튼 클릭이벤트
    $("#savebutton").click(function(){
        //id가 content인 textarea에 에디터에서 대입
        editor_object.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
         
        try{
            $("#frm").submit();
        }catch(e){}
    })
})
</script>
<body>
<?php session_start();
require_once("require/tools.php");
    if(!isset($_SESSION["id"])){
        alertback("로그인하세요");
    }
?>
    <h2> 글쓰기 폼 예제 </h2>
    <form action="write.php" method="post" id="frm">
        제목 <input type="text" name="title" value="글의 제목을 입력하세요"><br>
        작성자 <input type="text" name="writer" value="<?=$_SESSION['name']?>" disabled><br>
        글 내용 <br>
    <textarea name="content" id="content" rows="10" cols="100" style="width:100%;"></textarea>
    <input type="button" id="savebutton" value="게시글 등록" />
</form>
</body>
</html>