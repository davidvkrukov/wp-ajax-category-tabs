<?php global $post; ?>
<?php wp_nonce_field(plugin_basename(__FILE__),'wpact_nonce'); ?>
<h4>Select flag(s):</h4>
<ul>
<?php $i=1;foreach($flags as $_f=>$_url): ?>
	<li style="float:left;background:#eee;margin:2px;">
		<label for="flag_<?php echo $_f?>">
			<strong><?php echo strtoupper($_f); ?></strong>
			<img src="<?php echo $_url ?>"/>
		</label><br/>
		<div style="width:100%;text-align:center;">
			<input type="checkbox" id="flag_<?php echo $_f?>" name="wpact_flag[]" value="<?php echo $_f ?>"/>
		</div>
	</li>
<?php $i++;endforeach; ?>
</ul>
<div style="clear:both;"></div>
<?php $source=get_post_meta($post->ID,'wpact_source',true); ?>
<h4>Source link:</h4>
<label for="wpact_source_url">
	<strong>URL</strong>
	<input type="text" id="wpact_source_url" name="wpact_source[url]" value="<?php echo isset($source['url'])?$source['url']:''; ?>"/>
</label>
<label for="wpact_source_title">
	<strong>Title</strong>
	<input type="text" id="wpact_source_title" name="wpact_source[title]" value="<?php echo isset($source['title'])?$source['title']:''; ?>"/>
</label>