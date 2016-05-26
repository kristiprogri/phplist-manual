<?php

/*
 * ePub2HTML - quick-n-dirty script to take an ePub and show it as HTML
 * used for the phpList Manual, edited on flossmanuals.org
 * 
 * v.01 - 11/11/2014 - MD initial release
 * 
 * license GPLv3 or later
 * 
 */

$headerFile = 'header.html';
$footerFile = 'footer.html';
$tocFile = 'toc.ncx';

/* ---------------------- end config -------------- */


$tocFile = simplexml_load_file(dirname(__FILE__).'/'.$tocFile);
$title = $tocFile->docTitle->text;
$toc = extractMenu($tocFile->navMap->navPoint);
$chapter = 0;
$chapterTitle = '';

$header = file_get_contents(dirname(__FILE__).'/'.$headerFile);
$footer = file_get_contents(dirname(__FILE__).'/'.$footerFile);
//$header = file_get_contents('https://raw.githubusercontent.com/phpList/epub2html/master/header.html');
//$footer = file_get_contents('https://raw.githubusercontent.com/phpList/epub2html/master/footer.html');

$file = $_SERVER['REQUEST_URI'];
$file = basename($file);
$file = str_replace('?','',$file);
if (is_file(dirname(__FILE__).'/'.$file)) {
  $contents = file_get_contents(dirname(__FILE__).'/'.$file);
  if (preg_match('/^ch(\d+)_(.*)\.xhtml$/',$file, $regs)) {
    $chapter = $regs[1];
    $chapterTitle = $regs[2];
    $chapterTitle = str_replace('-',' ',$chapterTitle);
    $chapterTitle = ucfirst($chapterTitle);
    $chapterTitle = str_ireplace('phplist','phpList',$chapterTitle);
  }
  $header .=  "<a href='/manual' class='download'><big>&rarr;</big> DONWLOAD THIS MANUAL</a><div class='clear show-on-mobile'></div>\n";

} else {
  $contents = '
  
  <h1>The phpList manual</h1>
  <div class="intro">
  <a class="book" href="ch001_system-overview.xhtml"><span class="ics read"></span><span class="book-title">Read Online</span></a>
  <a class="book" href="phpList_manual_20150522.epub"><span class="ics epub"></span><span class="book-title">Download as ePub</span></a>
  <a class="book" href="phpList_manual_pdf_20150522.pdf"><span class="ics pdf"></span><span class="book-title">Download as PDF</span></a>
  <a class="book" href="phpList_manual_20150522.odt"><span class="ics odt"></span><span class="book-title">Download in OpenDocument format</span></a>
  </div>
  ';
}
  
  
if (!empty($chapter)) {
  $title = sprintf('chapter %d - %s',$chapter,htmlspecialchars($chapterTitle));
}

$contents = str_replace('<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title/>','',$contents);

$contents = str_replace('</head><body>','',$contents);
$contents = str_replace('</body></html>','',$contents);

$contents = str_replace('/phplist/_edit/','',$contents);

$header = str_ireplace('[TITLE]',$title,$header);

print $header;
print "<nav id='menu' role='navigation'>\n";
print $toc;
print "</nav>\n";
print "<div id='content'>\n";
print $contents;
print "</div>\n";
print $footer;

function extractMenu($navPoints,$level = 1) {
  $menu = '<ul class="menu level'.$level.'">';
  foreach ($navPoints as $navPoint) {
    $menu .= '<li class="menuitem itemlevel'.$level.'">';
    $menu .=  '<a href="';
    $menu .= $navPoint->content['src'];
    $menu .= '">';
    $menu .=  $navPoint->navLabel->text;
    $menu .= '</a>';
    
    if (!empty($navPoint->navPoint)) {
      $menu .= extractMenu($navPoint->navPoint,$level++);
    }
    $menu .= '</li>';
  }
  $menu .= '</ul>';
  return $menu;
}


