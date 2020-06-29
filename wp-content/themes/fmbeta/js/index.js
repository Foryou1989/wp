//菜单下拉
$(function(){	
    var cubuk_seviye = $(document).scrollTop();
    var header_yuksekligi = $('.header-web').outerHeight();

    $(window).scroll(function() {
        var kaydirma_cubugu = $(document).scrollTop();

        if (kaydirma_cubugu > header_yuksekligi){$('.header-web').addClass('gizle');} 
        else {$('.header-web').removeClass('gizle');}

        if (kaydirma_cubugu > cubuk_seviye){$('.header-web').removeClass('sabit');} 
        else {$('.header-web').addClass('sabit');}				

        cubuk_seviye = $(document).scrollTop();	
     });
});

// 手机弹出搜索
(function($) {
	// Handle click on toggle search button
	
	
	$('#toggle-search').click(function() {
	$('#cover').css('display','block'); //显示遮罩层
    $('#cover').css('height',document.body.clientHeight+'px'); //设置遮罩层的高度为当前页面高
		$('#search-form, #toggle-search').toggleClass('open');
		return false;
	
	}
	

	);
	
	// Clicking outside the search form closes it
	$(document).click(function(event) {
		var target = $(event.target);
  
		if (!target.is('#toggle-search') && !target.closest('#search-form').size()) {
			$('#search-form, #toggle-search').removeClass('open');
		}
	});
})(jQuery);

// 手机弹出二级菜单
$(document).ready(function() {
	$('.menu-item-has-children a').click(function(){
		if($(this).siblings('ul').css('display')=='none'){
			$(this).parent('li').siblings('li').removeClass('inactives a');
			$(this).addClass('inactives a');
			$(this).siblings('ul').slideDown(200).children('li');
			
		}else{
			
			$(this).removeClass('inactives a');
			$(this).siblings('ul').slideUp(200);
		

		}
	})
});
// 手机左则弹出菜单
	$(document).click(function(){
		$('.nav-list').removeClass('opend')
		   $('#cover').css('display','none');   //显示遮罩层
	})
	$('.nav-menu,.nav-list').click(function(e){e.stopPropagation()})
	$('nav').find('.nav-menu').click(function(e){
		$('.nav-list').toggleClass('opend')
		  $('#cover').css('display','block'); //显示遮罩层
    $('#cover').css('height',document.body.clientHeight+'px'); //设置遮罩层的高度为当前页面高度
	})
	