<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        mark.test{background-color:cyan}
        #anomessage{text-align:left; background-color:yellow}
        #anoname{font-size:20px;border:0;}
        #mymessage{text-align:right; background-color:cyan}
        #hiddenif{width:100; height:100; border:1;}
        #asd{border:0;}
    </style>
    <script>
        function sample(){
            var t = document.getElementsById("anoname");
            var f = document.createElement("div");
            f.setAttribute("id","test");
            f.innerHTML("asd");
            t.value="1q2w3e4r";
            t.appendChild(f);
        }
    </script>
</head>
<body>
    <iframe src="iframe.html" id="hiddenif"> </iframe>
    <form id="testform">
        <mark class="test" id="anomessagea" >a b c</mark>
        <button id="testbtn" onclick=sample()>test</button>
        <input id="anoname" value="ab" readonly>    
        <div id="chatbox">
            <div id="anomessage">
                <div id="anoname">상대방 이름 : </div>
                <ul>상대방의 문장</ul>
            </div>
            <div id="mymessage">
                <ul>내가말한 문장</ul>
        </div>    
        <button class="test" id='mtest'>1</button>
    </div>
    </form>

</body>
</html>