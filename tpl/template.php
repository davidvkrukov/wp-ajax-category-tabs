<div class="wpactContainer">
	<div id="wpactTitleContainer">
		<strong><?php echo trim(get_option('wpact_root_template_title'))==''?__('WP Ajax Categories Tab Title'):trim(get_option('wpact_root_template_title')); ?></strong>
	</div>
	<div id="wpactAjaxCategoryTabs">
		<?php 
			$root_category_id=get_option('wpact_root_category',false);
			if($root_category_id===false||trim($root_category_id)==''){
				$all_categories=get_categories();
				$root_category_id=null;
				foreach($all_categories as $_cat){
					if($root_category_id==null||intval($_cat->cat_ID)<$root_category_id){
						$root_category_id=intval($_cat->cat_ID);
					}
				}
			}
			$categories=get_categories('child_of='.$root_category_id.'&hide_empty=0');
		?>
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
			<div><?php echo __('Current root category have not subcategories...') ?></div>
		<?php endif; ?>
		<div id="wpactReadMoreContainer" class="wpactAjaxReadMore"><?php if(count($categories)>0): ?><a href="#" id="wpact_readMore" style="padding:10px;"><?php echo __('More') ?></a><?php endif; ?></div>
	</div>
</div>