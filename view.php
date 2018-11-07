<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
        require_once("require/tools.php");
        require_once("require/BoardDao.php");
        require_once("require/CommentDao.php");
        require_once("smarteditor/workspace/upload/uploadDao.php");
        session_start();
        $num=issetrequest("num");
    ?> 
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
            function insertcomment(){
                window.open('loginForm.php','','width=300,height=200,scrollbars=no,resizable=no,location=no');
            }
        </script>
</head>
<body> 
    <style type="text/css">
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
    <?php
        $bdao = new BoardDao();
        $id=$_SESSION["id"];
        $msg=$bdao->getMsg($num);
        if(!isset($_SESSION["name"])){
            alertback("로그인하세욧!");
        }
        $bdao->hIncrement($num,$id);
        ?>
        <div class="container">
        <table class="table">
            <tr>
                <th>제목</th>
                <td><?=$msg["title"]?></td>
                <?php if($_SESSION["id"]=='admin') : ?>
                <td>이 게시글을 공지로 등록 <br><pre>         <input type="checkbox" name="notice"></pre></td>
                <?php endif  ?>
            </tr>
            <tr>
                <th>작성자</th>
                <td><?=$msg["writer"]?></td>
            </tr>
            <tr>
                <th>작성일시</th>
                <td><?=$msg["regtime"]?></td>
            </tr>
            <tr>
                <th>조회수</th>
                <td><?=$bdao->hitsGet($msg["num"])?></td>
            </tr>
            <?php 
            $udao= new uploadDao();
            $filelist=$udao->getFileList($num);
            $file=$udao->getFile($num);
            if($filelist){
                ?>
                <tr>
                    <th>첨부파일</th>
                    <td><a href="files/<?=$file['fname']?>">
                    <?=$file['fname']?></a></td>
                </tr>
                <?php
            } 
            ?>
            <tr>
                <th>내용</th>
                <td><?=$msg["content"]?></td>
            </tr>
        </table>
        <!-- 게시글의 정보를 table 형식으로 만든 표에 넣어줌-->
    </div>
    <input type="button" class="btn btn-primary" onclick="location.href='board.php'" value="목록보기">
    <?php if($msg["writer"]==$_SESSION["name"] ||$_SESSION["id"]=="admin") :?>
    <input type="button" class="btn btn-success" onclick='modify(<?=$msg["num"]?>,"<?=$msg["writer"]?>")' value="수정하기">
    <input type="button" class="btn btn-danger" onclick='delreq(<?=$msg["num"]?>,"<?=$msg["writer"]?>")' value="삭제하기">
    <?php endif ?>    

        <!-- 목록으로 가기 수정하기 삭제하기 버튼 -->    
        <form method="post" action="insertcomment.php?num=<?=$num?>">
        <textarea class="form-control" rows="3" id="comment"name="comment" required></textarea>
        <input type="submit" value ="댓글등록">
    </form>
    <?php
        $cdao = new CommentDao();
        $count=$cdao->countOfComment($num);
        $msg=$cdao->commentsGet($num);
        ?>
        <div class="container">
        <h6>댓글란 </h6>
        <table class="table">
            <tr>
                <th>작성자</th>
                <th>덧글 내용</th>
                <th>작성일시</th>
            </tr>
            <?php foreach($msg as $msgs) : ?>
            <tr>
                <td><?=$msgs["writer"]?></td>
                <td><?=$msgs["content"]?></td>
                <td><?=$msgs["regtime"]?></td>
            </tr>
            <?php endforeach  ?>
        </table>

</body>
</html>