<?php
if (!isset($_SESSION))
session_start();

if(isset($_GET['lang']))
{
$lang = $_GET['lang'];

$_SESSION['lang'] = $lang;

setcookie("lang", $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
$lang = $_COOKIE['lang'];
}
else
{
$lang = 'en';
}

switch ($lang) {
  case 'en':
  $lang_file = 'lang.en.php';
  break;

  case 'ro':
  $lang_file = 'lang.ro.php';
  break;

  case 'es':
  $lang_file = 'lang.es.php';
  break;

  case 'de':
  $lang_file = 'lang.de.php';
  break;
  
  default:
  $lang_file = 'lang.en.php';

}

include_once 'languages/'.$lang_file;
?>