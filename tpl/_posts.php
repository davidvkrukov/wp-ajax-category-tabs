<div class="ajaxPostContent">
<?php foreach($_posts as $_post): ?>
	<h2><?php echo $_post->post_title ?></h2>
	<!-- post flag & source here -->
	<div class="ajaxPostDesc">
		<?php echo $_post->post_content ?>
	</div>
<?php endforeach; ?>
</div>