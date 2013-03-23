<div class="ajaxPostContent">
<?php foreach($_posts as $_post): ?>
<?php //var_dump($_post);?>
	<h2><?php echo $_post['post_title']; ?></h2>
	<p class="sourceLine">
		<?php 
			$_source=array();
			if($flags=get_post_meta($_post['ID'],'wpact_flag',true)){
				$flags=unserialize($flags); 
				if(is_array($flags)&&count($flags)>0){
					$tmp='';
					foreach($flags as $flag){
						$tmp.='<img style="padding:0 2px;" src="'.plugins_url('img/'.$flag.'.png',dirname(__FILE__)).'" />';
					}
					$_source[]=$tmp;
				}
			}
			if($source=get_post_meta($_post['ID'],'wpact_source',true)){
				$source=unserialize($source);
				if(isset($source['url'])&&isset($source['title'])){
					$_source[]='<span>Source: <a href="'.$source['url'].'">'.$source['title'].'</a></span>';
				}
			}
			echo implode('<span style="padding:5px 20px;">&nbsp;|&nbsp;</span>',$_source);
		?>
	</p>
	<div class="ajaxPostDesc">
		<?php echo $_post['post_content'] ?>
	</div>
<?php endforeach; ?>
</div>