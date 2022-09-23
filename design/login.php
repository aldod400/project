<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if(!empty($email) && !empty($pass)){
        $connection = mysqli_connect("localhost","root","","instant");
        $query_student = mysqli_query($connection,"SELECT * FROM students WHERE student_email = '$email' and student_password = '$pass'");
        $query_id = mysqli_query($connection,"SELECT student_id FROM students WHERE student_email = '$email' and student_password = '$pass'");

        if(mysqli_affected_rows($connection)== 1){
          $_SESSION['level'] = 1;
          $_SESSION['is_loged'] = true;
          $_SESSION['id'] = mysqli_fetch_all($query_student,MYSQLI_ASSOC)[0]['student_name'];
          $_SESSION['idd'] = mysqli_fetch_all($query_id,MYSQLI_ASSOC)[0]['student_id'];

          header("location:home.php");
          exit;
        }
        $query_instractor = mysqli_query($connection,"SELECT * FROM instructors WHERE instructor_email = '$email' and instructor_password = '$pass'");
        if(mysqli_affected_rows($connection)== 1){
          $_SESSION['level'] = 2; 
          $_SESSION['is_loged'] = true;
          $_SESSION['id'] = mysqli_fetch_all($query_instractor,MYSQLI_ASSOC)[0]['instructor_name'];
          $_SESSION['idd'] = mysqli_fetch_all($query_id,MYSQLI_ASSOC)[0]['instructor_id'];
          header("location:index.php");
          exit;
        }
        $query_admin = mysqli_query($connection,"SELECT * FROM admins WHERE admin_email = '$email' and admin_password = '$pass'");
        if(mysqli_affected_rows($connection)== 1){
          $_SESSION['level'] = 3; 
          $_SESSION['is_loged'] = true;
          $_SESSION['id'] = mysqli_fetch_all($query_admin,MYSQLI_ASSOC)[0]['admin_name'];
          $_SESSION['idd'] = mysqli_fetch_all($query_id,MYSQLI_ASSOC)[0]['admin_id'];
          header("location: index.php?q=*");
          exit;
        }

        // $_SESSION['login'] = true;
        // $user_students = mysqli_fetch_assoc($query_student);
        // $user_instractor = mysqli_fetch_assoc($query_instractor);
        // $user_admin = mysqli_fetch_assoc($query_admin );
        // if(empty($user_students) || empty($user_instractor) || empty($user_admin)){
        //     header("location:login.php");
        // }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../../logo-orange.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="pass" required>
          <span></span>
          <label>Password</label>
        </div>
        
        <input type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="register.php">Signup</a>
        </div>
      </form>
    </div>

  </body>
</html>
