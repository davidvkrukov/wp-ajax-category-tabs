jQuery(document).ready(function($){
	var $tabs=$("#wpactAjaxCategoryTabs").tabs({
		beforeLoad:function(event,ui){
			ui.jqXHR.error(function(){
				ui.panel.html("Couldn't load this tab.");
			});
		},
		activate:function(event,ui){
			if($('#wpactAjaxReadMore').is(':hidden')){
				$('#wpactAjaxReadMore').show();
			}
			var cat_id=$(ui.newTab.context).data('cat_id');
			$.ajax({
				url:wpact_ajaxurl,
				type:'post',
				data:{action:'load_category_posts',category:cat_id},
				success:function(resp){
					$(ui.newPanel).html(resp);
					$('#wpactAjaxReadMore').on('click',function(){
						$.ajax({
							url:wpact_ajaxurl,
							type:'post',
							data:{action:'load_category_posts',category:cat_id,full_list:1},
							success:function(resp){
								$(ui.newPanel).html(resp);
							}
						});
						$(this).hide();
						return false;
					});
				}
			});
		}
	});
	$tabs.tabs('select',1);
	$tabs.tabs('select',0);
});