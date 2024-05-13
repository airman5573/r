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
	var width = jQuery('#kboard-before-after-plus-document .kboard-thumbnail').width();
	jQuery('#kboard-before-after-plus-document .kboard-thumbnail').height(Math.round(width/2));
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