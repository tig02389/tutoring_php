<!DOCTYPE html>
<html lang="en">
<head>
    <?php
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
                location.href="memberDataUpdateForm.php";
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
    <h2>게시글 리스트</h2>
    <div id="ralgin">
    <?php
    if(isset($_SESSION["name"])){
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
    <?php
        require_once("require/tools.php");
        // 툴에 있는 메서드들을 사용하기 위해서
        require_once("require/BoardDao.php");
        // 게시글 목록을 불러 오려면 Dao 상에 존재하는 getManyMsgs()를 써야함
        /*
            현재 페이지 번호를 받아온다.  currentpage
            각 페이지에 첫번째 게시글의 번호를 지정한다. start
            start 를 기준으로 출력하기로 한 숫자 만큼의 게시글을 불러온다 msgs
            총 게시글 갯수를 받아온다.  totalCount
            총글수 / 페이지에 출력할 게시글 수 의 값을 올림처리 해서 몇 페이지 까지 있는지를 지정한다. numpage
            다시한번 현재 페이지 값의 유효성을 검사한다 1보다 작을때, numpage 보다 클때 등.
            
        */
        $currentpage=issetrequest("page");
        if($currentpage<1){
            $currentpage=1;
        }
        $dao=new BoardDao();
        $start=($currentpage-1)*NUMLINES;
        $numOfNotice = $dao->getNoticeNum();
        $msgs=$dao->getManyMsgs($start,$numOfNotice);
        $totalCount=$dao->getNumMsgs();
        if($totalCount>0){
            $numPage=ceil($totalCount/NUMLINES);
            if($currentpage>$numPage){
                $currentpage=$numPage;
            }
        }
        if($totalCount>0){
            // 게시글이 하나도 없으면
        }else{
            echo "<h1>등록된 게시글이 없습니다.</h1>";
            ?>
            <input type="button" class="btn btn-dark" onclick="location.href='writeForm.php'" value="글쓰기">
            <?php
            exit();
        }
        $startPage=floor(($currentpage-1)/NUMPAGELINKS)*NUMPAGELINKS+1;
        $endPage=$startPage+NUMPAGELINKS-1;
        if($endPage>$numPage){
            $endPage=$numPage+1;
        }

    ?>
    <?php if($totalCount>0) : ?>
        <table class="table table-dark table-hover">
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일시</th>
                <th>조회수</th>
            </tr>
            <?php foreach($msgs as $row) : 
                // 받아온 개시판 목록의 데이터를 각 표의 셀에 집어넣어줌
                ?>
                <tr>
                    <td><?=$row["num"]?></td>
                    <td><a href="view.php?num=<?=$row['num']?>"><?=$row["title"]?></a></td>
                    <td><?=$row["writer"]?></td>
                    <td><?=$row["regtime"]?></td>
                    <td>
                        <?php
                            $a=$dao->hitsGet($row["num"]);
                            if($a==0){
                                echo "0";
                            }else{
                                echo "$a";
                            }
                        ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php if($startPage>1) : ?>
            <a href='<?=combineUrl("board.php",0,$currentpage-NUMPAGELINKS)?>' ><</a>&nbsp;
        <?php endif?>
        <?php for($i=$startPage;$i<=$endPage-1;$i++) : ?>
            <?php if($i==$currentpage) : ?>
                <a href="<?=combineUrl('board.php',0,$i)?>"><b><?=$i?></b></a>&nbsp;
            <?php else : ?>
                <a href="<?=combineUrl('board.php',0,$i)?>"><?=$i ?></a>&nbsp;
            <?php endif ?>
        <?php endfor ?>

        <?php if($endPage<$numPage) : ?>
            <a href="<?=combineUrl('board.php',0,$startPage+NUMPAGELINKS)?>">></a>
        <?php endif ?>
    <?php endif ?>
    <br>
    <br>
    <input type="button" class="btn btn-dark" onclick="location.href='writeForm.php'" value="글쓰기">
</body>
</html>