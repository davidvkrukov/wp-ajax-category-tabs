<div class="ajaxPostContent">
<?php foreach($_posts as $_post): ?>
	<h2><?php echo $_post->post_title; ?></h2>
	<p class="sourceLine">
		<?php 
			if($flags=get_post_meta($_post->ID,'wpact_flag',true)){
				$flags=unserialize($flags); 
				if(is_array($flags)){
					foreach($flags as $flag){
						echo '<img style="padding:2px;" src="'.plugins_url('img/'.$flag.'.png',dirname(__FILE__)).'" />';
					}
				}
			}
			if($source=get_post_meta($_post->ID,'wpact_source',true)){
				$source=unserialize($source);
				if(isset($source['url'])&&isset($source['title'])){
					echo '<span style="padding:5px 10px;">Source: <a href="'.$source['url'].'">'.$source['title'].'</a></span>';
				}
			}
		?>
	</p>
	<div class="ajaxPostDesc">
		<?php echo $_post->post_content ?>
	</div>
<?php endforeach; ?>
</div>