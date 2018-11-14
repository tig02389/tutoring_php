<?php
    define("MainPage","board.php");   // 메인페이지 지정
    define("NUMLINES",10);  // 한 페이지에 출력할 게시글 수
    define("NUMPAGELINKS",5); // 한 페이지에 출력할 페이지 링크 수
    // NUM_PAGE_LINKS = (5){startPage=1, 6, 11, 16, ...}
    // NUM_PAGE_LINKS = (10){startPage=1, 11, 21, 31, ...}
    function issetrequest($name){
        // 겟 혹은 포스트 방식으로 $name이라는 이름으로 넘어 오는 값이 실제로 있는지 확인
        return isset($_REQUEST[$name])?$_REQUEST[$name]:"";
        // 있다면 그 값을 리턴하고 없다면 공란을 리턴
    }
    function alertback($message){
        // 에러가 생기면 에러 메세지를 경고창에 띄워준 후 이전 페이지로 돌아감
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
        </head>
        <body>
            <script>
                alert("<?=$message?>");
                history.back();
            </script>
        </body>
        </html>
<?php
        exit();
    }
    function justBack(){
        // 그냥 뒤로 돌아감
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
        </head>
        <body>
            <script>
                history.back();
            </script>
        </body>
        </html>
        <?php
    }
    function alertClose($msg){
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
            </head>
            <body>
            <script>
            opener.parent.location.reload();
                alert("<?=$msg?>");
                window.close();
            </script>
            </body>
        </html>
        <?php
                exit();
    }
    function alertGo($msg,$url){
        // 특정 메세지를 띄우고 특정 창으로 이동
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
        </head>
        <body>
            <script>
                alert("<?=$msg?>");
                location.href="<?=$url?>";
            </script>
        </body>
        </html>
<?php
        exit();
    }
    function combineUrl($file,$num,$page){
        $join="?";
        if($num){
            $file .=$join."num=$num";
            $join = "&";
        }
        if($page){
            $file .=$join."page=$page";
        }
        return $file;
    }
?>