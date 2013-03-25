<?php 
/**
 * @author David V. Krukov
 */

class WP_Ajax_Category_Tabs_Main{
	private static $__instance=null;
	public $jquery_ui_themes=array('black-tie','blitzer','cupertino','dark-hive','dot-luv','eggplant','excite-bike','flick','hot-sneaks','humanity','le-frog','mint-choc','overcast','pepper-grinder','redmond','smoothness','south-street','start','sunny','swanky-purse','trontastic','ui-darkness','ui-lightness','vader');
	
	protected function __construct(){
		add_action('init',array(&$this,'_init'));
		add_action('wp_head',array(&$this,'_setAjaxURL'));
		add_action('wp_enqueue_scripts',array(&$this,'loadScripts'));
		if(is_admin()){
			add_action('admin_init',array(&$this,'_registerSettings'));
			add_action('admin_menu',array(&$this,'_registerMenu'));
		}
	}
	
	public static function init(){
		if(self::$__instance===null){
			self::$__instance=new WP_Ajax_Category_Tabs_Main();
		}
		return self::$__instance;
	}
	
	public function loadScripts(){
		wp_enqueue_style('jquery-ui-smoothness','http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.min.css',false,null);
		wp_enqueue_style('wp-ajax-category-tabs-impl-css',plugins_url('css/wp-ajax-category-tabs.css',dirname(__FILE__)));
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('wp-ajax-category-tabs-impl-js',plugins_url('js/wp-ajax-category-tabs.js',dirname(__FILE__)));
	}
	
	public function _init(){
		add_action('wp_ajax_load_category_posts',array(&$this,'ajax_loadCategoryPosts'));
		add_action('wp_ajax_nopriv_load_category_posts',array(&$this,'ajax_loadCategoryPosts'));
		add_action('add_meta_boxes',array(&$this,'_addMetabox'));
		add_action('save_post',array(&$this,'_saveMetaboxValues'));
		add_shortcode('wpact_ajax_category_tabs',array(&$this,'_shortcodeData'));
	}
	
	public function _registerSettings(){
		register_setting('wpact-settings-group','wpact_root_category');
		register_setting('wpact-settings-group','wpact_jqueryui_theme');
		register_setting('wpact-settings-group','wpact_root_template_title');
	}
	
	public function _registerMenu(){
		$settings_url=add_options_page('WP Ajax Category Tabs','WP Ajax Category Tabs','administrator',__FILE__,array(&$this,'_settingsPage'));
		add_action('load-'.$settings_url,array(&$this,'_saveSettings'));
	}
	
	public function _settingsPage(){
		ob_start();
		require dirname(dirname(__FILE__)).'/tpl/settings.php';
		$html=ob_get_contents();
		ob_clean();
		echo $html;
	}
	
	public function _saveSettings(){
		
	}
	
	public function _setAjaxURL(){
		echo '<script type="text/javascript">';
		echo 'var wpact_ajaxurl="'.admin_url('admin-ajax.php').'";';
		echo '</script>';
	}
	
	public function _addMetabox(){
		global $post;
		$allowed_types=array();
		if(in_array($post->post_type,$allowed_types)){
			add_meta_box('wpact_id',__('Post Source (WP AJAX Category Tabs)'),array(&$this,'_metaboxContent'),'post');
		}
	}
	
	public function _metaboxContent($post){
		ob_start();
		require dirname(dirname(__FILE__)).'/tpl/_metabox.php';
		$html=ob_get_contents();
		ob_clean();
		echo $html;
	}
	
	public function _saveMetaboxValues($post_id){
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
			$args=array('category'=>intval($_POST['category']));
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
