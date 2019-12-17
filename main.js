$(document).ready(function () {
    $('#errormessage').hide();
    $('#errorempty').hide();
    $('#successmess').hide();




    function checkdatabase() {
        $('#output').empty();
        $.ajax({
            url: 'comment_list.php',
            dataType: 'json',
            cache: false,
            success: function (data) {
                $.each(data, function (index) {
                    console.log(data[index]);
                    if(data[index].updated == 1){
                    $('#output').append("<div class='row comment'><div class='col-md-4'>" + data[index].name + "<br>" + data[index].added + "<br>" + data[index].email + '<br>Изменен админом' + "</div><div class='col-md-6'>" + data[index].comment + "</div><div class='col-md-2'><img src='" + data[index].image + "' width='120' /> </div>");
                    }else {
                    $('#output').append("<div class='row comment'><div class='col-md-4'>" + data[index].name + "<br>" + data[index].added + "<br>" + data[index].email + "</div><div class='col-md-6'>" + data[index].comment + "</div><div class='col-md-2'><img src='" + data[index].image + "' width='120' /> </div>");
                    }
                });
            }
        });
    }

    function checkdatabase_by_name() {
        $('#output').empty();
        $.ajax({
            url: 'comment_list_by_name.php',
            dataType: 'json',
            cache: false,
            success: function (data) {
                $.each(data, function (index) {
                    console.log(data[index]);
                    if(data[index].updated == 1){
                        $('#output').append("<div class='row comment'><div class='col-md-4'>" + data[index].name + "<br>" + data[index].added + "<br>" + data[index].email + '<br>Изменен админом' + "</div><div class='col-md-6'>" + data[index].comment + "</div><div class='col-md-2'><img src='" + data[index].image + "' width='120' /> </div>");
                    }else {
                        $('#output').append("<div class='row comment'><div class='col-md-4'>" + data[index].name + "<br>" + data[index].added + "<br>" + data[index].email + "</div><div class='col-md-6'>" + data[index].comment + "</div><div class='col-md-2'><img src='" + data[index].image + "' width='120' /> </div>");
                    }
                });
            }
        });
    }

    function checkdatabase_by_email() {
        $('#output').empty();
        $.ajax({
            url: 'comment_list_by_email.php',
            dataType: 'json',
            cache: false,
            success: function (data) {
                $.each(data, function (index) {
                    console.log(data[index]);
                    if(data[index].updated == 1){
                        $('#output').append("<div class='row comment'><div class='col-md-4'>" + data[index].name + "<br>" + data[index].added + "<br>" + data[index].email + '<br>Изменен админом' + "</div><div class='col-md-6'>" + data[index].comment + "</div><div class='col-md-2'><img src='" + data[index].image + "' width='120' /> </div>");
                    }else {
                        $('#output').append("<div class='row comment'><div class='col-md-4'>" + data[index].name + "<br>" + data[index].added + "<br>" + data[index].email + "</div><div class='col-md-6'>" + data[index].comment + "</div><div class='col-md-2'><img src='" + data[index].image + "' width='120' /> </div>");
                    }

                });
            }
        });
    }


        $('#form').submit(function () {
            var formData = new FormData();

            var name = $('#name').val();
            var comment = $("#comment").val();
            var email = $("#email").val();
            var file = $("#file")[0].files[0];


            formData.append('name', name);
            formData.append('email', email);
            formData.append('comment', comment);
            formData.append('file', file);

            $.ajax({
                url: 'addcommet.php',
                enctype: 'multipart/form-data',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {

                    if (result == 'Все отправилось') {

                        $("#successmess").show();
                        $("#errormessage").hide();
                        $("#errorempty").hide();

                    } else if (result == 'Не указаны все данные') {

                        $("#errorempty").show();
                        $("#errormessage").hide();
                        $("#successmess").hide();
                    } else {

                        $("#errormessage").show();
                        $("#errorempty").hide();
                        $("#successmess").hide();
                    }
                }
            });
            return false;

        });
    checkdatabase();

   $("#sort").click(function () {

       var sort = $("#sortby").val();
       if(sort == 'email'){
           checkdatabase_by_email()
       }else if(sort == 'name'){
           checkdatabase_by_name();
       }else{
           checkdatabase();
       }

   });



});

