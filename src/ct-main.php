<?php 
/**
 * @author David V. Krukov
 */

class CT_Main{
	private static $__instance=null;
	
	protected function __construct(){
		add_action('init',array(&$this,'_init'));
		add_action('wp_head',array(&$this,'_setAjaxURL'));
		add_action('wp_enqueue_scripts',array(&$this,'loadScripts'));
	}
	
	public static function init(){
		if(self::$__instance===null){
			self::$__instance=new CT_Main();
		}
		return self::$__instance;
	}
	
	public function loadScripts(){
		//global $wp_scripts;
		$proto=is_ssl()?'https':'http';
		//$ui=$wp_scripts->query('jquery-ui-core');
		$url=$proto.'://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/smoothness/jquery-ui.css';
		wp_enqueue_style('jquery-ui-smoothness',$url,false,null);
		wp_enqueue_style('wp-category-tabs-ajax-impl-css',plugins_url('css/wp-category-tabs.css',dirname(__FILE__)));
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('wp-category-tabs-ajax-impl-js',plugins_url('js/wp-category-tabs.js',dirname(__FILE__)));
	}
	
	public function _init(){
		add_action('wp_ajax_load_category_posts',array(&$this,'ajax_loadCategoryPosts'));
		add_action('wp_ajax_nopriv_load_category_posts',array(&$this,'ajax_loadCategoryPosts'));
		add_action('add_meta_boxes',array(&$this,'_addMetabox'));
		add_action('save_post',array(&$this,'_saveMetaboxValues'));
		add_shortcode('wp_category_tabs',array(&$this,'_shortcodeData'));
	}
	
	public function __activate(){
		if(is_admin()){
			global $wpdb;
			$sql1="INSERT INTO {$wpdb->prefix}postmeta(post_id,meta_key,meta_value)
							SELECT ID AS post_id,'wpact_flags' AS meta_key,'' AS meta_value
						FROM {$wpdb->prefix}posts WHERE ID NOT IN
							(SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'wpact_flags')
						AND post_type = 'post';";
			$sql2="INSERT INTO {$wpdb->prefix}postmeta(post_id,meta_key,meta_value)
							SELECT ID AS post_id,'wpact_source' AS meta_key,'' AS meta_value
						FROM {$wpdb->prefix}posts WHERE ID NOT IN
							(SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'wpact_source')
						AND post_type = 'post';";
			try{
				$wpdb->query($sql1);
				$wpdb->query($sql2);
			}catch(Exception $e){
				var_dump($e);
			}
		}
	}
	
	public function _setAjaxURL(){
		echo '<script type="text/javascript">';
		echo 'var wpct_ajaxurl="'.admin_url('admin-ajax.php').'";';
		echo '</script>';
	}
	
	public function _addMetabox(){
		add_meta_box('wpact_id','Post Source (WP AJAX Category Tabs)',array(&$this,'_metaboxContent'),'post');
	}
	
	public function _metaboxContent($post){
		ob_start();
		$directory=dirname(dirname(__FILE__)).'/img';
		$it=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
		$flags=array();
		while($it->valid()){
			if(!$it->isDot()){
				$flags[substr(basename($it->getFilename()),0,-4)]=plugins_url('img/'.$it->getFilename(),dirname(__FILE__));
			}
			$it->next();
		}
		ksort($flags);
		require dirname(dirname(__FILE__)).'/tpl/_metabox.php';
		$html=ob_get_contents();
		ob_clean();
		echo $html;
	}
	
	public function _saveMetaboxValues($post_id){
		if(isset($_POST['post_type'])&&$_POST['post_type']=='page'){
			return;
		}
		if(!isset($_POST['post_ID'])){
			return;
		}
		$post_ID=$_POST['post_ID'];
		if(isset($_POST['wpact_flag'])){
			$wpact_flags=$_POST['wpact_flag'];
			if(is_array($wpact_flags)){
				update_post_meta($post_ID,'wpact_flag',serialize($wpact_flags));
			}
		}
		if(isset($_POST['wpact_source'])){
			$wpact_source=$_POST['wpact_source'];
			if(isset($wpact_source['url'])&&isset($wpact_source['title'])&&trim($wpact_source['url'])!=''&&trim($wpact_source['title'])!=''){
				update_post_meta($post_ID,'wpact_source',serialize($wpact_source));
			}
		}
	}
	
	public function _shortcodeData($attrs=array(),$content=null){
		ob_start();
		require dirname(dirname(__FILE__)).'/tpl/template.php';
		$html=ob_get_contents();
		ob_clean();
		return $html;
	}
	
	public function ajax_loadCategoryPosts(){
		if(isset($_POST['category'])){
			$args=array('offset'=>0,'category'=>intval($_POST['category']));
			if(!isset($_POST['full_list'])){
				$args['numberposts']=3;
			}
			$_posts=wp_get_recent_posts($args);
			ob_start();
			require dirname(dirname(__FILE__)).'/tpl/_posts.php';
			$html=ob_get_contents();
			ob_clean();
			echo $html;
		}
		wp_die();
	}
	
}
