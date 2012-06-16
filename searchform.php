<form method="get" class="searchform" action="<?php echo home_url(); ?>/">

	<input type="text" value="<?php _e('Search','andrewasquith');?>" name="s" class="searchfield" onfocus="if (this.value == '<?php _e("Search","andrewasquith");?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Search","andrewasquith");?>';}" />
	<input type="submit" class="searchsubmit" value="Go" name="searchsubmit" />
</form>