<?php
/*
 * e107 Bootstrap CMS
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * IMPORTANT: Make sure the redirect script uses the following code to load class2.php:
 *
 * 	if (!defined('e107_INIT'))
 * 	{
 * 		require_once(__DIR__.'/../../class2.php');
 * 	}
 *
 */

if (!defined('e107_INIT')) { exit; }

// v2.x Standard  - Simple mod-rewrite module.

class download_url // plugin-folder + '_url'
{

	public $alias = 'download';
 
	function config($profile=null)
	{

		$alias = 'download';

		// $config['subcategory'] = array(
		// 	'regex'			=> '^{alias}/([^\/]*)/([^\/]*)/?$',
		// 	'redirect'		=> '{e_PLUGIN}download/download.php?catsef=$2', // TODO catsef support in download_class.php
		// 	'sef'			=> '{alias}/{cat_sef}/{subcat_sef}'
		// );
 

		/* category detail list  */
		$config['category'] = array(
			'alias'         => "{$alias}/category",
			'regex'			=> '^{alias}-(\d*)-([\w-]*)\/?\??(.*)',
			'sef'			=> '{alias}-{download_category_id}-{download_category_sef}/',
			'redirect'		=> '{e_PLUGIN}download/download.php?action=list&id=$1',
			//'redirect'		=> '{e_PLUGIN}news/news_category.php?id=$1&sef=$2'
		);

		/* download detail view  */
		$config['item'] = array(
			'alias'         => "{$alias}/view",
			'regex'			=> '^{alias}-(\d*)-([\w-]*)\/?\??(.*)',
			'sef'			=> '{alias}-{download_id}-{download_sef}/',
			'redirect'		=> '{e_PLUGIN}download/download.php?action=view&id=$1'
		);

	 
		$config['get']     = array(
			'regex'		    => '^{alias}/get/([\d]*)/(.*)$',
			'sef'           => '{alias}/get/{download_id}/{download_sef}',
			'redirect'	    => '{e_PLUGIN}download/request.php?id=$1&sef=$2', 		// file-path of what to load when the regex returns true.
		);

		$config['report']    = array(
			'regex'		    => '^{alias}/report/([\d]*)/(.*)$',
			'sef'           => '{alias}/report/{download_id}/{download_sef}',
			'redirect'	    => '{e_PLUGIN}download/download.php?action=report&id=$1', 		// file-path of what to load when the regex returns true.

		);

		$config['image']     = array(
			'regex'		    => '^{alias}/image/([\d]*)/(.*)$',
			'sef'           => '{alias}/image/{download_id}/{download_sef}',
			'redirect'	    => '{e_PLUGIN}download/request.php?download.$1', 		// file-path of what to load when the regex returns true.
		);

		
		/* frontpage 'maincats'  */
		$config['index'] = array(
			'alias'         => $alias,
			'regex'		    => '^{alias}/$',
			'sef'		    => '{alias}/',
			'redirect'	    => '{e_PLUGIN}download/download.php',
		);

 

		return $config;
	}


	private function profile1()
	{
		$config = array();
 

		$config['category'] = array(
			'regex'			=> '^{alias}/category/([\d]*)/(.*)$',
			'redirect'		=> '{e_PLUGIN}download/download.php?action=list&id=$1',
			'sef'           => '{alias}/category/{download_category_id}/{download_category_sef}/',
		);

		$config['item']     = array(
			'regex'		    => '^{alias}/([\d]*)/(.*)$',
			'redirect'	    => '{e_PLUGIN}download/download.php?action=view&id=$1',
			'sef'           => '{alias}/{download_id}/{download_sef}',
		);

		$config['get']     = array(
			'regex'		    => '^{alias}/get/([\d]*)/(.*)$',
			'sef'           => '{alias}/get/{download_id}/{download_sef}',
			'redirect'	    => '{e_PLUGIN}download/request.php?id=$1&sef=$2', 		// file-path of what to load when the regex returns true.
		);

		$config['report']    = array(
			'regex'		    => '^{alias}/report/([\d]*)/(.*)$',
			'sef'           => '{alias}/report/{download_id}/{download_sef}',
			'redirect'	    => '{e_PLUGIN}download/download.php?action=report&id=$1', 		// file-path of what to load when the regex returns true.

		);

		$config['image']     = array(
			'regex'		    => '^{alias}/image/([\d]*)/(.*)$',
			'sef'           => '{alias}/image/{download_id}/{download_sef}',
			'redirect'	    => '{e_PLUGIN}download/request.php?download.$1', 		// file-path of what to load when the regex returns true.
		);

		$config['index'] = array(
			'regex'		    => '^{alias}/?(.*)$',
			'sef'		    => '{alias}/',
			'redirect'	    => '{e_PLUGIN}download/download.php$1',
		);


		return $config;
	}



}
