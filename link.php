<?php session_start(); /* Starts the session */

if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style type="text/css">
        @import "bourbon";

    body {
        background: #eee !important;
    }

    .wrapper {
        margin-top: 80px;
      margin-bottom: 80px;
    }

    .form-signin {
      max-width: 380px;
      padding: 15px 35px 45px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid rgba(0,0,0,0.1);

      .form-signin-heading,
        .checkbox {
          margin-bottom: 30px;
        }

    .checkbox {
      font-weight: normal;
    }

    .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
        @include box-sizing(border-box);

        &:focus {
          z-index: 2;
        }
    }

    input[type="text"] {
      margin-bottom: -1px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }

    input[type="password"] {
      margin-bottom: 20px;
      border-top-left-radius: 0;}
}

    </style>
</head>
<body>
    <div class="container">
    <form action="" method="post">
    <label>Source: </label>
    <input class="form-control" type="text" name="source" id="textbox"/> </br>
    <label>Medium:</label>
    <input class="form-control" type="text" name="medium" id="textbox"/> </br>
    <label>Campaign:</label>
    <input class="form-control" type="text" name="campaign" id="textbox"/> </br>
    <input type="submit" value="Fake" class="btn btn-lg btn-primary"/></br>
    <br>
    </form>
<?php
error_reporting(0);
if ($_POST['source']) {
    $result = 'http://' . substr(md5(microtime()), rand(0, 26), 10) . '.' . $_SERVER['HTTP_HOST'] . '?utm_source=' . $_POST['source'] . '&utm_medium=' . $_POST['medium'] . '&utm_campaign=' . $_POST['campaign'];
    echo "Link share: " . "<a href ='$result'>" . $result . "</a>";
}
?>
