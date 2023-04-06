<?php 
require_once("entities/user.class.php");
?>
<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<?php 
    session_start();


    if(isset($_SESSION["user"])!=""){
        header("Location: Login.php");
    }
    if(isset($_POST["btn-summit-login"])){
        $u_name = $_POST['txtname'];
        $u_pass = $_POST['txtpass'];
        if (strlen($u_pass) < 8 || strlen($u_pass) > 16) {
            header("Location: Login.php?error=Password ít nhất 8 chữ cái");
            
            exit();
        }
        if (!preg_match("/\d/", $u_pass)) {
   
            header("Location: Login.php?error=Password phải có 1 kí tự số");

            exit();

        }
        if (!preg_match("/[A-Z]/", $u_pass)) {
            header("Location: Login.php?error=Password kí tự in hoa");

            exit();

        }
        if (!preg_match("/[a-z]/", $u_pass)) {

            header("Location: Login.php?error=Password kí tự chữ thường");

            exit();

        }
        if (!preg_match("/\W/", $u_pass)) {
            header("Location: Login.php?error=Password Nhập Phải có một kí tự đặt biệt");
            exit();

        }
        if (preg_match("/\s/", $u_pass)) {
            header("Location: Login.php?error=Password không chứa bất kỳ khoảng trắng nào");
            exit();
        }

        $user =  User::checkLogin($u_name,  $u_pass);
        if($user){
            $_SESSION['user'] = $u_name;
            header("Location: questions_admin.php");
        }else{
            header("Location: Login.php?error=Sai Tài Khoản  Mật khẩu");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Ai Là Triệu Phú</title>
    <link rel="icon" href='/images/logo.png' type='image/jpg' , sizes='16x16'>

</head>

<body>


        <a href="/" class="btn btn-success" style=" margin-top: 12%; margin-left: 60%;">Trở lại</a>

    <div class="center">
        <h1>Đăng Nhập Admin</h1>
        <form class="mt-4" enctype="multipart/form-data" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
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