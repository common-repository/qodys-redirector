<?php
class qodyPage_RedirectorSettings extends QodyPage
{
	function __construct()
	{
		$this->SetOwner( func_get_args() );
		
		$this->m_raw_file = __FILE__;
		
		$this->m_priority = 2;
		
		$this->SetParent( 'home' );
		//$this->m_icon_url = '';
		
		$this->SetTitle( 'Settings' );
		
		parent::__construct();
	}
	
	function LoadMetaboxes()
	{
		$this->AddMetabox( 'general_settings', 'Default Redirect Settings' );
		$this->AddMetabox( 'advance_features', 'Advance Features' );
		
		$this->AddMetabox( 'save', 'Save Settings', 'side' );
		$this->AddMetabox( 'announcements', 'Announcements', 'side' );
		$this->AddMetabox( 'support_info', 'Not Working? Try this', 'side' );
	}
}
?>