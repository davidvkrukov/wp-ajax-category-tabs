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
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-tabs-impl',plugins_url('js/wp-category-tabs.js',dirname(__FILE__)));
	}
	
	public function _init(){
		add_action('wp_ajax_load_category_posts',array(&$this,'ajax_loadCategoryPosts'));
		add_action('wp_ajax_nopriv_load_category_posts',array(&$this,'ajax_loadCategoryPosts'));
		add_shortcode('wp_category_tabs',array(&$this,'_shortcodeData'));
	}
	
	public function _setAjaxURL(){
		echo '<script type="text/javascript">';
		echo 'var wpct_ajaxurl="'.admin_url('admin-ajax.php').'";';
		echo '</script>';
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
			$args=array('offset'=>1,'category'=>intval($_POST['category']));
			if(!isset($_POST['full_list'])){
				$args['numberposts']=3;
			}
			$_posts=get_posts($args);
			ob_start();
			require dirname(dirname(__FILE__)).'/tpl/_posts.php';
			$html=ob_get_contents();
			ob_clean();
			echo $html;
		}
		wp_die();
	}
	
}
