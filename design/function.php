<?php

if($_SESSION['level'] < 1 && $_SESSION['is_loged'] == false){
    header("location:login.php");
}
?>