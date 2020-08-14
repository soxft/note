<?php
$conn = new mysqli("localhost","USERNAME","PASSWD","DBNAME");

define("TITLE",'星辰笔记');

function randStr($num)
{
  $str = '';
  $strAll = "q1234ty78iSDFGHQWERTYULZ59werNMXCVBopasdfIOPJKghjklzxcvbnmu6A0";
  for ($i = 0; $i <= $num - 1; $i++) {
    $rand = rand(0, strlen($strAll) - 1);
    $str .= $strAll[$rand];
  }
  return $str;
}