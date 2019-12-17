<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <title>Отзывы</title>
</head>

<body>
<!-- Авторизация -->
<?php if (!isset($_COOKIE['user'])) { ?>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand"></a>
        <form class="form-inline" method="post" action="admin/index.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Логин" name="login" aria-label="Login">
            <input class="form-control mr-sm-2" type="password" placeholder="Пароль" name="password"
                   aria-label="Password">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="loginform">Войти</button>
        </form>
    </nav>
<?php } else {
    echo '<a href="admin">Перейти в аккаунт администратора</a>';
} ?>
<div class="container">


    <!-- Сортировка -->
    <div class="row sort_it">
        <div class="col-md-4">
            <h5>Сортировать по ...</h5>
            <form action="" id='sort' method="post">
                <div class="form-group">
                    <select class="form-control" id="sortby" name="sortby">
                        <option value="date">По дате</option>
                        <option value="name">По имени</option>
                        <option value="email">По эл. почте</option>

                    </select>
                   <!-- <button type="button" class="btn btn-primary mb-2" id="sort">Сортировать</button>-->
                </div>
            </form>
        </div>
    </div>

    <!-- Список комментариев -->


    <h3>Все комментарии</h3>
    <div id="output"></div>


    <br>
    <!-- Форма отправки комментариев -->
    <h3>Оставьте комментарий</h3>
    <div class="row">
        <div class='col-md-12'>
            <div id="successmess">Отправлено</div>
            <div id="errormessage">Ошибка</div>
            <div id="errorempty">Вы не заполнили все необходимые поля</div>
            <form action="addcommet.php" id='form' method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id='name' name="name">
                    </div>
                    <div class="col">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" id='email' name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea class="form-control" rows="3" id='comment' name="comment"></textarea>

                </div>
                <div class="form-group">
                    <label for="image">Прикрепите картинку</label>
                    <input type="file" class="form-control-file" id="file" name="file">

                </div>
                <button type="submit" id="submit" name="submit" class="btn btn-primary mb-2">Отправить</button>


            </form>
            <div id="load"></div>
    </div>
</div>
</body>

<script src='main.js'></script>


</html>