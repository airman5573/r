/**
 * @author https://www.cosmosfarm.com/
 */

jQuery(document).ready(function(){
	jQuery('.kboard-dalia-before-after-list-slide .kboard-dalia-before-after-list').each(function(){
		var list = jQuery(this);
		list.owlCarousel({
			loop: true,
			margin: 0,
			nav: true,
			navText: [
				'<span aria-label="' + 'Previous' + '"><i class="xi-angle-left-thin"></i></span>',
				'<span aria-label="' + 'Next' + '"><i class="xi-angle-right-thin"></i></span>'
			],
			items: 1,
			itemClass: 'kboard-list-item',
			responsiveBaseElement: list,
			autoplay: false,
			mouseDrag: false,
			touchDrag: false,
			pullDrag: false,
			freeDrag: false,
		});
	});
	
	kboard_dalia_before_after_list_layout();
	
	setTimeout(function(){
		jQuery('.kboard-dalia-before-after-list .kboard-list-item').kboardViewport(function(px){
			if(px && !jQuery(this).hasClass('animation-fadein')){
				jQuery(this).addClass('animation-fadein');
			}
		});
	});
});

jQuery(window).resize(function(){
	kboard_dalia_before_after_list_layout();
});

function kboard_dalia_before_after_list_layout(){
	jQuery('.kboard-dalia-before-after-list').each(function(){
		var parent = jQuery(this).parent('#kboard-dalia-before-after-list');
		var width = jQuery(parent).width();
		if(width > 1400){
			jQuery(parent).removeClass('mw1400');
			jQuery(parent).removeClass('mw1200');
			jQuery(parent).removeClass('mw1000');
			jQuery(parent).removeClass('mw800');
			jQuery(parent).removeClass('mw600');
			
			for(var i=5; i<99; i+=5){
				jQuery('#kboard-dalia-before-after-list .kboard-dalia-before-after-list .kboard-list-item:nth-child('+i+')').css('margin','0');
			}
		}
		else if(width > 1200){
			jQuery(parent).addClass('mw1400');
			jQuery(parent).removeClass('mw1200');
			jQuery(parent).removeClass('mw1000');
			jQuery(parent).removeClass('mw800');
			jQuery(parent).removeClass('mw600');

			for(var i=5; i<99; i+=5){
				// jQuery('#kboard-dalia-before-after-list .kboard-dalia-before-after-list .kboard-list-item:nth-child('+i+')').css('margin','0');
			}
		}
		else if(width > 1000){
			jQuery(parent).removeClass('mw1400');
			jQuery(parent).addClass('mw1200');
			jQuery(parent).removeClass('mw1000');
			jQuery(parent).removeClass('mw800');
			jQuery(parent).removeClass('mw600');

			for(var i=4; i<99; i+=4){
				// jQuery('#kboard-dalia-before-after-list .kboard-dalia-before-after-list .kboard-list-item:nth-child('+i+')').css('margin','0');
			}
		}
		
		else if(width > 800){
			jQuery(parent).removeClass('mw1400');
			jQuery(parent).removeClass('mw1200');
			jQuery(parent).addClass('mw1000');
			jQuery(parent).removeClass('mw800');
			jQuery(parent).removeClass('mw600');

			for(var i=3; i<99; i+=3){
				// jQuery('#kboard-dalia-before-after-list .kboard-dalia-before-after-list .kboard-list-item:nth-child('+i+')').css('margin','0');
			}
		}
		else if(width > 600){
			jQuery(parent).removeClass('mw1400');
			jQuery(parent).removeClass('mw1200');
			jQuery(parent).removeClass('mw1000');
			jQuery(parent).addClass('mw800');
			jQuery(parent).removeClass('mw600');

			for(var i=2; i<99; i+=2){
				// jQuery('#kboard-dalia-before-after-list .kboard-dalia-before-after-list .kboard-list-item:nth-child('+i+')').css('margin','0');
			}
		}
		else{
			jQuery(parent).removeClass('mw1400');
			jQuery(parent).removeClass('mw1200');
			jQuery(parent).removeClass('mw1000');
			jQuery(parent).removeClass('mw800');
			jQuery(parent).addClass('mw600');
		}
		var item_width = jQuery('.kboard-list-item', this).width();
		jQuery('.kboard-list-item .kboard-list-thumbnail', this).css({'height':(item_width/2)+'px'});
	});
}

function kboard_dalia_before_after_search_toggle(){
	if(jQuery('.kboard-dalia-before-after-search').hasClass('active-search')){
		jQuery('.kboard-dalia-before-after-search').removeClass('active-search');
	}
	else{
		jQuery('.kboard-dalia-before-after-search').addClass('active-search');
	}
}

function kboard_dalia_before_after_slide_img_toggle(position, uid){
	if(position == 'front'){
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .front').show();
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .half-side').hide();
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .side').hide();

		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .front-toggle').addClass('selected');
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .half-side-toggle').removeClass('selected');
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .side-toggle').removeClass('selected');
	}
	else if(position == 'half_side'){
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .front').hide();
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .half-side').show();
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .side').hide();

		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .front-toggle').removeClass('selected');
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .half-side-toggle').addClass('selected');
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .side-toggle').removeClass('selected');
	}
	else if(position == 'side'){
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .front').hide();
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .half-side').hide();
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .side').show();

		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .front-toggle').removeClass('selected');
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .half-side-toggle').removeClass('selected');
		jQuery('.kboard-dalia-before-after-list-slide .kboard-list-item.' + uid + ' .side-toggle').addClass('selected');
	}
}


jQuery(($) => {
	const beforeAfterPhotos = $('.before-after-photo');

	beforeAfterPhotos.each(function() {
		let active = false;
		const wrapper = $(this).find('.wrapper');
		if (!wrapper.length) return;

		const scroller = wrapper.find('.scroller');
		const before = wrapper.find('.before-img-container');
		const after = wrapper.find('.after-img-container');
		if (!scroller.length) return;

		scroller.on('mousedown touchstart', function() {
			active = true;
			scroller.addClass('scrolling');
		});

		$(document.body).on('mouseup touchend touchcancel', function() {
			active = false;
			scroller.removeClass('scrolling');
		});

		$(document.body).on('mouseleave mousemove touchmove', function(e) {
			if (!active) return;
			let x;
			if (e.type === 'mousemove') {
				x = e.pageX;
			} else if (e.type.match(/touch/)) {
				x = e.originalEvent.touches[0].pageX;
			}
			x -= wrapper.offset().left;
			scrollIt(x);
		});

		function scrollIt(x) {
			let transform = Math.max(0, Math.min(x, wrapper.width()));
			after.width(transform);
			scroller.css('left', transform - 25 + 'px');
		}

		// Set initial position
		scrollIt(wrapper.width() / 2);

		// Set width of content-image to width of .wrapper
		const contentImages = $(this).find('.content-image');
		contentImages.each(function() {
			$(this).width(wrapper.width());
		});
	});
});