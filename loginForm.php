
<!-- 로그인 입력 페이지 -->
<!DOCTYPE html>
<html lang="en">
<head>
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
<!--부트스트랩 사용을 위한 참조 -->
<script>
  function back(){
    history.back();
  }
</script>
</head>
<body>
<div class="container">
<h2>Login</h2>
<form action="login.php" method="post">
  <div class="form-group">
  <div class="form-group">
    <label for="usr">Id:</label>
    <input type="text" class="form-control" name="id">
  </div>
  <div class="form-group">
    <label for="pwd">Pw:</label>
    <input type="password" class="form-control" name="pw">
  </div>
  <button type="submit" class="btn btn-primary">로그인</button>
  <input type="button" class="btn btn-danger" onclick='back()' value="뒤로가기"></button>
</form>
  </div>
</body>
</html>