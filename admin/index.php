<?php
require_once('../connection.php');

// Авторизация админа

if (isset($_POST['loginform'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login != '' && $password != '') {


        $stmt = $pdo->prepare("SELECT * FROM users WHERE login =:login");
        $stmt->execute(['login' => $login]);

        if ($row = $stmt->fetch()) {

            if ($password != $row['password']) {

                header('Location:../comments.php');

            } else {

                echo 'Привет, админ!';
                $cookie_name = "user";
                $cookie_value = "admin";
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            }

        } else {
            header('Location:../comments.php');
        }

    } else {
        header('Location:../comments.php');
    }
}

// Подтверждение комментария админом

if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $sql = "UPDATE comments SET status = 'approved' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
}

// Отклонение комментария админом

if (isset($_POST['refuse'])) {
    $id = $_POST['id'];
    $sql = "UPDATE comments SET status = 'no-approved' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
}

if(isset($_POST['change'])){
    $id = $_POST['id'];
    $comment = $_POST['comment'];
    $sql = "UPDATE comments SET comment = :comment, updated = 1 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->execute();
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous"></script>
        <title>Отзывы</title>
    </head>

    <body>
    <div class="container">
        <a href='../comments.php'>На страницу комментариев </a><br><br>
<?php

$sql = "SELECT * FROM comments";

$result = $pdo->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    $id = $row['id'];
    $status = $row['status'];
    $img = $row['image'];

    echo '<form method="post" action="" class="listforadmin">';
    echo '<div class="row">';
    if ($status != 'approved') {
        echo '<div class="col-md-3">' . $row['name'] . '<br>' . $row['added'] . '<br>' . $row['email'] . '<br><span style="color:#c82333"> Отклонен</span></div>';
    } else {
        echo '<div class="col-md-3">' . $row['name'] . '<br>' . $row['added'] . '<br>' . $row['email'] . '<br> <span style="color:#218838">Подтвержден</span></div>';
    }
    echo '<input type="number" name="id" value=' . $id . ' hidden>';
    echo '<div class="col-md-6"><textarea name="comment" class="form-control" rows="3">' . $row['comment'] . '</textarea></div>';
    if ($img != '') {
        echo '<div class="col-md-2"><img src="../' . $row['image'] . '" width="120" /></div></div>';
    } else {
        echo '</div>';
    }
    echo '<div class="row"><div class="col-md-12"><button type="submit" name="change" class="btn btn-primary mb-2">Изменить</button>';

    if ($status != 'approved') {
        echo '<button type="submit" name="approve" class="btn btn-success mb-2" style="margin-left:5px;">Принять</button>';
    } else {
        echo '<button type="submit" name="refuse" class="btn btn-danger mb-2" style="margin-left:5px;">Отклонить</button>';
    }
    echo '</div></div></form>';
}
