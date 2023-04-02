<?php 
require_once("entities/user.class.php");
?>

<?php 
    session_start();


    if(isset($_SESSION["user"])!=""){
        header("Location: Login.php");
    }
    if(isset($_POST["btn-summit-login"])){
        $u_name = $_POST['txtname'];
        $u_pass = $_POST['txtpass'];
        $user =  User::checkLogin($u_name,  $u_pass);
        if($user){
            $_SESSION['user'] = $u_name;
            header("Location: questions_admin.php");
        }else{
            header("Location: Login.php?Loi");
        }
           
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Ai Là Triệu Phú</title>
    <link rel="icon" href='/images/logo.png' type='image/jpg' , sizes='16x16'>

</head>

<body>

    <div class="center">
        <h1>Đăng Nhập Admins</h1>
        <form class="mt-4" enctype="multipart/form-data" method="post">
            <div class="txt_field">
                <input type="text" name="txtname" required>
                <span></span>
                <label>Tên Đăng Nhập</label>
            </div>
            <div class="txt_field">
                <input type="password" name="txtpass" required>
                <span></span>
                <label>Mật Khẩu</label>
            </div>
            <button type="submit" name="btn-summit-login" >Đăng Nhập</button>
        </form>
    </div>
</body>
</html>