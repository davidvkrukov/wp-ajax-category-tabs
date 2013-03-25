<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2><?php _e('WP Ajax Category Tabs'); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields('wpact-settings-group'); ?>
		<?php do_settings_sections('wpact-settings-group'); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row" colspan="2"><h3 class="title"><?php _e('Settings'); ?></h3></th>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Template title'); ?></th>
				<td>
					<input class="regular-text" type="text" name="wpact_root_template_title" value="<?php echo get_option('wpact_root_template_title'); ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Root category'); ?></th>
				<td>
					<?php $categories=get_categories(); ?>
					<select id="wpact_root_category" name="wpact_root_category">
						<option value=""<?php echo get_option('wpact_root_category',false)==false?' selected="selected"':''; ?>>Not selected</option>
					<?php foreach($categories as $category): ?>
						<option value="<?php echo $category->cat_ID ?>"<?php echo get_option('wpact_root_category')==$category->cat_ID?' selected="selected"':''; ?>><?php echo $category->name ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('jQueryUI theme'); ?></th>
				<td>
					<select id="wpact_jqueryui_theme" name="wpact_jqueryui_theme">
					<?php foreach($this->jquery_ui_themes as $theme): ?>
						<option value="<?php echo $theme ?>"<?php echo get_option('wpact_jqueryui_theme','smoothness')==$theme?' selected="selected"':''; ?>><?php echo ucwords(str_replace('-',' ',$theme)) ?></option>
					<?php endforeach;?>
					</select>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>