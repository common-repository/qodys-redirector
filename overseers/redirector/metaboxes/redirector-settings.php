<?php 
global $post;

$custom = get_post_custom( $post->ID );
?>

<input type="hidden" name="qody_noncename" id="qody_noncename" value="<?php echo wp_create_nonce( $this->GetUrl() ); ?>" />

<table class="form-table">
	<tbody>
		<tr>
		<?php $nextItem = 'enable_redirect'; ?>
			<th><label for="<?php echo $nextItem; ?>1">Enable Redirection</label></th>
			<td><!-- allproductsppid -->
				<input type="radio" <?php if ( $custom[ $nextItem ][0] == '1' || $custom[ $nextItem ][0] == '' ) echo 'checked="checked"'; ?> value="1" name="field_<?php echo $nextItem; ?>" id="<?php echo $nextItem ?>1" >
				<label for="<?php echo $nextItem; ?>1">Enable</label>
				<input type="radio" <?php if ( $custom[ $nextItem ][0] == '-1' ) echo 'checked="checked"'; ?> value="-1" name="field_<?php echo $nextItem; ?>" id="<?php echo $nextItem ?>2" >
				<label for="<?php echo $nextItem; ?>2">Disable</label>
				<span class="howto">Disable to stop any and all redirection from happening on this page</span>
			</td>
		</tr>
		
		<!--<tr>
		<?php $nextItem = 'redirect_again'; ?>
			<th><label for="<?php echo $nextItem; ?>3">Consecutive Redirects</label></th>
			<td>
				<input type="radio" <?php if ( $custom[ $nextItem ][0] == '1' ) echo 'checked="checked"'; ?> value="1" name="field_<?php echo $nextItem; ?>" id="<?php echo $nextItem; ?>3" >
				<label for="<?php echo $nextItem; ?>3">Enable</label>
				<input type="radio" <?php if ( $custom[ $nextItem ][0] == '-1' || $custom[ $nextItem ][0] == '' ) echo 'checked="checked"'; ?> value="-1" name="field_<?php echo $nextItem; ?>" id="<?php echo $nextItem;?>4" >
				<label for="<?php echo $nextItem; ?>4">Disable</label>
				<span class="howto" style="margin-top:5px;">Disabling forces each user to only be redirected from this page once per month</span>
			</td>
		</tr>-->
		
		<tr>
		<?php $nextItem = 'redirect_delay'; ?>
			<?php if( $custom[ $nextItem ][0] == "" ) $custom[ $nextItem ][0] = 0; ?>
			<th><label for="<?php echo $nextItem; ?>5">Redirect Delay</label></th>
			<td><!-- cartpage_id -->
				<input class="widefat" type="text" value="<?php echo $custom[ $nextItem ][0]; ?>" class="full" name="field_<?php echo $nextItem; ?>" size="35" style="width:75px;" id="<?php echo $nextItem; ?>5"> Seconds
				<span class="howto">Delay in seconds for the redirect to occur</span>
			</td>
		</tr>
		
		<tr>
		<?php $nextItem = 'redirect_url'; ?>
			<th><label for="<?php echo $nextItem; ?>6">Redirect URL</label></th>
			<td><!-- cartpage_id -->
				<input class="widefat" type="text" value="<?php echo $custom[ $nextItem ][0]; ?>" class="full" name="field_<?php echo $nextItem; ?>" size="35" id="<?php echo $nextItem; ?>6" >
				<span class="howto">This is the full url of where "leavers" will be redirected to, eg. <?php echo get_bloginfo('url'); ?>/whatever</span></td>
		</tr>
	</tbody>
</table>


<?php $nextItem = 'video_type'; ?>
<input type="hidden" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" /> <!-- application/x-shockwave-flash -->

<?php $nextItem = 'audio_type'; ?>
<input type="hidden" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" /> <!-- application/mp3 -->