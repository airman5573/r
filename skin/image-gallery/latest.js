/**
 * @author https://www.cosmosfarm.com
 */

jQuery(document).ready(function(){
	jQuery('.kboard-light-gallery', '#kboard-image-gallery-latest').lightGallery({
		selector: '.target-image',
		download: false,
		getCaptionFromTitleOrAlt: false
	});
	
	jQuery('.kboard-image-gallery-thumbnail', '#kboard-image-gallery-latest').click(function(){
		if(jQuery('.target-image', this).length > 0){
			jQuery('.target-image', this).get(0).click();
		}
	});
});