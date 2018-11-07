<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width", initial-scale="1">
        <title>부트스트랩 샘플</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script> 
        // 게시판에서 사용 되는 스크립트 문을 모아둔 곳
        function go(page){
            // 각 버튼별 이동 페이지 지정.
            if(page=='login'){
                //로그인 버튼
                window.open('loginForm.php','','width=300,height=250,scrollbars=no,resizable=no'); 
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
    <style>
	    #ralgin { text-align: right; }
        a:hover{
            text-decoration:none;
        }
    </style>
    </head>
    <body>
        <style type="text/css">
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
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
        <div class="cotainer">
            <div id="ralgin">
            <?php
            session_start();
            if(isset($_SESSION["name"])){
                // 세션에 name 라는 이름의 데이터가 있다면
                // 즉 로그인이 되어있는 상태라면
                // ~~님 환영합니다 와 로그아웃,회원정보 수정 버튼 제공
            ?>
            <h6><?=$_SESSION["name"]?>님 환영합니다</h6>
            <button class="btn btn-primary" onclick="go('logout')">로그아웃</button>
            <button class="btn btn-danger" onclick="go('update')">회원정보수정</button>
            <?php
                }else{
                // 아니면 로그인,회원가입 버튼 제공
            ?>
            <button class="btn btn-primary" onclick="go('login')">로그인</button>
            <button class="btn btn-danger" onclick="go('join')">회원가입</button>
            <?php
            }
            ?>
            </div>
        </div>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">메인페이지 입니다</h1>
                <p class="text-center">꾸미는건 차후에 하겠죠?</p>
            </div>
        </div>
        <footer sytle="background-color: #ffffff; color:#ffffff">

            <div class="container">
                <br>
                <div class="row">
                        <div class="list-group"> 
                    </div>
                </div>
                <div class="col-sm-2"><h4 style="text-align:center;"><span class="glyphicon glyphicon-ok"></span></h4></div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>