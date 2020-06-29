<aside id="sitebar">
  <?php 

if (function_exists("dynamic_sidebar")) {//如果设置了侧边栏
 
	if (is_home() || is_front_page()) {
		dynamic_sidebar("widget_homesidebar");//如果是首页则显示home侧边栏中的小工具
	}
	else if (is_category()) {
		dynamic_sidebar("widget_categorysidebar");
	}
	else if (is_tag()) {
		dynamic_sidebar("widget_tagsidebar");
	}
		else if (is_single()) {
		dynamic_sidebar("widget_singlesidebar");
	}
	else if (is_search()) {
		dynamic_sidebar("widget_searchsidebar");
	}
}
?>
<a href="<?php echo get_option('yzipi_adx_links'); ?>" target="_blank" ><img class="totop" src="<?php echo get_option('yzipi_adxs'); ?>" /></a>
   <script type="text/javascript"> 
$(function() { 
    var elm = $('.totop'); 
    var startPos = $(elm).offset().top; 
    $.event.add(window, "scroll", function() { 
        var p = $(window).scrollTop(); 
        $(elm).css('position',((p) > startPos) ? 'fixed' : 'static'); 
        $(elm).css('top',((p) > startPos) ? '0px' : ''); 
    }); 
}); 
</script>
</aside>