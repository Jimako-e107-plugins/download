<?php

// Generated e107 Plugin Admin Area 

if (!defined('e107_INIT'))
{
    exit;
} 

 		
class download_ui extends e_admin_ui
{		
		protected $pluginTitle		= 'Downloads+';
		protected $pluginName		= 'download';
	  	protected $eventName		= 'download'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'download';
		protected $pid				= 'download_id';
		protected $perPage			= 30; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
        protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	 	protected $tabs				= array(0 =>  'Download Info', 'da' =>'Author Info', 'df' => 'File info' ); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'download_id DESC';
	
		protected $fields 		= array (  
			'checkboxes' =>   array ( 
				'title' => '', 
				'type' => null, 
				'data' => null, 
				'width' => '5%', 
				'thclass' => 'center', 
				'forced' => '1', 
				'class' => 'center', 
				'toggle' => 'e-multiselect', 
				'readParms' =>  array ( ),
		 		'writeParms' =>  array ( ),
		  ),
		  'download_id' =>   array ( 
				'title' => LAN_ID, 
				'data' => 'int', 
				'width' => '5%',
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( ) 
			),
          	'download_name' =>   array ( 
				'title' => LAN_TITLE,
				'type' => 'text', 
				'data' => 'str', 
				'inline' => true, 
				'validate' => true, 
				'help' => 'Unique name, there is unique index for it, so no copy', 
				'readParms' =>  array ( ),
          		'writeParms' => array(
					'size' => 'block-level')
				), 
          	'download_url' =>   array ( 
				'title' => DOWLAN_13,
                'tab' => 'df',
				'type' => 'url', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => 'Internal or external URL', 
				'readParms' =>  array ( ),
          		'writeParms' => array(
				'size' => 'block-level') 
			),
		  	'download_sef' =>   array ( 
				'title' => 'Sef', 
				'type' => 'text', 
				'data' => 'str', 
				'width' => 'auto', 
				'inline' => true, 
                 'writeParms' => array(
                    'sef' => 'download_name',
                    'size' => 'x-level',
                ) ),
		  	'download_author' =>   array ( 
				'title' => LAN_AUTHOR, 
                'tab' => 'da',
				'type' => 'text',  
				'data' => 'str', 
				'filter' => true, 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_author_email' =>   array ( 
				'title' => LAN_EMAIL, 
				'type' => 'email',
                'tab' => 'da',
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
		 		'writeParms' =>  array ( )
		   	),
		  	'download_author_website' =>   array ( 
				'title' => LAN_URL, 
				'type' => 'url',
                'tab' => 'da',
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
		 		'writeParms' =>  array ( )
		   	),
            'download_summary' =>   array(
                'title' => LAN_SUMMARY,
                'type' => 'textarea',
                'data' => 'str', 'inline'=>true,
                'width' => '40%',
                'help' => '',
                'readParms' =>  array(),
                'writeParms' => array(
                    'size' => 'block-level',
                )
            ),
		  	'download_description' =>   array ( 
				'title' => LAN_DESCRIPTION, 
				'type' => 'bbarea', 
				'data' => 'str', 
				'width' => '40%', 
				'help' => '',
			 	'readParms' =>  array ( ),
			 	'writeParms' => array(
            		'size' => 'block-level',
				 )  
			),
		  	'download_keywords' =>   array ( 
				'title' => 'Keywords', 
				'type' => 'tags', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( ) 
			),
		  	'download_filesize' =>   array ( 
				'title' => 'Filesize', 
				'type' => 'text',
                'tab' => 'df',
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_requested' =>   array ( 
				'title' => 'Requested', 
				'type' => 'number',
            'tab' => 'df',
				'data' => 'int', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( ) 
			),
		  	'download_category' =>   array ( 
				'title' => LAN_CATEGORY, 
				'type' => 'dropdown', 
				'data' => 'int', 
				'width' => 'auto', 
				'batch' => true, 
				'filter' => true, 
				'inline' => true, 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_active' =>   array ( 
				'title' => 'Active', 
				'type' => 'boolean', 
				'data' => 'int', 
				'width' => 'auto', 'batch' => true,
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_datestamp' =>   array ( 
				'title' => LAN_DATESTAMP, 
				'type' => 'datestamp',
                'tab' => 'df',
				'data' => 'int', 
				'width' => 'auto', 
				'filter' => true, 
				'help' => '', 
				'readParms' =>  array ( ),
				'writeParms' =>  array ( ),
			),
		  	'download_thumb' =>   array ( 
				'title' => 'Thumb image',
                'tab' => 'df',
				'type' => 'image', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' => 'thumb=80x80', 
				'writeParms' =>  array ( ),
				'class' => 'left', 
				'thclass' => 'left',  ),

		  	'download_image' =>   array ( 
				'title' => 'Download image' ,
                'tab' => 'df',
				'type' => 'image', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' => 'thumb=80x80', 
				'writeParms' =>  array ( )
			),
		  	'download_comment' =>   array ( 
				'title' => 'Comment', 
				'type' => 'boolean', 
				'data' => 'int', 
				'help' => '', 
				'readParms' =>  array ( ),
				'writeParms' =>  array ( )
			),
        'download_class'             => array('title' => DOWLAN_106,            'type' => 'userclass',        'width' => 'auto', 'inline' => true, 'data' => 'int', 'batch' => TRUE, 'filter' => TRUE),
        'download_visible'           => array('title' => LAN_VISIBILITY,        'type' => 'userclass',    'inline' => true,    'width' => 'auto', 'data' => 'int', 'batch' => TRUE, 'filter' => TRUE),
			
		  'options' =>   array ( 
			  'title' => LAN_OPTIONS, 
			  'type' => null, 
			  'data' => null, 
			  'width' => '10%', 
			  'thclass' => 'center last',
          	'noselector'=>false, 'class' => 'center last', 'forced' => '1', 'readParms' =>  array ( ),
		 'writeParms' =>  array ( ),
		  ),
		);		
		
		protected $fieldpref = array('download_name', 'download_url', 'download_category', 'download_active', 'download_datestamp', 'download_class');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 

	
		public function init()
		{
            
            $sql = e107::getDb();
            if($sql->select('download_category'))
            {
                while ($row = $sql->fetch())
                {
                    $this->download_category[$row['download_category_id']] = $row['download_category_name'];
                }
            }
           

            $this->fields['download_category']['writeParms']['optArray'] = $this->download_category;

            // Set drop-down values (if any). 
			$this->fields['download_active']['writeParms']['optArray'] = array('download_active_0','download_active_1', 'download_active_2'); // Example Drop-down array. 
  
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
		// left-panel help menu area. 
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = '<b>Warning!</b> <br>Not upload files here. Use core Download plugin. This is just overview for checking saved data. ';

			return array('caption'=>$caption,'text'=> $text);

		}
			
}
				


class download_form_ui extends e_admin_form_ui
{

	
	// Custom Method/Function 
	function download_keywords($curVal,$mode)
	{

		 		
		switch($mode)
		{
			case 'read': // List Page
				return $curVal;
			break;
			
			case 'write': // Edit Page
				return $this->text('download_keywords',$curVal, 255, 'size=large');
			break;
			
			case 'filter':
			case 'batch':
				return  array();
			break;
		}
	}

}		
		
		
 