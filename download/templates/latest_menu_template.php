<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
 */
if (!defined('e107_INIT'))
{
    exit;
}

$LATEST_MENU_WRAPPER['item']['DOWNLOAD_CATEGORY']         = "<dt>".LAN_CATEGORY . "</dt><dd>{---}</dd>";
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_LIST_FILESIZE']    = "<dt>" . LAN_SIZE . "</dt><dd>{---}</dd>";
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_LIST_AUTHOR']      = "<dt>" . LAN_AUTHOR . "</dt><dd>{---}</dd>";
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_VIEW_DATE_SHORT']  = "<dt>" . LAN_DATE . "</dt><dd>{---}</dd>";
$LATEST_MENU_WRAPPER['item']['DOWNLOAD_LIST_SUMMARY']     = "<dt>" . LAN_SUMMARY . "</dt><dd>{---}</dd>";
 
$LATEST_MENU_TEMPLATE['caption'] = '{MENU_CAPTION}';
$LATEST_MENU_TEMPLATE['start'] = '<ul class="list-group ">';


$LATEST_MENU_TEMPLATE['item']['item'] = '
<style>
dl {
    width: 100%;
}
dt {
    float: left;
    width: 8em;
}

dd {
    margin-left: 0em;
}

dd + dd {
    margin-left: 0em;
}
</style>
  

<li class="list-group-item top-download-{DOWNLOAD_POSITION}">
 
			<h5 class="contenttitle">{DOWNLOAD_LIST_NAME}</h5>
            <dl>
                {DOWNLOAD_CATEGORY}
                {DOWNLOAD_LIST_AUTHOR}
		        {DOWNLOAD_LIST_FILESIZE}
                {DOWNLOAD_VIEW_DATE_SHORT} 
                {DOWNLOAD_LIST_SUMMARY}
            </dl>
           
            
            
            
 </li> 
 ';
$LATEST_MENU_TEMPLATE['item']['separator'] = '';
$LATEST_MENU_TEMPLATE['end'] = '</ul> ';