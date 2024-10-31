<?php
wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false );

// Select which pagehook to use to select which metaboxes to show
$pagehook = $this->m_pages['settings']['pagehook'];
// ItemDebug($this);
?>

<div class="wrap">

	<h2>Redirector Settings</h2>
	
	<?php $this->GetClass('postman')->DisplayMessages(); ?>
	
	<form action="<?php echo $this->GetAsset( 'forms', 'save', 'url' ); ?>" method="post" id="" class="form-horizontal">
		<?php //wp_nonce_field($this -> sections -> settings); ?>
		
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<div id="side-info-column" class="inner-sidebar">
				
				<img style="width:180px;" class="owl_sidebar" src="<?php echo $this->GetRandomOwlImage( 5 ); ?>" />
				<?php $this->do_meta_boxes( 'side' ); ?>
			</div>
			<div id="post-body" class="has-sidebar">
				<div id="post-body-content" class="has-sidebar-content">
                	<div id="normal-sortables" class="meta-box-sortables ui-sortable">
						<?php $this->do_meta_boxes( 'normal' ); ?>
                        <?php $this->do_meta_boxes( 'advanced' ); ?>
                    </div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
jQuery(document).ready( function(){
	jQuery('#addMorePage').click(function(){
		var pageTableHtml = jQuery(".pageDropdown:last").html();
		jQuery(".pageDropdown:last").after("<tr>"+pageTableHtml+"</tr>");
	});
	jQuery('#addMorePost').click(function(){
		var postTableHtml = jQuery(".postDropDown:last").html();
		jQuery(".postDropDown:last").after("<tr>"+postTableHtml+"</tr>");
	});
	if(jQuery('#capY').attr("checked") == "checked"){
		jQuery('#capdiv').show();
	}
});
</script>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready( function($) {
	// close postboxes that should be closed
	$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
	// postboxes setup
	postboxes.add_postbox_toggles('<?php echo $pagehook; ?>');
});
//]]>
</script>