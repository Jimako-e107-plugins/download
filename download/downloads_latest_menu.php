<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * jm_download menu file.
 *
 */


if (!defined('e107_INIT')) { exit; }

$text = "";
e107::lan("download_extended");

$template = e107::getTemplate('download', 'latest_menu'); 

 

/* CAPTION FROM MENU SETTINGS */
$menu_caption = $parm;
/*
if(isset($parm['menuCaption'])){ 
    if(isset($parm['menuCaption'][e_LANGUAGE]))
    {
    	$menu_caption = $parm['menuCaption'][e_LANGUAGE];
    }
    else $menu_caption = $parm['menuCaption']; 
}
*/
 
$vars = array('MENU_CAPTION' => $menu_caption);
 
$caption  = e107::getParser()->simpleParse($template['caption'], $vars , false);
 
/* ITEM LIMIT FROM MENU SETTINGS */
$menu_limit = 5;
if(isset($parm['menuLimit']))
{
	$menu_limit = $parm['menuLimit'];
}
$limit = $menu_limit;


/* TABLERENDER FROM MENU SETTINGS */
$menu_tablestyle = 0;
if(isset($parm['menuTableStyle']))
{
	$menu_tablestyle = $parm['menuTableStyle'];
}

/* for now */
 
$qry = " AND find_in_set(download_visible,'" . USERCLASS_LIST . "')  ";

$qry = "SELECT d.*,
            dc.download_category_name, dc.download_category_id, dc.download_category_sef
			FROM #download AS d
			LEFT JOIN #download_category AS dc ON d.download_category=dc.download_category_id
			WHERE 
			d.download_active > '0' " . $qry . "
			ORDER BY download_datestamp DESC LIMIT 0," . intval($limit) . " ";

$downloads = e107::getDB()->retrieve($qry, true);
 

$listArray = $downloads;
 
$start    =  $tp->parseTemplate($template[$sectiontemplate]['start'] );

 
$sc2 = e107::getScBatch('download', true);
//$sc->wrapper('download/view');

/*	 * Example e107::getScBatch('contact')->wrapper('contact/form');
	 * which results in using the $CONTACT_WRAPPER['form'] wrapper in the parsing phase   */
	 
$sc2->wrapper('latest_menu/item');
 
$start    =  $tp->parseTemplate($template['start'], true, $sc2);
$end      =  $tp->parseTemplate($template['end'], true, $sc2);

 
$items ='';

//$item_template = $latest_downloads->setWhatIsDisplayed($template['item']['item']);
$item_template = $template['item']['item'];

foreach ($listArray as  $v)
{			
	$sc2->setVars($v);   
    $items    .=  $tp->parseTemplate($item_template, true, $sc2);       
}

e107::getRender()->tablerender($caption, $start.$items.$end);

 