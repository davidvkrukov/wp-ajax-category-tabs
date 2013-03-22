<style type="text/css">
.ui-widget-content,.ui-widget-header{
	border:none;
	background:none;
}
.ui-widget-header{
	border-bottom: solid #aaa 1px;
	border-bottom-left-radius:0px;
	border-bottom-right-radius:0px;
}
.ajaxPostDesc{
	border-bottom: solid #aaa 2px;
}
</style>
<div id="wp_category_tabs">
	<ul>
		<?php foreach(get_categories() as $cat): ?>
		<li>
			<a href="#cat_<?php echo $cat->cat_ID ?>" data-cat_id="<?php echo $cat->cat_ID ?>"><?php echo $cat->cat_name ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php foreach(get_categories() as $cat): ?>
	<div id="cat_<?php echo $cat->cat_ID ?>"></div>
	<?php endforeach; ?>
</div>