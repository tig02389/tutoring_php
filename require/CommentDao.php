<?php
        require_once("tools.php");
        class commentDao{
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
            function commentInsert($belong,$writer,$content){
                $regtime = date("Y-m-d H:i:s");
                try{
                    $sql="insert into comment2(belong,writer,content,regtime) value(:belong,:writer,:content,:regtime)";
                    $pstmt=$this->db->prepare($sql);
                    $pstmt->bindvalue(":belong",$belong,PDO::PARAM_STR);
                    $pstmt->bindvalue(":writer",$writer,PDO::PARAM_STR);
                    $pstmt->bindvalue(":content",$content,PDO::PARAM_STR);
                    $pstmt->bindvalue(":regtime",$regtime,PDO::PARAM_STR);
                    $pstmt->execute();
                }catch(PDOException $e){
                    exit($e->getMessage());
                }
            }
            function commentDelete($num){
                try{
                    $sql="delete from comment2 where num=:num";
                    $pstmt=$this->db->prepare($sql);
                    $pstmt->bindvalue(":num",$num,PDO::PARAM_INT);
                    $pstmt->execute();
                }catch(PDOException $e){
                    exit($e->getMessage());
                }
            }
            function commentUpdate($num,$content){
                $regtime=date("Y-m-d H:i:s");
                try{
                    $sql="update comment2 set content=:content,regtime=:regtime where num=:num";
                    $pstmt=$this->db->prepare($sql);
                    $pstmt->bindvalue(":num",$num,PDO::PARAM_INT);
                    $pstmt->bindvalue(":content",$content,PDO::PARAM_STR);
                    $pstmt->bindvalue(":regtime",$regtime,PDO::PARAM_STR);
                    $pstmt->execute();
                }catch(PDOException $e){
                    exit($e->getMessage());
                }
            }        
            public function commentsGet($belong){
                try{
                    $rows = $this->db->prepare("select * from comment2 where belong=:belong");
                    $rows->bindvalue(":belong",$belong,PDO::PARAM_INT);
                    $rows->execute();
                    $msg=$rows->fetchAll(PDO::FETCH_ASSOC);
                }catch(Exception $e){
                    exit($e->getMessage());
                }
                return $msg;
            }
            function commentGet($belong){
                try{
                    $sql="select * from comment2 where belong=:belong";
                    $pstmt=$this->db->prepare($sql);
                    $pstmt->bindvalue(":belong",$belong,PDO::PARAM_INT);
                    $pstmt->execute();
                    $result=$pstmt->fetch(PDO::FETCH_ASSOC);
                }catch(PDOException $e){
                    exit($e->getMessage());
                }
                return $result;
            }
            function countOfComment($belong){
                try{
                    $sql="select count(*) from comment2 where belong=:belong";
                    $pstmt=$this->db->prepare($sql);
                    $pstmt->bindvalue(":belong",$belong,PDO::PARAM_INT);
                    $pstmt->execute();
                    $result=$pstmt->fetchColumn();
                }catch(PDOException $e){
                    exit($e->getMessage());
                }
                return $result;
            }
        }
?>