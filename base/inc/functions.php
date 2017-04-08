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


function draw_calendar($month,$year){

	/* draw table */
	$calendar = '<table cellspacing="1" cellpadding="1" class="calendar">';

	/* table headings */
	$headings = unserialize(lang_weekdays);
	$calendar.= '<tr class="calendar-row calendar-head-area"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if($list_day==date("d")){$calendar.= '<td class="calendar-day calendar-today">';}else{$calendar.= '<td class="calendar-day">';}
			/* add in the day number */
			$calendar.= '<ul class="rowli">';
			if(checkOrgNotes(date("Y-m-d",strtotime($year.'-'.$month.'-'.$list_day)))){$calendar.= '<li class="colz-md-1"><a href="pop_notes.php?pos=0&amp;oy='. $year .'&amp;om='. $month .'&amp;od='. $list_day .'" class="calendar-alerts glyphicon glyphicon-calendar fancybox2" data-fancybox-type="iframe" data-fancybox-title="'. lang_notes .'" data-fancybox-width="600" data-fancybox-height="500"></a></li>';}else{$calendar.= '<li class="colz-md-1">&nbsp;</li>';}
			$calendar.= '<li class="colz-md-2"><div class="day-number">'.$list_day.'</div><li>';
			if(admin_logged){
				$calendar.= '<li class="colz-md-3"><a href="pop_notes.php?pos=1&amp;oy='. $year .'&amp;om='. $month .'&amp;od='. $list_day .'" class="calendar-add fancybox2" data-fancybox-type="iframe" data-fancybox-title="'. lang_add_new_note .'" data-fancybox-width="700" data-fancybox-height="600"></a></li>';
			}else{
				$calendar.= '<li class="colz-md-3">&nbsp;</li>';
				}
			$calendar.= '</ul><div class="clr"></div>';
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

# ** Mini Calendar ******************************************
function draw_calendar_mini($month,$year){

	/* draw table */
	$calendar = '<table cellspacing="1" cellpadding="1" class="calendar-mini">';

	/* table headings */
	$headings = unserialize(lang_weekdays_min);
	$calendar.= '<tr class="calendar-row calendar-head-area"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if($list_day==date("d")){$calendar.= '<td class="calendar-day calendar-today">';}else{$calendar.= '<td class="calendar-day">';}
			/* add in the day number */
			if(checkOrgNotes(date("Y-m-d",strtotime($year.'-'.$month.'-'.$list_day)))){$addArrow=' calendar-mini-pop'; $pop_details='data-fancy-href="pop_notes.php?pos=0&amp;oy='. $year .'&amp;om='. $month .'&amp;od='. $list_day .'"';}else{$addArrow='';$pop_details='';}
			$calendar.= '<li class="colz-md-2"><div '. $pop_details .' class="day-number'. $addArrow .'">'.$list_day.'</div><li>';
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

# ** Organiser
function checkOrgNotes($v){
	$opOrg = mysqli_query($GLOBALS['connection'], "SELECT ID,UID,note_date FROM ". db_table_pref ."panel_notes WHERE DATE_FORMAT(note_date, '%Y-%m-%d')='". $v ."'") or die(mysqli_error());
	$opOrgRes = mysqli_num_rows($opOrg);
	mysqli_free_result($opOrg);
	if($opOrgRes==0){return false;}else{return true;}
	}
	
# ** Selectbox and Checkbox Marker
function formSelector($f1,$f2,$ty){
	# f1 - First Option
	# f2 - Second Option
	# ty - Form Type (0=Selectbox, 1=Checkbox, 2=Radio)
	if($ty==0){$cc = ' selected';}elseif($ty==1){$cc = ' checked';}elseif($ty==2){$cc = ' checked';}
	if($f1==$f2){return $cc;} else {return '';}
	}
	
# ** Default Recording Filter
function mysqli_prep( $value ) {
	$value = str_replace('<','&lt;',$value);
	$value = str_replace('>','&gt;',$value);
	$value = str_replace("'",'&#39;',$value);
	$value = str_replace('"','&quot;',$value);
	$value = str_replace('<!--','&lt;!--',$value);
	$value = str_replace("where","&#119here",$value);
	$value = str_replace("drop","&#100rop",$value);
	$value = str_replace("select","&#115elect",$value);
	$value = str_replace("union","&#117nion",$value);
	$value = str_replace("like","&#108ike",$value);
	$value = str_replace("update","&#117pdate",$value);
	$value = str_replace("delete","&#100elete",$value);
	$value = str_replace("insert","&#105nsert",$value);
	$value = str_replace("show","&#115how",$value);
	$value = str_replace("alter","&#97lter",$value);
	$value = str_replace("script","&#115cript",$value);
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists( "mysqli_real_escape_string" ); // i.e. PHP >= v4.3.0
	if( $new_enough_php ) { // PHP v4.3.0 or higher
	// undo any magic quote effects so mysqli_real_escape_string can do the work
	if( $magic_quotes_active ) { $value = stripslashes( $value ); }
	$value = mysqli_real_escape_string( $value );
	} else { // before PHP v4.3.0
	// if magic quotes aren't already on then add slashes manually
	if( !$magic_quotes_active ) { $value = addslashes( $value ); }
	// if magic quotes are active, then the slashes already exist
	}
	return $value;
}

# ** HTML Recording Filter
function mysqli_prep2( $value ) {
	$value = str_replace("'",'&#39;',$value);
	$value = str_replace("where","&#119here",$value);
	$value = str_replace("drop","&#100rop",$value);
	$value = str_replace("select","&#115elect",$value);
	$value = str_replace("union","&#117nion",$value);
	$value = str_replace("like","&#108ike",$value);
	$value = str_replace("update","&#117pdate",$value);
	$value = str_replace("delete","&#100elete",$value);
	$value = str_replace("insert","&#105nsert",$value);
	$value = str_replace("show","&#115how",$value);
	$value = str_replace("alter","&#97lter",$value);
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists( "mysqli_real_escape_string" ); // i.e. PHP >= v4.3.0
	if( $new_enough_php ) { // PHP v4.3.0 or higher
	// undo any magic quote effects so mysqli_real_escape_string can do the work
	if( $magic_quotes_active ) { $value = stripslashes( $value ); }
	$value = mysqli_real_escape_string( $value );
	} else { // before PHP v4.3.0
	// if magic quotes aren't already on then add slashes manually
	if( !$magic_quotes_active ) { $value = addslashes( $value ); }
	// if magic quotes are active, then the slashes already exist
	}
	return $value;
}

# ** Date / Time Optimization
function setMyDate($tarih,$bicim){
	
	$myDate = date_create($tarih);
	
	# 1 - 2012-03-24 17:45:12
	# 2 - 24/03/2012 17:45:12
	# 3 - 24/03/12
	# 4 - 5:45pm on Saturday 24th March 2012
	# 5 - 24.03.2012
	# 6 - 24.03.2012 17:45:12
	# 7 - 09 March 2012 Sat
	# 8 - October 23, 2013, 12:43 am
	
	if($bicim==1){return date_format($myDate, 'Y-m-d H:i:s');}
	if($bicim==2){return date_format($myDate, 'd/m/Y H:i:s');}
	if($bicim==3){return date_format($myDate, 'd/m/Y');}
	if($bicim==4){return date_format($myDate, 'g:ia \o\n l jS F Y');}
	if($bicim==5){return date_format($myDate, 'd.m.Y');}
	if($bicim==6){return date_format($myDate, 'd.m.Y H:i:s');}
	if($bicim==7){
		
		$strToTimeDate = strtotime($tarih);
		return date("d",$strToTimeDate) . ' ' . dateLang(date("m",$strToTimeDate),2,1) . ' ' . date("Y",$strToTimeDate) . ' ' . dateLang(date("N",$strToTimeDate),1,1);
		
		}
	if($bicim==8){
		
		$strToTimeDate = strtotime($tarih);
		return dateLang(date("m",$strToTimeDate),2,1) . ' ' . date("d",$strToTimeDate) . ', ' . date("Y",$strToTimeDate) . ', ' . date("g:i a",$strToTimeDate);
		
		}
	
	}
	
# ** Check Date Format
	
function validateMysqlDate( $date ){ 
    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date, $matches)) { 
        if (checkdate($matches[2], $matches[3], $matches[1])) { 
            return true; 
        } 
    } 
    return false; 
} 

# Check Date Format for Forms
function validate_Date($mydate,$format = 'DD-MM-YYYY') {

    if ($format == 'YYYY-MM-DD') list($year, $month, $day) = explode('-', $mydate);
    if ($format == 'YYYY/MM/DD') list($year, $month, $day) = explode('/', $mydate);
    if ($format == 'YYYY.MM.DD') list($year, $month, $day) = explode('.', $mydate);

    if ($format == 'DD-MM-YYYY') list($day, $month, $year) = explode('-', $mydate);
    if ($format == 'DD/MM/YYYY') list($day, $month, $year) = explode('/', $mydate);
    if ($format == 'DD.MM.YYYY') list($day, $month, $year) = explode('.', $mydate);

    if ($format == 'MM-DD-YYYY') list($month, $day, $year) = explode('-', $mydate);
    if ($format == 'MM/DD/YYYY') list($month, $day, $year) = explode('/', $mydate);
    if ($format == 'MM.DD.YYYY') list($month, $day, $year) = explode('.', $mydate);       

    if (is_numeric($year) && is_numeric($month) && is_numeric($day))
        return checkdate($month,$day,$year);
    return false;           
}  
?>