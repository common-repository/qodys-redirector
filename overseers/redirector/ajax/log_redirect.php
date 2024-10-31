<?php
require_once( dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))).'/wp-load.php' );

if( $qodys_redirector )
{
	$ip = $qodys_redirector->GetClass('tools')->getRealIP();
	$redirect_url = urldecode( $_GET['redirect_url'] );
	$host_id = $_GET['post_id'];
	
	$fields = array();
	$fields['post_title'] = "Redirect Record";
	$fields['post_type'] = $qodys_redirector->GetClass('posttype_redirect-record')->m_type_slug;
	$fields['post_status'] = 'pending';
	$fields['post_author'] = 1;
	
	$post_id = wp_insert_post( $fields );
	
	update_post_meta( $post_id, 'ip_address', $ip );
	update_post_meta( $post_id, 'redirect_url', $redirect_url );
	update_post_meta( $post_id, 'host_id', $host_id );
	update_post_meta( $post_id, 'ref', $_SERVER['HTTP_REFERER'] );
}
?>