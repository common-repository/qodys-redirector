<?php
class qodyPosttype_RedirectRecord extends QodyPostType
{
	function __construct()
	{
		$this->SetOwner( func_get_args() );
		
		$this->m_raw_file = __FILE__;
		
		$this->m_show_in_menu = $this->GetPre().'-home.php';
		
		//$this->m_supports[] = 'title';
		//$this->m_supports[] = 'editor';
		//$this->m_supports[] = 'thumbnail';
		//$this->m_supports[] = 'excerpt';
		$this->m_supports[] = null;

		$this->SetMassVariables( 'redirect record', 'redirect records', true );
		
		$this->m_list_columns['cb'] = '<input type="checkbox" />';
        $this->m_list_columns['ip_address'] = 'IP';
        $this->m_list_columns['redirect_url'] = 'Redirect Url';
        $this->m_list_columns['host_id'] = 'Redirected From';
        $this->m_list_columns['ref'] = 'Referring Page';
		$this->m_list_columns['log_date'] = 'Date';
		
		parent::__construct();
	}
	
	function WhenViewingPostList()
    {
		if( !parent::WhenViewingPostList() )
			return;
		
		$this->EnqueueStyle( 'nicer-tables' );
    }
	
	function DisplayListColumns( $column )
	{
		global $post;
		
		$post_id = $post->ID;
		
		$custom = get_post_custom( $post_id );
		$the_meta = get_post_meta( $post_id, $column, true);
		
		switch( $column )
		{
			case "redirect_url":
				
				echo '<a target="_blank" href="'.$the_meta.'">'.$the_meta.'</a>';
				//echo '<a href="">'.$toDisplay.'</a>';
				
				break;
			
			case "ip_address":
				
				echo '<a target="_blank" href="http://whois.domaintools.com/'.$the_meta.'">'.$the_meta.'</a>';
				//echo '<a href="">'.$toDisplay.'</a>';
				
				break;
			
			case "host_id":
				
				echo '<a target="_blank" href="'.get_permalink( $the_meta ).'">'.get_the_title( $the_meta ).'</a>';
				//echo '<a href="">'.$toDisplay.'</a>';
				
				break;
			
			case "log_date":
				
				$the_post = get_post( $post_id );
				
				echo $this->NumberTimeToStringTime( time() - strtotime($the_post->post_date) ).' ago';
				
				break;
				
			default: echo $the_meta; break;
		}
	}
	
}
?>