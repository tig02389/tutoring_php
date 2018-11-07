<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
            var text = "";
        
        var check = 0;
        function test(){   
            if(check==0){
                check =1;
                mailsome1();
                var charter=document.getElementById("SecurityCharacter");
                var textbox = document.createElement("input");
                var chechElement = document.createElement("input");
                textbox.setAttribute("type","text");
                textbox.setAttribute("id","SecurityBox");
                charter.appendChild(textbox);
                chechElement.setAttribute("type","button");
                chechElement.setAttribute("value","문자 확인");
                chechElement.setAttribute("onclick","checkElements()");
                charter.appendChild(chechElement);
            }
        }
        function checkElements(){
            var textfelid = document.getElementById("SecurityBox").value;
            if(textfelid==text){
                alert("보안 문자가 확인 되었습니다.");
                var email= document.getElementById("emailbox");
                opener.document.getElementById("emailbox").value=email.value;
                window.close();
            }else{
                alert("문자열을 다시 확인하세요");
            }
        }
        function mailsome1(){
            var email= document.getElementById("emailbox");
            var rand=makeid();
            window.open("test.php?addr="+email.value+"&text="+rand,'','width=300,height=200,scrollbars=no,resizable=no');
        }
        function makeid(){
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_)+-=[];',./`~";

            for( var i=0; i < 5; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }
    </script>
</head>
<body>
    <h2>Email 검사</h2>
    <h4>네이버 메일만 가능합니다<h4>
        E-mail <input type="email" id="emailbox" required> 
        <input type="submit" value="메일 확인" onclick="test()">
    <div id ="SecurityCharacter">
    보안문자 입력 : 
    </div>
</body>
</html>