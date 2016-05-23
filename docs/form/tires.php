<?php
if($_POST) {
    require_once "db/_bootstrap.php";

    $request = $_POST['Client'];
    $info = $_POST;
    unset($info['Client']);

    require_once "db/_general.php";
    include 'db/_tires_db.php';
} else {
    require_once 'views/header.php';
    require_once 'views/_tires_form.php';
    require_once 'views/footer.php';
}
