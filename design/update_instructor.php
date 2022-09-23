<?php 

session_start();
$id=$_GET['id'];
$connection = mysqli_connect("localhost", "root", "", "instant");

$query555 = mysqli_query($connection,"SELECT * FROM instructors WHERE instructor_id=$id");
$instructor = mysqli_fetch_all($query555,MYSQLI_ASSOC);
$result = $instructor[0];
if(isset($_POST['sub'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];
    $imgname = $_FILES['img']['name'];
    $imgtmp = $_FILES['img']['tmp_name'];
    $role = $_POST['role'];
   
    /*validator*/
    if(!empty($name) && !empty($email) && !empty($pass) && !empty($phone)){
        $connection = mysqli_connect("localhost","root","","instant" );
        $query_img= mysqli_query( $connection,"SELECT instructor_img FROM instructors WHERE instructor_id=$id");
        $values22 = mysqli_fetch_all($query_img, MYSQLI_ASSOC);
        if(!empty($imgname)){
            move_uploaded_file($imgtmp,"upload/".$imgname);
        }else{
            $imgname = $values22[0]['instructor_img'];
        }
        if($role == "instructor"){
            $query_student= mysqli_query( $connection,"SELECT student_email FROM students WHERE student_email = '$email' AND student_id != $id");
             
                if(mysqli_affected_rows($connection) != 1 && strlen($email)!=0){
                $query_instructor= mysqli_query( $connection,"SELECT instructor_email FROM instructors WHERE instructor_email = '$email' AND instructor_id != $id");
                if(mysqli_affected_rows($connection) != 1 && strlen($email)!=0){
                    $query_student= mysqli_query( $connection,"SELECT admin_email FROM admins WHERE admin_email = '$email' AND admin_id != $id");
                    if(mysqli_affected_rows($connection) != 1 && strlen($email)!=0){
                    $query_students = mysqli_query($connection,"UPDATE instructors SET instructor_name='$name', instructor_email='$email', instructor_password='$pass', instructor_phone='$phone', instructor_img='$imgname' WHERE instructor_id = $id");
                    if(mysqli_affected_rows($connection)==1){
                        header("location: instructors.php");
                    }
                    }else{
                        echo "<script>alert('this email is already registered')</script>";
                    }
                }else{
                    echo "<script>alert('this email is already registered')</script>";
                }
            }else{
                echo "<script>alert('this email is already registered')</script>";
            }
        }
    }
    else{
        echo "<script>alert('Fill The Template')</script>";
    }
}

?>

<?php
include "function.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Edit Instructor <?=ucfirst(explode(" ",trim($result["instructor_name"]))[0]) ?></title>
    <link rel="icon" type="image/x-icon" href="logo-orange.png">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center">
        <h1>Add New member</h1>
        <input type="hidden" name="id" value="<?= $_GET['id']?>">
        <form method="post" action="update_instructor.php?id=<?= $_GET['id']?>" enctype="multipart/form-data">
            <div class="txt_field">
                <input type="text" value="<?=$result["instructor_name"] ?> "name="name" required>
                <span></span>
                <label>Name</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" value="<?=$result["instructor_email"] ?>" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="tel" pattern="^01[0-2]\d{1,8}$" name="phone" value="<?= $result["instructor_phone"]?>"
                required>
                <span></span>
                <label>phone</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" value="<?= $result["instructor_password"]?>" required>
                <span></span>
                <label>Create a password</label>
            </div>
            <!-- <div class="txt_field">
                <input type="date" name="registration_date" required>
                <span></span>
            </div> -->
            <div class="txt_field">
                <input type="file" name="img">
                <span></span>
            </div>
            <div class="txt_field">

                <select id="role" name="role" style="width: 100%;border: none;">
                    <option value="student" style="display:none">Student</option>
                    <option value="instructor" selected>instructor</option>
                </select>
            </div>
            <input type="submit" name="sub" value="Add">
            <div class="signup_link">
                <a href="login.php">Login</a>
            </div>

        </form>
    </div>

</body>

</html>