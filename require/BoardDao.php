<?php
require_once("tools.php");
    class BoardDao{
        // board 에서 작업하는 메서드들을 모아둔 클래스
        private $db;
        public function __construct(){
            // 생성자. DB와 연결하는 역할
            try{
                $this->db=new PDO("mysql:host=localhost;dbname=termproject","root","1111");
                $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        public function getNumMsgs(){
            try{
                $rows = $this->db->prepare("select count(*) from board");
                $rows->execute();
                $msg=$rows->fetchColumn();
            }catch(Exception $e){
                exit($e->getMessage());
            }
            return $msg;
        }        
        public function getNoticeNum(){
            try{
                $rows = $this->db->prepare("select count(*) from board_notice");
                $rows->execute();
                $msg=$rows->fetchColumn();
            }catch(Exception $e){
                exit($e->getMessage());
            }
            return $msg;
        }
        public function getMsgToTitle($title){
            // $title이란 제목의 게시글의 데이터를 반환함
            // write.php 에서 게시글 제목의 중복 여부를 판단
            try{
                $rows = $this->db->prepare("select * from board where title=:title");
                $rows->bindValue(":title",$title,PDO::PARAM_STR);
                $rows->execute();
                $msg=$rows->fetch(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                exit($e->getMessage());
            }
            return $msg;
        }
        public function getMsg($num){
            // $num 번의 게시글의 데이터를 반환함
            // view.php 에서 게시글의 내용을 보기 위해 사용
            try{
                $rows = $this->db->prepare("select * from board where num=:num");
                $rows->bindValue(":num",$num,PDO::PARAM_INT);
                $rows->execute();
                $msg=$rows->fetch(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                exit($e->getMessage());
            }
            return $msg;
        }
        public function getInfoMsg($num,$tar){
            // $num 번의 게시글의 데이터를 반환함
            // view.php 에서 게시글의 내용을 보기 위해 사용
            try{
                $rows = $this->db->prepare("select :target from board where num=:num");
                $rows->bindvalue(":target",$tar,PDO::PARAM_STR);
                $rows->bindValue(":num",$num,PDO::PARAM_INT);
                $rows->execute();
                $msg=$rows->fetchColumn(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                exit($e->getMessage());
            }
            return $msg;
        }
        
        public function getManyMsgs($num_page,$numOfNotice){
            // $start 번부터 $rows 개의 데이터를 반환(2차원 배열)
            // getNumMsgs() 와 마찬가지로 페이지네이션에서 사용 예정
            try{
                $numLine=NUMLINES+$numOfNotice;
                $rows = $this->db->prepare("SELECT * FROM board WHERE notice=1 UNION (SELECT * FROM board ORDER BY notice DESC, num DESC LIMIT $num_page,$numLine)");
                $rows->execute();
                $msg=$rows->fetchAll(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                exit($e->getMessage());
            }
            return $msg;
        }
        
        public function insertMsg($writer,$title,$content){
            //새 글을 DB에 추가
            try{
                $regtime=date("Y-m-d H:i:s");
                $pstmt=$this->db->prepare("insert into board(writer,title,content,regtime) values(:writer,:title,:content,:regtime)");
                $pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);
                $pstmt->bindValue(":title",$title,PDO::PARAM_STR);
                $pstmt->bindValue(":content",$content,PDO::PARAM_STR);
                $pstmt->bindValue(":regtime",$regtime,PDO::PARAM_STR);
                $pstmt->execute();
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        public function updateMsg($num,$writer,$title,$content){
            //$num번 게시글 업데이트
            try{
                $regtime=date("Y-m-d H:i:s");
                $pstmt=$this->db->prepare("update board set writer=:writer,title=:title,content=:content,regtime=:regtime where num=:num");
                $pstmt->bindValue(":num",$num,PDO::PARAM_INT);
                $pstmt->bindValue(":writer",$writer,PDO::PARAM_STR);
                $pstmt->bindValue(":title",$title,PDO::PARAM_STR);
                $pstmt->bindValue(":content",$content,PDO::PARAM_STR);
                $pstmt->bindValue(":regtime",$regtime,PDO::PARAM_STR);
                $pstmt->execute();
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        public function deleteMsg($num){
             //$num번 게시글 삭제
            try{
                $pstmt=$this->db->prepare("delete from board where num=:num");
                $pstmt->bindValue(":num",$num,PDO::PARAM_INT);
                $pstmt->execute();
                $target=$this->db->prepare("select title from board where num=:num");
                $pstmt->bindValue(":num",$num,PDO::PARAM_INT);
                $target->execute();
                $pstmt=$this->db->prepare("alter table hitSum drop column $target");
                $pstmt->execute();
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        public function hIncrement($num,$id){
            //현재 로그인 중인 사용자로 $num번 게시글을 1 올림
            try{
                    $sql="select * from hits where post=:num and user_id=:id";
                    $pstmt=$this->db->prepare($sql);
                    $pstmt->bindvalue(":num",$num,PDO::PARAM_INT);
                    $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                    $pstmt->execute();
                    $searchResult=$pstmt->fetch(PDO::FETCH_ASSOC);
    
                    if($searchResult){ }
                    else{
                        $sql="insert into hits value(:num,:id)";
                        $pstmt=$this->db->prepare($sql);
                        $pstmt->bindvalue(":num",$num,PDO::PARAM_INT);
                        $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                        $pstmt->execute();
                    }    
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        public function hitsGet($num){
            //$num번 게시글의 조회수를 받아옴
            try{
                $sql="select c from hit_vu where post=:num";
                $pstmt=$this->db->prepare($sql);
                $pstmt->bindvalue(":num",$num,PDO::PARAM_INT);
                $pstmt->execute();
                $searchResult=$pstmt->fetchColumn();
            }catch(PDOException $e){
                exit($e->getMessage());
            }
            return $searchResult;
        }
    }
?>