<div class="wpact_container">
	<div id="wpact_titleContainer">
		<strong style="position:relative;bottom:-20px;letter-spacing:1px;font-size:30px;font-weight:normal;margin:0px;padding:0px;z-index:3;">Newsletter</strong>
		<span style="display:block;position:relative;top:-5px;font-size:small;color:#aaa;background:none;z-index:2;"><small style="background:#fff;padding:10px 20px;position:relative;z-index:1;"><img alt="calendar" src="<?php echo plugins_url('img/calendar.png',dirname(__FILE__)) ?>" style="position:relative;top:3px;width:14px;height:14px;"> February 22, 2013 | <a href="#" style="display:inline;text-decoration:none;color:#aaa;"><img alt="previous" src="<?php echo plugins_url('img/previous.png',dirname(__FILE__)) ?>" style="position:relative;top:3px;width:14px;height:14px;">Previous issues</a></small></span>
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