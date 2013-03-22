jQuery(document).ready(function($){
	$("#wp_category_tabs").tabs({
		beforeLoad:function(event,ui){
			ui.jqXHR.error(function(){
				ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. If this wouldn't be a demo.");
			});
		},
		beforeActivate:function(event,ui){
			var cat_id=$(ui.newTab.context).data('cat_id');
			$.ajax({
				url:wpct_ajaxurl,
				type:'post',
				data:{action:'load_category_posts',category:cat_id},
				success:function(resp){
					$(ui.newPanel).html(resp);
				}
			});
		}
	});
});