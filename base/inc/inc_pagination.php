<?php
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Caledonian PHP Calendar & Event System                                 |
# | Copyright (c) Artlantis Design Studio 2013. All rights reserved.       |
# | Version       2.2                                                      |
# | Last modified 27.02.14                                                 |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+
$pagination = '<div id="pagination-area">
<h4>'. lang_pages .':</h4>
<ul class="pagination">';
if($limit > $count){$pagination .= '<li>1</li>';}
if($count > $limit) :
 $x = 7; # Paging Page List
 $lastP = ceil($count/$limit);

 if($pgGo > 1){

 $pgPrev = $pgGo-1;

 $pagination .= '<li><a href="'. $pgVar .'">«</a></li><li><a href="'. $pgVar .'&pgGo='. $pgPrev .'">&lt;</a></li>';

 }

 # Print page 1
 if($pgGo==1) $pagination .= '<li class="active"><a href="javascript:;">1</a></li>';
 else $pagination .= '<li><a href="'. $pgVar .'">1</a></li>';
 # Print "..." or only 2
 if($pgGo-$x > 2) {
 $pagination .= '<li class="disabled"><a href="javascript:;">...</a></li>';
 $i = $pgGo-$x;
 } else {
 $i = 2;
 }
 # Print Pages
 for($i; $i<=$pgGo+$x; $i++) {
 if($i==$pgGo) $pagination .= '<li class="active"><a href="javascript:;">'. $i .'</a></li>';
 else $pagination .= '<li><a href="'. $pgVar .'&pgGo='. $i .'">'. $i .'</a></li>';
 if($i==$lastP) break;
 }
 # Print "..." or last page
 if($pgGo+$x < $lastP-1) {
 $pagination .= '<li class="disabled"><a href="javascript:;">...</a></li>';
 $pagination .= '<li><a href="'. $pgVar .'&pgGo='. $lastP .'">'. $lastP .'</a></li>';
 } elseif($pgGo+$x == $lastP-1) {
 $pagination .= '<li><a href="'. $pgVar .'&pgGo='. $lastP .'">'. $lastP .'</a></li>';
 }

 if($pgGo < $lastP){

 $pgNext = $pgGo+1;

 $pagination .= '<li><a href="'. $pgVar .'&pgGo='. $pgNext .'">&gt;</a></li><li><a href="'. $pgVar .'&pgGo='. $count .'">»</a></li>';

 }

endif;
$pagination .= '</ul></div>';
echo($pagination);
?>