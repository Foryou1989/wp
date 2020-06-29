<footer id="dibu">	
	   <div class="bottom">
	   <ul class="botop"><?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'bottom-menu')); ?></ul>
        <div class="tongji"><?php echo get_option('yzipi_tongjis'); ?></div>
    </div>
  </div>
  
    <div class="off">
  <div class="scroll" id="scroll" style="display:none;"> ︿ </div>
  </div>
  <script type="text/javascript">
	$(function(){
		showScroll();
		function showScroll(){
			$(window).scroll( function() { 
				var scrollValue=$(window).scrollTop();
				scrollValue > 500 ? $('div[class=scroll]').fadeIn():$('div[class=scroll]').fadeOut();
			} );	
			$('#scroll').click(function(){
				$("html,body").animate({scrollTop:0},1224);	
			});	
		}
	})
	</script> 
</footer>
<!--dibu-->
<?php wp_footer(); ?>
</body></html>