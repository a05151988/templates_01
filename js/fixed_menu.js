jQuery(function(){
	jQuery('#goto-top').click(function(){
		jQuery("html, body").animate({
            scrollTop: 0
        }, 600);
	})
	jQuery(window).bind('scroll resize', function(){
		var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
		if(width > 979){
			var $this = jQuery(this);
			var $this_Top=$this.scrollTop();
			if($this_Top < 130){
				jQuery('.menu-section').css('position','relative');
				jQuery('.menu-section').css('width','auto');
				jQuery('.menu-section').css('z-index','auto');
				jQuery('.menu-section').css('top','auto');
				jQuery('#goto-top').hide();
				jQuery('#goto-top').stop().animate({opacity:0});
			}
			if($this_Top > 130){
				if(jQuery('.menu-section').css('top') == 'auto')
					jQuery('.menu-section').css('top','-50px');
				jQuery('.menu-section').css('position','fixed');
				jQuery('.menu-section').stop().animate({top:"0px"});
				jQuery('.menu-section').css('width','100%');
				jQuery('.menu-section').css('z-index','101');
				jQuery('#goto-top').show();
				jQuery('#goto-top').stop().animate({opacity:1});
			}
		}
	}).scroll();
})