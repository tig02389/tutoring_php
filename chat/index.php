<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>    
    <?php
        setcookie("test","test",time()+300);

    ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        var getCookie = function(name) {
            var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return value? value[2] : null;
        };
        $(document).ready(function() {
            $("#btn1").click(function() {
                var result = document.getElementById('ajaxValue');
                var chat = parent.document.getElementById('chatbox');
                $.ajax({
                    // 상대방 문장
                    success : function(data) {
                        
                        var btn = document.getElementById('body');
                        var targetname = document.createElement("div");
                        targetname.setAttribute('id','anoname');
                        targetname.setAttribute('style','text-align:left; background-color:yellow')
                        
                        targetname.innerHTML = getCookie('test');
                        parent.testform.appendChild(targetname);
                        //parent.testform.targetname.innerHTML=Date.now();
                    },
                    error : function(e) {
                        console.log(e.responseText);
                    }
                });
            });
        });
        $(document).ready(function(){
            $("#btn2").click(function(){
                alert(getCookie('test'));
            });
        });
    </script>
</head>
<body id='body'>
    <button id="btn1">asd</button>
    <button id="btn2">dsa</button>
</body>
</html>