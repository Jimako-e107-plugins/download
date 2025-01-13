<?php
/*
* e107 website system
*
* Copyright (C) 2008-2012 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom download install/uninstall/update routines
*
*/

class download_setup
{
	
	function install_pre($var)
	{
		// print_a($var);
		$mes = eMessage::getInstance();
		// $mes->add("custom install 'pre' function.", E_MESSAGE_SUCCESS);
	}

	function install_post($var)
	{
		$sql = e107::getDb();
		$mes = eMessage::getInstance();
		// $mes->add("custom install 'post' function.", E_MESSAGE_SUCCESS);
	}

	function uninstall_pre($var)
	{
		$sql = e107::getDb();
		$mes = eMessage::getInstance();
		// $mes->add("custom uninstall 'pre' function.", E_MESSAGE_SUCCESS);
	}



	function upgrade_required()
	{

		// Check if e_dashboard and e_notify addons are loaded 
		if(!e107::getAddon('download','e_notify') || !e107::getAddon('download','e_dashboard'))
		{
			return true;
		}

		// Get all preferences
		$pref = e107::getPref();

		// Use array_keys and preg_grep to check for keys starting with "download_"

		/*		Array
		(
			[316] => download_php
			[317] => download_subsub
			[318] => download_incinfo
			[319] => download_view
			[320] => download_order
			[321] => download_sort
			[322] => download_reportbroken
			[326] => download_denied
			[342] => download_limits
		)
		*/
 
		$keys = array_keys($pref);
		$matchingKeys = preg_grep('/^download_/', $keys);
		if (!empty($matchingKeys))
		{
			 return true;
		}		

	}



	// IMPORTANT : This function below is for modifying the CONTENT of the tables only, NOT the table-structure. 
	// To Modify the table-structure, simply modify your {plugin}_sql.php file and an update will be detected automatically. 
	/*
	 * @var $needed - true when only a check for a required update is being performed.
	 * Return: Reason the upgrade is required, otherwise set it to return FALSE. 
	 */
	function upgrade_post($needed)
	{
		$pref = e107::getPref();

		// Use array_keys and preg_grep to check for keys starting with "download_"
		$keys = array_keys($pref);
		$matchingKeys = preg_grep('/^download_/', $keys);

		if (!empty($matchingKeys))
		{ 
 
			/* This will move the main download preferences into its own table row. */
			$dconf = e107::getPlugConfig('download', '', false);
			$coreConfig = e107::getConfig();
			$old_prefs = array();
	 
			foreach ($pref as $k => $v)
			{

				if (substr($k, 0, 9) == 'download_')
				{

					//$nk = substr($k, 9);
					$nk = $k;
					$old_prefs[$nk] = $v;
					$coreConfig->remove($k);
				}
			}

			$old_prefs['mirror_order'] = $pref['mirror_order'];
			$coreConfig->remove('mirror_order');

			$old_prefs['agree_flag'] = $pref['agree_flag'];
			$coreConfig->remove('agree_flag');

			$old_prefs['agree_text'] = $pref['agree_text'];
			$coreConfig->remove('agree_text');

			$old_prefs['recent_download_days'] = $pref['recent_download_days'];
			$coreConfig->remove('recent_download_days');

			$old_prefs['download_limits'] = $pref['download_limits'];
			$coreConfig->remove('download_limits');

			$dconf->setPref($old_prefs)->save(false, true);
			$coreConfig->save(false, true);
		}
		/*
		 * Currently Installed version (prior to upgrade): $needed->current_plug['plugin_version'];
		 * Add "IF" statements as needed, and other upgrade_x_y() methods as required. 
		 * eg.	if($needed->current_plug['plugin_version'] == '1.0')
		 * 		{
		 * 			$this->upgrade_from_1();
		 * 		}
		 */

		// Make sure e_notify and e_dashboard addons are loaded
		if(!e107::getAddon('download','e_notify') || !e107::getAddon('download','e_dashboard'))
		{
			e107::getPlug()->clearCache()->buildAddonPrefLists();	
		}
		

		$config = e107::getPref('url_config');

		if(!empty($config['download']))
		{
			e107::getConfig()
			->removePref('url_config/download')
			->removePref('url_locations/download')
			->save(false,true);

			if(file_exists(e_PLUGIN."download/url/url.php"))
			{
				@unlink(e_PLUGIN."download/url/url.php");
				@unlink(e_PLUGIN."download/url/sef_url.php");
			}

			$bld = new eRouter;
			$bld->buildGlobalConfig();

		}

		return $this->upgradeFilePaths($needed);

	}


	private function upgradeFilePaths($needed)
	{



		$sql = e107::getDb();
		$mes = e107::getMessage();
		$qry = "SELECT * FROM #download WHERE download_image !='' AND SUBSTRING(download_image, 1, 3) != '{e_' ";

		if($sql->gen($qry))
		{
			if($needed == TRUE){ return "Incorrect download image paths"; } // Signal that an update is required.

			if($sql->update("download","download_image = CONCAT('{e_FILE}downloadimages/',download_image) WHERE download_image !='' "))
			{
				$mes->addSuccess("Updated Download-Image paths");
			}
			else
			{
				$mes->addError("Failed to update Download-Image paths");
			}

			if($sql->update("download"," download_thumb = CONCAT('{e_FILE}downloadthumbs/',download_thumb) WHERE download_thumb !='' "))
			{
				$mes->addSuccess("Updated Download-Thumbnail paths");
			}
			else
			{
				$mes->addError("Failed to update Download-Thumbnail paths");
			}
		}

		$qry = "SELECT * FROM #download_category WHERE download_category_icon !='' AND SUBSTRING(download_category_icon, 1, 3) != '{e_' ";
		if($sql->gen($qry))
		{
			// Signal that an update is required.
			if($needed == TRUE){ return "Downloads-Category icon paths need updating"; } // Must have a value if an update is needed. Text used for debug purposes.

			if($sql->update("download_category","download_category_icon = CONCAT('{e_IMAGE}icons/',download_category_icon) WHERE download_category_icon !='' "))
			{
				$mes->addSuccess("Updated Download-Image paths");
			}
			else
			{
				$mes->addError("Failed to update Download-Image paths");
			}
		}

		if($needed == TRUE){ return FALSE; }



	}
}
