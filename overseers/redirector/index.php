<?php
class qodyOverseer_Redirector extends QodyOverseer
{
	function __construct()
	{
		$this->SetOwner( func_get_args() );
		
		$this->m_raw_file = __FILE__;
		
		//$this->SetParent( 'home' );
		//$this->m_icon_url = '';
		
		//$this->SetTitle( 'Settings' );
		
		add_action( 'template_redirect', array( $this, 'RedirectorCodeInsertion' ), 0 );
		
		parent::__construct();
	}
	
	function LoadMetaboxes()
	{
		$this->AddMetabox( 'redirector settings', 'Redirector Settings', 'normal', 'post' );
		$this->AddMetabox( 'redirector settings', 'Redirector Settings', 'normal', 'page' );
	}
	
	function RedirectorCodeInsertion()
	{
		global $post;
		// causes problems with people's query loops sometimes, like on http://mastermentalism.com/blog/
		//wp_reset_query(); 
		//wp_reset_postdata();
		
		$custom = $this->get_post_custom( $post->ID );
		
		$enable_redirect = $this->get_option( 'enable_redirect' );
		
		$redirect_url = $this->get_option( 'redirect_url' );
		$home_redirect = $this->get_option( 'redirect_home' );
		
		$ignore_specifics = $this->get_option( 'ignore_specifics' );
		
		if( is_home() || is_front_page() )
		{
			$post_id = -1;
			
			if( $home_redirect )
				$redirect_url = $home_redirect;
		}
		else
		{
			if( $ignore_specifics != 'yes' )
			{
				if( $custom['enable_redirect'] == -1 )
					$enable_redirect = -1;
				
				if( $custom['redirect_url'] )
					$redirect_url = $custom['redirect_url'];
			}
				
			$post_id = $post->ID;
		} 
		
		if( $enable_redirect == '1' && $redirect_url )
		{
			$this->RegisterScript( 'redirector-action', $this->GetAsset( 'includes', 'redirect-action', 'url' ).'?post_id='.$post_id );
			$this->EnqueueScript( 'redirector-action' );
		}
	}
}
?>