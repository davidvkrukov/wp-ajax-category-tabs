<div class="wpactAjaxPostContent">
<?php foreach($_posts as $_post): ?>
	<h2><?php echo $_post['post_title']; ?></h2>
	<p class="wpactSourceLine">
		<?php 
			// TODO
		?>
	</p>
	<div class="wpactAjaxPostDesc">
		<?php echo $_post['post_content'] ?>
	</div>
<?php endforeach; ?>
</div>