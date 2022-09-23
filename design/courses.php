<?php
session_start();
if($_SESSION['level'] == 1){
$connection = mysqli_connect("localhost","root","","instant");
$query= mysqli_query( $connection,"");
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);
}else{
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ODC - Tables</title>
    <link rel="icon" type="image/x-icon" href="logo-orange.png">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
    <form action="course.php" method="get">
    <div class="container-fluid" style="margin-top :50px">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Course Img</th>
                        <th>Course Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $value):?>
                    <tr>
                        <td><?= $value['course_name']; ?></td>
                        <td><a href="" ><img width="100px" hieght="100px" src="<?= "upload/".$value['course_img']; ?>"></a></td>
                        <td><?= $value['rating']; ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>

    </form>
</body>
</html>