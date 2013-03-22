<div id="wpact_titleContainer">
	<span>Newsletter</span><br/>
	<small>February 22, 2013 | <a href="#">Previous issues</a></small>
</div>
<div id="wp_category_tabs">
	<ul>
		<?php $categories=get_categories(array('number'=>4)); ?>
		<?php foreach($categories as $cat): ?>
		<li>
			<a href="#cat_<?php echo $cat->cat_ID ?>" data-cat_id="<?php echo $cat->cat_ID ?>"><?php echo $cat->cat_name ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php foreach($categories as $cat): ?>
	<div id="cat_<?php echo $cat->cat_ID ?>"></div>
	<?php endforeach; ?>
	<div id="wpact_readMoreContainer" class="ajaxReadMore"><a href="#" id="wpact_readMore" style="padding:10px;">Read more</a></div>
</div>