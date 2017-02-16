﻿<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Рута Вход</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
   <link href="ico/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  </head>

  <body>

    <div class="">

      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Пожалуйста войдите в систему</h2>
        <input type="text" name = "name" class="input-block-level" placeholder="Name">
        <input type="password" name = "password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="submit">Войти</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>	