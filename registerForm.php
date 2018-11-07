<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <style>
	    #ralgin { text-align: right; }
	    #calgin { text-align: center; }
        a:hover{
            text-decoration:none;
        }
    </style>
    <script>
        function eMailCheck(){
            window.open("eMailCheck.php",'','width=300,height=200,scrollbars=no,resizable=no'); 
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-yellow bg-dark">
            <a class="navbar-brand" style="color:white">Term Project</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="board.php">게시판</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                    미니게임
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="https://www.naver.com">핵맨</a>
                    <a class="dropdown-item" href="https://www.naver.com">카드 뒤집기</a>
                    <a class="dropdown-item" href="chrome://dino/">디노 크롬<a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <h2> 회원가입 </h2>
    <form method="post" action="register.php" >
    <pre>
        id &nbsp; : <input type="text" name="rhopeid" required><br>
        pw &nbsp; : <input type="password" name="rhopepw" required><br>
        이름 : <input type="text" name="rhopename" required><br>
        주소 : <input type="text" name="rhopeaddr" required><br>
        E-mail <input type="email" id="emailbox" name="rhopeemail" required readonly> 
        <input type="button" onclick="eMailCheck()" value="메일인증"><br>
        취미 :
        <input type="checkbox" name="rhopehobby[]" value="독서">독서 
        <input type="checkbox" name="rhopehobby[]" value="게임">게임 
        <input type="checkbox" name="rhopehobby[]" value="낚시">낚시 
        <input type="checkbox" name="rhopehobby[]" value="쇼핑">쇼핑
        <input type="checkbox" name="rhopehobby[]" value="영화">영화
        <input type="checkbox" name="rhopehobby[]" value="운동">운동
        <input type="checkbox" name="rhopehobby[]" value="여행">여행
        <input type="checkbox" name="rhopehobby[]" value="음악감상">음악감상
        기타 취미 : <input type="text" name="rhopehobby[]">
        <br>
        <input type="submit" value="회원가입">
        </pre>
    </form>
</body>
</html>