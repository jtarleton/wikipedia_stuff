<?php 
require_once('./httpful.phar');

// Get GitHub Profile for nategood as XML
$uri = 'http://en.wikipedia.org/wiki/Special:Random';
 
$response = \Httpful\Request::get($uri)->followRedirects()  // Will parse based on Content-Type
//    ->expectsXml()              // from the response, but can specify
    ->send();                   // how to parse via expectsXml too.

$html = $response->body;
$title = strstr($html, '<title>');
$title = str_replace(' - Wikipedia, the free encyclopedia','',str_replace('<title>', '', strstr($title, '</title>', true)));
//<link rel="canonical" href="http://en.wikipedia.org/wiki/Matzo_Ball" />

$needle = '<link rel="canonical" href="';
$link = strstr($html, $needle);
//$href=strstr($link, '" />', true); //   '<a href="'.$href.'">'.$title.'</a>'
$href=str_replace('<link rel="canonical" href="', '', strstr($link, '" />', true));
$arr=array($title => '<a href="'.$href.'">'.$title.'</a>');

print_r($arr);