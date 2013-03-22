<?php 
/**
 * @author David V. Krukov
 */

class CT_Main{
	private static $__instance=null;
	
	protected function __construct(){
		add_action('init',array(&$this,'loadShortcode'));
		add_action('wp_enqueue_scripts',array(&$this,'loadScripts'));
	}
	
	public static function init(){
		if(self::$__instance===null){
			self::$__instance=new CT_Main();
		}
		return self::$__instance;
	}
	
	public function loadScripts(){
		global $wp_scripts;
		$proto=is_ssl()?'https':'http';
		$ui=$wp_scripts->query('jquery-ui-core');
		$url=$proto.'://ajax.googleapis.com/ajax/libs/jqueryui/'.$ui->ver.'/themes/smoothness/jquery-ui.css';
		wp_enqueue_style('jquery-ui-smoothness',$url,false,null);
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-tabs-impl',plugins_url('js/wp-category-tabs.js',dirname(__FILE__)));
	}
	
	public function loadShortcode(){
		add_shortcode('wp_category_tabs',array(&$this,'_shortcodeData'));
	}
	
	public function _shortcodeData($attrs=array(),$content=null){
		ob_start();
		require dirname(dirname(__FILE__)).'/tpl/template.php';
		$html=ob_get_contents();
		ob_clean();
		return $html;
	}
	
}
