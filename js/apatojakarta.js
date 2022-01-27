$(document).ready(function(){
		
		$('.logo-slide').bxSlider({
			auto:true,
			controls:true,
			minSlides:2,
			maxSlides:5,
			slideWidth:200,
			slideMargin:10
		});
		
		$('.gallery_slider').bxSlider({
			auto:true,
			adaptiveHeight:true
		});
		
		$('.slider').bxSlider({
			auto:true,
			pagerCustom: '#bx-pager',
			adaptiveHeight:true
		});
		
		$('.menu').slicknav();

		var $grid = $('.grid').masonry({
			//columnWidth: 200,
			itemSelector: '.grid-item'
		});
		
		// layout Masonry after each image loads
		$grid.imagesLoaded().progress( function() {
		$grid.masonry('layout');
		});
		
		$('.mainSlider .item:first-child()').addClass('active');
		
		$('.parallax-slider').each(function(){
			var $this = $(this);
			var $window = $(window);
			
			$(window).scroll(function() {
				if($window.scrollTop() > 0){
					var yPos = -(($window.scrollTop()) / $this.data('speed'));		
				}
				
				if($window.scrollTop() == 0){
					var coords = 'center';
				}else{
					var coords = '50% '+ yPos + 'px';
				}
				
				$this.css({ backgroundPosition: coords });
			});			
			
		});
	
});