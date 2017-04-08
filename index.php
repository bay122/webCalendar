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

if(demo_mode){
	if(!isset($_GET['month'])){$_GET['month']=11;}
	if(!isset($_GET['year'])){$_GET['year']=2013;}
	}else{
	if(!isset($_GET['month'])){$_GET['month']=date('m');}
	if(!isset($_GET['year'])){$_GET['year']=date('Y');}
		}

$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));
$getMonthName = unserialize(lang_months);
?>
<!doctype html>
<html>
<head>
<?php include_once('inc/head.php');?>
</head>

<body>
<h1 id="main-head">Caledonian</h1>

<div id="main-container">
<div id="head-control"><a href="?month=<?php echo(($month != 1 ? $month - 1 : 12).'&amp;year='.($month != 1 ? $year : $year - 1));?>"><span class="glyphicon glyphicon-chevron-left"></span></a> <h1><?php echo($getMonthName[$month]);?></h1> <a href="?month=<?php echo(($month != 12 ? $month + 1 : 1).'&amp;year='.($month != 12 ? $year : $year + 1));?>"><span class="glyphicon glyphicon-chevron-right"></span></a></div>
<div id="control-area">
<?php
/* select month control */
$select_month_control = '<select name="month" id="month" class="form-control cst-input-normal">';
for($x = 1; $x <= 12; $x++) {
	$select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.$getMonthName[$x].'</option>';
}
$select_month_control.= '</select> ';

/* select year control */
$year_range = 7;
$select_year_control = '<select name="year" id="year" class="form-control cst-input-normal">';
for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
	$select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
}
$select_year_control.= '</select>';

/* bringing the controls together */
if(!isset($previous_month_link)){$previous_month_link=null;}
if(!isset($next_month_link)){$next_month_link=null;}
$controls = '<form method="get" role="form" class="form-inline">'.$select_month_control.$select_year_control.' <button type="submit" name="submit" class="btn btn-warning" value="'. lang_show .'"><span class="glyphicon glyphicon-time"></span> '. lang_show .'</button>      '.$previous_month_link.'     '.$next_month_link.' </form>';

echo $controls;
?>
</div>
<?php echo(draw_calendar($month,$year));?>
    
</div>

<!-- TEST CONTROLS -->
<div id="user-contr"><a href="#inline" data-toggle="tooltip" data-placement="right" title="<?php echo(lang_auth_control);?>" data-fancybox-cnt="external-nav" data-fancybox-width="300" data-fancybox-height="100" class="fancybox"><span class="glyphicon glyphicon-asterisk user-mode-<?php if(!admin_logged){echo('0');}else{echo('1');}?>"></span></a></div>
<div id="mini-cal"><a href="#inline" data-toggle="tooltip" data-placement="right" title="<?php echo(lang_mini_calendar);?>" data-fancybox-cnt="external-cal" data-fancybox-width="300" data-fancybox-height="300" class="fancybox"><span class="glyphicon glyphicon-calendar"></span></a></div>
<div id="upcoming-events"><a href="#inline" data-toggle="tooltip" data-placement="right" title="<?php echo(lang_upcoming_events);?>" data-fancybox-cnt="upcoming-event-demo" data-fancybox-width="400" data-fancybox-height="400" class="fancybox"><span class="glyphicon glyphicon-time"></span></a></div>
<div id="today-events">
	<?php 
	$todays_date = date("Y-m-d",strtotime("2014-2-11")); # This Line Set For Demo, Please Change Date area to date("Y-m-d")
	if(checkOrgNotes($todays_date)){?>
	<a href="pop_notes.php?pos=0&oy=<?php echo(date("Y",strtotime($todays_date)));?>&om=<?php echo(date("n",strtotime($todays_date)));?>&od=<?php echo(date("d",strtotime($todays_date)));?>" data-toggle="tooltip" data-placement="right" title="<?php echo(lang_todays_events);?>" data-fancybox-type="iframe" data-fancybox-width="600" data-fancybox-height="400" class="fancybox has-activity"><span class="glyphicon glyphicon-eye-open"></span></a>
    <?php }else{ # There no activity?>
    <a href="pop_notes.php?pos=0&oy=<?php echo(date("Y",strtotime($todays_date)));?>&om=<?php echo(date("n",strtotime($todays_date)));?>&od=<?php echo(date("d",strtotime($todays_date)));?>" data-toggle="tooltip" data-placement="right" title="<?php echo(lang_todays_events);?>" data-fancybox-type="iframe" data-fancybox-width="600" data-fancybox-height="400" class="fancybox"><span class="glyphicon glyphicon-eye-close"></span></a>
	<?php }?>
</div>
<div id="lang-contr"><a href="javascript:;" class="lang-toggle" data-toggle="tooltip" data-placement="right" title="<?php echo(lang_language);?>"><span class="glyphicon glyphicon-globe"></span></a>
	<div id="lang-box">
    	<a href="switch_lang.php?l=en"><img src="images/flags/en.png" alt="English"></a>
        <a href="switch_lang.php?l=es"><img src="images/flags/es.png" alt="Español"></a>
        <a href="switch_lang.php?l=tr"><img src="images/flags/tr.png" alt="Türkçe"></a>
    </div>
</div>
<div id="external-nav">
<?php if(!admin_logged){
						echo('<span class="glyphicon glyphicon-asterisk user-mode-0"></span> <strong>'. lang_user_offline .'</strong><br><br><button type="button" onclick="parent.location.href=\'switch_user.php?p=1\';" class="btn btn-success">'. lang_simulate_admin .'</button>');}
				   else{
					   	echo('<span class="glyphicon glyphicon-asterisk user-mode-1"></span> <strong>'. lang_user_online .'</strong><br><br><button type="button" onclick="parent.location.href=\'switch_user.php?p=0\';" class="btn btn-danger">'. lang_logout .'</button>');
						}?>
</div>
<div id="external-cal">
<?php echo(draw_calendar_mini($month,$year));?>
</div>

<div id="upcoming-event-demo">
<h1><?php echo(lang_upcoming_events);?></h1>
<?php
$get_today = date("Y-m-d",strtotime("2014-2-11")); # This Line Set For Demo, Please Change It to date("Y-m-d");
$opEvents = mysql_query("SELECT ID,title,note_date FROM ". db_table_pref ."panel_notes WHERE note_date >= '". $get_today ."' ORDER BY note_date ASC LIMIT 0,10") or die(mysql_error());

    if(mysql_num_rows($opEvents)==0){echo('<div class="alert alert-info">'. lang_no_record_found .'</div>');}else{

        while($opEventsRs = mysql_fetch_assoc($opEvents)){
            $eventDT2 = strtotime($opEventsRs['note_date']);
            echo('<div class="up-events"><a href="pop_notes.php?pos=2&oy='. date('Y',$eventDT2) .'&om='. date('m',$eventDT2) .'&od='. date('d',$eventDT2) .'&ID='. $opEventsRs['ID'] .'" class="fancybox2" data-fancybox-type="iframe" data-fancybox-title="'. $opEventsRs['title'] .'" data-fancybox-width="600" data-fancybox-height="500"><span>'. date("d.m.Y",$eventDT2) . ' ' . date("H:i",$eventDT2) . '</span> ' . $opEventsRs['title'] .'</a></div>');
        }

    }
?>
</div>
<!-- TEST CONTROLS -->

</body>
</html>

