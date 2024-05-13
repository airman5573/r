/**
 * @author https://www.cosmosfarm.com/
 */

jQuery(document).ready(function(){
	jQuery('.kboard-light-gallery', '#kboard-hwaikeul-gallery-document').lightGallery({
		selector: '.target-image',
		download: false,
		getCaptionFromTitleOrAlt: false
	});
	
	jQuery('.kboard-hwaikeul-gallery-thumbnail', '#kboard-hwaikeul-gallery-document').click(function(){
		if(jQuery('.target-image', this).length > 0){
			jQuery('.target-image', this).get(0).click();
		}
	});
});