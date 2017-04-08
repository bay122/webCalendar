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
include_once('inc/config.php');
if(!isset($_GET['p'])){$p=0;}else{$p=intval($_GET['p']);}
setcookie("userLog", $p, time() + (10 * 365 * 24 * 60 * 60),"/");
header('Location: index.php');
?>