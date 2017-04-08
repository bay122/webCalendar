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
if(!isset($_GET['l'])){$l='en';}else{$l=trim($_GET['l']);}
if($l != 'en' && $l != 'es' && $l != 'tr'){$l='en';} # This is a basic querystring control, if you wanna add more language you can use Array system.
setcookie("caLang", $l, time() + (10 * 365 * 24 * 60 * 60),"/");
header('Location: index.php');
?>