<?php
if($_POST) {
    require_once "db/_bootstrap.php";

    $request = $_POST['Request'];
    $info = $_POST;
    unset($info['Request']);

    require_once "db/_general.php";
    require_once 'db/_company_db.php';
} else {
    require_once 'views/header.php';
    require_once 'views/_company_form.php';
    require_once 'views/footer.php';
}
