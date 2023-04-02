<?php
require_once("entities/category.class.php");

    $Cates = Category::list_category();
  
?>
<?php
    session_start();
    if(isset($_SESSION['user']) == ""){
        header("Location: Login.php");
    }
?>

<?php
if(isset($_POST["submit"])) {

    $nameCate = $_POST["nameCate"];

    $newCate = new Category($nameCate);

    $result = $newCate->save();

    if(!$result){
        header("location: cates_admin.php?failure");
    }
    else{
        header("location: cates_admin.php?inserted");

    }
}
?>
<?php


if(isset($_POST["delete-submit"])) {

    $CateID = $_POST["CateID"];


    $result = Category::delete($CateID);

    if(!$result){
        header("location: cates_admin.php?failure");
    }
    else{
        header("location: cates_admin.php?inserted");

    }
}
?>

<?php


if(isset($_POST["edit-submit"])) {

    $nameCate = $_POST["nameCate"];
    $CateID = $_POST["CateID"];


    $result = Category::update($CateID,$nameCate);

    if(!$result){
        header("location: cates_admin.php?failure");
    }
    else{
        header("location: cates_admin.php?inserted");

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,800&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/table.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"
        integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
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
                                <button class="btn dim_button create_new" data-toggle="modal"
                                    data-target="#addCategory"> <span class="glyphicon glyphicon-plus"></span>Thêm mới
                                    Loại Câu hỏi</button>
                            </div>
                            <div class="col-sm-8 add_flex">
                                <div class="form-group searchInput">
                                    <label for="email">Search:</label>
                                    <input type="search" class="form-control" id="filterbox" placeholder=" ">
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x">
                            <table style="width:100%;" id="filtertable"
                                class="table cust-datatable dataTable no-footer">
                                <thead>
                                    <tr>

                                        <th style="min-width:5%;">ID</th>
                                        <th style="min-width:600px;">Tên Loại câu hỏi</th>
                                        <th style="min-width:100px; max-width: 150px">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($Cates as $item){ ?>
                                    <tr>
                                        <td><?php echo $item["ID"];?></td>
                                        <td><?php echo $item["CategoryName"];?></td>
                                        <td>
                                            <button class="btn btn-secondary mr-2" data-toggle="modal"
                                                data-target="#editCategory"
                                                data-name="<?php echo $item["CategoryName"];?>"
                                                data-id="<?php echo $item["ID"];?>" style="margin-right: 10px;">
                                                <span class="ti-pencil-alt"></span>&nbsp;
                                                Sửa
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteCategory" data-id="<?php echo $item["ID"];?>">
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



<!-- {{!-- add Category  --}} -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="transition: all 0.3s ease; max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title font-weight-bold text-dark text-uppercase" id="addCategoryLabel">Thêm mới
                    Loại Câu hỏi</strong>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-dark">

                <p class="card-description">Nhập thông tin bên dưới để thêm mới Loại Câu hỏi mới</p>
                <form class="mt-4" enctype="multipart/form-data" method="post">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-dark" for="name-lesson">Tên Loại câu hỏi</label>
                        <div class="col-sm-9">
                            <textarea rows="4" class="form-control" type="text" placeholder="Nhập Câu Hỏi"
                                name="nameCate" required="required"></textarea>
                        </div>
                    </div>

                    <div class="float-right">
                        <button class="btn btn-secondary" style="margin-left: 73%;" type="button"
                            data-dismiss="modal">Hủy bỏ</button>
                        <button class="btn btn-success ml-2" type="submit" name="submit">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- {{!-- edit Category  --}} -->
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="transition: all 0.3s ease; max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="modal-title font-weight-bold text-dark text-uppercase" id="editCategoryLabel">Sửa Loại
                    Câu hỏi</strong>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <p class="card-description">Nhập thông tin bên dưới để sửa Loại Câu hỏi </p>
                <form class="mt-4" enctype="multipart/form-data" method="post">
                    <input type="text" name="CateID" hidden="hidden">
                    <div class="mt-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-dark" for="name-lesson">Tên Loại câu hỏi</label>
                            <div class="col-sm-9">
                                <textarea rows="4" class="form-control" type="text" placeholder="Nhập Câu Hỏi"
                                    name="nameCate" required="required"></textarea>
                            </div>
                        </div>

                        <div class="float-right">
                            <button class="btn btn-secondary" style="margin-left: 73%;" type="button"
                                data-dismiss="modal">Hủy bỏ</button>
                            <button class="btn btn-success ml-2" type="submit" name="edit-submit">Lưu lại</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- {{!-- Confirm  Delete cate --}} -->
<div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="transition: all 0.3s ease">
        <form class="mt-4" enctype="multipart/form-data" method="post">
            <input type="text" name="CateID" hidden="hidden">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold text-dark" id="deleteCategoryLabel">Xác nhận xóa Loại Câu
                        hỏi</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p id="delete-grade-name" style="font-weight: bold; text-align: center; font-size: large;"></p>
                    <h4>Hành động này sẽ Xóa Những câu hỏi Có Thể Loại này.<br>Hành động này không thể khôi phục. </h4>
                    <p>Bạn đã chắc chắn muốn xóa?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button class="btn btn-danger" name="delete-submit" type="submit">Xác nhận xóa</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js"></script>
<script src="js/table.js"></script>


<script>
var editCategoryModal = $("#editCategory");
var deleteCategoryModal = $("#deleteCategory");
console.log(editCategoryModal);
var CategoryId, CategoryName;




editCategoryModal.on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);

    CategoryId = button.data('id');
    CategoryName = button.data('name');
    console.log("CategoryName" + CategoryName);
    $("#editCategory input[name='CateID']").val(CategoryId);
    $("#editCategory textarea[name='nameCate']").val(CategoryName);
});

deleteCategoryModal.on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);

    CategoryId = button.data('id');
    console.log("CategoryName" + CategoryId);

    $("#deleteCategory input[name='CateID']").val(CategoryId);
});
</script>
</body>

</html>