<div class="wpact_container">
	<div id="wpact_titleContainer">
		<h2 style="position:relative;bottom:-15px;padding:0px;margin:0px;">Newsletter</h2>
		<div><small><i class="ui-icon ui-icon-calendar" style="position:relative;display:inline-block;top:2px;"></i> February 22, 2013 | <a href="#" style="display:inline;text-decoration:none;"><i class="ui-icon ui-icon-arrowreturnthick-1-w" style="position:relative;display:inline-block;top:2px;"></i>Previous issues</a></small></div>
	</div>
	<div id="wp_category_tabs">
		<?php $categories=get_categories('child_of='.get_cat_ID('Newsletters').'&hide_empty=0'); ?>
			<?php if(count($categories)>0): ?>
			<ul>
				<?php foreach($categories as $cat): ?>
				<li>
					<a href="#cat_<?php echo $cat->cat_ID ?>" data-cat_id="<?php echo $cat->cat_ID ?>"><?php echo $cat->cat_name ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php foreach($categories as $cat): ?>
			<div id="cat_<?php echo $cat->cat_ID ?>"></div>
			<?php endforeach; ?>
		<?php else: ?>
			<div>Currently have not newsletters</div>
		<?php endif; ?>
		<div id="wpact_readMoreContainer" class="ajaxReadMore"><?php if(count($categories)>0): ?><a href="#" id="wpact_readMore" style="padding:10px;">Read more</a><?php endif; ?></div>
	</div>
</div>