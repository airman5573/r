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
    const beforeAfterPhotos = [...(document.querySelectorAll('.before-after-photo') ?? [])];

    beforeAfterPhotos.forEach(function(beforeAfterPhoto) {
        let active = false;
        const wrapper = beforeAfterPhoto.querySelector('.wrapper');
        if (!wrapper) return;
        const scroller = wrapper.querySelector('.scroller');
        const before = wrapper.querySelector('.before-img-container');
        const after = wrapper.querySelector('.after-img-container');
        if (!scroller) return;

        scroller.addEventListener('mousedown', function() {
            active = true;
            scroller.classList.add('scrolling');
        });

        document.body.addEventListener('mouseup', function() {
            active = false;
            scroller.classList.remove('scrolling');
        });
        document.body.addEventListener('mouseleave', function() {
            active = false;
            scroller.classList.remove('scrolling');
        });

        document.body.addEventListener('mousemove', function(e) {
            if (!active) return;
            let x = e.pageX;
            x -= wrapper.getBoundingClientRect().left;
            scrollIt(x);
        });

        function scrollIt(x) {
            let transform = Math.max(0, (Math.min(x, wrapper.offsetWidth)));
            after.style.width = transform + "px";
            scroller.style.left = transform - 25 + "px";
        }

        scrollIt(wrapper.offsetWidth/2);

        scroller.addEventListener('touchstart', function() {
            active = true;
            scroller.classList.add('scrolling');
        });
        document.body.addEventListener('touchend', function() {
            active = false;
            scroller.classList.remove('scrolling');
        });
        document.body.addEventListener('touchcancel', function() {
            active = false;
            scroller.classList.remove('scrolling');
        });

        // Set width of content-image to width of .wrapper
        const contentImages = [...(beforeAfterPhoto.querySelectorAll('.content-image') ?? [])];
        contentImages.forEach(function(contentImage) {
            contentImage.style.width = wrapper.offsetWidth + 'px';
        });

        // Add click event listener to all `.before-after-photo > .wrapper a` and when click, go to the href of the link
        const links = [...(beforeAfterPhoto.querySelectorAll('.wrapper a') ?? [])];
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                window.location ? window.location.assign(link.href) : window.location.replace(link.href);
            });
        });
    });
});
