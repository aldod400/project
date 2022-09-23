<?php

$id =  $_GET['id'];

$connection = mysqli_connect("localhost","root","","instant");
$query =  mysqli_query($connection,"DELETE FROM students WHERE student_id =  $id");
error_reporting(0);
header("location: index.php");


