/**
 * @author https://www.cosmosfarm.com
 */

jQuery(document).ready(function(){
	jQuery('.kboard-light-gallery', '.kboard-hompage-review-latest').lightGallery({
		select: '.target-video',
		download: false,
		getCaptionFromTitleOrAlt: false
	});
	
	jQuery('.kboard-hompage-review-thumbnail', '.kboard-hompage-review-latest').click(function(){
		if(jQuery('.target-video', this).length > 0){
			jQuery('.target-video', this).get(0).click();
		}
	});
});