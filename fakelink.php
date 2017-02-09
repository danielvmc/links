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
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
}

    </style>
</head>
<body>
    <div class="container">
    <form action="" method="post">
    <label>Link giả:</label>
    <input class="form-control" type="text" name="fake_link" id="textbox"/> </br>
    <label>Người đăng: (Viết không dấu không hoa, VD minh)</label>
    <input class="form-control" type="text" name="user" id="textbox"/> </br>
    <label>Địa chỉ Đến:</label>
    <input class="form-control" type="text" name="url" id="textbox"/> </br>
    <input type="submit" value="Fake" class="btn btn-lg btn-primary"/></br>
    <br>
    </form>
    <?php
$listDomains = [
    'http://tuurl.info/',
    'http://minhurl.info/',
    'http://phucurl.info/',
];

$tuDomain = 'http://' . substr(md5(microtime()), rand(0, 26), 10) . '.' . 'tuurl.info';
$minhDomain = 'http://' . substr(md5(microtime()), rand(0, 26), 10) . '.' . 'minhurl.info';
$phucDomain = 'http://' . substr(md5(microtime()), rand(0, 26), 10) . '.' . 'phucurl.info';

function generateRandomString($length = 100)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-', ceil($length / strlen($x)))), 1, $length);
}

function randomAsciiChar($length)
{
    $char = '';
    for ($i = 0; $i < $length; $i++) {
        $char .= chr(rand(130, 172));
    }
    return $char;
}

function addHttp($url)
{
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

$randomOne = randomAsciiChar(200);
$randomTwo = randomAsciiChar(2000);
$randomUrlOne = 'http://' . generateRandomString() . '.' . $_SERVER['HTTP_HOST'] . '/';
$randomUrlTwo = 'http://' . generateRandomString() . '.' . $_SERVER['HTTP_HOST'] . '/';

error_reporting(0);
if ($_POST["url"]) {
    // $n=rand(0000,9999);
    // $pathname = substr(md5(microtime()), rand(0, 26), 500);
    $pathname = generateRandomString();
    $filePhp = $pathname . ".php";
    $fileHtml = $pathname . ".html";
    $fakeLinkHtml = 'fake' . $pathname . ".html";

    $tuHtml = './tu/' . $pathname . ".html";
    $minhHtml = './minh/' . $pathname . ".html";
    $phucHtml = './phuc/' . $pathname . ".html";

    $tuUrl = $tuDomain . '/tu/' . $pathname . ".html";
    $minhUrl = $minhDomain . '/minh/' . $pathname . ".html";
    $phucUrl = $phucDomain . '/phuc/' . $pathname . ".html";

    $fakeLink = $_POST['fake_link'];
    $mainLink = $_POST['url'] . '/?utm_source=' . $_POST['user'] . '&utm_medium=Facebook';
    $fphp = fopen($filePhp, 'w');
    $fhtml = fopen($fileHtml, 'w');
    $fTuHtml = fopen($tuHtml, 'w');
    $fMinhHtml = fopen($minhHtml, 'w');
    $fPhucHtml = fopen($phucHtml, 'w');
    $fFakeLink = fopen($fakeLinkHtml, 'w');

    $htmlString = '
    <!DOCTYPE html PUBLIC \\"-//W3C//DTD XHTML 1.0 Transitional//EN\\" \\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\\">
  <html xmlns=\\"http://www.w3.org/1999/xhtml\\">
  <head>
  <meta http-equiv=\\"Content-Type\\" content=\\"text/html; charset=utf-8\\">
  <title></title>
  <meta property=\\"fb:app_id\\" content=\\"\\">
  <meta property=\\"og:site_name\\" content=\\"......\\">
  <meta name=\\"viewport\\" content=\\"width=device-width, initial-scale=1\\">
  <meta name=\\"robots\\" content=\\"noindex,nofollow\\">
  <style>
  *{
  text-align: center;
  }
  </style>
  </head>
  <body>

  <script>
  function go() {
  window.frames[0].document.body.innerHTML = \'<form target=\\"_parent\\" method=\\"get\\" action=\\"' . $tuUrl . '\\";></form>\';
  window.frames[0].document.forms[0].submit();
  }
  </script>
  <iframe onload=\\"window.setTimeout(\'go()\', 0)\\" src=\\"about:blank\\" style=\\"visibility:hidden\\"></iframe>
  </body>
  </html>
    ';
    $htmlTu = "
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"vi\" prefix=\"og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<meta name=\"googlebot\" content=\"noarchive\"/>
<meta content=\"noindex, nofollow\" name=\"robots\"/>
<title>Loading......</title>
<meta property=\"og:url\" content=\"$fakeLink\"/>
</head>
<body>
  <script>
  function go() {
  window.frames[0].document.body.innerHTML = '<form target=\"_parent\" method=\"get\" action=\"$minhUrl\";></form>';
  window.frames[0].document.forms[0].submit();
  }
  </script>
  <iframe onload=\"window.setTimeout('go()', 0)\" src=\"about:blank\" style=\"visibility:hidden\"></iframe>
  </body>
  </html>

    ";

    $htmlMinh = "
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"vi\" prefix=\"og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<meta name=\"googlebot\" content=\"noarchive\"/>
<meta content=\"noindex, nofollow\" name=\"robots\"/>
<title>Loading......</title>
<meta property=\"og:url\" content=\"$fakeLink\"/>
</head>
<body>
  <script>
  function go() {
  window.frames[0].document.body.innerHTML = '<form target=\"_parent\" method=\"get\" action=\"$phucUrl\";></form>';
  window.frames[0].document.forms[0].submit();
  }
  </script>
  <iframe onload=\"window.setTimeout('go()', 0)\" src=\"about:blank\" style=\"visibility:hidden\"></iframe>
  </body>
  </html>

    ";

    $htmlPhuc = "
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"vi\" prefix=\"og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<meta name=\"googlebot\" content=\"noarchive\"/>
<meta content=\"noindex, nofollow\" name=\"robots\"/>
<title>Loading......</title>
<meta property=\"og:url\" content=\"$fakeLink\"/>
</head>
<body>
  <script>
  function go() {
  window.frames[0].document.body.innerHTML = '<form target=\"_parent\" method=\"post\" action=\"$mainLink\";></form>';
  window.frames[0].document.forms[0].submit();
  }
  </script>
  <iframe onload=\"window.setTimeout('go()', 0)\" src=\"about:blank\" style=\"visibility:hidden\"></iframe>
  </body>
  </html>

    ";

    fwrite($fhtml, $htmlString);
    fclose($fhtml);
    fwrite($fTuHtml, $htmlTu);
    fclose($fTuHtml);
    fwrite($fMinhHtml, $htmlMinh);
    fclose($fMinhHtml);
    fwrite($fPhucHtml, $htmlPhuc);
    fclose($fPhucHtml);

    $redirectString = "
    <script type='text/javascript'>// <![CDATA[
    var d='<data:blog.url/>';
    d=d.replace(/.*\/\/[^\/]*/, '');
    location.href = '" . $fileHtml . "';
    // ]]></script>
    ";

    $facebookCheat = '
<!DOCTYPE html PUBLIC \\"-//W3C//DTD XHTML 1.0 Transitional//EN\\" \\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\\">
<html xmlns=\\"http://www.w3.org/1999/xhtml\\">
<head>
<meta http-equiv=\\"content-type\\" content=\\"text/html; charset=utf-8\\">
<meta http-equiv=\\"Content-Type\\" content=\\"text/html; charset=utf-8\\">
<title>ÂÃÃÃ±·¾Â¼Ã¬»ÂÂÂÃÂÃÃÂÂÃ«Â¼ÂÂÃÂÂÂÃÂÃÃÃÃÃÂÃÃ·ÂÂ¾¯ÃÂÂ¶±™Â·Â±ÂÂÃÂ©ÃÃºÂ¶ÂÃÂÃ©Â³»º¡²‹ÃÂ±ÂÃÃÂÃÂ‹ÂÃ¬¡ÃÃÂ²ÂÂÂÂ</title>
<meta property=\\"fb:app_id\\" content=\\"\\">
<meta property=\\"article:author\\" content=\\"https://www.facebook.com/4795236469298187\\">
<meta property=\\"og:site_name\\" content=\\"ƒÂÂÃÂÃƒÂ¾ÂÃ¬Ã³ÃÂÂÂÂ‹ÂÂÂ©«ÃÂÃ«ÂÂÂÃÂÃ³ÂÂÃÂÂ¡Â³™™ÂÃÃÂ\\">
<meta name=\\"news_keywords\\" content=\\"Bernie Sanders, Warriors, Democrats,Politics,2016 Election\\">
<meta name=\\"viewport\\" content=\\"initial-scale=1.0, maximum-scale=1.0, user-scalable=no\\">
<meta name=\\"robots\\" content=\\"noindex,nofollow\\">
<meta property=\\"image:width\\" content=\\"1280\\">
<meta property=\\"image:height\\" content=\\"720\\">
<meta name=\\"description\\" content=\\"Â¡Ã«Ã™Ã«ÃÂÃ½Ã¼ÂÃ©Ã¸ÂÃ±‹ÂÂÂÃÂÂÂÂÃ«ÂÂÂÂÃÃÃÂ©Â©ÂÃÃÃ³™ÃÃ½ÂÂ¸ÃÂÃÂ¶ÃÃ»ÃÂÂƒÂÃ«™»Ã»²ÂÂÃ©ÂÃÃÂÃÂÂÃÂ‹ÂÃÂÃÂ¸ÃÃÃÂÂ™ÂÃÂ¶ÂÃ·™ÂÂ«Ã™‹ÃÂÃÂÂ¡ÂÂÃÂÃÃÂÂÃÂÂ©ÂÃÂÃºÂ«¾Â²ÂÂ¾ÃÃƒÃ¶ÃÃÃÂ»ÃÃÂÂÂÃÃ‹ÂÃÂÂÂÃÃÂÃÂ‹ÂÂÂÂÂÃ©³±Â‹·ÃÂ™ÂÂÃÂÃÂÂ¸Ã\\">
<meta name=\\"keywords\\" content=\\"ÂÃÂÂÃÂÂ¬ÃÃÂÂ©ÃÃÂÂÃÂ‹ÃÂÂÂ™ÃÂÃÃÂÂ²ÃÃ‹™¼ÃÂÃÂ¾ÃÂÂÃ¾ÂÃÂÂÂ»¼ÃÃÃ·ÃÃÂÃ½ÃÃ¯Ã¶ÃÂ³²ÂÂÂ¡ÂÃÂ¾ÂÂÃÂÂ‹ÃÃ«ÂÂÃÃÂÂÃÃ‹ÂÂ\\">
<meta name=\\"fb_title\\" content=\\"ÂÃÃÃ±·¾Â¼Ã¬»ÂÂÂÃÂÃÃÂÂÃ«Â¼ÂÂÃÂÂÂÃÂÃÃÃÃÃÂÃÃ·ÂÂ¾¯ÃÂÂ¶±™Â·Â±ÂÂÃÂ©ÃÃºÂ¶ÂÃÂÃ©Â³»º¡²‹ÃÂ±ÂÃÃÂÃÂ‹ÂÃ¬¡ÃÃÂ²ÂÂÂÂ\\">
<meta property=\\"og:type\\" content=\\"website\\">
<meta property=\\"og:title\\" content=\\"ÂÃÃÃ±·¾Â¼Ã¬»ÂÂÂÃÂÃÃÂÂÃ«Â¼ÂÂÃÂÂÂÃÂÃÃÃÃÃÂÃÃ·ÂÂ¾¯ÃÂÂ¶±™Â·Â±ÂÂÃÂ©ÃÃºÂ¶ÂÃÂÃ©Â³»º¡²‹ÃÂ±ÂÃÃÂÃÂ‹ÂÃ¬¡ÃÃÂ²ÂÂÂÂ\\">
<meta property=\\"og:description\\" content=\\"Â¡Ã«Ã™Ã«ÃÂÃ½Ã¼ÂÃ©Ã¸ÂÃ±‹ÂÂÂÃÂÂÂÂÃ«ÂÂÂÂÃÃÃÂ©Â©ÂÃÃÃ³™ÃÃ½ÂÂ¸ÃÂÃÂ¶ÃÃ»ÃÂÂƒÂÃ«™»Ã»²ÂÂÃ©ÂÃÃÂÃÂÂÃÂ‹ÂÃÂÃÂ¸ÃÃÃÂÂ™ÂÃÂ¶ÂÃ·™ÂÂ«Ã™‹ÃÂÃÂÂ¡ÂÂÃÂÃÃÂÂÃÂÂ©ÂÃÂÃºÂ«¾Â²ÂÂ¾ÃÃƒÃ¶ÃÃÃÂ»ÃÃÂÂÂÃÃ‹ÂÃÂÂÂÃÃÂÃÂ‹ÂÂÂÂÂÃ©³±Â‹·ÃÂ™ÂÂÃÂÃÂÂ¸Ã\\">
<meta property=\\"url\\" content=\\"' . $randomUrlOne . 'ÃÂ™ÃÃÃÂÃÂÃ¾ÂÂÂÂÃÃÃ·»¬ÃÃÂÃÃ«ÂÂ»¼ÂÃÂÃÃ·ÂÂÂ½ÂÃÃÃÂÂÂÂ¡Ã½ÂÂÃÃÂÃÃÂÃÂÃ·ÂÃÂÂ‹²ÂÃ³Ã¾Â¼Â±ÃÂÃÂÃÃÃ¬ÂÂ™ÂÃ²ÂÃÃÂÃÃÃÂ‹ÂÂºÂÃ¼ÂÂÃÃÃÂÃÂÂÂ«ÂÃ½ÂÃÂ«‹ºÃÃ»ÃÂÂ¶ÂÃÂ±¼ÂÃÃÂÃÂ¼©™Ã±Â™Â¼Ã½ÃÃÂº‹ÂÂ¬ÃÃÂ©ÃÂÃ»ÃÃÃÃÂÂƒÂÂÃÂÂ¼ÃÃÃÃ·©ƒÂÂ«ÃÃÂºÂÃÂÃÃ·¡Ã½©ÂÂÂÂÃ¼ÃÃÂ²ÂÂÃÃÂº™Â¼Ã½ÂÂ¯ÃÂÃÃÃÃ³¶ÂÂÃ±ÂÃ™ÃÂÂÃƒÃÂÃÃ©ÂÂ±ÃÃÃÃÃÃÂ±ÃÂÃ¬ÂÃÃÂƒ©Ã±«Ã‹Â²ÃÃÃÂÂÂÃÃÃÂÂ™«ÃÃÃ·º»²Â¡©¡ÃÂÂÃ»ÃÃÂÃÃºÃÂ¶ÃÂÃÃÂÃÂ²ÂÂÂÂÂ·Ã³ÂÂÂ»ÂÂÃ¶ÂÃºÂ±ÃÃÂÃ¸ÃÂ³ÂÃÃ¸ÃÃ¾ÃÃÃÃÂ¬ÃÃÃ™ÂÃÃÂÃÃÂÃÃÃÂ¸Ã¶Â·ÃÂÂÂÂÃ³Ã½©ÃÃƒÃ¯ÂÂÂÃÃ²ÃÂÂÂÂÂ©ÂÂÂÂÂ‹ÃÃÃ¼ÂÂÃÃÃ¸ÃÂÂÂ¡ÂÃƒƒ¸·Ã©ÃÂÃÃÂ±ÃÃÂ±ÃÃÂÂÂÃ¾ƒÃÂƒÂÂÂÂƒÃ™±ÂÃÃÂ©ÂÂÃÃÂ¼ƒÂÂÃÃÂÃÂ¡¾ÃÂÃÃ·ÃÃÂÃ²¾²¶ÂÃÂÂ±ÂÃ»Ã¡ÃÂÃ¼ÃÃÂ½Â¡ÂÃÂÂÃÂÂÂÃÃÂÃÃÂÂÂÃÃ¯ÂÃ¶ÃÃ½ÃÂ¼ÂÂƒ³ÂÂÃ·Ã½ÃÃÃÃ«Â‹ÃÂÂÃ²·ƒÂÂ©Ã²±ºÂÃ¯ÂÃ‹¯ÂÃ¼ÃÂ‹Â·ÂÂÂÃÃÂÂÃÂÃÂÂ±™¡‹ÂÃÃÂ¡ÃÃÃ»ÃÂ¾½ÂÃÃÂÂÃÂÃ»ÂÂÂ¶¶‹ÂÂÂÃÃ¬ÃÂ««ÃÃÃÂ²ÃÃÂÂÂÃ¾ÃÂÃÂÂ·ÃÂ½ºÂÂÃÃÂÃÃ½ÂÃÂÂÂÂÃÃ±ÂÃÂ¯™©Ã²¾ÂÂ³ÂÃÃÃÃÂÂÃÃÃÃ¬¾½ÂÂÃÂ¶Ã‹ÂÃÃÃÂ³«ÃÃÃÂÃÂÃÂÂÃÂÃÃ¾Ã¯ÃÃÃ¾Â·¬¯ÂÃÃÂÃÂÂÂ»Ã³ºÂÂ·¶³ƒÂÃÂ¼¬ÂÂÃ¼‹Ã™ÃÂÂÃÂÂÂ²²¸ÂÂ¶¸ÃÂƒ‹ÃÃÃÃÂÂ«¾¯±Ã©ÂÃÃ²ÂÂƒÂÂ‹ÃºÃÂ»Ã»ÂÂ¶ÃÂÂÂÃ™Â¶ÃÃÃ‹²«ÃÃÂÃÂ¯ÃÃÂÂÂÃÃÂ·ÂÃ©ÃÃÂÂ©ƒÃ¾Ã¡Â·ÃÂ¡ÃÃ™ÃÃÃÂÂÃ¾ÂÂ»Â‹‹ÂÂÃÂÂÃÂÃÂÃÃÃºÃÃÂÃ¸ÂÂ«ÂÂ·ÂÂÂ¾‹¡Â¼Ã¡Â‹ÃÂÂÂÃÃÂ©ƒÃÃ¼¬ÂÂÂ©Ã±·ÂÂºÃÃÃÃÂÃÂƒÃ³ƒƒÃ‹Ã¶ÂÂÃÃÃÃÂÃÃ½ÃÂ»¶™ÃÃÂÃ¡Ã¼Ã³Â¯ÃÂ±ÃÂ¸ÃÃ³ÂÂÂÂÂ¼¼¼ÃÂÂ²¾Ã¼½¶¬Â·ÃÂÃ³ÂÂÃÃÃºÂÃÂÂ«¾ÃÃÃÃÂÂ‹ÃÂÃ·ÂÂ©‹ÃÃÂÂ¶ÃÂÃÂ¾ÂÂÃÂÂÃÃÃÃ¯ÃÃÃÂ·ÃÂÂÂÃ¸Â¬ÃÂ™Ã‹¸©ÂÂÂ½ÃÃÂÃÃÃÂ©ÃÃÃºÃÂÂÂÃÃÂÂ±¸ÃÂÂÂÃÂÃÂºÂº·«ÃƒÃÃÂÂÂ»ÂÂƒ¯»±¬ÂÃÃ¬ÂÂ¸Ã«ÂÂÃÂÂ™±ÃÂÂ¶ÂÃ·ÂÃÂÃÂÃÂÃÃÂ©Ã±ÃÃÂ³¸ÂÂ©ÂÂÂÂÃ±º¾±¼Ã‹º¡Ã™ÂÂ±ÃÃÂÃÃ²ÃÂÃÂÃÃÂ»¯ÂÂÂÃƒÃÂÂ»ÂÂÂÃ¸ÃÃÂ»Â±‹ÃÂ¬ÂÂ¸Â·ÃÂÃÂÃÃÃÂ¶ÃºÂ™ÃÂ½™ÂÃÃ¯Ã²ÃºÂ·ÃÂ¸ÂÂÂÂÂÃ·ÂÂÃÃÂÃÂ±ÂÂÃÂ»™ÃÂÃÂ»Ã¯·ÂÃÂÂÂÂ²ÂÂ½ÃÂÃÂÂ½ÂÂÂÃ‹ÃÂÃÃ¬ÂÃÂÂÃ¾ÃÂ©³ÃÃÃÃ¼ÂÂÃÂÃÂÂÂ¾Ã«Â¶½ÂÂÂ±¶ÂÂÂÂÃÃÂ™ÃÃÂÂƒÂÃÃÃÃÃ½Ã·¸¬ÃÂÂ¯Ã¶ÂÃÃÃ³ÃÂÂÂÂÂÂÂÃÂ¾ÂÃÃÂ±ÃÂÃÂÂ™ÂÃÂ²ÂÂÂÂÂÂ«ÂÃÂÂÃÃÃÃ™ÂÃÂÃÃÂÃÂÃÂ¡ÂÂÂ¬ÃÃÃ¬ÃÂÃÃÂÂ½¾ÃÂ¸ÃÃÂÂÃÂÂÂ»ÃÃÃ¾Ã¼¶ÃÂÂÃÂÂÃ¸ÂÂÃ±ÂÂ¸ÂÃ¡ÃÃ‹¾«ÃÃÂÂÃÂÂÂÂÃÃÃº‹¯·ÃÂÂÂÃÃ±ÃÃ¯ÃÃÂÂÃÂ¯ÂÂÃÂÂÂÃ«Ã‹ÂÃÃÃ¡ÂÃ¸Ã¸Â‹Â¼¾ÂÂÃ²¶ÃÂ·¬ÂÃÂÃ«º™ÃÂÂÃÃÃ±¬Ã±¯ÃÃÂÂÃÃÂÃ™ÂÃÃÃÂÂÃ¼Ã±©™ÂÂÃ¾ÂÂÂ±™¸ÂÂÃÃÃÂÂÂÂ¡ƒ©ƒ¬ÃÃÃ¡©¶ÂÃ‹ÂÃ»ÂÃÃÃÃÃ²ÂÃ¬½‹ÂÂÂÃÂ·¶±Â±ÃÂÂÃÂÂ©ÃÃÃÃ±»™¼©ÂÂÂÂÂÂÂ‹Ã™ÂÃÂÃÂÂÂÃÃÃƒÂÃ¬¸Ã™Â³¾ÃÂÂÃÂÂÂÂÂ²ÂÂÃÃÃ¸ÃÃÂÂÃ¯Â‹ÃÂÂ¯«ÂÃÃÃÃÃÃÃÃ‹ÂºÂÃÃ¬Â²ÂÂÂƒÂ·¯ÃÂÂÃÃÂÂÂÃÂ½«Â™¡ÂÃÂ±¼ºÃ¡ÃÂÂÃ¸ÃÂÂÂÂÃ±ÃÂ™ÂÂÃƒÂƒÃ¬ÂÃÂƒ¶¯³Â¶ÂÂÃÃÃÂÃÃÂÂƒ²ÂÃÃƒÂÃÃÂÃÂÂ¸ÂÃ¡ÃÃÂÃÂÂ·«ÂÃÃ¸ÃÃÃÃÃ½ÃÂÂÂÃ²Ã‹ÂÂÃ¾¯‹™ÃÃ‹Â‹¬¾Ã¬ÂÂºÂ‹‹ÂÂ¾ÂÃ¾²«ÂÃÂÃÃÂÃ¸ÃÃÂÂÂ‹»ÃÂ·ÃÂ¬¡¸ÂÃÂÂÂ±·ÂÂ¼ÂÂ¼½Ã³ÂƒÂÂÂÃ³¸ÃÃÂÂÂÃ·ÂÂºÂÃÃ³ÂÃ«ÂÂÂÂÃÂÂÂ¾Ã¶·Ã¾™ÃÃÂÃÃÂºÂÂƒÂÂÃÂÂÂÃÂÂÃ‹¾Â»ÂÂÃ¡ÂÃÃÃÂ‹ÂÃÃ»²ÂÂÂ‹³ÃÂÂ¶ÃÃÂ²ÃÂÃÃÂ·ÂÃÃ¸ÃÃ²ÂÂÂÂÂÂ³²ÂÃ¡ÂÃÂÃÃÃÂÃÃÂÂÂÂÃÃÂÃÂÃÂÃ¼ÃÂ¡·ÂÃÃ‹ÂÃÃÃÂÃÃÂÃÃƒÂÂ¡Ã¯ÂÂÂÃÂÂÃÂÂÃÃÂÂÃ©Â²ÃÂÂÂ¬Â¸Ã²ÂÂÂ©ÂÃÂÃÃ¶ÃÂ©ÃÂÂÂÂ²³Ã¬ÂÂÂÃ¼ÂÃÂÃÃÃÂÂÂÃ¬Â¸ÂÂ·ÃÂÂÃÃÃÂ¬ÂÂ¯ÃÂÂ¶‹ÃÃÂÃ¸ÂÃÂÃ¬«Ã¸ÂÂÃÂÃÃ‹ÃÃ™ÂÂÃÂÃÂÂ³ÃÂ¾Ã‹ÂÂÂ¸Ã¶Ã²ÃÂÃÃ™ƒÂÃÃÃÃÃÃÃƒÃ‹Ãƒ·Ã³³‹Ã«ÃÃÃ¸Ã»ÂÃÃÂÂÃÃÂÂÃÃ™·ÂÂ³ÂÃÃÃ¼ÂÃ¯ÂÂÂÃÃÂÃÃÂÃÃ½ºÃÃ™ÂÃÃÂÃÃ²©ÂÃÃÂÃ²ÃƒÃÂÂÃÂÂÂÃÃÃÃÂÂÃÃÃÂÃ²ÂÃ±ÂÂÂ½ÃÂÂÃÃÂÃÃÂÂÃ³ÃÂ½ÂÂÂÃÃÂÃÃÃÂÂÂÂ™ÂÂÃƒÃ¬¯ÃÂ™Ã¯Â«ÂÃ¬Â‹‹ÃÃÃÂ·ÃÂÂÃÂÃ‹Â³Â²±ƒÃÃÂÂÃÂÃÂ¯¸±ÃÃ¡ÃÃÃÃÂÂÂ¸Â‹ÂÂÂÂÂƒÃ‹¡±ÂÂÂÃÃ³ÃÂ©ÂÂÂÃÂ·ÂÂÂÃÃÃÂÂÂÃÂÃÃÂÂÂ·ÃÃÃÂÃÃÃÂÃÃ‹ÂÂ‹ÃÂÂ‹ÃÃÂ‹ÃÂÃÃ½ÂÃÂº‹ÂºÃ«Â‹ÃÂÂÃÃÂÂÂÃ±ÂÂÂÃÂÃÃÃÂ½ÃÂƒ¬·Ã‹ÃÂ©ÃÂÃÃ½ºÂÂÂÂ‹ÃÂÃÂÂÂÂ©ÃÃÂÂÃÃ¬¬ÃÂ‹²½™‹·ºÂÃÂÃ¶ÃÃÃÂƒÂÃ¶ÃÂ¶ºÂÂÂÃ½¸«ÂÂ¬»ÃÃÃÂÂÂÂÃÃ«ÂÂÂÃºÂÂÂÃÃÃ¾Â»¯ÂÃÃÃÂÃÃ¸ÃÂÃ³ÃÂÂÃÃÃÃ¬ÃÃÂ©Ã¶ÂÂÂ«©ÂÃÂÂ‹ÂÂÂÃÃÂÃÃ³ÃÃÂºÂÂÃ©ÂÃÃÂ™«¾º¼ÂÃÂÃ¯ÃÂÃÃÃ¬ÃÂÃÂºÃÂƒÂÂÂÃÃÂÂÂÃÃÂ‹Â±Â¾ÃÂÂ¶ÃÃ¼ÃÃÂÂÂ¬ÃÂÂ·ÂÃÂ·Ã¼ÂÂÃÃÂÂÂÂÃÂ¸ÃÃÂ·¼ÂÃÂÃÃÃÂÃ¯ÂÂÂ©ÂÂÂÃÂ¼Â»ÃÂÂÂÃ¯ÂÂ¸Â«ÃÂ¡¼ÂÃÂÃÃ··Ã©¾ÂÃÃ«ÃÂÂÃ‹Â¬ÃÃÂ¶ÃÃÂÃÂÃÂÂÂÃÃÃ·ÃÂ·™ÂÂÂÃÃÃÂ©ÃÂÂ²ÃÃÂÂ±‹ÂÂ¯ÃÃÂÂ¾ÂÃÃÃÃ»ÃÃÂÂ¼‹ÃÃÃÃÃÂÂ·ÂÂ‹Â³Ã±‹ÃÃÂÃÃÂÃÂÂÂƒÂÃ²ÃÂ™ÃÂÃÃÂÂÃÂ©Ã¾¡ÂÂÂÃÃÂƒÂ»ÃÂÃÂÃÃ«·ÃÂÃÃ«ÃÂÃ‹ÃÃÂÂÃ.html\\">
<link id=\\"canonical\\" rel=\\"canonical\\" href=\\"' . $randomUrlTwo . '%E5%B0%B3%94%8C%AC%BB%B0%9C%90%E5%A5%8A%E5%8F%A1%B7%A1%BA%E4%84%8F%A5%95%83%9A%E4%E6%E8%E7%E8%E9%AF%B5%E7%BC%8F%AB%83%E9%97%AE%BC%BC%88%A8%E6%AE%94%8E%E5%A6%E7%A2%86%BC%93%E4%99%BD%94%E4%B0%E7%B4%A1%E6%A3%E4%AD%E9%94%E9%AE%E8%E8%E6%A2%82%8F%94%9F%97%AD%A7%A5%8C%8D%8D%E7%E4%E9%AD%80%BF%E7%86%B5%94%89%E8%A5%9A%E8%BD%A4%BB%85%E8%A0%B7%9F%AF%9C%8E%E4%B9%B8%E5%E5%E9%E5%AD%9F%BA%B3%89%90%E5%B0%AC%E8%B7%85%95%85%9C%8B%E2%E7%BF%9B%B8%BB%E8%98%99%A8%E3%E5%88%9E%E5%B9%E5%BF%91%E8%A6%BC%B9%9F%81%B7%B2%E6%A7%8B%B8%E7%92%E5%87%E5%8F%81%8D%82%B8%E5%B3%BB%9A%BA%86%B9%B4%96%9B%97%E8%A4%81%E4%AF%E5%87%E6%9F%97%E9%85%B9%8F%80%E5%87%8E%AE%AE%E5%B3%E6%E8%91%BA%E6%B5%86%90%B4%E8%A6%8A%9F%E5%E7%83%E5%AF%E5%E6%B9%AE%E4%E8%9F%E7%E5%BB%83%B0%B8%E5%A6%B1%9C%E9%B8%B7%E6%90%B0%E5%93%9E%E5%BE%98%93%E6%AE%89%95%B8%97%E4%E5%B2%BF%80%8B%E5%E7%98%8D%E9%E7%85%B0%96%E4%80%98%E6%84%BB%89%AE%8D%BC%8B%95%B3%8D%E5%E6%E5%8F%E6%E5%9C%B0%8D%AB%BF%8B%8A%E5%A6%E9%A4%E8%E4%AB%97%E6%9D%AC%AF%AD%8D%9C%E8%B7%E5%AF%E5%A3%E5%94%AD%83%B4%E7%E9%8A%9B%B4%87%E6%E7%BC%E7%B8%E4%E8%E5%90%9C%A5%85%E8%A8%A4%A7%90%A8%E9%A8%BF%BF%91%AD%A1%AB%E8%BE%93%81%E6%E9%E5%BD%91%BB%97%B8%83%E5%BD%B9%88%E5%E8%8C%E5%84%B6%80%9C%E6%B5%B1%AB%B7%BF%E6%E6%8F%E5%80%89%E5%9E%AE%AD%A4%E6%E8%E5%E7%A7%E6%A9%98%A9%AF%83%BD%8A%BA%AE%B2%E5%8A%E8%B1%E6%AB%84%E6%AA%BB%A7%96%96%86%86%E5%B7%B0%83%AF%9B%E6%9B%A6%81%AE%E5%B4%E6%E5%80%90%8F%E8%BD%E8%B0%B4%96%E5%E8%B4%B3%8E%80%E8%E8%BA%AE%B8%81%90%BB%E4%E5%8D%9D%87%BF%83%9D%E6%E7%8F%B2%8C%B3%8E%87%88%93%E5%BF%E7%BB%AA%E6%E7%E6%BB%E9%A4%8D%90%E6%B3%AE%85%80%E4%97%AB%8E%A2%8B%E7%9B%E8%9A%E6%8F%E7%85%B3%E4%92%B2%E5%E5%A7%E9%9B%9D%E4%BE%94%AC%BA%84%91%96%B8%A7%90%AF%8B%E7%97%A5%B9%9E%AE%AD%E5%A5%95%E6%E5%E8%A8%A0%E6%B7%9D%E8%84%E8%E8%E5%C2%83%90%96%E8%BC%E5%E6%B3%B2%E5%E5%85%8A%B7%BA%E8%B1%E5%E6%BE%A1%E5%BF%B5%90%E6%B3%BB%E5%BA%AD%A3%E7%9C%E9%B4%BF%86%E4%8C%80%E7%97%E7%E5%81%85%E7%E8%89%E6%AA%C2%9F%85%E5%85%E7%92%B6%E4%E6%E6%AF%94%BD%A5%E5%8D%95%89%B1%E7%B0%86%88%85%BB%A7%A5%80%B5%A1%B4%85%89%E8%B9%B8%8D%85%8F%A5%86%E8%90%A2%9B%B2%87%BA%8E%E6%88%80%8D%8A%E6%A0%AE%8D%83%E7%A4%99%9C%E8%B2%E9%AC%A5%BA%80%80%8F%81%A6%A8%90%92%9F%96%E7%92%B7%BB%96%BF%B4%E8%8B%8F%B9%91%85%E4%BF%AF%85%82%E5%E5%B9%E6%E6%B3%B8%E5%BB%E8%8F%B8%E5%8E%E8%E6%85%A0%B8%8A%82%A9%AD%E8%AC%E9%AF%92%B2%E7%81%9D%91%BA%E5%E7%9A%AD%BC%A9%9A%A7%E9%E5%E5%B1%E8%B9%B7%86%A5%93%A4%8F%E5%E7%8D%91%E7%A9%A3%AB%B8%BC%E5%97%81%A8%86%E6%BD%B6%E6%BB%B1%B3%BF%E5%85%C2%E5%B3%E4%8B%83%9B%81%B8%E6%AF%BD%E6%A6%B6%B3%B4%9E%9E%BA%BA%E8%BC%BB%8C%BA%9D%BB%E7%83%83%BB%8F%85%90%A1%B9%E5%96%9A%8D%A3%E5%E6%89%B7%8B%E6%8E%E4%8F%86%E5%86%E7%91%E4%B0%80%86%E6%BC%A5%E7%BE%A0%E5%E3%81%E6%E7%E5%E7%E6%A5%E6%81%A8%9E%97%86%E6%90%81%BC%B2%8B%BD%B5%A2%E8%B1%BA%E7%B1%E5%E8%E5%E5%AF%E7%B2%86%E6%E6%E8%A7%B3%BB%E7%8C%86%8F%81%86%9F%9C%E5%BA%E7%E6%A9%9A%9C%E9%E6%BF%96%A1%B5%85%B9%9F%BF%8C%81%96%E5%E7%A3%B9%BB%93%E5%9D%E4%AF%E7%B0%E5%BA%E9%E5%E5%80%E3%A9%86%8F%A2%B4%90%9C%AB%B9%90%87%98%B7%8D%E7%AB%82%E9%BE%A6%E5%E8%9B%85%E8%E5%E7%BE%E4%8D%E8%E5%B6%E5%B9%B9%97%AD%BC%BF%E7%E5%BE%9A%81%9D%BB%BD%A0%B4%A6%E5%8C%E5%AB%B9%BB%B6%95%8F%91%9C%89%88%E4%86%84%E6%AF%E8%82%85%9A%91%AF%BA%98%B3%E8%A9%89%97%83%A8%BB%81%A7%B9%80%A9%E4%E5%E8%E5%B7%A8%AC%E6%85%E7%8F%E4%B2%E5%B9%E6%83%B7%81%8D%83%E9%E5%E5%A5%E4%E3%E4%AD%B0%8A%C2%E6%E6%B3%93%A7%B3%E9%E5%90%B0%A0%80%AF%8D%E4%94%E6%E5%E8%AC%8F%B1%99%E4%9F%84%AC%81%BC%B4%BB%84%A7%E9%81%E5%93%BF%B8%E4%83%B8%E8%8D%8C%E5%96%B7%E6%94%A8%AE%81%BF%E5%E8%88%BA%E7%E8%E4%8B%E6%E5%E4%81%B0%9A%E6%E9%B3%B3%BF%E6%E7%E5%90%E5%E5%8B%E4%89%8C%E7%AE%B3%E6%E5%E5%9F%8D%90%E7%E8%AC%E8%BF%9F%E8%E7%B4%E6%A4%90%99%97%E6%93%E6%E5%8E%A6%8D%E9%AB%A2%A4%B3%E6%E7%BA%85%AB%E6%97%E5%8D%E6%E5%8C%AF%E9%AA%E6%9F%E5%E5%8D%E6%A9%A6%8D%8C%E8%AA%A1%E5%B2%B4%E5%80%97%88%95%BE%E5%8B%81%9A%E8%8F%BA%E6%BF%AF%E5%81%E6%A5%B4%E2%86%B8%B7%95%E7%AF%81%E6%BF%A9%B1%E6%BA%98%92%A1%BD%B5%88%A3%9D%E8%A8%AD%E5%A1%97%E5%A6%B8%E4%E8%E6%A8%99%E5%89%B8%A1%BE%B1%B2%E3%A0%A0%E8%E6%A7%A9%E4%E4%E4%BF%8F%E5%B2%E6%85%AA%E6%8B%B8%E6%A4%E5%83%91%B6%94%E4%E8%AA%B4%B6%E5%AE%E5%BC%8F%8C%97%AD%97%9C%BB%92%AD%8C%E5%E5%9D%9F%BF%B2%8B%E5%AA%85%E5%A9%E5%BD%E9%E8%84%8B%B0%8A%E5%E7%E5%E4%AF%AD%90%92%A7%86%91%AF%E8%B2%E4%86%E5%E7%BF%A2%E7%9F%A3%94%E6%8F%E8%8A%BD%A4%8A%B0%E8%81%A5%E5%81%85%A9%E8%E6%A6%94%96%E5%9C%8D%E5%88%90%E5%AD%80%8A%E8%83%88%AE%E8%9D%BF%8B%E6%93%87%B6%85%AE%B3%A1%E7%E4%88%9B%BC%B9%90%AB%81%E8%99%81%90%B4%A6%B0%E4%80%90%A8%E8%90%E6%A4%85%8B%93%B7%A8%B0%E5%A6%88%87%BF%E5%88%E5%E7%E7%E5%E4%E5%AD%E9%E5%E6%E5%8E%90%B0%9D%BC%96%96%E8%B6%80%E8%E7%E9%92%E7%A4%BB%AA%83%AD%88%B7%E9%9E%9F%AF%AC%E5%E5%B8%B1%A2%8D%E5%E7%B8%96%8A%A2%8C%9D%8C%80%BA%E6%8A%AE%BC%8C%E5%80%E4%9D%E7%A7%9C%AF%97%B9%E5%A6%E9%BC%90%9E%9A%E5%A3%A7%B3%8C%E9%AA%81%BB%8E%E4%E5%E6%A7%E6%8F%8F%E6%9B%8A%B9%8F%E8%E4%99%86%8F%E5%E6%E5%E9%AC%BA%E6%E8%E8%E5%89%88%E3%B5%E5%E5%97%B8%BF%E8%AF%E5%BA%E4%B7%91%BB%AB%B4%A2%E5%E7%A8%8A%90%82%90%E4%AF%A4%A5%97%95%E9%BE%94%8B%BC%E9%E8%E6%8F%A3%81%B7%8C%BE%8D%B3%B6%96%A7%80%B0%9D%9B%E5%E6%E8%8D%B7%8D%94%8E%9A%E8%B1%E6%B9%E6%AD%E6%8C%9F%9C%86%E5%90%E6%E5%84%9F%87%A8%E5%B6%8D%E6%91%8B%E8%E5%91%B8%BD%91%E7%B0%8B%92%8D%89%8F%8F%E6%E7%E7%B3%8E%E5%B1%A6%8E%E8%97%95%84%80%E5%AB%94%E4%E4%E5%E5%91%E5%A6%E4%8A%E5%9A%BB%E5%8B%8C%98%E6%E6%98%E7%8F%91%E5%80%B1%BF%90%8C%85%E9%E7%E9%AE%97%E5%E5%E4%9B%E7%B5%E7%9A%E5%E9%E2%E5%E6%8D%E4%E5%E4%BB%80%B5%90%9A%8E%E7%B4%9B%A4%E8%8D%B2%8E%E5%E6%80%83%E6%A5%A4%9C%E9%A4%B3%BA%E9%E8%BA%AA%AE%81%E5%E4%E5%8B%A6%90%B4%E5%B3%87%A9%B8%A4%E5%A6%B5%81%AA%AA%90%B8%A9%B8%8D%B9%AC%E6%E5%E5%E8%A9%E4%AD%9C%99%E8%E5%88%BF%97%B2%E4%80%A9%E5%E7%E5%88%9B%E4%BD%E5%E6%81%9E%9B%9C%82%BF%BC%86%9F%E3%E6%B6%89%E5%BF%BB%BD%AA%BF%88%E7%E3%E4%A7%84%8B%94%E6%AF%E5%BD%86%E5%E5%E5%A3%E4%90%8C%8B%E5%97%B0%90%9F%E3%E5%E9%88%A5%E5%AE%81%E5%8C%E5%9B%E6%B0%E5%97%E7%8A%A2%80%A5%B0%92%80%E8%B4%A5%93%9F%E8%E8%B3%E7%E4%BC%E4%E7%83%E8%E6%B4%E7%E6%E5%88%8C%AB%A4%E5%B9%B1%80%E7%BF%E7%A8%BB%E8%94%BF%BE%E5%E2%9D%9B%86%A1%E5%E8%A0%E5%E8%90%E5%E6%AF%9A%E5%B6%84%B2%8C%AB%B0%B7%BB%E7%E5%8A%E6%BA%99%E5%97%E6%E6%8F%9F%E6%AB%BE%E6%AF%87%BA%84%A7%E9%E5%E5%98%A6%B9%E7%9E%8C%AF%BA%93%9E%AF%E6%E5%AE%E5%A3%E6%B6%9D%85%8B%9D%A3%89%E4%B3%B0%E6%9F%C2%8E%E9%E8%BC%9C%80%9F%AF%AC%A9%9C%BB%83%B2%99%86%E4%81%85%E6%8C%BC%A7%E9%87%A2%E5%BE%E5%BF%8F%B8%8E%B9%E4%86%82%98%E5%AB%E4%E6%E4%A7%E5%8C%A9%8C%BB%8B%BC%E6%9B%E7%AA%BE%E4%8E%E6%90%E5%E8%E5%B8%9F%8A%8C%AB%B8%9D%B0%AE%E8%BB%E7%E4%E4%E9%A8%90%BB%A4%A7%88%BB%AD%89%90%E4%81%81%94%B9%B0%E9%8A%9A%A5%91%E5%8B%B9%E3%85%AF%9F%A5%AF%86%9B%A8%E4%B4%E6%E8%A4%A4%E7%BA%BE%8C%BF%BE%85%B1%A5%E6%B9%BB%B9%E5%A9%BA%A1%E9%96%E6%8D%E5%E7%B2%E5%A4%BF%E8%BF%81%E9%E6%B0%E7%E6%AC%E6%B8%88%B7%E4%E5%E8%99%AE%E5%B7%E5%AE%E5%9D%A2%91%97%B9%87%98%A5%E5%E4%B3%E5%97%9C%8B%E4%E7%91%E5%A6%B5%E5%82%E4%8F%8F%E5%E5%8F%8C%BB%94%E8%8F%B9%E5%8C%89%95%AF%87%80%B3%AF%E9%E5%E4%E4%BE%90%E8%BC%BB%B2%B9%89%BF%A0%96%E7%E3%AF%E3%B9%B1%E6%AF%E4%81%81%9B%99%E9%E6%88%E8%B7%E4%B9%81%E6%87%82%81%9E%E8%A2%B1%AD%9D%86%89%E9%A7%B3%E5%82%82%E7%AC%BF%8F%BD%85%E7%9B%E4%9B%9A%E4%E5%E4%E5%E7%A5%B7%E5%A7%89%93%A7%BD%AB%B9%E5%AD%B6%E7%E5%90%AF%E8%A1%A6%AF%95%E7%E8%B9%8F%80%E5%E8%9F%E5%E5%AD%9B%BC%E6%83%E6%E6%A8%A7%E6%E8%AB%E5%8D%9D%93%BC%8B%8D%81%E6%B8%8C%E4%BA%E5%A6%B3%9B%A1%A2%BB%E6%A0%98%A2%E5%9B%A3%A5%E5%E8%E5%E9%82%90%E5%B9%BE%E5%E5%AB%A1%98%E6%E7%AA%A4%E3%98%AF%9C%E5%E9%A2%E5%E9%85%E6%83%E6%E3%80%95%8C%E9%BE%9B%A0%A9%A3%AE%97%BD%AA%AD%89%81%8F%BF%B8%BF%E7%E8%94%E6%E3%80%8D%99%8C%A5%E5%8A%E5%94%8F%9D%E5%E6%9C%84%8D%E4%E5%E5%9F%9F%97%85%E8%A5%B1%B8%A0%82%B8%E9%E7%8F%AE%90%9F%A3%E7%9B%B8%80%E5%AF%E4%E6%E9%E7%AF%E5%A7%93%96%83%AE%8B%E5%BE%A7%B8%E5%83%E5%BE%BC%E8%BD%E4%89%80%A2%B8%E4%BC%E6%B8%E7%E6%83%8F%8D%E4%E6%A5%8F%A1%E7%E5%9F%BE%E5%E5%80%B1%9C%BE%AA%89%B6%E4%BA%84%8E%BB%E9%99%BE%8F%E5%E6%8A%9F%B0%89%E5%B8%90%BB%E8%BE%BB%E5%83%B3%B8%82%BA%8F%81%8A%BB%BC%94%E8%E6%E7%80%94%B8%88%E5%E6%E7%A6%8A%97%B4%94%88%8B%84%E6%90%95%83%A0%E5%8E%87%99%B1%E8%93%B7%B2%8D%A6%94%85%A7%A4%A7%80%B7%B4%E6%E9%BA%80%B6%A1%83%93%91%E4%AC%B0%E8%85%BD%87%E6%A6%8A%A7%E5%BE%8C%E5%A1%E8%B9%AB%A8%A7%E5%87%A8%E5%93%91%E6%AF%B0%A5%E6%B8%90%E6%94%9A%9E%AF%E6%E5%9E%90%83%AD%E9%83%A5%82%A9%E4%85%A1%E5%E7%98%E5%E5%E4%95%87%E5%A5%AE%9F%BB%E7%E5%8F%B3%E5%8C%93%8D%97%E6%AB%E5%A9%E7%AD%E4%A3%AE%E7%E9%81%E5%8D%A7%99%81%B2%97%E4%A7%9C%A5%E5%89%8D%85%AF%B9%E4%E5%A1%AF%83%B8%E5%88%E5%BE%88%BD%AC%A5%8E%BD%E7%E5%89%A5%B4%E6%E5%9B%8C%E6%85%BB%A8%E5%B7%E8%E8%E7%B8%BA%E7%8C%96%E5%E5%AE%E9%B6%E5%95%E6%E5%E5%A6%E7%E8%B1%E8%BC%9C%97%BB%E5%E7%80%E5%9E%AD%E9%E5%B7%E5%B1%E5%E5%E5%85%91%BE%85%A3%E5%E9%BB%B6%8F%E5%E7%B8%AD%9A%8A%E9%8C%9D%A6%AF%B3%AF%B1%B9%9F%97%9D%E5%BB%A6%B1%E5%80%BA%BC%83%88%E4%E5%81%8A%A4%E4%E9%E4%E4%B8%B8%AC%A3%B1%BA%E5%9B%9C%E5%A7%BD%B0%B9%E4%BD%8F%9A%BD%AC%B7%E6%BE%90%E7%9C%85%94%E5%A9%E6%B8%80%8D%85%B8%E6%A0%E6%9F%85%E5%96%80%9F%BF%E8%E4%88%A1%E5%E5%B7%9D%BD%E8%E6%E4%93%E5%E5%B0%AD%9C%E5%8C%B3%E6%A5%94%87%E5%B1%B9%AC%E5%E9%E4%BA%BF%A7%8E%A1%E4%E4%84%81%E5%E8%92%A1%8F%85%A0%B7%E8%E8%89%E5%8F%A1%81%A5%E9%A7%8A%E6%AF%BF%E8%87%A5%E5%85%99%A0%E4%B7%E5%AB%85%AB%E7%E8%9D%AF%9C%BF%B3%88%E9%E5%E7%8E%BA%91%BB%A4%9F%E5%B2%9F%E8%AF%80%E8%BB%8D%A5%91%E5%B3%E6%90%B9%98%9F%9F%8B%88%A5%A0%BF%B1%A5%9B%B8%E5%9D%B4%8C%8E%E5%96%81%E7%E5%8C%85%B1%89%98%AD%E4%8E%E5%E6%BC%E6%E5%AF%AD%8F%E4%E5%81%85%9C%89%E9%A0%A7%88%A7%E5%9C%85%E8%E6%80%E9%E5%BF%E5%9C%E9%AF%B2%E4%A3%9E%A2%E5%AD%9D%B9%B4%E4%E5%E5%BF%A1%80%E5%AD%80%AD%A6%E7%E7%82%BF%E8%E8%80%E5%E6%E8%E8%9D%B2%E7%85%8E%E5%BF%B4%AC%9B%E4%E4%E5%87%A8%88%BD%BB%81%8D%B9%AA%E6%8E%94%87%80%B9%B0%BC%E9%8D%9D%A7%9F%E7%BA%E9%E9%BA%A7%84%BE%E9%A6%E5%E6%E7%9F%BC%AF%94%B7%85%B4%BB%B8%B0%86%85%E5%87%95%B4%9B%83%AB%B9%A2%E5%BD%94%E4%E4%BB%80%E6%8C%AB%E4%86%BF%87%E5%B2%E5%80%E9%B8%A9%E5%BB%E6%A0%E9%E8%AB%E9%E5%9F%B0%E9%AF%89%E9%B4%9C%E5%85%E5%8F%BB%8D%AD%AB%A6%81%E9%E5%E5%E5%E4%B7%82%A9%B5%E6%E5%BC%B7%E6%E6%AB%9C%AF%E5%9D%AF%9F%E8%E4%E5%E5%A8%E8%B7%B7%B9%AE%E7%94%80%85%86%E9%E5%E8%A9%8A%A2%E7%89%B2%E8%80%E5%E5%E5%E9%B8%9C%E4%E7%8A%E5%E5%9D%A4%8F%E5%E5%BA%E6%E5%AF%9B%B1%B9%A6%E5%A3%BB%8C%80%AB%A3%BF%AF%BD%A1%E6%A1%E8%BF%E5%A5%8A%A7%81%E5%88%98%B9%AB%A6%E5%E4%9E%B9%E6%97%E5%E6%E8%E7%8A%8E%9A%A0%81%A6%A1%AE%A6%E5%A7%B8%8A%E5%82%E4%A7%B9%BB%B4%A0%AD%A4%A3%A2%91%B9%99%96%A1%E8%E4%8F%8E%BA%E6%A7%9A%BD%BA%AF%E6%E7%E8%A3%E6%E5%A2%BA%E5%E9%E6%90%AF%9B%E8%B9%E5%E5%A7%BB%8C%E5%9D%E5%E6%BC%80%8A%91%E5%8B%87%85%AA%A7%BA%E7%AB%9D%E5%BA%BC%B7%94%8B%94%86%AB%9F%AB%E9%A0%97%AE%E5%AA%A7%E5%BA%E6%E5%E9%8F%E4%9D%99%83%AC%E8%9E%85%A6%83%99%B8%92%A1%B9%B3%8E%E9%9A%A9%E6%E6%90%E5%AA%81%BD%E6%98%B9%B9%E8%83%96%E5%E8%E6%8D%8D%85%A7%BB%98%BC%BC%B9%E6%A4%8B%80%9C%E8%E8%BD%8E%97%8F%E7%E8%E7%E5%97%E6%97%B8%BA%95%AB%91%B2%E9%E6%B1%88%AB%A4%A5%BB%E5%BD%99%92%E4%BC%E4%E5%E5%E9%9D%E5%E8%BF%9E%AE%E5%E4%E5%E6%A8%8F%A6%A5%E5%A7%97%A5%AA%BD%E5%A9%E5%88%BE%97%92%E8%A1%88%E8%E5%E4%E6%89%E5%93%E6%E5%E7%8E%99%BF%BF%B9%9A%A3%BC%E4%B8%E5%E3%A7%92%E4%E5%E8%AD%BC%8F%8C%95%88%E8%E8%E5%83%8D%E9%97%82%9F%B3%E7%9F%B0%A0%E6%80%A1%E6%99%E5%9D%A3%E9%E5%E6%BE%B8%A3%BA%E5%AF%BA%8C%B1%97%AD%92%88%9F%E5%97%95%BE%B5%82%E8%8F%E4%B3%E8%A8%E4%E6%81%E6%E4%84%86%93%E7%87%B8%A6%8D%82%E4%8F%E6%B9%E7%E8%BE%E5%E9%B9%85%83%E4%E5%E4%B7%9B%A7%8D%A5%A7%E6%B3%9C%E6%8F%E7%9C%BF%E4%E5%AF%81%BF%E6%E8%B7%83%E4%86%81%E8%BF%BB%AF%B8%A1%E4%E9%AB%9F%8F%E5%B8%E8%E5%E5%8C%E5%8A%B2%E4%84%E8%90%8E%88%B8%E9%87%E8%E8%A7%B5%BB%83%88%8C%8F%B3%9B%BB%E3%B9%E5%9D%97%E9%B3%82%8D%9C%A4%E4%A3%88%B6%B1%BB%B9%BC%E7%9D%E5%99%E4%82%E5%E6%A8%99%97%88%87%E6%8D%91%80%A1%E9%A6%E9%BA%E3%E6%81%8C%8D%E4%E9%E6%80%B1%94%88%E5%E5%90%E8%E5%E8%E5%8D%E4%93%E6%E3%8D%E4%AF%E6%BA%88%E6%BF%85%BF%B9%E6%A5%A9%88%B9%81%96%A1%E9%97%83%A4%E5%80%91%8B%99%8A%A9%A6%90%E5%A5%85%98%E6%A7%83%BB%A9%A1%85%E5%A0%9D%8E%AE%8A%BE%98%B3%E8%8A%B0%B5%B4%B7%E9%8D%88%AE%B9%AE%E5%E6%E4%85%E7%B0%B3%B6%E5%E6%E7%99%82%A1%BF%E5%B8%A8%AB%E4%E5%B9%E5%E4%E6%BB%E9%94%AF%96%A3%82%E9%E6%B1%87%81%98%E5%E5%A9%AF%8D%94%E5%E8%E7%E5%E6%E8%A4%AE%E7%98%82%8F%B7%8C%99%91%A8%BB%E4%85%9D%80%BA%90%B7%E8%BF%8E%B2%B8%AE%9D%B0%BA%98%83%97%8B%E7%A8%AB%8A%E5%E5%8E%E8%BB%E9%A5%8F%E8%E6%9B%B0%8F%E4%E6%E5%E6%BB%AE%80%88%A0%AF%E5%AF%8C%80%B4%BE%E6%B9%87%8A%94%9C%88%E5%AC%B9%BF%A1%E5%A4%8E%9B%E7%E4%A8%83%81%9A%88%88%E4%93%BE%E5%88%A5%91%B9%E5%E4%A7%9A%91%83%A6%AC%E8%AF%E9%95%E8%E6%E5%B0%E5%E5%93%94%AF%B6%84%95%E7%BD%AF%B1%83%A3%A3%BA%AB%E4%A1%85%E4%E3%98%B3%AE%A7%8C%E6%B4%80%BF%E6%A8%BE%8E%97%E8%8D%E5%BD%85%89%BA%E9%BB%BB%A8%90%8C%A5%E7%E5%87%E7%A5%B9%85%9E%B9%BD%93%BF%AB%E4%B6%B8%B5%83%98%8A%AE%8F%9B%91%E4%8F%E6%BC%80%B8%B0%81%E7%88%92%8F%E5%E5%B8%AB%B8%B8%9F%B8%89%AC%E6%8F%8D%E8%E4%8C%9C%E5%B0%B0%BB%88%BA%E7%E6%B0%B4%E7%E8%B5%BB%E6%E7%BD%B9%87%E5%AB%E7%A2%E7%89%E5%A4%83%E9%8F%AB%E4%A7%89%8D%E7%E5%92%94%91%87%99%E7%94%E8%E6%E6%A0%E5%88%83%92%8C%AA%80%E6%A2%E6%9A%BB%9F%93%A0%97%BA%90%89%98%8F%AF%81%E7%8A%E9%BD%B8%E5%88%E4%E5%E5%BC%E7%E4%88%AE%A6%E8%9B%97%8D%B8%E7%AE%E4%9D%E6%B2%89%AB%BE%94%9B%E5%B7%E5%BB%E7%82%8F%BB%81%84%AB%9C%A6%A2%A7%B1%A4%8C%9F%B7%82%E6%E5%E7%E4%B1%E6%E5%A2%85%E3%AB%E5%8C%E5%E7%E5%E6%AF%E9%E6%A5%98%A2%E8%A2%BB%E7%E5%AB%E6%E5%E6%E7%E4%E5%B7%E6%E7%99%E9%B3%AC%E5%E5%92%E6%85%AF%99%E8%8C%B8%B3%82%A2%AF%B3%AF%9F%B4%A4%BB%BA%B7%85%B9%94%E9%E5%A7%E4%9F%B7%8F%B9%9E%94%91%85%E6%E8%9A%9B%8A%8C%9A%E5%E5%E5%E5%8F%9A%E5%E7%85%E4%A6%A9%82%9C%91%89%89%A3%80%AF%AF%8A%E9%E4%8C%8D%E4%E9%B0%95%E7%81%B6%85%91%BA%AE%91%BD%E4%93%B0%8C%BC%89%BF%A2%8E%E5%B1%85%94%85%99%B3%E5%99%87%B9%A3%E8%93%A2%B9%E8%8C%B3%9E%E4%B3%A4%8E%E4%97%9B%E8%E6%E5%E6%87%E6%B0%E5%B1%B1%83%E8%AE%E9%E6%B8%92%88%82%9D%B2%BA%A2%E6%97%97%84%AF%97%AB%81%E5%87%E5%E8%E8%97%83%AD%94%BD%BA%AA%E5%94%90%BD%E8%E7%AD%86%E5%87%9D%8D%B9%E9%E6%90%9F%95%E5%E6%A3%B4%87%E6%8C%E8%A4%B7%82%E4%B8%86%E8%A4%BF%A1%E6%9B%9B%B2%8B%E8%B4%E8%E5%E3%E5%E6%8D%E5%E9%9A%B3%E5%9C%AA%E9%BA%8F%A5%8A%BE%B7%E6%A1%87%AF%E6%E5%E8%E9%E6%E3%91%E5%E5%80%83%B3%97%81%B9%B0%AA%91%AF%E6%A9%E5%95%8B%E4%E4%E7%E8%BE%E9%81%A0%AD%AB%B8%87%E6%B8%B8%E8%99%91%8F%E6%A1%E5%BB%B8%85%8B%99%80%E5%8B%A8%87%BE%E7%E8%80%BA%E9%E5%97%9D%9B%E5%B1%E6%9A%E6%E5%9F%AF%A4%8B%E4%88%A9%80%E5%A0%E6%BA%AF%81%83%E4%E5%E5%AB%B0%A0%B7%E8%8A%8C%9C%B8%94%E4%8D%AA%E5%E8%E3%BB%E8%E5%96%E4%B4%E7%9C%AF%8C%B8%80%89%E5%8F%E4%E8%E5%B9%8F%E8%9F%E7%8C%93%E7%A5%94%E5%B2%8A%B8%88%A9%E5%8F%BF%E7%94%E4%8F%90%E8%E2%BF%81%E5%A5%E5%E5%E9%E8%BB%8D%89%8F%E3%A6%B8%8C%BB%AB%AF%8E%8B%E9%A6%9E%E7%E5%AE%8A%A1%9F%98%8A%A1%E5%E6%A6%E9%95%9C%E5%A7%E5%99%8C%B9%E8%E5%85%80%88%85%B8%E6%A6%9F%E6%8D%E6%87%E7%96%88%81%82%9F%9F%E7%E5%9C%8C%E6%E4%87%E6%E5%E5%E7%E8%E5%BE%BB%B8%80%83%A9%AE%82%B9%8D%8F%8E%A1%A7%A7%E6%E5%E7%BE%E4%8D%E9%E9%9D%AE%80%B1%E9%A6%AE%8F%E6%94%A3%E8%80%A4%E5%A6%E3%96%89%B9%E8%E5%BF%BA%BE%E5%8F%B7%9A%E5%E5%94%E4%BA%9D%E7%8C%8F%8A%9F%E4%B7%8F%E5%E8%B9%9C%E5%92%E4%E5%E8%96%86%92%98%E5%94%AA%88%E3%A6%8F%9E%B9%E9%88%E7%8C%93%AD%8C%E5%9F%E8%E6%A0%84%87%A1%8F%A8%E5%98%81%E8%E6%AC%A6%BE%88%E9%BB%B0%E8%E5%E4%85%B2%E6%A9%85%E6%E5%87%9D%9F%BA%AC%B8%8D%85%A0%E8%B9%BF%BE%94%81%9F%88%97%AA%E5%95%A5%E7%B4%E5%E8%94%E5%E5%B5%A9%A5%86%9F%B3%B3%85%83%E5%BA%8F%9A%84%E5%9A%B0%BF%9C%9C%E6%BD%8D%E7%86%85%BD%E7%9C%E5%BA%88%E5%AB%88%E8%BA%A4%8C%E6%B9%BC%E4%A8%8E%A1%8F%B6%AF%E5%AD%8E%AF%86%E5%E5%B0%E6%99%E6%BA%B1%BE%E6%E8%AC%AE%A6%BD%E5%E5%BE%E9%99%9E%85%E5%89%87%AE%A5%9C%88%A5%E7%9C%E4%8D%E5%89%94%E8%E6%8D%8B%E6%E5%90%E4%B7%BF%E5%94%8C%E8%8F%B3%9B%A8%BC%A5%97%A7%89%E5%E4%B2%BD%E5%E4%AE%E5%B3%E5%B8%E7%83%E9%E8%83%92%E6%AB%87%92%AC%E8%AB%9D%93%E6%E5%E7%E5%E4%8B%B0%97%E5%E4%E5%99%E6%BB%BA%E7%A1%E7%84%85%95%8A%9B%E5%B4%89%E6%E8%A8%80%96%A9%A0%E5%B1%83%B3%9A%E9%E6%E3%E6%81%E6%BF%8E%A8%89%A5%B5%8F%E6%B8%E5%A4%E3%8B%9B%E8%E5%80%94%E8%9F%E7%B5%8F%B8%AE%9B%94%90%AA%AC%B9%82%B8%A2%85%BF%E6%B1%E8%83%E5%B2%A8%E5%A7%B7%A2%87%E5%80%B2%E4%B0%E5%8A%8C%8B%BA%E9%BA%B4%A4%E6%8E%B7%85%82%93%B6%8F%A0%8D%E6%B6%84%BB%93%BA%95%88%8A%96%9D%E5%E6%E5%8E%BC%A4%85%E5%88%98%B9%9B%E4%9F%E6%9C%E9%83%E6%86%93%9F%A5%A5%9A%88%A0%85%94%E6%E9%8B%E5%86%9D%B3%87%9F%87%E8%92%94%B9%E5%E5%B3%E5%E6%B8%E5%E8%E8%85%90%90%E7%E7%E8%A1%97%E5%AF%86%BC%E5%E6%B9%8F%85%E5%84%8B%E5%88%96%E5%E7%8E%B8%E5%E5%AB%85%E6%83%A7%AF%9C%88%A6%E5%B7%81%A1%8B%9E%88%8C%9D%96%E6%E8%8A%92%E8%8C%E6%E5%9F%8B%83%85%AC%B8%97%E5%E9%AA%90%E6%AE%A7%84%E5%E5%BF%E8%BA%E6%A6%90%E9%BF%E8%A7%E8%E5%E6%A2%E6%80%E6%B0%B8%B7%E9%8B%E6%B6%95%9F%BE%93%E5%E7%82%9C%E7%BF%82%B1%AB%E8%B3%A9%8F%8B%BA%AF%81%A3%BD%A5%97%82%89%E6%94%81%E5%86%E5%83%E5%E6%E8%8A%94%E5%9F%9F%E6%BF%E7%A5%E4%BE%B3%95%E4%E5%E7%E7%90%A3%B4%AD%BD%E9%E8%81%87%8A%96%83%B5%87%AD%BE%E4%BD%E5%9C%A1%B7%E5%92%E6%8D%8C%B6%84%8F%80%A6%96%E7%E5%E8%B9%AA%AF%8C%E5%85%85%E7%AF%E7%85%E6%81%C2%80%86%A2%B0%97%E5%A0%B9%81%E8%E8%85%A5%9A%B2%84%9C%9A%E9%B4%E5%9F%E7%B0%96%99%E9%E7%A0%88%E5%BA%BE%B9%A6%A1%AB%E7%95%E4%BB%91%BE%BE%B8%92%AB%A9%E4%83%E7%97%E4%E5%E5%E8%E7%9D%A3%E6%89%E5%BD%9D%B4%AE%E5%E4%E9%AE%B4%E8%92%AD%83%E8%98%E5%81%8F%BD%E5%BE%E4%A0%E5%BD%B4%82%97%E6%E3%92%BD%BF%BE%A4%A8%8D%83%9A%BF%90%82%E7%AA%84%B8%E5%95%9F%9B%E5%E7%82%8D%8F%E6%BB%E4%B2%BC%8C%8A%E6%AF%E5%9A%E7%98%8B%9D%E5%9D%E5%E7%BA%E9%E4%9F%E6%E6%E8%84%E5%80%B8%E6%8A%E8%90%E8%BF%8D%8F%9F%83%A5%AF%E5%A1%94%E5%E7%8F%BD%91%9D%87%E6%E7%A2%E5%8F%89%E5%E6%A6%B8%85%E5%BD%AE%E6%80%E6%99%A8%9F%AC%86%87%BB%B1%BC%81%B3%A8%E7%96%E6%E4%E5%B9%85%8C%8B%E7%E5%85%8E%97%BE%E6%BF%E5%E7%81%90%BD%BE%9C%B3%B9%9D%E6%B3%BB%BF%91%9D%E7%E8%93%8E%E5%E5%86%E4%E9%98%A8%86%9B%E4%E4%9F%89%99%9A%B9%B0%81%80%B8%E4%94%8B%E5%92%E5%9D%E7%E5%E4%85%E5%BD%E2%86%E5%E5%BB%E5%BC%BF%8A%A9%A5%9B%E4%9D%9B%A3%BF%94%E5%94%A4%93%A5%BC%E5%87%8F%E5%84%E5%E6%AF%B0%8E%A0%BC%BC%E5%E7%B8%82%A7%E5%97%E6%84%A8%B2%B7%BB%E5%A4%BB%99%BC%AE%A5%E5%BB%AD%B4%8A%AC%E6%85%E4%99%BD%B9%88%B8%E4%E5%B0%E5%AE%E6%E5%85%E9%B6%E6%E7%E4%90%89%98%BB%E8%99%E7%87%E5%E5%AB%85%E5%E8%BE%8B%A9%E9%E8%B7%85%84%E6%AD%E8%A1%BF%91%9E%AF%88%BD%E6%E9%A6%E5%B3%A9%BB%8B%E5%B5%BA%E5%85%AA%A7%E5%BC%BD%E5%E6%BD%81%E8%8E%E5%B9%B6%90%E5%E6%8B%E5%E4%A7%E8%82%AE%E5%E8%B4%E6%95%95%8F%85%8C%86%A4%97%E6%BE%E8%BB%9B%AC%85%E5%E8%9B%E5%89%A7%BB%B7%E4%8B%BA%B1%8C%BC%AB%BC%8A%87%A3%E5%AD%A6%E7%BF%AF%97%AE%E7%8E%E6%B3%B5%B9%9A%8B%94%80%E6%99%E6%BA%95%9B%E5%E6%90%9D%AB%90%86%A8%E5%B9%9F%99%E4%AC%E6%8A%E5%83%A8%B9%AE%85%BB%81%BD%81%A4%81%E4%8D%AB%AF%E5%E5%B3%8C%93%91%E5%9E%E8%91%80%E8%8B%E7%95%8F%E5%9F%E6%E5%9F%E5%E5%E7%94%A9%81%BA%80%E7%E7%E9%E8%83%8C%B9%85%E6%E5%8E%E8%A5%E6%BD%A0%8F%AD%E5%A1%E6%A9%E5%E5%A4%E5%AB%B3%E5%83%9C%E4%86%AD%E5%E5%C2%E5%E5%80%A3%E5%85%E8%A3%E8%86%E4%AC%E5%A5%98%88%AE%E5%8E%E5%E9%E6%E7%E4%87%E5%E8%A3%A2%E4%B7%AC%B2%E5%85%E8%AD%B6%E5%E6%A0%B9%8B%E9%90%BD%E5%80%E4%E5%E5%8F%BA%E6%E6%8E%E6%97%E5%93%97%E4%E5%8C%BF%E4%93%87%80%E6%E8%E5%B7%E5%97%E5%E7%B7%E5%88%B4%B3%E6%E5%8C%BD%A7%E8%94%A0%E6%E5%85%94%8F%A5%E6%9A%8C%E4%AF%AA%E6%8E%E7%B3%E5%E5%94%85%E5%E4%E7%E8%A7%83%BE%B2%E6%8A%A6%E4%AF%94%AF%8C%E4%E5%92%E6%AB%E6%BD%E5%86%E9%BA%A3%E5%BF%A1%8F%E8%E5%E5%E5%BC%A0%98%80%E6%9B%90%E4%BA%88%8A%BF%E7%E5%BB%9F%86%BA%E8%E8%BD%80%89%95%B3%E5%AB%BA%E4%E6%9C%B4%9D%B0%E5%E5%B7%8F%E6%8C%B3%96%AD%B2%81%A6%A5%A2%E8%92%BF%80%86%9F%9F%E9%BE%9D%97%E8%E4%E7%B2%80%E7%E8%E4%80%A9%A6%E7%A9%A5%E5%E7%9C%E8%A1%A8%BF%AE%E5%8E%A8%E8%AF%B8%E8%85%E5%BF%AF%E6%B0%B8%E5%E5%BA%E5%8D%E7%AF%86%E5%8D%A7%A6%93%9A%85%AF%E9%E5%8F%BE%E5%B7%E7%A1%8B%E6%90%8F%AE%E5%A8%8C%89%94%A6%A7%A2%A1%E4%E5%A4%E5%A6%B8%90%A2%E5%98%97%E6%B3%94%BB%E9%97%8D%E8%E6%B8%BC%A7%E7%E5%88%E5%89%AF%BA%A2%90%AF%E7%E8%A5%AC%B9%91%89%E6%E5%E6%89%BC%85%E8%8F%94%B9%8D%E4%E6%A3%85%E5%AA%BA%82%BB%E9%85%B3%8C%A5%E8%E7%E7%AC%A8%B0%A8%94%90%B9%99%8F%8A%B2%E5%BE%E7%9A%BE%E6%99%93%9F%90%83%E5%E7%B0%99%B9%A8%E5%E6%B7%9F%83%AF%E5%A7%E4%B7%E5%E5%A1%E7%E5%E7%B9%A6%BB%E7%E5%85%B4%E5%97%BD%AF%B6%8E%85%9F%E6%E5%83%BA%88%E6%A4%E8%A3%86%E5%A7%B8%85%E9%87%BA%A6%AD%E7%81%E6%E5%B0%E4%E4%E9%AB%E7%B4%BF%86%B9%90%88%9C%E5%E7%BD%97%A2%BA%8A%BB%9D%90%E5%B2%E7%98%E7%E5%91%8C%E5%B3%8D%B5%9C%81%E4%A1%8A%A0%E5%E4%97%A2%E6%E5%B9%AF%95%E9%E5%A1%E5%E9%A2%92%E7%B9%E8%9A%E8%99%A5%98%E4%B1%85%B8%97%E7%A8%8C%94%E5%9F%E7%B7%99%8C%A7%9F%98%E7%A5%E5%E7%9B%B9%E5%E5%8C%E6%E5%82%8C%A6%8A%A5%E7%8C%8D%9B%9C%E7%E5%E8%E5%88%AF%E9%99%E5%84%B0%E5%E5%B8%E4%98%B0%99%E6%97%A1%9B%90%8B%B8%8B%B6%8E%BF%B4%9C%A5%E5%E5%8B%96%9F%E5%8C%BC%99%90%E5%A5%E4%E8%93%91%9A%9E%8F%89%9A%8A%E6%B9%AB%E6%BA%E5%B1%8A%91%E4%95%E9%E5%BE%E5%E6%94%BA%A3%A0%A0%86%E6%B3%8D%E7%E9%E5%8C%A6%E5%B4%A8%A4%E5%A7%E4%86%A1%E9%83%E5%E6%8E%E6%80%82%99%9A%89%9F%E4%BA%E3%87%9F%85%BC%E5%E8%AB%BA%E5%B3%AF%B8%E5%BC%AB%8D%9E%E8%E8%A8%AB%85%E5%BF%E8%AD%97%AD%E5%E5%E5%B1%9F%B3%E8%BB%A9%8B%E5%E6%E4%B9%B6%8E%E6%B0%E4%E6%A6%8E%83%E8%BF%B2%A8%94%8E%E5%9F%B8%80%8A%E7%A5%E4%E7%E5%E4%B3%E8%E5%91%AF%B1%8F%E6%8A%8C%B8%A3%89%E5%E8%98%A8%E8%E4%A4%E5%A6%BF%88%E8%E9%98%E7%E8%AF%E5%E5%E5%E5%E4%84%A2%E5%E7%A1%85%8D%E7%E9%8D%E6%A7%95%E4%E5%8B%B3%AD%E4%E5%B9%E9%BA%B1%89%BB%E8%E8%B4%E7%8A%8B%E6%9D%BE%E5%9D%E7%E8%BC%E5%BF%8E%9C%E5%80%BA%90%94%E5%BC%AF%9B%A5%8D%AA%BE%AE%B4%9C%BA%BE%E9%BD%BA%E5%81%BB%8F%E5%BD%E5%AB%A6%B9%AF%A1%92%8A%BD%E8%99%B0%A9%86%95%E7%B9%E4%B0%8F%8B%E4%BE%BA%AB%E8%8D%E8%E7%B1%AB%E5%E5%E6%E8%BB%E6%9A%E5%E9%E9%94%92%B1%85%82%BB%E5%E5%B3%A1%E7%E7%E7%88%E5%E4%E5%89%E5%E5%94%E5%B8%B8%8C%BF%A6%A8%94%9C%E6%B8%BB%9D%82%9F%8C%A6%B6%E6%E8%E9%AB%E8%B3%AB%BA%E5%A8%E5%BC%94%88%8A%BD%E5%E8%E6%E5%B9%AA%E8%BA%8D%B0%8A%E5%E7%AA%B8%94%9A%A2%BE%89%96%BF%E5%85%AD%E7%E8%B7%E5%E5%E5%88%AE%B5%9C%E9%AE%99%E5%98%B2%8D%A4%E7%89%9B%E5%E9%87%80%E5%A6%E4%82%E8%E8%E8%B0%B0%A6%9D%E6%AE%81%90%E5%A7%B6%A7%98%92%AE%A4%8D%97%99%E5%9C%A9%E5%A7%E5%E6%B2%B8%8A%BF%E5%E4%B0%85%BB%87%E7%E7%E6%8D%84%9F%E7%AD%E6%A6%8F%8C%96%9B%8A%A1%90%A5%8B%B7%E6%E5%A5%B5%8A%A3%97%80%86%A6%BF%86%98%8D%E5%88%89%AD%E6%E5%A7%B9%A8%E4%E9%B3%E5%98%BB%E4%E4%E6%E6%89%B2%8C%E7%94%99%AE%AF%E9%8C%E6%8B%E6%82%E5%AA%9C%88%B0%BA%B8%BF%80%8B%94%91%BE%E8%E7%AA%B8%E5%B4%E5%BC%BF%BD%82%80%A0%E4%E7%E6%E5%91%BF%98%E7%8D%E7%AE%E5%B4%E6%E8%E5%8E%85%81%9F%E5%AD%B9%A8%A9%E9%BB%E8%93%E5%E8%81%87%89%E5%E5%8E%A8%E7%E6%E6%81%93%B3%89%9D%89%88%BF%E8%E5%E7%BF%E7%B9%9B%E6%BE%E4%E6%8B%E3%B0%E8%AF%E6%A7%8F%85%BE%A1%A5%E6%E6%90%E5%84%E5%E6%B2%B3%83%AD%E7%E7%91%E6%A3%8F%E4%E5%AF%A5%E5%E8%E7%E6%B1%E8%8D%85%E5%B9%B7%90%AF%E4%8C%88%E7%E5%84%B9%E4%A7%94%A6%87%E6%E9%AD%E4%E6%95%E8%E6%86%A1%E8%E5%BA%85%E5%AE%AF%86%BB%B4%97%81%B3%B1%82%A9%90%BE%85%85%86%8D%95%90%A7%85%E6%AE%BB%A8%8D%E4%9A%B7%AB%A3%A8%8A%E5%83%8C%88%8E%80%81%9F%A4%B8%B9%80%87%AF%B4%BE%E5%B3%B8%81%8B%E8%88%E5%E4%8B%8A%95%8D%E8%9B%9E%AD%89%AB%E6%85%BF%B0%E4%90%8E%9E%BE%B2%E7%E8%B1%BA%89%E7%E9%9F%A7%8A%91%99%A8%98%E6%9D%E4%BE%9D%E3%82%E7%E5%8B%E6%E6%86%8E%E4%9E%8B%AD%A9%E4%E9%9F%E8%E7%A8%BB%B3%A8%B8%8F%86%A0%E6%E5%E5%E7%9F%E5%E4%BC%9B%E5%BA%E8%E8%8F%A3%83%E5%E5%BA%E6%B7%E5%A2%89%B9%E6%E7%A5%E5%AE%E9%E7%E6%A0%B8%E5%B6%88%90%B7%E8%E4%BA%E9%AB%AA%A4%E6%B6%86%E5%B4%E6%8E%E5%80%B0%E7%E7%AF%E8%B3%E9%E7%E5%E6%E4%A5%84%E5%9C%E9%E2%8A%A6%84%E3%BB%E8%E5%E6%89%88%8C%A2%E4%BB%8D%9D%AB%86%9D%99%80%99%E7%9F%97%B8%8D%91%E9%97%9A%9A%E6%A2%E6%93%E4%BA%E5%A2%8A%9D%89%92%8F%93%E4%E9%E7%B8%A0%86%E5%86%88%88%99%97%83%A6%BC%9C%BC%9F%80%E5%BE%8F%B3%E5%E9%95%B9%98%8F%E5%A5%A2%BF%E5%A0%E7%E5%8D%E6%A4%E5%B9%E7%E5%E6%9E%E5%BC%A1%E5%BE%97%85%9A%97%BB%E6%E5%B4%A7%A4%8B%89%E5%E6%BB%E5%E5%82%9C%B8%9F%AA%9A%A4%B8%A7%A1%92%E5%E7%BA%E4%A1%E6%E7%86%E8%E9%BA%B1%B7%8B%AC%83%9F%E9%AA%E5%E4%8B%A2%E4%E8%E8%E6%E4%AF%E9%BE%80%E5%E8%E5%E5%E5%A6%85%87%AF%E5%E8%87%B0%80%E5%E8%98%89%E6%BD%86%B5%BB%E5%88%99%E5%AE%8B%8F%AB%BB%E7%BB%AD%97%E8%E6%84%AE%E5%A4%AE%BA%E4%89%80%E6%E5%E4%8C%B8%A1%BC%B3%9A%B9%8E%E9%9B%AB%9D%94%A8%B1%E6%E5%E5%E5%E8%BB%BB%AB%8B%A0%E5%A7%AF%A5%BB%E6%8E%94%A8%B9%E8%83%BB%A9%E6%A2%8B%E5%B7%81%AB%E6%E5%E5%E7%9A%8A%E5%A0%E6%E2%E7%B1%E4%81%8D%A4%85%96%A5%84%E5%98%B9%E9%80%BA%BD%8F%E5%B4%A1%BB%E6%80%9D%A0%9B%E8%86%8F%BE%E5%BB%A4%90%AD%BE%8D%E5%92%8F%E5%E7%90%B6%E7%8E%E8%A4%E7%B9%94%85%8A%E7%E5%BA%AE%E8%80%E6%89%AB%8A%94%E5%E5%BB%E6%E8%E6%81%E5%E5%E5%A3%E5%E8%E5%8F%E8%98%E6%E4%E5%9D%8E%87%BF%A7%E9%E6%9C%87%8F%A3%E9%81%E5%A6%E4%B1%BA%8F%80%B8%E8%80%97%AF%B8%E5%94%B8%E5%E9%85%E4%82%BE%E4%89%84%8C%84%A1%88%9F%BD%B6%91%E6%E8%8B%91%A4%BB%9F%E4%E6%E4%97%E6%E5%E5%83%E6%B8%B7%B6%E5%E5%8E%E7%A5%E5%A4%E6%8B%85%8F%88%E5%E7%E9%E9%A2%E7%E5%E5%BE%E8%8A%A9%E4%B0%E4%E7%BF%A8%89%BF%96%89%8F%AE%8D%8F%B7%E6%B1%E6%BF%E8%85%E5%E6%E5%B7%E6%9B%BB%E4%9D%83%B9%A0%E8%A4%E5%8F%BE%BA%8F%83%B2%96%E4%9D%85%A3%E5%BE%E5%E7%81%88%B1%E5%E5%E8%8A%E5%A4%88%E9%E8%85%BA%E8%A5%E6%A5%B7%E5%E9%BA%E8%E5%E5%B8%E4%E4%E6%E5%B1%E7%A9%E8%90%A6%B4%84%E5%A2%8D%B9%E8%8D%98%E5%BD%82%99%9E%94%A1%A7%91%91%80%8F%B5%E5%B2%8F%80%BB%9B%A3%BB%B1%E5%AF%B3%AC%89%90%B8%E5%94%9D%BF%8F%B8%BD%BF%89%E5%E8%E6%9C%E6%97%E9%E8%9F%E5%94%9B%E5%E5%80%A6%E5%9C%96%96%8F%8C%84%E9%BB%BF%A1%B3%8D%E7%AF%8F%E9%B8%BF%E5%E5%80%E4%97%A6%E4%A0%E6%E9%BB%96%E6%BB%9B%B4%E4%E6%9C%E7%E5%8C%BF%E8%84%A5%96%97%E6%E6%E6%A7%E5%98%84%9E%E5%8F%E4%9F%AB%E6%8B%8B%E5%E9%91%E6%E5%A0%BA%E5%97%A7%E6%E8%94%8D%A8%A9%9C%8C%E5%A6%E8%A7%E5%89%92%8A%8D%81%E4%E6%E5%BD%B9%90%B0%A4%A3%E5%93%83%E5%B7%8D%BD%8C%BD%AE%A7%A3%BD%8D%A3%E5%BB%9F%93%E9%E8%8A%BA%E8%A3%BC%B6%E5%AE%8E%E7%A2%E8%BA%B4%8E%93%BA%E8%81%80%B9%BC%E5%B9%E4%A6%E5%BE%BF%BC%AE%85%E9%E6%B3%E5%E4%82%8E%E5%E6%B7%90%9D%E6%E6%E4%90%E6%E5%E5%A8%E5%A6%E6%E5%E7%B8%87%AC%B4%B3%BA%E8%E8%E4%E7%A4%B3%B7%E9%E8%8F%92%90%80%89%A1%84%B8%82%E5%81%A0%E7%B7%E8%E5%9A%8D%E6%A6%99%9A%97%B9%A6%E9%E9%9F%88%E3%A5%E5%A8%87%97%B6%BF%E7%E5%80%E8%E7%A3%9C%81%BF%E5%A1%A0%BA%98%B3%9B%A5%E5%9C%B4%9C%86%8F%B7%8F%85%A6%80%A1%E4%BC%9D%8F%8D%E5%9F%E5%8E%92%E8%9D%AD%96%E3%E6%86%AE%BB%E5%85%BC%88%E8%8A%96%B3%B7%88%E4%B3%E9%E7%E8%AF%E8%88%88%98%8F%8D%9C%E5%E8%80%E6%B8%8A%8A%E6%AE%BA%E6%95%E5%BC%8C%B8%E8%BD%E7%A7%E7%89%AE%B3%83%9E%E8%E7%A2%E5%8E%BA%A8%9D%E5%E5%E5%E5%E7%BB%BD%BB%80%B6%B0%8F%E5%8E%9C%9F%9C%92%E5%A6%87%9D%E7%86%B1%B7%B3%E9%86%A8%E6%85%BE%B2%97%E5%BE%8A%9C%E7%87%9B%9F%81%E5%9D%BB%E8%AC%B4%E5%BF%BD%E7%BF%E7%9B%BA%B8%A9%E5%8F%E7%E6%AE%8D%E6%E9%92%B3%BA%8B%B8%BD%B1%E3%81%8C%E8%A6%E5%E5%E5%96%B6%87%80%E5%E6%91%BC%83%A3%90%E5%8A%85%9A%A5%E6%B9%E7%87%88%E5%90%B0%BE%E5%BA%9D%E4%E7%B9%89%A9%8E%AB%A3%83%9E%AF%81%E8%9D%8D%E5%E5%E5%E2%A5%B3%8A%E6%AE%BB%9F%E5%E8%9C%A5%B2%E6%AF%AE%AB%B3%E5%E9%E8%B1%AA%85%80%E4%A2%E8%99%B7%BD%A2%B8%8D%E8%BA%E9%97%E7%9F%A6%BB%9A%90%E4%8F%BC%B7%E6%A7%82%E5%BA%E9%AB%85%E5%BB%9C%BF%A1%E8%BB%E5%93%85%B1%BA%E5%E8%E4%E6%E8%E5%8A%E6%A7%AE%91%B7%B1%8A%81%91%E4%B8%90%AB%BC%E8%E6%BB%9B%E5%BE%E8%E7%9C%BA%A2%BF%E5%BC%A5%AA%A7%B7%AF%9F%B0%88%B6%96%B8%A7%8A%B4%E4%E6%81%E7%E3%9B%8A%92%E5%94%A2%8D%A8%B8%B3%E5%AF%89%E5%E7%B7%E7%E9%E5%E6%80%E5%96%E6%A7%86%81%E9%99%BF%BE%B8%8A%A6%90%E5%9D%E4%BB%91%8C%E6%95%E4%BB%8D%9D%9C%90%E8%E8%E7%E9%E4%86%E7%A4%8F%B6%8C%9B%E4%AC%E5%E4%E7%9A%B4%86%91%AC%9C%E7%E6%E9%E5%E5%99%94%B4%B3%AD%E5%E4%E6%BA%E8%A2%94%AA%9B%B1%98%E5%A0%A5%AA%A5%B9%B7%E5%E7%BC%E6%AE%B8%96%BE%B9%A6%94%99%A5%E8%95%AC%E6%E5%97%E6%87%E7%BD%A6%E6%E5%95%9A%E5%E5%E8%E7%A7%9D%8B%B7%83%E4%87%AC%9A%E7%E5%89%8F%95%E5%E9%88%B2%E9%87%A1%85%88%8D%9D%E8%E8%99%E3%BD%BE%A0%A3%E5%E4%A5%E5%BD%8E%E4%E5%E5%AE%E4%E8%89%E5%9C%98%9D%B9%AB%E8%E5%BB%E6%BC%80%E9%E6%88%91%86%9D%93%89%E5%BD%AC%E8%E6%9C%E8%E5%A8%E5%B6%87%99%E9%B8%A6%A3%B0%80%AD%B0%E5%E5%AC%A8%9A%E5%B6%8C%85%A8%E9%A6%E7%E4%BB%E5%E5%81%AF%AE%E7%E8%E5%82%B6%E8%E8%E4%BA%B4%E5%A0%E9%9B%96%83%9A%E4%88%E5%A6%B5%93%E5%9B%B8%BF%A8%B9%A2%E8%E6%E6%A3%80%A1%E4%B9%8E%E5%A0%AA%E7%A6%86%9B%B8%BB%B3%E7%AD%85%E8%E7%BB%93%9B%AF%BC%8E%E6%8F%96%95%86%B4%E6%E6%E6%9F%E5%E5%B3%E5%E5%AA%E4%E5%A5%B6%B9%B3%96%AB%BC%E4%80%E5%80%E5%B7%E9%E8%E8%E6%E6%A6%A1%8B%E6%81%BC%88%B2%BE%E6%BE%83%E4%83%E6%83%8B%91%93%E5%E5%E5%E4%A7%88%96%BB%88%86%AB%A7%9D%B4%A6%E6%90%8E%E4%B5%8C%8A%9B%A4%B2%E4%9C%BA%BC%B7%A6%85%9D%E6%AB%E7%9C%E5%8D%BC%8C%E8%E7%9D%E4%84%E4%A6%AE%9D%E4%E4%B3%85%E5%A6%86%A1%E9%A1%B0%B4%E7%E7%BC%B1%E7%E6%97%A7%8F%E6%AC%8D%E5%83%E5%8E%80%A7%8F%E7%A2%8B%84%E5%B0%E7%86%85%AE%E9%BA%BF%96%9B%9C%A4%E8%AC%86%BB%E5%E6%BE%E7%AC%81%E5%8E%AE%E4%E6%BE%A7%AB%E5%B9%E7%82%8C%E5%AF%9C%BC%AD%8C%E8%E8%97%81%A0%B8%85%E8%BD%B4%AC%E4%E5%E7%90%E8%9A%A7%B2%E6%E5%B0%9B%A5%B0%E8%8C%89%E5%82%E5%BB%A0%A6%A6%89%BC%99%E8%B7%B2%93%8F%BC%E6%9B%A4%E5%97%8D%94%98%99%85%E7%E6%B7%E5%82%E5%8F%A3%88%90%BF%94%E8%A1%87%E3%E6%A4%E5%BE%8F%9C%A5%BA%83%E6%A8%B7%E5%AB%E6%B4%90%8D%BC%B0%AC%94%AF%8F%85%9D%95%E5%B1%E6%E8%9A%BA%E3%81%94%E4%E5%83%E5%B0%E9%81%88%AF%A1%BF%E4%E4%AD%80%E5%E5%95%82%BA%A4%E7%97%E4%9F%E9%BB%E4%E7%80%AC%B2%A7%B7%90%8D%84%E8%9A%8C%8B%AC%B2%8B%90%E5%93%E7%A6%B9%E5%90%99%98%A4%E5%BB%E5%9B%BB%E8%E6%A6%E8%E5%E3%E9%B8%E5%AA%A8%E5%BC%B7%E5%B2%93%E8%E5%E4%E5%E5%E5%9D%B6%BE%83%82%E5%8F%A7%82%A5%B2%90%97%AE%A8%91%E8%B7%8A%BA%E5%E9%BA%A8%B3%80%89%88%BA%E9%E7%A3%AD%BF%E6%9C%8C%A0%85%E6%81%8F%96%E5%8B%97%B4%E5%8C%E8%AE%BF%9B%E6%B9%BE%9D%E8%A6%E5%88%97%E5%E7%E6%E8%A1%9F%89%A8%97%BE%8D%BB%E8%8F%E5%AE%8E%82%99%E4%E7%E6%B0%BC%AB%B4%9E%93%9F%E5%A9%83%83%E5%E4%A5%E5%83%9D%E7%E5%E6%B9%9D%E8%8C%E5%E7%E5%E7%9B%E4%B3%81%91%BF%99%98%B7%86%E7%B8%E5%E6%9D%A4%BE%88%8A%B2%A7%E6%97%B4%91%E7%E5%E5%E8%B8%B0%E7%95%E5%A6%8F%AC%A8%A1%E8%83%8C%94%E3%92%E3%8E%8F%AD%A4%8D%9B%91%E6%E5%B1%88%99%80%99%A8%BA%E4%8B%E5%AC%9D%BA%E7%88%E4%A8%94%E7%A6%E8%E8%81%B3%A2%81%E6%BE%92%E5%A7%BE%BF%E8%E4%E5%E6%9D%BC%E5%B6%99%91%E3%E7%E6%E8%88%AF%E7%C2%E9%8C%A1%86%9D%E5%A2%E8%B4%E7%9E%E5%97%87%80%E6%82%E5%83%A0%AD%BF%BA%B4%BD%82%E5%E6%94%87%E9%9A%E5%8F%B1%E7%81%AF%BE%94%BF%E4%9E%93%86%BE%E5%B8%E6%A0%8B%A4%E8%88%A4%E4%BD%E7%E6%B1%AF%B3%E6%E7%8E%E6%E8%E8%BE%81%A1%B7%E7%BA%E4%B9%9B%B4%86%82%94%83%91%84%91%8A%85%E8%B0%E8%A3%A4%80%80%BB%99%E9%8F%E6%E4%88%81%E5%B8%97%BC%E3%E5%AD%89%B9%AD%88%E5%E5%E6%8E%8B%9D%E4%E5%E5%83%E5%E6%E4%BF%88%E6%8C%A2%E4%E9%B8%E7%AD%E4%E6%A3%E8%E8%E5%A9%88%A0%A4%E8%97%9F%BB%E5%E4%BA%98%AF%B8%E8%BA%E8%E8%E5%9A%E8%89%A4%87%B6%8E%A6%B7%A0%80%93%88%A9%E5%B8%B9%BF%97%9F%E8%E5%94%E6%83%88%A9%B9%97%97%E8%85%A8%E3%97%E6%AF%E5%A2%9B%E5%8A%E4%80%BE%BA%8F%BA%82%E8%B3%E5%E4%AA%E3%90%9D%E4%90%AA%A5%87%E5%97%E9%E8%90%88%AD%81%BE%B7%8C%BC%A7%83%90%AE%E5%85%BC%A2%85%E5%80%80%BD%83%9A%B4%A0%BE%A1%91%E7%E5%87%E6%B8%A2%E6%E8%E5%BA%BF%E4%BE%E6%E6%96%8B%A3%B8%88%87%E7%86%B8%93%E6%E6%E4%87%E7%E4%E5%B4%AA%E5%82%A7%B4%88%8D%E6%BC%E8%8B%80%9B%8C%E2%E6%E6%80%E5%90%9D%89%E7%E8%A1%84%E5%E8%BE%E5%E9%83%97%AA%E5%BF%E5%E5%E6%99%E5%B3%8F%E7%B7%9F%85%B8%E7%AE%A9%BF%E6%BC%A4%AC%E7%8F%A9%B7%8A%B7%E6%80%80%B3%9C%AA%9A%B7%E7%E4%E3%E6%E9%E5%98%E6%85%B0%B1%9D%99%BE%80%BC%E9%E5%99%BB%A8%99%B3%B3%97%BF%B7%A8%89%E5%AF%9B%AE%86%AE%8A%B8%87%E6%81%E5%A6%E5%98%BF%8D%E5%B3%E4%E4%BD%E9%BC%E7%94%B2%BC%94%9B%E7%BF%BC%8D%80%E8%BC%83%B3%BA%A4%9D%BC%E7%E4%E5%B3%8F%8F%E5%9B%9C%A1%9F%B1%A0%81%A0%B1%E5%85%B7%E6%E5%88%91%AE%AB%80%E9%80%A2%AC%E8%E5%9A%E5%8F%E3%92%90%AB%E5%B8%84%AB%90%A7%A8%85%E4%81%E6%AB%E5%AE%AD%97%B7%9C%88%8E%96%B2%9E%A0%E5%E9%E7%E8%E5%A8%B8%9F%85%92%9B%E6%BF%94%9A%9B%B0%9B%B3%E5%85%E6%97%A7%E6%9F%98%89%97%E7%80%83%AE%86%E5%E5%95%A9%91%BD%E5%90%92%BA%E6%A4%E4%AB%E4%B9%E6%8B%8F%A6%E5%94%E5%B2%A2%8D%AE%E4%B7%B8%E8%E9%B7%81%A7%E6%90%BF%9E%BE%E5%E7%AB%E4%E8%8B%9C%B8%85%E7%E5%90%E7%E9%E5%A2%B4%E2%AD%83%8D%A5%8B%AD%BB%E8%B7%8C%B7%AB%E5%E9%BE%E5%97%BA%E5%E7%86%B5%E4%AB%A5%BA%A9%AE%B0%E5%B8%9D%B7%A6%9F%9F%90%BF%88%84%BF%9F%E5%A2%8E%BE%B2%E6%E8%BC%B7%A4%88%E7%AB%B8%B3%86%93%BE%B4%E5%8D%BB%B1%E6%E7%BF%93%AE%8F%E6%83%80%85%A7%A2%E5%82%8F%E5%A5%E5%E4%E4%E6%BE%E4%87%8E%B3%8B%8C%E4%98%E5%E7%94%B8%9A%A5%E8%AE%BC%E5%E5%B6%A7%AF%E7%E6%90%E5%A8%E9%88%9C%A0%E6%E6%E4%9D%E5%E8%84%89%8A%B5%A6%E5%E5%BE%85%A8%A3%81%E6%8D%AD%BA%95%BA%8F%E6%E4%B8%AF%A5%81%E9%86%80%E6%E4%A1%E6%B6%86%B0%97%97%AF%85%E5%AB%8C%E5%E5%BD%9E%E7%E7%8E%A7%BC%8C%E5%E7%B2%9C%88%8D%AD%E6%E5%90%BB%94%86%E8%81%85%E8%94%82%E4%E6%E7%E9%E5%BF%E7%E8%8F%AF%A2%E6%E5%88%BE%AF%E4%99%B2%B8%88%A7%BB%9A%E5%A8%BF%AF%E4%A7%A2%E4%A7%AD%89%A8%AB%A7%BA%85%E6%E5%8C%80%9F%A9%B9%80%B0%E5%BB%91%BC%A8%85%94%E5%A1%BF%E5%E5%81%E6%9E%B9%B5%E5%AE%BD%A4%88%88%E6%97%E5%8F%90%94%E9%87%A8%AF%91%8B%87%E7%98%E8%A0%B8%E4%BC%9D%BB%8F%A5%AE%E7%8E%E6%80%94%8D%B4%E7%E4%E5%BF%E5%E6%9C%AE%E8%8B%86%E5%9B%E4%A9%B5%99%B1%97%E3%B6%E5%B5%E5%E5%E5%E6%A4%E7%E6%A8%E4%E5%E6%E8%E6%E6%AE%96%AE%E6%E8%B8%8C%E5%AF%8E%AF%A6%A8%BE%B0%E8%E6%E6%E6%E8%92%87%88%AE%E5%A4%A5%BC%BD%BF%97%E8%BF%E5%8F%A8%AA%E5%E5%88%B3%BB%B2%AB%8F%81%9C%A8%E5%E9%8F%B8%B4%85%E9%86%A7%88%88%84%94%E5%85%BB%E8%E5%82%B0%80%B7%E8%8F%E8%BA%B7%E4%E9%E5%E9%E9%E5%AD%9C%E4%E3%AF%AD%81%A6%E5%88%E6%8B%E6%BF%86%83%B4%B8%B3%E7%E6%E4%B7%8B%E4%E6%96%A7%E6%E8%E5%90%BB%E7%93%89%E5%8A%97%97%BA%85%E4%E7%E5%86%B9%8A%E6%B8%89%BE%BE%A2%E7%AF%89%AF%88%E3%9B%AE%BE%8E%B2%9A%A7%A9%AE%9A%E5%E2%BA%E5%E7%88%90%B4%B4%86%AF%E7%94%B3%E9%E6%E6%90%E5%8C%E6%96%8E%B6%8B%8F%B2%B8%E4%A6%E8%A5%E6%8A%9A%E6%90%E5%E5%BB%BE%A4%94%E5%E5%88%E7%E4%AE%A9%BB%97%E6%8F%E5%90%80%A4%A4%8D%8A%E8%B3%A4%8C%E5%E5%80%E8%E5%E5%BF%80%AF%AD%83%B1%B8%BC%BE%A1%E6%BE%E5%8E%AD%8E%B8%9D%8C%E3%E6%AB%E8%E7%9A%E5%E6%A7%BF%E5%E8%B8%8F%E4%A5%E7%9D%E6%B7%93%BC%BE%E4%83%B5%97%B9%A9%E5%8D%85%E6%AD%B6%8B%A4%E5%AF%E4%89%92%E4%B7%AA%E7%E5%E5%E6%B2%98%E5%A6%E4%81%8D%81%E5%8F%97%A5%E9%94%88%89%E5%9C%E5%A2%B2%A7%BF%B8%BF%E5%E8%8D%BB%8C%AA%84%E5%8D%BE%94%E5%A7%8E%AE%E9%BE%83%9A%93%B0%AD%A5%8A%8E%E8%9D%92%E5%96%AB%B0%E5%A3%AF%BD%B7%80%AC%E5%E8%B8%8B%90%E5%B0%A9%AE%81%8E%E5%94%95%86%B6%94%E6%94%A5%95%BE%AA%BA%E7%88%B6%9D%E7%A3%B3%B8%B3%E9%BF%BB%95%88%A2%9C%B9%BE%A5%BD%A7%A8%AC%88%9C%96%E8%B5%E6%8E%E4%83%85%B8%E7%B8%A3%A7%90%E5%92%E7%BE%E5%E7%B2%B2%E7%E7%BD%A3%BE%91%BF%AF%81%90%B4%E5%8D%E5%E5%A7%E5%E9%85%99%E5%E7%E4%E4%93%97%B8%85%8C%BB%A8%9F%95%E5%B1%8B%E8%E5%94%AA%85%E5%8D%E5%AF%E5%E5%B7%9C%99%E3%B0%9A%9E%A6%E4%A5%83%E7%E9%B0%90%85%88%85%E6%9F%96%8B%9E%94%AB%E6%9D%8B%BF%8A%E6%99%A6%85%A3%E5%93%E5%82%A5%E7%B8%E7%AD%93%88%A1%E6%E8%E5%E8%BF%AE%8E%E6%E5%AA%E5%BF%E8%B4%BE%E5%E6%8E%E7%95%E8%85%9D%E5%E8%8C%9D%E5%E5%A2%E4%E7%E7%E5%E5%E5%A7%94%84%8D%E6%E5%E7%AA%B3%E5%E6%A0%E6%E9%8F%8F%8C%86%97%89%A0%E9%E5%A8%B0%AB%8E%E5%E5%E6%A9%E4%E8%E9%8A%9B%E6%85%BB%94%86%E6%E9%B6%82%B0%BB%B3%E6%80%90%BC%83%B9%B9%BF%BB%80%A6%A8%B0%E5%AB%A5%E9%E5%E8%88%B7%83%95%E6%B4%AF%E5%A1%E8%AD%E6%83%94%80%E5%98%89%E5%E5%8C%9B%E5%B8%9B%8E%9F%E5%E5%89%B9%97%A1%85%BB%BB%9B%E6%A8%8B%8F%E6%B9%80%B3%BF%E7%81%BA%8F%E5%A4%BC%E5%80%A7%BD%B6%BF%AA%8B%E7%E5%E8%9B%E6%BB%E4%8F%B9%E6%BA%91%E7%84%E4%85%8F%AF%95%E9%B8%88%8D%E7%8C%AD%A9%87%E5%B7%80%E9%97%A1%E8%A0%8E%E5%A3%BE%A5%E6%E7%E6%89%A3%A1%E8%E6%E6%BA%95%B3%E5%A1%E5%97%AF%BB%82%A7%B3%E6%E8%E6%E4%80%A6%E6%9E%B5%E7%E5%E8%E5%A5%E7%A7%E7%E6%91%97%81%8A%E5%9D%AB%A9%A1%E8%80%96%BB%E5%9D%97%9A%89%BB%89%8A%87%E5%AB%E5%A4%80%BB%E4%AC%83%80%86%9A%8A%B8%97%9D%9B%E5%A6%81%E8%8B%B2%A7%A4%E8%BE%E8%E5%E5%92%E5%A7%B4%99%BF%E5%E5%AF%B7%91%E5%B4%80%BF%B3%B1%95%9D%E5%8F%AE%E4%97%97%BF%E7%B1%A0%E5%82%BA%8D%B2%E8%E9%85%83%88%E4%E6%E4%99%A1%96%E7%E6%94%85%81%B7%BA%97%E6%E6%92%A5%9B%E8%8F%8A%B0%8C%E7%E8%E6%96%88%BB%B6%E4%B2%E6%E5%AC%AD%AE%85%BC%88%E4%A6%E4%BA%BB%E6%BD%BF%B9%AB%9A%E5%E5%BB%BA%E8%E5%90%BA%85%E5%E6%B8%A6%E9%94%BA%E8%81%E8%E6%81%E6%88%E4%B6%96%92%A5%BB%B9%A1%BE%81%BA%B7%A9%B2%8D%8C%BB%9F%AE%E5%AB%A0%88%83%9D%A0%93%88%E7%E5%AD%E5%AE%BF%97%E4%94%94%E8%E8%8E%BA%E5%E7%94%A4%9D%9A%A4%E6%A8%B0%8C%A4%E6%E5%B1%E6%B9%A7%E5%9C%E6%96%E5%83%E5%E5%B4%88%B0%A5%82%98%E8%8A%B1%A7%E6%B9%90%89%80%A7%B8%87%98%E5%E8%E7%E4%BE%E9%85%83%E9%8B%E8%89%8E%81%AF%E8%97%E6%92%E6%A6%AC%B8%9F%E5%E4%BA%8F%A1%E8%8C%A8%96%BE%E6%B6%90%B4%A3%E6%B9%E6%9B%B7%A0%88%A5%BE%8A%E5%E8%9D%83%BF%A4%E8%9D%80%94%E5%AD%E5%E8%BD%AE%E4%8F%9C%94%B4%E8%84%A9%A7%87%81%E8%BE%8D%8B%E5%9D%8B%9E%E6%E5%E4%A0%91%E5%E9%E5%E9%E9%AE%B0%97%A7%E5%E5%B7%89%B8%E5%E8%E5%8B%9C%E5%B9%80%E5%AE%E9%E5%E5%B3%BB%E8%BC%E8%E9%98%E5%BB%85%BF%B3%E6%B8%B0%E4%AD%BD%8E%E4%E9%86%E8%E7%8F%A5%98%8D%E5%B0%B4%83%AC%B7%E5%BF%9F%99%98%80%E9%E5%87%E4%8C%E8%A8%B1%E6%A3%BD%9D%80%AF%E5%B8%AF%90%E7%A7%A1%86%98%99%BD%8F%8B%E6%A3%81%90%E6%A8%A1%B8%B9%85%E5%89%AB%BC%E5%AC%E7%B6%8E%BD%90%A9%90%B5%88%BF%A0%8D%9E%E5%B6%E5%E5%E6%8C%E7%E7%E7%94%E8%A9%E2%E6%BC%E9%B6%B8%BB%80%E8%E6%A5%B7%84%BF%E6%E5%E6%A7%A6%80%87%A0%86%83%90%E5%91%8E%A8%E7%A4%E8%B9%E3%8E%E4%E8%BC%BA%81%90%9B%E6%BB%92%E5%99%E5%98%BC%B4%E7%83%E5%E7%E9%E3%95%E5%BA%E5%A5%B7%A0%BA%98%E5%BC%90%9A%A0%E3%B4%E6%E8%E9%9B%E8%E5%80%BD%BF%8F%B3%E8%92%AD%8F%A6%A0%E5%E5%BA%E5%BD%E7%8E%85%E7%E6%BD%A8%AB%E7%A6%97%9F%E5%E6%AF%E9%B1%E5%B4%86%E4%E7%84%B3%B3%E5%AB%E4%E7%A8%E9%87%E7%A6%BF%BF%E5%E8%E5%94%8D%81%E5%8C%8B%AC%B8%93%E5%A6%BE%98%E5%E6%E6%A8%AF%A3%E5%B9%E8%E4%B8%85%E5%E5%E6%E5%BC%E7%93%E4%AE%E5%E4%B9%E5%AF%95%B5%BB%E9%A0%A3%E9%B8%BF%A5%B9%9F%E5%9C%E5%B4%BC%B6%B3%B9%8B%88%AE%AB%E4%E9%A2%E4%8F%E6%84%E5%A6%E4%E3%E4%E5%E7%97%98%E6%AE%A7%E6%E8%A8%E6%83%E5%BD%E6%E7%8B%BF%9C%E7%87%89%E5%E9%84%9F%E6%AC%B4%E9%A4%80%E5%E6%E9%9C%8A%E5%8C%8F%E5%E6%E8%B2%AF%9B%E6%BB%BF%AE%BE%B9%BF%B1%BA%81%83%81%A3%E9%E5%BA%A9%88%83%91%E5%A2%AD%89%AE%90%E7%A4%96%83%E5%9B%A8%B3%E6%A5%E9%A6%AE%95%BD%9A%B7%A6%99%9C%BF%E8%E8%AB%81%E5%B8%BF%E6%E5%94%B2%94%86%9D%85%E5%BC%9D%E8%E5%A1%E5%A8%BC%A4%E7%E8%E8%B8%AB%A1%8A%86%8C%80%E9%8A%A7%E6%AB%8B%AA%BB%B2%AC%E4%E5%B8%88%9B%90%E5%AF%AB%AC%80%E5%E5%E8%9C%E4%81%AA%E4%E6%E5%98%83%A9%E5%E6%AB%89%A2%E4%BC%AB%E5%B7%E4%AB%BD%A7%E8%E8%BB%A5%8D%A9%E5%90%A7%AC%E5%96%E8%A7%8F%E7%E5%97%94%AF%E6%E5%A7%8E%BC%E8%87%E9%B8%8C%E5%90%A2%8F%A2%89%A6%E6%E5%E9%E6%9B%E6%E5%E7%B8%E5%E5%B2%96%85%A1%A8%B8%82%BB%BE%84%A4%81%A3%BD%A7%AD%E3%89%8D%93%A3%E8%E7%86%AD%E7%98%AA%BB%E8%E5%BF%B4%97%86%AE%BA%BF%AE%8D%B2%E7%89%AB%86%BD%BB%E9%97%AD%86%E5%94%E6%90%A7%BC%B8%85%E7%A0%88%A1%B6%90%B2%94%B3%AB%BB%80%BB%AB%9A%E6%E9%E6%B6%BC%B7%A2%E5%BB%95%E4%E9%A7%91%AE%A4%99%8B%99%B6%BF%9A%A3%8C%94%E6%80%97%AE%E5%97%8B%A1%86%BB%99%94%AC%E8%B3%E6%E7%86%92%E8%AF%88%E9%E9%82%84%E5%B4%E5%E5%A4%E7%81%B7%AF%87%A4%A6%E5%E5%AE%AE%88%E5%91%95%B8%E9%8F%E4%8F%E4%E4%E5%BE%AD%84%9D%B7%E4%A4%8A%B1%A3%E5%B0%A1%E5%E6%94%9F%B9%E5%E5%BC%E8%E7%9C%E8%89%B8%E9%90%BA%BD%E5%E8%E6%BA%E9%8C%9F%BB%8B%BE%89%80%87%E4%BF%89%95%E6%AF%A2%A0%B7%E7%B3%8B%9B%9C%E7%9B%A3%97%E6%E5%E7%BA%E4%BF%B4%E5%E5%94%A7%87%98%86%B7%E6%E5%B8%E5%E6%E4%B9%E8%E7%E8%E4%E6%AD%90%E4%E8%8D%A0%A7%A7%E7%E7%8D%AE%E5%B6%E7%8F%AE%AF%B0%88%E8%97%9A%A9%90%E9%E8%AD%AD%E5%E6%E4%BA%96%E4%E4%8C%E5%8F%B1%E5%E5%BF%9C%88%AB%8D%E9%97%93%B4%85%A0%88%BB%AD%BF%E3%E4%E8%E5%B1%E5%AB%BF%97%E4%8D%BF%8F%AD%E4%9C%B9%9E%A1%80%B8%8C%89%E6%E5%B9%A9%E8%81%B4%A9%E6%BF%96%BF%9F%E6%E2%AC%E3%E8%A4%E5%B4%B5%E5%A1%B4%E5%E5%92%AC%BB%E6%E7%8B%8F%8C%E5%E7%E4%E5%94%E5%8C%86%88%94%E6%E8%9F%B7%82%A8%95%E5%E6%AF%95%E5%84%B9%B7%E8%83%9F%AB%B9%E6%B4%B3%B9%E6%87%A6%E9%B8%95%8A%8E%8E%E6%9A%E9%E4%93%E6%E5%E9%E5%94%BE%E6%B4%95%AF%A6%E8%E4%E6%8E%AD%BF%E7%95%B7%E8%E4%A8%E5%A1%E4%87%BD%80%8A%E6%B5%9A%E6%B7%BA%E6%94%8C%E5%B3%E3%E6%BB%B4%8D%E8%A5%91%E5%B3%E5%E9%81%BA%B2%E8%86%88%8B%97%9B%E4%9E%A2%8F%E5%83%99%94%E4%BF%B8%95%E9%E5%E4%BA%A8%80%A7%9D%8C%94%E6%E8%B9%E5%E6%95%A4%94%B4%E6%8C%81%A0%9B%A2%E5%AE%88%9E%E9%89%80%A5%97%E9%94%B4%AC%AF%9B%88%BB%A2%E8%B8%E8%8E%E4%8C%8C%81%A6%8E%AB%BA%E4%E5%AE%A7%80%BB%AF%E4%A8%A1%B4%AE%BB%E6%E8%A7%8B%B1%E5%8A%BC%AF%AE%A3%9D%E4%E5%81%A1%8D%9D%A8%88%E6%E5%90%8A%E6%9B%93%AD%E6%E6%B9%AF%9D%85%88%8C%E6%E5%8C%E4%E5%AA%A7%A9%80%87%8A%AB%AC%E5%85%8B%E5%8C%E5%BC%8D%E5%E6%B0%E5%9A%8E%BC%9C%E4%A5%80%E4%E6%90%E5%B1%99%A1%E5%98%85%9A%E5%80%E2%97%E5%AD%92%B3%BC%AC%88%AE%B6%9B%A8%8C%E8%9E%AF%86%E5%88%97%B8%E8%B4%E6%94%9B%94%E6%BC%94%E5%E6%9B%E5%B3%B9%AB%9B%98%90%E7%E4%88%B5%B8%E8%BA%AB%A9%A2%85%B8%E4%E8%BC%9D%E7%E5%A0%A9%BA%80%86%AA%AE%E5%E8%A2%94%A1%A5%BA%E9%E5%89%98%E5%E8%B3%E9%E5%E5%BC%E8%E5%82%AF%E5%B7%94%81%BE%E8%8D%96%BC%AF%B9%E8%AE%E5%E5%83%E6%E9%A2%8A%BB%8D%B9%A9%B1%94%E8%E5%98%94%9C%E5%E5%8F%BF%9B%8A%99%A7%83%8D%E5%E5%E9%E5%98%E6%BE%97%AF%E7%80%87%92%E5%80%BA%E5%B2%9F%E8%E5%E8%E4%E8%85%A7%E6%E5%AD%90%E8%E5%E9%98%A2%E7%AE%8B%A4%A5%90%E8%C2%E4%88%E4%A1%8D%88%BE%9C%AC%86%E8%E5%93%B8%A3%E5%E6%E5%81%98%87%E5%E5%E5%E6%E8%E7%81%BB%8A%E6%A0%E5%E5%E5%A1%94%88%94%97%90%8A%80%E5%80%E6%E7%89%B2%E6%E8%81%96%E5%E8%B0%E5%88%80%BF%E5%9E%E6%E3%8E%E5%A4%AE%E5%E5%E8%E5%A8%E7%87%E7%8C%E6%8B%E5%E6%B6%90%AF%A1%E6%8D%E6%94%E5%A7%E8%B0%98%E6%8C%E5%81%97%E4%E4%E7%8B%BA%E4%E7%E5%8C%BF%E6%AD%E5%A0%B0%AA%BF%8E%E8%90%9D%E5%BE%E8%B4%E8%83%E5%8D%E3%98%B0%85%80%E4%A7%B9%E6%BA%AB%E5%BF%E6%E7%9D%B9%BE%AF%9A%A7%E6%AE%A6%E4%B1%8B%B3%AB%E4%E6%A8%99%97%8B%87%A7%99%A5%AA%AF%86%B4%B2%AC%81%A7%E6%8F%86%E8%E3%E5%8A%E8%BF%A2%E6%E9%81%E8%8F%B3%E5%E9%8C%80%E7%E6%E8%90%A8%AD%8D%E7%AC%8C%E4%BB%8F%85%E5%A1%80%E5%E6%A9%A4%BA%E7%94%E2%89%E8%E8%91%A9%84%9A%E5%BE%B6%A1%E5%8F%B5%BF%E5%93%E4%85%86%E5%E8%88%E5%E5%E5%BF%A7%E9%E5%8C%E5%A4%B1%97%8B%E5%93%BC%B4%AD%B2%B8%AF%99%A1%AD%E5%8F%B3%E5%8A%E5%B7%E5%E9%94%90%E5%E6%B8%8D%8A%BA%80%9C%9A%8E%B0%8C%89%E4%BA%86%AD%8F%E6%8C%A1%E8%E5%9F%E4%B7%E5%E6%91%8E%BC%E4%AE%BC%E4%BF%AF%E6%E7%A7%9B%9B%E4%E6%80%E8%A7%90%E9%E4%90%A8%E5%88%E5%E5%B9%E5%B0%E4%E6%81%BB%E5%E8%9E%B7%E4%E4%85%E8%E6%9B%E6%E5%B8%E8%B1%E5%E5%A2%E5%85%E7%E9%88%A0%E9%BC%E7%A0%E8%E7%E6%E9%9B%A6%E5%85%85%E6%94%E5%8C%81%8D%9C%A7%E5%A9%B6%E7%E5%E5%E6%85%89%BB%98%E5%9A%94%E5%E7%E7%85%9E%A6%B0%89%83%85%E9%90%E3%E7%8B%AF%9D%E5%E6%B1%E5%93%90%94%82%E5%E8%96%AE%E5%94%8B%E4%E5%91%99%AB%9E%E5%AC%E5%E5%E4%E5%81%E8%B8%E8%86%9D%BD%E5%E5%E7%A5%8D%E7%A5%86%91%A2%A1%8E%8B%B9%E8%80%B3%89%B2%E6%B8%94%E5%E6%9F%83%E5%8E%BA%A4%96%A5%E5%BA%91%B9%E9%8E%BF%E5%AA%B4%9B%E4%99%94%8E%9C%A0%9B%AD%E8%B6%91%85%B3%86%BA%BE%E5%AF%E6%E6%E6%8D%E5%E5%82%BA%A7%95%E6%90%E5%B9%E9%B5%98%8F%A3%A6%E6%E8%E5%BC%85%86%E2%E6%8F%B3%E6%E6%8A%E5%E5%B9%A8%BB%BB%B3%81%A4%E5%98%E5%AE%E5%E8%9C%B0%9B%E5%89%B9%92%A5%AE%B6%B1%BF%E7%B6%E7%9D%99%E4%E5%A3%E5%97%8F%E6%A5%E8%E6%81%E6%E5%E8%A3%A2%BD%E6%A4%9F%BE%E6%E6%A4%8D%8C%AB%9A%9B%80%B4%BF%B0%E8%9B%E7%8A%E7%8E%E8%8F%A4%83%E5%83%E9%9B%B8%89%86%E6%E8%E6%E4%A9%97%88%9B%A1%E6%E4%E9%83%92%B0%E6%A1%E5%E4%85%8C%E5%BA%E5%A6%E5%94%80%BF%99%A5%82%8F%AD%9F%E6%94%E7%9F%E4%BE%8A%E4%BB%BA%B7%8A%A6%E5%E5%A4%B7%B8%80%80%95%E9%E5%E5%E5%86%E6%B9%8E%A9%9C%E5%E7%BB%A8%BD%91%B8%8E%84%E6%83%B0%9D%96%93%E5%E5%B8%8F%E5%AA%80%BB%E9%BC%E7%E6%E5%B9%B2%E6%A6%90%E5%BD%E5%E6%B9%8D%83%E5%E6%8A%E5%E5%A1%E5%A3%BD%8F%8C%AC%E7%E9%BE%E5%B2%B1%AC%A6%A5%A5%8D%E5%E5%B8%E8%E5%80%E4%AF%E4%BE%E5%A2%BB%A8%E8%88%E4%E6%BF%B9%8C%AE%A1%AE%E8%E5%9D%93%83%80%E5%BB%BB%E7%E5%83%E6%81%B1%E5%BA%8C%B4%BF%E4%AE%E5%AD%8F%A5%90%E6%E6%E9%BF%97%A2%E5%AC%83%94%B9%E5%BA%A9%A5%95%85%AD%E4%AB%E4%E5%97%94%BA%A9%8D%8A%E7%BE%80%E6%E6%9F%90%9F%E4%E8%88%9D%BA%E5%8B%80%E5%A6%BB%A9%BE%A5%9F%8F%AE%E5%B8%E7%E8%97%A0%BC%E4%B8%E5%87%B0%E3%E5%E8%BB%E5%8B%8C%89%9C%A9%A0%E5%E7%89%BF%B8%E6%E5%99%E4%9B%E6%A0%A2%E6%A7%A7%BC%E9%8B%E5%E9%8B%9B%E5%E6%85%B3%8F%82%A5%A5%98%E5%E7%97%8F%AD%E7%BC%B1%E4%B9%E5%B3%E5%E7%B9%AD%BE%E5%95%E7%E6%A5%E4%BF%8E%98%AE%A5%B1%E8%8B%99%A2%E7%BF%A3%E8%B2%8F%96%80%81%A5%84%86%E5%E7%8B%A8%A8%8B%9A%9C%B2%B3%E5%81%E8%8F%BE%A5%98%B4%E4%88%B0%9F%8E%E5%88%E6%B1%8F%94%E8%A9%BB%8A%AE%E7%8C%B2%BA%E6%99%E4%8C%AC%B6%E5%E9%E5%E5%A1%8C%B9%BA%BB%A5%E5%90%A7%99%E5%E5%9D%BE%B1%97%8A%E8%E7%BE%8E%9D%E5%95%B8%E6%9F%E5%B7%8F%BD%E4%9D%AD%8F%94%E7%9A%80%A2%86%E9%E6%99%BF%95%E8%81%81%E4%BF%83%E7%8D%A1%85%90%A7%80%B7%E4%E6%E5%97%E6%A7%97%E6%8B%B1%9F%E5%E5%E5%94%9F%E9%B0%86%BF%E8%E8%E6%E8%E4%85%85%B2%8D%A6%B1%A9%BA%8D%E5%A4%89%90%A6%94%A2%9C%A4%95%A6%E5%B6%E8%BA%BA%89%B8%94%B8%9B%A5%E5%B7%9C%E7%9C%E8%E5%97%87%E5%92%9D%BC%AD%AE%E6%BA%E5%BB%91%88%A0%9D%8C%BD%94%85%E4%E7%82%AC%E7%B4%E4%8F%8B%E4%BB%E6%AC%A8%B7%B6%E9%E5%89%9B%E8%E5%9C%E9%AC%BB%BF%88%BF%A1%E5%B5%E6%9F%E5%E5%E5%89%A8%83%A1%E5%E5%E8%8C%8F%9D%8E%83%90%E5%E5%A3%AF%E4%AB%E5%BA%E5%86%84%8C%B8%98%E4%80%A1%E6%E7%A5%BA%93%B7%BE%99%B8%B1%94%E4%B8%B7%E5%89%E8%BF%8E%E5%B2%88%E5%89%E5%95%AE%80%83%B7%A6%E8%E8%E5%90%A6%AF%E6%9B%E7%AF%E7%E5%E6%E5%9B%B0%E5%B3%86%BA%A0%E7%B7%95%BB%BB%AB%E7%AB%E7%85%E5%83%90%A6%E6%E7%E8%91%8C%BA%E6%A1%91%E5%E4%9C%8F%E5%E9%88%8B%8A%A6%91%E5%AB%87%E9%E6%89%B8%A3%A8%E4%94%92%84%AB%99%E6%8F%AB%97%E7%E5%B3%80%B3%AA%E8%86%B7%84%BB%A5%B3%9D%B1%8E%BF%E8%9B%BC%81%9D%E5%E4%E6%9D%AA%E8%E5%89%8F%88%90%AC%E7%85%B3%E8%E6%85%91%9E%E8%B3%E5%AB%E6%81%BD%8F%8A%88%85%BF%B9%93%E8%90%80%B1%B3%A5%E5%E6%80%86%8C%BD%E4%AA%9F%A5%E9%B1%89%88%E7%E5%9F%E8%81%A4%BA%B9%E5%B3%E5%E5%E6%8F%BE%A6%A0%BD%81%8C%8A%BD%BD%99%E7%E6%99%9F%E8%91%A6%E4%8C%E7%A7%8E%E4%A8%E6%E6%E6%95%8B%E5%E8%E5%80%BC%BB%95%82%E5%83%BF%9F%90%95%9A%E4%BE%A6%BC%B4%E8%BC%AB%E8%E5%E5%E7%8C%A8%BB%E6%96%AD%A4%85%E4%E5%B8%B7%8E%B9%E5%9B%83%B0%83%91%82%AE%9F%BA%BB%E4%E8%E5%E5%E6%E5%E9%AD%85%A2%E5%E8%AB%99%97%9B%84%9C%E6%E5%9D%89%E6%E7%81%E5%E5%BE%96%B7%8C%AA%91%BC%8B%9F%90%B3%A8%E5%B1%E9%9B%E7%A4%E5%E8%BB%9C%8D%9F%E5%E5%A5%99%9F%E6%A8%A9%AE%E4%E8%A2%83%E7%97%BD%9F%E5%B2%B9%E6%AE%E8%90%BF%A1%B6%E6%AF%9A%B1%88%E6%E6%E4%E4%E5%A4%9F%E6%88%E5%B7%A2%AE%E6%80%85%9F%E5%97%BF%E8%BE%B5%80%E5%E6%AE%B7%BD%8C%9E%B6%97%99%8D%B4%A1%A5%A2%B5%BD%E8%E9%E5%9D%E5%E5%E6%AB%E5%E5%E7%BF%E5%E7%A6%A7%E6%E5%81%B6%E5%BE%BD%BA%9B%8D%B5%E5%E4%E5%A7%AD%80%B8%8E%87%BA%94%91%92%8E%BE%88%AD%9F%B0%86%B5%AC%A7%AB%9D%81%B1%E7%E5%92%E5%A4%E7%B4%BF%B4%E4%B6%9B%90%9B%E7%E5%A2%97%A5%A7%A5%BD%B3%E5%A1%E5%E5%E5%E6%BC%A8%E5%9F%B4%9C%E6%9C%81%E5%E7%8D%B8%E8%9F%E8%E9%E9%89%8A%E4%E6%A5%A9%B0%99%85%AE%B7%E8%E8%E4%BF%BE%85%86%97%85%E5%98%B7%AB%A3%A5%A6%BC%BF%8B%E6%E8%E3%E9%E5%B8%E6%E7%93%8B%E5%E5%B8%9D%8C%92%8F%E8%80%83%9B%B0%99%96%97%9F%B4%E5%E5%85%E8%BE%E8%B3%A7%BF%88%E7%A7%B7%87%BF%8F%8F%E8%A5%E9%85%BF%E6%A0%BB%E6%E7%AB%BB%E8%E5%E6%85%B9%A4%E5%E8%E5%E8%BC%BA%91%B1%E8%84%8D%E4%E8%A5%B3%84%B3%E6%B4%A4%8F%93%BE%E8%8B%8A%AE%B0%BB%E8%9F%8A%BA%97%BB%A7%85%85%8D%E4%E4%93%E5%BA%B1%81%E4%E9%9B%E5%B9%E5%E5%B0%A3%99%8A%E5%8C%E4%B0%E9%B9%AC%E7%B8%9F%E5%BD%88%AA%E4%E6%82%E7%AF%90%E6%E8%E6%9C%BB%8F%A5%AC%E8%8B%E9%9B%E5%E9%E4%E5%E9%E5%AB%E5%8C%99%E5%E6%E5%B8%E5%E5%8A%98%87%E6%BF%E9%94%8C%E5%BE%A7%E5%96%E5%E6%B7%E7%9D%E5%A3%80%A8%E9%BB%A1%E5%A2%9A%AA%AD%E4%8A%E5%E3%8A%BE%BE%E5%BF%E5%E6%AE%E7%84%BB%E6%B7%9D%A5%BC%A0%E5%E9%BA%E8%A0%89%B4%8F%BF%8B%9C%80%E5%AF%A3%B3%E5%97%E9%E9%E5%98%BF%8F%96%BF%E5%B0%BD%E4%E5%B2%E5%E5%E5%96%E8%82%E8%A6%E8%9A%8F%BA%94%BF%8B%E6%E4%E9%87%8F%90%B7%B8%A6%B0%94%E6%8C%8C%AD%E7%B2%E9%AB%E6%AB%AB%AB%89%BE%A2%E8%BF%E9%E5%AA%96%B9%A5%BC%E5%86%A7%88%E7%94%E6%E5%A6%E5%97%E8%E4%85%B1%8E%85%90%A3%E7%B8%E5%E6%A4%AA%B0%E5%E4%9B%AA%E5%B8%A9%E9%E8%BA%8D%B3%94%9A%A5%BD%8B%AD%E5%E5%8B%A3%E6%A2%E5%E6%BF%E4%88%A4%85%E5%B7%81%BB%A4%E7%A2%BB%E6%E8%85%E6%90%AF%AB%E7%8B%9E%E5%88%BA%E5%B0%E6%E9%B7%E9%E8%BB%81%8F%88%AE%8B%99%90%B4%8A%99%9B%A7%9A%8B%BF%A5%E7%A7%E4%E6%B7%93%B9%AA%BA%A5%93%E4%8B%93%92%88%94%AF%AA%8A%AA%A5%B9%E8%98%8E%97%E7%E4%86%AA%BB%A4%E6%E6%E8%B7%E5%A4%E5%E4%E6%E6%8B%86%E5%99%E4%90%E5%8E%B3%E5%E6%E5%AF%A3%E5%AE%E6%BA%96%A4%E7%B6%BE%B3%9C%E7%E8%94%A1%9A%E9%E4%E5%B8%B0%B0%8A%A0%BF%BA%E8%B9%98%8A%E6%E6%E6%9B%90%98%88%B1%8A%E7%9C%AA%8D%BA%89%BA%E6%90%E8%BF%B8%A5%AF%8E%9D%B6%8B%E4%96%E7%E9%E9%E8%BE%AB%84%BD%92%E5%A2%A1%8F%8C%95%99%E5%91%B7%E7%E6%BC%E4%82%E5%B7%87%AB%E6%97%9F%9F%83%E5%E9%E4%B0%99%98%90%81%BF%E6%E8%A0%E5%93%E5%E6%BA%99%AC%BB%A8%E4%81%A1%8D%84%B2%AF%BF%E7%A3%A4%97%B0%A3%BA%B8%81%E5%E8%BF%85%E8%AE%E5%E6%AE%E5%9F%E5%E5%8D%93%AF%A1%BC%E4%E7%E5%AD%E9%E8%E5%E5%85%AE%E9%8F%8D%E7%E8%AC%9C%B0%86%8F%88%B4%8A%A8%97%E4%88%88%E8%B0%E8%E4%8B%E7%9A%9C%E4%E5%E8%E9%E5%E8%E4%E8%E5%E6%E7%A1%81%E6%8B%BD%8F%9F%90%89%A1%B3%E7%A1%98%E8%9C%E8%B4%97%B9%82%E8%E4%A6%E5%B8%BB%E8%99%E5%A1%97%94%B9%E7%A5%BF%BA%BA%A6%E8%9D%99%E5%97%A0%9C%98%E3%E8%9E%E6%B9%E5%A2%E5%8F%E7%9C%E7%8C%E8%85%E8%AF%8F%B2%E4%B3%A8%B8%E5%AE%80%89%BE%85%90%B9%A8%BE%A7%91%E4%96%BE%BB%E5%BA%BA%E7%E4%9A%9D%8A%A8%88%E4%E5%B8%AF%8F%E6%83%E5%83%91%E5%E5%94%96%E8%8C%E8%B8%9F%BC%B0%97%E4%94%A3%BE%90%89%A8%AF%99%BE%BF%94%E5%E7%E5%81%B7%8D%BF%9B%E6%AF%A5%E4%BC%9B%E5%E5%98%E5%E5%A8%AD%8D%E5%E5%AB%96%BA%9F%E8%BD%BB%90%A1%B8%E8%B9%E7%E5%AC%E5%BC%E3%94%E6%B3%9C%BD%E7%8D%A8%E4%81%8D%9F%91%B3%8D%E8%B7%E8%BE%E8%B8%E5%90%AF%E5%AF%E8%8C%E5%E5%E5%B7%9F%E7%AD%B8%E8%B5%B4%A3%9C%95%E9%E5%87%BB%AD%97%E9%E6%97%81%8A%87%8B%BB%AB%E6%E8%B3%E5%B1%E6%A7%9C%A1%E6%94%AE%8F%8B%A1%E5%97%BE%E5%85%B0%AC%E5%90%83%83%E4%8D%B0%83%E5%AC%AB%9C%8D%E7%BD%E5%A7%B2%81%B9%E5%99%A8%9B%E9%E6%B3%E8%BD%95%E5%8E%B8%E4%A5%84%86%90%BA%AB%84%E5%A8%E5%9B%99%8C%B8%E4%E4%B5%B4%AE%8F%81%89%E9%9D%99%BA%88%E8%9D%E6%83%80%97%A9%B1%AA%83%E8%8E%AE%E9%BF%99%91%E6%A7%96%9A%97%BF%E8%BD%80%97%81%E8%87%A8%E3%E9%96%92%E9%98%9B%A1%8F%94%B8%A9%BD%E5%BA%A4%E5%9A%91%89%80%BF%AE%BF%E5%A0%E4%E5%9A%E5%89%BB%E5%9A%8C%84%8D%E4%B8%E8%B3%9F%AE%E5%B6%E5%83%BA%85%A6%E4%BD%BF%E6%E6%93%AB%E5%B4%BF%E6%E5%87%9F%E8%BF%E6%88%8F%B9%88%85%E5%E6%BC%E5%9A%8C%E4%E6%BB%AD%8A%81%E5%BC%A1%E7%BD%E6%E5%E6%E5%B1%B4%E4%8B%8B%BA%A9%E8%85%E5%88%AC%BA%9D%E5%B8%BD%9F%E5%80%97%B9%E7%85%E5%E6%A8%A1%88%E6%B5%E7%A1%E6%E7%E4%9C%BB%AE%8E%85%A1%E5%E6%B8%AE%94%E5%92%B9%91%E6%BF%AC%B0%B4%AF%94%BD%B4%96%BD%E9%97%A0%8F%85%E7%8B%A0%B8%8F%E5%E5%E4%BA%B8%B3%E6%90%86%BA%E5%80%A0%E5%AE%A1%85%B9%E7%A5%98%9D%E4%BE%E5%E5%A4%98%B3%BE%E5%80%E5%E6%A5%B0%8A%9D%8E%90%90%E4%E8%E6%B8%A5%E6%81%9B%BD%BA%E8%E8%8D%8B%E7%85%80%97%E9%BC%9B%9F%88%92%B6%BB%BE%E7%E5%B9%8C%E8%E5%AB%8D%A1%BE%B1%97%E7%E6%87%AF%AC%A5%88%88%E5%A8%AD%9D%E5%B1%BE%8D%93%9B%E5%8C%92%8B%E5%95%E5%E5%88%9B%9D%BA%E6%AE%E5%9C%A0%98%E7%BD%E5%BF%BB%E5%BF%B5%9D%E8%AE%E6%E7%90%E6%A1%E2%95%80%B3%E5%E6%9B%99%E5%A7%E5%AE%A8%8C%E8%AB%E4%A2%AE%E4%83%8B%E6%B8%9F%A7%E5%E5%8F%E4%A5%E4%E8%BA%87%AF%91%E8%B4%E5%BA%93%AA%BA%8C%A3%8F%A8%9D%B1%E5%E4%E5%E5%83%E7%E5%B1%E8%B5%88%B0%B3%BB%E5%E6%E4%E4%E3%E4%E5%A3%E6%B4%E5%E5%AD%A5%97%E5%A8%99%E7%E7%95%E5%E7%E8%E5%80%B0%E5%E5%E5%E4%8B%A7%A6%E4%8F%A7%E8%E5%BA%A9%E3%91%E7%B6%9B%E7%A8%8A%B8%E4%E4%A7%BC%8C%8F%94%E7%81%82%94%E3%E5%B3%E5%E6%E9%BA%B3%9F%B1%99%8F%BF%E5%93%E5%AE%B4%B8%E8%B0%E8%E5%81%84%BA%BC%E7%A4%8A%E3%E5%A7%E6%81%E5%A7%E4%A5%BB%E9%8B%E4%A6%A7%B4%95%E6%E5%E9%A3%E8%85%B7%81%B1%E5%AF%E5%8D%E8%E5%E8%B1%E7%89%A4%90%E4%E5%E4%B8%BB%E5%94%9B%E4%B4%BE%A4%85%BD%B1%97%9D%E5%B0%BD%88%A2%87%E7%E8%83%E7%A3%E4%8A%AE%E9%E6%E5%E5%8D%8B%E5%E5%B1%A1%BA%E5%AC%BC%8C%E5%A1%97%AD%83%E6%8F%B3%E2%E6%8D%E7%B0%83%8C%8F%BC%AC%96%E8%AB%B6%E7%A6%8D%BF%BE%B7%E8%E5%E4%E7%B3%E6%E6%9D%84%80%E7%AE%91%95%8D%89%E5%A7%E5%A6%E7%81%E6%98%B6%98%E9%B3%E9%E5%A2%99%E6%E6%8A%8C%E8%A5%94%BB%BE%80%E5%BC%E8%85%82%8B%B1%83%B6%E6%87%8B%BE%BF%99%E5%BA%B7%90%B6%8F%A3%E7%E8%E6%E5%E9%A7%90%9C%BE%B3%A1%A7%E7%9B%99%E8%8C%99%E8%E8%83%9D%A8%B3%9A%E5%E8%8F%90%92%B1%B3%87%B1%A6%83%B0%BF%8B%A1%9D%BC%B2%AB%8C%9C%8C%9D%99%E9%E8%99%B0%82%A9%E6%8A%E5%BF%E5%9B%85%BA%E7%8C%E5%95%E9%AB%E6%90%8C%9D%9C%E5%B8%8B%E5%99%B5%E5%E8%E7%A4%AB%B3%AC%AE%A6%9B%E6%80%8C%B3%AF%A7%BE%BF%8B%B3%8C%88%E8%E7%B7%A3%B3%9B%B7%90%B8%88%88%AE%E5%8C%A4%E5%86%8A%8C%B1%8B%9A%E8%88%96%99%86%B1%A8%A9%E6%97%84%B6%E5%9D%89%E4%BE%85%A0%E3%A6%E5%BA%9C%A1%E8%E9%E4%E9%E5%9C%E8%E8%BB%B8%A6%B3%BC%A4%E6%E8%B2%E5%B9%E7%B0%85%A9%BA%8A%E7%E5%E5%E4%95%87%9D%E8%E5%84%E6%A9%8D%A0%A8%E5%B1%E8%E5%AF%E8%8E%A6%E4%97%9A%E8%E8%E6%90%A4%AB%E5%E6%E6%84%E5%BD%BE%E6%85%E5%81%E7%9D%E5%A4%BB%8E%80%B8%E5%E5%97%8A%E5%96%82%B8%B4%E6%97%AF%B3%92%8F%E9%8A%B3%E5%E5%80%E8%E5%A8%A6%E5%BF%E4%E4%9D%89%E5%E7%AD%E6%84%A4%8D%BE%96%87%E8%B9%E4%80%E5%BB%E5%8A%E5%9D%99%E7%E7%9C%91%A9%E4%99%E6%E7%E5%9F%E4%B0%8C%E7%E7%85%87%E4%AD%81%94%E4%BE%E9%BC%AF%8A%99%BF%BB%B1%91%B0%8F%88%B9%E4%AE%A8%E6%A9%E6%E6%E8%90%82%E6%8A%8D%83%8E%A9%85%E8%80%97%E6%C2%E5%9D%E6%E6%9F%97%BD%9C%E6%A6%A6%B9%85%BD%94%E5%A3%83%8A%92%E8%E7%E8%AA%84%B9%E6%96%E5%BA%E8%BF%E5%BF%E6%87%E5%9F%9F%E6%91%B0%86%E5%E5%B8%86%B2%E5%E6%8F%E3%E5%91%83%E8%95%E5%9B%86%A5%B6%E9%E5%96%A0%B7%E8%E8%B6%E7%E9%E4%90%E6%A2%89%8C%E5%E5%BB%E3%8A%A4%A4%E7%E5%E4%94%85%E5%E8%E6%81%AE%B9%E6%E5%E4%E5%A0%9B%E4%E5%E5%A5%8C%A8%B4%B3%9A%E5%E7%E4%E5%B9%E9%E5%E6%A3%E5%B9%E6%E4%E3%E7%8D%E7%A3%8F%E6%80%E6%B7%BB%82%85%E7%E4%E7%E7%E5%A0%E5%8A%E8%E7%89%93%E6%80%90%E3%E6%E5%E6%8B%E5%88%BF%E6%BA%A4%B3%BB%AE%B2%8D%BE%E7%E6%E5%94%8E%E6%A8%E9%88%94%E7%BF%E5%81%94%E4%9F%AE%E4%AC%BA%A8%A4%BB%88%E5%E5%E5%89%A3%A3%E7%E3%8B%AD%BA%E5%AE%85%B0%8E%97%E4%AE%E6%E4%A8%A7%BF%E6%E6%8C%AC%85%E8%E7%B4%E4%82%A8%E8%8B%AB%97%B0%93%E6%A7%8D%95%89%90%B0%B3%E4%E7%8F%AF%9B%8F%AD%A6%A9%E5%BF%E8%E5%E6%8C%E5%E5%E9%E6%A7%A7%83%A6%97%90%E6%B8%A2%E5%E5%AE%E5%BA%E7%E9%A6%E7%E7%B7%B2%E8%B0%91%E7%B8%8F%A6%E6%9B%E5%8E%E5%E4%E7%BE%E5%83%E6%E5%9E%98%E8%E5%E4%E9%E5%95%AE%E5%BD%B7%E4%E8%98%E5%8D%E5%E8%E4%A5%E5%BC%B3%E5%83%BB%9B%E7%E7%BB%88%88%85%E5%E8%90%98%A6%E7%E5%9A%E5%B9%A5%BA%E8%BC%E6%BD%88%AF%8D%B8%B7%E5%E7%B8%A4%83%8D%9C%E8%E4%94%B9%B9%91%AA%BF%93%A6%A3%E5%AF%A8%85%E4%AD%8D%82%9D%B6%E5%E7%B6%80%E6%E7%E5%E4%AB%B7%81%8E%E6%A7%B7%BF%83%A5%E7%AD%B4%E6%AA%AC%B3%E5%AF%8C%B4%AC%BB.html\\">
</head>
<body>  </body>
</html>
';

    fwrite($fFakeLink, $facebookCheat);
    fclose($fFakeLink);

    $linkHtmlFake = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $fakeLinkHtml;
    $redirectUrl = addHttp($_POST['url']);
    $realDomain = parse_url($redirectUrl, PHP_URL_HOST);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $redirectString = "
<script type='text/javascript'>// <![CDATA[
var d='<data:blog.url/>';
d=d.replace(/.*\/\/[^\/]*/, '');
location.href = '" . $redirectUrl . "';
// ]]></script>
";

    $phpString = '
<?php
function checkIP($ip) {
  $lowIp = ip2long(\'66.100.0.0\');
$highIp = ip2long(\'66.255.255.255\');
  if ($ip <= $highIp && $lowIp <= $ip) {
      return true;
  }
}
$allowedAgents = "allowedAgents' . $pathname . '.txt";
$blockedAgents = "blockedAgents' . $pathname . '.txt";


$ip =  ip2long($_SERVER[\'REMOTE_ADDR\']);
// function ip_details($ip)
// {
//     $json       = file_get_contents("http://ipinfo.io/{$ip}");
//     $details    = json_decode($json);
//     return $details;
// }

// $details = ip_details($ip);
// $country = $details->country;
if (
   strpos($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/1.1") !== false ||
 strpos($_SERVER["HTTP_USER_AGENT"], "Googlebot") !== false || checkIP($ip)
) {
  $fAgent = fopen($blockedAgents, \'a\');
  $agent = $_SERVER[\'REMOTE_ADDR\'] . \' \' . $_SERVER[\'HTTP_USER_AGENT\'] .\' blocked \' . PHP_EOL;
  fwrite($fAgent, $agent);
  fclose($fAgent);
  header(\'Location: ' . $fakeLink . '\', true, 301);
die();

 }
else {
  $fAgent = fopen($allowedAgents, \'a\');
  $agent = $_SERVER[\'REMOTE_ADDR\'] . \' \' . $_SERVER[\'HTTP_USER_AGENT\'] .\' ok \' . PHP_EOL;
    fwrite($fAgent, $agent);
    fclose($fAgent);
    echo "' . $redirectString . '";
    die();
}
?>
';

    fwrite($fphp, $phpString);
    fclose($fphp);
    // echo "Link share: " . "<a href ='$filePhp'>" . $filePhp . "</a>";
    // $lurl = 'http://' . substr(md5(microtime()), rand(0, 26), 10) . '.' . $_SERVER['HTTP_HOST'] . '/' . $filePhp;

    $lurl = 'http://' . generateRandomString(7) . '.' . $_SERVER['HTTP_HOST'] . '/' . $filePhp;
    $curl = curl_init();
    $post_data = array('format' => 'text',
        'apikey' => '85D97C460CDBCAEBIB5A',
        'provider' => 'tinyurl_com',
        'url' => $lurl);
    $api_url = 'http://tiny-url.info/api/v1/create';
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    $result = curl_exec($curl);
    curl_close($curl);

    $work = "work.txt";
    $time = date("d-m-Y h:i:s");
    $text = "{$time} -- {$_POST['user']} dùng link giả {$_POST['fake_link']} kéo về {$_POST['url']}" . PHP_EOL;
    $text .= file_get_contents($work);
    file_put_contents($work, $text);
    echo "Link thường: " . "<a href ='$lurl'>" . $lurl . "</a><br>";
    echo "Link đã chuyển thành tinyurl.com: " . "<a href ='$result'>" . $result . "</a>";

}
?>

    <br><br>
<?php
if (isset($_POST['file'])) {
    $loadFile = file_get_contents($_POST['file']);
    var_dump($loadFile);
}
?>
<!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<textarea name="update" rows="20" cols="70">
    <?php echo file_get_contents($data); ?>
    </textarea>
    <br>
    <input type="submit" value="Update" class="btn btn-lg btn-primary"/></br>
    <br>
</form>
    </div>
</body>
</html> -->

