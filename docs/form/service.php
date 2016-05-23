<?php
if($_POST) {
    require_once "db/_bootstrap.php";

    $work = $_POST['Work'];
    $request = $_POST['Client'];
    $info = $_POST;
    unset($info['Client']);

    require_once "db/_general.php";
    include 'db/_service_db.php';
} else {
    require_once 'views/header.php';
    require_once 'views/_service_form.php';
    require_once 'views/footer.php';
}
