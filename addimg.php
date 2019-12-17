<?php
if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $formats = array("jpg", "gif", "png");
    $format = @end(explode(".", $_FILES['image']['name']));
    if (in_array($format, $formats)) {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $dir = "pic/" . $_FILES['image']['name'] . "-" . time() . $format;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
                echo "<img src='" . $dir . " ' />";
            } else {
                echo $dir;
            }
        }
    } else {
        echo "Не верный формат файла";
    }
}
