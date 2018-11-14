<?php    
    require_once("tools.php");
    class MemberDao{
        private $db;
        public function __construct(){
            try{
                $this->db=new PDO("mysql:host=localhost;dbname=termproject","root","1111");
                $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        function Minsert($id, $pw, $name, $addr,$mail){
            // 맴버 추가 (회원가입)
            // id, pw, name, addr, hobby
            try{
                $sql="insert into member value(:id,:pw,:name,:addr,:email)";
                $pstmt=$this->db->prepare($sql);
                $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                $pstmt->bindvalue(":pw",$pw,PDO::PARAM_STR);
                $pstmt->bindvalue(":name",$name,PDO::PARAM_STR);
                $pstmt->bindvalue(":addr",$addr,PDO::PARAM_STR);
                $pstmt->bindvalue(":email",$email,PDO::PARAM_STR);
                $pstmt->execute();
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        function Hinsert($id,$hobby){
            // 맴버의 취미 추가
            // id 취미
            try{
                $sql="insert into member_hobby value(:id,:hobby)";
                $pstmt=$this->db->prepare($sql);
                $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                $pstmt->bindvalue(":hobby",$hobby,PDO::PARAM_STR);
                $pstmt->execute();
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        function Mdelete($id){
            // 맴버 삭제 (회원탈퇴)
            // 타겟 id
            try{
                $sql="delete from member_hobby where id=:id";
                $pstmt->$this->db->prepare($sql);
                $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                $pstmt->execute();
                $sql="delete from member where id=:id";
                $pstmt->$this->db->prepare($sql);
                $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                $pstmt->execute();
            }catch(PDOException $e){
                exit($e->getMessage());
            }
        }
        function Mupdate($id, $pw, $name, $addr, $hobby){
            // 맴버 내용 변경(회원정보 수정)
            // 타겟 : id 
            // 내용 : pw, name, addr, hobby
            try{
                $sql="update member set pw=:pw,name=:name,addr=:addr,hobby=:hobby where id=:id";
                $pstmt=$this->db->prepare($sql);
                $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                $pstmt->bindvalue(":pw",$pw,PDO::PARAM_STR);
                $pstmt->bindvalue(":name",$name,PDO::PARAM_STR);
                $pstmt->bindvalue(":addr",$addr,PDO::PARAM_STR);
                $pstmt->bindvalue(":hobby",$hobby,PDO::PARAM_STR);
                $pstmt->execute();
            }catch(PDOException $e){
                exit($e->getMessage());
            }

        }
        function mGet($id){
            // 맴버 내용 받기(회원정보 일람)
            // 타겟 : id
            try{
                $sql="select * from member where id=:id";
                $pstmt=$this->db->prepare($sql);
                $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                $pstmt->execute();
                $result = $pstmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                exit($e->getMessage());
            }
            return $result;
        }
        function hGet($id){
            // 맴버 취미 받기(회원정보 일람)
            // 타겟 : id
            try{
                $sql="select * from member_hobby where id=:id";
                $pstmt=$this->db->prepare($sql);
                $pstmt->bindvalue(":id",$id,PDO::PARAM_STR);
                $pstmt->execute();
                $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                exit($e->getMessage());
            }
            return $result;
        }
    }

?>