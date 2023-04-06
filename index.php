<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ai Là Triệu Phú</title>
    <link rel="icon" href='/images/logo.png' type='image/jpg' , sizes='16x16'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/57045c6330.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="banner">
        <div class="navbar">
            <h3 class="logo">AI LÀ TRIỆU PHÚ</h3>
            <ul>
                <li>
                    <a href="/login.php">Admin</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <img src="images/logo.png" width="30%" height="10%">
            <div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span></span>BẮT ĐẦU</button>
            </div>
        </div>
    </div>




      <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Luật Chơi:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               
                    <h5 class=" text-success">15 câu hỏi trong trò chơi được phân loại theo độ khó từ câu hỏi dễ đến câu hỏi khó.</h5>
                        <div class="text-success">
                            <hr>
                        </div>
                        <ul>
                            <li>50/50: Loại bỏ hai phương án sai khỏi bốn phương án trả lời, chỉ còn lại hai phương án, trong đó một phương án là đáp án đúng.</li>
                            <li>Gọi điện cho người thân: Người chơi có thể gọi cho người thân của mình để nhờ giúp đỡ trả lời câu hỏi.</li>
                            <li>Hỏi ý kiến khán giả: Người chơi có thể hỏi ý kiến của khán giả để nhờ họ giúp đỡ trả lời câu hỏi</li>
                        </ul>
                        <div class="text-red text-center">
                            <hr>
                        </div>
                     <h5 class=" text-red">Bạn Sẵn Sàng để chơi</h5>
                 
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chưa</button>
                <button type="button" onclick="location.href='question.php'" class="btn btn-primary">Tôi Sẵn Sàng</button>
            </div>  
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>