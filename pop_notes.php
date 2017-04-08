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
/* date settings */
$om = (int) ($_GET['om'] ? $_GET['om'] : date('m'));
$oy = (int)  ($_GET['oy'] ? $_GET['oy'] : date('Y'));
$od = (int)  ($_GET['od'] ? $_GET['od'] : date('n'));
if(!isset($_GET["ID"])){$ID=0;}else{$ID=intval($_GET["ID"]);}
if(!isset($_GET["pos"])){$pos=0;}else{$pos=intval($_GET["pos"]);}
$full_content_date = date("d.m.Y",strtotime($od.'.'.$om.'.'.$oy));
$pgGo = @$_GET["pgGo"];if(empty($pgGo) or !is_numeric($pgGo)) {$pgGo = 1;}
$errText = '';


# Add Note
if(isset($_POST['addNote'])){
	
	if(demo_mode){ # *** DEMO MODE *******************************************************************
		$errText = '<div class="alert alert-danger">'.lang_demo_mode_alert.'</div>';
		}else{  # *** DEMO MODE **********************************************************************
	
	if(!admin_logged){
		$errText = '<div class="alert alert-danger">'. lang_user_auth_err .'</div>';
		}
	
	if(empty($_POST['orgDate'])){$errText .='* '. lang_required_date .'<br />';}
	if(empty($_POST['orgHour'])){$errText .='* '. lang_required_hour .'<br />';}
	if(empty($_POST['title'])){$errText .='* '. lang_required_title .'<br />';}
	if(empty($_POST['notes'])){$errText .='* '. lang_required_note .'<br />';}
	$conv_date = $_POST['orgDate'] . ' ' . $_POST['orgHour'] . ':00';
	$conv_date = date("Y-m-d H:i:s",strtotime($conv_date));
	if(!validateMysqlDate(mysql_prep($conv_date),"Y-m-d H:i:s")){$errText .='* '. lang_invalid_date .' '. $conv_date .'<br />';}
	
	if($errText == ''){
		
		mysql_query("INSERT INTO ". db_table_pref ."panel_notes (UID,
														   title,
														   mynotes,
														   note_date,
														   note_icon,
														   ip_address
												 ) VALUES (". admin_ID .",
												 		   '". mysql_prep($_POST['title']) ."',
														   '". mysql_prep2($_POST['notes']) ."',
														   '". mysql_prep($conv_date) ."',
														   ". intval($_POST['note_icon']) .",
														   '". $_SERVER['REMOTE_ADDR'] ."'
														   )") or die(mysql_error());
		$errText = '<div class="alert alert-success"><strong>'. mysql_prep($_POST['title']) .'</strong><br />'. lang_success_record .'</div>';
		$_POST = array();
		
		
		}
	else {
		$errText = '<div class="alert alert-danger">'. $errText .'</div>';
		}
	
	}}
	
# ** Edit Note
if(isset($_POST['editNote'])){
	
	$errText = '';
	
	if(demo_mode){ # *** DEMO MODE *******************************************************************
		$errText = '<div class="alert alert-danger">'.lang_demo_mode_alert.'</div>';
		}else{  # *** DEMO MODE **********************************************************************
		
	if(!admin_logged){
		$errText = '<div class="alert alert-danger">'. lang_user_auth_err .'</div>';
		}
	
	if(isset($_POST['sil'])){
		if($errText==''){
			mysql_query("DELETE FROM ". db_table_pref ."panel_notes WHERE ID=". $ID ."") or die(mysql_error());
			$pos=0;
		}
		}
	else{
	
	if(!isset($_POST['orgDate']) || empty($_POST['orgDate'])){$errText .='* '. lang_required_date .'<br />';}
	if(!isset($_POST['orgHour']) || empty($_POST['orgHour'])){$errText .='* '. lang_required_hour .'<br />';}
	if(!isset($_POST['title']) || empty($_POST['title'])){$errText .='* '. lang_required_title .'<br />';}
	if(!isset($_POST['notes']) || empty($_POST['notes'])){$errText .='* '. lang_required_note .'<br />';}
	$conv_date = $_POST['orgDate'] . ' ' . $_POST['orgHour'] . ':00';
	$conv_date = date("Y-m-d H:i:s",strtotime($conv_date));
	if(!validateMysqlDate(mysql_prep($conv_date),"Y-m-d H:i:s")){$errText .='* '. lang_invalid_date .' '. $conv_date .'<br />';}
	
	if($errText == ''){
		
		mysql_query("UPDATE ". db_table_pref ."panel_notes SET title='". mysql_prep($_POST['title']) ."',
														   mynotes='". mysql_prep2($_POST['notes']) ."',
														   note_date='". mysql_prep($conv_date) ."',
														   note_icon=". intval($_POST['note_icon']) ."
												WHERE
														   ID=". $ID ."
												") or die(mysql_error());
		$errText = '<div class="alert alert-success"><strong>'. mysql_prep($_POST['title']) .'</strong><br />'. lang_success_update .'</div>';
		$_POST = array();
		
		
		}
	else {
		$errText = '<div class="alert alert-danger">'. $errText .'</div>';
		}
	}
	
	}}
?>
<!doctype html>
<html>
<head>
<?php include_once('inc/head.php');?>

<!-- Date Picker -->
<link rel="stylesheet" type="text/css" href="css/jquery.datepick.css"> 
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.8.23/themes/south-street/jquery-ui.css"> 
<script type="text/javascript" src="Scripts/datepicker/jquery.datepick.js"></script>
<script type="text/javascript" src="Scripts/datepicker/jquery.datepick-<?php echo($caLang);?>.js"></script>

<!-- tinyMCE -->
<script>
var customMCEchar = '<?php echo($caLang);?>';
var customMCEHeight = '';
var customMCEWidth = '';
var customButCMS = false;

// Organiser Icons
$(document).ready(function(){
	$(".org-icons").hide();
	$(".show-org-icons").show();
	$(".hide-org-icons").hide();
	
	// Open
	$(".show-org-icons").click(function () {
		$(".org-icons").slideDown('fast');
		$(".show-org-icons").hide();
		$(".hide-org-icons").show();
	});
	// Close
	$(".hide-org-icons").click(function () {
		$(".org-icons").slideUp('fast');
		$(".hide-org-icons").hide();
		$(".show-org-icons").show();
	});
});
</script>
<script src="Scripts/tinymce/tinymce.min.js"></script>
<script src="Scripts/tinymce/tinymce_custom.js"></script>
<!-- tinyMCE -->
<style>
html,body{background-image:none;}
</style>
</head>

<body id="pop">

<div class="panel panel-primary cst-panel-master">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo(lang_notes);?></div>
  <div class="panel-body">
<!-- START PANEL -->

<?php if($pos==0){?>
<div id="top-pager"></div> 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-hover">
<thead>
                <tr>
                  <th width="124" height="25"><?php echo(lang_hour);?></th>
                  <th width="67" align="center">&nbsp;</th>
                  <th width="1187" height="25"><?php echo(lang_title);?></th>
                </tr>
</thead>
<tbody>
<?php

$srcQuery = "&amp;od=". $od ."&amp;om=". $om ."&amp;oy=". $oy ."";
$addQuery = " DATE_FORMAT(note_date, '%Y-%m-%d')='". date("Y-m-d",strtotime($full_content_date)) ."'";
$sortQuery = " ORDER BY note_date DESC";
$sortList = "";

 $limit = 25;
 $count		 = mysql_num_rows(mysql_query("SELECT ID FROM ". db_table_pref ."panel_notes where $addQuery"));
 $toplamsayfa	 = ceil($count / $limit);
 $baslangic	 = ($pgGo-1)*$limit;
				
				
		  $getRs = mysql_query("select ID,UID,title,note_date,note_icon from ". db_table_pref ."panel_notes where $addQuery $sortQuery LIMIT $baslangic,$limit");
		  while ($rs = mysql_fetch_assoc($getRs)){
?>
                <tr>
                  <td height="30" class="org-list-h-cell"><?php echo(date('H:i',strtotime($rs['note_date'])));?></td>
                  <td align="center" class="org-list-line-cell"><div class="org-icons<?php echo($rs['note_icon']);?>"></div></td>
                  <td height="25" class="org-list-line-cell"><a href="<?php echo('?pos=2&amp;od='. $od .'&amp;om='. $om .'&amp;oy='. $oy .'&amp;ID='. $rs['ID'] .'');?>"><?php echo($rs['title']);?></a></td>
                </tr>
                      <?php 
				}?>
                <tr class="non-striped-cell">
                  <td colspan="3" class="pages"><?php $pgVar='?pos='.$pos.$srcQuery.$sortList.'';include("inc/inc_pagination.php");?></td>
                  </tr>
</tbody>
              </table>
<?php }elseif($pos==1){
	
		if(!isset($_POST['orgDate'])){
			$_POST['orgDate'] = str_replace('.','-',$full_content_date);
			}
			
if(!admin_logged){
	$errText = '<div class="alert alert-danger">'. lang_user_auth_err .'</div>';
	echo($errText);
}else{
	echo($errText);
	
	?>
<form name="form1" method="post" action="" role="form">
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td width="20%" height="25"><strong><?php echo(lang_date);?></strong></td>
                    <td width="2%" height="25"><strong>:</strong></td>
                    <td width="78%" height="25"><input class="form-control cst-input-normal" name="orgDate" id="orgDate" type="text" value="<?php echo(mysql_prep($_POST['orgDate']));?>" required /><script>$(document).ready(function(){$('#orgDate').datepick({dateFormat: 'dd-mm-yyyy'});});</script></td>
                  </tr>
                  <tr>
                    <td height="25"><strong><?php echo(lang_hour);?></strong></td>
                    <td height="25"><strong>:</strong></td>
                    <td height="25">
                    <select name="orgHour" id="orgHour" class="form-control cst-input-normal">
<?php
$start=strtotime('00:00');
$end=strtotime('23:30');
for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+30*60) {
    printf('<option value="%s"'. formSelector(@$_POST['orgHour'],date('H:i',$halfhour),0) .'>%s</option>',date('H:i',$halfhour),date('H:i',$halfhour));
}
?>
                    </select></td>
                  </tr>
                  <tr>
                    <td height="25"><strong><?php echo(lang_title);?></strong></td>
                    <td height="25"><strong>:</strong></td>
                    <td height="25"><input name="title" class="form-control cst-input-normal" type="text" id="title" value="<?php echo(mysql_prep(@$_POST['title']));?>" size="40"></td>
                  </tr>
                  <tr>
                    <td height="25"><strong><?php echo(lang_icon);?></strong></td>
                    <td height="25"><strong>:</strong></td>
                    <td height="25">
                    <div id="org-icon-opener">
                    	<div class="show-org-icons"><span><?php echo(lang_show);?></span></div>
                        <div class="hide-org-icons"><span><?php echo(lang_hide);?></span></div>
                    </div>
                    <div class="org-icons">
                    <ul>
                    <?php for($i=0;$i<=38;$i++){?>
                    	<li><input type="radio" value="<?php echo($i);?>" name="note_icon" id="org_icon<?php echo($i);?>"<?php echo(formSelector($i,intval(@$_POST['note_icon']),1));?>> <div class="org-icons<?php echo($i);?>"></div></li>
                    <?php }?>
                    </ul><div class="clr"></div>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="25" valign="top"><strong><?php echo(lang_note);?></strong></td>
                    <td height="25" valign="top"><strong>:</strong></td>
                    <td height="25"><textarea name="notes" id="notes" class="mceEditor form-control cst-input-normal"><?php echo(@$_POST['notes']);?></textarea></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                    <td height="25">&nbsp;</td>
                    <td height="25">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                    <td height="25">&nbsp;</td>
                    <td height="25"><button name="addNote" id="addNote" value="addNote" type="submit" class="btn btn-primary"><?php echo(lang_add);?> <span class="glyphicon glyphicon-plus"></span></button></td>
                  </tr>
                </table>
              </form>
<?php }}elseif($pos==2){
	$getNote = mysql_query("SELECT * FROM ". db_table_pref ."panel_notes WHERE ID=". $ID ."") or die(mysql_error());
		  if(mysql_num_rows($getNote)==0){echo('<div class="alert alert-danger">'. lang_no_record_found .'</div>');}else{
		  $rs = mysql_fetch_assoc($getNote);
	?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td><h2><?php echo($rs['title']);?></h2><?php echo($rs['mynotes']);?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong><?php echo(lang_date);?>:</strong> <?php echo(setMyDate($rs['add_date'],6));?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <?php if(admin_logged){?>
                <tr>
                  <td><button type="button" name="EditBut" value="EditBut" data-href="<?php echo('?pos=3&amp;od='. $od .'&amp;om='. $om .'&amp;oy='. $oy .'&amp;ID='. $rs['ID'] .'');?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> <?php echo(lang_update);?></button></td>
                </tr>
                <?php }?>
    </table>

<?php }?>
<?php }elseif($pos==3){
	
$getNote = mysql_query("SELECT * FROM ". db_table_pref ."panel_notes WHERE ID=". $ID ."") or die(mysql_error());
if(mysql_num_rows($getNote)==0){echo('<div class="alert alert-danger">'. lang_no_record_found .'</div>');}else{
		  $rs = mysql_fetch_assoc($getNote);

if(!admin_logged){
	$errText = '<div class="alert alert-danger">'. lang_user_auth_err .'</div>';
	echo($errText);
}else{
	echo($errText);
	?>
<form name="form1" method="post" action="" role="form">
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td width="20%" height="25"><strong><?php echo(lang_date);?></strong></td>
                    <td width="2%" height="25"><strong>:</strong></td>
                    <td width="78%" height="25"><input class="form-control cst-input-normal" name="orgDate" id="orgDate" type="text" value="<?php echo(mysql_prep(date("d-m-Y",strtotime($rs['note_date']))));?>" required /><script>$(document).ready(function(){$('#orgDate').datepick({dateFormat: 'dd-mm-yyyy'});});</script></td>
                  </tr>
                  <tr>
                    <td height="25"><strong><?php echo(lang_hour);?></strong></td>
                    <td height="25"><strong>:</strong></td>
                    <td height="25">
                    <select name="orgHour" id="orgHour" class="form-control cst-input-normal">
<?php
$start=strtotime('00:00');
$end=strtotime('23:30');
for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+30*60) {
    printf('<option value="%s"'. formSelector(date('H:i',strtotime($rs['note_date'])),date('H:i',$halfhour),0) .'>%s</option>',date('H:i',$halfhour),date('H:i',$halfhour));
}
?>
                    </select></td>
                  </tr>
                  <tr>
                    <td height="25"><strong><?php echo(lang_title);?></strong></td>
                    <td height="25"><strong>:</strong></td>
                    <td height="25"><input name="title" type="text" class="form-control cst-input-normal" id="title" value="<?php echo(mysql_prep($rs['title']));?>" size="40"></td>
                  </tr>
                  <tr>
                    <td height="25"><strong><?php echo(lang_icon);?></strong></td>
                    <td height="25"><strong>:</strong></td>
                    <td height="25">
                    <div id="org-icon-opener">
                    	<div class="show-org-icons"><span><?php echo(lang_show);?></span></div>
                        <div class="hide-org-icons"><span><?php echo(lang_hide);?></span></div>
                    </div>
                    <div class="org-icons">
                    <ul>
                    <?php for($i=0;$i<=38;$i++){?>
                    	<li><input type="radio" value="<?php echo($i);?>" name="note_icon" id="org_icon<?php echo($i);?>"<?php echo(formSelector($i,intval($rs['note_icon']),1));?>> <div class="org-icons<?php echo($i);?>"></div></li>
                    <?php }?>
                    </ul><div class="clr"></div>
                    </div></td>
                  </tr>
                  <tr>
                    <td height="25" valign="top"><strong><?php echo(lang_note);?></strong></td>
                    <td height="25" valign="top"><strong>:</strong></td>
                    <td height="25"><textarea name="notes" id="notes" class="mceEditor"><?php echo($rs['mynotes']);?></textarea></td>
                  </tr>
                  <tr>
                    <td height="25"><strong><?php echo(lang_delete);?></strong></td>
                    <td height="25"><strong>:</strong></td>
                    <td height="25"><input name="sil" type="checkbox" id="sil" value="YES" onClick="return confirm('<?php echo(lang_are_you_sure_to_delete_this_entry);?>')"></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                    <td height="25">&nbsp;</td>
                    <td height="25">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                    <td height="25">&nbsp;</td>
                    <td height="25"><button type="submit" name="editNote" value="editNote" class="btn btn-primary"><?php echo(lang_update);?> <span class="glyphicon glyphicon-refresh"></span></button></td>
                  </tr>
                </table>

              </form>
<?php }}}?>

<!-- END PANEL -->
</div>
</div>


</body>
</html>
