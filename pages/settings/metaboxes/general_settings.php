<?php 
$redirect_url = $this->CleanForInput( $this->get_option( 'redirect_url' ) );
$redirect_home = $this->CleanForInput( $this->get_option( 'redirect_home' ) );
$enable_redirect = $this->get_option( 'enable_redirect' );
$redirect_again = $this->get_option( 'redirect_again' );
$redirect_delay = $this->get_option( 'redirect_delay' );
?>

<fieldset>
	<legend>Redirection</legend>
	
	<?php $nextItem = 'enable_redirect'; ?>
	<?php $nextValue = $this->get_option( $nextItem ); ?>
	<div class="control-group">
		<label class="control-label" for="<?php echo $nextItem; ?>">Enable Redirection?</label>
		<div class="controls">
			<label class="checkbox">
				<input type="checkbox" onclick="jQuery('#redirector_content').toggle();" name="<?php echo $nextItem; ?>" <?php echo $nextValue == '1' ? 'checked="checked"' : ''; ?> value="1">
				Yes - will enable core redirection functionality
				<p class="help-block"><strong>Note:</strong> theme must have <code>wp_footer()</code> to work (most do).</p>
			</label>
		</div>
	</div>
	
</fieldset>

<div id="redirector_content" style="display:<?php echo $nextValue == 'yes' || $nextValue == '1' ? 'block' : 'none'; ?>;">
	
	<fieldset>
		<legend>Default Settings</legend>
		
		<?php $nextItem = 'redirect_again'; ?>
		<?php $nextValue = $this->get_option( $nextItem ); ?>
		<div class="control-group">
			<label class="control-label" for="<?php echo $nextItem; ?>">Consecutive Redirects</label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="<?php echo $nextItem; ?>" <?php echo $nextValue == '1' ? 'checked="checked"' : ''; ?> value="1">
					Enable - allows users to be redirected multiple times
				</label>
			</div>
		</div>
		
		<?php $nextItem = 'redirect_url'; ?>
		<?php $nextValue = $this->get_option( $nextItem, true ); ?>
		<div class="control-group">
			<label class="control-label" for="<?php echo $nextItem; ?>">Site-wide Redirect</label>
			<div class="controls">
				<input type="text" class="span5" id="<?php echo $nextItem; ?>" name="<?php echo $nextItem; ?>" value="<?php echo $nextValue; ?>" placeholder="ex. http://somesite.com/whatever">
				<span class="help-inline">(optional) every page on entire site</span>
				<span class="help-block"><strong>Note:</strong> can be overridden by post/page-specific settings</span>
			</div>
		</div>
		
		<?php $nextItem = 'redirect_home'; ?>
		<?php $nextValue = $this->get_option( $nextItem, true ); ?>
		<div class="control-group">
			<label class="control-label" for="<?php echo $nextItem; ?>">Homepage Redirect</label>
			<div class="controls">
				<input type="text" class="span5" id="<?php echo $nextItem; ?>" name="<?php echo $nextItem; ?>" value="<?php echo $nextValue; ?>" placeholder="ex. http://somesite.com/whatever">
				<span class="help-inline">(optional) redirect url just for the homepage</span>
			</div>
		</div>
		
		<?php $nextItem = 'redirect_delay'; ?>
		<?php $nextValue = $this->get_option( $nextItem, true ); ?>
		<div class="control-group">
			<label class="control-label" for="<?php echo $nextItem; ?>">Redirect Delay</label>
			<div class="controls">
				<input type="text" class="span1" id="<?php echo $nextItem; ?>" name="<?php echo $nextItem; ?>" value="<?php echo $nextValue; ?>" placeholder="ex. 3">
				<span class="help-inline">seconds</span>
				<span class="help-block">Measures the time in seconds to wait after the page loads for a visitor before 
				detecting & checking for a redirect action to happen; we recommend a value of 1.</span>
			</div>
		</div>
		
	</fieldset>
	
</div>
