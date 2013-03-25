<div class="wpact_container">
	<div id="wpact_titleContainer">
		<strong>Newsletter</strong>
	</div>
	<div id="wpact_categoryTabs">
		<?php $categories=get_categories('child_of='.get_cat_ID('Newsletters').'&hide_empty=0'); ?>
			<?php if(count($categories)>0): ?>
			<ul>
				<?php foreach($categories as $cat): ?>
				<li>
					<a href="#wpact_cat_<?php echo $cat->cat_ID ?>" data-cat_id="<?php echo $cat->cat_ID ?>"><?php echo $cat->cat_name ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php foreach($categories as $cat): ?>
			<div id="wpact_cat_<?php echo $cat->cat_ID ?>"></div>
			<?php endforeach; ?>
		<?php else: ?>
			<div><?php echo __('Have not categories to list...') ?></div>
		<?php endif; ?>
		<div id="wpact_readMoreContainer" class="wpactAjaxReadMore"><?php if(count($categories)>0): ?><a href="#" id="wpact_readMore" style="padding:10px;"><?php echo __('More') ?></a><?php endif; ?></div>
	</div>
</div>