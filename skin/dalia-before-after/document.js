/**
 * @author https://www.cosmosfarm.com/
 */

jQuery(document).ready(function(){
	kboard_before_after_plus_thumbnail_size();

	if(jQuery('input.front-toggle').hasClass('selected')){
		kboard_before_after_plus_document_img_toggle('front');
	} 
	else if(jQuery('input.half-side-toggle').hasClass('selected')){
		kboard_before_after_plus_document_img_toggle('half-side');
	}
	else{
		kboard_before_after_plus_document_img_toggle('side');
	}
});

jQuery(window).resize(function(){
	kboard_before_after_plus_thumbnail_size();
});

function kboard_before_after_plus_thumbnail_size(){
	var width = jQuery('#kboard-dalia-before-after-document .kboard-thumbnail').width();
	jQuery('#kboard-dalia-before-after-document .kboard-thumbnail').height();
}

function kboard_before_after_plus_document_img_toggle(position){
	if(position == 'front'){
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.front').show();
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.half-side').hide();
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.side').hide();

		jQuery('.front-toggle').addClass('selected');
		jQuery('.half-side-toggle').removeClass('selected');
		jQuery('.side-toggle').removeClass('selected');
	}
	else if(position == 'half_side'){
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.front').hide();
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.half-side').show();
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.side').hide();

		jQuery('.front-toggle').removeClass('selected');
		jQuery('.half-side-toggle').addClass('selected');
		jQuery('.side-toggle').removeClass('selected');
	}
	else if(position == 'side'){
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.front').hide();
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.half-side').hide();
		jQuery('.kboard-thumbnail .kboard-thumbnail-child img.side').show();

		jQuery('.front-toggle').removeClass('selected');
		jQuery('.half-side-toggle').removeClass('selected');
		jQuery('.side-toggle').addClass('selected');
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
