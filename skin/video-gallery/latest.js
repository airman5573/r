/**
 * @author https://www.cosmosfarm.com
 */

jQuery(document).ready(function(){
	jQuery('.kboard-light-gallery', '.video-gallery-latest').lightGallery({
		select: '.target-video',
		download: false,
		getCaptionFromTitleOrAlt: false
	});
	
	jQuery('.video-gallery-thumbnail', '.video-gallery-latest').click(function(){
		if(jQuery('.target-video', this).length > 0){
			jQuery('.target-video', this).get(0).click();
		}
	});
});