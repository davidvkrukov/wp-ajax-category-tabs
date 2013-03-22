<?php global $post; ?>
<?php wp_nonce_field(plugin_basename(__FILE__),'wpact_nonce'); ?>
<h2>Select flag(s)</h2>
<ul>
<?php 
$_flags=unserialize(get_post_meta($post->ID,'wpact_flag',true));
if(!is_array($_flags)){
	$_flags=array();
}
?>
<?php $i=1;foreach($flags as $_f=>$_url): ?>
	<li style="float:left;background:<?php echo (in_array($_f,$_flags)?'#aae':'#eee') ?>;margin:2px;">
		<label for="flag_<?php echo $_f?>">
			<strong><?php echo strtoupper($_f); ?></strong>
			<img src="<?php echo $_url ?>"/>
		</label><br/>
		<div style="width:100%;text-align:center;">
			<input type="checkbox" id="flag_<?php echo $_f?>"<?php echo (in_array($_f,$_flags)?' checked="1"':''); ?> name="wpact_flag[]" value="<?php echo $_f ?>"/>
		</div>
	</li>
<?php $i++;endforeach; ?>
</ul>
<div style="clear:both;"></div>
<?php $source=get_post_meta($post->ID,'wpact_source',true); ?>
<h2>Source link</h2>
<label for="wpact_source_title">
	<strong style="display:block;">Title: </strong>
	<input style="width:45%;" type="text" id="wpact_source_title" name="wpact_source[title]" value="<?php echo isset($source['title'])?$source['title']:''; ?>"/>
</label><br/>
<label for="wpact_source_url" style="width:25%;">
	<strong style="display:block;">Link URL: </strong>
	<input style="width:45%;" type="text" id="wpact_source_url" name="wpact_source[url]" value="<?php echo isset($source['url'])?$source['url']:''; ?>"/>
</label><br/>
