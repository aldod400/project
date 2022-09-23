<?php
session_start();
if($SESSION['level'] = 3){
$connection = mysqli_connect("localhost","root","","instant");
$query_course_name = mysqli_query($connection,"SELECT courses.course_name FROM courses");
$query_course_name_results = mysqli_fetch_all($query_course_name, MYSQLI_ASSOC);
$query_names = mysqli_query($connection, "SELECT * FROM students ");
$query_names_results  = mysqli_fetch_all($query_names,MYSQLI_ASSOC);

if(isset($_POST['sub'])){
    $student_email = $_POST['name'];
    $course_name = $_POST['course'];
    $query_stds = mysqli_query($connection, "SELECT * FROM students WHERE student_email='$student_email'");
    $query_courses = mysqli_query($connection, "SELECT * FROM courses WHERE course_name='$course_name'");
    $query_name_id_results = mysqli_fetch_all($query_stds, MYSQLI_ASSOC);
    $query_courses_id_results = mysqli_fetch_all($query_courses, MYSQLI_ASSOC);
    
    $student_id = $query_name_id_results[0]["student_id"];
    $course_id = $query_courses_id_results[0]["course_id"];
    $query_courses_val = mysqli_query($connection, "SELECT * FROM courses_students WHERE course_id=$course_id AND student_id=$student_id");
    
    if(mysqli_num_rows($query_courses_val)>0){
        echo "<script>alert('this user is already in this course')</script>";
    }else{
        $en_date= $_POST["_date"];
    $query_insert = mysqli_query($connection,"INSERT INTO courses_students (course_id, student_id, enrollment_date) VALUES ($course_id,$student_id,$en_date)");
    
    if(mysqli_affected_rows($connection)==1){header("location: addcourse.php");
    unset($_POST['sub']);
    }
    }
    
    
}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Add new Student</title>
    <link rel="icon" type="image/x-icon" href="logo-orange.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="center">
    <h1>Link a course</h1>
    <form method="post" action="addcourse.php" enctype="multipart/form-data">
        <div class="txt_field">
                <select id="branch" name="name" style="width: 100%;border: none;">
                <?php foreach($query_names_results as $student):?>
                <option value="<?= $student['student_email']; ?> "><?= $student['student_email']; ?> </option>
                <?php endforeach; ?>
                </select>
        </div>
        <div class="txt_field">
                <select id="branch" name="course" style="width: 100%;border: none;">
                <?php foreach($query_course_name_results as $course):?>
                <option value="<?= $course['course_name']; ?>"><?= $course['course_name']; ?></option>
                <?php endforeach; ?>
                </select>
        </div>
        <div class="txt_field">
            <input type="date" name="_date" required>
            <span></span>
        </div>
        <input type="submit" name="sub" value="Enroll">
        <div class="signup_link">
        </div>
        
    </form>
    </div>

</body>
</html>
