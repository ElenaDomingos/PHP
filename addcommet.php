<?php
include_once('connection.php');
require_once 'vendor/autoload.php';
use Intervention\Image\ImageManagerStatic as Image;

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $formats = array( "JPG" , "jpg", "gif", "png");
    $format = @end(explode(".", $_FILES['file']['name']));

    if (in_array($format, $formats)) {

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            $dir = "pic/" . $_FILES['file']['name'];

            if (move_uploaded_file($_FILES['file']['tmp_name'], $dir)) {

            }

        }
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $today = date('Y-m-d');
    $status = 'no-approved';
    $image = Image::make($dir)->fit(320, 240)->save($dir);
    if(isset($dir) && $dir != ''){
        $file = $dir;
    }else {
    $file = '';}


if ($name != '' && $email != '' && $comment != '') {


    $sendcomment = "INSERT INTO comments (`name`, `email` , `image` , `comment`, `added`, `status`) VALUES (:name, :email, :img,  :comment, :today, :status)";
    $stmt = $pdo->prepare($sendcomment);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':today', $today);
    $stmt->bindParam(':img', $file);


    if ($stmt->execute()) {
        echo 'Все отправилось';
    } else {
        echo 'Произошла ошибка';
    }
} else {
    echo 'Не указаны все данные';
}

}