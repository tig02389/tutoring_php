<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once("require/tools.php");
        require_once("require/MemberDao.php");
        session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
	    #ralgin { text-align: right; }
        a:hover{
            text-decoration:none;
        }
    </style>
        <script>
        // 게시판에서 사용 되는 스크립트 문을 모아둔 곳
        function go(page){
            // 각 버튼별 이동 페이지 지정.
            if(page=='login'){
                //로그인 버튼
                window.open('loginForm.php','','width=300,height=200,scrollbars=no,resizable=no,location=no'); 
                // location.href="loginForm.php";
            }
            if(page=='join'){
                // 회원가입 버튼
                location.href="registerForm.php";
            }
            if(page=='logout'){
                // 로그아웃 버튼
                location.href="logout.php";
            }
            if(page=='update'){
                // 회원정보 수정 버튼
                location.href="update_check.php";
            }
        }
    </script>
</head>
<body> <style type="text/css">
        .jumbotron {
            background-image: url(image/jumbotronBackground.jpg);
            background-size: cover;
            text-shadow: black 0.2em 0.2em 0.2em;
            color: white;
        }
        </style>
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
                    <a class="dropdown-item" href="chrome://dino">디노 크롬<a>
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

    <div class="cotainer">
    <h2>회원정보 수정</h2>
    <?php
        $mdao=new MemberDao();
        $mInfo=$mdao->mGet($_SESSION["id"]);
    ?>
    <form action="memberDateUpdate.php" method="post">
        <pre>
            id &nbsp; : <input type="text" name="rhopeid" value="<?=$_SESSION['id']?>"><br>
            pw &nbsp; : <input type="password" name="rhopepw"><br>
            이름 : <input type="text" name="rhopename" value="<?=$_SESSION['name']?>"><br>
            주소 : <input type="text" name="rhopeaddr" value="<?=$mInfo['addr']?>"><br>
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
            <input type="submit" value="회원정보 수정">
        </pre>
    </form>

</body>
</html>