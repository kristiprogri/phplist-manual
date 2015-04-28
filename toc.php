<?php

$toc = simplexml_load_file('toc.ncx');
print '<h1>'.$toc->docTitle->text.'</h1>';

function extractMenu($navPoints,$level = 1) {
  $menu = '<ul class="menu level'.$level.'">';
  print $level;
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

$menu = extractMenu($toc->navMap->navPoint);
print $menu;
