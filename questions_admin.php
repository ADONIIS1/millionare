<?php
    session_start();
    if(isset($_SESSION['user']) == ""){
        header("Location: Login.php");
    }
?>

<?php
    require_once("entities/question.class.php");
    require_once("entities/category.class.php");

?>
<?php
    $Questions = Questions::List_Question();
  
?>


<?php
if(isset($_POST["submit"])) {

    $question = $_POST["question"];
    $answer1 = $_POST["answer1"];
    $answer2 = $_POST["answer2"];
    $answer3 = $_POST["answer3"];
    $answer4 = $_POST["answer4"];
    $answer =$_POST["answer"];

    if ($answer === "A") {
        $answer = $answer1;
    } else if ($answer === "B") {
        $answer =  $answer2;
    } else if ($answer === "C") {
        $answer = $answer3;
    } else if ($answer === "D") {
        $answer = $answer4;
    }

    $categoryID = $_POST["categoryID"];

    $newQuestion = new Questions($question,$answer1,$answer2,$answer3,$answer4,$answer,$categoryID);
   
    
    $result = $newQuestion->save();

    if(!$result){
        header("location: questions_admin.php?failure");
    }
    else{
        header("location: questions_admin.php?inserted");

    }
}
?>



<?php

if(isset($_POST["submit-edit"])) {
    $question = $_POST["question"];
    $questionID = $_POST["QuestionID"];
    $answer1 = $_POST["answer1"];
    $answer2 = $_POST["answer2"];
    $answer3 = $_POST["answer3"];
    $answer4 = $_POST["answer4"];
    $answer =$_POST["answer"];

    if ($answer === "A") {
        $answer = $answer1;
    } else if ($answer === "B") {
        $answer =  $answer2;
    } else if ($answer === "C") {
        $answer = $answer3;
    } else if ($answer === "D") {
        $answer = $answer4;
    }

    $categoryID = $_POST["categoryID"];

    $result = Questions::update($questionID,$question,$answer1,$answer2,$answer3,$answer4,$answer,$categoryID);

    if(!$result){
        header("location: questions_admin.php?failure");
    }
    else{
        header("location: questions_admin.php?inserted");

    }
}
?>

<?php

if(isset($_POST["delete-submit"])) {

    $QuestionID = $_POST["QuestionID"];


    $result = Questions::delete($QuestionID);

    if(!$result){
        header("location: questions_admin.php?failure");
    }
    else{
        header("location: questions_admin.php?inserted");

    }
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<!-- <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,80...lay=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/table.css">
    <title>Ai Là Triệu Phú</title>
    <link rel="icon" href='/images/logo.png' type='image/jpg' , sizes='16x16'>

</head>

<body></body>
    <!-- =============== Navigation ================ -->
    <div class="container-admin">   
        <?php include ("sidebar.php");?>

               <!-- ========================= Main ==================== -->
        <div class="main-admin">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
            <section class="system__list">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-sm-4 createSegment"> 
                                <button class="btn dim_button create_new"  data-toggle="modal" data-target="#addQuestion"> <span class="glyphicon glyphicon-plus"></span>Thêm câu hỏi</button>
                                </div>
                                <div class="col-sm-8 add_flex">
                                    <div class="form-group searchInput">
                                        <label for="email">Search:</label>
                                        <input type="search" class="form-control" id="filterbox" placeholder=" ">
                                    </div>
                                </div> 
                            </div>
                            <div class="overflow-x">
                                <table style="width:100%;" id="filtertable" class="table cust-datatable dataTable no-footer">
                                    <thead>
                                        <tr>
                                            
                                            <th style="min-width:5%;">ID</th>
                                            <th  style="min-width:30%;">Câu hỏi</th>
                                            <th  style="min-width:10%;">Đáp án A</th>
                                            <th  style="min-width:10%;">Đáp án B</th>
                                            <th  style="min-width:10%;">Đáp án C</th>
                                            <th  style="min-width:10%;">Đáp án D</th>
                                            <th  style="min-width:10%;">Đáp án</th>
                                            <th  style="min-width:10%;">Loại câu hỏi</th>
                                            <th  style="min-width:150px;">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php foreach($Questions as $question){ ?>
                                        <tr>
                                                <td><?php echo $question["QuestionID"];?></td>
                                                <td><?php echo $question["Question"];?></td>
                                                <td><?php echo $question["Answer1"];?></td>
                                                <td><?php echo $question["Answer2"];?></td>
                                                <td><?php echo $question["Answer3"];?></td>
                                                <td><?php echo $question["Answer4"];?></td>
                                                <td ><?php echo $question["CorrectAnswer"];?></td>
                                                <td><?php $cate =  Category::get_CateName($question["CategoryID"]);
                                                        $cate = reset($cate); echo $cate["CategoryName"];?>
                                                </td>
                                                 <td>
                                                    <button 
                                                        class="btn btn-secondary mr-2" 
                                                        data-toggle="modal" 
                                                        data-target="#editQuestion" 
                                                        data-id="<?php echo $question["QuestionID"];?>" 
                                                        data-question="<?php echo $question["Question"];?>" 
                                                        data-answer1="<?php echo $question["Answer1"];?>" 
                                                        data-answer2="<?php echo $question["Answer2"];?>" 
                                                        data-answer3="<?php echo $question["Answer3"];?>" 
                                                        data-answer4="<?php echo $question["Answer4"];?>" 
                                                        data-correctAnswer="<?php echo $question["CorrectAnswer"];?>" 
                                                        data-categoryID="<?php echo $question["CategoryID"];?>" 
                                                        style="margin-right: 10px;"
                                                    >
                                                        <span class="ti-pencil-alt"></span>&nbsp;
                                                        Sửa
                                                    </button>
                                                    <button 
                                                        class="btn btn-danger" 
                                                        data-toggle="modal" 
                                                        data-target="#deleteQuestion"
data-id="<?php echo $question["QuestionID"];?>" 
                                                        >
                                                        <span class="ti-trash"></span>&nbsp;
                                                        Xóa
                                                    </button>
                                                </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>




<!-- {{!-- add Question  --}} -->
    <div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="addQuestionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="transition: all 0.3s ease; max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title font-weight-bold text-dark text-uppercase" id="addQuestionLabel">Thêm mới Câu hỏi</strong>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-dark">
                    <p class="card-description">Nhập thông tin bên dưới để thêm mới 1 Câu hỏi</p>
                    <form class="mt-4" enctype="multipart/form-data" method="post">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-dark" for="name-lesson">Câu Hỏi</label>
                            <div class="col-sm-9">
                                <textarea   rows="10" class="form-control" id="exercise-question" type="text" placeholder="Nhập Câu Hỏi" name="question" required="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input class="form-check-input-custom color-1" id="custom1" type="radio" name='answer'
                                        value='A' required>
                                    <label for="custom1">
                                        <span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer1'/>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input class="form-check-input-custom color-2" id="custom2" type="radio" name='answer'
                                        value='B' required>
                                    <label for="custom2">
                                        <span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
                                        Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer2'/>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input type="radio" class="form-check-input-custom color-3" id="custom3" name='answer'
                                        value='C' required>
                                    <label for="custom3">
                                        <span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
                                        Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer3'/>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input type="radio" class="form-check-input-custom color-4" id="custom4" name='answer'
                                        value='D' required>
                                    <label for="custom4">
<span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
                                        Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer4'/>
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-dark" for="name-lesson">Loại Câu Hỏi</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select-lg" style="padding-bottom: 5px;padding-top: 5px;" name="categoryID">
                                    <option value=""selected >-- Chọn Loại --</option>
                                    <?php
                                        $cates = Category::list_category();
                                        foreach($cates as $item){
                                            echo "<option value = ".$item["ID"].">".$item["CategoryName"]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="float-right " >
                            <button class="btn btn-secondary " style="margin-left: 73%;"  type="button" data-dismiss="modal">Hủy bỏ</button>
                            <button class="btn btn-success ml-2 " type="submit" name="submit">Lưu lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- {{!-- edit Question  --}} -->
    <div class="modal fade" id="editQuestion" tabindex="-1" role="dialog" aria-labelledby="editQuestionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="transition: all 0.3s ease; max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title font-weight-bold text-dark text-uppercase" id="editQuestionLabel">Sửa  Câu hỏi</strong>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-dark">
<p class="card-description">Nhập thông tin bên dưới để sửa 1 Câu hỏi</p>
                    <form class="mt-4" enctype="multipart/form-data" method="post">
                        <input  type="text" name="QuestionID" hidden="hidden">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-dark" for="name-lesson">Câu Hỏi</label>
                            <div class="col-sm-9">
                                <textarea rows="10" class="form-control" id="exercise-question" type="text" placeholder="Nhập Câu Hỏi" name="question" required="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input class="form-check-input-custom color-1" id="custom1" type="radio" name='answer'
                                        value='A' required>
                                    <label for="custom1">
                                        <span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
                                        Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer1'/>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input class="form-check-input-custom color-2" id="custom2" type="radio" name='answer'
                                        value='B' required>
                                    <label for="custom2">
                                        <span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
                                        Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer2'/>
</div>
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input type="radio" class="form-check-input-custom color-3" id="custom3" name='answer'
                                        value='C' required>
                                    <label for="custom3">
                                        <span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
                                        Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer3'/>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-center position-relative">
                                    <input type="radio" class="form-check-input-custom color-4" id="custom4" name='answer'
                                        value='D' required>
                                    <label for="custom4">
                                        <span>
                                            <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg'
                                                alt='Checked Icon'>
                                        </span>
                                    </label>
                                    <div class="custom-desc">
                                        Đánh dấu đây là câu trả lời đúng
                                    </div>
                                </div>
                                <input class="form-control option-custom" type='text'
                                    placeholder='Nhập Đáp Án' name='answer4'/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-dark" for="name-lesson">Loại Câu Hỏi</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select-lg" style="padding-bottom: 5px;padding-top: 5px;" name="categoryID">
                                    <option value=""selected >-- Chọn Loại --</option>
                                    <?php
                                        $cates = Category::list_category();
                                        foreach($cates as $item){
echo "<option value = ".$item["ID"].">".$item["CategoryName"]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="float-right " >
                            <button class="btn btn-secondary " style="margin-left: 73%;"  type="button" data-dismiss="modal">Hủy bỏ</button>
                            <button class="btn btn-success ml-2 " type="submit" name="submit-edit">Lưu lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- {{!--   Delete Question --}} -->
    <div class="modal fade" id="deleteQuestion" tabindex="-1" role="dialog" aria-labelledby="deleteQuestionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="transition: all 0.3s ease">
            <form class="mt-4" enctype="multipart/form-data" method="post">
                <input  type="text" name="QuestionID" hidden="hidden">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold text-dark" id="deleteQuestionLabel">Xác nhận xóa  Câu hỏi</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p id="delete-grade-name" style="font-weight: bold; text-align: center; font-size: large;"></p>
                        <h4>Hành động này không thể khôi phục. </h4>
                        <p>Bạn đã chắc chắn muốn xóa?</p>                    
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <button class="btn btn-danger"  name="delete-submit" type="submit">Xác nhận xóa</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




<!-- =========== Scripts =========  -->
<script src="js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js"></script>
<script src="js/table.js"></script>




<script>
    var editQuestionModal = $("#editQuestion");
var QuestionId, question ,answer1 ,answer2, answer3, answer4, correctAnswer, categoryID ;
    var deleteQuestionModal = $("#deleteQuestion");

    editQuestionModal.on('show.bs.modal',function (event) {
        var button = $(event.relatedTarget);
        
        QuestionId = button.data('id');
        question = button.data('question');
        answer1 = button.data('answer1');
        answer2 = button.data('answer2');
        answer3 = button.data('answer3');
        answer4 = button.data('answer4');
        correctAnswer = button.data('correctanswer');
        categoryID = button.data('categoryid');

        $("#editQuestion option[value='"+categoryID+"']").prop("selected", true);

        if(answer1 == correctAnswer){
                $("#editQuestion input[name='answer'][value='A']").prop('checked', true);;
        }else if(answer2 == correctAnswer){
                $("#editQuestion input[name='answer'][value='B']").prop('checked', true);
        }else if(answer3 == correctAnswer){
                $("#editQuestion input[name='answer'][value='C']").prop('checked', true);
        }else if(answer4 == correctAnswer){
                $("#editQuestion input[name='answer'][value='D']").prop('checked', true);
        }

        $("#editQuestion input[name='QuestionID']").val(QuestionId);
        $("#editQuestion textarea[name='question']").val(question);
        $("#editQuestion input[name='answer1']").val(answer1);
        $("#editQuestion input[name='answer2']").val(answer2);
        $("#editQuestion input[name='answer3']").val(answer3);
        $("#editQuestion input[name='answer4']").val(answer4);

    });
    deleteQuestionModal.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        QuestionId = button.data('id');
        $("#deleteQuestion input[name='QuestionID']").val(QuestionId);
    });



</script>





</body>

</html>